<?php
include('C:\wamp\www\Project\home_page\connect.php');
@session_start();
//echo '<script> setTimeout(function(){window.location.reload();},5000);</script>'
//global $conn;
echo "<script>window.alert('welcome')</script>";
$email = $_COOKIE["email"];
$query = "select * from user_template where t_id = 2 and user_id in (select user_id from user_custom where email = '$email')";
$res = pg_query($conn,$query);
$web = pg_fetch_assoc($res); 

//$mssg = '<script>window.alert('search')</script>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/about_us.css">
<?php
$img = $web["web_img"];
    echo "
    <style>
    .about-section{
        background: url(../public/img/$img) no-repeat left;
        background-size: 55%;
        background-color: #fdfdfd;
        overflow: hidden;
        padding: 100px 0;
    }
    </style>
    ";

?>

</head>
<body>
    <header>
        <div class="logo"><a href="index.php"><?php echo $web["web_name"]; ?></a></div>
        <div class="search">
    
          <input type="text" placeholder="search products" id="input">
        </div>

        <div class="heading">
          <ul>
            <li><a href="index.php" class="under">HOME</a></li>
              <li><a href="product.php" class="under">OUR PRODUCTS</a></li>
              <li><a href="about_us.php" class="under">ABOUT US</a></li>
              <li><a href="cart.php" class="under">CART</a></li>
          </ul>
        </div>
        <div class="heading1">
          <ion-icon name="menu" class="ham"></ion-icon>
        </div>
      </header>

      <div class="about-section" style="margin-top:0; margin-bottom:0px;">
        <div class="inner-container">
          <h1>About Us</h1>
          <p class="text">
           <?php echo $web["about_us"]; ?>
          </p>
          <div class="skills">
            <span><?php echo $web["feat1"]; ?></span>
            <span><?php echo $web["feat2"]; ?></span>
            <span><?php echo $web["feat3"]; ?></span>
          </div>
        </div>
      </div>
      <footer>
        <div class="footer0">
          <h1>ShoPperZ</h1>
        </div>
        <!--<div class="footer2">
          <div class="product">
            <div class="heading">Products</div>
            <div class="div">Sell your Products</div>
            <div class="div">Advertise</div>
            <div class="div">Pricing</div>
            <div class="div">Product Buisness</div>
    
          </div>
          <div class="services">
            <div class="heading">Services</div>
            <div class="div">Return</div>
            <div class="div">Cash Back</div>
            <div class="div">Affiliate Marketing</div>
            <div class="div">Others</div>
          </div>
          <div class="Company">
            <div class="heading">Company</div>
            <div class="div">Complaint</div>
            <div class="div">Careers</div>
            <div class="div">Affiliate Marketing</div>
            <div class="div">Support</div>
          </div>
          <div class="Get Help">
            <div class="heading">Get Help</div>
            <div class="div">Help Center</div>
            <div class="div">Privacy Policy</div>
            <div class="div">Terms</div>
            <div class="div">Login</div>
          </div>
        </div>-->
        <div class="footer3">Copyright © <h4>ShoPperZ</h4> 2021-2028</div>
      </footer>
    
    
</body>
</html>