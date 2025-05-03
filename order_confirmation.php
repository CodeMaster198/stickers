<?php
session_start();

// Vérifier s'il y a une commande à afficher
if (!isset($_SESSION['last_order'])) {
    header("Location: index.php");
    exit();
}

$order = $_SESSION['last_order'];
unset($_SESSION['last_order']);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Famms - Order Confirmation</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/responsive.css" rel="stylesheet" />
</head>
<body>
    <div class="hero_area">
        <!-- header section (identique) -->
        
        <!-- confirmation section -->
        <section class="product_section layout_padding">
            <div class="container">
                <div class="heading_container heading_center">
                    <h2>Order <span>Confirmation</span></h2>
                </div>
                
                <div class="alert alert-success">
                    <h4>Thank you for your order, <?php echo htmlspecialchars($order['customer']['name']); ?>!</h4>
                    <p>Your order has been placed successfully. A confirmation email has been sent to <?php echo htmlspecialchars($order['customer']['email']); ?>.</p>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <h3>Order Details</h3>
                        <p><strong>Order Date:</strong> <?php echo $order['date']; ?></p>
                        <p><strong>Order Total:</strong> $<?php echo number_format($order['total'], 2); ?></p>
                        
                        <h3>Shipping Address</h3>
                        <address>
                            <?php echo nl2br(htmlspecialchars($order['customer']['address'])); ?>
                        </address>
                    </div>
                    
                    <div class="col-md-6">
                        <h3>Order Items</h3>
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
                                <?php foreach ($order['items'] as $id => $quantity): 
                                    if (!isset($products[$id])) continue;
                                    $product = $products[$id];
                                    $subtotal = $product['price'] * $quantity;
                                ?>
                                <tr>
                                    <td><?php echo $product['name']; ?></td>
                                    <td><?php echo $quantity; ?></td>
                                    <td>$<?php echo $product['price']; ?></td>
                                    <td>$<?php echo $subtotal; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <a href="index.php" class="btn btn-primary">Continue Shopping</a>
                </div>
            </div>
        </section>
        <!-- end confirmation section -->
        
        <!-- footer section (identique) -->
    </div>
    
    <!-- scripts (identique) -->
</body>
</html>