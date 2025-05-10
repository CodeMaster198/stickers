<!DOCTYPE html>
<html>
   <?php require_once 'config.php'; ?>
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
        <!-- ... -->
        <section class="slider_section ">
            <div class="slider_bg_box">
               <img src="images/pc stickers.png" alt="">
            </div>
            <div id="customCarousel1" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <div class="container ">
                        <div class="row">
                           <div class="col-md-7 col-lg-6 ">
                              <div class="detail-box">
                                <BR>
                                <BR>

                                <BR>                                <BR>


                                 <h1>
                                    <span>
                                    مع ملصقاتنا دلال ما  يوفاش
                                    
                                    </span>
                                    <br>
                                    <br>
                                    On Everything
                                    <br><br>
                               <span> 20% Promo</span>
                               </h1>
                                 <br>
                                 <div class="btn-box">
                                    <a href="" class="btn1">
                                    Shop Now
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
             
               </div>
               <div class="container">
                  <ol class="carousel-indicators">
                     <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
                     <li data-target="#customCarousel1" data-slide-to="1"></li>
                     <li data-target="#customCarousel1" data-slide-to="2"></li>
                  </ol>
               </div>
            </div>
         </section>
         <br>   <br>   <br>
         <div class="heading_container heading_center" >
                    <h2>Nos <span>Promos</span></h2>
                </div>
        <!-- product section -->
      <section class="why_section layout_padding">
         <div class="container">
         <div class="heading_container heading_center">
         </div>
         <div class="row">
            <div class="col-md-4">
            <div class="box">
               <h1>
               <div class="img-box">
               <a href="page100.php">
                  <img src="images/100stickers.png" alt="100 Stickers Aléatoires" style="font-weight: 700; color: #f7444e;">
                
               </a>
               </div>
      </h1>
               <div class="detail-box">
               </div>
            </div>
            </div>
            <div class="col-md-4">
            <div class="box">
            <h1>
               <div class="img-box">
               <a href="page250.php">
                  <img src="images/250stickers.png" alt="250 Stickers Aléatoires"  style="font-weight: 700; color:#f7444e;">
               </a>
               </div>
      </h1>
            
            </div>
            </div>
            <div class="col-md-4">
            <div class="box">
               <h1>
               <div class="img-box">
               <a href="page500.php">
                  <img src="images/500stickers.png" alt="500 Stickers Aléatoires"  style="font-weight: 700; color:#f7444e;">
               </a>
               </div>
      </h1>
            
            </div>
            </div>
         </div>
         </div>
      </section>
        <section class="product_section layout_padding">
            <div class="container">
                <div class="heading_container heading_center">
                    <h2>Produits <span>Populaires</span></h2>
                </div>
                <div class="row">
                <?php
    $count = 0;
    foreach ($products as $id => $product):
        if ($count >= 6) break;
        $count++;
    ?>
                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="box">
                            <div class="option_container">
                                <div class="options">
                                    <form method="post" action="">
                                        <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                        <input type="hidden" name="add_to_cart" value="1">
                                        <button type="submit" class="option1">Add To Cart</button>
                                    </form>
                                    <form method="post" action="cart.php" style="display: inline;">
                                        <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                        <input type="hidden" name="add_to_cart" value="1">
                                        <button type="submit" class="option2">Buy Now</button>
                                    </form>
                                </div>
                            </div>
                            <div class="img-box">
                                <img src="<?php echo $product['image']; ?>" alt="">
                            </div>
                            <div class="detail-box">
                                <h5><?php echo $product['name']; ?></h5>
                                <h6>
  <?php echo $product['price']; ?> DT 
  <span style="margin-left: 10px; color: grey;">
    <del>1.200 DT</del>
  </span>
