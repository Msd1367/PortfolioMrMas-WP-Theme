<h1>portfolioMrMas Sidebar Options</h1>
<?php
settings_errors();

$fullName = esc_attr(get_option('first_name')) . ' ' . esc_attr(get_option('last_name'));
$description = esc_attr(get_option('user_description'));
$email = esc_attr(get_option('email'));
$profile_pic = esc_attr(get_option('profile_picture'));

$instagram = esc_attr(get_option('instagram'));
$telegram = esc_attr(get_option('telegram'));
$linkedIn = esc_attr(get_option('linkedIn'));
$gitHub = esc_attr(get_option('gitHub'));
?>
<div class="portfolioMrMas-sidebar-preview">
    <div class="portfolioMrMas-sidebar">
        <div class="image-container">
            <div class="profile-picture">
                <img id="profile-picture-preview" src="<?= $profile_pic ?>" alt="<?= $fullName ?> profile picture" />

            </div>
        </div>
        <h1 class="portfolioMrMas-username"><?= $fullName ?></h1>
        <h2 class="portfolioMrMas-description"><?= $description ?></h2>
        <div class="portfolioMrMas-social-media-icons">
            <?php if (!empty($instagram)): ?>
                <a href="<?php echo $instagram ?>" target="_blank" aria-label="Instagram">
                    <span class="fab fa-instagram"></span>
                </a>
            <?php endif;
            if (!empty($telegram)): ?>
                <a href="<?php echo $telegram ?>" target="_blank" aria-label="Telegram">
                    <span class="fab fa-telegram"></span>
                </a>
            <?php endif;
            if (!empty($linkedIn)): ?>
                <a href="<?php echo $linkedIn ?>" target="_blank" aria-label="LinkedIn">
                    <span class="fab fa-linkedin"></span>
                </a>
            <?php endif;
            if (!empty($gitHub)): ?>
                <a href="<?php echo $gitHub ?>" target="_blank" aria-label="GitHub">
                    <span class="fab fa-github"></span>
                </a>
            <?php endif; ?>

        </div>
        <?php if (!empty($email)): ?>
            <h3 class="portfolioMrMas-email"><a href="mailto: <?= $email ?>" aria-label="Email"><?= $email ?></a></h3>
        <?php endif; ?>
    </div>

</div>

<form method="post" action="options.php" class="portfolioMrMas-general-form">
    <?php

    settings_fields('portfolioMrMas-settings-group');
    do_settings_sections('portfolioMrMas_options');
    submit_button('Save Changes', 'primary', 'btnSubmit');

    ?>

</form>