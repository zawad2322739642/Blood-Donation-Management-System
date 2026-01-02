<?php
include("connect_db.php");

$show_donor = "SELECT * FROM donor";
try {
    $result = mysqli_query($conn, $show_donor);
} catch(Exception $e) {
    echo 'Message: ' .$e->getMessage();
}


$receiver_id = isset($_GET['receiver_id']) ? intval($_GET['receiver_id']) : null;
//include("save_data.php");
//exit() ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor List</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f2f2f2; padding: 20px; }
        h1, h2 { text-align: center; color: #333; }
        table { width: 80%; margin: auto; border-collapse: collapse; background: white; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #4CAF50; color: white; }
        tr:hover { background: #f5f5f5; }
        form { max-width: 400px; margin: 30px auto; padding: 20px; background: white; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        label { font-weight: bold; color: #555; }
        input[type="text"], input[type="number"] { width: 100%; padding: 8px; margin-top: 5px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; }
        button { background-color: #2196F3; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-size: 16px; }
        button:hover { background-color: #0b7dda; }
    </style>
</head>
<body>

<h1>Donor List</h1>

<?php if ($receiver_id): ?>
    <h2 style="color:green;">Your Receiver ID is: <?= $receiver_id ?></h2>
    <p style="text-align:center;">Use this ID when requesting blood.</p>
<?php endif; ?>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Blood Group</th>
    </tr>
    <?php 
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['donor_id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['age']}</td>
                    <td>{$row['gender']}</td>
                    <td>{$row['blood_group']}</td>
                  </tr>";
        }
    }
    ?>
</table>

<h2>Request Blood</h2>
<form action="donation.php" method="POST">
    <label>Receiver ID:</label>
    <input type="number" name="receiver_id" required>

    <label>Donor ID:</label>
    <input type="number" name="donor_id" required>
    <button type="submit">Send Request to Admin</button>
</form>

</body>
</html>
<?php


?>