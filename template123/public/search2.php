<?php
include('C:\wamp\www\Project\home_page\connect.php');
@session_start();
//$_POST = array();
//echo "<script> setTimeout(function(){window.location.reload();},5000);</script>"
//global $conn;
$email = $_COOKIE["email"];
$query = "select * from user_template where user_id in (select user_id from user_custom where email = '$email')";
$res = pg_query($conn,$query);
$web = pg_fetch_assoc($res); 

$cnt = "select sum(qty) from cart group by user_id having user_id in (select user_id from user_custom where email='$email')";
$item = pg_query($conn,$cnt);
if($item)
{
$count = pg_fetch_assoc($item);
$c = $count["sum"];
}
echo "<script>window.alert('welcome')</script>";

//$mssg = "<script>window.alert('search')</script>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>

    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/search.css">
    <link rel="stylesheet" href="css/seller.css">
    <?php
    echo "
    <style>
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
    .card-btn2{
        position: absolute;
        bottom: 50px;
        left: 50%;
        transform: translateX(-50%);
        padding: 10px;
        width: 90%;
        text-transform: capitalize;
        border: none;
        outline: none;
        background: #fff;
        border-radius: 5px;
        transition: 0.5s;
        cursor: pointer;
        opacity: 0;
    
    }
    .card-btn2:hover{
        background: #aeaeae;
    }
    .product-card:hover .card-btn2{
        opacity:1;
    }
    a{
        text-decoration:none;
        text-transform: capitalize;
        text-align:center;
        color: #383838;
    }
    </style> ";

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

    <section class="search-results">
        <?php
        $id = $_GET["id"];
        $que = "select * from category where cat_id = $id";
        $r = pg_fetch_assoc(pg_query($conn,$que));
        $cat_name = $r["cat_name"];
        echo "<h2 class='heading'>search results for <span id='search-key'>$cat_name</span></h2>";

        ?>
        <section class="cards-container">

        </section>
        <form method="post" action=" ">
        <div class="product-container">

        <?php
        include('C:\wamp\www\Project\home_page\connect.php');
            $email = $_COOKIE["email"];
            $t_id = $_SESSION["t_id"];
            if($_GET["id"]==0)
            $query = "select * from product where t_id = $t_id and user_id in (select user_id from user_custom where email = '$email')";
            else
            {
                $id = $_GET["id"];
                $query = "select * from product where t_id = $t_id and cat_id = $id and user_id in (select user_id from user_custom where email = '$email')";

            }
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
        <div class='product-card'>
                <div class='product-image'>
                    <span class='discount-tag'>$discount% off</span>
                    <img src='img/$img1' alt='na' class='product-thumb'>
                    <button name='edit' class='card-action-btn edit-btn' value=$prod_id><img src='img/edit.png' alt=''></button>
                    <button name='del' class='card-action-btn delete-popup-btn' value=$prod_id><img src='img/delete.png' alt=''></button>
                    <a href='product.php?prod_id=$prod_id' class='card-btn2' name='view' value=$prod_id>view more</a>
                    <button class='card-btn' name='cart' value=$prod_id>add to Cart</button>
                    
                </div>
                <div class='product-info'>
                    <h2 class='product-brand'>$prod_name</h2>
                    <p class='product-short-des'>$short_des</p>
                    <span class='price'>Rs. $sell_price</span>
                    <span class='actual-price'>Rs. $actual_price</span>
                </div>
            </div>";
            
                }
            }
           
    ?>
            <!--<div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">50% off</span>
                    <img src="img/card1.png" alt="" class="product-thumb">
                    <button name="cart" value=23 class="card-btn" >add tocart</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des"> a short line about...</p>
                    <span class="price">$20</span>
                    <span class="actual-price">$40</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">50% off</span>
                    <img src="img/card2.png" alt="" class="product-thumb">
                    <button name="cart" value=24 class="card-btn" >add to wishlist</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des"> a short line about...</p>
                    <span class="price">$20</span>
                    <span class="actual-price">$40</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">50% off</span>
                    <img src="img/card3.png" alt="" class="product-thumb">
                    <button name="cart" class="card-btn" value=26>add to wishlist</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des"> a short line about...</p>
                    <span class="price">$20</span>
                    <span class="actual-price">$40</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">50% off</span>
                    <img src="img/card4.png" alt="" class="product-thumb">
                    <button class="card-btn" name="cart" value=27 >add to wishlist</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des"> a short line about...</p>
                    <span class="price">$20</span>
                    <span class="actual-price">$40</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">50% off</span>
                    <img src="img/card5.png" alt="" class="product-thumb">
                    <button class="card-btn" name="cart" value=28>add to wishlist</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des"> a short line about...</p>
                    <span class="price">$20</span>
                    <span class="actual-price">$40</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">50% off</span>
                    <img src="img/card6.png" alt="" class="product-thumb">
                    <button class="card-btn" name="cart" value=29>add to wishlist</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des"> a short line about...</p>
                    <span class="price">$20</span>
                    <span class="actual-price" >$40</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">50% off</span>
                    <img src="img/card7.png" alt="" class="product-thumb">
                    <button class="card-btn" name="cart" value=30>add to wishlist</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des"> a short line about...</p>
                    <span class="price">$20</span>
                    <span class="actual-price">$40</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">50% off</span>
                    <img src="img/card8.png" alt="" class="product-thumb">
                    <button class="card-btn" >add to wishlist</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des"> a short line about...</p>
                    <span class="price">$20</span>
                    <span class="actual-price">$40</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">50% off</span>
                    <img src="img/card9.png" alt="" class="product-thumb">
                    <button class="card-btn">add to wishlist</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des"> a short line about...</p>
                    <span class="price">$20</span>
                    <span class="actual-price">$40</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">50% off</span>
                    <img src="img/card10.png" alt="" class="product-thumb">
                    <button class="card-btn">add to wishlist</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des"> a short line about...</p>
                    <span class="price">$20</span>
                    <span class="actual-price">$40</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">50% off</span>
                    <img src="img/card4.png" alt="" class="product-thumb">
                    <button class="card-btn">add to wishlist</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des"> a short line about...</p>
                    <span class="price">$20</span>
                    <span class="actual-price">$40</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">50% off</span>
                    <img src="img/card3.png" alt="" class="product-thumb">
                    <button class="card-btn">add to wishlist</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des"> a short line about...</p>
                    <span class="price">$20</span>
                    <span class="actual-price">$40</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">50% off</span>
                    <img src="img/card12.png" alt="" class="product-thumb">
                    <button class="card-btn">add to wishlist</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des"> a short line about...</p>
                    <span class="price">$20</span>
                    <span class="actual-price">$40</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">50% off</span>
                    <img src="img/card11.png" alt="" class="product-thumb">
                    <button class="card-btn">add to wishlist</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des"> a short line about...</p>
                    <span class="price">$20</span>
                    <span class="actual-price">$40</span>
                </div>
            </div>-->
        </div>
        </form>
    </section>

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

    <!--<script src="js/nav.js"></script>-->
    <!--<script src="js/footer.js"></script>-->
    
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
else if(isset($_POST["del"]))
{
    $p = $_POST["del"];
  //echo "<script>window.alert('hhheeee')</script>";
  $query = "delete from product where prod_id = $p and t_id = $t_id";
  $result = pg_query($conn,$query);
}
else
{
  echo "<script>window.alert('click to continue');</script>";
}

$_POST["cart"] = -1;
$id = $_POST["cart"];
//echo "<script>window.alert('$id');</script>";

?>