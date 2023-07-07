<section id="<?=$anchor_id ?? ''?>" class="section section--padding section--fullWidth section-usp <?=$bg_color?>">
  <?php if (isset($title) and !empty($title)) : ?>
  <div class="section-header section-header--center">
    <?php if ($title) : ?>
    <div class="section-header-title h2">
      <?php echo $title ?>
    </div>
    <?php endif ?>
  </div>
  <?php endif ?>

  <?php if(isset($content) and !empty($content)) : ?>
  <div class="section-usp-body">
    <?php if($content_view == 'statistic') : ?>
    <div class="usps usps--statistic">
      <?php foreach ($content as $content_value) : ?>
      <div class="usp">
        <div class="usp-wrapper">
          <div class="usp-statistic">
            <div class="usp-statistic-number h3 js-statistic">
              <?= !empty($content_value['number']) ? $content_value['number'] : '' ?></div>
            <div class="usp-statistic-title h4">
              <?= !empty($content_value['number_title']) ? $content_value['number_title'] : '' ?></div>
          </div>
          <div class="usp-title"><?= !empty($content_value['title']) ? $content_value['title'] : '' ?></div>
          <div class="usp-text"><?= !empty($content_value['text']) ? $content_value['text'] : '' ?></div>
        </div>
      </div>
      <?php endforeach ?>
    </div>

    <?php elseif ($content_view == 'icon') : ?>
    <div class="usps usps--icon">
      <?php foreach ($content as $content_value) : ?>
      <div class="usp">
        <div class="usp-wrapper">
          <div class="usp-icon">
            <?php echo wp_get_attachment_image($content_value['image']); ?>
          </div>
          <div class="usp-title"><?= !empty($content_value['title']) ? $content_value['title'] : '' ?></div>
          <div class="usp-text"><?= !empty($content_value['text']) ? $content_value['text'] : '' ?></div>
        </div>
      </div>
      <?php endforeach ?>
    </div>
    <?php endif ?>
  </div>
  <?php endif ?>
</section>