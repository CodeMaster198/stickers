<?php
session_start();

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: checkout.php");
    exit();
}

// Ici vous traiteriez normalement le paiement avec une API de paiement
// Pour cet exemple, nous allons simplement vider le panier et rediriger

// Enregistrer la commande (dans une vraie application, vous l'enregistreriez en base de données)
$order = [
    'customer' => [
        'name' => $_POST['full_name'],
        'email' => $_POST['email'],
        'address' => $_POST['address']
    ],
    'items' => $_SESSION['cart'],
    'total' => array_reduce($_SESSION['cart'], function($sum, $quantity) use ($products) {
        return $sum + ($products[key($products)]['price'] * $quantity);
    }, 0),
    'date' => date('Y-m-d H:i:s')
];

// Vider le panier
$_SESSION['cart'] = [];

// Rediriger vers la page de confirmation
$_SESSION['last_order'] = $order;
header("Location: order_confirmation.php");
exit();
?>