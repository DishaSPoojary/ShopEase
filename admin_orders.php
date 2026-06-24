<?php
session_start();
include "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT * FROM orders ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>All Orders</title>

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
}

.navbar a {
    color: #f4c10f;
    text-decoration: none;
}

/* Container */
.container {
    width: 85%;
    margin: 40px auto;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

th {
    background: #111827;
    color: white;
    padding: 12px;
}

td {
    padding: 12px;
    text-align: center;
}

tr:hover {
    background: #f9fafb;
}

/* Price */
.price {
    font-weight: bold;
}
</style>

</head>

<body>

<div class="navbar">
    <h3>All Orders</h3>
    <a href="admin.php">⬅ Back</a>
</div>

<div class="container">

<h2>Orders List</h2>

<table>
<tr>
    <th>User</th>
    <th>Product</th>
    <th>Price</th>
</tr>

<?php while ($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?php echo htmlspecialchars($row['user_email']); ?></td>
    <td><?php echo htmlspecialchars($row['product_name']); ?></td>
    <td class="price">₹<?php echo $row['price']; ?></td>
</tr>
<?php } ?>

</table>

</div>

</body>
</html>