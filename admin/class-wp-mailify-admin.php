<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/princegup42
 * @since      1.0.0
 *
 * @package    Wp_Mailify
 * @subpackage Wp_Mailify/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Mailify
 * @subpackage Wp_Mailify/admin
 * @author     Sumit Kumar <guptasum521@gmail.com>
 */
class Wp_Mailify_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
	private $wp_mailify_options;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Mailify_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Mailify_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-mailify-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Add the WP Mailify options page.
	 *
	 * @return void
	 */
	public function wp_mailify_add_options_page() {
		add_options_page(
			__('WP Mailify Settings', 'wp-mailify'),      // Page title
			__('WP Mailify', 'wp-mailify'),               // Menu title
			'manage_options',                            // Capability required to access the page
			$this->plugin_name,                        // Menu slug
			array($this, 'wp_mailify_display_plugin_setup_page')                // Callback function to display the page content
		);
	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function wp_mailify_display_plugin_setup_page() {
		include_once( 'partials/wp-mailify-admin-display.php' );
	}

	public function wp_mailify_page_init() {
		register_setting(
			'wp_mailify_option_group', // option_group
			'wp_mailify_option_name', // option_name
			array( $this, 'wp_mailify_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'wp_mailify_setting_section', // id
			'Settings', // title
			array( $this, 'wp_mailify_section_info' ), // callback
			'wp-mailify-admin' // page
		);

		add_settings_field(
			'from_email_address', // id
			'From Email Address', // title
			array( $this, 'from_email_address_callback' ), // callback
			'wp-mailify-admin', // page
			'wp_mailify_setting_section' // section
		);

		add_settings_field(
			'from_name', // id
			'From Name', // title
			array( $this, 'from_name_callback' ), // callback
			'wp-mailify-admin', // page
			'wp_mailify_setting_section' // section
		);

		add_settings_field(
			'smtp_host', // id
			'SMTP Host', // title
			array( $this, 'smtp_host_callback' ), // callback
			'wp-mailify-admin', // page
			'wp_mailify_setting_section' // section
		);

		add_settings_field(
			'smtp_port', // id
			'SMTP Port', // title
			array( $this, 'smtp_port_callback' ), // callback
			'wp-mailify-admin', // page
			'wp_mailify_setting_section' // section
		);

		add_settings_field(
			'smtp_username', // id
			'SMTP Username', // title
			array( $this, 'smtp_username_callback' ), // callback
			'wp-mailify-admin', // page
			'wp_mailify_setting_section' // section
		);

		add_settings_field(
			'smtp_password', // id
			'SMTP Password', // title
			array( $this, 'smtp_password_callback' ), // callback
			'wp-mailify-admin', // page
			'wp_mailify_setting_section' // section
		);
	}

	public function wp_mailify_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['from_email_address'] ) ) {
			$sanitary_values['from_email_address'] = sanitize_text_field( $input['from_email_address'] );
		}

		if ( isset( $input['from_name'] ) ) {
			$sanitary_values['from_name'] = sanitize_text_field( $input['from_name'] );
		}

		if ( isset( $input['smtp_host'] ) ) {
			$sanitary_values['smtp_host'] = sanitize_text_field( $input['smtp_host'] );
		}

		if ( isset( $input['smtp_port'] ) ) {
			$sanitary_values['smtp_port'] = sanitize_text_field( $input['smtp_port'] );
		}

		if ( isset( $input['smtp_username'] ) ) {
			$sanitary_values['smtp_username'] = sanitize_text_field( $input['smtp_username'] );
		}

		if ( isset( $input['smtp_password'] ) ) {
			$sanitary_values['smtp_password'] = sanitize_text_field( $input['smtp_password'] );
		}

		return $sanitary_values;
	}

	public function wp_mailify_section_info() {
		echo '<p>' . esc_html__('Simplify your email sending process and enhance deliverability using WP Mailify\'s user-friendly interface', 'wp-mailify') . '</p>';
	}

	public function from_email_address_callback() {
		printf(
			'<input class="regular-text" type="text" name="wp_mailify_option_name[from_email_address]" id="from_email_address" value="%s">',
			isset( $this->wp_mailify_options['from_email_address'] ) ? esc_attr( $this->wp_mailify_options['from_email_address']) : ''
		);
	}

	public function from_name_callback() {
		printf(
			'<input class="regular-text" type="text" name="wp_mailify_option_name[from_name]" id="from_name" value="%s">',
			isset( $this->wp_mailify_options['from_name'] ) ? esc_attr( $this->wp_mailify_options['from_name']) : ''
		);
	}

	public function smtp_host_callback() {
		printf(
			'<input class="regular-text" type="text" name="wp_mailify_option_name[smtp_host]" id="smtp_host" value="%s">',
			isset( $this->wp_mailify_options['smtp_host'] ) ? esc_attr( $this->wp_mailify_options['smtp_host']) : ''
		);
	}

	public function smtp_port_callback() {
		printf(
			'<input class="regular-text" type="text" name="wp_mailify_option_name[smtp_port]" id="smtp_port" value="%s">',
			isset( $this->wp_mailify_options['smtp_port'] ) ? esc_attr( $this->wp_mailify_options['smtp_port']) : ''
		);
	}

	public function smtp_username_callback() {
		printf(
			'<input class="regular-text" type="text" name="wp_mailify_option_name[smtp_username]" id="smtp_username" value="%s">',
			isset( $this->wp_mailify_options['smtp_username'] ) ? esc_attr( $this->wp_mailify_options['smtp_username']) : ''
		);
	}

	public function smtp_password_callback() {
		printf(
			'<input class="regular-text" type="password" name="wp_mailify_option_name[smtp_password]" id="smtp_password" value="%s">',
			isset( $this->wp_mailify_options['smtp_password'] ) ? esc_attr( $this->wp_mailify_options['smtp_password']) : ''
		);
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Mailify_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Mailify_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-mailify-admin.js', array( 'jquery' ), $this->version, false );

	}

}
