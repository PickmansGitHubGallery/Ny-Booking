<style>
.booking-details {
    margin-top: 20px;
    padding: 20px;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 5px;
    text-align: center; /* Center the text */
}

.booking-details h2 {
    margin-bottom: 10px;
}

.booking {
    margin: 0 auto 20px; /* Center the booking div */
    max-width: 600px; /* Limit the width of the booking div */
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.booking p {
    margin: 5px 0;
}

.booking p strong {
    font-weight: bold;
}

#no-booking {
    text-align: center;
    margin-top: 20px;
    padding: 20px;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 5px;
}
</style>
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
    echo '<p id="no-booking">No booking details available.</p>';
}
?>
