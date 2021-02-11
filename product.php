<?php
include_once 'include/startSession.php';
include_once 'classes/productview.php';
include_once 'classes/accountview.class.php';
include_once 'include/nav.inc.php';
$currentProduct[] = $_GET['id'];
$productView = new ProductView();
$productInfo = $productView->getAllProductsOfId($currentProduct);
$recommendedProducts = $productView->getRandomProduct($productInfo[0]['type']);
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
</head>

<body>
    <main class="d-flex justify-content-center">
        <div class=" shadow col-7 pt-5 mt-5" style="background-color: ghostWhite; min-height: 100vh">
                <div class="d-flex flex-wrap mt-4">
                    <div class="border-bottom w-100"></div>
                    <div class="w-100">
                        <div>
                            <h3 class="m-3"><?= $productInfo[0]['name']?></h3>
                            <h5 class=" ml-3 text-secondary"><?= $productInfo[0]['manufactur']?></h5>
                            <p class=" ml-3 text-secondary"><?= $productInfo[0]['manufactur'] . $productInfo[0]['id'] . $productInfo[0]['dateCreated'] ."-". $productInfo[0]['createdBy']?></p>
                        </div>
                        <div class="d-flex justify-content-between w-100">
                            <img class="ml-3" id="productImg" src="<?php echo str_replace("/customers/5/f/4/christianvillads.tech/httpd.www/opgaver/V31_OOP/", "", $productInfo[0]['img']);  ?>">
                            <div id="productBuyMenu" class="col-4 rounded">
                                <h4 class="m-2"><?= $productInfo[0]['price'] ?>.99 DKK</h4>
                                <p class="rounded">FREE SHIPPING</p>
                                <p><i class="fas fa-check"></i>30 day open purchase</p>
                                <p><i class="fas fa-check"></i>Free return</p>
                                <p><i class="fas fa-check"></i>Free shipping</p>
                                <button class="btn mt-5">ADD TO CART</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mx-3">
                    <h5 class="text-light p-1 mt-5" style="background-color: #333">Description</h5>
                    <div class="w-100 border">
                        <p><?= $productInfo[0]['description']?></p>
                    </div>
                </div>
                <div class="mx-3 mt-5">
                <div id="multi-item-example" class="carousel slide carousel-multi-item" data-ride="carousel">
            <!--Slides-->
            <div class="carousel-inner" role="listbox">

                <!--First slide-->
                <div class="carousel-item active">
                    <div class="row">
                       <?php for ($i=0; $i < 3; $i++) { ?>
                        <div class="col-md-4">
                            <div class="card mb-2">
                                <a href="product.php?id=<?= $recommendedProducts[$i]['id'] ?>">
                                <img id="frontPageProductImg" src="<?php echo str_replace("/customers/5/f/4/christianvillads.tech/httpd.www/opgaver/V31_OOP/", "", $recommendedProducts[$i]['img']);  ?>" alt="Card image cap">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title"><?= $recommendedProducts[$i]['name'] ?></h5>
                                    <p class="card-text"><?= $recommendedProducts[$i]['price']?>.99 DKK</p>
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
                                <a href="product.php?id=<?= $recommendedProducts[$i]['id'] ?>">
                                <img  id="frontPageProductImg" src="<?php echo str_replace("/customers/5/f/4/christianvillads.tech/httpd.www/opgaver/V31_OOP/", "", $recommendedProducts[$i]['img']);  ?>" alt="Card image cap">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title"><?= $recommendedProducts[$i]['name'] ?></h5>
                                    <p class="card-text"><?= $recommendedProducts[$i]['price']?>.99 DKK</p>
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
        <!--/.Carousel Wrapper-->
        
            </div>
        </div>
    </main>
    
    <footer>

    </footer>
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
    <script src="js/plugins.js"></script>
    <script src="js/navSearchBar.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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