<?php while (have_posts()) : the_post() ?>
<div id="single-<?php echo get_post_type() ?>" class="selected-post bg--dark-teal">
	<?php 
			#Blog content
			$title 		= get_the_title();
			$preamble 	= get_the_excerpt();
			$content 	= get_the_content();
			$img		= get_post_field('image');
			$image		= isset($img) && !empty($img) ? $img : '';

			#Related post
			$terms = get_the_terms($post->ID, (get_post_type() === 'post' ? 'category' : get_post_type() . '_category'));
			$term_id = isset($terms[0]->term_id) && !empty($terms[0]->term_id) ? $terms[0]->term_id : '';
			$post_Id = get_the_ID();

			$args['tax_query'] = [[
				'taxonomy' => 'category',
				'field' => 'term_id',
				'terms' => $term_id,
			]];
			
			if (isset($post_Id) and !empty($post_Id)) { $args['post__not_in'] = [$post_Id]; }
			
			$idChecker = sleek_get_posts('post', $args);
		?>

	<?php if (!empty($title) ) : ?>
	<?php Sleek\Modules\render('text-hero', [
				'title' => $title ?? '',
				'preamble' => $preamble ?? '',
				'image'	   => [],
				'link' => [],
				]); ?>
	<?php endif ?>
	<!-- Featured Image -->
	<?php if (isset($image) and !empty($image)) : ?>
		<figure class="selected-post-image">
			<?= wp_get_attachment_image($image, 'large') ?>
		</figure>
	<?php endif ?>

	<?php if (!empty($content) ) : ?>
	<?php Sleek\Modules\render('text-editor', [
				'title' => $content ?? '',
				'bg_color' => 'bg--dark-teal',
				]); ?>
	<?php endif ?>

	<!-- Article Category -->
	<?php if (!empty($term_id) && !empty($idChecker)) : ?>
	<?php Sleek\Modules\render('article-promo', [
			'title' => 'Related Posts',
			'preamble' => '',
			'bg_color' => 'bg--dark-teal',
			'category' => $term_id,
			'exclude'  => $post_Id ?? '',
		]); ?>
	<?php endif ?>


</div>
<?php endwhile ?>