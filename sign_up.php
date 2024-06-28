<?php
include('connect.php');
session_start();
?>

<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>WEBBIE : SIGN UP</title>
      <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>
      <div class="bg-img">
         <div class="content">
            <header>Signup Form</header>
            <form action="" method="post">
               <div class="field">
                  <span class="fa fa-user"></span>
                  <input type="name" name="name" required placeholder="Name">
               </div>
               <div class="field">
                <span class="fa fa-user"></span>
                <input type="email" name="email" required placeholder="Email">
             </div>
             <div class="field">
                <span class="fa fa-user"></span>
                <input type="contact" name="contact" required placeholder="Phone no">
             </div>
               <div class="field space">
                  <span class="fa fa-lock"></span>
                  <input type="password" name="password" class="pass-key" required placeholder="Password">
               </div>
               <div class="field space">
                <span class="fa fa-lock"></span>
                <input type="password" class="pass-key" name="confirm_password" required placeholder="Confirm Password">
                <span class="show">SHOW</span>
             </div>
               
               <div class="field">
                  <input type="submit" name="submit" value="SIGN UP">
               </div>
            </form>
            <div class="signup">
               Already have an account?
               <a href="log_in.php">LogIn</a>
            </div>
         </div>
      </div>
      <script>
         const pass_field = document.querySelector('.pass-key');
         const showBtn = document.querySelector('.show');
         showBtn.addEventListener('click', function(){
          if(pass_field.type === "password"){
            pass_field.type = "text";
            showBtn.textContent = "HIDE";
            showBtn.style.color = "#3498db";
          }else{
            pass_field.type = "password";
            showBtn.textContent = "SHOW";
            showBtn.style.color = "#222";
          }
         });
      </script>
   </body>
</html>

<?php
global $conn;
if(isset($_POST['submit']))
{
   $name = $_POST['name'];
   $email = $_POST['email'];
   $contact = $_POST['contact'];
   $password = $_POST['password'];
   $confirm_password = $_POST['confirm_password'];
   $query = "select * from user_custom where email = '$email'";
   $result = pg_query($conn,$query);
   $_SESSION['username'] = $name;

   $uppercase = preg_match('@[A-Z]@',$password);
   $lowercase = preg_match('@[a-z]@',$password);
   $number = preg_match('@[0-9]@',$password);
   $special_char = preg_match('@[^\w]@',$password);
   if(pg_num_rows($result)>0)
   {
      echo "<script>window.alert('Email already in use! Use different email')</script>";
   }
   else if(strlen($contact)!=10 || !preg_match('/^[0-9]{10}+$/',$contact))
   {
      echo "<script>window.alert('Incorrect phone number')</script>";
   }
   else if(!$uppercase)
   {
      echo "<script>window.alert('Atleast one uppercase letter required in password')</script>";
   }
   else if(!$lowercase)
   {
      echo "<script>window.alert('Atleast one lowercase letter required in password')</script>";
   }
   else if(!$number)
   {
      echo "<script>window.alert('Atleast one digit is required in password')</script>";
   }
   else if(!$special_char)
   {
      echo "<script>window.alert('Atleast one special character required in password')</script>";
   }
   else if(strlen($password)<8)
   {
      echo "<script>window.alert('Password should be atleast 8 char long')</script>";
   }
   else if($password!=$confirm_password)
   {
      echo "<script>window.alert('confirm password is not same as password')</script>";
   }
   else
   {
      $_SESSION['username'] = $name;
      $hash_password = password_hash($password,PASSWORD_DEFAULT);
      $query = "insert into user_custom(name,email,phone,password)values('$name','$email','$contact','$hash_password')";
      $result = pg_query($conn,$query);

      if($result === false)
      {
         echo "<script>window.alert('unsuccessful')</script>";
      }
      else
      {
         echo "<script>window.alert('successful')</script>";
         echo "<script>window.open('log_in.php','_self')</script>";

      }
   }
}
?>