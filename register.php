<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];

    // ✅ PASSWORD LENGTH CHECK
    if (strlen($password) < 6) {
        echo "<p style='color:red; text-align:center;'>Password must be at least 6 characters!</p>";
    } else {

        // HASH PASSWORD AFTER VALIDATION
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // ✅ CHECK IF EMAIL EXISTS
        $check = $conn->prepare("SELECT id FROM users WHERE email=?");
        $check->bind_param("s", $email);
        $check->execute();
        $res = $check->get_result();

        if ($res->num_rows > 0) {
            echo "<p style='color:red; text-align:center;'>Email already exists!</p>";
        } else {

            // ✅ INSERT USER
            $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $hashedPassword);

            if ($stmt->execute()) {
                header("Location: login.php");
                exit();
            } else {
                echo "<p style='color:red; text-align:center;'>Something went wrong!</p>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
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
}

button:hover {
    background: #f4c10f;
    color: black;
}
</style>
</head>

<body>

<div class="container">
<h2>Register</h2>

<form method="POST">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>

    <!-- ✅ HTML VALIDATION -->
    Password: <input type="password" name="password" minlength="6" required><br><br>

    <button type="submit">Register</button>
</form>
</div>

</body>
</html>