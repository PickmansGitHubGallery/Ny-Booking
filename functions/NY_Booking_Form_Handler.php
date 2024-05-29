<?php

if(!defined('ABSPATH')){
    exit;
}

if (!class_exists('NY_Booking_Form_Handler')) {
    class NY_Booking_Form_Handler {
        public function __construct() {
            add_action('init', [$this, 'process_form']);
        }

        public function process_form() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ny_booking_navn'])) {
                
                $navn = sanitize_text_field($_POST['ny_booking_navn']);
                $telefon = sanitize_text_field($_POST['ny_booking_telefon']);
                $behandling = sanitize_text_field($_POST['ny_booking_behandling']);
                $dato = sanitize_text_field($_POST['ny_booking_dato']);
                $tid = sanitize_text_field($_POST['ny_booking_tid']);

                
                
                $post_id = wp_insert_post([
                    'post_title' => $navn,
                    'post_type' => 'ny_booking',
                    'post_status' => 'publish'
                ]);

                
                if ($post_id) {
                    global $wpdb;

                    $meta_data = [
                        'ny_booking_navn' => $navn,
                        'ny_booking_telefon' => $telefon,
                        'ny_booking_behandling' => $behandling,
                        'ny_booking_dato' => $dato,
                        'ny_booking_tid' => $tid
                    ];

                    foreach ($meta_data as $meta_key => $meta_value) {
                        $wpdb->query(
                            $wpdb->prepare(
                                "INSERT INTO {$wpdb->postmeta} (post_id, meta_key, meta_value) VALUES (%d, %s, %s)",
                                $post_id, $meta_key, $meta_value
                            )
                        );
                    }
                }

                
                $page_id = get_page_by_path('tak-for-din-bestilling')->ID;
                if ($page_id) {
                    $redirect_url = get_permalink($page_id);
                    wp_redirect($redirect_url);
                    exit;
                }
            }
        }
    }
}

