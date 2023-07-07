<?php if ($has_content) : ?>
	<div class="col-12 col-lg-3 footer-column">
		<?php if ($title) : ?>
			<small class="footer-title"><?= $title ?></small>
		<?php endif ?>

		<?php if ($menu_items) : ?>
			<ul class="footer-links footer-links-anchor list-unstyled">
				<?php foreach ($menu_items as $item) : ?>
					<li class="footer-link-item">
						<a class="footer-link" href="<?= $item->url ?>" target="<?= $item->target ?>"><?= $item->title ?></a>
					</li>
				<?php endforeach ?>
			</ul>
		<?php endif ?>
	</div>
<?php endif ?>