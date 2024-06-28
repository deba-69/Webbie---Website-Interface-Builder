<?php
include('C:\wamp\www\Project\home_page\connect.php');
@session_start();
//echo "<script> setTimeout(function(){window.location.reload();},5000);</script>";
$email = $_COOKIE["email"];
$query = "select * from user_template where user_id in (select user_id from user_custom where email = '$email') and t_id=1";
$res = pg_query($conn,$query);
$web = pg_fetch_assoc($res); 

?>

<html>
    <head>
        <link rel="stylesheet" href="css/home.css">
        <link rel="stylesheet" href="css/product.css">
        <style>
            .cart-section{
                margin-top: 70px;
            }
        </style>
    </head>
    <body>
        <div>
        <nav>
            <div class="menu">
              <div class="logo">
                <a href="#"><?php echo $web["web_name"]; ?></a>
              </div>
              <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="product.php">Product</a></li>
                <li><a href="#">About</a></li>
                <li><a href="cart.php">Cart</a></li>
              </ul>
            </div>
          </nav>
        </div>

    <div class="cart-section">
    
    <div class="table-heading">
      <h2 class="cart-product">Product</h2>
      <h2 class="cart-price">Price</h2>
      <h2 class="cart-quantity">Quantity</h2>
      <h2 class="cart-total">Total</h2>
    </div>  
    
    <?php
      global $conn;
      $query = "select * from product where prod_id in (select prod_id from cart)";
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
                        echo "<div class='table-content'>
                        <div class='cart-product'>  
                          <div class='cart-image-box'>
                            <div class='cart-images' id='image-10' style = 'background-image:url(../public/img/$img);'></div>
                          </div>
                          <h2 class='cart-item'>$name</h2>
                          <p class='cart-description'>$des</p>
                        </div>
                        <div class='cart-price'>
                          <h3 class='price'>Rs.$price</h3>
                        </div>
                        <div class='cart-quantity'>
                          <p>$qty</p>
                        </div>
                        <div class='cart-total'>
                          <h3 class='price'>Rs.$cost</h3>
                          <button type='button' class='remove' name='remove-1' id='remove-1'>x</button>
                        </div>
                      </div>";
                    }
                }
                ?>
    <!--<div class="table-content">
      <div class="cart-product">  
        <div class="cart-image-box">
          <div class="cart-images" id="image-10"></div>
        </div>
        <h2 class="cart-item">Lemon</h2>
        <p class="cart-description">A bag of lemons</p>
      </div>
      <div class="cart-price">
        <h3 class="price">$4.99</h3>
      </div>
      <div class="cart-quantity">
        <input type="text" name="cart-1-quantity" id="cart-1-quantity" value="1">
      </div>
      <div class="cart-total">
        <h3 class="price">$4.99</h3>
        <button type="button" class="remove" name="remove-1" id="remove-1">x</button>
      </div>
    </div>
    
    <div class="table-content">
      <div class="cart-product">  
        <div class="cart-image-box">
          <div class="cart-images" id="image-7"></div>
        </div>
        <h2 class="cart-item">Banana</h2>
        <p class="cart-description">A bag of bananas</p>
      </div>
      <div class="cart-price">
        <h3 class="price">$4.99</h3>
      </div>
      <div class="cart-quantity">
        <input type="text" name="cart-1-quantity" id="cart-1-quantity" value="1">
      </div>
      <div class="cart-total">
        <h3 class="price">$4.99</h3>
        <button type="button" class="remove" name="remove-2" id="remove-2">x</button>
      </div>
    </div>
    
    <div class="table-content">
      <div class="cart-product">  
        <div class="cart-image-box">
          <div class="cart-images" id="image-3"></div>
        </div>
        <h2 class="cart-item">Passionfruit</h2>
        <p class="cart-description">A bag of passionfruit</p>
      </div>
      <div class="cart-price">
        <h3 class="price">$4.99</h3>
      </div>
      <div class="cart-quantity">
        <input type="text" name="cart-1-quantity" id="cart-1-quantity" value="1">
      </div>
      <div class="cart-total">
        <h3 class="price">$4.99</h3>
        <button type="button" class="remove" name="remove-3" id="remove-3">x</button>
      </div>
    </div>-->
    
    <div class="coupon">
      <input type="text" name="coupon" id="coupon" placeholder="COUPON CODE">
      <button type="button" name="coupon" id="coupon">Submit</button>  
    </div>
    
    <div class="checkout">
      <button type="button" name="update" id="update">Update</button>
      <button type="button" name="checkout" id="checkout">Checkout</button>
      <div class="final-cart-total">
        <h3 class="price"><?php global $sum; echo $sum; ?></h3>
      </div>
    </div>
    
    <div class="keep-shopping">
      <button type="button" name="keep-shopping" id="keep-shopping">Keep Shopping</button>  
    </div>
  </div>

  <footer>
    <div class="content">
      <div class="left box">
        <div class="lower">
          <div class="topic">Contact us</div>
          <div class="phone">
            <a href="#"><i class="fas fa-phone-volume"></i>+007 9089 6767</a>
          </div>
          <div class="email">
            <a href="#"><i class="fas fa-envelope"></i>abc@gmail.com</a>
          </div>
        </div>
      </div>
      <div class="middle box">
        <div class="topic">Our Services</div>
        <div><a href="#">Web Design, Development</a></div>
        <div><a href="#">Web UX Design, Reasearch</a></div>
       
      </div>
      <div class="right box">
        <div class="topic">Subscribe us</div>
        <form action="#">
          <input type="text" placeholder="Enter email address">
          <input type="submit" name="" value="Send">
        </form>
      </div>
    </div>
    <div class="bottom">
      <p>Copyright © 2020 <a href="#">CodingLab</a> All rights reserved</p>
    </div>
  </footer>

    </body>
</html>