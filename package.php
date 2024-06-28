<?php
    include('connect.php');
    @session_start();
    //$_POST=array();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>WEBBIE : Templates</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="getTemplateStyleMW.css">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <script id="template-animations-data">mw.__pageAnimations = []</script>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-light pt-3 d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center">
                    <?php
                            if(isset($_SESSION['username']))
                            {
                                echo '<p><i class="fa mr-2"></i>Welcome '.$_SESSION["username"].'</p>';
                            }
                            else
                            {
                                echo '<p><i class="fa fa-envelope mr-2"></i>Welcome guest</p>';
                            }
                        ?>
                    </div>
                </div>
                <div class="col-lg-6 text-center text-lg-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-primary px-3" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-primary px-3" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-primary px-3" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-primary px-3" href="">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="text-primary pl-3" href="">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid position-relative nav-bar p-0">
        <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-light navbar-light shadow-lg py-3 py-lg-0 pl-3 pl-lg-5">
                <a href="" class="navbar-brand">
                    <h1 class="m-0 text-primary"><span class="text-dark">WEBB</span>IE</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
                        <a href="home_pg.php" class="nav-item nav-link">Home</a>
                        <a href="about.php" class="nav-item nav-link">About</a>
                        <a href="package.php" class="nav-item nav-link active">Templates</a>
                        <a href="service.php" class="nav-item nav-link">Services</a>
                        <?php
                            if(isset($_SESSION['username']))
                            {
                                echo '<a href="logout.php" class="nav-item nav-link">Logout</a>';
                            }
                            else
                            {
                                echo '<a href="log_in.php" class="nav-item nav-link">Login</a>';
                            }
                        ?>
                        
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Header Start -->
    <div class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <h3 class="display-4 text-white text-uppercase">TEMPLATES</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="">Home</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Templates</p>
                    <br><br>
                    
                </div>
                <p style="text-align:center;color:aliceblue">
                    Choose the template, which fits for your website.<br>
                    Each template is a perfect example of how your website will look like.<br>
                    You can expand and modify the template or even start from scratch.
                </p>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <style>
        
            html, body {
                scroll-behavior: smooth;
            }
        
            .center {
            transform: scale(1.5);
            height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            }

            .article-card {
            width: 440px;
            height: 220px;
            border-radius: 12px;
            overflow: hidden;
            position: relative;
            font-family: Arial, Helvetica, sans-serif;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            transition: all 300ms;
            }

            .article-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            }

.article-card img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.article-card .content {
  box-sizing: border-box;
  width: 100%;
  position: absolute;
  padding: 30px 20px 20px 20px;
  height: auto;
  bottom: 0;
  background: linear-gradient(transparent, rgba(0, 0, 0, 0.6));
}

.article-card .date,
.article-card .title {
  margin: 0;
}

.article-card .date {
  font-size: 12px;
  color: rgba(255, 255, 255, 0.9);
  margin-bottom: 4px;
}

.article-card .title {
  font-size: 17px;
  color: #fff;
}

.prv-btn .title{
    font-size: 17px;
    color: black;
}
.prv-btn{
    display: relative;
    width: 25%;
    /*border: none;*/
    outline: none;
    cursor: pointer;
    height: 40px;
    border-radius: 5px;
    border-color: #fff;
    border-width: 1px;
    background: none;
    color: #fff;
    line-height: 40px;
    text-align: center;
    text-transform: capitalize;
    text-decoration: none;
}



        
        </style>
        
        
        
       
    <!-- Packages Start -->
    <section class="section" id="templates-page">
        <div id="templates-page-bg">
