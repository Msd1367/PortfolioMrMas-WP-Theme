<h1>portfolioMrMas Theme Options</h1>
<?php settings_errors(); ?>
<form method="post" action="options.php" class="portfolioMrMas-general-form">
    <?php
    settings_fields('portfolioMrMas-theme-support');
    do_settings_sections('portfolioMrMas_options_theme');
    submit_button();
    ?>
</form>