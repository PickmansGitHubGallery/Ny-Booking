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

            require_once NY_BOOKING_PLUGIN_PATH . 'shortcodes/ny-booking_shortcode_vis_bookinger.php';
            $NY_Booking_Shortcode = new Booking_Shortcode();

            require_once NY_BOOKING_PLUGIN_PATH . 'shortcodes/ny-booking_shortcode_booking_form.php';
            $NY_Booking_Shortcode_booking_form = new shortcode_booking_form();

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
                    'post_content' => '<!-- wp:shortcode -->[ny-booking-form]<!-- /wp:shortcode -->'
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

            global $wpdb;

            $wpdb->query(
                "DELETE FROM $wpdb->posts
                WHERE post_type = 'page' 
                AND post_name IN('vis-booking', 'book-her', 'tak-for-din-bestilling')"
            );

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
    function booking_menu(){
        add_menu_page(
          'Booking',
          'Booking aftaler',
          'manage_options',
          'booking-menu',
          'booking_menu_page',
          'dashicons-calendar-alt',
          4
        );
      }
      add_action('admin_menu', 'booking_menu');
      
      function booking_menu_page(){
            // Hent alle indlæg med meta_key 'ny_booking_navn'
            global $wpdb;
            $meta_key = 'ny_booking_navn';
            $results = $wpdb->get_results( $wpdb->prepare(
                "SELECT post_id, meta_value FROM $wpdb->postmeta WHERE meta_key = %s",
                $meta_key
            ), ARRAY_A);
  
            // Send dataene til visningsfilen
            if ($results) {
                // Forbereder data til visning
                $bookings = [];
                foreach ($results as $result) {
                    $post_id = $result['post_id'];
                    $navn = get_post_meta($post_id, 'ny_booking_navn', true);
                    $telefon = get_post_meta($post_id, 'ny_booking_telefon', true);
                    $behandling = get_post_meta($post_id, 'ny_booking_behandling', true);
                    $dato = get_post_meta($post_id, 'ny_booking_dato', true);
                    $tid = get_post_meta($post_id, 'ny_booking_tid', true);
                    
                    $bookings[] = [
                        'navn' => $navn,
                        'telefon' => $telefon,
                        'behandling' => $behandling,
                        'dato' => $dato,
                        'tid' => $tid
                    ];
                }
                usort($bookings, function($a, $b) {
                    $dateA = strtotime($a['dato']);
                    $dateB = strtotime($b['dato']);
                    return $dateA - $dateB;
                });
                require_once NY_BOOKING_PLUGIN_PATH . 'views/ny-booking_vis_booking_view.php';
            } else {
                echo '<p>No booking details available.</p>';
            }
        }
      }

 if(class_exists('NY_Booking')){
    register_activation_hook(__FILE__, ['NY_Booking', 'activate']);
    register_deactivation_hook(__FILE__, ['NY_Booking', 'deactivate']);
    register_uninstall_hook(__FILE__, ['NY_Booking', 'uninstall']);

     $ny_booking = new NY_Booking();
 }
