<?php

namespace Classes;

use Inc\Classes\Mailchimp;

class Rest
{
    public function __construct()
    {
        if (is_admin()) {
            return;
        }

        $namespace = 'custom/v2/';

        add_action('wp_enqueue_scripts', function () use ($namespace) {
            wp_localize_script(
                'sleek',
                'rest_object',
                array(
                    'api_nonce' => wp_create_nonce('wp_rest'),
                    'api_url' => site_url("/wp-json/$namespace"),
                    'lang' => pll_current_language(),
                )
            );
        }, 100);


        
        # Add REST API support to poly lang language.
        add_action('rest_api_init', function () {
            global $polylang;

            $default = pll_default_language();
            $langs = pll_languages_list();
            $curLang = !empty($_GET['lang']) ? $_GET['lang'] : '';

            if (!in_array($curLang, $langs)) {
                $curLang = $default;
            }

            $polylang->curlang = $polylang->model->get_language($curLang);

            $GLOBALS['text_direction'] = $polylang->curlang->is_rtl ? 'rtl' : 'ltr';
        });

        # Register WP_rest routes
        add_action('rest_api_init', function () use ($namespace) {
            register_rest_route($namespace, '/cpt_paging/(?P<post_type>.+)/(?P<page>.+)', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_listing_posts'),
            ));
        });

        add_action('rest_api_init', function () use ($namespace) {
            register_rest_route($namespace, '/mailchimp/', array(
                'methods' => 'POST',
                'callback' => array($this, 'process_mailchimp_newsletter'),
            ));
        });
    }

    public function get_listing_posts($request)
    {
        $post_type = $request['post_type'];
        $taxonomy = sleek_get_cpt_category($post_type);
        $filters = $_GET;
        $taxQuery = [];

        $args = array(
            'post_type' => $post_type,
            'post_status' => 'publish',
            'ignore_sticky_posts' => true,
        );

        # Language
        if (isset($filters['lang']) && $filters['lang']) {
            $args['lang'] = $filters['lang'];
        }

        # Tags - category slug
        if (isset($filters['tag']) && $filters['tag']) {
            $taxQuery[] = array(
                'taxonomy' => $taxonomy,
                'field' => 'slug',
                'terms' => explode(',', $filters['tag']),
            );
        }

        # Term - term ID
        if (isset($filters['termid']) && $filters['termid']) {
            $taxQuery[] = array(
                'taxonomy' => $taxonomy,
                'field' => 'term_id',
                'terms' => explode(',', $filters['termid']),
            );
        }

        # Add tax query
        if (sizeof($taxQuery) > 0) {
            $args['tax_query'] = $taxQuery;
        }

        # Post per page
        if (isset($request['page']) && $request['page']) {
            $args['paged'] = $request['page'];
            $args['posts_per_page'] = get_field('posts_per_page', $post_type . '_settings') ?? 10 ?: 10;
        }


        # Get post type specific args for filtering
        $method_name = "get_{$post_type}_filter_args";
        if (method_exists($this, $method_name)) {
            $args = $this->$method_name($args, $filters);
        }

        $wp_query = new \WP_Query($args);

        # Return no items available text if no posts match the arguments
        if (empty($wp_query->posts)) {
            $emptyResult = sleek_empty_listing_content($post_type);

            return new \WP_REST_Response(['html' => $emptyResult], 200);
        }

        $posts = $wp_query->posts;

        $listCount = $wp_query->query_vars['paged'] == $wp_query->max_num_pages
            ? $wp_query->found_posts
            : $wp_query->post_count * $wp_query->query_vars['paged'];

        # Initialized $tpl
        $tpl = array(
            'html'  => '',
            'limit' => $wp_query->max_num_pages,
            'total' => sleek_render_shortcode(sleek_sitewide('job_listing_translation', 'job_count_text'), ['current_jobs' => $listCount, 'total_jobs' => $wp_query->found_posts]),
        );

        # Update $tpl html value
        foreach ($posts as $post) {

            ob_start();
            \Sleek\Utils\get_template_part('modules/post', $post_type, [
                'postID' => $post->ID,
            ]);
            $tpl['html'] .= ob_get_contents();
            ob_clean();
        }

        return new \WP_REST_Response($tpl, 200);
    }

    public function get_pnty_job_showcase_filter_args($args, $filters)
    {
        return $this->get_pnty_job_filter_args($args, $filters);
    }

    public function get_pnty_job_filter_args($args, $filters)
    {
        $meta = [];

        # Location
        if (isset($filters['location']) && $filters['location']) {
            $meta[] = array(
                'key' => '_pnty_location',
                'value' => explode(',', $filters['location']),
                'compare' => 'IN'
            );
        }

        # Company
        if (isset($filters['company']) && $filters['company']) {
            $meta[] = array(
                'key' => '_pnty_organization_name',
                'value' => $filters['company'],
                'compare' => '='
            );
        }

        if (sizeof($meta) > 0) {
            $args['meta_query'] = $meta;
        }

        return $args;
    }

    public function process_mailchimp_newsletter()
    {
        $apiKey = get_field('general_info_mailchimp', 'global_settings');
        $emailListID = '';

        if (function_exists('pll_current_language')) {
            $emailListID = get_field('mc_email_list_id', 'site_settings');
        }

        try {
            if (!empty($apiKey) && !empty($emailListID)) {
                $mailChimp = new MailChimp($apiKey);

                $mailChimp->post("lists/$emailListID/members", [
                    'email_address' => $_POST['email'],
                    'status'        => 'subscribed',
                ]);
            }

            wp_send_json_success();
        } catch (\Exception $exp) {
            wp_send_json_error($exp->getMessage());
        }
    }
}

$rest = new Rest();
