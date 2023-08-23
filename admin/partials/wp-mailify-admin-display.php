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
<div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <form method="post" action="options.php">
        <?php settings_fields($this->plugin_name); ?>
        <?php do_settings_sections($this->plugin_name); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><?php esc_html_e('From Email Address', 'wp-mailify'); ?></th>
                <td><input type="text" name="<?php echo $this->plugin_name; ?>_custom_email_from_address" value="<?php echo esc_attr(get_option('<?php echo $this->plugin_name; ?>_custom_email_from_address')); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php esc_html_e('From Name', 'wp-mailify'); ?></th>
                <td><input type="text" name="<?php echo $this->plugin_name; ?>_custom_email_from_name" value="<?php echo esc_attr(get_option('<?php echo $this->plugin_name; ?>_custom_email_from_name')); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php esc_html_e('SMTP Host', 'wp-mailify'); ?></th>
                <td><input type="text" name="<?php echo $this->plugin_name; ?>_custom_smtp_host" value="<?php echo esc_attr(get_option('<?php echo $this->plugin_name; ?>_custom_smtp_host')); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php esc_html_e('SMTP Port', 'wp-mailify'); ?></th>
                <td><input type="text" name="<?php echo $this->plugin_name; ?>_custom_smtp_port" value="<?php echo esc_attr(get_option('<?php echo $this->plugin_name; ?>_custom_smtp_port')); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php esc_html_e('SMTP Username', 'wp-mailify'); ?></th>
                <td><input type="text" name="<?php echo $this->plugin_name; ?>_custom_smtp_username" value="<?php echo esc_attr(get_option('<?php echo $this->plugin_name; ?>_custom_smtp_username')); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php esc_html_e('SMTP Password', 'wp-mailify'); ?></th>
                <td><input type="password" name="<?php echo $this->plugin_name; ?>_custom_smtp_password" value="<?php echo esc_attr(get_option('<?php echo $this->plugin_name; ?>_custom_smtp_password')); ?>" /></td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
</div>
