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

            require_once NY_BOOKING_PLUGIN_PATH . 'shortcodes/class.ny-booking-shortcode-skabelon.php';
            $NY_Booking_Shortcode_skabelon = new NY_Booking_Shortcode_skabelon();

            require_once NY_BOOKING_PLUGIN_PATH . 'functions/NY_Booking_Form_Handler.php';
            $NY_Booking_Form_Handler = new NY_Booking_Form_Handler();

        }
        


        public function define_constants(){
            define('NY_BOOKING_PLUGIN_URL', plugin_dir_url(__FILE__));
            define('NY_BOOKING_PLUGIN_PATH', plugin_dir_path(__FILE__));
            define('NY_BOOKING_PLUGIN_VERSION', '1.0.0');
        }


        public static function activate(){
            update_option('rewrite_rules', '');

            global $wpdb;
            if( $wpdb->get_row("SELECT post_name FROM {$wpdb->prefix}posts WHERE post_name = 'vis-booking'") === null ){
                $current_user = wp_get_current_user();
                $page = [
                    'post_title' => __('Vis Booking','ny-booking'),
                    'post_name' => 'vis-booking',
                    'post_status' => 'publish',
                    'post_type' => 'page',
                    'post_author' => $current_user->ID,
                    'post_content' => '<!-- wp:shortcode -->[ny-booking]<!-- /wp:shortcode -->'
                ];
                wp_insert_post($page);
            }
    
            if( $wpdb->get_row("SELECT post_name FROM {$wpdb->prefix}posts WHERE post_name = 'book-her'") === null ){
                $current_user = wp_get_current_user();
                $page = [
                    'post_title' => __('Book Her','ny-booking'),
                    'post_name' => 'book-her',
                    'post_status' => 'publish',
                    'post_type' => 'page',
                    'post_author' => $current_user->ID,
                    'post_content' => '<!-- wp:shortcode -->[ny-booking-skabelon]<!-- /wp:shortcode -->'
                ];
                wp_insert_post($page);
            }
            if( $wpdb->get_row("SELECT post_name FROM {$wpdb->prefix}posts WHERE post_name = 'tak-for-din-bestilling'") === null ){
                $current_user = wp_get_current_user();
                $page = [
                    'post_title' => __('Tak For Din Bestilling','ny-booking'),
                    'post_name' => 'tak-for-din-bestilling',
                    'post_status' => 'publish',
                    'post_type' => 'page',
                    'post_author' => $current_user->ID,
                    'post_content' => 'Mange tak'
                ];
                wp_insert_post($page);
            }
        }

        public static function deactivate(){
            flush_rewrite_rules();
            unregister_post_type('ny-booking');
        }
        public static function uninstall(){
            global $wpdb;

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
            $wpdb->query(
                "DELETE FROM $wpdb->posts
                WHERE post_type = 'page' 
                AND post_name IN('vis-booking', 'book-her')"
            );
        }
    }
 }

 if(class_exists('NY_Booking')){
    register_activation_hook(__FILE__, ['NY_Booking', 'activate']);
    register_deactivation_hook(__FILE__, ['NY_Booking', 'deactivate']);
    register_uninstall_hook(__FILE__, ['NY_Booking', 'uninstall']);

     $ny_booking = new NY_Booking();
 }
