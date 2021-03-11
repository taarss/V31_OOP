<?php 
    include_once 'include/autoloader.inc.php';
    include_once 'include/startSession.php';
    include_once 'classes/settingsView.php';
    $settingsView = new SettingsView();
    $settings = json_decode($settingsView->viewAllSettings());
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Analytics | <?= $settings->websiteName ?></title>
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
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <?php include 'include/nav.inc.php' ?>

    <main class="container row justify-content-between">
        <div>
            <h3 class="text-center">Most freqeuntly viewed products</h3>
            <div class="chart-container" style="position: relative; height:400px; width:470px">
                <canvas id="myChart" style="height:100%; width:100%"></canvas>
            </div>
        </div>
        <div>
            <h3 class="text-center">Frequent visitor location</h3>
            <div class="border locationTable" style="position: relative; height:400px; width:470px">
                
            </div>
        </div>

    </main>
    

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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/plugins.js"></script>
    <script src="js/checkLocation.js"></script>
    <script src="js/navSearchBar.js"></script>
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
   <script>
    $(document).ready(function() {
   $.ajax({
      url: "include/ajaxCall.inc.php",
      method: "POST",
      data: {
            "getFrequentProducts": 1,
        },
      success: function(data) {
         var objData = JSON.parse(data);
         console.log(objData);
         var labels = [];
         var efficiency = [];
         var coloR = [];

         var dynamicColors = function() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgb(" + r + "," + g + "," + b + ")";
         };

         objData.forEach(element => {
            labels.push("Product id: " + element['product_id']);
            efficiency.push(element['value_occurrence']);
            coloR.push(dynamicColors());
         });
         var chartData = {

            labels: labels,
            datasets: [{
               label: 'Efficiency ',
               //strokeColor:backGround,

               backgroundColor: coloR,

               borderColor: 'rgba(200, 200, 200, 0.75)',
               //hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
               hoverBorderColor: 'rgba(200, 200, 200, 1)',
               data: efficiency
            }]
         };

         var ctx = $("#myChart");
         var barGraph = new Chart(ctx, {
            type: 'pie',
            data: chartData
         })
      },
      error: function(data) {

         console.log(data);
      },
   });
});
    </script>
    <script>
        $.ajax({
        type: "POST",
        url: 'include/ajaxCall.inc.php',
        data: {
            "getFrequentVisitors": 1,
        },
        success: function(data) {
            console.log(data);
            var objData = JSON.parse(data);
            objData.forEach(element => {
                let div = document.createElement("div");
                let location = document.createElement("p");
                let occurrence = document.createElement("p");
                location.innerHTML = element['region'] + " " + element['city'];
                occurrence.innerHTML = element['value_occurrence'];
                div.appendChild(location);
                div.appendChild(occurrence);
                div.classList.add("locationRow");
                document.querySelector(".locationTable").appendChild(div);
            });
        }
    });
    </script>
    <script src="js/myScript.js"></script>

</body>

</html>