<?php
namespace Sleek\ArchiveFilter;

add_action('after_setup_theme', function () {
	if (get_theme_support('sleek/archive_filter')) {
		add_filter('pre_get_posts', function ($query) {
			# Only touch main query
			if (!is_admin() and $query->is_main_query()) {
				# Build potential tax and meta query
				$taxQuery = $query->get('tax_query', ['relation' => 'AND']);
				$metaQuery = $query->get('meta_query', ['relation' => 'AND']);
				$hasTaxQuery = false;
				$hasMetaQuery = false;

				# NOTE: On is_tax(), is_tag() and is_category() $query->get('tax_query') will in fact be empty
				# but $query->tax_query will contain the current tax query. We need to merge that into our
				# own tax query in order for get_queried_object() to still return the correct term
				# https://wordpress.stackexchange.com/questions/124100/when-why-does-query-get-tax-query-return-empty/124404
				if (isset($query->tax_query->queries) and !empty($query->tax_query->queries)) {
					$taxQuery = array_merge($taxQuery, $query->tax_query->queries);
				}

				# Go through all get params
				foreach ($_GET as $k => $v) {
					# If this is a sleek filter taxonomy
					if (substr($k, 0, strlen('sleek_filter_tax_')) === 'sleek_filter_tax_') {
						$tax = substr($k, strlen('sleek_filter_tax_'));
						$val = $_GET[$k];
						$val = is_array($val) ? array_filter($val) : array_filter([$val]);

						if (!empty($val)) {
							$hasTaxQuery = true;
							$taxQuery[] = [
								'taxonomy' => $tax,
								'field' => 'term_id',
								'terms' => $val
							];
						}
					}
					# Or a sleek filter meta min query
					elseif (substr($k, 0, strlen('sleek_filter_meta_min_')) === 'sleek_filter_meta_min_') {
						$meta = substr($k, strlen('sleek_filter_meta_min_'));
						$val = $_GET[$k];
						$val = is_array($val) ? array_filter($val) : array_filter([$val]);

						if (!empty($val)) {
							$hasMetaQuery = true;
							$newQuery = [
								'relation' => 'OR'
							];

							foreach ($val as $v) {
								$newQuery[] = [
									'key' => $meta,
									'value' => $v,
									'compare' => '>=',
									'type' => is_numeric($v) ? 'NUMERIC' : 'CHAR'
								];
							}

							$metaQuery[] = $newQuery;
						}
					}
					# Max query
					elseif (substr($k, 0, strlen('sleek_filter_meta_max_')) === 'sleek_filter_meta_max_') {
						$meta = substr($k, strlen('sleek_filter_meta_max_'));
						$val = $_GET[$k];
						$val = is_array($val) ? array_filter($val) : array_filter([$val]);

						if (!empty($val)) {
							$hasMetaQuery = true;
							$newQuery = [
								'relation' => 'OR'
							];

							foreach ($val as $v) {
								$newQuery[] = [
									'key' => $meta,
									'value' => $v,
									'compare' => '<=',
									'type' => is_numeric($v) ? 'NUMERIC' : 'CHAR'
								];
							}

							$metaQuery[] = $newQuery;
						}
					}
					# Equal query
					elseif (substr($k, 0, strlen('sleek_filter_meta_')) === 'sleek_filter_meta_') {
						$meta = substr($k, strlen('sleek_filter_meta_'));
						$val = $_GET[$k];
						$val = is_array($val) ? array_filter($val) : array_filter([$val]);

						if (!empty($val)) {
							$hasMetaQuery = true;
							$newQuery = [
								'relation' => 'OR'
							];

							foreach ($val as $v) {
								$newQuery[] = [
									'key' => $meta,
									'value' => $v,
									'compare' => '=',
									'type' => is_numeric($v) ? 'NUMERIC' : 'CHAR'
								];
							}

							$metaQuery[] = $newQuery;
						}
					}
				}

				if ($hasTaxQuery) {
					$query->set('tax_query', $taxQuery);
				}

				if ($hasMetaQuery) {
					$query->set('meta_query', $metaQuery);
				}

				# See if a search string is provided
				if (isset($_GET['sleek_filter_search'])) {
					$query->set('s', $_GET['sleek_filter_search']);
				}

				# If any filters are set - ignore sticky posts
				if ($hasTaxQuery or $hasMetaQuery or isset($_GET['sleek_filter_search'])) {
					$query->set('ignore_sticky_posts', true);
				}
			}
		});
	}
});
