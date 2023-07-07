<?php

$postID = isset($postID) ? $postID : get_the_ID();

if (empty(get_post_status($postID))) {
    return;
}

$img = get_post_field('image', $postID);
?>

<a href="<?= get_the_permalink($postID) ?>" class="article ">
	<div class="article-container">
		<?php if (has_post_thumbnail($postID)) : ?>
			<div class="article-image">
				<?= get_the_post_thumbnail($postID, 'article_promo_portrait_medium_large') ?>
			</div>
		<?php elseif (isset($img) and !empty($img)) : ?>
			<div class="article-image">
				<?= wp_get_attachment_image($img, 'article_promo_portrait_medium_large') ?>
			</div>
		<?php endif ?>
		<div class="article-content">
			<?php if ($categories = sleek_get_cpt_tag_names($postID)) : ?>
				<div class="article-content-tag text--pink"><?= $categories ?></div>
			<?php endif ?>
			<div class="article-content-title h3"><?= get_the_title($postID) ?></div>
		</div>
	</div>
</a>