<?php
include('C:\wamp\www\Project\home_page\connect.php');
@session_start();
echo "<script>window.alert('opened')</script>";
    if(isset($_POST['submit-btn']))
    {
        //setcookie("sect_name",$_POST["name"]);
        $email = $_COOKIE["email"];
        $que = "select * from user_custom where email = '$email'";
        $user_res = pg_query($conn,$que);
        if(pg_num_rows($user_res)>0)
        {
            $data = pg_fetch_assoc($user_res);
            $user_id = $data["user_id"];
            $name = $_POST["name"];
            $cost = $_POST["cost"];
            $p1 = $_POST["p1"];
            $p2 = $_POST["p2"];
            $t_id = $_SESSION["t_id"];
           
            $query = "insert into pricing(name,cost,perk1,perk2,user_id)values('$name',$cost,'$p1','$p2',$user_id)";
        
            $result = pg_query($conn,$query);

            if($result>0)
            {
                echo "<script>window.alert('product inserted successfully')</script>";
            }
            else
            {
                echo "<script>window.alert('error')</script>";
            }   
        }
        /*echo "<script>window.open('template123/public/tempo.php','_self')</script>";*/
    }
    else if(isset($_POST["back-btn"]))
    {
        echo "<script>window.open('customise.php','_self')</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="input_form.css" rel="stylesheet">
    <link href="template123/public/css/home.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div>
            <form action="" method="post" enctype = "multipart/form-data">
            <input type="text" autocomplete="off" name="name" placeholder="Enter Plan Period">
            <input type="number" autocomplete="off" name="cost" min=1 placeholder="Enter Price">
            <input type="text" autocomplete="off" name="p1" placeholder="Perks">
            <input type="text" autocomplete="off" name="p2" placeholder="Perks">
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