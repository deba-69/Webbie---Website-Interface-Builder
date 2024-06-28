<?php
include('C:\wamp\www\Project\home_page\connect.php');
@session_start();
$email = $_COOKIE["email"];
$query = "select * from user_template where t_id = 3 and user_id in (select user_id from user_custom where email = '$email')";
$r = pg_query($conn,$query);
$da = pg_fetch_assoc($r);

if(pg_num_rows($r)>0)
{
    $id = $da["feat2"];
    $err = pg_last_error();
    echo "<script>window.alert('$id')</script>";
}
else
{
    echo "<script>window.alert('hii')</script>";

}

$query = "select * from user_template where user_id in (select user_id from user_custom where email = '$email')";
$res = pg_query($conn,$query);
$web = pg_fetch_assoc($res); 

$cnt = "select sum(qty) from cart group by user_id having user_id in (select user_id from user_custom where email='$email')";
$item = pg_query($conn,$cnt);
$count = pg_fetch_assoc($item);
$c = $count["sum"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link href="css/home.css" rel="stylesheet">
    <style>
        .collection-container{
            margin-top: 10px;
        }
        .collection-content p{
            color:#706e6e;
            /*background-color: #f5f5f5;
            */
            font-size: 30px;
            padding: 20px 20px;
            font-family: 'Brush Script MT', cursive;
        }
        .collection-info p{
            color:#706e6e;
            /*background-color: #f5f5f5;
            */
            font-size: 25px;
            margin: 10px 10px;
            font-family: 'Brush Script MT', cursive;
        }
        .image{
            height:200px;
            width:100%;
        }
        <?php
        echo "sup{position: relative;
        font-size: 15px;
        display: block;
        bottom: 1px;
        left: 11px;
        color: #383838;
        font-weight: 800;
        border: 1px solid #aeaeae;
        padding: 5px 10px;
    }"
    ?>
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
    

    <!-- header -->
    <header class="hero-section" style="background-image: url('prod_img/<?php global $web; echo $web["web_img"]?>');">
        <div class="content">
            <p class="logo" style="font-family: 'Brush Script MT', cursive;font-size: 80px;text-align: center;color: <?php global $web; echo $web["name_color"]; ?> ; text-transform:capitalize; font-weight: 500;margin: auto;"><?php global $web; echo $web["web_name"];?></p>
            <p class="sub-heading" style="margin-top: 10px; text-align: center; color: <?php global $web; echo $web["head_color"]; ?>; text-transform: capitalize; font-size: 35px; font-weight: 300; font-family: Copperplate, Papyrus, fantasy;"><?php echo $web["web_head"];?></p>
        </div>

    </header>
    <form action=" " method="post">
    <div class="collection-container">
        <div class="collection">
            <!--<img src="img/about-1.jpeg" alt="">-->
            <p class="collection-title">About Us</p><br>
            <div class="collection-content">
            <p><?php global $data; echo $da["about_us"]; ?></p>
            </div>
        </div>
        <div class="collection">
            <!--<img src="img/women-collection.png" alt="">-->
           
            <p class="collection-title"><?php echo $da["feat1"]; ?></p>
            <div class="collection-info">
                <p><?php echo $da["feat1_des"]; ?></p>
            </div>
            
        </div>
        <div class="collection">
            <!--<img src="img/men-collection.png" alt="">-->
            <p class="collection-title"><?php echo $da["feat2"]; ?></p>
            <div class="collection-info">
                <p><?php echo $da["feat2_des"]; ?></p>
            </div>
        </div>
        <div class="collection">
            <!--<img src="img/men-collection.png" alt="">-->
            <p class="collection-title"><?php echo $da["feat3"]; ?></p>
            <div class="collection-info">
                <p><?php echo $da["feat3_des"]; ?></p>
            </div>
        </div>

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