<div></div>
<div></div>
</div>
       
        <form action=" " method="post"> 
        <div class="section-wrapper">
            <div class="center">
                <div class="article-card">
                    <div class="content">
                        <p class="date">Fitness  Shop  Sport  Training</p>
                        <p class="title">Fitness Shop</p>
                        <div class="but-on">
                        <button class="prv-btn" onclick="fetch('./template123/public3/gym/index.html')">Preview</button>
                        <button class="prv-btn" name="start" value=1>Start</button>
                        </div>
                    </div>
                    <img src="img/fitness.jpg" alt="article-cover" />
                </div>
            </div>  
        <div class="center">
                <div class="article-card">
                    <div class="content">
                        <p class="date">Ecommerce Shop</p>
                        <p class="title">Online Store</p>
                        <div class="but-on">
                        <button class="prv-btn" onclick="fetch('./template123/public2/index.html')">Preview</button>
                        <button class="prv-btn" name="start" value=2>Start</button>
                        </div>
                    </div>
                    <img src="img/shop2.jpg" alt="article-cover" />
                </div>
            </div>  
        <div class="center">
                <div class="article-card">
                    <div class="content">
                        <p class="date">Business  Shopping  Fashion</p>
                        <p class="title">Boutique</p>
                        <div class="but-on">
                        <button class="prv-btn" onclick="fetch('./template123/public/index.html')">Preview</button>
                        <button class="prv-btn" name="start" value=3>Start</button>
                        </div>
                    </div>
                    <img src="img/carousel-2.jpeg" alt="article-cover" />
                </div>
        </div> 
                    </div>
            </form> 
    </section>
    <!-- Packages End -->



    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 py-5 px-sm-3 px-lg-5" style="margin-top: 90px;">
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries 
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

     Contact Javascript File
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>-->

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>
        function fetch(str)
        {
            window.open(str,'_blank');
        }
    </script>
</body>
</html>
<?php
global $conn;
if(isset($_POST["start"]))
{
    $p = $_POST["start"];
    $_SESSION["t_id"] = $p;
    //setcookie("t_id",$p);
    $_SESSION["t_id"] = $p;
    $t_id = $_SESSION["t_id"];
    echo "<script>window.alert('$t_id')</script>";
    if($p==3)
    {
        $email = $_COOKIE["email"];  
        $q = "select * from user_custom where email = '$email'";
        $res = pg_query($conn,$q);
        $data = pg_fetch_assoc($res);
        $id = $data["user_id"]; 

        $q = "select * from user_template where user_id = $id";
        $res = pg_query($conn,$q);

        if(pg_num_rows($res)==0)
        {
            $query = "insert into user_template(user_id,t_id)values($id,3)";
            $q = pg_query($conn,$query);
            echo "<script>window.alert('$email')</script>";
        }
        else
        {
            echo "<script>window.alert('$email error')</script>";
        }
        echo "<script>window.open('kkk.php','_blank');</script>";
    }
    else if($p==2)
    {
        $email = $_COOKIE["email"];  
        $q = "select * from user_custom where email = '$email'";
        $res = pg_query($conn,$q);
        $data = pg_fetch_assoc($res);
        $id = $data["user_id"]; 

        $q = "select * from user_template where user_id = $id and t_id = 2";
        $res = pg_query($conn,$q);
        $cnt = pg_num_rows($res);
        echo "<script>window.alert('$cnt is count')</script>";
        if(pg_num_rows($res)==0)
        {
            echo "<script>window.alert('online store')</script>";
            $query = "insert into user_template(user_id,t_id)values($id,2)";
            $q = pg_query($conn,$query);
            echo "<script>window.alert('$email')</script>";
        }
        else
        {
            echo "<script>window.alert('$email error')</script>";
        }
        echo "<script>window.open('store.html','_blank');</script>";

    }
    else if($p==1)
    {
        $email = $_COOKIE["email"];  
        $q = "select * from user_custom where email = '$email'";
        $res = pg_query($conn,$q);
        $data = pg_fetch_assoc($res);
        $id = $data["user_id"]; 

        $q = "select * from user_template where user_id = $id and t_id = 1";
        $res = pg_query($conn,$q);
        $cnt = pg_num_rows($res);
        echo "<script>window.alert('$cnt is count')</script>";
        if(pg_num_rows($res)==0)
        {
            echo "<script>window.alert('online store')</script>";
            $query = "insert into user_template(user_id,t_id)values($id,1)";
            $q = pg_query($conn,$query);
            echo "<script>window.alert('$email')</script>";
        }
        else
        {
            echo "<script>window.alert('$email error')</script>";
        }
        echo "<script>window.open('./template123/public3/gym/gym_exe.html','_blank');</script>";
    }
    $_POST=array();
}


?>