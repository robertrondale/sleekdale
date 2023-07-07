<section id="<?=$anchor_id ?? ''?>" class="section section-services section--padding section--fullWidth bg--dark-teal">
	<div class="service-wrapper">
		<?php if( isset($items) and !empty($items) ) : ?>
		<?php foreach($items as $key => $item) : ?>
		<?php if($key == 0) : ?>
		<div id="service-circle-<?=$key+1?>" class="service-circle bg--off-white">
			<div class="service-content">
				<?php if (isset($item['image']) and !empty($item['image'])) : ?>
				<img class="service-icon laptop-only js-lazy" data-src="<?=wp_get_attachment_image_url($item['image'])?>" alt="">
				<?php endif ?>
				<?php if($item['title_option'] == 'title') : ?>
				<div class="service-title h3"><?=$item['title'] ?? ''?></div>
				<?php elseif ($item['title_option'] == 'link') :?>
				<?php if(isset($item['link']) and !empty($item['link'])) : ?>
				<?php $additionalSettings =  !empty($item['link']['target']) ? 'rel="nofollow noreferrer"' : ''; ?>
				<a class="service-title service-title-link h3" href="<?=$item['link']['url']?>"
					target="<?=$item['link']['target']?>" <?=$additionalSettings?>><?=$item['link']['title']?></a>
				<?php endif ?>
				<?php endif ?>
				<?php if (isset($item['service_links']) and !empty($item['service_links'])) : ?>
				<ul class=" list-unstyled service-links">
					<?php foreach($item['service_links'] as $link) : ?>
					<?php if(isset($link['link']) and !empty($link['link'])) : ?>
					<?php $additionalSettings =  !empty($link['link']['target']) ? 'rel="nofollow noreferrer"' : ''; ?>
					<li class="service-link">
						<a href="<?=$link['link']['url']?>" target="<?=$link['link']['target']?>"
							<?=$additionalSettings?>><?=$link['link']['title']?></a>
					</li>
					<?php endif ?>
					<?php endforeach ?>
				</ul>
				<?php endif ?>
			</div>
		</div>
		<?php endif ?>
		<?php endforeach ?>
		<?php if( isset($items) and !empty($items) ) : ?>
		<div class=" service-under">
			<?php foreach($items as $key => $item) : ?>
			<?php $position = $key + 1; 
									$bg_color = $position == 2 ? 'bg--light-green' : 'bg--pink'; ?>
			<?php if($position != 1) : ?>
			<div id="service-circle-<?=$position?>" class="service-circle <?=$bg_color?>">
				<div class="service-content">
					<?php if (isset($item['image']) and !empty($item['image'])) : ?>
					<img class="service-icon laptop-only js-lazy" data-src="<?=wp_get_attachment_image_url($item['image'])?>" alt="">
					<?php endif ?>
					<?php if($item['title_option'] == 'title') : ?>
					<div class="service-title h3"><?=$item['title'] ?? ''?></div>
					<?php elseif ($item['title_option'] == 'link') :?>
					<?php if(isset($item['link']) and !empty($item['link'])) : ?>
					<?php $additionalSettings =  !empty($item['link']['target']) ? 'rel="nofollow noreferrer"' : ''; ?>
					<a class="service-title h3" href="<?=$item['link']['url']?>" target="<?=$item['link']['target']?>"
						<?=$additionalSettings?>><?=$item['link']['title']?></a>
					<?php endif ?>
					<?php endif ?>
					<?php if (isset($item['service_links']) and !empty($item['service_links'])) : ?>
					<ul class="list-unstyled service-links">
						<?php foreach($item['service_links'] as $link) : ?>
						<?php if(isset($link['link']) and !empty($link['link'])) : ?>
						<?php $additionalSettings =  !empty($link['link']['target']) ? 'rel="nofollow noreferrer"' : ''; ?>
						<li class="service-link">
							<a href="<?=$link['link']['url']?>" target="<?=$link['link']['target']?>"
								<?=$additionalSettings?>><?=$link['link']['title']?></a>
						</li>
						<?php endif ?>
						<?php endforeach ?>
					</ul>
					<?php endif ?>
				</div>
			</div>
			<?php endif ?>
			<?php endforeach ?>
		</div>
		<?php endif ?>
		<?php endif ?>
	</div>
</section>