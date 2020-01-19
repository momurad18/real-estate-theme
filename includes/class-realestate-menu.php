<?php

/*
 * Real_Estate_Menu class
 *
 * Theme includes Mega Main Menu and should be activated right after installation.
 * This class setup configuration for this plugin and register menu location.
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

if ( ! class_exists( 'My_Home_Menu' ) ) :

	class Real_Estate_Menu {
		public function __construct(){
			// register menu
			add_action( 'after_setup_theme', array( $this, 'register_menu' ) );
		}

		/*
		 * register_menu
		 *
		 * Register menu location
		 */
		public function register_menu() {
			register_nav_menus(
				array(
					'primary-menu' => 'Primary Menu', 
					'footer-menu' => 'Footer Menu', 
					'mobil-menu' => 'Mobile Menu', 
				)
			);
		}
	}

endif;