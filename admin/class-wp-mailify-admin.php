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
