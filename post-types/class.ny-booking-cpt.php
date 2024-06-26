<?php

if(!defined('ABSPATH')){
    exit;
}
if(!class_exists('NY_Booking_Post_Type')){
  class NY_Booking_Post_Type{
      function __construct(){
        add_action('init',[$this, 'create_post_type']);
        add_action('add_meta_boxes', [$this, 'add_meta_boxes']);
        add_action('save_post', [$this, 'save_post'], 10, 3);
      }

      public function create_post_type(){
          register_post_type(
            'ny-booking',
            [
              'label' => 'Booking',
              'description' => 'A simple booking post type',
              'labels' =>
              [
                'name' => 'Bookings',
                'singular_name' => 'Booking'
              ],
              'public' => true,
              'supports' => ['title', 'editor'],
              'show_ui' => false,
              'show_in_menu' => true,
              'menu_position' => 5,
              'show_in_admin_bar' => true,
              'show_in_nav_menus' => true,
              'can_export' => true,
              'has_archive' => false,
              'show_in_rest' => true,
              'menu_icon' => 'dashicons-calendar-alt',
            ]
            
          );

      }

      public function add_meta_boxes(){
        add_meta_box(
          'ny_booking_meta_box',
          'Booking Details',
          [$this, 'add_inner_meta_boxes'],
          'ny-booking',
          'side',
          'default'

        );
      }
      public function add_inner_meta_boxes(){
        require_once NY_BOOKING_PLUGIN_PATH . 'views/ny-booking_metabox.php';
      }

      public function save_post($post_id){
        if( isset($_POST['action']) && $_POST['action'] == 'editpost'){
            $old_name = get_post_meta($post_id, 'ny_booking_navn', true);
            $new_name = sanitize_text_field($_POST['ny_booking_navn']);
            $old_telefon = get_post_meta($post_id, 'ny_booking_telefon', true);
            $new_telefon = sanitize_text_field($_POST['ny_booking_telefon']);
            $old_behandling = get_post_meta($post_id, 'ny_booking_behandling', true);
            $new_behandling = sanitize_text_field($_POST['ny_booking_behandling']);
            $old_dato = get_post_meta($post_id, 'ny_booking_dato', true);
            $new_dato = sanitize_text_field($_POST['ny_booking_dato']);
            $old_tid = get_post_meta($post_id, 'ny_booking_tid', true);
            $new_tid = sanitize_text_field($_POST['ny_booking_tid']);

            update_post_meta($post_id, 'ny_booking_navn', $new_name, $old_name);
            update_post_meta($post_id, 'ny_booking_telefon', $new_telefon, $old_telefon);
            update_post_meta($post_id, 'ny_booking_behandling', $new_behandling, $old_behandling);
            update_post_meta($post_id, 'ny_booking_dato', $new_dato, $old_dato);
            update_post_meta($post_id, 'ny_booking_tid', $new_tid, $old_tid);
        }

      }
    
}
}