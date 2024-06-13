<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

if(!class_exists('Booking_Shortcode')){
  class Booking_Shortcode{
      public function __construct(){
          add_shortcode('ny-booking', [$this, 'ny_booking_shortcode']);
      }

      public function ny_booking_shortcode($atts = [], $content = null, $tag = ''){
          $atts = array_change_key_case((array)$atts, CASE_LOWER);

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
              require_once NY_BOOKING_PLUGIN_PATH . 'views/ny-booking_vis_booking_view.php';
          } else {
              echo '<p>No booking details available.</p>';
          }
      }
  }
}


