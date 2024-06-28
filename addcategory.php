<?php
include('C:\wamp\www\Project\home_page\connect.php');
@session_start();
global $conn;
if(isset($_POST["submit-btn"]))
{
$cat_name = $_POST["name"];
$email = $_COOKIE["email"];
$que = "select * from user_custom where email = '$email'";
$user_res = pg_query($conn,$que);
if(pg_num_rows($user_res)>0)
{
    $data = pg_fetch_assoc($user_res);
    $user_id = $data["user_id"];
}
$query = "select * from category where cat_name = '$cat_name' and user_id = $user_id";
$result = pg_query($conn,$query);
if(pg_num_rows($result) > 0)
{
    echo "<script>window.alert('category already exists')</script>";
}
else
{
    $query = "insert into category(cat_name,user_id)values('$cat_name',$user_id)";
    $result = pg_query($conn,$query);
    if($result>0)
    {
        echo "<script>window.alert('category added')</script>";
    }
    else
    {
        $err = preg_last_error();
        echo "<script>window.alert('$err')</script>";
    }
}
}
else if(isset($_POST["back-btn"]))
{
    echo "<script>window.open('select.php','_self')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/input_form.css" rel="stylesheet">
    <link href="css/home.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div>
            <form action="" method="post" enctype = "multipart/form-data">
            <input type="text" autocomplete="off" name="name" placeholder="Enter Category name">
            <input type="file" autocomplete="off" name="b-img1" placeholder="Enter img">
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