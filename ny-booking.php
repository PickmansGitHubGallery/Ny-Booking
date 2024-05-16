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
            unregister_post_type('ny-booking');
        }
        public static function uninstall(){
            $posts = get_posts(
                [
                    'post_type' => 'ny-booking',
                    'number_posts' => -1,
                    'post_status' => 'any'
                ]
            );

            foreach($posts as $post){
                wp_delete_post($post->ID, true);
            }
        }
    }
 }

 if(class_exists('NY_Booking')){
    register_activation_hook(__FILE__, ['NY_Booking', 'activate']);
    register_deactivation_hook(__FILE__, ['NY_Booking', 'deactivate']);
    register_uninstall_hook(__FILE__, ['NY_Booking', 'uninstall']);

     $ny_booking = new NY_Booking();
 }
