<?php
include('C:\wamp\www\Project\home_page\connect.php');
@session_start();
echo "<script> setTimeout(function(){window.location.reload();},5000);</script>";
$email = $_COOKIE["email"];
$query = "select * from user_template where user_id in (select user_id from user_custom where email = '$email') and t_id=1";
$res = pg_query($conn,$query);
$web = pg_fetch_assoc($res); 

/*$cnt = "select sum(qty) from cart group by user_id having user_id in (select user_id from user_custom where email='$email')";
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
}*/
?>
<!DOCTYPE html>
<!-- Created By CodingNepal - www.codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!------<title> Website Layout | CodingLab</title>------>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
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
  <div class="img">
  <div class="center">
    <div class="title" style="color:<?php echo $web["name_color"];?>"><?php echo $web["web_name"]; ?></div>
    <div class="sub_title" style="color:<?php echo $web["head_color"];?>"><?php echo $web["web_head"]; ?></div>
  </div>
  </div>

<form action="" method="post">

<?php
        include('C:\wamp\www\Project\home_page\connect.php');
        $email = $_COOKIE["email"];
        $query = "select * from section where user_id in (select user_id from user_custom where email = '$email')";
        $res = pg_query($conn,$query);
        if(pg_num_rows($res)>0)
        {
            
            while($data = pg_fetch_assoc($res))
            {
                $sect_name = $data["sect_name"];
                $sect_id = $data["sect_id"];
            echo "<div>
            <h1>$sect_name</h1>
            <div class='listing-section'>";
            $query = "select * from product where sect_id = $sect_id";
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
                echo "<div class='product'>
                <div class='image-box'>
                  <div class='images' id='image-1' style = 'background-image:url(../public/img/$img1);'></div>
                </div>
                <div class='text-box'>
                  <h2 class='item'>$prod_name</h2>
                  <h3 class='price'>Rs.$sell_price</h3>
                  <p class='description'>$short_des</p>
                  <button type='button' name='item-1-button' id='item-1-button'>Add to Cart</button>
                </div>
              </div>";
            
                }
                echo"</div></div>";
            }
            }
        }


    ?>
  <!--<div>
    <h1>tero aasd asdasd</h1>

  <div class="listing-section">
    <div class="product">
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
        <p class="description">A bag of delicious passionfruit!</p>
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
    </div>

</div>-->

</form>
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