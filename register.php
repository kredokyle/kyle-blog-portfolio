<?php
$error = "";
include "functions/connection.php";
include "functions/register.php";

if (isset($_POST['btnRegister'])) {
   $firstName = $_POST['firstName'];
   $lastName = $_POST['lastName'];
   $address = $_POST['address'];
   $contact = $_POST['contact'];
   $username = $_POST['username'];
   $passw = $_POST['passw'];
   $confirmPassw = $_POST['confirmPassw'];

   if ($passw == $confirmPassw) {
      $error = registerUser($firstName, $lastName, $address, $contact, $username, $passw);
   } else {
      $error = "
         <div class='mt-3 mx-auto alert alert-danger' role='alert'>
         Passwords must match.
         </div>
         ";
   }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
   <link rel="stylesheet" href="main.css">
   <title>Blogen | Register</title>
   <style>

   </style>
</head>

<body>

   <body class="bg-light">
      <main>
         <form action="" method="post">
            <div class="col-lg-6 col-md-9 mx-auto my-5">
               <div class="card">
                  <div class="card-header bg-yellow row align-items-center m-0 border-bottom-0" style="height: 15rem">
                     <h1 class="display-4 text-dark">Create Account</h1>
                  </div>
                  <div class="card-body">
                     <div class="input-group mb-2">
                        <div class="input-group-prepend">
                           <div class="input-group-text bg-lyellow"><i class="fas fa-user"></i></div>
                        </div>
                        <input type="text" name="firstName" class="form-control" placeholder="First Name" required autofocus>
                        <input type="text" name="lastName" class="form-control" placeholder="Last Name" required>
                     </div>
                     <div class="input-group mb-2">
                        <div class="input-group-prepend">
                           <div class="input-group-text bg-lyellow"><i class="fas fa-map-pin"></i></div>
                        </div>
                        <input type="text" name="address" class="form-control" placeholder="Address" required>
                     </div>
                     <div class="input-group mb-5">
                        <div class="input-group-prepend">
                           <div class="input-group-text bg-lyellow"><i class="fas fa-phone-alt"></i></div>
                        </div>
                        <input type="text" name="contact" class="form-control" placeholder="Contact Number" required>
                     </div>

                     <div class="input-group mb-2">
                        <div class="input-group-prepend">
                           <div class="input-group-text bg-lyellow"><i class="fas fa-id-card"></i></div>
                        </div>
                        <input type="text" name="username" class="form-control" placeholder="Username" maxlength="15" required>
                     </div>
                     <div class="input-group mb-2">
                        <div class="input-group-prepend">
                           <div class="input-group-text bg-lyellow"><i class="fas fa-lock"></i></div>
                        </div>
                        <input type="password" name="passw" class="form-control" placeholder="Password" minlength="8" required>
                     </div>
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <div class="input-group-text bg-lyellow"></div>
                        </div>
                        <input type="password" name="confirmPassw" class="form-control col" placeholder="Confirm Password" minlength="8">
                     </div>
                     <p class="text-muted text-right"><small>Password must be 8 or more characters long.</small></p>
                     <?= $error ?>
                     <div class="mt-5">
                        <button name="btnRegister" class="btn btn-dark btn-block">JOIN NOW</button>
                        <div class="text-center mt-3">
                           <small>Registered already? <a href="../blog_portfolio">Log In</a></small>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </form>
      </main>
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
   </body>

</html>