<?php
// This file assumes donor.php or receiver.php has already set the variables

// If donor data is available
if (isset($donor_id)) {
    echo "<h3>Data from Donor</h3>";
    echo "Donor ID: " . htmlspecialchars($donor_id) . "<br>";
    echo "Name: " . htmlspecialchars($name) . "<br>";
    echo "Age: " . htmlspecialchars($age) . "<br>";
    echo "Blood Group: " . htmlspecialchars($blood_group) . "<br>";
    echo "Gender: " . htmlspecialchars($gender) . "<br>";
    echo "Phone Number: " . htmlspecialchars($phone_no) . "<br>";
    echo "Last Donation Date: " . htmlspecialchars($last_donation) . "<br>";
}

// If receiver data is available
if (isset($receiver_id)) {
    echo "<h3>Data from Receiver</h3>";
    echo "Receiver ID: " . htmlspecialchars($receiver_id) . "<br>";
    echo "Name: " . htmlspecialchars($name) . "<br>";
    echo "Age: " . htmlspecialchars($age) . "<br>";
    echo "Blood Group: " . htmlspecialchars($blood_group) . "<br>";
    echo "Gender: " . htmlspecialchars($gender) . "<br>";
    echo "Phone Number: " . htmlspecialchars($phone_no) . "<br>";
}
?>
