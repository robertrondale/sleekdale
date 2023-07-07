<section id="<?=$anchor_id ?? ''?>" class="section section--padding section--fullWidth section-logos <?=$bg_color?>">

  <?php if ($title or $description) : ?>
  <div class="section-header section-header--center">

    <?php if ($title) : ?>
    <div class="section-header-title h2">
      <?php echo $title ?>
    </div>
    <?php endif ?>

    <?php if ($description) : ?>
    <div class="section-header-description h5">
      <?=strip_tags($description)?>
    </div>
    <?php endif ?>
  </div>
  <?php endif ?>

  <?php if(isset($logos) and !empty($logos)) : ?>
  <div class="section-logos-body">
    <div class="logos">
      <?php foreach ($logos as $logo) : ?>
      <div class="logo">
        <?php echo wp_get_attachment_image($logo); ?>
      </div>
      <?php endforeach ?>
    </div>
  </div>
  <?php endif ?>
</section>