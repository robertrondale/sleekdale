<section id="<?=$anchor_id ?? ''?>" class="section section-hero-banner">
    <div class="hero-wrap js-video">
        <div class="hero-background">
            <?= $images['desktop'] ?? '' ?>
            <?= $images['mobile'] ?? '' ?>
            <?php if ($video_tag ?? '') : ?>
                <div class="hero-play-btn js-hide-on-play js-playvideo">
                    <button id="js-playvideo">
                        <img class="js-play" src="<?php echo get_template_directory_uri(); ?>/dist/assets/icons/play.svg" alt="Play">
                    </button>
                </div>
            <?php endif ?>
        </div>

        <?= $video_tag ?? '' ?>

        <?php if ($has_content ?? false) : ?>
            <div class="hero-text <?= $text_color ?? 'text--light-green' ?>">
                <div class="hero-inner">
                    <?php if ($title) : ?>
                        <div class="h1 hero-title"><?= $title ?></div>
                    <?php endif ?>
                    <?php if ($preamble) : ?>
                        <div class="hero-subtitle preamble"><?= $preamble ?></div>
                    <?php endif ?>
                    <?php if ($link) : ?>
                        <div class="hero-btn">
                            <a href="<?= $link['url'] ?>" target="<?= $link['target'] ?>">
                                <button class="button <?= $cta_color ?? 'button--quarternary' ?>" type="button"><?= $link['title'] ?></button>
                            </a>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        <?php endif ?>
    </div>
</section>