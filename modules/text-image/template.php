<section id="<?=$anchor_id ?? ''?>" class="section section-text-image section--padding section--fullWidth bg--dark-teal <?=($is_text_first) ? 'is-text-first' : ''?>">
  <?php if(!$hide_arrow) : ?>
    <div class="text-image-icon">
      <img src=" <?php echo get_template_directory_uri(); ?>/dist/assets/icons/arrow-down.svg" alt="Icon">
    </div>
  <?php endif ?>
  <div class="row">
    <?php if (isset($image) and !empty($image)) : ?>
      <div class="col-12 col-lg-6 text-image-img-column">
        <figure class="ratio--1-1">
          <img class="text-image-img" src="<?=wp_get_attachment_image_url($image, 'fifty_image_large')?>" alt="Image">
        </figure>
      </div>
    <?php endif ?>
    <div class="col-12 col-lg-6 text-image-content-column">
      <div class="text-image-content">

        <?php if(isset($title) and !empty($title)) :?>
          <div class="h3 text-image-title"><?=$title?></div>
        <?php endif ?>

        <?php if(isset($text) and !empty($text)) : ?>
          <p class="text-image-txt"><?=$text?></p>
        <?php endif ?>

        <?php if(isset($link) and !empty($link)) : ?>
          <?php $additionalSettings =  !empty($link['target']) ? 'rel="nofollow noreferrer"' : ''; ?>
          <div> <a href="<?=$link['url']?>" class="button button--quarternary" target="<?=$link['target']?>" <?=$additionalSettings?> ><?=$link['title']?></a></div>
        <?php endif ?>

      </div>
    </div>
  </div>
</section>