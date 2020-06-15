<?php

namespace includes;

/**
 * Fired during plugin activation
 *
 * @link       mrinalbd.com
 * @since      1.0.0
 *
 * @package    Wp_Admin_Vue
 * @subpackage Wp_Admin_Vue/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wp_Admin_Vue
 * @subpackage Wp_Admin_Vue/includes
 * @author     Mrinal Haque <mrinalhaque99@gmail.com>
 */
class Wp_Admin_Vue_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $itbz_table_name = $wpdb->prefix . 'itbz';

        $itbz_table_create = "CREATE TABLE $itbz_table_name (
      		`id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
      		`product` int(255),
      		`customer` int(255),
      		`url` varchar(255),
      		PRIMARY KEY  (id)
    	) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        maybe_create_table($itbz_table_name, $itbz_table_create);
	}

}
