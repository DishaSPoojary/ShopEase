<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Checkout</title>

<style>
body {
    font-family: 'Segoe UI';
    background: #f5f5f5;
}

.container {
    width: 400px;
    margin: 50px auto;
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

input, textarea, select {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
}

button {
    background: #0f172a;
    color: white;
    padding: 10px;
    border: none;
    width: 100%;
    border-radius: 6px;
}

button:hover {
    background: #6366f1;
}
</style>
</head>

<body>

<div class="container">
<h2>Checkout</h2>

<form method="POST" action="place_order.php">

<input type="text" name="name" placeholder="Full Name" required>
<textarea name="address" placeholder="Delivery Address" required></textarea>
<input type="text" name="phone" placeholder="Phone Number" pattern="[0-9]{10}" maxlength="10" required>

<select name="payment">
<option value="COD">Cash on Delivery</option>
</select>

<button type="submit">Place Order</button>

</form>
</div>

</body>
</html>