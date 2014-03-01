
<!DOCTYPE html>
<?php

    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $login_page = '../html/login.html';


    session_start();
    if (!$_SESSION["user_id"]) {
      header("Location: http://$host$uri/$login_page");
    }

?>
<html>
  <head>
    <title>Home - Zappo's Price Notify</title>
    <link rel="shortcut icon" href="../img/PN_Favicon.ico" >

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">


     <link href="../css/custom_stylesheet.css" rel="stylesheet" media="screen"> 
     <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>


     <script type="text/javascript">
    document.write("\<script src='//ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js' type='text/javascript'>\<\/script>");
    </script>


  </head>
  <body>
 

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">

  <div class ="row">
    <div class = "col-md-5 col-md-offset-1">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a href="./home_page.php"><img class = "logo" src="../img/PN_Logo.png" alt="Logo Here"> </a>
          </div>
     </div>

  <div class = "col-md-6">
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <ul class="nav navbar-nav">
        <li><a href="./home_page.php"><span class = "navbarfont">HOME</span></a></li>
        <li><a href="./about.php"><span class = "navbarfont">ABOUT</span></a></li>
        <li class = "active"><a href="./watchList.php"><span class = "navbarfont">MY LIST</span></a></li>
        <li><a href="./logout.php"><span class = "navbarfont">LOG OUT</span></a></li>
      </ul>
    </div>
    </div>
  </div>
</nav>


<div class = "watch_list">
	<div class="row">
		<div class="text-center">
			<h2> Items On Your Price Watch List </h2>
			<br>
		</div>
	</div>

<?php



	require 'database.php';

  

  
	$stmt = $mysqli->prepare("SELECT watch_id, sku, orig_price, item_name, image_url, zappos_url FROM watches WHERE user_id='".$_SESSION['user_id']."'");
		if(!$stmt){
			printf("Query Prep Failed: %s\n", $mysqli->error);
			exit;
		}
		 
		$stmt->execute();
		//bind results of query to the following parameters
		 
		$stmt->bind_result( $watch_id, $sku, $orig_price, $item_name, $image_url, $zappos_url);


		echo"<div class = 'row'>";

		while($stmt->fetch()){
			echo"<div class = 'col-md-2 col-md-offset-1 col-sm-3 col-sm-offset2 col-xs-5 col-xs-offset-4'>";
		
			?>

				<img src=<?php echo $image_url?> alt='thumbnail'> 
				<br> 
				<h4><?php echo htmlentities($item_name)?></h4>
				Original Price: $<?php echo htmlentities($orig_price)?><br>
				SKU: <?php echo htmlentities($sku)?><br><br>


				<form action=<?php echo($zappos_url)?>>
				    <input type="submit" value="Item on zappos.com" class = "btn btn-default">
				</form>
			
			<form method="POST" action="./deleteWatch.php">
				 <input type="hidden" name="watch_id" value="<?php echo htmlspecialchars($watch_id); ?>">
				 <input type="submit" value="Delete" class="btn btn-delete">
			</form>
			<br> 

            </div>
			<?php	

		}

		?>
	</div>
	
		<?
		 
		$stmt->close();

?>

</div>
