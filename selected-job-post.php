<?php /* Template Name: Selected Job Post */ ?>

<?php get_header() ?>

<main>
	<section class="job-post-banner js-bg-switch bg--dark-teal"
		data-bg-desktop="https://www.dailysports.com/wp-content/uploads/2022/08/353-145-465_353-292-999_205-1-1920x670.jpg"
		data-bg-mobile="https://www.dailysports.com/wp-content/uploads/2022/08/353-145-465_353-292-999_205-720x1305.jpg">
		<div class="job-post-wrapper">
			<div class="h4 job-post-company">Peak Performance</div>
			<div class="h1 job-post-title">Consumer Service Manager</div>
			<div class="job-post-tags">
				<div class="job-post-tags-item">Online sales</div>
				<div class="job-post-tags-item">Stockholm</div>
			</div>
			<p class="preamble job-post-description">Peak Performance was born in the Swedish mountains out of love
				for
				skiing in remote, untouched terrain and the passion for adventure and nature runs deep. The products
				all
				have the same purpose – empower the freedom to be adventurous, and live everyday life to the
				fullest,
				365 days a year. Whether it be horizontally or vertically, on skis, bikes or your own two feet, they
				offer the optimal balance of progressive style & performance.</p>
		</div>
	</section>

	<section class="job-post-contact bg--dark-teal">
		<div class="job-post-contact-wrapper">
			<div class="job-post-contact-profile">
				<figure class="job-post-contact-image ratio--1-1">
					<img class="js-lazy"
						data-src="<?php echo get_template_directory_uri(); ?>/dist/assets/temp/profile.png"
						alt="Profile">
				</figure>
				<div>
					<p class="preamble job-post-contact-name">Niclas Winroth</p>
					<div class="small job-post-contact-position">CEO & Founder</div>
					<ul class="job-post-contact-links list-unstyled">
						<li class="job-post-contact-links-item">
							<a class="job-post-contact-link" href="mailto:niclas@beyondretail.se">
								<img class="job-post-contact-contact-icon"
									src="<?php echo get_template_directory_uri(); ?>/dist/assets/icons/email.svg"
									alt="Email">
								niclas@beyondretail.se </a>
						</li>
						<li class="job-post-contact-links-item">
							<a class="job-post-contact-link" href="tel:+4673 380 9898">
								<img class="job-post-contact-contact-icon"
									src="<?php echo get_template_directory_uri(); ?>/dist/assets/icons/phone.svg"
									alt="Telephone">
								+4673 380 9898 </a>
						</li>
					</ul>
				</div>
			</div>
			<div class="job-post-contact-apply">
				<a href="#" class="button button--quarternary">Apply here</a>
				<div class="small">This job is open for applications</div>
			</div>
		</div>
	</section>

	<div class="job-post-details bg--off-white">
		<?php Sleek\Modules\render('text-editor', [
          'bg_color' => 'bg--off-white',
          'title' => 'About the role

		  We are looking for an experienced Customer Service Manager to lead Peak Performance’s Consumer Service team. You will be responsible for the overall customer engagement and satisfaction levels and your mission will be to provide outstanding customer service to Peak Performance’s D2C-customers. Together with your team, consisting of six inhouse agents and an external team at a call center in Barcelona, you will deliver excellent customer service on a daily basis and also have a big focus on driving optimizations and lead improvement projects in order to create incremental value throughout all touch points with our customers.
		  
		  To succeed in the role, you need to be an engaging and envisioning leader and you should also be comfortable working with data to enable you to analyze the business and take actions based on the data. You will be part of the e-commerce team and you will also work closely with the marketing team. The position reports to the Head of E-com and is based at Peak Performance HQ in Frihamnen, Stockholm.
		   
		  
		  As a Consumer Service Manager you will:
		  
		  Be accountable for our Consumer Service team and the delivery of all service KPIs in line with the overall company plan
		  Lead our Consumer Service team to deliver an exceptional experience which promotes and supports our brand values whilst always maintaining our ‘human and personal’ touch
		  Develop and implement the Consumer Service strategy and KPI:s that will contribute to and support delivery of the overall business strategy
		  Identify business opportunities and ensure processes and capacity are fit for purpose for future growth of all channels across e-commerce and retail
		  Ensure Consumer Service processes maintain optimum efficiency and continuously seek ways to improve the customer experience, putting the customer at the heart of decision-making
		  Work closely with E-commerce, Marketing, Retail and Operation teams to help provide an understanding of the customer needs and help develop the best communication and shopping experience for our D2C customers
		  Motivate, inspire and develop a high-performing team
		  Advocate for Peak Performance’s cultural values
		  
		  The successful candidate will have a great understanding of the Peak Performance brand and its values, combined with a commercial outlook and passion for customer service. As a leader we believe you, as well as we, are driven by building and developing engaged and sales driven teams. You are a natural leader that focuses on coaching and developing your team to achieve success. Last but not least you need to be eager to own and drive optimizations and lead improvement projects.
		  
		  
		  Qualifications
		  
		  Experienced leader within Customer Service in a D2C business
		  Proven track record of leading a Customer Service team through periods of significant growth and change
		  Proven leadership experience with ability to work cross-functionally and to develop, motivate, inspire and influence teams to deliver targets.
		  Strong empathy for customers, exceptional “can do” attitude and a passionate customer-first focus
		  Good technical understanding and strong interest in continuous improvement tools and techniques
		  A confident and articulate communicator capable of inspiring strong collaboration in the organization
		  Fluent in English (other languages are a bonus)
		  Omni-channel experience is a plus
		  
		  
		  Personal competencies
		  
		  A passionate customer-first focus
		  A strong ability to define a vision, communicate it and through collaboration with the rest of the organization, implement it to achieve the desired result
		  Commercial, results-driven and analytical with an ability to deliver results through own work and by motivating and leading others
		  Strong analytical skills and ability to leverage analytics to improve the customer experience.
		  A curious, inclusive and committed leader who has a willingness to contribute with knowledge and energy 
		  
		  
		  Finally, and as always at Peak Performance you are a true team player and match our values of Togetherhood, Passion and Winning Spirit.
		  
		  Interested?
		  
		  Apply with CV or Linkedin as soon as possible, we are eager to get to know you!'
        ]); ?>

		<div class="job-post-apply">
			<a href="#" class="button button--primary">Apply here</a>
		</div>
	</div>
</main>

<?php get_sidebar() ?>
<?php get_footer() ?>