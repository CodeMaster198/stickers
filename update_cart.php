<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_quantity'])) {
    $productId = $_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    
    if ($quantity <= 0) {
        unset($_SESSION['cart'][$productId]);
    } else {
        $_SESSION['cart'][$productId] = $quantity;
    }
}

header("Location: cart.php");
exit();
?>