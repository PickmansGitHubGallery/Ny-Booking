<?php
/**
 * Plugin Name: NY Booking
 * Description: A simple booking plugin
 */


 if(!defined('ABSPATH')){
     exit;
 }

 if (! class_exists('NY_Booking')){
    class NY_Booking{
        function __construct(){
            $this->define_constants();

            require_once NY_BOOKING_PLUGIN_PATH . 'post-types/class.ny-booking-cpt.php';
            $NY_Booking_Post_Type = new NY_Booking_Post_Type();

            require_once NY_BOOKING_PLUGIN_PATH . 'shortcodes/class.ny-booking-shortcode.php';
            $NY_Booking_Shortcode = new NY_Booking_Shortcode();
        }
        public function define_constants(){
            define('NY_BOOKING_PLUGIN_URL', plugin_dir_url(__FILE__));
            define('NY_BOOKING_PLUGIN_PATH', plugin_dir_path(__FILE__));
            define('NY_BOOKING_PLUGIN_VERSION', '1.0.0');
        }

        public static function activate(){
            update_option('rewrite_rules', '');
        }

        public static function deactivate(){
            flush_rewrite_rules();
        }
        public static function uninstall(){
            delete_option('rewrite_rules');
        }
    }
 }

 if(class_exists('NY_Booking')){
     $ny_booking = new NY_Booking();
 }
