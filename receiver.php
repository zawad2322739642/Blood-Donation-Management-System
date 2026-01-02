<?php
include("connect_db.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect form data into variables
    $name        = $_POST['name'];
    $age         = $_POST['age'];
    $blood_group = $_POST['group'];
    $gender      = $_POST['gender'];
    $phone_no    = $_POST['phone_no'];

    // Insert into receiver table
    $add_receiver = "INSERT INTO receiver (name, blood_group, age, phone_no, gender)
                     VALUES ('$name','$blood_group',$age,'$phone_no','$gender')";

    if (mysqli_query($conn, $add_receiver)) {
        // Get auto-generated ID AFTER successful insert
        $receiver_id = mysqli_insert_id($conn);

        // Show confirmation
        echo "<h2>Receiver Information Received</h2>";
        echo "Name: " . htmlspecialchars($name) . "<br>";
        echo "Age: " . htmlspecialchars($age) . "<br>";
        echo "Gender: " . htmlspecialchars($gender) . "<br>";
        echo "<p style='color:green; font-weight:bold;'>Your Receiver ID is: $receiver_id</p>";
        echo "<p>Please save this ID. You will need it when requesting blood.</p>";

        // Now savedata.php can safely access $receiver_id
      //  include("savedata.php");

        // Redirect to donor list with ID
        header("Location: donorList.php?receiver_id=$receiver_id");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Form not submitted correctly.";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Receiver Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
        }
        .container {
            width: 400px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px #ccc;
        }
        h2 {
            text-align: center;
            color: #b30000;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #b30000;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 15px;
        }
        input[type="submit"]:hover {
            background-color: #800000;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Blood Receiver Information</h2>
    <form action="receiver.php" method="post">
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age"  required>
        <label for= "blood group">Blood Group</label>
        <input type ="text" id = "group" name = "group" required>
        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="">--Select--</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>
<label for="phone_no">Phone Number:</label>
        <input type="number" id="phone_no" name="phone_no" pattern="[0-9]{10}" placeholder="e.g. +8801234567890" required>


        <input type="submit" value="Submit">
    </form>
</div>

</body>
</html>
