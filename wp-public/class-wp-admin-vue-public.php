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
	 * Is special page
	 */
	private $current_url;

	/**
	 * This user id
	 */
	private $customer_id;

	/**
	 * This user email
	 */
	private $customer_email;

	/**
	* Videos
	*/
	private $videos;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		global $wpdb;
		$results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}itbz" );
		$this->videos = $results;
		
		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action( 'init', [ $this, 'get_customer_email_id' ] );
		add_action( 'init', [ $this, 'add_video_forum_endpoint' ] );
		add_action( 'init', [ $this, 'customer_bought_special_product' ], 99 );

		$this->is_special_page();
	}

	public function is_special_page() {
		// $special_page = get_permalink( get_option('woocommerce_myaccount_page_id') ) . str_replace( ' ', '-', get_option( 'itbz-slug' ) ) . '/';
		$protocol = ( ( ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443 ) ? "https://" : "http://";  
		$this->current_url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		// $this->is_special_page = ( $special_page === $current_url ) ? true : false;
	}

	public function itbz_upload_function() {
		$nonce = $_POST['nonce'];

    	if ( ! wp_verify_nonce( $nonce, 'itbz' ) ) {
			wp_die ( 'Unauthrized access!');
		}

		if( ! empty( $_POST['url'] ) ) {
			global $wpdb;
			$table = $wpdb->prefix.'itbz';
			$data = array(
				'product' => $_POST['product'], 
				'customer' => $_POST['customer'], 
				'url' => $_POST['url'],
			);
			$format = array( '%d', '%s', '%s' );
			$wpdb->insert( $table, $data, $format );
		}
		wp_die();
	}

	public function get_customer_email_id() {
		global $product;
		$current_user = wp_get_current_user();
		$this->customer_email = $current_user->user_email;
		$this->customer_id = $current_user->ID;
	}

	public function customer_bought_special_product() {
		$special_product = intval( get_option( 'itbz-product' ) );
		$special_customer = wc_customer_bought_product( $this->customer_email, $this->customer_id, $special_product );
		if( $special_customer ) {
			$endpoint_name = 'woocommerce_account_' . str_replace( ' ', '-', get_option( 'itbz-slug' ) ) . '_endpoint';
			add_action( $endpoint_name, [ $this, 'video_forum_content' ] );
			add_action( 'wp_ajax_itbz_upload', [ $this, 'itbz_upload_function' ] );

			add_filter( 'query_vars', [ $this, 'video_forum_query_vars' ], 0 );
			add_filter( 'woocommerce_account_menu_items', [ $this, 'add_video_forum_link_my_account' ] );

			flush_rewrite_rules();
		}
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Admin_Vue_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Admin_Vue_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$special_page = get_permalink( get_option('woocommerce_myaccount_page_id') ) . str_replace( ' ', '-', get_option( 'itbz-slug' ) ) . '/';
		$is_special_page = ( $special_page === $this->current_url ) ? true : false;

		if( $is_special_page ) {
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/css/wp-admin-vue.build.css', array(), $this->version, 'all' );
		}

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Admin_Vue_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Admin_Vue_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$special_page = get_permalink( get_option('woocommerce_myaccount_page_id') ) . str_replace( ' ', '-', get_option( 'itbz-slug' ) ) . '/';
		$is_special_page = ( $special_page === $this->current_url ) ? true : false;
		
		if( $is_special_page ) {
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/js/wp-admin-vue.build.js', array( ), $this->version, true );
			wp_localize_script( $this->plugin_name, 'object', [
				'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
				'nonce'				=> wp_create_nonce( 'itbz' ),
				'specialproduct' 	=> get_option( 'itbz-product' ),
				'customer'		 	=> $this->customer_id,
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

}