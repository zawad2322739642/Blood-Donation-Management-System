<?php
if (isset($_POST['role'])){
    if($_POST['role'] === "Donor"){
        header("Location: donor.php");
        exit();
    } elseif ($_POST['role'] === "Receiver") {
        header("Location: receiver.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }
        h2 {
            color: #b30000;
        }
        fieldset {
            width: 300px;
            padding: 15px;
            border: 2px solid #b30000;
            border-radius: 6px;
            background-color: #fff;
        }
        legend {
            font-weight: bold;
            color: #333;
        }
        input[type="submit"] {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            background-color: #b30000;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #800000;
        }
        label {
            color: #333;
        }
        .admin-btn {
            background-color: white;
            color: red;
            border: 1px solid red;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
        }
        .admin-btn:hover {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<center>
    <h2>Blood Donation Management System</h2>
    <div style="margin-top:50px;">
        <form action="homepage.php" method="post">
            <fieldset>
                <legend>Please Select One</legend>

                <input type="radio" name="role" value="Donor">
                <label>I am a Blood Donor</label>
                <br><br>

                <input type="radio" name="role" value="Receiver">
                <label>I am a Blood Receiver</label>
                <br><br>

                <input type="submit" value="Proceed">
            </fieldset>
        </form>
    </div>
</center>

<div style="position: fixed; bottom: 10px; right: 10px;">
    <form action="signin.php">
    <input type="submit" name="admin" value="Admin" class="admin-btn">
    </form>
</div>

</body>
</html>
