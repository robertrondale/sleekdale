<section class="section section--padding section--fullWidth section-anchor-links bg--dark-teal">
	<?php if (isset($items) and !empty($items)) : ?>
	<ul class="anchor-links-wrapper list-unstyled">
		<?php foreach ($items as $item) : ?>
		<?php if($item['links_option'] == 'anchor'): ?>
		<li class="anchor-links-item"><a href="#<?=$item['anchor_id'] ?? ''?>"
				class="button button--small button--quarternary js-anchorLink"><?=$item['anchor_title'] ?? ''?></a></li>
		<?php elseif($item['links_option'] == 'links'): ?>
		<?php if(isset($item['link']) and !empty($item['link']) ) : ?>
		<?php $additionalSettings =  !empty($item['link']['target']) ? 'rel="nofollow noreferrer"' : ''; ?>
		<li class="anchor-links-item"><a href="<?=$item['link']['url']?>" target="<?=$link['link']['target']?>"
				<?=$additionalSettings?> class="button button--small button--quarternary">
				<?=$item['link']['title']?></a>
		</li>
		<?php endif ?>
		<?php endif ?>
		<?php endforeach ?>
	</ul>
	<?php endif ?>
</section>