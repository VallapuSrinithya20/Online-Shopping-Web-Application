<?php
session_start(); // <- MUST be at the very top

include 'db.php';



// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit(); // <- important after header redirect
}

// Check if product id is set
if (!isset($_GET['id'])) {
    echo "Product not selected.";
    exit();
}

$product_id = intval($_GET['id']); // security: convert to integer
$product_query = mysqli_query($conn, "SELECT * FROM products WHERE product_id = $product_id");

if (!$product_query || mysqli_num_rows($product_query) == 0) {
    echo "Product not found.";
    exit();
}

$product = mysqli_fetch_assoc($product_query);
?>
<head>
    <title>Online Shopping</title>
    
</head>


<h2 class="order-title">Order <?= htmlspecialchars($product['product_name']); ?></h2>

<div class="order-box">
    <form method="post">
        <label>Quantity:</label><br>
        <input type="number" name="qty" required min="1" class="qty-input">

        <br><br>

        <button type="submit" name="order" class="order-btn">
            Place Order
        </button>
    </form>
</div>


<?php
if (isset($_POST['order'])) {
    $qty = intval($_POST['qty']); // convert to integer
    $total = $qty * $product['price'];
    $user_id = $_SESSION['user_id'];

    // Insert into orders table
    $insert_order = mysqli_query($conn, "
        INSERT INTO orders (order_date, total_amount, status, user_id)
        VALUES (NOW(), $total, 'Pending', $user_id)
    ");

    if ($insert_order) {
        $order_id = mysqli_insert_id($conn);

        // Insert into order_items table
        mysqli_query($conn, "
            INSERT INTO order_items (quantity, price, order_id, product_id)
            VALUES ($qty, {$product['price']}, $order_id, $product_id)
        ");

        // Redirect to payment page
        header("Location: payment.php?order_id=$order_id");
        exit();
    } else {
        echo "Failed to place order. Please try again.";
    }
}
?>
