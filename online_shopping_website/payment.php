<?<?php
include 'db.php';
$order_id = $_GET['order_id'];
?>
<head>
    <title>Online Shopping</title>
    
</head>
<h2>Payment</h2>

<form method="post">
    Payment Method:
    <select name="method" required>
        <option value="UPI">UPI</option>
        <option value="Card">Card</option>
        <option value="Cash">Cash</option>
    </select>
    <button name="pay">Pay</button>
</form>

<?php
if (isset($_POST['pay'])) {
    $mode = $_POST['method'];

    mysqli_query($conn, "
        INSERT INTO payments (payment_date, payment_method, payment_status, order_id)
        VALUES (NOW(), '$mode', 'Success', $order_id)
    ");

    mysqli_query($conn, "
        INSERT INTO delivery (delivery_date, delivery_status, order_id)
        VALUES (DATE_ADD(NOW(), INTERVAL 3 DAY), 'Shipped', $order_id)
    ");
    header("Location: logout.php");
        exit();

    echo "<h3>Order placed successfully!</h3>";
}
?>



