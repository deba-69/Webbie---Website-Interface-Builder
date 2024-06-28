<?php
include('C:\wamp\www\Project\home_page\connect.php');
@session_start();
echo "<script> setTimeout(function(){window.location.reload();},5000);</script>";
$email = $_COOKIE["email"];
$query = "select * from user_template where user_id in (select user_id from user_custom where email = '$email') and t_id=1";
$res = pg_query($conn,$query);
$web = pg_fetch_assoc($res); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex">
  <title> fitness </title>
  <!--     <link rel="shortcut icon" href="https://source.unsplash.com/15x15/?gym,icon" type="image/x-icon"> -->
  <!-- css -->

  <!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">-->

  <link rel="stylesheet" href="style.css">
  <style>
 /*   * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  list-style: none;
  font-family: "Open Sans", sans-serif;
}

body {
  display: grid;
  place-items: center;
  min-height: 100vh;
  background-color: #171717;
}*/

.pricing-plans {
  gap: 32px;
  display: flex;
  flex-wrap: wrap;
  flex-direction: row;
  justify-content: center;
  width: 100%;
  padding: 64px;
}

/*.pricing-card {
  --col: #e4e4e7;
  position: relative;
  min-width: 360px;
  padding: 32px;
  padding-bottom: 96px;
  border-radius: 4px;
  border: 1px solid #262626;
  background-color: #26262620;
  box-shadow: 0 0 32px transparent;
  text-align: center;
}*/

.pricing-card {
    --col: #e4e4e7;
    position: relative;
    min-width: 300px;
    padding: 30px;
    padding-bottom: 59px;
    border-radius: 4px;
    border: 1px solid #262626;
    background-color: #26262620;
    box-shadow: 0 0 32px transparent;
    text-align: center;
}

.pricing-card.basic {
  --col: #0891b2;
}

.pricing-card.standard {
  --col: #059669;
}

.pricing-card.premium {
  --col: #c026d3;
}

.pricing-card:hover {
  border-color: var(--col);
  background-color: #26262680;
  box-shadow: 0 0 32px #171717;
  transform: translateY(-16px) scale(1.02);
  transition: all 0.5s ease;
}

.pricing-card > *:not(:last-child) {
  margin-bottom: 32px;
}

.pricing-card .heading h4 {
  padding-bottom: 12px;
  color: var(--col);
  font-size: 24px;
  font-weight: normal;
}

.pricing-card .heading p {
  color: #111;
  font-size: 14px;
  font-weight: lighter;
}

.pricing-card .price {
  position: relative;
  color: var(--col);
  font-size: 60px;
  font-weight: bold;
}

.pricing-card .price sub {
  position: absolute;
  bottom: 14px;
  color: #111;
  font-size: 14px;
  font-weight: lighter;
}

.pricing-card .features li {
  padding-bottom: 16px;
  color: #180e0e;
  font-size: 16px;
  font-weight: lighter;
  text-align: left;
}

.pricing-card .features li i, .pricing-card .features li strong {
    color: #383838;
    font-size: 16px;
    text-align: left;
}

.pricing-card .features li strong {
  padding-left: 24px;
}

.pricing-card .cta-btn {
  position: absolute;
  bottom: 32px;
  left: 50%;
  transform: translateX(-50%);
  width: 200px;
  padding: 12px;
  border-radius: 4px;
  border: 1px solid var(--col);
  background-color: var(--col);
  color: #e4e4e7;
  font-size: 20px;
  font-weight: bold;
}

.pricing-card .cta-btn:active {
  background-color: transparent;
  color: var(--col);
  transition: all 0.3s ease;
}

  </style>

</head>

