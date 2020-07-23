<?php
session_start();
if (!$_SESSION['account_id']) {
   header("location: logout.php");
   exit;
}
$error = "";

if(isset($_POST['btnUpdatePassw'])){
   $currentPassw = $_POST['currentPassw'];
   $newPassw = $_POST['newPassw'];
   $confNew = $_POST['confNew'];


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
   <title>Blogen | Change Password</title>
</head>

<body class="bg-light">
   <main class="container col-md-5 col-lg-4 col-xl-3 my-5">
      <a href="profile.php" class="btn btn-outline-secondary btn-sm mb-3"><i class="fas fa-chevron-left mr-2"></i>Back to Profile</a>
      <div class="card">
         <div class="card-header bg-yellow">
            <h1 class="display-4">Change Password</h1>
         </div>
         <div class="card-body">
            <form action="" method="post">
               <div class="form-group mb-5">
                  <label for="currentPassw">Current Password</label>
                  <input type="password" name="currentPassw" id="currentPassw" class="form-control" autofocus required>
               </div>
               <div class="form-group">
                  <label for="newPassw">New Password</label>
                  <input type="password" name="newPassw" id="newPassw" class="form-control" required>
               </div>

               <div class="form-group">
                  <label for="confNew">Confirm New Password</label>
                  <input type="password" name="confNew" id="confNew" class="form-control" required>
               </div>
               <?= $error ?>

               <button type="submit" name="btnUpdatePassw" class="btn btn-dark float-right">Update Password</button>
            </form>
         </div>
      </div>
   </main>

   <script src="js/jquery.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
</body>

</html>