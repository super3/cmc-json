<?php
// Needed for our class
include('./market_cap.php');

// Making a new object from coin market cap data class
$mc = new coin_market_cap_data();

// Displaying this with some pretty_print
echo json_encode($mc->market_cap_data(100), JSON_PRETTY_PRINT);
?>
