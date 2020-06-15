<?php

namespace admin;

use admin\WP_Admin_Vue_Menu;
use admin\WP_Admin_Vue_Submenu;

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       mrinalbd.com
 * @since      1.0.0
 *
 * @package    Wp_Admin_Vue
 * @subpackage Wp_Admin_Vue/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Admin_Vue
 * @subpackage Wp_Admin_Vue/admin
 * @author     Mrinal Haque <mrinalhaque99@gmail.com>
 */

class Wp_Admin_Vue_Admin {

	use WP_Admin_Vue_Menu, WP_Admin_Vue_Submenu;

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

	/*
	* All videos uploaded by customer
	*/
	private $videos;

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

		$this->get_all_videos();
		
		add_action( 'wp_ajax_itbz_callback', [ $this, 'itbz_callback_function' ] );
		add_action( 'wp_ajax_itbz_all_uploads', [ $this, 'itbz_all_uploads_function' ] );
	}

	public function itbz_callback_function() {

		$nonce = $_POST['nonce'];

    	if ( ! wp_verify_nonce( $nonce, 'itbz' ) ) {
			wp_die ( 'Unauthrized access!');
		}
		
		update_option( 'itbz-product', $_POST['product'] );
		update_option( 'itbz-slug', $_POST['slug'] );
		update_option( 'itbz-wckey', $_POST['wckey'] );
		update_option( 'itbz-wcsecret', $_POST['wcsecret'] );
		update_option( 'itbz-apiKey', $_POST['apiKey'] );
		update_option( 'itbz-authDomain', $_POST['authDomain'] );
		update_option( 'itbz-databaseURL', $_POST['databaseURL'] );
		update_option( 'itbz-projectId', $_POST['projectId'] );
		update_option( 'itbz-storageBucket', $_POST['storageBucket'] );
		update_option( 'itbz-messagingSenderId', $_POST['messagingSenderId'] );
		update_option( 'itbz-appId', $_POST['appId'] );
		update_option( 'itbz-measurementId', $_POST['measurementId'] );

		wp_die();
	}

	public function get_all_videos() {
		global $wpdb;
		$results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}itbz" );
		$this->videos = $results;
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
	 * Register the JavaScript for the admin area.
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
		
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/js/wp-admin-vue.build.js', array(  ), $this->version, false );

		wp_localize_script( $this->plugin_name, 'object', [
			'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
			'nonce'				=> wp_create_nonce( 'itbz' ),
			'specialvideos'		=> $this->videos,
			'siteurl'			=> get_option( 'siteurl' ),
			'wckey' 			=> get_option( 'itbz-wckey' ),
			'wcsecret' 			=> get_option( 'itbz-wcsecret' ),
			'specialproduct' 	=> get_option( 'itbz-product' ),
			'specialurl' 		=> get_option( 'itbz-slug' ),
			'apiKey' 			=> get_option( 'itbz-apiKey' ),
			'authDomain' 		=> get_option( 'itbz-authDomain' ),
			'databaseURL' 		=> get_option( 'itbz-databaseURL' ),
			'projectId' 		=> get_option( 'itbz-projectId' ),
			'storageBucket' 	=> get_option( 'itbz-storageBucket' ),
			'messagingSenderId' => get_option( 'itbz-messagingSenderId' ),
			'appId' 			=> get_option( 'itbz-appId' ),
			'measurementId' 	=> get_option( 'itbz-measurementId' ),
		] );

	}

}
