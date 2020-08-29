<?php
session_start();
if (!$_SESSION['account_id']) {
   header("location: logout.php");
   exit;
}

include "functions/connection.php";

$error = "";

function getPassword($id)
{
   $sql = "SELECT `password` FROM accounts WHERE id = $id";
   $conn = connection();
   if ($result = $conn->query($sql)) {
      $passw = $result->fetch_assoc();
      return $passw['password'];
   }
}

function deleteAccount($id){
   $sql = "DELETE accounts, users, posts
   FROM accounts
   INNER JOIN users ON accounts.id = users.account_id
   INNER JOIN posts ON accounts.id = posts.account_id
   WHERE accounts.id = $id";

   $conn = connection();

   if($conn->query($sql)){
      header("location: ../blog_portfolio");
      exit;
   }else{
      die("Error deleting your account: " . $conn->error);
   }
}

if (isset($_POST['btnDeleteAccount'])) {
   $id = $_SESSION['account_id'];
   $passw = $_POST['passw'];
   $dbPassw = getPassword($id);

   if (password_verify($passw, $dbPassw)) {
      deleteAccount($id);
   } else {
      $error = "<div class='mt-3 mx-auto alert alert-danger' role='alert'> Incorrect password. </div>";
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
   <title>Blogen | Delete Account</title>
</head>

<body class="bg-light">
   <main class="container col-md-5 col-lg-4 col-xl-3 my-5">
      <a href="profile.php" class="btn btn-outline-secondary btn-sm mb-3 border-0"><i class="fas fa-chevron-left mr-2"></i>Back to Profile</a>
      <div class="card">
         <div class="card-header bg-danger text-light">
            <h1 class="display-4">Delete Account</h1>
         </div>
         <div class="card-body">
            <form action="" method="post">
               <?= $error ?>
               <div class="form-group mb-5">
                  <label for="passw">Enter Password</label>
                  <input type="password" name="passw" id="passw" class="form-control" autofocus required>
               </div>

               <button type="submit" name="btnDeleteAccount" class="btn btn-outline-danger btn-sm btn-block"><i class="fas fa-exclamation-circle fa-2x mr-2" style="vertical-align: middle;"></i>Delete Account</button>
            </form>
         </div>
      </div>
   </main>

   <script src="js/jquery.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
</body>

</html>