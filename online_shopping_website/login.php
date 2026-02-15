<?php
session_start();
include 'db.php';

// store product id if coming from product page
if (isset($_GET['product_id'])) {
    $_SESSION['product_id'] = $_GET['product_id'];
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['name'];

        // Check if product_id exists
        if (isset($_SESSION['product_id'])) {
            // Redirect to order page for the product
            header("Location: order.php?id=" . $_SESSION['product_id']);
            exit();
        } else {
            // If no product selected, redirect to all orders page
            header("Location: orders.php");
            exit();
        }
    } else {
        echo "<p style='color:red;'>Invalid login!</p>";
    }
}
?>

<h2>Login</h2>

<form method="post">
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button name="login">Login</button>
</form>

<p>New user? <a href="register.php">Register</a></p>
