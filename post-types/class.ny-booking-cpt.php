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
        add_action('add_meta_boxes', [$this, 'show_data_meta_box']);
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
              'show_ui' => true,
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

            update_post_meta($post_id, 'ny_booking_navn', $new_name, $old_name);
            update_post_meta($post_id, 'ny_booking_telefon', $new_telefon, $old_telefon);
            update_post_meta($post_id, 'ny_booking_behandling', $new_behandling, $old_behandling);
        }

      }
      public function show_data_meta_box(){
        add_meta_box(
          'ny_booking_data',
          'Booking Data',
          [$this, 'show_data'],
          'ny-booking',
          'side',
          'default'
        );
      }
      public function show_data($post_id){
        $navn = get_post_meta(105, 'ny_booking_navn', true);
        $telefon = get_post_meta(105, 'ny_booking_telefon', true);
        $behandling = get_post_meta(105, 'ny_booking_behandling', true);

        require_once NY_BOOKING_PLUGIN_PATH . 'views/ny-booking_data.php';
      }
    
}
}