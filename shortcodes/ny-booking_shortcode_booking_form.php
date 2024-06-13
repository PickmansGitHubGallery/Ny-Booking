<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if(!class_exists('shortcode_booking_form')){
    class shortcode_booking_form{
        public function __construct(){
            add_shortcode('ny-booking-form', [$this, 'ny_booking_shortcode_booking_form']);
        }

        public function ny_booking_shortcode_booking_form($atts = [], $content = null, $tag = ''){
            $atts = array_change_key_case((array)$atts, CASE_LOWER);
            ob_start();
            require_once NY_BOOKING_PLUGIN_PATH . 'views/ny-booking_form.php';
            return ob_get_clean();
        }
       
    }
}
