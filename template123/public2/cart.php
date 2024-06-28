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
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Basket</title>
  <link rel="stylesheet" href="css/cart.css">
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
  <main>
    <form action="" method="post">
    <div class="basket">
      <!--<div class="basket-module">
        <label for="promo-code">Enter a promotional code</label>
        <input id="promo-code" type="text" name="promo-code" maxlength="5" class="promo-code-field">
        <button class="promo-code-cta">Apply</button>
      </div>-->
      <div class="basket-labels">
        <ul>
          <li class="item item-heading">Item</li>
          <li class="price">Price</li>
          <li class="subtotal">Subtotal</li>
        </ul>
      </div>
      <?php
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
                        echo "<div class='basket-product'>
                        <div class='item'>
                          <div class='product-image'>
                            <img src='../public/img/$img' alt='Placholder Image 2' class='product-frame'>
                          </div>
                          <div class='product-details'>
                            <h1><strong><span class='item-quantity'>$qty</span> x $name</strong></h1>
                            <p><strong>$des</strong></p>
                            <p>Product Qty - $qty</p>
                          </div>
                        </div>
                        <div class='price'>Rs.$price</div>
                        <div class='subtotal'>$cost</div>
                        <div class='remove'>
                          <button>Remove</button>
                        </div>
                      </div>";
                    }
                }
                ?>

      <!--<div class="basket-product">
        <div class="item">
          <div class="product-image">
            <img src="../public/img/card10.png" alt="Placholder Image 2" class="product-frame">
          </div>
          <div class="product-details">
            <h1><strong><span class="item-quantity">4</span> x Eliza J</strong> Lace Sleeve Cuff Dress</h1>
            <p><strong>Navy, Size 18</strong></p>
            <p>Product Code - 232321939</p>
          </div>
        </div>
        <div class="price">26.00</div>
        <div class="quantity">
          <input type="number" value="4" min="1" class="quantity-field">
        </div>
        <div class="subtotal">104.00</div>
        <div class="remove">
          <button>Remove</button>
        </div>
      </div>
      <div class="basket-product">
        <div class="item">
          <div class="product-image">
            <img src="../public/img/card11.png" alt="Placholder Image 2" class="product-frame">
          </div>
          <div class="product-details">
            <h1><strong><span class="item-quantity">1</span> x Whistles</strong> Amella Lace Midi Dress</h1>
            <p><strong>Navy, Size 10</strong></p>
            <p>Product Code - 232321939</p>
          </div>
        </div>
        <div class="price">26.00</div>
        <div class="quantity">4</div>
        <div class="subtotal">26.00</div>
        <div class="remove">
          <button>Remove</button>
        </div>
      </div>
    </div>-->
    </div>
    <aside>
      <div class="summary">
        <div class="summary-total-items"><span class="total-items"></span> Items in your Bag</div>
        <div class="summary-subtotal">
          <div class="subtotal-title">Subtotal</div>
          <div class="subtotal-value final-value" id="basket-subtotal"><?php global $sum; echo $sum; ?></div>
          <div class="summary-promo hide">
            <div class="promo-title">Promotion</div>
            <div class="promo-value final-value" id="basket-promo"></div>
          </div>
        </div>
        <div class="summary-total">
          <div class="total-title">Total</div>
          <div class="total-value final-value" id="basket-total"><?php global $sum; echo $sum; ?></div>
        </div>
        <div class="summary-checkout">
          <button class="checkout-cta">Go to Secure Checkout</button>
        </div>
      </div>
    </aside>
    </form>
  </main>

  <footer>
    <div class="footer0">
      <h1>ShoPperZ</h1>
    </div>
    <!--<div class="footer2">
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
    </div>-->
    <div class="footer3">Copyright © <h4>ShoPperZ</h4> 2021-2028</div>
  </footer>

</body>

</html>

