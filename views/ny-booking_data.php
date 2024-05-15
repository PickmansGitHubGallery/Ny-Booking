<?php
if (isset($navn, $telefon, $behandling)) {
?>
    <div class="booking-details">
        <h2>Booking Details</h2>
        <p><strong>Navn:</strong> <?php echo esc_html($navn); ?></p>
        <p><strong>Telefon nummer:</strong> <?php echo esc_html($telefon); ?></p>
        <p><strong>Behandling:</strong> <?php echo esc_html($behandling); ?></p>
    </div>
<?php
} else {
    echo '<p>No booking details available.</p>';
}
?>
