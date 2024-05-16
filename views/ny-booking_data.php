<?php
if (!empty($bookings)) {
    echo '<div class="booking-details">';
    echo '<h2>Booking Details</h2>';
    
    foreach ($bookings as $booking) {
        if (isset($booking['navn'], $booking['telefon'], $booking['behandling'], $booking['dato'], $booking['tid'])) {
            echo '<div class="booking">';
            echo '<p><strong>Navn:</strong> ' . esc_html($booking['navn']) . '</p>';
            echo '<p><strong>Telefon nummer:</strong> ' . esc_html($booking['telefon']) . '</p>';
            echo '<p><strong>Behandling:</strong> ' . esc_html($booking['behandling']) . '</p>';
            echo '<p><strong>Dato:</strong> ' . esc_html($booking['dato']) . '</p>';
            echo '<p><strong>Tid:</strong> ' . esc_html($booking['tid']) . '</p>';
            echo '</div>';
        }
    }

    echo '</div>';
} else {
    echo '<p>No booking details available.</p>';
}
?>
