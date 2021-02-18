<?php
    include_once '../classes/crypt.php';
    $key = "5L3yq&@{B*@BG}!6";
    $crypt = new Crypt;
    if (isset($_POST['dbname'])) {
        $myfile = fopen("dbinfo.txt", "w") or die("Unable to open file!");
        $txt = "{$_POST['dbname']} {$_POST['dbhost']} {$_POST['dbusername']} {$_POST['dbpassword']}";
        fwrite($myfile, $crypt->encrypt($txt, $key));
        fclose($myfile);
        $myfile = fopen("dbinfo.txt", "r") or die("Unable to open file!");
        $words = preg_split('/\s+/', $crypt->decrypt(fgets($myfile), $key), -1, PREG_SPLIT_NO_EMPTY);
        include_once 'installBackend.php';
        $installBackend = new Install();
        $installBackend->installBackend();
      }
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Installation</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <?php if (!isset($_POST['dbname'])) {?>
            <form method="post" action="install.php">
            <p>Enter database infomation</p>
            <input name="dbname" type="text" placeholder="database name" required>
            <input name="dbhost" type="text" placeholder="database host" required>
            <input name="dbusername" type="text" placeholder="database username" required>
            <input name="dbpassword" type="text" placeholder="database password" required>
            <input value="Submit" type="submit">
            </form>
        <?php }
        else { ?>
            <form class="regForm" method="post" autocomplete="off">
          <input
            type="text"
            name="username"
            placeholder="Username"
            id="username"
            required
          />
          <input
            type="password"
            name="password"
            placeholder="Password"
            id="password"
            required
          />
          <input
            type="password"
            name="cpassword"
            placeholder="Confirm Password"
            id="cpassword"
            required
          />
          <input
            type="email"
            name="email"
            placeholder="Email"
            id="email"
            required
          />
          <input type="submit" value="Register" />
          <div class="registermsg"></div>
        </form>
        <?php }
        ?>
         <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script>
		$(".regForm").submit(function(event) {
      let name = document.querySelector("#username").value;
			event.preventDefault();
			var form = $(this);
			var url = '../include/register.inc.php';
			$.ajax({
				type: "POST",
				url: url,
				data: form.serialize(),
				success: function(data) {
          console.log(data);       
					$(".registermsg").text("activate your email");
          $.ajax({
            type: "POST",
            url: '../include/ajaxCall.inc.php',
            data: {
              createInitialAdmin: 1,
              adminName: name,
				    },
            success: function(data) {
              let completeBtn = document.createElement("button");
              completeBtn.innerText = "Finish installation";
              completeBtn.addEventListener("click", function(){ 
                
               });
              document.querySelector("form").appendChild(completeBtn);      
            }
          });
				}
			});
		});
    </script>
    </body>
    </html>