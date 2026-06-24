<?php
session_start();
include "db.php";

if (!isset($_SESSION['user']) || empty($_SESSION['cart'])) {
    header("Location: shop.php");
    exit();
}

$name = htmlspecialchars(trim($_POST['name']));
$address = htmlspecialchars(trim($_POST['address']));
$phone = htmlspecialchars(trim($_POST['phone']));
$payment = $_POST['payment'];

$user_email = $_SESSION['user'];

foreach ($_SESSION['cart'] as $item) {

    $total_price = $item['price'] * $item['quantity'];

    $stmt = $conn->prepare("INSERT INTO orders 
    (user_email, product_name, price, name, address, phone, payment) 
    VALUES (?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssdssss", $user_email, $item['name'], $total_price, $name, $address, $phone, $payment);
    $stmt->execute();
}

$_SESSION['cart'] = [];

echo "<h2 style='text-align:center;'> Order Placed Successfully!</h2>";
echo "<p style='text-align:center;'><a href='shop.php'>Continue Shopping</a></p>";
?>