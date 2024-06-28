<?php
    include('C:\wamp\www\Project\home_page\connect.php');
    @session_start();
    $email = $_COOKIE["email"];
    echo "<script>window.alert('hello');</script>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webbie : Getting Started</title>
    <link href="css/input_form.css" rel="stylesheet">
    <style>
        input[type="submit"]{
            width: 150px;
            height: 40px;
            text-align: center;
            line-height: 40px;
            background: #383838;
            color: #fff;
            border-radius: 2px;
            text-transform: capitalize;
            border: none;
            cursor: pointer;
            display: block;
            margin: 10px 0;
        }
        .container{
            align-items: center;
        }
        form{
            align-items: center;
        }

        select{
        display: block;
    width: 300px;
    height: 40px;
    padding: 0px;
    border-radius: 5px;
    background: #fff;
    border: 1px solid #383838;
    outline: none;
    margin: 20px 0;
    text-transform: capitalize;
    color: #383838;
    font-size: 14px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.01);
    font-family: 'roboto', sans-serif;
        }

        .text{
            margin-top: 10px; 
            text-align: center; 
            text-transform: capitalize;
            font-size: 25px; 
            color:#383838; 
            font-weight: 100; 
            font-family: Copperplate, Papyrus, fantasy;

        }
    </style>
    
</head>
<body>

    <div class="container">
        <div>
        <p class="sub-heading" style="margin-top: 10px; text-align: center; color: #fff; text-transform: capitalize; font-size: 35px; color:#383838; font-weight: 300; font-family: Copperplate, Papyrus, fantasy;">customise Category</p>
        <form action="" method="post" enctype = "multipart/form-data">
            <p class="text">Select Category</p>
                <select name="category" id="category">
                <?php
                    $email = $_COOKIE["email"];
                    $query = "select * from category where user_id in (select user_id from user_custom where email = '$email')";
                    $result = pg_query($conn,$query);
                    if(pg_num_rows($result)>0)
                    {
                        while($data = pg_fetch_assoc($result))
                        {
                            $id = $data['cat_id'];
                            $name = $data['cat_name'];
                            echo "<option value='$id'>$name</option>";
                        }
                    }
                ?>

                </select>

            <input type="submit" class="submit-btn" name="submit" value = "Submit"></input>
            <input type="submit" class="submit-btn" name="back" value = "Back"></input>
            <!--<a href="./template123/public/tempo.php"><button class="submit-btn" id="submit-btn">Submit</button></a>-->
        </form>
        </div>
    </div>

    <script src="js/form.js"></script>
    
</body>
</html>

<?php

if(isset($_POST["back"]))
{
    echo "<script>window.alert('Going back ko select page');</script>";
    echo "<script>window.open('select.php','_self')</script>";
}
else if(isset($_POST["submit"]))
{
    $cat_id = $_POST["category"]; 
    $query = "delete from category where cat_id = $cat_id and user_id in (select user_id from user_custom where email = '$email')";
    $res = pg_query($conn,$query);
    if($res===false)
    {
        $err = pg_last_error();
        echo "<script>window.alert('$err');</script>";
    }
    else
    {
        echo "<script>window.alert('successfully removed');</script>";
    }
    
}

?>