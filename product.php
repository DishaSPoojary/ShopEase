<?php
session_start();
include "db.php";

// Check product ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Product not found!");
}

$id = intval($_GET['id']);

// Fetch product
$stmt = $conn->prepare("SELECT * FROM products WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Product not found!");
}

$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo htmlspecialchars($product['name']); ?></title>

<style>
body {
    font-family: Arial;
    background: #f5f5f5;
}

.container {
    width: 60%;
    margin: 50px auto;
    background: white;
    padding: 30px;
    border-radius: 10px;
    text-align: center;
}

img {
    width: 250px;
}

.price {
    font-size: 20px;
    font-weight: bold;
    margin: 10px 0;
}

.desc {
    margin-top: 15px;
    color: #555;
    font-size: 16px;
}

button {
    padding: 10px 20px;
    background: #111;
    color: white;
    border: none;
    border-radius: 6px;
}

button:hover {
    background: #f4c10f;
    color: black;
}
</style>

</head>

<body>

<div class="container">

<h2><?php echo htmlspecialchars($product['name']); ?></h2>

<img src="images/<?php echo $product['image']; ?>"><br>

<div class="price">
₹<?php echo $product['price']; ?>
</div>

<div class="desc">
<?php
if (!empty($product['description'])) {
    echo htmlspecialchars($product['description']);
} else {
    echo "No description available.";
}
?>
</div>

<br>

<a href="cart.php?id=<?php echo $product['id']; ?>">
<button>Add to Cart</button>
</a>

<br><br>

<a href="shop.php">⬅ Back to Shop</a>

</div>

</body>
</html>