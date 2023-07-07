<section id="<?=$anchor_id ?? ''?>" class="section section--padding section--fullWidth section-expertise bg--off-white">
	<div class="section-expertise-body">
		<?php if(isset($items) and !empty($items)) : ?>
		<div class="expertises">
			<?php foreach ($items as $item) : ?>
				<div class="expertise">
					<?php if(isset($item['image']) and !empty($item['image'])) : ?>
						<div class="expertise-icon">
							<img src="<?=wp_get_attachment_image_url($item['image'])?>" alt="">
						</div>
					<?php endif ?>
					<div class="expertise-content">
						<?php if (!empty($item['title'])) : ?>
							<div class="expertise-content-title h3"><?=$item['title']?></div>
						<?php endif ?>
						<?php if (!empty($item['title'])) : ?>
							<div class="expertise-content-preamble"><?=$item['preamble']?></div>
						<?php endif ?>
						<?php if ( isset($item['details_content']) and !empty($item['details_content'])) : ?>
							<?php foreach ($item['details_content'] as $detail) : ?>
								<div class="expertise-content-details">
									<div class="expertise-content-detail">
										<?php if (!empty($detail['title'])) : ?>
											<div class="expertise-content-detail-title h5"><?=$detail['title']?></div>
										<?php endif ?>
										<ul class="expertise-content-detail-list">
											<?php foreach ($detail['details_list'] as $list) : ?>
												<?php if (!empty($list['text'])) : ?>
													<li class="h5"><?=$list['text']?></li>
												<?php endif ?>
											<?php endforeach ?>
										</ul>
									</div>
								</div>
							<?php endforeach ?>
						<?php endif ?>
						<?php if(isset($item['link']) and !empty($item['link'])) : ?>
							<?php $additionalSettings =  !empty($item['link']['target']) ? 'rel="nofollow noreferrer"' : ''; ?>
							<div class="expertise-content-link">
								<a href="<?=$item['link']['url']?>" class="button-link button-link--primary" target="<?=$item['link']['target']?>" <?=$additionalSettings?>><?=$item['link']['title']?></a>
							</div>
						<?php endif ?>
					</div>
				</div>
			<?php endforeach ?>
		</div>
		<?php endif ?>
	</div>
</section>