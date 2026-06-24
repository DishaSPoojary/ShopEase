<?php
session_start();
include "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM products WHERE id=$id");
$product = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("UPDATE products SET name=?, price=? WHERE id=?");
   $stmt->bind_param("sdi", $name, $price, $id);
   $stmt->execute();

    header("Location: manage_products.php");
}
?>

<h2>Edit Product</h2>

<form method="POST">
    Name: <input type="text" name="name" value="<?php echo $product['name']; ?>"><br><br>
    Price: <input type="number" name="price" value="<?php echo $product['price']; ?>"><br><br>
    <button>Update</button>
</form>