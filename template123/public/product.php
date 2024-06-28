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

$cnt = "select sum(qty) from cart group by user_id having user_id in (select user_id from user_custom where email='$email')";
$item = pg_query($conn,$cnt);
$count = pg_fetch_assoc($item);
$c = $count["sum"];

//$mssg = '<script>window.alert('search')</script>';
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Product</title>
    <link rel='stylesheet' href='css/home.css'>
    <link rel='stylesheet' href='css/product.css'>
    <?php
    echo "
    <style> 
    .product-images{
        grid-template-columns: repeat(3,1fr);
    }
    sup{position: relative;
        font-size: 15px;
        display: block;
        bottom: 1px;
        left: 11px;
        color: #383838;
        font-weight: 800;
        border: 1px solid #aeaeae;
        padding: 5px 10px;
    }
    </style>
    ";
    ?>

</head>
<body>

<nav class="navbar">

<div class="nav">
    <p class="brand-logo" style="font-size : 50px; font-family: 'Brush Script MT', cursive; font-weight: 400; text-transform: capitalize;"><?php global $web; echo $web["web_name"];?></p>
    <div class="nav-items">
        <div class="search">
            <input type="text" class="search-box" placeholder="Type">
            <button class="search-btn">search</button>
        </div>
        <a>
        <img src="img/user.png" alt="" id="user-img">
        <div class="login-logout-popup hide">
            <p class="account-info">Log in as, name</p>
            <button class="btn" id="user-btn">Log Out</button> 
        </div>
        </a>
        <a href="cart.php"><img src="img/cart.png" alt=""></a><sup><?php echo $c; ?></sup>
    </div>

</div>
<ul class="links-container">
    <li class="list-item"><a href="tempo.php" class="link">home</a></li>
    <li class="list-item"><a href="search2.php?id=0" class="link">Product</a></li>
    <li class="list-item"><a href="aboutUS.php" class="link">about us</a></li>
    <?php
    global $conn;
    $email = $_COOKIE["email"];
    $query = "select * from category where user_id in (select user_id from user_custom where email = '$email')";
    $result = pg_query($conn,$query);
    if($result)
    {
        $cnt=0;
        while($data = pg_fetch_assoc($result))
        {
            $name = $data["cat_name"];
            $id = $data["cat_id"];
            echo "<li class='list-item'><a href='search2.php?id=$id' class='link'>$name</a></li>";
            $cnt=$cnt+1;
            if($cnt==4)
            break;
        }
    }

    ?>
    <!--<li class="list-item"><a href="#" class="link"><?php echo $_COOKIE["nav2"];?></a></li>
    <li class="list-item"><a href="#" class="link"><?php echo $_COOKIE["nav3"];?></a></li>
    <li class="list-item"><a href="#" class="link"><?php echo $_COOKIE["nav4"];?></a></li>-->
    <li class="list-item"><a href="#" class="link"><?php
    if(isset($_COOKIE["username"]))
    echo $_COOKIE["username"];
    ?></a></li>
