<?php
include("connect_db.php");

// Join donation with donor and receiver tables
$sql = "SELECT 
            d.donation_id,
            r.receiver_id,
            r.name AS receiver_name,
            dn.donor_id,
            dn.name AS donor_name,
            d.donation_date
        FROM donation d
        JOIN receiver r ON d.receiver_id = r.receiver_id
        JOIN donor dn ON d.donor_id = dn.donor_id
        ORDER BY d.donation_date DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Donation History - Admin View</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        h1 { text-align: center; color: #333; }
        table { width: 90%; margin: auto; border-collapse: collapse; background: white; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #b30000; color: white; }
        tr:hover { background-color: #f2f2f2; }
    </style>
</head>
<body>

<h1>Donation History</h1>

<table>
    <tr>
        <th>Donation ID</th>
        <th>Receiver ID</th>
        <th>Receiver Name</th>
        <th>Donor ID</th>
        <th>Donor Name</th>
        <th>Donation Date</th>
    </tr>
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['donation_id']}</td>
                    <td>{$row['receiver_id']}</td>
                    <td>{$row['receiver_name']}</td>
                    <td>{$row['donor_id']}</td>
                    <td>{$row['donor_name']}</td>
                    <td>{$row['donation_date']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='6' style='text-align:center;'>No donations recorded yet.</td></tr>";
    }
    ?>
</table>

</body>
</html>
