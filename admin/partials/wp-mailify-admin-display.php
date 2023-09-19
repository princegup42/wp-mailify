<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/princegup42
 * @since      1.0.0
 *
 * @package    Wp_Mailify
 * @subpackage Wp_Mailify/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php $this->wp_mailify_options = get_option( 'wp_mailify_option_name' ); ?>

<div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    
    <form method="post" action="options.php">
        <?php
        settings_fields( 'wp_mailify_option_group' );
        do_settings_sections( 'wp-mailify-admin' );
        submit_button();
        ?>
    </form>
</div>