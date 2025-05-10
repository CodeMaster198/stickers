<?php
    require_once 'config.php'; 

session_start();

// Initialisation du panier s'il n'existe pas
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Fonction pour ajouter un produit au panier
function addToCart($productId, $quantity = 1) {
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] += $quantity;
    } else {
        $_SESSION['cart'][$productId] = $quantity;
    }
}

// Fonction pour supprimer un produit du panier
function removeFromCart($productId) {
    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
    }
}

// Fonction pour mettre à jour la quantité
function updateCart($productId, $quantity) {
    if ($quantity <= 0) {
        removeFromCart($productId);
    } else {
        $_SESSION['cart'][$productId] = $quantity;
    }
}

// Traitement des actions du panier
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_to_cart'])) {
        $productId = $_POST['product_id'];
        addToCart($productId);
    } elseif (isset($_POST['remove_item'])) {
        $productId = $_POST['product_id'];
        removeFromCart($productId);
    } elseif (isset($_POST['update_quantity'])) {
        $productId = $_POST['product_id'];
        $quantity = (int)$_POST['quantity'];
        updateCart($productId, $quantity);
    }
}

// Simuler une base de données de produits (identique à index.php)








// Simuler une base de données de produits


// Récupérer les produits depuis la base de données
// Récupérer les produits depuis la base de données
$products = [];
$sql = "SELECT id, nom, prix, image FROM produits"; // Assure-toi que les noms des colonnes sont corrects

$stmt = $pdo->query($sql); // utilise $pdo ici

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $products[$row['id']] = [
        'name' => $row['nom'],
        'price' => $row['prix'],
        'image' => $row['image']
    ];
}


?>
<!DOCTYPE html>
<html>
<head>
    <!-- Même head que index.php -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Famms - Shopping Cart</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/responsive.css" rel="stylesheet" />
    <style>
        .cart-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #f7444e;
            color: white;
            border-radius: 50%;
            padding: 3px 6px;
            font-size: 12px;
        }
        .nav-item {
            position: relative;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }
        .table th, .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }
        .table tbody + tbody {
            border-top: 2px solid #dee2e6;
        }
        .btn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .btn-primary {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-success {
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-danger {
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-info {
            color: #fff;
            background-color: #17a2b8;
            border-color: #17a2b8;
        }
        .text-right {
            text-align: right !important;
        }
        .text-center {
            text-align: center !important;
        }
    </style>
</head>
<body>
    <div class="hero_area">
        <!-- header section (identique à index.php) -->
        <header class="header_section">
            <div class="container">
                <nav class="navbar navbar-expand-lg custom_nav-container ">
                    <a class="navbar-brand" href="index.php"><img width="250" src="images/logo.png" alt="#" /></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class=""> </span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Home</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="cart.php">Cart <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="cart.php">
                                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                                        <!-- SVG du panier -->
                                    </svg>
                                    <span class="cart-count">
                                        <?php echo array_sum($_SESSION['cart']); ?>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!-- end header section -->

        <!-- cart section -->
        <section class="product_section layout_padding">
            <div class="container">
                <div class="heading_container heading_center">
                    <h2>Your <span>Cart</span></h2>
                </div>
                
                <?php if (empty($_SESSION['cart'])): ?>
                    <div class="text-center">
                        <p>Your cart is empty</p>
                        <a href="index.php" class="btn btn-primary">Continue Shopping</a>
                    </div>
                <?php else: ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $total = 0;
                            foreach ($_SESSION['cart'] as $id => $quantity): 
                                if (!isset($products[$id])) continue;
                                $product = $products[$id];
                                $subtotal = $product['price'] * $quantity;
                                $total += $subtotal;
                            ?>
                            <tr>
                                <td>
                                    <img src="<?php echo $product['image']; ?>" width="50" style="margin-right: 10px;">
                                    <?php echo $product['name']; ?>
                                </td>
                                <td><?php echo $product['price']; ?> DT</td>
                                <td>
                                    <form method="post" action="" style="display:inline;">
                                        <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                        <input type="number" name="quantity" value="<?php echo $quantity; ?>" min="1" style="width: 80px;">
                                        <button type="submit" name="update_quantity" class="btn btn-sm btn-info">Update</button>
                                    </form>
                                </td>
                                <td><?php echo $subtotal; ?> DT</td>
                                <td>
                                    <form method="post" action="" style="display:inline;">
                                        <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                        <button type="submit" name="remove_item" class="btn btn-sm btn-danger">Remove</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-right"><strong>Total:</strong></td>
                                <td><?php echo $total; ?> DT</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="text-center">
                        <a href="index.php" class="btn btn-primary">Continue Shopping</a>
                        <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        <!-- end cart section -->

        <!-- footer section (identique à index.php) -->
        <footer>
            <!-- Votre footer existant -->
        </footer>
    </div>

    <!-- scripts (identique à index.php) -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>