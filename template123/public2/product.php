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
    <title>product page</title>
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="css/ecommerce.css">
    <style>
        .container{
            width: auto;
        }

    </style>
</head>
<body>
    <header>
        <div class="logo"><a href="#"><?php echo $web["web_name"]; ?></a></div>

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
      </header>
    <form action="" method="post">
    <div class="container">
        <div class="card">
            <div class="imgbx">
                <img class="prod-img" src="../public/img/card10.png" alt="">
                <ul class="action">

                    <li>
                        <button><img style="object-fit: cover;
                            display: block;
                            overflow: hidden;
                            height: 20px;
                            width: 20px;
                            top: 14px;
                            right: 10px;
                         " src="../public/img/eye.jpg" alt=""></button>
                        <span>Add to wishlist</span>
                    </li>
                    <li>
                        <button><img style="object-fit: cover;
                            display: block;
                            overflow: hidden;
                            height: 20px;
                            width: 20px;
                            top: 14px;
                            right: 10px;
                         " src="../public/img/cart.png" alt=""></button>
                        <span>
                            Add to cart
                        </span>
                    </li>
                </ul>
            </div>
            <div class="content">
                <div class="product-name">
                    <h1>Shoes</h1>
                </div>
                <div class="price_rating">
                    <h2 class="s-price">$13.45</h2>
                    <h2 class="a-price">$26.90</h2>
                    <h2 class="discount">50% off</h2>
                </div>
                <div class="rating">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing.</p>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="imgbx">
                <img class="prod-img" src="../public/img/card10.png" alt="">
                <ul class="action">

                    <li>
                        <button><img style="object-fit: cover;
                            display: block;
                            overflow: hidden;
                            height: 20px;
                            width: 20px;
                            top: 14px;
                            right: 10px;
                         " src="../public/img/edit.png" alt=""></button>
                        <span>Add to wishlist</span>
                    </li>
                    <li>
                        <button><img style="object-fit: cover;
                            display: block;
                            overflow: hidden;
                            height: 20px;
                            width: 20px;
                            top: 14px;
                            right: 10px;
                         " src="../public/img/cart.png" alt=""></button>
                        <span>
                            Add to cart
                        </span>
                    </li>
                    <li>
                        <button><img style="object-fit: cover;
                            display: block;
                            overflow: hidden;
                            height: 20px;
                            width: 20px;
                            top: 14px;
                            right: 10px;
                         " src="../public/img/edit.png" alt=""></button>
                        <span>
                            View More
                        </span>
                    </li>
                </ul>
            </div>
            <div class="content">
                <div class="product-name">
                    <h1>Shoes</h1>
                </div>
                <div class="price_rating">
                    <h2 class="s-price">$13.45</h2>
                    <h2 class="a-price">$26.90</h2>
                    <h2 class="discount">50% off</h2>
                </div>
                <div class="rating">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing.</p>
                </div>
            </div>
        </div>
        
        <?php
        include('C:\wamp\www\Project\home_page\connect.php');
        $email = $_COOKIE["email"];
        $t_id = $_SESSION["t_id"];
        $query = "select * from product where t_id = $t_id and user_id in (select user_id from user_custom where email = '$email')";
        $res = pg_query($conn,$query);
        if(pg_num_rows($res)>0)
        {
                /*echo "<script>window.alert('correct query')</script>";*/
                while($data = pg_fetch_assoc($res))
                {
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
                echo "
                <div class='card'>
                <div class='imgbx'>
                    <img class='prod-img' src='../public/img/$img1' alt=''>
                    <ul class='action'>
    
                        <li>
                            <a href='product_details.php?id=$prod_id'><img style='object-fit: cover;
                                display: block;
                                overflow: hidden;
                                height: 20px;
                                width: 20px;
                                top: 14px;
                                right: 10px;
                             ' src='../public/img/eye.jpg' alt=''></a>
                            <span>More Details</span>
                        </li>
                        <li>
                            <button name='cart' value=$prod_id><img style='object-fit: cover;
                                display: block;
                                overflow: hidden;
                                height: 20px;
                                width: 20px;
                                top: 14px;
                                right: 10px;
                             ' src='../public/img/cart.png' alt=''></button>
                            <span>
                                Add to cart
                            </span>
                        </li>
                    </ul>
                </div>
                <div class='content'>
                    <div class='product-name'>
                        <h1>$prod_name</h1>
                    </div>
                    <div class='price_rating'>
                        <h2 class='s-price'>Rs.$sell_price</h2>
                        <h2 class='a-price'>Rs.$actual_price</h2>
                        <h2 class='discount'>$discount%</h2>
                    </div>
                    <div class='rating'>
                        <p>$short_des</p>
                    </div>
                </div>
            </div>
                        ";
            
                }
            }


    ?>
    </div>
    </form>

    <footer>
        <div class="footer0">
          <h1>ShoPperZ</h1>
        </div>
        <div class="footer1 ">
          Connect with us at<div class="social-media">
            <a href="#">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
            <a href="#">
              <ion-icon name="logo-linkedin"></ion-icon>
            </a>
            <a href="#">
              <ion-icon name="logo-youtube"></ion-icon>
            </a>
            <a href="#">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
            <a href="#">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </div>
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
      <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
      <script src="./ecommerce.js"></script>

</body>
</html>

<?php
global $conn;
$q = "select * from user_custom where email = '$email'";
$id = pg_fetch_assoc(pg_query($conn,$q));
$u_id = $id["user_id"];
$t_id = $_SESSION["t_id"];
if(isset($_POST["cart"]))
{
$p = $_POST["cart"];
  //echo "<script>window.alert('hhheeee')</script>";
  $query = "select * from cart where prod_id = $p and user_id = $u_id and t_id = $t_id";
  $result = pg_query($conn,$query);
  if(pg_num_rows($result)==0)
  {
      $query = "insert into cart values($p,1,$u_id,$t_id)";
      $result = pg_query($conn,$query);
      if($result===true)
      echo "<script>window.alert('added to cart');</script>";
      $_POST["cart"]=-1;
      echo "<script>window.open('cart.php','_self')</script>";

  }
  else
  {
    $query = "update cart set qty = qty+1 where prod_id = $p and user_id=$u_id and t_id = $t_id";
    $result = pg_query($conn,$query);
    echo "<script>window.open('cart.php','_self')</script>";
    //echo "<script>window.alert('item exits in cart');</script>";
    //$_POST = array();
  }
  //unset($_POST);
  //$_POST = array();
}