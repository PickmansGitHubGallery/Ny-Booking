<?php
if (!class_exists('NY_Booking_Form_Handler')) {
    class NY_Booking_Form_Handler {
        public function __construct() {
            add_action('init', [$this, 'process_form']);
        }

        public function process_form() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ny_booking_navn'])) {
                // Sanitize and validate input
                $navn = sanitize_text_field($_POST['ny_booking_navn']);
                $telefon = sanitize_text_field($_POST['ny_booking_telefon']);
                $behandling = sanitize_text_field($_POST['ny_booking_behandling']);
                $dato = sanitize_text_field($_POST['ny_booking_dato']);
                $tid = sanitize_text_field($_POST['ny_booking_tid']);

                // Create a new post
                $post_id = wp_insert_post([
                    'post_title' => $navn,
                    'post_type' => 'ny_booking',
                    'post_status' => 'publish'
                ]);

                // Add post meta
                if ($post_id) {
                    add_post_meta($post_id, 'ny_booking_navn', $navn);
                    add_post_meta($post_id, 'ny_booking_telefon', $telefon);
                    add_post_meta($post_id, 'ny_booking_behandling', $behandling);
                    add_post_meta($post_id, 'ny_booking_dato', $dato);
                    add_post_meta($post_id, 'ny_booking_tid', $tid);
                }

                // Redirect to a specific page
                $page_id = get_page_by_path('tak-for-din-bestilling')->ID;
                $redirect_url = get_permalink($page_id);
                wp_redirect($redirect_url);
                exit;
            }
        }
    }
}
