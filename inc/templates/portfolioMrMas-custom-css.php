<h1>portfolioMrMas Custom CSS</h1>
<?php settings_errors(); ?>
<form id="save-custom-css-form" method="post" action="options.php" class="portfolioMrMas-general-form">
    <?php
    settings_fields('portfolioMrMas-custom-css-options');
    do_settings_sections('portfolioMrMas_options_css');
    submit_button();
    ?>
</form>