</h6>                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="btn-box">
                    <a href="">View All products</a>
                </div>
            </div>
        </section>
         <!-- end slider section -->
      </div>
      <!-- why section -->
  
      <!-- end why section -->
      
      <!-- arrival section -->
      <section class="arrival_section">
         <div class="container">
            <div class="box">
               <div class="arrival_bg_box">
               </div>
               <div class="row">
                  <div class="col-md-6 ml-auto">
                     <div class="heading_container remove_line_bt">
                        <h2 style="color:white">
                           1000 CHOIX
                        </h2>
                     </div>
                     <p style="margin-top: 20px;margin-bottom: 30px; color:white">
                       On vous garantie choix de stickers avec une impression haute chaute qualité chez <b>moustachio</b> </p>
                     <a href="">
                     Shop Now
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end arrival section -->
      
      <!-- product section -->
  
      <!-- end product section -->

      <!-- subscribe section -->
      <section class="subscribe_section">
         <div class="container-fuild">
            <div class="box">
               <div class="row">
                  <div class="col-md-6 offset-md-3">
                     <div class="subscribe_form ">
                        <div class="heading_container heading_center">
                           <h3>Subscribe To Get Discount Offers</h3>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
                        <form action="">
                           <input type="email" placeholder="Enter your email">
                           <button>
                           subscribe
                           </button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end subscribe section -->
      <!-- client section -->
      <section class="client_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  Customer's Testimonial
               </h2>
            </div>
            <div id="carouselExample3Controls" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <div class="box col-lg-10 mx-auto">
                        <div class="img_container">
                           <div class="img-box">
                              <div class="img_box-inner">
                                 <img src="images/client3.jpeg" alt="">
                              </div>
                           </div>
                        </div>
                        <div class="detail-box">
                           <h5>
                              Maryem Hedhli
                           </h5>
                           <h6>
                              Client 
                           </h6>
                           <p>
                             3ejbetni lqualité yesser tayara wlivraison rapide ya3tikom sa7a 
    </p>
    <div class="stars">
                         <i class="fa fa-star" style="color: gold;"></i>
                         <i class="fa fa-star" style="color: gold;"></i>
                         <i class="fa fa-star" style="color: gold;"></i>
                         <i class="fa fa-star" style="color: gold;"></i>
                         <i class="fa fa-star" style="color: gold;"></i>
                        </div>

                        </div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="box col-lg-10 mx-auto">
                        <div class="img_container">
                           <div class="img-box">
                              <div class="img_box-inner">
                                 <img src="images/enfant1.jpeg" alt="">
                              </div>
                           </div>
                        </div>
                        <div class="detail-box">
                           <h5>
                             Ahmed Khelifa
                           </h5>
                           <h6>
                              Client
                           </h6>
                           <p>
                              qualité exceptionnelle !! </p>
                              <div class="stars">
                         <i class="fa fa-star" style="color: gold;"></i>
                         <i class="fa fa-star" style="color: gold;"></i>
                         <i class="fa fa-star" style="color: gold;"></i>
                         <i class="fa fa-star" style="color: gold;"></i>
                         <i class="fa fa-star" style="color: gold;"></i>
                        </div>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="box col-lg-10 mx-auto">
                        <div class="img_container">
                           <div class="img-box">
                              <div class="img_box-inner">
                                 <img src="images/client2.jpg" alt="">
                              </div>
                           </div>
                        </div>
                        <div class="detail-box">
                           <h5>
                              Ons Belkoudja
                           </h5>
                           <h6>
                              Client
                           </h6>
                           <p>
                              barcha choix haja yesser mezyena zidoulna fi chakira et merci
                           </p>
                           <div class="stars">
                         <i class="fa fa-star" style="color: gold;"></i>
                         <i class="fa fa-star" style="color: gold;"></i>
                         <i class="fa fa-star" style="color: gold;"></i>
                         <i class="fa fa-star" style="color: gold;"></i>
                         <i class="fa fa-star" style="color: gold;"></i>
                        </div>
                        </div>
                        
                     </div>
                  </div>
               </div>
               <div class="carousel_btn_box">
                  <a class="carousel-control-prev" href="#carouselExample3Controls" role="button" data-slide="prev">
                  <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                  <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExample3Controls" role="button" data-slide="next">
                  <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                  <span class="sr-only">Next</span>
                  </a>
               </div>
            </div>
         </div>
      </section>
      <!-- end client section -->
      <!-- footer start -->
      <footer>
         <div class="container">
            <div class="row">
               <div class="col-md-4">
                   <div class="full">
                      <div class="logo_footer">
                        <a href="#"><img width="210" src="images/logo.png" alt="#" /></a>
                      </div>
                      <div class="information_f">
                        <p><strong>ADDRESS:</strong> 21,Cité Bougatfa,Ezzahrouni;Tunis</p>
                        <p><strong>TELEPHONE:</strong> +216 56 885 263</p>
                        <p><strong>EMAIL:</strong> rochdi-dreams2@hotmail.fr</p>
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
                           <li><a href="#">Home</a></li>
                           <li><a href="#">About</a></li>
                           <li><a href="#">Services</a></li>
                           <li><a href="#">Testimonial</a></li>
                           <li><a href="#">Blog</a></li>
                           <li><a href="#">Contact</a></li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="widget_menu">
                        <h3>Account</h3>
                        <ul>
                           <li><a href="#">Account</a></li>
                           <li><a href="#">Checkout</a></li>
                           <li><a href="#">Login</a></li>
                           <li><a href="#">Register</a></li>
                           <li><a href="#">Shopping</a></li>
                           <li><a href="#">Widget</a></li>
                        </ul>
                     </div>
                  </div>
                     </div>
                  </div>     
                  <div class="col-md-5">
                     <div class="widget_menu">
                        <h3>Newsletter</h3>
                        <div class="information_f">
                          <p>Subscribe by our newsletter and get update protidin.</p>
                        </div>
                        <div class="form_sub">
                           <form>
                              <fieldset>
                                 <div class="field">
                                    <input type="email" placeholder="Enter Your Mail" name="email" />
                                    <input type="submit" value="Subscribe" />
                                 </div>
                              </fieldset>
                           </form>
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