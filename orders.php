<?php
session_start();
include "db.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['user'];

$stmt = $conn->prepare("SELECT * FROM orders WHERE user_email=? ORDER BY id DESC");

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
<title>My Orders</title>

<style>
body {
    font-family: 'Segoe UI', sans-serif;
    background: #f5f5f5;
    text-align: center;
}

/* Navbar */
.navbar {
    background: #0f172a;
    padding: 15px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.navbar a {
    color: white;
    text-decoration: none;
    margin-left: 20px;
}

.navbar a:hover {
    color: #6366f1;
}

h1 {
    color: #6366f1;
}

/* Table */
table {
    margin: 40px auto;
    width: 80%;
    border-collapse: collapse;
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

th {
    background: #0f172a;
    color: white;
    padding: 12px;
}

td {
    padding: 12px;
    text-align: center;
}

.status {
    color: green;
    font-weight: bold;
}


</style>

</head>

<body>

<div class="navbar">
    <h1>ShopEase</h1>
    <div>
        <a href="shop.php">Home</a>
        <a href="cart.php">Cart</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<h2> My Orders</h2>

<?php if ($result->num_rows == 0) { ?>
    <p>No orders found!</p>
<?php } else { ?>

<table>
<tr>
    <th>Product</th>
    <th>Price</th>
    <th>Date</th>
    <th>Status</th>
</tr>

<?php while ($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?php echo $row['product_name']; ?></td>
    <td>₹<?php echo $row['price']; ?></td>
    <td><?php echo $row['created_at'] ?? 'N/A'; ?></td>
    <td class="status">Delivered</td>
</tr>
<?php } ?>

</table>

<?php } ?>

<br>
<a href="shop.php">⬅ Back to Shop</a>



</body>
</html>