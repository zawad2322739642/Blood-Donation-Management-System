<?php
$donor_id = $_POST['donor_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Request Blood</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        label {
            font-weight: bold;
            color: #555;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2>Request Blood From Donor #<?= $donor_id ?></h2>

<form action="request.php" method="POST">
    <input type="hidden" name="donor_id" value="<?= $donor_id ?>">

    <label>Your Name:</label><br>
    <input type="text" name="name" required><br>

    <label>Your Phone:</label><br>
    <input type="text" name="phone" required><br>

    <button type="submit">Submit Request</button>
</form>

</body>
</html>
