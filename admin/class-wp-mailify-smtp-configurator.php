<?php
/**
 * Class for WP Mailify SMTP Configurator.
 *
 * This class sets up custom email settings for WordPress using the WP Mailify plugin.
 *
 * @package Wp_Mailify
 */

class WP_Mailify_SMTP_Configurator {
    /**
     * Singleton instance.
     *
     * @var WP_Mailify_SMTP_Configurator
     */
    private static $instance = null;

    /**
     * Options for WP Mailify.
     *
     * @var array
     */
    private $wp_mailify_options;

    /**
     * Get the singleton instance of WP_Mailify_SMTP_Configurator.
     *
     * @return WP_Mailify_SMTP_Configurator
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Private constructor to prevent external instantiation.
     */
    private function __construct() {
        $this->wp_mailify_options = get_option('wp_mailify_option_name');
        // Change the content type of the email to HTML
        add_filter('wp_mail_content_type', array($this, 'wp_mailify_set_email_content_type'));

        // Specify the email address for the FROM header
        add_filter('wp_mail_from', array($this, 'wp_mailify_set_email_from_address'));

        // Specify the email name for the FROM header
        add_filter('wp_mail_from_name', array($this, 'wp_mailify_set_email_from_name'));

        // Configure PHPMailer settings for SMTP
        add_action('phpmailer_init', array($this, 'wp_mailify_configure_phpmailer'));

        // Handle mailer errors and log them
        add_action('wp_mail_failed', array($this, 'wp_mailify_log_mailer_errors'));
    }

    /**
     * Set the email content type to HTML.
     *
     * @param string $content_type The default content type.
     * @return string Modified content type.
     */
    public function wp_mailify_set_email_content_type($content_type) {
        return 'text/html';
    }

    /**
     * Set the email address for the FROM header.
     *
     * @param string $email_address The default email address.
     * @return string Modified email address.
     */
    public function wp_mailify_set_email_from_address($email_address) {
        return $this->wp_mailify_options['from_email_address']; // Will get the header: WordPress <youremail@gmail.com>
    }

    /**
     * Set the email name for the FROM header.
     *
     * @param string $email_from The default email name.
     * @return string Modified email name.
     */
    public function wp_mailify_set_email_from_name($email_from) {
        return $this->wp_mailify_options['from_name']; // Will get the header: WordPress <wordpress@yoursite.com>
    }

    /**
     * Configure PHPMailer settings for SMTP.
     *
     * @param PHPMailer $phpmailer The PHPMailer instance.
     */
    public function wp_mailify_configure_phpmailer($phpmailer) {
        $phpmailer->isSMTP();
        $phpmailer->Host = $this->wp_mailify_options['smtp_host'];
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 465;
        $phpmailer->Username = $this->wp_mailify_options['smtp_username'];
        $phpmailer->Password = $this->wp_mailify_options['smtp_password'];

        // Additional settings
        $phpmailer->SMTPSecure = 'ssl';
        $phpmailer->From = $this->wp_mailify_options['from_email_address'];
        $phpmailer->FromName = $this->wp_mailify_options['from_name'];
    }

    /**
     * Log mailer errors.
     *
     * @param WP_Error $wp_error The WP_Error object representing the error.
     */
    public function wp_mailify_log_mailer_errors($wp_error) {
        // Output the error to the error log (/wp-content/debug.log file).
        error_log($wp_error->get_error_message());
    }
}