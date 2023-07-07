<section id="<?=$anchor_id ?? ''?>"
	class="section section-text-image-animated section--padding section--fullWidth <?=$bg_color?> <?=($is_text_first) ? 'is-text-first' : ''?>">
	<div class="container-fluid no-gutter-grid">
		<div class="row">
			<div class="col-12 col-lg-6 text-image-animated-image-column">
				<figure class="animation-container js-animation-figure ratio--1-1" id="js-animation-container"></figure>
			</div>
			<div class="col-12 col-lg-6 text-image-animated-content-column">
				<div class="text-image-content">

					<?php if(isset($title) and !empty($title)) :?>
					<div class="h3 text-image-title"><?=$title?></div>
					<?php endif ?>

					<?php if(isset($text) and !empty($text)) : ?>
					<p class="text-image-txt"><?=$text?></p>
					<?php endif ?>

					<?php if(isset($link) and !empty($link)) : ?>
					<?php $additionalSettings =  !empty($link['target']) ? 'rel="nofollow noreferrer"' : ''; ?>
					<div> <a href="<?=$link['url']?>" class="button button--inherit-color" target="<?=$link['target']?>"
							<?=$additionalSettings?>><?=$link['title']?></a></div>
					<?php endif ?>

				</div>
			</div>
		</div>
	</div>
</section>