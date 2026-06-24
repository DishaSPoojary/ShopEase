<?php
session_start();
include "db.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if(isset($_GET['search'])){
    $search=htmlspecialchars(trim($_GET['search']));
    $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ?");
    $searchTerm = "%$search%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
}else{
    $result=$conn->query("SELECT * FROM products");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shop</title>
    <style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: #f5f5f5;
}

/* Navbar */
.navbar {
    background: #111;
    padding: 15px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

h1{
    color: blue;
}

.navbar a {
    color: white;
    text-decoration: none;
    margin-left: 20px;
    font-weight: 500;
    transition: 0.3s;
}

.navbar a:hover {
    color: #f4c10f;
}

/* Product Section */
.products {
    padding: 40px;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    max-width: 1000px;
    margin: auto;
}

/* Product Card */
.card {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: 0.3s;
    text-align: center;
}

.card:hover {
    transform: translateY(-6px);
}

.card img {
    width: 100%;
    height: 200px;
    object-fit: contain;
    display: block;
    margin: 0 auto;
}

.card h3 {
    margin: 10px 0;
}

.card p {
    font-size: 18px;
    font-weight: bold;
    color: #111;
}

/* Buttons */
button {
    padding: 8px 15px;
    background: #111;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #f4c10f;
    color: black;
}
/* Footer */
.footer {
    background: #111;
    color: white;
    text-align: center;
    padding: 20px 10px;
    margin-top: 50px;
}

.footer p {
    margin: 5px 0;
    font-size: 14px;
}

.footer a {
    color: #f4c10f;
    text-decoration: none;
}

.footer a:hover {
    text-decoration: underline;
}
</style>
</head>
<body>

<div class="navbar">

    <div>
    <h1>ShopEase</h1>
</div>
    <div>
        <span style="color:white;">
        Welcome, <?php echo $_SESSION['name']; ?>
    </span>
        <a href="shop.php">Home</a>
        <a href="logout.php">Logout</a>
        <a href="cart.php">Cart</a>
        <a href="orders.php">My Orders</a>
    </div>
</div>
<form method="GET" style='text-align: center; margin: 20px;'>
    <input type="text" name="search" placeholder="Search product...." style="padding: 8px; width: 250px;">
    <button type="submit">Search</button>
</form>

<div class="products">

<?php
while ($row = $result->fetch_assoc()) {

    echo "<div class='card'>";

    //  CLICKABLE PRODUCT
    echo "<a href='product.php?id=" . $row['id'] . "' style='text-decoration:none; color:black;'>";

    echo "<img src='images/" . $row['image'] . "'><br>";
    echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";

    echo "</a>";

    echo "<p>₹" . $row['price'] . "</p>";

    echo "<a href='cart.php?id=" . $row['id'] . "'>
            <button>Add to Cart</button>
          </a>";

    echo "</div>";
}
?>

</div>
<div class="footer">
    <p>&copy; 2026 ShopEase. All Rights Reserved.</p>
    
</div>
</body>
</html>