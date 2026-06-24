<?php
include "db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $row['email'];
            $_SESSION['name'] = $row['name'];
           $_SESSION['role'] = $row['role'];

           if ($row['role'] == 'admin') {
            header("Location: admin.php");
} else {
    header("Location: shop.php");
}
exit();
            
        } else {
            echo "Invalid Password!";
        }

    } else {
        echo "User not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
body {
    font-family: Arial;
    background-color: #f2f2f2;
}

.container {
    width: 300px;
    margin: 100px auto;
    padding: 30px;
    background: white;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    border-radius: 8px;
    text-align: center;
}

input {
    width: 100%;
    padding: 8px;
    margin: 8px 0;
}

button {
    padding: 10px;
    background: #111;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #f4c10f;
    color: black;
}
</style>
</head>
<body>

<div class="container">
<h2>Login</h2>

<form method="POST">
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
</form>
</div>
</body>
</html>