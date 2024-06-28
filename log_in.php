<?php
   include('connect.php');
   @session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>WEBBIE : LOG IN</title>
      <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>
      <div class="bg-img">
         <div class="content">
            <header>Login Form</header>
            <form action="" method="post">
               <div class="field">
                  <span class="fa fa-user"></span>
                  <input type="email" name="email" required placeholder="Email">
               </div>
               <div class="field space">
                  <span class="fa fa-lock"></span>
                  <input type="password" name="password" class="pass-key" required placeholder="Password">
                  <span class="show">SHOW</span>
               </div>
               <div class="pass">
                  <a href="#">Forgot Password?</a>
               </div>
               <div class="field">
                  <input type="submit" name="submit" value="LOGIN">
               </div>
            </form>
            <div class="signup">
               Don't have account?
               <a href="sign_up.php">Signup Now</a>
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
      //echo "<script>window.alert('start')</script>";
      $name = $_POST['email'];
      $password = $_POST['password'];
      
      //echo "<script>window.alert('$name')</script>";
      $query = "select * from user_custom where email = '$name'";
      $result = pg_query($conn,$query);
      $data = pg_fetch_assoc($result);
      if(pg_num_rows($result)>0)
      {
         if(password_verify($password,$data['password']))
         {
            setcookie("username",$data["name"]);
            setcookie("email",$data['email']);
           $_SESSION['username'] = $data['name']; 
           echo "<script>window.alert('Login Successful')</script>";
           echo "<script>window.open('home_pg.php','_self')</script>"; 
         }
         else
         {
            echo "<script>window.alert('Invalid Credentials')</script>";
         }
      }
      else
      {
         echo "<script>window.alert('Invalid Credentials')</script>";
      }
   }

?>