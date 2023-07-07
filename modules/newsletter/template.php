<section class="section section--padding section--fullWidth section-newsletter bg--off-white">
	<div class="newsletter-row">
		<div class="newsletter-column--content">
			<div class="newsletter-icon">
				<svg class="svg--inherit-color" width="208" height="209" viewBox="0 0 208 209" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path class="path-fill" d="M130.135 208.4C123.186 208.4 116.303 206.947 109.926 204.017C94.5115 196.948 83.9125 183.226 80.8999 166.355C77.0297 144.882 85.7376 121.029 104.187 102.55C113.972 92.7494 125.121 85.195 136.578 79.3805C125.473 70.6147 111.971 65.3288 97.4581 64.9984C78.2611 64.58 60.1197 71.6939 46.3981 85.1069C32.6766 98.5418 25.1122 114.289 25.1122 128.517H0V62.774C0 28.9662 27.1572 0.400391 59.3281 0.400391C81.6036 0.400391 101.548 18.1081 106.892 40.5291C128.288 43.1941 147.638 53.5897 162.328 69.051C179.04 63.8752 194.696 61.6287 205.867 60.6816L208 85.7456C201.227 86.3182 190.386 87.6837 178.094 90.8112C185.329 104.18 189.793 119.465 190.606 135.741C191.904 161.642 180.865 185.12 161.096 198.555C151.487 205.075 140.712 208.4 130.135 208.4ZM153.927 99.0704C142.537 104.114 131.3 110.986 121.933 120.368C109.311 133.01 103.197 148.56 105.616 161.929C106.738 168.139 110.19 176.509 120.393 181.178C128.573 184.922 138.293 183.667 147.023 177.742C159.491 169.285 166.418 154.044 165.56 136.997C164.856 123.011 160.656 110.039 153.927 99.0704ZM59.3281 25.5524C41.0986 25.5524 25.1122 42.9519 25.1122 62.774V71.0111C26.3216 69.6897 27.553 68.4122 28.8504 67.1568C43.2536 53.0611 61.2192 44.0751 80.68 41.0357C76.6559 32.1158 68.2778 25.5524 59.3281 25.5524Z" fill="#E1EFEB"/>
				</svg>
			</div>
		</div>
		<div class="newsletter-column--form">
			<!-- Display this by default -->
			 <?php include get_stylesheet_directory() . '/modules/newsletter/__form.php' ?>

			<!-- Display this when newsletter subscription succeeds -->
			<div class="newsletter-message h3 display-none">
				<?=$newsletter_data['success'] ?? 'Thank you for signing up, aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum!'?>
			</div>
		</div>
	</div>
</section>


