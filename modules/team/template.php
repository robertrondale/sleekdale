<section id="<?=$anchor_id ?? ''?>" class="section section-team section--padding section--fullWidth bg--off-white">
	<div class="container-fluid no-gutter-grid">
		<?php if(isset($title) and !empty($title)) : ?>
		<div class="h2 team-name"><?=$title?></div>
		<?php endif ?>
		<div class="row">
			<?php foreach ($employee_details as $employee)  : ?>
			<div class="col-12 col-lg-3">
				<div class="team-member">
					<?php if(isset($employee['image']) and !empty($employee['image'])) : ?>
					<figure class="team-member-profile ratio--1-1">
						<img class="js-lazy" data-src="<?=$employee['image']?>" alt="Member Profile">
					</figure>
					<?php endif ?>
					<p class="preamble team-member-name"><?=$employee['name'] ?? ''?></p>
					<div class="small team-member-position"><?=$employee['position'] ?? ''?></div>
					<ul class="team-member-links list-unstyled">

						<li class="team-member-links-item">
							<a class="team-member-link small" href="mailto:<?=$employee['email'] ?? ''?>">
								<img class="team-member-contact-icon"
									src="<?php echo get_template_directory_uri(); ?>/dist/assets/icons/email-black.svg"
									alt="Email">
								<?=$employee['email'] ?? ''?> </a>
						</li>

						<li class="team-member-links-item">
							<a class="team-member-link small" href="tel:<?=$employee['phone'] ?? ''?>">
								<img class="team-member-contact-icon"
									src="<?php echo get_template_directory_uri(); ?>/dist/assets/icons/phone-black.svg"
									alt="Telephone">
								<?=$employee['phone'] ?? ''?> </a>
						</li>
						<li class="team-member-links-item">
							<a class="team-member-link small" href="<?=$employee['url'] ?? ''?>"
								rel="nofollow noreferrer" target="_blank">
								<img class="team-member-contact-icon"
									src="<?php echo get_template_directory_uri(); ?>/dist/assets/icons/linkedin-black.svg"
									alt="Linkedin">
								Linkedin</a>
						</li>

					</ul>
				</div>
			</div>
			<?php endforeach ?>
		</div>
	</div>
</section>