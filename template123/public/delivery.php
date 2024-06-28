<?php
include('C:\wamp\www\Project\home_page\connect.php');
@session_start();
if(isset($_COOKIE["email"]))
{
$email = $_COOKIE["email"];
$query = "select * from user_custom where email = '$email'";
$res = pg_query($conn,$query);
$data = pg_fetch_assoc($res);
$name = $data["name"];

$email = $_COOKIE["email"];
$query = "select * from user_template where user_id in (select user_id from user_custom where email = '$email')";
$res = pg_query($conn,$query);
$web = pg_fetch_assoc($res); 

$cnt = "select sum(qty) from cart group by user_id having user_id in (select user_id from user_custom where email='$email')";
$item = pg_query($conn,$cnt);
$count = pg_fetch_assoc($item);
$c = $count["sum"];
if(isset($_POST["order"]))
{
    echo "<script>window.alert('$name your order has been placed')</script>";
    echo "<script>window.open('cart.php','_self');</script>";
}
else
{
    echo "<script>window.alert('Order can not be placed')</script>";
}
}
else
{
    echo "<script>window.alert('login to continue')</script>";
    echo "<script>window.open('tempo.php','_self');</script>";
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery</title>
    <link rel="stylesheet" href="css/signup.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/checkout.css">
    <style>
    input[type="submit"]{
    width: 300px;
    height: 40px;
    text-align: center;
    line-height: 40px;
    background: #383838;
    color: #fff;
    border-radius: 2px;
    text-transform: capitalize;
    border: none;
    cursor: pointer;
    display: block;
    margin: 30px 0;
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
    <form action="" method="post">
    <div class="form">
        <h1 class="heading">checkout</h1>
        <p class="text">delivery address</p>
        <input type="text" name="" id="address" placeholder="address">
        <input type="text" name="" id="street" placeholder="street">
        <div class="three-input-container">
            <input type="text" name="" id="city" placeholder="city">
            <input type="text" name="" id="state" placeholder="state">
            <input type="text" name="" id="pincode" placeholder="pin code">
        </div>
        <input type="text" name="" id="landmark" placeholder="Landmark">
        <input type="submit" name="order" id="street" placeholder="Order">
    </div>
    </form>

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

    
</body>
</html>