<?php
include('C:\wamp\www\Project\home_page\connect.php');
@session_start();
//echo "<script> setTimeout(function(){window.location.reload();},5000);</script>"
//global $conn;

function add_to_cart($p)
{   global $conn;
    $query = "select * from cart where prod where prod_id = $p";
    $result = pg_query($conn,$query);
    if(pg_num_rows($result)==0)
    {
        $query = "insert into cart values($p)";
        $result = pg_query($conn,$query);

    }
    else
    {
        echo "<script>window.alert('already added to cart')</script>";
    }

}
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
    
</head>
<body>
    <nav class="navbar">
        
    </nav>

    <section class="search-results">
        <h2 class="heading">search results for <span id="search-key">product</span></h2>
        <section class="cards-container">
        </section>
        <?php
        include('C:\wamp\www\Project\home_page\connect.php');
            $email = $_COOKIE["email"];
            $query = "select * from product where user_id in (select user_id from user_custom where email = '$email')";
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
        <!--<div class="product-container">

            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">50% off</span>
                    <img src="img/card1.png" alt="" class="product-thumb">
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
                    <img src="img/card2.png" alt="" class="product-thumb">
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
            </div>
        </div>-->
    </section>

    <footer>
    </footer>

    <script src="js/nav.js"></script>
    <script src="js/footer.js"></script>
    
</body>
</html>