</ul>
</nav>

        <?php
        $prod_id = $_GET["prod_id"]; 
        $query = "select * from product where prod_id = $prod_id";
        $result = pg_query($conn,$query);

        if(pg_num_rows($result)>0)
        {
            $data = pg_fetch_assoc($result);
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
        }
        echo "
        <form action='' method='post'>
        <section class='product-details'>
        <div class='image-slider'>
            <div class='product-images'>
                <img src='img/$img1' class='active' alt=''>
                <img src='img/$img2' alt=''>
                <img src='img/$img3' alt=''>
            </div>
        </div>
        <div class='details'>
            <h2 class='product-brand'>$prod_name</h2>
            <p class='product-short-des'>$short_des</p>
            <span class='product-price'>$sell_price</span>
            <span class='product-actual-price'>$actual_price</span>
            <span class='product-discount'>($discount %)</span>

            <p class='product-sub-heading'>select size</p>

            <input type='radio' name='size' value='s' hidden id='s-size' checked>
            <label for='s-size' class='size-radio-btn check'>s</label>
            <input type='radio' name='size' value='m' hidden id='m-size'>
            <label for='m-size' class='size-radio-btn'>m</label>
            <input type='radio' name='size' value='l' hidden id='l-size'>
            <label for='l-size' class='size-radio-btn'>l</label>
            <input type='radio' name='size' value='xl' hidden id='xl-size'>
            <label for='xl-size' class='size-radio-btn'>xl</label>
            <input type='radio' name='size' value='xxl' hidden id='xxl-size'>
            <label for='xxl-size' class='size-radio-btn'>xxl</label>

            <div class='btn-grp'>
                <button class='btn cart-btn' name='cart' value=$prod_id>add to cart</button>
                <!--<button class='btn wishlist-btn'>add to wishlist</button>-->
            </div>

            
        </div>;

        

    </section>

    <section class='detail-des'>
        <h2 class='heading'>description</h2>
        <p class='des'>$des</p>
        
    </section>
    </form>"
    ?>

    <section class='container-for-card-slider'>
        

    </section>
     <!-- cards-container -->
    <!-- <section class='product'>
        <h2 class='product-category'>Shoes</h2>
        <button class='pre-btn'><img src='img/arrow.png' alt='na'></button>
        <button class='nxt-btn'><img src='img/arrow.png' alt='na'></button>
        <div class='product-container'>

            <div class='product-card'>
                <div class='product-image'>
                    <span class='discount-tag'>50% off</span>
                    <img src='img/card10.png' alt=' class='product-thumb'>
                    <button class='card-btn'>add to wishlist</button>
                </div>
                <div class='product-info'>
                    <h2 class='product-brand'>brand</h2>
                    <p class='product-short-des'> a short line about...</p>
                    <span class='price'>$20</span>
                    <span class='actual-price'>$40</span>
                </div>
            </div>
            <div class='product-card'>
                <div class='product-image'>
                    <span class='discount-tag'>50% off</span>
                    <img src='img/card11.png' alt=' class='product-thumb'>
                    <button class='card-btn'>add to wishlist</button>
                </div>
                <div class='product-info'>
                    <h2 class='product-brand'>brand</h2>
                    <p class='product-short-des'> a short line about...</p>
                    <span class='price'>$20</span>
                    <span class='actual-price'>$40</span>
                </div>
            </div>
            <div class='product-card'>
                <div class='product-image'>
                    <span class='discount-tag'>50% off</span>
                    <img src='img/card12.png' alt=' class='product-thumb'>
                    <button class='card-btn'>add to wishlist</button>
                </div>
                <div class='product-info'>
                    <h2 class='product-brand'>brand</h2>
                    <p class='product-short-des'> a short line about...</p>
                    <span class='price'>$20</span>
                    <span class='actual-price'>$40</span>
                </div>
            </div>
            <div class='product-card'>
                <div class='product-image'>
                    <span class='discount-tag'>50% off</span>
                    <img src='img/card9.png' alt=' class='product-thumb'>
                    <button class='card-btn'>add to wishlist</button>
                </div>
                <div class='product-info'>
                    <h2 class='product-brand'>brand</h2>
                    <p class='product-short-des'> a short line about...</p>
                    <span class='price'>$20</span>
                    <span class='actual-price'>$40</span>
                </div>
            </div>
            <div class='product-card'>
                <div class='product-image'>
                    <span class='discount-tag'>50% off</span>
                    <img src='img/package-1.jpg' alt=' class='product-thumb'>
                    <button class='card-btn'>add to wishlist</button>
                </div>
                <div class='product-info'>
                    <h2 class='product-brand'>brand</h2>
                    <p class='product-short-des'> a short line about...</p>
                    <span class='price'>$20</span>
                    <span class='actual-price'>$40</span>
                </div>
            </div>
            <div class='product-card'>
                <div class='product-image'>
                    <span class='discount-tag'>50% off</span>
                    <img src='img/package-2.jpg' alt=' class='product-thumb'>
                    <button class='card-btn'>add to wishlist</button>
                </div>
                <div class='product-info'>
                    <h2 class='product-brand'>brand</h2>
                    <p class='product-short-des'> a short line about...</p>
                    <span class='price'>$20</span>
                    <span class='actual-price'>$40</span>
                </div>
            </div>
            <div class='product-card'>
                <div class='product-image'>
                    <span class='discount-tag'>50% off</span>
                    <img src='img/package-3.jpg' alt=' class='product-thumb'>
                    <button class='card-btn'>add to wishlist</button>
                </div>
                <div class='product-info'>
                    <h2 class='product-brand'>brand</h2>
                    <p class='product-short-des'> a short line about...</p>
                    <span class='price'>$20</span>
                    <span class='actual-price'>$40</span>
                </div>
            </div>
            <div class='product-card'>
                <div class='product-image'>
                    <span class='discount-tag'>50% off</span>
                    <img src='img/package-4.jpg' alt=' class='product-thumb'>
                    <button class='card-btn'>add to wishlist</button>
                </div>
                <div class='product-info'>
                    <h2 class='product-brand'>brand</h2>
                    <p class='product-short-des'> a short line about...</p>
                    <span class='price'>$20</span>
                    <span class='actual-price'>$40</span>
                </div>
            </div>
        </div>
    </section>

     <!-- cards-container -->
     <!--<section class='product'>
        <h2 class='product-category'>Shirts</h2>
        <button class='pre-btn'><img src='img/arrow.png' alt='na'></button>
        <button class='nxt-btn'><img src='img/arrow.png' alt='na'></button>
        <div class='product-container'>

            <div class='product-card'>
                <div class='product-image'>
                    <span class='discount-tag'>50% off</span>
                    <img src='img/card5.png' alt=' class='product-thumb'>
                    <button class='card-btn'>add to wishlist</button>
                </div>
                <div class='product-info'>
                    <h2 class='product-brand'>brand</h2>
                    <p class='product-short-des'> a short line about...</p>
                    <span class='price'>$20</span>
                    <span class='actual-price'>$40</span>
                </div>
            </div>
            <div class='product-card'>
                <div class='product-image'>
                    <span class='discount-tag'>50% off</span>
                    <img src='img/card6.png' alt=' class='product-thumb'>
                    <button class='card-btn'>add to wishlist</button>
                </div>
                <div class='product-info'>
                    <h2 class='product-brand'>brand</h2>
                    <p class='product-short-des'> a short line about...</p>
                    <span class='price'>$20</span>
                    <span class='actual-price'>$40</span>
                </div>
            </div>
            <div class='product-card'>
                <div class='product-image'>
                    <span class='discount-tag'>50% off</span>
                    <img src='img/card7.png' alt=' class='product-thumb'>
                    <button class='card-btn'>add to wishlist</button>
                </div>
                <div class='product-info'>
                    <h2 class='product-brand'>brand</h2>
                    <p class='product-short-des'> a short line about...</p>
                    <span class='price'>$20</span>
                    <span class='actual-price'>$40</span>
                </div>
            </div>
            <div class='product-card'>
                <div class='product-image'>
                    <span class='discount-tag'>50% off</span>
                    <img src='img/card8.png' alt=' class='product-thumb'>
                    <button class='card-btn'>add to wishlist</button>
                </div>
                <div class='product-info'>
                    <h2 class='product-brand'>brand</h2>
                    <p class='product-short-des'> a short line about...</p>
                    <span class='price'>$20</span>
                    <span class='actual-price'>$40</span>
                </div>
            </div>
            <div class='product-card'>
                <div class='product-image'>
                    <span class='discount-tag'>50% off</span>
                    <img src='img/card9.png' alt=' class='product-thumb'>
                    <button class='card-btn'>add to wishlist</button>
                </div>
                <div class='product-info'>
                    <h2 class='product-brand'>brand</h2>
                    <p class='product-short-des'> a short line about...</p>
                    <span class='price'>$20</span>
                    <span class='actual-price'>$40</span>
                </div>
            </div>
            <div class='product-card'>
                <div class='product-image'>
                    <span class='discount-tag'>50% off</span>
                    <img src='img/package-2.jpg' alt=' class='product-thumb'>
                    <button class='card-btn'>add to wishlist</button>
                </div>
                <div class='product-info'>
                    <h2 class='product-brand'>brand</h2>
                    <p class='product-short-des'> a short line about...</p>
                    <span class='price'>$20</span>
                    <span class='actual-price'>$40</span>
                </div>
            </div>
            <div class='product-card'>
                <div class='product-image'>
                    <span class='discount-tag'>50% off</span>
                    <img src='img/package-3.jpg' alt=' class='product-thumb'>
                    <button class='card-btn'>add to wishlist</button>
                </div>
                <div class='product-info'>
                    <h2 class='product-brand'>brand</h2>
                    <p class='product-short-des'> a short line about...</p>
                    <span class='price'>$20</span>
                    <span class='actual-price'>$40</span>
                </div>
            </div>
            <div class='product-card'>
                <div class='product-image'>
                    <span class='discount-tag'>50% off</span>
                    <img src='img/package-4.jpg' alt=' class='product-thumb'>
                    <button class='card-btn'>add to wishlist</button>
                </div>
                <div class='product-info'>
                    <h2 class='product-brand'>brand</h2>
                    <p class='product-short-des'> a short line about...</p>
                    <span class='price'>$20</span>
                    <span class='actual-price'>$40</span>
                </div>
            </div>
        </div>
    </section>-->

    <footer> 
    <div class="footer-content">
    <p class="logo" style="font-size: 100px; height: 100px; color: #fff; font-weight: 700; font-family: 'Brush Script MT', cursive;margin: auto;"><?php echo $web["web_name"];?></p>
    <div class="footer-ul-container">
        <ul class="category">
            <?php
                include('C:\wamp\www\Project\home_page\connect.php');
                global $conn;
                $email = $_COOKIE["email"];
                $query = "select * from category where user_id in (select user_id from user_custom where email = '$email')";
                $result = pg_query($conn,$query);
                if($result)
                {
                    while($data = pg_fetch_assoc($result))
                    {
                        $name = $data["cat_name"];
                        echo "<li><a href='#' class='footer-link'>$name</a></li>";
                    }
                }
                else
                {
                    echo "<script>window.alert('error occured')</script>";
                }
            ?>
        </ul>

        <!--<ul class="category">
            <li><a href="#" class="footer-link">t-shirts</a></li>
            <li><a href="#" class="footer-link">jeans</a></li>
            <li><a href="#" class="footer-link">trousers</a></li>
            <li><a href="#" class="footer-link">sweatshirts</a></li>
            <li><a href="#" class="footer-link">shoes</a></li>
            <li><a href="#" class="footer-link">casuals</a></li>
            <li><a href="#" class="footer-link">formals</a></li>
        </ul>-->
    </div>
   </div> 
    </footer>

    
   
    <script src='js/home.js'></script>
    <script src='js/product.js'></script>
    
</body>
</html>

<?php
global $conn;
if(isset($_POST["cart"]))
{
$p = $_POST["cart"];
  //echo "<script>window.alert('hhheeee')</script>";
  $query = "select * from cart where prod_id = $p";
  $result = pg_query($conn,$query);
  if(pg_num_rows($result)==0)
  {
      $query = "insert into cart values($p,1)";
      $result = pg_query($conn,$query);
      echo "<script>window.alert('added to cart');</script>";

  }
  else
  {
    $query = "update cart set qty = qty+1 where prod_id = $p";
    $result = pg_query($conn,$query);
    
    echo "<script>window.alert('item exits in cart');</script>";
  }
  unset($_POST);
}
else
{
  echo "<script>window.alert('click to continue');<script>";
}

?>