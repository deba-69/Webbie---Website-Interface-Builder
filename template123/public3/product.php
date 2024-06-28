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
        .listing-section{
            margin-top: 80px;
        }
    </style>
</head>
<body>

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
      <!--<div class="img">
      <div class="center">
        <div class="title">Create Amazing Website</div>
        <div class="sub_title">Pure HTML & CSS Only</div>
      </div>
      </div>-->

<form action="" method="post">    
<div class="listing-section">

<?php
        include('C:\wamp\www\Project\home_page\connect.php');
        $email = $_COOKIE["email"];
        $query = "select * from product where user_id in (select user_id from user_custom where email = '$email')";
        $res = pg_query($conn,$query);
        if(pg_num_rows($res)>0)
        {
                /*echo "<script>window.alert('correct query')</script>";*/
                while($data = pg_fetch_assoc($res))
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
                echo "<div class='product'>
                <div class='image-box'>
                <div class='images' id='image-1' style = 'background-image:url(../public/img/$img1);'></div>
                </div>
                <div class='text-box'>
                  <h2 class='item'>$prod_name</h2>
                  <h3 class='price'>Rs.$sell_price</h3>
                  <p class='description'>$short_des</p>
                  <button name='cart' id='item-1-button' value = $prod_id>Add to Cart</button>
                </div>
              </div>";
            
                }
            }


    ?>
    <!--<div class="product">
      <div class="image-box">
        <div class="images" id="image-1"></div>
      </div>
      <div class="text-box">
        <h2 class="item">Orange</h2>
        <h3 class="price">$4.99</h3>
        <p class="description">A bag of delicious oranges!</p>
        <button type="button" name="item-1-button" id="item-1-button">Add to Cart</button>
      </div>
    </div>
    <div class="product">
      <div class="image-box">
        <div class="images" id="image-2"></div>
      </div>
      <div class="text-box">
        <h2 class="item">Apple</h2>
        <h3 class="price">$4.99</h3>
        <p class="description">A bag of delicious apples!</p>
        <button type="button" name="item-2-button" id="item-2-button">Add to Cart</button>
      </div>
    </div>
    <div class="product">
      <div class="image-box">
        <div class="images" id="image-3"></div>
      </div>
      <div class="text-box">
        <h2 class="item">Passionfruit</h2>
        <h3 class="price">$4.99</h3>
        <p class="description">delicious passionfruit!</p>
        <button type="button" name="item-3-button" id="item-3-button">Add to Cart</button>
      </div>
    </div>
    <div class="product">
      <div class="image-box">
        <div class="images" id="image-4"></div>
      </div>
      <div class="text-box">
        <h2 class="item">Pineapple</h2>
        <h3 class="price">$4.99</h3>
        <p class="description">A bag of delicious pineapples!</p>
        <button type="button" name="item-4-button" id="item-4-button">Add to Cart</button>
      </div>
    </div>
    <div class="product">
      <div class="image-box">
        <div class="images" id="image-5"></div>
      </div>
      <div class="text-box">
        <h2 class="item">Mango</h2>
        <h3 class="price">$4.99</h3>
        <p class="description">A bag of delicious mangos!</p>
        <button type="button" name="item-5-button" id="item-5-button">Add to Cart</button>
      </div>
    </div>
    <div class="product">
      <div class="image-box">
        <div class="images" id="image-6"></div>
      </div>
      <div class="text-box">
        <h2 class="item">Coconut</h2>
        <h3 class="price">$4.99</h3>
        <p class="description">A bag of delicious coconuts!</p>
        <button type="button" name="item-6-button" id="item-6-button">Add to Cart</button>
      </div>
    </div>
    <div class="product">
      <div class="image-box">
        <div class="images" id="image-7"></div>
      </div>
      <div class="text-box">
        <h2 class="item">Banana</h2>
        <h3 class="price">$4.99</h3>
        <p class="description">A bag of delicious bananas!</p>
        <button type="button" name="item-7-button" id="item-7-button">Add to Cart</button>
      </div>
    </div>
    <div class="product">
      <div class="image-box">
        <div class="images" id="image-8"></div>
      </div>
      <div class="text-box">
        <h2 class="item">Plum</h2>
        <h3 class="price">$4.99</h3>
        <p class="description">A bag of delicious plums!</p>
        <button type="button" name="item-8-button" id="item-8-button">Add to Cart</button>
      </div>
    </div>
    <div class="product">
      <div class="image-box">
        <div class="images" id="image-9"></div>
      </div>
      <div class="text-box">
        <h2 class="item">Avocado</h2>
        <h3 class="price">$4.99</h3>
        <p class="description">A bag of delicious avocados!</p>
        <label for="item-9-quantity">Quantity:</label>
        <input type="text" name="item-9-quantity" id="item-9-quantity" value="1">
        <button type="button" name="item-9-button" id="item-9-button">Add to Cart</button>
      </div>
    </div>
    <div class="product">
      <div class="image-box">
        <div class="images" id="image-10"></div>
      </div>
      <div class="text-box">
        <h2 class="item">Lemon</h2>
        <h3 class="price">$4.99</h3>
        <p class="description">A bag of delicious lemons!</p>
        <label for="item-10-quantity">Quantity:</label>
        <input type="text" name="item-10-quantity" id="item-10-quantity" value="1">
        <button type="button" name="item-10-button" id="item-10-button">Add to Cart</button>
      </div>
    </div>-->
  </div>
</form>
  
  <!--<div class="cart-section">
    
    <div class="table-heading">
      <h2 class="cart-product">Product</h2>
      <h2 class="cart-price">Price</h2>
      <h2 class="cart-quantity">Quantity</h2>
      <h2 class="cart-total">Total</h2>
    </div>  
    
    <div class="table-content">
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
    </div>
    
    <div class="coupon">
      <input type="text" name="coupon" id="coupon" placeholder="COUPON CODE">
      <button type="button" name="coupon" id="coupon">Submit</button>  
    </div>
    
    <div class="checkout">
      <button type="button" name="update" id="update">Update</button>
      <button type="button" name="checkout" id="checkout">Checkout</button>
      <div class="final-cart-total">
        <h3 class="price">$14.97</h3>
      </div>
    </div>
    
    <div class="keep-shopping">
      <button type="button" name="keep-shopping" id="keep-shopping">Keep Shopping</button>  
    </div>
    
  </div>-->


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

  <?php
global $conn;
$q = "select * from user_custom where email = '$email'";
$id = pg_fetch_assoc(pg_query($conn,$q));
$u_id = $id["user_id"];
echo "<script>window.alert('hhheeee')</script>";
if(isset($_POST["cart"]))
{
$p = $_POST["cart"];
  echo "<script>window.alert('hhheeee')</script>";
  $query = "select * from cart where prod_id = $p and user_id = $u_id";
  $result = pg_query($conn,$query);
  if(pg_num_rows($result)==0)
  {
      $query = "insert into cart values($p,1,$u_id)";
      $result = pg_query($conn,$query);
      if($result===true)
      echo "<script>window.alert('added to cart');</script>";
      $_POST["cart"]=-1;
      echo "<script>window.open('cart.php','_self')</script>";

  }
  else
  {
    $query = "update cart set qty = qty+1 where prod_id = $p and user_id=$u_id";
    $result = pg_query($conn,$query);
    echo "<script>window.open('cart.php','_self')</script>";
    //echo "<script>window.alert('item exits in cart');</script>";
    //$_POST = array();
  }
  //unset($_POST);
  //$_POST = array();
}