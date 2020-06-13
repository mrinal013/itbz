<?php

namespace wp_public;

use wp_public\WP_Admin_Vue_Video;

/**
 * The public-facing functionality of the plugin.
 *
 * @link       mrinalbd.com
 * @since      1.0.0
 *
 * @package    Wp_Admin_Vue
 * @subpackage Wp_Admin_Vue/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wp_Admin_Vue
 * @subpackage Wp_Admin_Vue/public
 * @author     Mrinal Haque <mrinalhaque99@gmail.com>
 */
class Wp_Admin_Vue_Public {

	use WP_Admin_Vue_Video;

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action( 'init', [ $this, 'add_video_forum_endpoint'] );
		add_action( 'woocommerce_account_video-forum_endpoint', [ $this, 'video_forum_content' ] );

		add_filter( 'query_vars', [ $this, 'video_forum_query_vars' ], 0 );
		add_filter( 'woocommerce_account_menu_items', [ $this, 'add_video_forum_link_my_account' ] );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Admin_Vue_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Admin_Vue_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/css/wp-admin-vue.build.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Admin_Vue_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Admin_Vue_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/js/wp-admin-vue.build.js', array( ), $this->version, false );

	}

}