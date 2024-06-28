<?php
    include('connect.php');
    @session_start();
    $email= $_COOKIE["email"];
    if(isset($_POST['submit-btn']))
    {
        //echo "<script>window.open('holllaaaa')</script>";
        $color = $_POST["colour"];
        $img = $_FILES["b-img1"]["name"];
        $web_name=$_POST["name"];
        $heading=$_POST["heading"];
        $color1=$_POST["colour1"];
        $t_id = $_SESSION["t_id"];
        echo "<script>window.alert('$t_id')</script>";
        if($web_name!='')
        {
        $query = "update user_template set web_name = '$web_name' where t_id = $t_id and user_id in (select user_id from user_custom where email = '$email')";
        $res = pg_query($conn,$query);
        if($res==0)
        echo "<script>window.alert('errrrrrr')</script>";
        }
        if($img!='')
        {
        $query = "update user_template set web_img = '$img' where t_id = $t_id and user_id in (select user_id from user_custom where email = '$email')";
        $res = pg_query($conn,$query);
        if($res==0)
        echo "<script>window.alert('errrrrrr')</script>";
        }
        if($heading!='')
        {
        $query = "update user_template set web_head = '$heading' where t_id = $t_id and user_id in (select user_id from user_custom where email = '$email')";
        $res = pg_query($conn,$query);
        if($res==0)
        echo "<script>window.alert('errrrrrr')</script>";
        }
        if(strcmp($color,'#000000'))
        {
        $query = "update user_template set head_color = '$color' where t_id = $t_id and user_id in (select user_id from user_custom where email = '$email')";
        $res = pg_query($conn,$query);
        if($res==0)
        echo "<script>window.alert('errrrrrr')</script>";
        }
        if(strcmp($color1,'#000000'))
        {
        $query = "update user_template set name_color = '$color1' where t_id = $t_id and user_id in (select user_id from user_custom where email = '$email')";
        $res = pg_query($conn,$query);
        if($res==0)
        echo "<script>window.alert('errrrrrr')</script>";
        }
        echo "<script>window.alert('$email')</script>";

        /*echo "<script>window.open('template123/public/tempo.php','_self')</script>";*/
    }
    else if(isset($_POST["back-btn"]))
    {
        echo "<script>window.open('customise.php','_self')</script>";
    }
    setcookie("sect_name");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webbie : Getting Started</title>
    <link href="input_form.css" rel="stylesheet">

</head>
<body>


    <div class="alert-box">
        <img src="img/error.png" alt="NaN" class="alert-img">
        <p class="alert-msg">error message</p>
    </div>
    <div class="container">
        <div>
            <form action="" method="post" enctype = "multipart/form-data">
            <input type="text" autocomplete="off" name="name" placeholder="Enter name for your website">
            <input type="color" name="colour1" placeholder="Enter font colour">
            <input type="file" autocomplete="off" name="b-img1" placeholder="Enter img">
            <input type="text" autocomplete="off" name="heading" placeholder="enter value for heading 1">
            <input type="color" name="colour" placeholder="Enter font colour">
            <!--<input type="submit" class="submit-btn" name="submit-btn" value = "submit"></input>-->
            <div class="buttons">
            <input type="submit" name="submit-btn" class="submit-btn" value="submit" id="add-btn">
            <input type="submit" class="submit-btn" name="back-btn" value = "back">
            </div>
        </form>
        </div>
    </div>

    <script src="js/form.js"></script>
    
</body>
</html>