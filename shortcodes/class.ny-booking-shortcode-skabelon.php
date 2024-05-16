<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

if(!class_exists('NY_Booking_Shortcode_skabelon')){
  class NY_Booking_Shortcode_skabelon{
      public function __construct(){
          add_shortcode('ny-booking-skabelon', [$this, 'ny_booking_shortcode_skabelon']);
      }
    public function ny_booking_shortcode_skabelon($atts = [], $content = null, $tag = ''){
      $atts = array_change_key_case((array)$atts, CASE_LOWER);
      ob_start();
      require_once NY_BOOKING_PLUGIN_PATH . 'views/ny-booking_skabelon.php';
      return ob_get_clean();
    }
  }
}