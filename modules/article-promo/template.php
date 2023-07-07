<section class="section section--padding section--fullWidth section-article-promo <?= $bg_color ?? '' ?>">
  <?php if ($title || $preamble) : ?>
  <div class="section-header section-header--center">
    <?php if ($title) : ?>
    <div class="section-header-title h2">
      <?php echo $title ?>
    </div>
    <?php endif ?>

    <?php if ($preamble) : ?>
    <div class="section-header-description h5">
      <?php echo $preamble ?>
    </div>
    <?php endif ?>
  </div>
  <?php endif ?>

  <?php if ($articles ?? '') : ?>
  <div class="section-article-promo-body">
    <?php
			$isSlider = 'slider' === $layout;
			$wrapperClass = 'articles--listing';
			$linkClass = '';

			if ($isSlider) {
				$wrapperClass = 'articles--slider swiper';
				$linkClass = 'swiper-slide';
			}
			?>

    <div class="articles articles--<?= $image_ratio ?? 'portrait' ?> <?= $wrapperClass ?>">
      <?php if ($isSlider) : ?>
      <div class="swiper-wrapper">
        <?php endif ?>

        <?php foreach ($articles as $article) : ?>
        <?php
						$tag = 'div';
						$attr = '';

						if ($article->link->url ?? '') {
							$tag = 'a';
							$attr = 'href="' . $article->link->url . '"';
						}

						// Item container start tag
						echo "<$tag $attr class='article $linkClass'>";
						?>

        <div class="article-container">
          <?php if ($article->image) : ?>
          <div class="article-image">
            <?= $article->image ?>
          </div>
          <?php endif ?>

          <?php if ($article->pre_header || $article->title) : ?>
          <div class="article-content">
            <?php if ($article->pre_header) : ?>
            <div class="article-content-tag text--pink"><?= $article->pre_header ?></div>
            <?php endif ?>
            <?php if ($article->title) : ?>
            <div class="article-content-title h3"><?= $article->title ?></div>
            <?php endif ?>
          </div>
          <?php endif ?>
        </div>

        <?= "</$tag>" ?>
        <?php endforeach ?>

        <?php if ($isSlider) : ?>
      </div>
      <?php endif ?>
    </div>
  </div>
  <?php endif ?>
</section>