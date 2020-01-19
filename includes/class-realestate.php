<?php

/*
 * Realestate Main class
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

if ( ! class_exists( 'Real_Estate' ) ) :

    class Real_Estate {

        public static $instance = false;

    	/**
    	 * @var Real_Estate Elements
    	 */
    	public $menu;
    	public $init;
    	public $version = '1.0.0';

        private function __construct(){}

        /*
         * init
         *
         * Initiate all necessary modules
         */
        public function init() {
    	    $this->load_dependencies();

    	    
    	    // prepare menu

    	    $this->menu         = new Real_Estate_Menu();
    	    // setup theme
            $this->init         = new Real_Estate_Init();

    	}
        private function load_dependencies() {
            require_once get_template_directory() . '/includes/class-realestate-init.php';
            require_once get_template_directory() . '/includes/class-realestate-menu.php';
        }

        /*
         * get_instance
         *
         * Get Real_Estate instance or create if doesn't exists
         */
        public static function get_instance() {
            if ( ! self::$instance ) {
                self::$instance = new Real_Estate();
            }
            return self::$instance;
        }
    }
endif;