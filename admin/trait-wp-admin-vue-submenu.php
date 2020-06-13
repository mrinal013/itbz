<?php
namespace admin;

trait WP_Admin_Vue_Submenu {

    public function wp_admin_submenu() {
        global $submenu;

        $capability = 'manage_options';

        $submenu[ PAGE_SLUG ][] = array( __( 'Link', TEXTDOMAIN ), $capability, 'admin.php?page=' . PAGE_SLUG . '#/' );
        $submenu[ PAGE_SLUG ][] = array( __( 'Videos', TEXTDOMAIN ), $capability, 'admin.php?page=' . PAGE_SLUG . '#/videos' );
        $submenu[ PAGE_SLUG ][] = array( __( 'WC setup', TEXTDOMAIN ), $capability, 'admin.php?page=' . PAGE_SLUG . '#/wc-setup' );
    }

}