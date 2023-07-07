<?php if ($offices) : ?>
    <div class="office-locations <?= $wrapper_class ?? '' ?>">
        <?php foreach ($offices as $office) : ?>
            <?php
            $mapLink = $office['map_link'] ?? '';

            $tag = 'div';
            $attr = '';

            if (!empty($mapLink)) {
                $tag = 'a';
                $attr = "href=\"$mapLink\"  target=\"_blank\"";
            }

            echo "<$tag class=\"office-location\" $attr>";
            ?>

            <img class="footer-location-icon" src="<?php echo get_template_directory_uri(); ?>/dist/assets/icons/location.svg" alt="Location">
            <?= $office['title'] ?? '' ?>
            <?php if ($office['text']) : ?>
                <p><?= $office['text'] ?? '' ?></p>
            <?php endif ?>

            <?php echo "</$tag>"; ?>
        <?php endforeach ?>
    </div>
<?php endif ?>