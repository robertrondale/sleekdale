<?php if ($has_content) : ?>
	<div class="col-12 col-lg-3 footer-column">
		<?php if ($title) : ?>
			<small class="footer-title"><?= $title ?></small>
		<?php endif ?>
		
		<?php Sleek\Modules\render('offices', ['offices' => $offices]); ?>
	</div>
<?php endif ?>