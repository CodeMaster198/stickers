<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Moustachio</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="css/responsive.css" rel="stylesheet" />
   </head>
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
    .header {
    background-color: #fff;
    padding: 10px;
    border: 1px solid #ddd;
    font-size: 14px;
  }

  /* Conteneur principal */
  .container {
    display: flex;
    flex-direction: row;
    margin-top: 20px;
  }

  /* Partie gauche: image ou logo */
  .left {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  /* Cercle rouge avec texte */
  .circle {
    width: 300px;
    height: 300px;
    background-color: red;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 24px;
    font-weight: bold;
    text-align: center;
    padding: 20px;
  }

  /* Partie droite: détails du produit */
  .right {
    flex: 1;
    padding: 20px;
  }

  /* Titre du produit */
  .title {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 10px;
  }

  /* Étoiles de notation */
  .stars {
    color: #ffa500; /* orange pour étoiles */
    margin-bottom: 10px;
  }

  /* Prix original barré */
  .original-price {
    text-decoration: line-through;
    color: #888;
    margin-right: 10px;
  }

  /* Prix actuel */
  .price {
    font-size: 18px;
    color: #000;
    font-weight: bold;
  }

  /* Description */
  .description {
    margin-top: 20px;
  }

  /* Section pour ajouter au panier */
  .add-to-cart {
    margin-top: 20px;
  }

  /* Bouton */
  button {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    font-size: 16px;
    border-radius: 4px;
  }

  button:hover {
    background-color: #0056b3;
  }

  /* Catégorie */
  .category {
    margin-top: 10px;
    font-style: italic;
  }
</style>
</style>
<?php
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

// Traitement des actions du panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    addToCart($productId);
    // Redirection pour éviter la resoumission du formulaire
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Simuler une base de données de produits
$products = [
    'p1' => ['name' => "Palestine", 'price' => 1.000, 'image' => 'images/p1.png'],
    'p2' => ['name' => "Nasa Sticker", 'price' => 1.000, 'image' => 'images/p2.png'],
    'p3' => ['name' => "Spongebob", 'price' => 1.000, 'image' => 'images/p3.png'],
    'p4' => ['name' => "Phone", 'price' => 1.000, 'image' => 'images/p4.png'],
    'p5' => ['name' => "Laptob", 'price' => 1.000, 'image' => 'images/p5.png'],
    'p6' => ['name' => "Wukong", 'price' => 1.000, 'image' => 'images/p6.png'],
    'p7' => ['name' => "Women's Dress", 'price' => 1.000, 'image' => 'images/p7.png'],
    'p8' => ['name' => "Men's Shirt", 'price' => 1.000, 'image' => 'images/p8.png'],
    'p9' => ['name' => "Men's Shirt", 'price' => 1.000, 'image' => 'images/p9.png'],
    'p10' => ['name' => "Men's Shirt", 'price' => 1.000, 'image' => 'images/p10.png'],
    'p11' => ['name' => "Men's Shirt", 'price' => 1.000, 'image' => 'images/p11.png'],
    'p12' => ['name' => "Women's Dress", 'price' => 1.000, 'image' => 'images/p12.png'],
    'p13' => ['name' => "500 random stickers", 'price' => 99.000, 'image' => 'images/stickes1.jpg']

];
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = intval($_POST['quantity']); // Assurez que c'est un entier

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Moustashio </title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
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
                    <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Pages <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="about.html">About</a></li>
                        <li><a href="testimonial.html">Testimonial</a></li>
                    </ul>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="product.html">Products</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="blog_list.html">Blog</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="contact.html">Contact</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="cart.php">
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                        <g>
                            <g>
                            <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                                c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                            </g>
                        </g>
                        <g>
                            <g>
                            <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                                C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                                c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                                C457.728,97.71,450.56,86.958,439.296,84.91z" />
                            </g>
                        </g>
                        <g>
                            <g>
                            <path d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                                c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                            </g>
                        </g>
                        </svg>
                        <span class="cart-count">
                        <?php echo array_sum($_SESSION['cart']); ?>
                        </span>
                    </a>
                    </li>
                    <form class="form-inline">
                    <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                    <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                    </form>
                </ul>
                </div>
            </nav>
            </div>
        </header>
       
        <!-- end header section -->
        
        <!-- slider section et autres sections restent identiques -->
     
         <!-- end slider section -->
    <div class="header" style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; border-radius: 4px; font-size: 14px;">
        Total cost of products in cart must be 15,000 or more
    </div>

    <!-- Conteneur principal -->
    <div class="container" style="margin-top:100px">
        <!-- Partie gauche avec cercle -->
        <div class="left">
            <div class="circle" style="background-image: url('images/stickes1.jpg'); background-size: cover; background-position: center; color: transparent; width: 400px; height: 400px; font-size: 32px;">
            500 RANDOM STICKERS
            </div>
        </div>
        <!-- Partie droite avec détails -->
        <div class="right" style="font-size: 20px;">
            <div class="title" style="font-size: 28px;">500 random stickers pack</div>
            <div class="stars" style="font-size: 24px;">⭐⭐⭐⭐⭐ (2 avis clients)</div>
            <div>
                <span class="original-price" style="font-size: 22px;">500.000 DT</span>
                <span class="price" style="font-size: 26px;">99.000 DT</span>
            </div>
            <div class="description" style="font-size: 20px;">
                500 random stickers pack contains several random themes.
            </div>
            <div class="category" style="font-size: 18px;">Category: Random Sticker Packs</div>
            <!-- Ajout au panier -->
            <form method="POST" action="">
  <input type="hidden" name="product_id" value="p13" />
  <input type="number" name="quantity" value="1" min="1" style="width: 80px; font-size: 18px;" />
  <button type="submit" name="add_to_cart" style="font-size: 18px;">Ajouter au panier</button>
</form>
            </div>
            
        </div>
        <!-- Section commentaires -->
<div class="comments-section" style="margin-top:50px; background-color: #f8f9fa; padding: 30px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); text-align: center;">
    <h3 style="color: #007bff; font-weight: bold;">Avis des clients</h3>

    <!-- Liste des avis existants -->
    <div class="reviews" style="margin-top: 20px;">
        <div class="review" style="margin-bottom: 20px; padding: 15px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
            <p><strong>ahmed slimeni</strong> - 24/06/2023</p>
            <p>Rapport qualité prix, quantite hayfa tayyar Salikhker</p>
            <div class="stars" style="color: #ffa500;">⭐⭐⭐⭐⭐</div>
        </div>
        <div class="review" style="margin-bottom: 20px; padding: 15px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
            <p><strong>zayneb belhadi</strong> - 26/06/2023</p>
            <p>weshow fi 3 amayn zyemith bihom boti i kki lol and i m'in love</p>
            <div class="stars" style="color: #ffa500;">⭐⭐⭐⭐⭐</div>
        </div>
    </div>

    <!-- Formulaire pour ajouter un avis -->
    <div style="margin-top:30px; border-top:1px solid #ccc; padding-top:20px;">
        <h4 style="color: #007bff; font-weight: bold;">Ajouter un Avis</h4>
        <form method="POST" action="#comments" class="comment-form" style="text-align: left; max-width: 600px; margin: 0 auto;">
            <p style="font-style: italic; color: #555;">Votre adresse e-mail ne sera pas publiée. Les champs obligatoires sont indiqués avec *</p>
            <label for="name" style="font-weight: bold;">Nom :</label><br>
            <input type="text" id="name" name="name" required style="width: 100%; margin-bottom:10px; padding: 10px; border-radius: 4px; border: 1px solid #ccc;"><br>

            <label for="email" style="font-weight: bold;">E-mail * :</label><br>
            <input type="email" id="email" name="email" required style="width: 100%; margin-bottom:10px; padding: 10px; border-radius: 4px; border: 1px solid #ccc;"><br>

            <label for="note" style="font-weight: bold;">Votre note * :</label><br>
            <select id="note" name="note" required style="width: 100%; margin-bottom:10px; padding: 10px; border-radius: 4px; border: 1px solid #ccc;">
                <option value="">Sélectionnez une note</option>
                <option value="5">5 étoiles</option>
                <option value="4">4 étoiles</option>
                <option value="3">3 étoiles</option>
                <option value="2">2 étoiles</option>
                <option value="1">1 étoile</option>
            </select>

            <label for="avis" style="font-weight: bold;">Votre avis :</label><br>
            <textarea id="avis" name="avis" rows="4" required style="width: 100%; margin-bottom:10px; padding: 10px; border-radius: 4px; border: 1px solid #ccc;"></textarea><br>

            <button type="submit" name="submit_review" style="background-color:#007bff; color:#fff; padding:10px 20px; border:none; border-radius:4px; font-weight: bold;">Soumettre</button>
        </form>
    </div>
    <div class="products-container">
        <div class="product-card">
            <div class="product-name">100 BANDON STICKERS</div>
            <div class="product-description">100 autocollants de qualité premium</div>
            <div class="product-price">4.00€ - 4.49€</div>
            <button class="add-to-cart">Ajouter au panier</button>
        </div>
        
        <div class="product-card">
            <div class="product-name">500 BANDON STICKERS</div>
            <div class="product-description">500 autocollants de qualité premium</div>
            <div class="product-price">4.00€ - 4.79€</div>
            <button class="add-to-cart">Ajouter au panier</button>
        </div>
    </div>
</div>

</div>

    </div>

</body>
     
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