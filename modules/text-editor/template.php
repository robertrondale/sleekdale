<section id="<?=$anchor_id ?? ''?>" class="section section-text-editor section--padding section--fullWidth <?=$bg_color?>">
	<div class="container-fluid no-gutter-grid">
		<div class="row">
			<div class="col-12 col-lg-8 offset-lg-2">
				<?php if(isset($title) and !empty($title)) :?>
				<div class="text-editor-wrapper">
					<div class="editor-content"> <?=$title?></div>
				</div>
				<?php endif ?>
			</div>
		</div>
	</div>
</section>