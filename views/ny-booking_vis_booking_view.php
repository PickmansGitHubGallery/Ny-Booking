<style>
.booking-details {
    margin-top: 20px;
    padding: 20px;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 5px;
    text-align: center; 
}

.booking-details h2 {
    margin-bottom: 10px;
}

.booking {
    margin: 0 auto 20px; 
    max-width: 600px; 
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
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

.booking {
    border: 1px solid #ccc;
    padding: 10px;
    margin-bottom: 10px;
}

.booking.red {
    background-color: red;
    opacity: 0.7;
    color: white;
}
</style>

<?php
if (!empty($bookings)) {
    echo '<div class="booking-details">';
    echo '<h2>Booket Aftaler</h2>';
    
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
<script>
        //Indlæser hele DOM'en før scriptet køres for at undgå fejl
        document.addEventListener("DOMContentLoaded", function() {
            //vælger alle elementer med klassen "booking"
            const bookings = document.querySelectorAll(".booking");
            
            //Laver en forEach loop for at tilføje en eventlistener til hvert element
            bookings.forEach(function(booking) {
                booking.addEventListener("click", function() {
                    booking.classList.toggle("red");
                });
            });
        });
    </script>';
