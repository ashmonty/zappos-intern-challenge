<!DOCTYPE html>
<html>
  <head>
    <title>Home - Zappo's Price Notify</title>
    <link rel="shortcut icon" href="../img/PN_Favicon.ico" >
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->

     <link href="../css/custom_stylesheet.css" rel="stylesheet" media="screen"> 
     <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>


     <script type="text/javascript">
    document.write("\<script src='//ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js' type='text/javascript'>\<\/script>");
    </script>

  </head>
  <body>
 
<?php

    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $login_page = '../html/login.html';


    session_start();
    if (!$_SESSION["user_id"]) {


      ?>

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
            <a href="../php/home_page.php"><img class = "logo" src="../img/PN_Logo.png" alt="Logo Here"> </a>
          </div>
     </div>

  <div class = "col-md-3 col-md-offset-2">
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <ul class="nav navbar-nav">
        <li><a href="../php/home_page.php"><span class = "navbarfont">HOME</span></a></li>
        <li class="active"><a href="./about.html"><span class = "navbarfont">ABOUT</span></a></li>

      </ul>
    </div>
    </div>
  </div>
</nav>

      <?php
    } else {
      ?>



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
        <li class="active"><a href="./about.php"><span class = "navbarfont">ABOUT</span></a></li>
        <li><a href="./watchList.php"><span class = "navbarfont">MY LIST</span></a></li>
        <li><a href="./logout.php"><span class = "navbarfont">LOG OUT</span></a></li>

      </ul>
    </div>
    </div>
  </div>
</nav>
      <?php
    }

?>


<div class = "about_area">
    <div class = "row">
        <div class ="text-center">
            <h1 > ABOUT PRICE NOTIFY</h1>
            <br>
        </div>

          <div class = "row">
            <div class = "col-md-6 col-md-offset-3">
      
              <h5>Price Notify was created as part of the challenge for the Zappos Family Summer 2014 Mobile Web Front End Development College Intern position
                <br> <br>At Price Notify, you can search for items for sale at zappos.com. If you find an item you like, you can put that item onto your Price Watch List. 
                <br><br>You will be notified via email if any item on your Price Watch List goes on sale for 20% off or more.
                <br><br> Contact applicant Ashley Montgomery at aemontgomery756@gmail.com with questions, comments, or concerns.</h5>
            </div>
          </div>
        <div class = "row">
            <div class = "text-center">
      
              <h4> Thanks for visiting Price Notify! </h4>
            </div>
          </div>


    </div>
</div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//code.jquery.com/jquery.js"></script> 
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap.js"></script>
  </body>
</html>






