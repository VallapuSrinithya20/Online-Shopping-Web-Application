<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>

<body>

<h2>Welcome to Online Shopping</h2>

<?php
$result = mysqli_query($conn, "SELECT * FROM products");
while ($row = mysqli_fetch_assoc($result)) {
?>
<div class="box">
    <h3><?= $row['product_name']; ?></h3>
    <p>Price: ₹<?= $row['price']; ?></p>
    <a href="product_details.php?id=<?= $row['product_id']; ?>">View</a>
</div>
<?php } ?>
<head>
<title>Online Shopping</title>
<link rel="stylesheet" href="style.css">
</head>

</body>
</html>
