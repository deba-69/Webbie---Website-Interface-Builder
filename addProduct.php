<?php
include('C:\wamp\www\Project\home_page\connect.php');
@session_start();
echo "<script>window.alert('opened')</script>";
if(isset($_COOKIE["username"]))
{
    if(isset($_POST['submit-btn']))
    {
        $prod_name = $_POST["product-name"];
        $short_des = $_POST["short-des"];
        $des = $_POST["des"];
        $img1 = $_FILES["b-img1"]["name"];
        $img2 = $_FILES["b-img2"]["name"];
        $img3 = $_FILES["b-img3"]["name"];
        $actual_price = $_POST["actual-price"];
        $sell_price = $_POST["sell-price"];
        $discount = $_POST["discount"];
        $stock = $_POST["stock"];
        $cat = $_POST["category"];
        $email = $_COOKIE["email"];
        $user_que = "select * from user_custom where email = '$email'";
        $res = pg_query($conn,$user_que);
        $user_data = pg_fetch_assoc($res);
        $user_id = $user_data["user_id"];
        move_uploaded_file($_FILES["b-img1"]["tmp_name"],"./template123/public/prod_img/$img1");
        move_uploaded_file($_FILES["b-img2"]["tmp_name"],"./template123/public/prod_img/$img2");
        move_uploaded_file($_FILES["b-img3"]["tmp_name"],"./template123/public/prod_img/$img3");
        $t_id = $_SESSION["t_id"]; 
        if(isset($_COOKIE["sect"]))
        {
            $n = $_COOKIE["sect"];
            /*$query = "select * from section where sect_id= '$n'";
            $result = pg_query($conn,$query);
            $data = pg_fetch_assoc($result);
            $sect = $data["sect_id"];*/
            $query = "insert into product(prod_name,short_des,des,image1,image2,image3,actual_price,sell_price,discount,stock,cat_id,sect_id,user_id,t_id)values('$prod_name','$short_des','$des','$img1','$img2','$img3','$actual_price','$sell_price','$discount','$stock','$cat',$n,$user_id,$t_id)";
            $result = pg_query($conn,$query);
        }
        else
        {
            $query = "insert into product(prod_name,short_des,des,image1,image2,image3,actual_price,sell_price,discount,stock,cat_id,user_id,t_id)values('$prod_name','$short_des','$des','$img1','$img2','$img3','$actual_price','$sell_price','$discount','$stock','$cat',$user_id,$t_id)";
            $result = pg_query($conn,$query);
        }

        if($result>0)
        {
            echo "<script>window.alert('product inserted successfully')</script>";
        }
        else
        {
            echo "<script>window.alert('error')</script>";
        }
        setcookie("sect");
        /*echo "<script>window.open('template123/public/tempo.php','_self')</script>";*/
    }
    else if(isset($_POST["back-btn"]))
    {
        unset($_COOKIE["sect_name"]);
        setcookie("sect");
        echo "<script>window.open('select.php','_self')</script>";
    }
}
else
{
    echo "<script>window.alert('Login first')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clothing : Add Product</title>
    <link rel="stylesheet" href="css/input_form.css">
    <link rel="stylesheet" href="template123/public/css/addProduct.css">
    <style>
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
        input[type="file"]{
            margin-bottom:10px;
        }
        .upload-catalogue{
            width: 100%;
            margin: 20px 0px;
            display: block;
        }
        .btn{
            margin-bottom: 15px;
        }

    </style>

</head>
<body>
    <!--<img src="img/loader.gif" alt="" class="loader">

    <div class="alert-box">
        <img src="img/error.png" alt="" class="alert-img">
        <p class="alert-msg"></p>
    </div>-->

    <img src="img/dark-logo.png" alt="" class="logo">

    <div class="form">
        <form action=" " method="post" enctype="multipart/form-data">
        <input type="text" name="product-name" id="product-name" maxlength="50" placeholder="Product name">
        <input type="text" id="short-des" name="short-des" maxlength="100" placeholder="Short description about the Product">
        <textarea id="des" name="des" placeholder="detail description"></textarea>
 
        <div class="container">
            <!--<div class="product-image"><p class="text">product image</p></div>-->
            <div class="upload-image-sec">
                <p class="text"><img src="template123/public/img/camera.png" alt="">upload image</p>
                <div class="upload-catalogue">
                    <input type="file" name="b-img1" class="fileupload" id="first-file-upload-btn" >
                    <!--<label for="first-file-upload-btn" class="upload-image"></label>-->
                    <input type="file" name="b-img2" class="fileupload" id="second-file-upload-btn">
                    
                    <input type="file" name="b-img3" class="fileupload" id="third-file-upload-btn">
                   
                    
                </div>
            </div>
            <div class="select-sizes">
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
                <!--<div class="sizes">
                    <input type="checkbox" name="xs" class="size-checkbox" id="xs" value="xs">
                    <input type="checkbox" name="s" class="size-checkbox" id="s" value="s">
                    <input type="checkbox" name="m" class="size-checkbox" id="m" value="m">
                    <input type="checkbox" name="l" class="size-checkbox" id="l" value="l">
                    <input type="checkbox" name="xl" class="size-checkbox" id="xl" value="xl">
                    <input type="checkbox" name="xxl" class="size-checkbox" id="xxs" value="xxl">
                    <input type="checkbox" name="xxxl" class="size-checkbox" id="xxxl" value="xxxl">
                </div>-->
            </div>
        </div>

        <div class="product-price">
            <input type="number" name ="actual-price" id="actual-price" placeholder="actual price">
            <input type="number" name ="discount" id="discount" placeholder="discount percentage">
            <input type="number" name ="sell-price" id="sell-price" placeholder="selling price">
        </div>

        <input type="number" name="stock" id="stock" min="20" placeholder="item in stocks(minimum 20)">
        <!--<textarea id="tags" placeholder="Enter categories here, for example - Men, Jeans, Rough Jeans (You should add men or women at start)"></textarea>-->


        <div class="buttons">
            <input type="submit" name="submit-btn" class="btn" value="Add Product" id="add-btn">
            <input type="submit" name="back-btn" class="btn" value="Back" id="add-btn">
            
        </div>
    </form>
    </div>

    <script src="template123/public/js/addProduct.js"></script>
   
    
</body>
</html>

