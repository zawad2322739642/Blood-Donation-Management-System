<?php
include("connect_db.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name     = $_POST['name'];
    $password = $_POST['password'];

    // Hash the password before saving
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO employees (name, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $name, $hashedPassword);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Employee Sign Up</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin:0; padding:0;">

    <div style="max-width:400px; margin:60px auto; background:#fff; padding:30px; border-radius:8px; box-shadow:0px 0px 10px #ccc;">
        <h2 style="text-align:center; color:#b30000; margin-bottom:20px;">Employee Sign Up</h2>

        <form action="signin.php" method="post">
            <label style="display:block; margin-top:10px; font-weight:bold;">Name:</label>
            <input type="text" name="name" required 
                   style="width:100%; padding:10px; margin-top:5px; border:1px solid #ccc; border-radius:4px;">

            <label style="display:block; margin-top:15px; font-weight:bold;">Password:</label>
            <input type="password" name="password" required 
                   style="width:100%; padding:10px; margin-top:5px; border:1px solid #ccc; border-radius:4px;">

            <input type="submit" value="Sign Up" 
                   style="width:100%; margin-top:20px; padding:12px; background-color:#b30000; color:#fff; border:none; border-radius:4px; cursor:pointer; font-size:16px;">
        </form>
    </div>

</body>
</html>
