<?php
include("connect_db.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect form data
    $name          = $_POST['name'];
    $age           = $_POST['age'];
    $blood_group   = $_POST['group'];
    $gender        = $_POST['gender'];
    $phone_no      = $_POST['phone_no'];
    $last_donation = $_POST['last_donation'];

    // Insert into donor table
    $add_donor = "INSERT INTO donor (name, blood_group, age, phone_no, last_donate, gender)
                  VALUES ('$name', '$blood_group', $age, '$phone_no', '$last_donation', '$gender')";

    if (mysqli_query($conn, $add_donor)) {
        // define donor_id BEFORE including savedata.php
        $donor_id = mysqli_insert_id($conn);

        echo "<h2>Donor Information Received</h2>";
        echo "Name: " . htmlspecialchars($name) . "<br>";
        echo "Age: " . htmlspecialchars($age) . "<br>";
        echo "Gender: " . htmlspecialchars($gender) . "<br>";
        echo "Last Donation Date: " . htmlspecialchars($last_donation) . "<br>";
        echo "<p style='color:green; font-weight:bold;'>Your Donor ID is: $donor_id</p>";

        // now savedata.php can see $donor_id
        include("savedata.php");
header("Location: thanks.php");
        exit();
        // you can also echo it again here if you want
        echo "<p>Echo from donor.php: $donor_id</p>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blood Donor Form</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f8f8f8; }
        .container { width: 400px; margin: 50px auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0px 0px 10px #ccc; }
        h2 { text-align: center; color: #b30000; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input, select { width: 100%; padding: 8px; margin-top: 5px; border-radius: 4px; border: 1px solid #ccc; }
        input[type="submit"] { background-color: #b30000; color: white; border: none; cursor: pointer; margin-top: 15px; }
        input[type="submit"]:hover { background-color: #800000; }
    </style>
</head>
<body>
<div class="container">
    <h2>Blood Donor Information</h2>
    <form action="donor.php" method="post">
        <label>Full Name:</label>
        <input type="text" name="name" required>
        <label>Age:</label>
        <input type="number" name="age" min="18" max="65" required>
        <label>Blood Group:</label>
        <input type="text" name="group" required>
        <label>Gender:</label>
        <select name="gender" required>
            <option value="">--Select--</option>
            <option>Male</option>
            <option>Female</option>
            <option>Other</option>
        </select>
        <label>Phone Number:</label>
        <input type="text" name="phone_no" required>
        <label>Last Donation Date:</label>
        <input type="date" name="last_donation" required>
        <input type="submit" value="Submit">
    </form>
</div>
</body>
</html>
