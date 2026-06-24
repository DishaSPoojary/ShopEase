<?php
session_start();
include "db.php";

/*  PROTECT PAGE */
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

/* Initialize cart */
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

/* REMOVE PRODUCT */
if (isset($_GET['remove'])) {
    $id = intval($_GET['remove']);

    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
    }

    header("Location: cart.php");
    exit();
}

/* INCREASE QUANTITY */
if (isset($_GET['increase'])) {
    $id = intval($_GET['increase']);

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity']++;
    }

    header("Location: cart.php");
    exit();
}

/* DECREASE QUANTITY */
if (isset($_GET['decrease'])) {
    $id = intval($_GET['decrease']);

    if (isset($_SESSION['cart'][$id])) {
        if ($_SESSION['cart'][$id]['quantity'] > 1) {
            $_SESSION['cart'][$id]['quantity']--;
        } else {
            unset($_SESSION['cart'][$id]);
        }
    }

    header("Location: cart.php");
    exit();
}

/* ADD PRODUCT */
if (isset($_GET['id']) && !isset($_GET['remove'])) {

    $id = intval($_GET['id']);

    $stmt = $conn->prepare("SELECT name, price FROM products WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($product = $result->fetch_assoc()) {

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity'] += 1;
        } else {
            $_SESSION['cart'][$id] = [
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => 1
            ];
        }
    }

    $stmt->close();

    header("Location: cart.php");
    exit();
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f5f5f5;
            text-align: center;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar */
        .navbar {
            background: #0f172a;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        h1 {
            color: #6366f1;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: 500;
            transition: 0.3s;
        }

        .navbar a:hover {
            color: #6366f1;
        }

        table {
            margin: 40px auto;
            width: 70%;
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
        }

        button {
            padding: 8px 15px;
            background: #0f172a;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
        }

        button:hover {
            background: #6366f1;
        }

        .qty-btn {
            text-decoration: none;
            padding: 5px 10px;
            background: #eee;
            border-radius: 5px;
            margin: 0 5px;
            color: black;
        }

        .qty-btn:hover {
            background: #6366f1;
            color: white;
        }

        .main-content {
            flex: 1;
        }

        /* Footer */
        .footer {
            background: #0f172a;
            color: white;
            text-align: center;
            padding: 20px 10px;
            margin-top: 50px;
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

<div class="main-content">

<h2> My Cart</h2>

<?php
if (!empty($success)) {
    echo "<h3>$success</h3>";
}

$total = 0;

if (empty($_SESSION['cart'])) {
    echo "<p>Cart is empty!</p>";
} else {

    $totalItems = 0;
foreach($_SESSION['cart'] as $item){
    $totalItems += $item['quantity'];
}
echo "<p><strong>Total Items:</strong> " . $totalItems . "</p>";

    
    echo "<table>";
    echo "<tr>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Subtotal</th>
        <th>Action</th>
      </tr>";

    foreach ($_SESSION['cart'] as $id => $item) {

        $subtotal = $item['price'] * $item['quantity'];

        echo "<tr>";
        echo "<td>".$item['name']."</td>";
        echo "<td>₹".$item['price']."</td>";

        echo "<td>
        <a class='qty-btn' href='cart.php?decrease=".$id."'>➖</a>
        ".$item['quantity']."
        <a class='qty-btn' href='cart.php?increase=".$id."'>➕</a>
        </td>";

        echo "<td>₹".$subtotal."</td>";

        echo "<td>
        <a href='cart.php?remove=".$id."'>
        <button type='button' style='background:red;'>Remove</button>
        </a>
        </td>";

        echo "</tr>";

        $total += $subtotal;
    }

    echo "<tr>
        <th colspan='3'>Total</th>
        <th>₹$total</th>
        <th></th>
      </tr>";

    echo "</table><br>";

    echo "<a href='checkout.php'>
<button type='button'>Proceed to Checkout</button>
</a>";

}
?>

<br><br>
<a href="shop.php">⬅ Back to Shop</a>

</div>

<div class="footer">
    <p>&copy; 2026 ShopEase. All Rights Reserved.</p>
</div>

</body>
</html>