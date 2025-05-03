<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_item'])) {
    $productId = $_POST['product_id'];
    unset($_SESSION['cart'][$productId]);
}

header("Location: cart.php");
exit();
?>