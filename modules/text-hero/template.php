<section id="<?=$anchor_id ?? ''?>" class="section section-text-hero js-bg-switch <?=$hero_class?>"
	data-bg-desktop="<?= $images['desktop'] ?? '' ?>"
	data-bg-mobile="<?= $images['mobile'] ?? '' ?>">
	<div class="text-hero-wrapper">
		<?php if( isset($title) and !empty($title)) : ?>
			<div class="h1 text-hero-title"><?=$title?></div>
		<?php endif; ?>
		<?php if( isset($preamble) and !empty($preamble)) : ?>
		<p class="preamble text-hero-description"><?=$preamble?></p>
		<?php endif; ?>
		<?php if(isset($link) and !empty($link)) : ?>
			<?php $additionalSettings =  !empty($link['target']) ? 'rel="nofollow noreferrer"' : ''; ?>
			<a href="<?=$link['url']?>" class="button button--quarternary" target="<?=$link['target']?>" <?=$additionalSettings?> ><?=$link['title']?></a>
		<?php endif; ?>
	</div>
</section>