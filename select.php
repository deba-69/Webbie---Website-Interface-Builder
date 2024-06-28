<?php
include('connect.php');
@session_start();
echo "<script>window.alert('opened')</script>";

if(isset($_POST["submit-btn1"]))
{
    echo "<script>window.open('input_form.php','_self')</script>";    
}
else if(isset($_POST["submit-btn2"]))
{
    echo "<script>window.open('addcategory.php','_self')</script>";    
}
else if(isset($_POST["submit-btn3"]))
{
    echo "<script>window.open('addsection.php','_self')</script>";    
}
else if(isset($_POST["submit-btn4"]))
{
    echo "<script>window.open('addProduct.php','_self')</script>";    
}
else if(isset($_POST["submit-btn5"]))
{
    echo "<script>window.open('cuts_Aboutus.php','_self')</script>";    
}
else if(isset($_POST["submit-btn6"]))
{
    echo "<script>window.open('remove_cat.php','_self')</script>";    
}
else if(isset($_POST["submit-btn7"]))
{
    echo "<script>window.open('remove_sect.php','_self')</script>";    
}
else
{
    echo "<script>window.alert('error')</script>";    
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
    </style>
    
</head>
<body>

    <div class="container">
        <div>
        <p class="sub-heading" style="margin-top: 10px; text-align: center; color: #fff; text-transform: capitalize; font-size: 35px; color:#383838; font-weight: 300; font-family: Copperplate, Papyrus, fantasy;">customise page</p>
        <form action="" method="post" enctype = "multipart/form-data">
            <input type="submit" class="submit-btn" name="submit-btn1" value = "header"></input>
            <input type="submit" class="submit-btn" name="submit-btn2" value = "Add Category"></input>
            <input type="submit" class="submit-btn" name="submit-btn3" value = "Add Section"></input>
            <input type="submit" class="submit-btn" name="submit-btn4" value = "Add Product"></input>
            <input type="submit" class="submit-btn" name="submit-btn5" value = "About Us"></input>
            <input type="submit" class="submit-btn" name="submit-btn6" value = "Remove Category"></input>
            <input type="submit" class="submit-btn" name="submit-btn7" value = "Remove Section"></input>
            <input type="submit" class="submit-btn" name="submit-btn8" value = "preview"></input>
            <!--<a href="./template123/public/tempo.php"><button class="submit-btn" id="submit-btn">Submit</button></a>-->
        </form>
        </div>
    </div>

    <script src="js/form.js"></script>
    
</body>
</html>