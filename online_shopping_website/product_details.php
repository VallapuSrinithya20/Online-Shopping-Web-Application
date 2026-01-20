
<?php
session_start();
include 'db.php';

if (!isset($_GET['id'])) {
    echo "Product not found";
    exit();
}

$product_id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    echo "Product not found";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($product['product_name']) ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h2><?= htmlspecialchars($product['product_name']) ?></h2>

<p><strong>Price:</strong> ₹<?= number_format($product['price'], 2) ?></p>

<p><strong>Description:</strong><br>
<?php
$productName = strtolower($product['product_name']);

if (strpos($productName, 'laptop') !== false) {
    
    echo "This laptop is designed for high performance and daily productivity.
    It features a powerful processor, fast storage, and long battery life,
    making it ideal for students, professionals, and office work.";
    
}
elseif (strpos($productName, 'headphone') !== false) {
    echo "These headphones deliver clear sound quality with deep bass and
    noise isolation. They are lightweight, comfortable for long usage,
    and suitable for music, online classes, gaming, and calls.";
}
elseif (strpos($productName, 'mobile') !== false || strpos($productName, ' phone') !== false) {
    echo "This mobile phone offers a sleek design with a vibrant display,
    smooth performance, high-quality camera, and long-lasting battery,
    perfect for communication, entertainment, and daily use.";
}
else {
    echo "This product is made with high quality materials and provides
    reliable performance for everyday use.";
}
?>

</p>


<a href="login.php?product_id=<?= $product['product_id'] ?>" class="btn">
    Order Now
</a>

</body>
</html>

