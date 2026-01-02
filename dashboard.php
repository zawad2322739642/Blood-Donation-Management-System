<?php
session_start();
include("connect_db.php");

// Redirect if not logged in
if (!isset($_SESSION['name'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Employee Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        h2 { text-align: center; color: #333; }
        .box {
            width: 90%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px #ccc;
        }
        .box h3 {
            text-align: center;
            background: #b30000;
            color: white;
            padding: 10px;
            border-radius: 4px;
        }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 10px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>

    <!-- Donor Info -->
    <div class="box">
        <h3>Donor Info</h3>
        <table>
            <tr><th>ID</th><th>Name</th><th>Age</th><th>Gender</th><th>Blood Group</th></tr>
            <?php
            $donor_result = mysqli_query($conn, "SELECT donor_id, name, age, gender, blood_group FROM donor");
            if ($donor_result && mysqli_num_rows($donor_result) > 0) {
                while ($d = mysqli_fetch_assoc($donor_result)) {
                    echo "<tr>
                            <td>".htmlspecialchars($d['donor_id'])."</td>
                            <td>".htmlspecialchars($d['name'])."</td>
                            <td>".htmlspecialchars($d['age'])."</td>
                            <td>".htmlspecialchars($d['gender'])."</td>
                            <td>".htmlspecialchars($d['blood_group'])."</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No donors found.</td></tr>";
            }
            ?>
        </table>
    </div>

    <!-- Receiver Info -->
    <div class="box">
        <h3>Receiver Info</h3>
        <table>
            <tr><th>ID</th><th>Name</th><th>Age</th><th>Blood Group</th></tr>
            <?php
            $receiver_result = mysqli_query($conn, "SELECT receiver_id, name, age, blood_group FROM receiver");
            if ($receiver_result && mysqli_num_rows($receiver_result) > 0) {
                while ($r = mysqli_fetch_assoc($receiver_result)) {
                    echo "<tr>
                            <td>".htmlspecialchars($r['receiver_id'])."</td>
                            <td>".htmlspecialchars($r['name'])."</td>
                            <td>".htmlspecialchars($r['age'])."</td>
                            <td>".htmlspecialchars($r['blood_group'])."</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No receivers found.</td></tr>";
            }
            ?>
        </table>
    </div>

    <!-- Donation History -->
    <div class="box">
        <h3>Donation History</h3>
        <table>
            <tr><th>ID</th><th>Receiver</th><th>Donor</th><th>Date</th></tr>
            <?php
            $history_sql = "SELECT d.donation_id,
                                   r.name AS receiver_name,
                                   dn.name AS donor_name,
                                   d.donation_date
                            FROM donation d
                            JOIN receiver r ON d.receiver_id = r.receiver_id
                            JOIN donor dn ON d.donor_id = dn.donor_id
                            ORDER BY d.donation_date DESC";
            $history_result = mysqli_query($conn, $history_sql);
            if ($history_result && mysqli_num_rows($history_result) > 0) {
                while ($h = mysqli_fetch_assoc($history_result)) {
                    echo "<tr>
                            <td>".htmlspecialchars($h['donation_id'])."</td>
                            <td>".htmlspecialchars($h['receiver_name'])."</td>
                            <td>".htmlspecialchars($h['donor_name'])."</td>
                            <td>".htmlspecialchars($h['donation_date'])."</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No donations recorded.</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
