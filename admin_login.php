<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND role='admin'");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {

        if (password_verify($password, $row['password'])) {
            $_SESSION['role'] = 'admin';
          $_SESSION['name'] = $row['name'];
          $_SESSION['user'] = $row['email'];
            header("Location: admin.php");
            exit();
        } else {
            echo "Wrong Password!";
        }

    } else {
        echo "Not an admin!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
</head>
<style>
body {
    margin: 0;
    padding: 0;
    font-family: Arial;
    background: #f4f4f4;

    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.login-box {
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
    width: 300px;
    text-align: center;
}

.login-box input {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
}

.login-box button {
    width: 100%;
    padding: 10px;
    background: black;
    color: white;
    border: none;
    cursor: pointer;
}
</style>

<div class="login-box">
    <h2>Admin Login</h2>

    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button>Login</button>
    </form>
</div>

</body>
</html>