<body>
  <header>
    <div class="logo">
      <h1 style="font-size:30px; color:#fff"><?php echo $web["web_name"]; ?></h1>
    </div>
    <nav>
      <ul id="menu">
        <li><a href="#home">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#service">Plans</a></li>
        <li><a href="#contact">Contact Us</a></li>
      </ul>
    </nav>
    <div class="trigger-main">
      <a href="#" class="hamBurger">
        <span class="one"></span>
        <span class="two"></span>
      </a>
    </div>
  </header>

  <!-- home -->

  <section class="home" id="home">
    <div class="slider">
      <div class="slide active" style="background-image: url('../../public/img/<?php echo $web["web_img"]; ?>')">
        <div class="container">
          <div class="caption">
            <h1><?php echo $web["web_name"]; ?></h1>
            <p><?php echo $web["web_head"]; ?></p>
          </div>
        </div>
      </div>
    </div>

    <!-- controls  -->

    <!-- indicators -->
    <!--<div class="indicator">
    </div>-->

  </section>
  <!-- home -->
  <!-- About -->
  <section id="about">
    <div class="container">
      <h1 class="title ">About</h1>
      <div class="about-row">
        <div class="about-col">
          <img src="../../public/img/<?php echo $web["img1"]; ?>" alt="workout">
        </div>
        <div class="about-col">
          <div class="caption">
            <h1><?php echo $web["feat1"]; ?></h1>
        <p><?php echo $web["feat1_des"]; ?></p>
            <a href="#" class="button"> click me</a>
          </div>
        </div>
      </div>
      <div class="about-row">
        <div class="about-col">
          <img src="../../public/img/<?php echo $web["img2"]; ?>" alt="workout">
        </div>
        <div class="about-col">
          <div class="caption">
            <h1><?php echo $web["feat2"]; ?></h1>
        <p><?php echo $web["feat2_des"]; ?></p>
            <a href="#" class="button"> click me</a>
          </div>
        </div>
      </div>
      <div class="about-row">
        <div class="about-col">
          <img src="../../public/img/<?php echo $web["img3"]; ?>" alt="workout">
        </div>
        <div class="about-col">
          <div class="caption">
            <h1><?php echo $web["feat3"]; ?></h1>
        <p><?php echo $web["feat3_des"]; ?>
        </p>
            <a href="#" class="button"> click me</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- About -->
  <!-- Services -->
  <section id="service">
    <div class="container">
      <h1 class="title ">Pricing</h1>
        
      <section class="pricing-plans">
        <?php
                include('C:\wamp\www\Project\home_page\connect.php');
                $email = $_COOKIE["email"];
                $query = "select * from pricing where user_id in (select user_id from user_custom where email = '$email')";
                $res = pg_query($conn,$query);
                //$data = pg_fetch_assoc($res);
                
                while($data = pg_fetch_assoc($res))
                {
                    $name = $data["name"];
                    $cost = $data["cost"];
                    $p1 = $data["perk1"];
                    $p2 = $data["perk2"];
                    echo "
                    <div class='pricing-card basic'>
                    <div class='heading'>
                    <h4>$name</h4>
                    </div>
                    <p class='price'>
                        $$cost
                    </p>
                    <ul class='features'>
                        <li>
                        <i class='fa-solid fa-check'></i>
                        <strong>$p1</strong>
                        </li>
                        <li>
                        <i class='fa-solid fa-check'></i>
                        <strong>$p2</strong>
                        </li>
                    </ul>
                    <button class='cta-btn'>SELECT</button>
                    </div>
                    ";

                }
        ?>
        <!--<div class="pricing-card basic">
          <div class="heading">
            <h4>WEEKLY</h4>
           
          </div>
          <p class="price">
            $2
          </p>
          <ul class="features">
            <li>
              <i class="fa-solid fa-check"></i>
              <strong>2 Hours of Personal Training</strong>
            </li>
            <li>
              <i class="fa-solid fa-check"></i>
              <strong>Free Consulting</strong>
            </li>
          </ul>
          <button class="cta-btn">SELECT</button>
        </div>
        <div class="pricing-card standard">
          <div class="heading">
            <h4>MONTHLY</h4>
            
          </div>
          <p class="price">
            $5
           
          </p>
          <ul class="features">
            <li>
              <i class="fa-solid fa-check"></i>
              <strong>4 Hours of Personal Training</strong>
            </li>
            <li>
              <i class="fa-solid fa-check"></i>
              <strong>Free Consulting</strong>
            </li>
          </ul>
          <button class="cta-btn">SELECT</button>
        </div>
        <div class="pricing-card premium">
          <div class="heading">
            <h4>YEARLY</h4>
           
          </div>
          <p class="price">
            $10
           
          </p>
          <ul class="features">
            <li>
              <i class="fa-solid fa-check"></i>
              <strong>5 Hours of Personal Training</strong>
            </li>
            <li>
              <i class="fa-solid fa-check"></i>
              <strong>Free Consulting</strong>
            </li>
          </ul>
          <button class="cta-btn">SELECT</button>
        </div>-->
      </section>
      <!--<div class="thumbnail-slider">
        <div class="thumbnail-container">
        <div class="content">
        </div>
      </div>
    </div>-->
  </section>
  <!-- Services -->

  <!-- TEAM -->

  <style>
    .container {
  margin-top: 50px;
}

 img{
   border-radius: 50%;
 }
