<?php
include("connect_db.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $receiver_id = intval($_POST['receiver_id']);
    $donor_id    = intval($_POST['donor_id']);

    $check_receiver = mysqli_query($conn, "SELECT * FROM receiver WHERE receiver_id = $receiver_id");
    $check_donor    = mysqli_query($conn, "SELECT * FROM donor WHERE donor_id = $donor_id");

    if (mysqli_num_rows($check_receiver) > 0 && mysqli_num_rows($check_donor) > 0) {
        // Insert into donation table
        $sql = "INSERT INTO donation (receiver_id, donor_id, donation_date)
                VALUES ($receiver_id, $donor_id, NOW())";

        if (mysqli_query($conn, $sql)) {
            echo "<h2 style='color:green;'>Donation has been recorded successfully!</h2>";
            echo "<p>Receiver ID: $receiver_id matched with Donor ID: $donor_id</p>";
        } else {
            echo "<p style='color:red;'>Error saving donation: " . mysqli_error($conn) . "</p>";
        }
    } else {
        echo "<p style='color:red;'>Invalid Receiver ID or Donor ID. Please try again.</p>";
    }
}
?>
