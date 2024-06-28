<?php
include('C:\wamp\www\Project\home_page\connect.php');
@session_start();
echo "<script> setTimeout(function(){window.location.reload();},5000);</script>";
$email = $_COOKIE["email"];
$query = "select * from user_template where user_id in (select user_id from user_custom where email = '$email') and t_id=2";
$res = pg_query($conn,$query);
$web = pg_fetch_assoc($res); 

/*$cnt = "select sum(qty) from cart group by user_id having user_id in (select user_id from user_custom where email='$email')";
$item = pg_query($conn,$cnt);
if($item===true)
{
    global $item;
$count = pg_fetch_assoc($item);
$c = $count["sum"];
}
else
{
    $c = 0;
}*/
?>
<!DOCTYPE html>
<html lang="en">
    <head>
      <link rel="stylesheet" href="css/product.css">
      <link rel="stylesheet" href="css/ecommerce.css">
        <!--<link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">-->
        <style>
            .container{
            width: auto;
        }
        .our-products{
            margin-top: 20px;
            margin-bottom: 20px;
            background: #f1f1fe;
        }
        .img-slider {
    display: flex;
    float: left;
    position: relative;
    width: 1080px;
    height: 720px;
    animation-name: none;
  }

  @media screen and (max-width : auto){
  header{
    height:150px;
  }
}

<?php
  echo " .container {
    grid-template-columns: repeat(4, minmax(250px,1fr));
  }
  .logo1{
    color:black;
  }"
  ?>
    </style>
        
      </head>
      
      <body>
        <header>
          <div class="logo"><a href="index.php"><?php echo $web['web_name']; ?></a></div>
          <div class="search">
           <input type="text" placeholder="search products" id="input">
          </div>
          <div class="heading">
            <ul>
                <li><a href="index.php" class="under">HOME</a></li>
                <li><a href="product.php" class="under">PRODUCTS</a></li>
                <li><a href="about_us.php" class="under">ABOUT US</a></li>
                <li><a href="cart.php" class="under">CART</a></li>
            </ul>
          </div>
        </header>
        <section>
          <div class="section">
            <div class="section1">
              <div class="img-slider">
                <img src="../public/img/<?php echo $web['web_img']; ?>" alt="" class="img">
                </div>
      
            </div>
          </div>
        </section>
            
    <!--        <div class="our-products">
                <p class="logo1" style="font-family: 'Brush Script MT', cursive;font-size: 80px;text-align: center;color:#000 ; text-transform:capitalize; font-weight: 500;margin: auto;">Our Products</p>
            </div>
            
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
              
              
              </div>
      
    </div>-->

    <?php
        include('C:\wamp\www\Project\home_page\connect.php');
        $email = $_COOKIE["email"];
        $t_id = $_SESSION["t_id"];
        $query = "select * from section where t_id = $t_id and user_id in (select user_id from user_custom where email = '$email')";
        $res = pg_query($conn,$query);
        if(pg_num_rows($res)>0)
        {
            
            while($data = pg_fetch_assoc($res))
            {
                $sect_name = $data["sect_name"];
                $sect_id = $data["sect_id"];
            echo "<div class='our-products'>
            <p class='logo1' style=' font-family: 'Brush Script MT', cursive;font-size: 80px;text-align: center; color:#000 ; text-transform:capitalize; font-weight: 500;margin: auto;'>$sect_name</p>
            <div class='container'>";
            $query = "select * from product where sect_id = $sect_id";
            $result = pg_query($conn,$query);
            if($result===false)
            {
                echo "<script>window.alert('wrong query')</script>";
            }
            else
            {
                /*echo "<script>window.alert('correct query')</script>";*/
                while($data = pg_fetch_assoc($result))
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
                            <button><img style='object-fit: cover;
                                display: block;
                                overflow: hidden;
                                height: 20px;
                                width: 20px;
                                top: 14px;
                                right: 10px;
                             ' src='../public/img/eye.jpg' alt=''></button>
                            <span>Add to wishlist</span>
                        </li>
                        <li>
                            <button><img style='object-fit: cover;
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
                echo"</div></div>";
            }
            }
        }


    ?>
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
        <script src="js/ecommerce.js"></script>
      
      </body>
      
      </html>