.container .team {
  width: auto;
  display: flex;
  justify-content: center;
  text-align: center;
  flex-wrap: wrap;
}

.container .team .member {
  width: 325px;
  margin: 10px;
  background: #fff;
  border-radius: 6px;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.07);
  padding: 25px;
}

.container .team .member img {
  width: 80px;
}

.container .team .member h3 {
  color: #444;
}

.container .team .member span {
  font-size: 12px;
  color: #999;
}

.container .team .member p {
  margin: 15px 0;
  font-weight: 400;
  color: #999;
  font-size: 15px;
  text-align: justify;
}
 
.container .team .member .btn a {
  background: #ddd;
  display: block;
  float: right;
  width: 125px;
  margin: 0 10px;
  padding: 10px;
  border-radius: 6px;
  color: #444;
  text-transform: capitalize;
  transition: all 0.3s ease;
}

.container .team .member .btn a:hover {
  background: #5a36dd;
  color: #fff;
}

 
  </style>
  <section>
    <div class="container">
        <h1 class="title ">Our Trainers</h1>
        <div class="container">
  
            <div class="team">

            <?php
                include('C:\wamp\www\Project\home_page\connect.php');
                $email = $_COOKIE["email"];
                $query = "select * from trainer where user_id in (select user_id from user_custom where email = '$email')";
                $res = pg_query($conn,$query);
                //$data = pg_fetch_assoc($res);
                
                while($data = pg_fetch_assoc($res))
                {
                    $name = $data["trainer_name"];
                    $email = $data["trainer_email"];
                    $p1 = $data["trainer_des"];
                    $img = $data["trainer_img"];
                    echo "
                    <div class='member'>
                <img src='../../public/img/$img' alt='member_image'>
                <h3>$name</h3>
                <span>$email</span>
                <p>$p1</p>
              </div>
                    ";

                }
        ?>
              <!--<div class="member">
                <img src="" alt="member_image">
                <h3>Paul Doe</h3>
                <span>doe@gmail.com</span>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.amet consecteturamet consecteturamet Laboriosam voluptatum fuga iure. Est, dicta voluptatum.</p>
              </div>
              <div class="member">
                <img src="https://images.unsplash.com/photo-1527980965255-d3b416303d12?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=800&q=80" alt="member_image">
                <h3>John Doe</h3>
                <span>doe@gmail.com</span>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.amet consecteturamet consecteturamet Laboriosam voluptatum fuga iure. Est, dicta voluptatum.</p>
        
              </div>
              <div class="member">
                <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="member_image">
                <h3>Alex Doe</h3>
                <span>doe@gmail.com</span>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.amet consecteturamet consecteturamet Laboriosam voluptatum fuga iure. Est, dicta voluptatum.</p>

              </div>-->
            </div>
          </div>
          
    </div>

  </section>


  <!-- Contact Us -->
  <section id="contact">
    <div class="container">
      <div class="login-page">
        <form>
          <div class="box">
            <div class="form-head">
              <h2>Member Login</h2>
            </div>
            <div class="form-body">
              <input type="text" placeholder="Enter name" />
              <input type="Password" placeholder="Password" />
            </div>
            <div class="form-footer">
              <button type="submit">Sign In</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
  <!-- Contact Us -->
  <!-- footer -->
  <footer>
    <samp>
      © copyright
    </samp>
  </footer>
  <!-- footer -->
  <!-- js -->
       <script>
       const hamBurger = document.querySelector(".hamBurger");
const nav = document.querySelector("nav");

hamBurger.addEventListener("click", function () {
  nav.classList.toggle("open");
  hamBurger.classList.toggle("close");
});
const menu = document.querySelector("#menu").children;

for (let i = 0; i < menu.length; i++) {
  menu[i].addEventListener("click", function () {
    for (let j = 0; j < menu.length; j++) {
      menu[j].classList.remove("active");
    }
    this.classList.add("active");
    nav.classList.toggle("open");
    hamBurger.classList.toggle("close");
  });
}
</script> 
</body>

</html>