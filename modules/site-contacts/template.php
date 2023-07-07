<?php if ($has_content) : ?>
<div class="col-12 col-lg-3 footer-column">
	<div class="footer-contact-wrapper">
		<?php if ($title) : ?>
		<small class="footer-title"><?= $title ?></small>
		<?php endif ?>

		<?php if ($contacts) : ?>
		<ul class="footer-links list-unstyled footer-contact">
			<?php foreach ($contacts as $contact) : ?>
			<li class="footer-link-item">
				<?php if ($contact['type'] === 'text') : ?>
				<div class="footer-link">
					<?= $contact['text'] ?>
				</div>
				<?php else : ?>
				<a class="footer-link" href="<?= $contact['link'] ?>">
					<img class="footer-contact-icon"
						src="<?php echo get_template_directory_uri(); ?>/dist/assets/icons/<?= $contact['type'] ?>.svg"
						alt="<?= ucfirst($contact['type']) ?>">
					<?= $contact['text'] ?>
				</a>
				<?php endif ?>
			</li>
			<?php endforeach ?>
		</ul>
		<?php endif ?>

		<?php if ($link ?? false) : ?>
		<a href="<?= $link['url'] ?>" class="button-link button-link--tersiary"
			target="<?= $link['target'] ?>"><?= $link['title'] ?></a>
		<?php endif ?>
	</div>
</div>
<?php endif ?>