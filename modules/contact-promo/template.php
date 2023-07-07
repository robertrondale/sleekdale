
<section id="<?=$anchor_id ?? ''?>" class="section section--padding section--fullWidth section-contact-promo <?= $bg_color ?? '' ?>">
    <div class="section-header section-header--center">
      <?php if (isset($title) and !empty($title)) : ?>
        <div class="section-header-title h2"><?=$title?></div>
      <?php endif ?>
        
        <div class="section-header-preamble h5"><?=$preamble ?? ''?></div>
    </div>

  <div class="section-contact-promo-body section-body">
      <div class="contact-promo">
        <div class="contact-promo-icon">
          <svg class="laptop-only svg--inherit-color" width="305" height="276" viewBox="0 0 305 276" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g clip-path="url(#clip0_1636_278)">
              <path class="path-stroke" d="M278.468 164.599H116.662C50.5104 164.599 18.1836 131.802 18.1836 66.9768V0.953125" stroke="#E1EFEB" stroke-width="36" stroke-miterlimit="10"/>
              <path class="path-stroke" d="M180.461 69.4174L278.469 164.599L180.461 262.607" stroke="#E1EFEB" stroke-width="36" stroke-miterlimit="10"/>
          </g>
          <defs>
              <clipPath id="clip0_1636_278">
              <rect width="305" height="276" fill="white"/>
              </clipPath>
          </defs>
          </svg>
          <svg class="touch-device-only svg--inherit-color" width="215" height="205" viewBox="0 0 215 205" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path class="path-stroke" d="M106.408 185.239L106.408 78.7887C106.408 35.2676 127.986 14 170.634 14L214.07 14" stroke="#E1EFEB" stroke-width="27" stroke-miterlimit="10"/>
          <path class="path-stroke" d="M169.027 120.76L106.408 185.239L41.9287 120.76" stroke="#E1EFEB" stroke-width="27" stroke-miterlimit="10"/>
          </svg>
        </div>
        <?php if(isset($employee_details) and !empty($employee_details)) : ?>
          <div class="contact-promo-detail">
              <?php if(isset($employee_details['image']) and !empty($employee_details['image'])) : ?>
                <div class="contact-promo-detail-image">
                    <?=$employee_details['image']?>
                </div>
              <?php endif ?>
              <div class="contact-promo-detail-text">
                <?php if(isset($employee_details['email']) and !empty($employee_details['email'])) : ?>
                  <a href="mailto:<?=$employee_details['email']?>" class="contact-promo-detail-text-email link--inherit-color h3"><?=$employee_details['email']?></a>
                <?php endif ?>
                <?php if(isset($employee_details['phone']) and !empty($employee_details['phone'])) : ?>
                  <a href="tel:<?=$employee_details['phone']?>" class="contact-promo-detail-text-telno link--inherit-color h3"><?=$employee_details['phone']?></a>
                <?php endif ?>
              </div>
          </div>
        <?php endif ?>
      </div>
  </div>
</section>