<?php 
    include_once 'include/autoloader.inc.php';
    include_once 'include/startSession.php';
    include_once 'classes/productview.php';
    include_once 'classes/settingsView.php';
    $productView = new ProductView();
    $categoriesObj = new CategoriesView();
    $productIds = $productView->getAllShowcaseProducts();
    $frontPageProducts = $productView->getAllProductsOfId($productIds);
    $settingsView = new SettingsView();
    $settings = json_decode($settingsView->viewAllSettings());
    $headCategories = $categoriesObj->getAllHeadCategories();
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Forside | <?= $settings->websiteName ?></title>
    <meta name="description" content="Velkommen til FancyClothes.dk">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Find our collection entire online here and find the right Lifewear to suit your style">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Karla|Lato|Oswald" rel="stylesheet">

    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/slider.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <?php include 'include/nav.inc.php' ?>
    <div class="container">
        <ul class="slider" id="slider">
            <li><img src="img/slide1.jpg" alt=""></li>
            <li><img src="img/slide2.jpg" alt=""></li>
            <li><img src="img/slide3.jpg" alt=""></li>
        </ul>
    </div>
    <hr class="hide400">
    <h1 class="tagline"><?= $settings->websiteName ?> - <?= $settings->slogan ?></h1>
    <hr>

    </div>
    <main class="container">
        <aside>
            <div class="categories">
                <div class="catTop">
                    <h4>Kategorier:</h4>
                </div>
                <div class="catMain">
                    <ul>
                        <?php 
                            $categoriesObj->listCategories();
                        ?>
                    </ul>
                </div>
            </div>

            <div class="newsletter">
                <div class="newsTop">
                    <h4>Tilmeld nyhedsbrev</h4>
                </div>
                <div class="newsMain">
                    <form action="">
                        <input type="text" placeholder="Navn">
                        <input type="email" placeholder="Email">
                </div>
                <div class="newsBottom">
                    <input type="submit" value="Tilmeld">
                    </form>
                </div>
            </div>
        </aside>
        <div class="products">
            <h3>INSPIRATION</h3>
            <hr>
            <div class="inspiration">
            <?php foreach ($headCategories as $headCategory) {?>
                    <div class="frontpageHeadCategory headCategory">
                        <img src="uploads/<?= $headCategory['icon'] ?>" alt="">
                        <h5><?= $headCategory['name'] ?></h5>
                        <div class="action">
                            <a href="products.php?category=0&mainCategory=<?= $headCategory['id'] ?>" class="newHeadBtn">Se mere<span style="display: none;"><?= $headCategory['id'] ?></span></a>
                        </div>
                    </div>  
               <?php } ?>
            </div>
            <div id="multi-item-example" class="carousel slide carousel-multi-item col-12" data-ride="carousel">
            <!--Slides-->
            <div class="carousel-inner" role="listbox">

                <!--First slide-->
                <div class="carousel-item active">
                    <div class="row">
                    <?php for ($i=0; $i < 3; $i++) { ?>
                        <div class="col-md-4">
                            <div class="card mb-2">
                                <a href="product.php?id=<?= $frontPageProducts[$i]['id'] ?>">
                                <img id="frontPageProductImg" src="uploads/<?= $frontPageProducts[$i]['img'] ?>" alt="Card image cap">
                                </a>
                                <div class="card-body">
                                    <h5><?= $frontPageProducts[$i]['name'] ?></h5>
                                    <p class="card-text"><?= $frontPageProducts[$i]['price']?>.99 DKK</p>
                                    <a class="btn" id="addToCart" href="#">Add to cart</a>
                                </div>
                            </div>
                        </div>
                        <?php  }?>
                    </div>
                </div>
                <!--/.First slide-->

                <!--Second slide-->
                <div class="carousel-item">
                    <div class="row">
                    <?php for ($i=3; $i < 6; $i++) { ?>
                        <div class="col-md-4">
                            <div class="card mb-2">
                                <a href="product.php?id=<?= str_replace("/customers/5/f/4/christianvillads.tech/httpd.www/opgaver/V31_OOP/", "", $frontPageProducts[$i]['img']) ?>">
                                <img  id="frontPageProductImg" src="<?= $frontPageProducts[$i]['img'] ?>" alt="Card image cap">
                                </a>
                                <div class="card-body">
                                    <h5><?= $frontPageProducts[$i]['name'] ?></h5>
                                    <p class="card-text"><?= $frontPageProducts[$i]['price'] ?>.99 DKK</p>
                                    <a class="btn" id="addToCart" href="#">Add to cart</a>
                                </div>
                            </div>
                        </div>
                        <?php  }?>
                    </div>

                </div>
                <!--/.Second slide-->
            </div>
            <!--/.Slides-->
            <!--Indicators-->
            <ol class="carousel-indicators my-3" id="bestSellersIndicator">
                <li data-target="#multi-item-example" data-slide-to="0" class="active"></li>
                <li data-target="#multi-item-example" data-slide-to="1"></li>
            </ol>
            <!--/.Indicators-->
        </div>
        <div id="multi-item-example2" class="carousel slide carousel-multi-item col-12" data-ride="carousel">
            <!--Slides-->
            <div class="carousel-inner mb-5" role="listbox">

                <!--First slide-->
                <div class="carousel-item active">
                    <div class="row">
                    <?php for ($i=6; $i < 9; $i++) { ?>
                        <div class="col-md-4">
                            <div class="card mb-2">
                                <a href="product.php?id=<?= $frontPageProducts[$i]['id'] ?>">
                                <img id="frontPageProductImg" src="<?= str_replace("/customers/5/f/4/christianvillads.tech/httpd.www/opgaver/V31_OOP/", "", $frontPageProducts[$i]['img']) ?>" alt="Card image cap">
                                </a>
                                <div class="card-body">
                                    <h5><?= $frontPageProducts[$i]['name'] ?></h5>
                                    <p class="card-text"><?= $frontPageProducts[$i]['price']?>.99 DKK</p>
                                    <a class="btn" id="addToCart" href="#">Add to cart</a>
                                </div>
                            </div>
                        </div>
                        <?php  }?>
                    </div>
                </div>
                <!--/.First slide-->

                <!--Second slide-->
                <div class="carousel-item">
                    <div class="row">
                    <?php for ($i=9; $i < 12; $i++) { ?>
                        <div class="col-md-4">
                            <div class="card mb-2">
                                <a href="product.php?id=<?= $frontPageProducts[$i]['id'] ?>">
                                <img  id="frontPageProductImg" src="<?= str_replace("/customers/5/f/4/christianvillads.tech/httpd.www/opgaver/V31_OOP/", "", $frontPageProducts[$i]['img']) ?>" alt="Card image cap">
                                </a>
                                <div class="card-body">
                                    <h5><?= $frontPageProducts[$i]['name'] ?></h5>
                                    <p class="card-text"><?= $frontPageProducts[$i]['price'] ?>.99 DKK</p>
                                    <a class="btn" id="addToCart" href="#">Add to cart</a>
                                </div>
                            </div>
                        </div>
                        <?php  }?>
                    </div>

                </div>
                <!--/.Second slide-->
            </div>
            <!--/.Slides-->
            <!--Indicators-->
            <ol class="carousel-indicators" id="bestSellersIndicator">
                <li data-target="#multi-item-example2" data-slide-to="0" class="active"></li>
                <li data-target="#multi-item-example2" data-slide-to="1"></li>
            </ol>
            <!--/.Indicators-->
        </div>
        </div>
    </main>
    <hr>
    <footer>
        <div class="contact container">
            <ul>
                <li class="bold"><?= $settings->websiteName ?></li>
                <li><?= $settings->address ?></li>
                <li><?= $settings->email ?></li>
                <li>Sitemap</li>
            </ul>
            <div class="social">
                <i class="fa fa-facebook-square" aria-hidden="true"></i>
                <i class="fa fa-twitter-square" aria-hidden="true"></i>
                <i class="fa fa-youtube-square" aria-hidden="true"></i>
            </div>
        </div>
    </footer>

    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
            <![endif]-->

    <!-- Add your site or application content here -->

    <script>
		$(".login form").submit(function(event) {
			event.preventDefault();
			var form = $(this);
			var url = form.attr('action');
			$.ajax({
				type: "POST",
				url: url,
				data: form.serialize(),
				success: function(data) {
					if (data.toLowerCase().includes("success")) {
						window.location.href = "index.php";
					} else {
						$(".loginmsg").text(data);
					}
				}
			});
		});
    </script>
    
    <script>
        window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')
    </script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/plugins.js"></script>
    <script src="js/navSearchBar.js"></script>
    <script src="js/slider.min.js"></script>
    <script>
        $(window).on("load", function() {
            $("#slider").slider();
        });
    </script>
    <script>
      $(".register form").submit(function (event) {
        event.preventDefault();
        var form = $(this);
        var url = form.attr("action");
        $.ajax({
          type: "POST",
          url: url,
          data: form.serialize(),
          success: function (data) {
            $(".registermsg").text(data);
          },
        });
      });
    </script>
        <script src="js/myScript.js"></script>

</body>

</html>