<?php
session_start();
include "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM products WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: manage_products.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Products</title>

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

/* Table */
.container {
    width: 80%;
    margin: 40px auto;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

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

/* Buttons */
.btn {
    padding: 6px 12px;
    border-radius: 5px;
    text-decoration: none;
    color: white;
    font-size: 14px;
}

.edit {
    background: #2563eb;
}

.delete {
    background: #dc2626;
}

.btn:hover {
    opacity: 0.8;
}

/* Back link */
.back {
    display: block;
    text-align: center;
    margin-top: 20px;
}
</style>

</head>

<body>

<div class="navbar">
    <h3>Manage Products</h3>
    <a href="admin.php">⬅ Back</a>
</div>

<div class="container">

<h2>Product List</h2>

<table>
<tr>
    <th>Name</th>
    <th>Price</th>
    <th>Actions</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM products");

while ($row = $result->fetch_assoc()) {
?>
<tr>
    <td><?php echo htmlspecialchars($row['name']); ?></td>
    <td>₹<?php echo htmlspecialchars($row['price']); ?></td>
    <td>
        <a class="btn edit" href="edit_product.php?id=<?php echo $row['id']; ?>">Edit</a>
        <a class="btn delete" href="?delete=<?php echo $row['id']; ?>">Delete</a>
    </td>
</tr>
<?php } ?>

</table>

</div>

</body>
</html>