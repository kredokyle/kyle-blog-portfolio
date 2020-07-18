<?php
$error = "";
function register($fname, $lname, $address, $contact, $username, $passw){
   include "functions/connection.php";
   $passw = password_hash($passw, PASSWORD_DEFAULT);
   $sql = "INSERT INTO accounts (username, `password`) VALUES ('$username', '$passw')";
   $conn = connection();
   if($conn->query($sql)){
      $last_id = $conn->insert_id;
      $sql = "INSERT INTO users (first_name, last_name, contact_number, `address`, account_id) VALUES ('$fname', '$lname', '$contact', '$address', $last_id)";
      if($conn->query($sql)){
         header("location: login.php");
         exit;
      }else{
         die("Error adding new user: " . $conn->error);
      }
   }else{
      die("Error adding new account: " . $conn->error);
   }
}

if (isset($_POST['btnRegister'])) {
   $fname = $_POST['firstName'];
   $lname = $_POST['lastName'];
   $address = $_POST['address'];
   $contact = $_POST['contact'];
   $username = $_POST['username'];
   $passw = $_POST['passw'];
   $confirmPassw = $_POST['confirmPassw'];

   if ($passw == $confirmPassw) {
      register($fname, $lname, $address, $contact, $username, $passw);
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
   <meta name="Description" content="Enter your description here" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
   <link rel="stylesheet" href="main.css">
   <title>Blogen | Register</title>
   <style>
      .fas {
         font-size: 20px;
         width: 30px;
      }

      .input-group-text {
         min-width: 57px;
      }
   </style>
</head>

<body>

   <body class="bg-light">
      <main>
         <form action="" method="post">
            <div class="col-md-6 mx-auto my-5">
               <div class="card">
                  <div class="card-header bg-success row align-items-center m-0 border-bottom-0" style="height: 15rem">
                     <h6 class="display-4 text-dark">Create Account</h6>
                  </div>
                  <div class="card-body">
                     <div class="input-group mb-2">
                        <div class="input-group-prepend">
                           <div class="input-group-text"><i class="fas fa-user"></i></div>
                        </div>
                        <input type="text" name="firstName" class="form-control" placeholder="First Name" required autofocus>
                        <input type="text" name="lastName" class="form-control" placeholder="Last Name" required>
                     </div>
                     <div class="input-group mb-2">
                        <div class="input-group-prepend">
                           <div class="input-group-text"><i class="fas fa-map-pin"></i></div>
                        </div>
                        <input type="text" name="address" class="form-control" placeholder="Address" required>
                     </div>
                     <div class="input-group mb-5">
                        <div class="input-group-prepend">
                           <div class="input-group-text"><i class="fas fa-phone-alt"></i></div>
                        </div>
                        <input type="text" name="contact" class="form-control" placeholder="Contact Number" required>
                     </div>

                     <div class="input-group mb-2">
                        <div class="input-group-prepend">
                           <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                        </div>
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                     </div>
                     <div class="input-group mb-2">
                        <div class="input-group-prepend">
                           <div class="input-group-text"><i class="fas fa-lock"></i></div>
                        </div>
                        <input type="password" name="passw" class="form-control" placeholder="Password" minlength="8" required>
                     </div>
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <div class="input-group-text"></div>
                        </div>
                        <input type="password" name="confirmPassw" class="form-control col" placeholder="Confirm Password" minlength="8">
                     </div>
                     <p class="text-muted text-right"><small>Password must be 8 or more characters long.</small></p>
                     <div class="mt-5">
                        <button name="btnRegister" class="btn btn-dark btn-block">JOIN NOW</button>
                        <div class="text-center mt-3">
                           <small>Registered already? <a href="login.php">Log In</a></small>
                        </div>
                     </div>
                  </div>
               </div>
               <?= $error ?>
            </div>
         </form>
      </main>
      <!-- <footer class="bg-blue text-white text-center w-100" style="height: 100px; margin-top: 150px;">
         <small style="line-height: 100px;">Kyle Nurville &copy; 2020</small>
      </footer> -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
   </body>

</html>