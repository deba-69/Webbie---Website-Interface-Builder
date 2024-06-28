<?php
include('C:\wamp\www\Project\home_page\connect.php');
@session_start();
//echo '<script> setTimeout(function(){window.location.reload();},5000);</script>'
//global $conn;
echo "<script>window.alert('welcome')</script>";
$email = $_COOKIE["email"];
$query = "select * from user_template where user_id in (select user_id from user_custom where email = '$email')";
$res = pg_query($conn,$query);
$web = pg_fetch_assoc($res); 

//$mssg = '<script>window.alert('search')</script>';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page HTML</title>
    <link rel="stylesheet" href="css/prod_details.css"/>
    <style>
        header {
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    height: 60px;
    width: 100%;
    background: black;
  }
  .heading ul {
    display: flex;
  }
  .logo a {
    color: white;
    transition-duration: 1s;
    font-weight: 800;
  }
  .logo a:hover {
    color: rgb(240, 197, 6);
    transition-duration: 1s;
  }
  .heading ul li {
    list-style: none;
  }
  .heading ul li a {
    margin: 5px;
    text-decoration: none;
    color: black;
    font-weight: 500;
    position: relative;
    color: white;
    margin: 2px 14px;
    font-size: 18px;
    transition-duration: 1s;
  }
  .heading ul li a:active {
    color: red;
  }
  .heading ul li a:hover {
    color: rgb(243, 168, 7);
    transition-duration: 1s;
  }
  
  .heading ul li a::before {
    content: "";
    height: 2px;
    width: 0px;
    position: absolute;
    left: 0;
    bottom: 0;
    background-color: white;
    transition-duration: 1s;
  }
  .heading ul li a:hover::before {
    width: 100%;
    transition-duration: 1s;
    background-color: rgb(243, 168, 7);
  }
  #input {
    height: 30px;
    width: 300px;
    text-decoration: none;
    border: 0px;
    padding: 5px;
  }
  .logo a {
    color: white;
    font-size: 35px;
    font-weight: 500;
    text-decoration: none;
  }
  ion-icon {
    width: 30px;
    height: 30px;
    background-color: white;
    color: black;
  }
  ion-icon:hover {
    cursor: pointer;
  }
  .search a {
    display: flex;
  }
  header a ion-icon {
    position: relative;
    right: 3px;
  }
    </style>

</head>
<body>
    <header>
        <div class="logo"><a href="#"><?php echo $web["web_name"]; ?></a></div>
        <div class="search">
    
          <a href=""><input type="text" placeholder="search products" id="input">
            <ion-icon class="s" name="search"></ion-icon>
          </a>
        </div>
        <div class="heading">
          <ul>
            <li><a href="index.php" class="under">HOME</a></li>
            <li><a href="product.php" class="under">OUR PRODUCTS</a></li>
            <li><a href="about_us.php" class="under">ABOUT US</a></li>
            <li><a href="cart.php" class="under">CART</a></li>
          </ul>
        </div>
      </header>
    <?php

    $email = $_COOKIE["email"];
    $id = $_GET["id"];
    $query = "select * from product where user_id in (select user_id from user_custom where email = '$email') and prod_id = $id";
    $res = pg_query($conn,$query);
    if(pg_num_rows($res)>0)
    {
        /*echo "<script>window.alert('correct query')</script>";*/
        $data = pg_fetch_assoc($res);
        
            $prod_name = $data["prod_name"];
            $short_des = $data["short_des"];
            $des = $data["des"];
            $img1 = $data["image1"];
            $img2 = $data["image2"];
            $img3 = $data["image3"];
            $actual_price = $data["actual_price"];
            $sell_price = $data["sell_price"];
            $discount = $data["discount"];
            $stock = $data["stock"];
            $prod_id = $data["prod_id"];
    echo "<section id='product-page'>
    <div class='product-details'>  
        <div class='product-img'>
        <div class='swiper mySwiper'>
            <div class='swiper-wrapper'>
            <div class='swiper-slide'>
                <img src='../public/img/$img1' />
            </div>
            </div>

        </div>
        
        </div>
        <div class='product-text'>
            <span class='product-category'></span>
            <h3>$prod_name</h3>
            <span class='product-price'>Rs.$actual_price</span>
            <p>$des</p>
            
            <div class='product-button'>
                <a href='cart.html?id=$prod_id' class='add-bag-btn'>Add To Bag</a>
            </div>
        </div>
    </div>
    </section>";
    }
    ?>

    <footer>
        <div class="footer0">
          <h1>ShoPperZ</h1>
        </div>
        <div class="footer2">
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
        </div>
        <div class="footer3">Copyright © <h4>ShoPperZ</h4> 2021-2028</div>
      </footer>

</body>
</html>
 