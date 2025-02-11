<h1>portfolioMrMas Contact Options</h1>
<?php settings_errors(); ?>

<p>Use this <strong>Shortcode</strong> to activate the Contact Form inside a Page of a Post</p>
<code>[contact_form]</code>

<form method="post" action="options.php" class="portfolioMrMas-general-form">
    <?php
    settings_fields('portfolioMrMas-contact-options');
    do_settings_sections('portfolioMrMas_options_contact');
    submit_button();
    ?>
</form>