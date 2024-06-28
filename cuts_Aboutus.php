<?php
include('C:\wamp\www\Project\home_page\connect.php');
@session_start();
    if(isset($_COOKIE["email"]))
    echo "<script>window.alert('user logged in')</script>";
    else
    echo "<script>window.alert('user not logged in')</script>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customise about us</title>
    
    <link rel="stylesheet" href="css/input_form.css">
    <link rel="stylesheet" href="template123/public/css/addProduct.css">
</head>
<body>
    <div class="container">
        <div>
            <form action="" method="post" enctype = "multipart/form-data">
                <p class="sub-heading" style="margin-top: 10px; text-align: center; color: #fff; text-transform: capitalize; font-size: 35px; color:#383838; font-weight: 300; font-family: Copperplate, Papyrus, fantasy;">customise About Us</p>
            <textarea id="des" name="des" placeholder="Tell about your company"></textarea>
            <input type="text" autocomplete="off" name="feat-1" placeholder="Enter feature 1">
            <input type="text"  name="feat-1-des" maxlength="100" placeholder="Short description about feature 1" value=''>
            <input type="text" autocomplete="off" name="feat-2" placeholder="Enter feature 2">
            <input type="text"  name="feat-2-des" maxlength="100" placeholder="Short description about feature 2" value=''>
            <input type="text" autocomplete="off" name="feat-3" placeholder="Enter feature 3">
            <input type="text"  name="feat-3-des" maxlength="100" placeholder="Short description about feature 3" value=''>
            <!--<input type="submit" class="submit-btn" name="submit-btn" value = "submit"></input>-->
            <div class="buttons">
            <input type="submit" name="submit-btn" class="submit-btn" value="submit" id="add-btn">
            <input type="submit" class="submit-btn" name="back-btn" value = "back">
            </div>
        </form>
        </div>
    </div>
    
</body>
</html>

<?php
if(isset($_POST['submit-btn']))
{
    $about=$_POST["des"];
    $feat_1=$_POST["feat-1"];
    $feat_1_des=$_POST["feat-1-des"];
    $feat_2=$_POST["feat-2"];
    $feat_2_des=$_POST["feat-2-des"];
    $feat_3=$_POST["feat-3"];
    $feat_3_des=$_POST["feat-3-des"];
    $email = $_COOKIE["email"];
    $t_id = $_SESSION["t_id"];

        if($about!='')
        {
        $query = "update user_template set about_us = '$about' where t_id = $t_id and user_id in (select user_id from user_custom where email = '$email')";
        $res = pg_query($conn,$query);
        if($res==0)
        echo "<script>window.alert('errrrrrr')</script>";
        }
        if($feat_1!='')
        {
        $query = "update user_template set feat1 = '$feat_1' where t_id = $t_id and user_id in (select user_id from user_custom where email = '$email')";
        $res = pg_query($conn,$query);
        if($res==0)
        echo "<script>window.alert('errrrrrr')</script>";
        }
        if($feat_2!='')
        {
        $query = "update user_template set feat2 = '$feat_2' where t_id = $t_id and user_id in (select user_id from user_custom where email = '$email')";
        $res = pg_query($conn,$query);
        if($res==0)
        echo "<script>window.alert('errrrrrr')</script>";
        }
        if($feat_3 != '')
        {
        $query = "update user_template set feat3 = '$feat_3' where t_id = $t_id and user_id in (select user_id from user_custom where email = '$email')";
        $res = pg_query($conn,$query);
        if($res==0)
        echo "<script>window.alert('errrrrrr')</script>";
        }
        if($feat_1_des !='')
        {
        $query = "update user_template set feat1_des = '$feat_1_des' where t_id = $t_id and user_id in (select user_id from user_custom where email = '$email')";
        $res = pg_query($conn,$query);
        if($res==0)
        echo "<script>window.alert('errrrrrr')</script>";
        }
        if($feat_2_des != '')
        {
        $query = "update user_template set feat2_des = '$feat_2_des' where t_id = $t_id and user_id in (select user_id from user_custom where email = '$email')";
        $res = pg_query($conn,$query);
        if($res==0)
        echo "<script>window.alert('errrrrrr')</script>";
        }
        if($feat_3_des != '')
        {
        $query = "update user_template set feat3_des = '$feat_3_des' where t_id = $t_id and user_id in (select user_id from user_custom where email = '$email')";
        $res = pg_query($conn,$query);
        $err = pg_last_error();
        if($res===false)
        echo "<script>window.alert('$err')</script>";
        }
    /*echo "<script>window.open('template123/public/tempo.php','_self')</script>";*/
}
else if(isset($_POST["back-btn"]))
{
    echo "<script>window.open('select.php','_self')</script>";
}
?>