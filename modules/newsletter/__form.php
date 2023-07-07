<?php if ($newsletter_data['title']) : ?>
    <div class="newsletter-title h3">
        <?= $newsletter_data['title'] ?>
    </div>
<?php endif ?>

<form action="" class="newsletter-form js-newsletter-form">
    <div class="form-control">
        <input type="text" class="js-name" name="name" placeholder="Your name" data-message = '<?= $newsletter_data['error_name'] ?? 'Error needs to be corrected' ?>'>
        <span class="form-control-feedback error-feedback "></span>
    </div>
    <div class="form-control">
        <input type="text" class="js-email" name='email' placeholder="Your email" data-message="<?= $newsletter_data['error_email'] ?? 'Error needs to be corrected' ?>"> <!-- add is-error -->
        <span class="form-control-feedback error-feedback"></span>
    </div>
    <div class="form-control form-control--checkbox">
        <input type="checkbox" class="js-terms" name="privacyPolicy" id="privacyPolicy" data-message="<?= $newsletter_data['error_terms'] ?? 'Error needs to be corrected' ?>" >
        <label for="privacyPolicy"><?= $newsletter_data['accept_terms'] ?? 'I agree to the Privacy Policy, read more here.' ?></label>
        <span class="form-control-feedback error-feedback"></span>
    </div>
    <button type="button" class="button button--primary js-submit-button"><?= $newsletter_data['btn_title'] ?? 'SIGN ME UP' ?></button>
</form>
