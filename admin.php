<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Panel</title>

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: #f4f6f9;
}

/* Navbar */
.navbar {
    background: #111827;
    color: white;
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.navbar h2 {
    margin: 0;
}

.navbar span {
    font-size: 14px;
}

/* Dashboard */
.container {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin-top: 80px;
    flex-wrap: wrap;
}

/* Cards */
.card {
    background: white;
    padding: 30px;
    width: 220px;
    text-align: center;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    transition: 0.3s;
}

.card:hover {
    transform: translateY(-8px);
}

.card h3 {
    margin-bottom: 15px;
    color: #111827;
}

/* Buttons */
.card a {
    text-decoration: none;
    color: white;
    background: #111827;
    padding: 10px 15px;
    border-radius: 6px;
    display: inline-block;
    transition: 0.3s;
}

.card a:hover {
    background: #f4c10f;
    color: black;
}

/* Logout */
.logout {
    color: #f4c10f;
    text-decoration: none;
    font-weight: bold;
}
</style>

</head>

<body>

<div class="navbar">
    <h2>Admin Dashboard</h2>
    <a class="logout" href="logout.php">Logout</a>
</div>

<div class="container">

    <div class="card">
        <h3> Add Product</h3>
        <a href="add_product.php">Open</a>
    </div>

    <div class="card">
        <h3>Manage Products</h3>
        <a href="manage_products.php">Open</a>
    </div>

    <div class="card">
        <h3> View Orders</h3>
        <a href="admin_orders.php">Open</a>
    </div>

</div>

</body>
</html>