<?php
session_start();
include("connect_db.php");

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name     = $_POST['name'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM employees WHERE name = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $_SESSION['name'] = $row['name'];
            header("Location: dashboard.php");
            exit();
        } else {
            $message = "Invalid name or password.";
        }
    } else {
        $message = "Invalid name or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Employee Login</title>
</head>
<body style="font-family: Arial, sans-serif; background-color:#f4f4f4; margin:0; padding:0;">

    <div style="max-width:400px; margin:60px auto; background:#fff; padding:30px; border-radius:8px; box-shadow:0px 0px 10px #ccc;">
        <h2 style="text-align:center; color:#b30000; margin-bottom:20px;">Employee Login</h2>

        <?php if (!empty($message)) { echo "<p style='color:red; text-align:center;'>$message</p>"; } ?>

        <form action="login.php" method="post">
            <label style="display:block; margin-top:10px; font-weight:bold;">Name:</label>
            <input type="text" name="name" required 
                   style="width:100%; padding:10px; margin-top:5px; border:1px solid #ccc; border-radius:4px;">

            <label style="display:block; margin-top:15px; font-weight:bold;">Password:</label>
            <input type="password" name="password" required 
                   style="width:100%; padding:10px; margin-top:5px; border:1px solid #ccc; border-radius:4px;">

            <input type="submit" value="Login" 
                   style="width:100%; margin-top:20px; padding:12px; background-color:#b30000; color:#fff; border:none; border-radius:4px; cursor:pointer; font-size:16px;">
        </form>
    </div>

</body>
</html>
