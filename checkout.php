<?php
session_start();

// Vérifier si le panier est vide
if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

// Simuler une base de données de produits (identique à index.php)

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


// Calculer le total du panier
$total = 0;
foreach ($_SESSION['cart'] as $id => $quantity) {
    if (isset($products[$id])) {
        $total += $products[$id]['price'] * $quantity;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Famms - Checkout</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/responsive.css" rel="stylesheet" />
    <style>
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
        .form-group {
            margin-bottom: 1rem;
        }
        .form-control {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
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
        .btn-success {
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-primary {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }
        .text-right {
            text-align: right;
        }
        .alert {
            position: relative;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }
        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
    </style>
</head>
<body>
    <div class="hero_area">
        <!-- header section -->
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
                            <li class="nav-item">
                                <a class="nav-link" href="cart.php">Cart</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="checkout.php">Checkout <span class="sr-only">(current)</span></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!-- end header section -->

        <!-- checkout section -->
        <section class="product_section layout_padding">
            <div class="container">
                <div class="heading_container heading_center">
                    <h2>Check<span>out</span></h2>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <h3>Order Summary</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $cart_total = 0;
                                foreach ($_SESSION['cart'] as $id => $quantity): 
                                    if (!isset($products[$id])) continue;
                                    $product = $products[$id];
                                    $subtotal = $product['price'] * $quantity;
                                    $cart_total += $subtotal;
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                                    <td><?php echo $quantity; ?></td>
                                    <td><?php echo number_format($product['price'], 2); ?> DT</td>
                                    <td><?php echo number_format($subtotal, 2); ?> DT</td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-right">Subtotal</th>
                                    <th><?php echo number_format($cart_total, 2); ?> DT</th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-right">Shipping</th>
                                    <th>TND 7.00</th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-right">Total</th>
                                    <th><?php echo number_format($cart_total+7.00, 2); ?> DT</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                    <div class="col-md-6">
                        <h3>Payment Information</h3>
                        <form action="process_checkout.php" method="post">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" name="full_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea name="address" class="form-control" required></textarea>
                            </div>
                           <br>
                            </div>
                            <input type="hidden" name="total_amount" value="<?php echo $cart_total; ?>">
                            <button type="submit" class="btn btn-success btn-block">Complete Order</button>
                            <a href="cart.php" class="btn btn-primary btn-block mt-2">Back to Cart</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- end checkout section -->
        
        <!-- footer section -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="full">
                            <div class="logo_footer">
                                <a href="#"><img width="210" src="images/logo.png" alt="#" /></a>
                            </div>
                            <div class="information_f">
                                <p><strong>ADDRESS:</strong> 28 White tower, Street Name New York City, USA</p>
                                <p><strong>TELEPHONE:</strong> +91 987 654 3210</p>
                                <p><strong>EMAIL:</strong> yourmain@gmail.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="widget_menu">
                                            <h3>Menu</h3>
                                            <ul>
                                                <li><a href="index.php">Home</a></li>
                                                <li><a href="about.html">About</a></li>
                                                <li><a href="cart.php">Cart</a></li>
                                                <li><a href="checkout.php">Checkout</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>     
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer end -->
    </div>
    
    <!-- jQery -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="js/custom.js"></script>
</body>
</html>