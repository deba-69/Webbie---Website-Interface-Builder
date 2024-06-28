<?php
include('C:\wamp\www\Project\home_page\connect.php');
@session_start();
//echo "<script> setTimeout(function(){window.location.reload();},5000);</script>"
//global $conn;
//unset($_POST);
echo "<script>window.alert('welcome')</script>";
echo "<script>window.reload();</script>";
$email = $_COOKIE["email"];
$query = "select * from user_template where user_id in (select user_id from user_custom where email = '$email')";
$res = pg_query($conn,$query);
$web = pg_fetch_assoc($res); 

$cnt = "select sum(qty) from cart group by user_id having user_id in (select user_id from user_custom where email='$email')";
$item = pg_query($conn,$cnt);
$count = pg_fetch_assoc($item);
$c = $count["sum"];
//echo "<script>window.location.reload();</script>"

//$mssg = "<script>window.alert('search')</script>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clothing : Cart</title>

    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/cart.css">
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
        </style>
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


    <div class="cart-section">
        <div class="product-list">
            <p class="section-heading">your cart</p>
            <div class="cart">
                <form action = " " method="post">
                <!--<img src="" alt="na" class="empty-img">-->
                <?php
                    $content = "<div class='sm-product'>
                    <img src='img/product image 1.png' alt='' class='sm-product-img'>
                    <div class='sm-text'>
                        <p class='sm-product-name'>BRAND</p>
                        <p class='sm-des'>this is a short line about</p>
                    </div>
                    <div class='item-counter'>
                        <p class='item-count'>1</p>
                    </div>
                    <p class='sm-price'>$20</p>
                    <button name='remove' class='sm-delete-btn'><img src='img/close.png' alt='' ></button>
                </div>";
                global $conn;
                $t_id = $_SESSION["t_id"];
                $query = "select * from product where prod_id in (select prod_id from cart where t_id = $t_id)";
                $result = pg_query($conn,$query);
                $sum = 0;
                if(pg_num_rows($result)>0)
                {
                    
                    while($data = pg_fetch_assoc($result))
                    {
                        $img = $data["image1"];
                        $name = $data["prod_name"];
                        $des = $data["short_des"];
                        $price = $data["actual_price"];
                        //$sum = $sum + $price;
                        $prod_id = $data["prod_id"];
                        $que = "select * from cart where prod_id = $prod_id";
                        $res = pg_query($conn,$que);
                        $d2 = pg_fetch_assoc($res);
                        $qty = $d2["qty"];
                        $cost = $qty*$price;
                        $sum = $sum + $cost;
                        echo "<div class='sm-product'>
                        <img src='img/$img' alt=' ' class='sm-product-img'>
                        <div class='sm-text'>
                            <p class='sm-product-name'>$name</p>
                            <p class='sm-des'>$des</p>
                        </div>
                        <div class='item-counter'>
                        <p class='item-count'>$qty</p>
                            
                        </div>
                        <p class='sm-price'>$cost</p>
                        <button name='delete' value=$prod_id class='sm-delete-btn'><img src='img/close.png' alt='' ></button>
                    </div>";
                    }
                }
                ?>
                <!--<div class="sm-product">
                    <img src="img/product image 1.png" alt="" class="sm-product-img">
                    <div class="sm-text">
                        <p class="sm-product-name">BRAND</p>
                        <p class="sm-des">this is a short line about</p>
                    </div>
                    <div class="item-counter">
                        <input type="number" class="item-count" name="qty" placeholder="qty">
                    </div>
                    <p class="sm-price">20</p>
                    <button class="sm-delete-btn"><img src="img/close.png" alt="" ></button>
                </div>
                <div class="sm-product">
                    <img src="img/product image 1.png" alt="" class="sm-product-img">
                    <div class="sm-text">
                        <p class="sm-product-name">BRAND</p>
                        <p class="sm-des">this is a short line about</p>
                    </div>
                    <div class="item-counter">
                        <input type="number" class="item-count" name="qty" placeholder="qty">
                    </div>
                    <p class="sm-price">200</p>
                    <button class="sm-delete-btn"><img src="img/close.png" alt="" ></button>
                </div>-->
            </form>
            </div>
        </div>
        <div class="checkout-section">
            <div class="checkout-box">
                <p class="text">your total bill,</p>
                <h1 class="bill"><?php global $sum; echo "Rs. ".$sum;?></h1>
                <a href="delivery.php" class="checkout-btn">checkout</a>             
            </div>

        </div>
    </div>

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


    <script src="js/home.js"></script>
    <script src="js/cart.js"></script>
    
</body>
</html>

<?php
if(isset($_POST["delete"]))
{
$p = $_POST["delete"];
  //echo "<script>window.alert('hhheeee')</script>";
  $query = "delete from cart where prod_id = $p";
  $result = pg_query($conn,$query);
  if(pg_num_rows($result)==0)
  {
      echo "<script>window.alert('item removed from cart');</script>";
  }
  else
  {
     // echo "<script>window.alert('item does not exists in cart');</script>";
        echo "<script>window.open('cart.php','_self')</script>";
  }
  $_POST["cart"] =-1;
}
else
{
  echo "<script>window.alert('click to continue');<script>";
}

?>