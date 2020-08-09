<?php
$error = "";

function login($username, $passw)
{
   include "functions/connection.php";
   $sql = "SELECT * FROM accounts WHERE username = '$username'";
   $conn = connection();
   $result = $conn->query($sql);
   if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();
      if (password_verify($passw, $row['password'])) {
         session_start();
         $_SESSION['account_id'] = $row['id'];
         $_SESSION['username'] = $row['username'];
         $_SESSION['role'] = $row['status'];

         if ($row['status'] == "A") {
            header("location: dashboard.php");
         } elseif ($row['status'] == "U") {
            header("location: profile.php");
         }
         exit;
      } else {
         return $error = "
      <div class='mt-3 mx-auto alert alert-danger' role='alert'>
      Incorrect login information.
      </div>";
      }
   } else {
      return $error = "
      <div class='mt-3 mx-auto alert alert-danger' role='alert'>
      Incorrect login information.
      </div>";
   }
}

if (isset($_POST['btnLogin'])) {
   $username = $_POST['username'];
   $passw = $_POST['passw'];

   $error = login($username, $passw);
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
   <title>Welcome to Blogen</title>
   <style>
      .form-control {
         border: none;
      }
   </style>
</head>

<body class="bg-blue">
   <main>
      <form action="" method="post">
         <div class="card col-xl-3 col-lg-4 col-md-5 mx-auto mt-5 border-0 bg-blue">
            <div class="card-header bg-blue row align-items-center m-0" style="height: 15rem; border: 4px solid white;">
               <h1 class="display-4 text-white"><strong>Welcome to<br><span class="text-yellow">Blogen</span></strong></h1>
            </div>
            <div class="card-body">
               <?= $error; ?>
               <div class="mb-2">
                  <label for="username" class="small text-light">Username</label>
                  <input type="text" name="username" id="username" class="form-control" required>
               </div>
               <div>
                  <label for="password" class="small text-light">Password</label>
                  <input type="password" name="passw" id="password" class="form-control" required>
               </div>
               <div class="mt-5">
                  <button name="btnLogin" class="btn btn-yellow btn-block text-dark">LOGIN</button>
                  <div class="text-center mt-3">
                     <small><a href="register.php" class="text-white">Create Account</a></small>
                  </div>
               </div>
            </div>
         </div>
      </form>
   </main>
   <footer class="bg-blue text-white text-center w-100" style="margin-top: 250px;">
      <small style="line-height:100px;">Kyle Nurville &copy; 2020</small>
   </footer>
</body>

</html>