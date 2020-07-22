<?php
session_start();
if (!$_SESSION['account_id']) {
   header("location: logout.php");
   exit;
}

include "functions/connection.php";
$id = $_SESSION['account_id'];
$row = getUser($id);
print_r($row);

function getUser($id)
{
   $sql = "SELECT * FROM users INNER JOIN accounts ON users.account_id = accounts.id WHERE accounts.id = $id";
   $conn = connection();
   if ($result = $conn->query($sql)) {
      return $result->fetch_assoc();
   } else {
      die("Error retreiving your record: " . $conn->error);
   }
}

function uploadPhoto($imageName, $id)
{
   $sql = "UPDATE users SET avatar = '$imageName' WHERE account_id = $id";

   $conn = connection();

   // Destination - where to store the image / directory
   $destination = "img/" . basename($imageName);

   if ($conn->query($sql)) {
      if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
         header("refresh: 0");
      } else {
         die("Error moving the photo: " . $conn->error);
      }
   } else {
      die("Error uploading photo: " . $conn->error);
   }
}

if (isset($_POST['btnUpdatePhoto'])) {
   $imageName = $_FILES['image']['name'];

   uploadPhoto($imageName, $id);
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
   <title>Blogen | Profile</title>
</head>

<body>
   <?php
   if ($_SESSION['role'] == "A") {
      include "adminMenu.php";
   } else {
      include "userMenu.php";
   }
   ?>
   <header>
      <div class="jumbotron jumbotron-fluid bg-blue m-0">
         <h1 class="display-4 text-white ml-4"><i class="fas fa-user mr-3"></i>Profile</h1>
      </div>
      <div class="jumbotron jumbotron-fluid bg-light">
         <div class="container text-container">
            <div class="row">
               <div class="col-sm">
                  <a class="btn btn-yellow col text-truncate" href="#"><i class="fas fa-lock mr-2"></i>Change
                     Password</a>
               </div>
               <div class="col-sm">
                  <a class="btn btn-outline-danger col text-truncate" href="#"><i class="fas fa-trash-alt mr-3"></i>Delete Account</a>
               </div>
            </div>
         </div>
      </div>
   </header>
   <main class="container mt-6">
      <div class="row">
         <div class="col-lg-4 col-md-6 mx-auto">
            <div class="card border-0">
               <!-- IMAGE -->
               <?php
               if ($row['avatar'] == NULL) {
               ?>
                  <div style="background-image: url('img/user.png'); width: 100%; height: 300px; background-position: center; background-size: cover;"></div>
               <?php
               } else {
               ?>
                  <div style="background-image: url('img/<?= $row['avatar'] ?>'); width: 100%; height: 350px; background-position: center; background-size: cover;"></div>
               <?php
               }
               ?>
               <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                     <div class="row">
                        <div class="custom-file col-lg-8 mb-1 mr-1">
                           <label for="choosePhoto" class="custom-file-label">Choose Photo</label>
                           <input type="file" name="image" id="choosePhoto" class="custom-file-input" required>
                        </div>
                        <button type="submit" class="btn btn-blue btn-sm col-lg mb-1" name="btnUpdatePhoto">Update</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="col-lg-8">
            <div class="container">
               <div class="row border-bottom mb-3 p-2">
                  <h3 class="d-inline text-muted">Update Details</h3>
               </div>
            </div>
            <form action="" method="post">
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
                  <input type="text" name="username" class="form-control" placeholder="Username" required>
               </div>
               <div class="input-group mb-2">
                  <div class="input-group-prepend">
                     <div class="input-group-text bg-lyellow"><i class="fas fa-lock"></i></div>
                  </div>
                  <input type="password" name="passw" class="form-control" placeholder="Password" minlength="8" required>
               </div>
               <?= $error ?>
            </form>
         </div>
      </div>
   </main>

   <footer class="bg-lblue text-center w-100" style="margin-top: 200px;">
      <small style="line-height:100px;">Kyle Nurville &copy; 2020</small>
   </footer>
   <script src="js/jquery.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
</body>

</html>