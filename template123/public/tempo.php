<?php
include('C:\wamp\www\Project\home_page\connect.php');
@session_start();
echo "<script> setTimeout(function(){window.location.reload();},5000);</script>";
$email = $_COOKIE["email"];
$query = "select * from user_template where user_id in (select user_id from user_custom where email = '$email') and t_id=3";
$res = pg_query($conn,$query);
$web = pg_fetch_assoc($res); 

$cnt = "select sum(qty) from cart group by user_id having user_id in (select user_id from user_custom where email='$email')";
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
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clothing- Best in World</title>
    <link href="css/home.css" rel="stylesheet">


    <?php
     echo '<link href="css/seller.css" rel="stylesheet">';
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
    body{
        padding:0;
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

    <section id="men-tshirt-products">

    </section>
        
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
            echo "<section class='product $sect_name'>
            <h2 class='product-category'>$sect_name</h2>
            <button class='pre-btn'><img src='img/arrow.png' alt='na'></button>
            <button class='nxt-btn'><img src='img/arrow.png' alt='na'></button>
            <div class='product-container'>";
            $query = "select * from product where sect_id = $sect_id and t_id = $t_id";
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
                echo"</div></section>";
            }
            }
        }


    ?>
    <!-- cards-container -->
    <!--<section class="product ">
        <h2 class="product-category">best selling</h2>
        <button class="pre-btn"><img src="img/arrow.png" alt="na"></button>
        <button class="nxt-btn"><img src="img/arrow.png" alt="na"></button>
        <div class="product-container">

            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">50% off</span>
                    <img src="img/img1.jpg" alt="" class="product-thumb">
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
                    <img src="img/destination-6.jpg" alt="" class="product-thumb">
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
                    <img src="img/package-6.jpg" alt="" class="product-thumb">
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
                    <img src="img/package-5.jpg" alt="" class="product-thumb">
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
                    <img src="img/package-1.jpg" alt="" class="product-thumb">
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
                    <img src="img/package-2.jpg" alt="" class="product-thumb">
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
                    <img src="img/package-3.jpg" alt="" class="product-thumb">
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
                    <img src="img/package-4.jpg" alt="" class="product-thumb">
                    <button class="card-btn">add to wishlist</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des"> a short line about...</p>
                    <span class="price">$20</span>
                    <span class="actual-price">$40</span>
                </div>
            </div>
        </div>
    </section>
    -->
     <!-- collections 
     <section class="collection-container">
        <a href="#" class="collection">
            <img src="img/women-collection.png" alt="">
            <p class="collection-title">women <br> apparels</p>
        </a>
        <a href="#" class="collection">
            <img src="img/men-collection.png" alt="">
            <p class="collection-title">men <br> apparels</p>
        </a>
        <a href="#" class="collection">
            <img src="img/accessories-collection.png" alt="">
            <p class="collection-title">accessories</p>
        </a>
     </section>-->

     <section id="men-tshirt-products-2"></section>

      <!-- cards-container -->
    <!--<section class="product">
        <h2 class="product-category">Shoes</h2>
        <button class="pre-btn"><img src="img/arrow.png" alt="na"></button>
        <button class="nxt-btn"><img src="img/arrow.png" alt="na"></button>
        <div class="product-container">

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
                    <img src="img/card11.png" alt="" class="product-thumb">
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
                    <img src="img/package-1.jpg" alt="" class="product-thumb">
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
                    <img src="img/package-2.jpg" alt="" class="product-thumb">
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
                    <img src="img/package-3.jpg" alt="" class="product-thumb">
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
                    <img src="img/package-4.jpg" alt="" class="product-thumb">
                    <button class="card-btn">add to wishlist</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des"> a short line about...</p>
                    <span class="price">$20</span>
                    <span class="actual-price">$40</span>
                </div>
            </div>
        </div>
    </section>

      cards-container
     <section class="product">
        <h2 class="product-category">Shirts</h2>
        <button class="pre-btn"><img src="img/arrow.png" alt="na"></button>
        <button class="nxt-btn"><img src="img/arrow.png" alt="na"></button>
        <div class="product-container">

            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">50% off</span>
                    <img src="img/card5.png" alt="" class="product-thumb">
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
                    <img src="img/card6.png" alt="" class="product-thumb">
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
                    <img src="img/card7.png" alt="" class="product-thumb">
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
                    <img src="img/card8.png" alt="" class="product-thumb">
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
                    <img src="img/package-2.jpg" alt="" class="product-thumb">
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
                    <img src="img/package-3.jpg" alt="" class="product-thumb">
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
                    <img src="img/package-4.jpg" alt="" class="product-thumb">
                    <button class="card-btn">add to wishlist</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des"> a short line about...</p>
                    <span class="price">$20</span>
                    <span class="actual-price">$40</span>
                </div>
            </div>
        </div>
    </section>
-->
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
    
    <!--<script>
        getproducts('Men Tshirt').then(data => createProductSlider(data,'#men-tshirt-products','Men T-shirt'));

        getproducts('Men Tshirt').then(data => createProductSlider(data,'#men-tshirt-products-2','Men T-shirt'));
    </script>-->
    
</body>
</html>

