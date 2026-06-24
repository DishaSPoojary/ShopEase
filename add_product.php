<?php
session_start();
include "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];

// VALIDATION
$allowed = ['jpg', 'jpeg', 'png'];
$ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));

if (!in_array($ext, $allowed)) {
    echo "Only JPG, JPEG, PNG files allowed!";
    exit();
}

// UPLOAD
move_uploaded_file($_FILES['image']['tmp_name'], "images/" . $image);

    $stmt = $conn->prepare("INSERT INTO products (name, price, description, image) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sdss", $name, $price, $description, $image);
    $stmt->execute();

    echo "Product Added!";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Product</title>

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
    font-weight: bold;
}

/* Form Container */
.container {
    width: 400px;
    margin: 60px auto;
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

/* Inputs */
input, textarea {
    width: 100%;
    padding: 10px;
    margin-top: 8px;
    margin-bottom: 15px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 14px;
}

textarea {
    resize: none;
}

/* Button */
button {
    width: 100%;
    padding: 12px;
    background: #111827;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background: #f4c10f;
    color: black;
}
</style>

</head>

<body>

<div class="navbar">
    <h3>Add Product</h3>
    <a href="admin.php">⬅ Back</a>
</div>

<div class="container">

<h2>Add New Product</h2>

<form method="POST" enctype="multipart/form-data">

<label>Product Name</label>
<input type="text" name="name" required>

<label>Price</label>
<input type="number" name="price" required>

<label>Product Image</label>
<input type="file" name="image" required>

<label>Description</label>
<textarea name="description" rows="4" placeholder="Enter product description" required></textarea>

<button type="submit">Add Product</button>

</form>

</div>

</body>
</html>