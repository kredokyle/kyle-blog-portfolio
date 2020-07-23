<?php
session_start();
if (!$_SESSION['account_id']) {
   header("location: logout.php");
   exit;
}

include "functions/connection.php";
include "functions/userExists.php";
$error = "";
$id = $_SESSION['account_id'];
$row = getUser($id);

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

function updateUser($id, $firstName, $lastName, $address, $contact, $bio){
   $sql = "UPDATE users SET first_name = '$firstName', last_name = '$lastName', `address` = '$address', contact_number = '$contact', bio = '$bio' WHERE account_id = $id";
   $conn = connection();
   if($conn->query($sql)){
      header("refresh: 0");
   } else {
      die("Error updating your information: " . $conn->error);
   }
}

function updateUsername($id, $username){
   if(!userExists($username)){
      $sql = "UPDATE accounts SET username = '$username' WHERE id = $id";
      $conn = connection();
      if($conn->query($sql)){
         $_SESSION['username'] = $username;
         header("refresh: 0");
      } else {
         die("Error updating username: " . $conn->error);
      }
   } else {
      // return "<div class='mt-3 mx-auto alert alert-danger' role='alert'> Username already exists. </div>";
   }
}

if (isset($_POST['btnUpdatePhoto'])) {
   $imageName = $_FILES['image']['name'];

   uploadPhoto($imageName, $id);
}

if(isset($_POST['btnUpdateInfo'])){
   $firstName = $_POST['firstName'];
   $lastName = $_POST['lastName'];
   $address = $_POST['address'];
   $contact = $_POST['contact'];
   $bio = $_POST['bio'];
   $username = $_POST['username'];
   $passw = $_POST['passw'];

   if(password_verify($passw, $row['password'])){
      if($username != $row['username']){
         updateUsername($id, $username);
      }
      $error = updateUser($id, $firstName, $lastName, $address, $contact, $bio);
   } else {
      $error = "<div class='mt-3 mx-auto alert alert-danger' role='alert'>
      Incorrect password.
      </div>";
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
               <div class="col-sm my-1">
                  <a class="btn btn-yellow col text-truncate" href="changePassword.php"><i class="fas fa-lock mr-2"></i>Change
                     Password</a>
               </div>
               <div class="col-sm my-1">
                  <a class="btn btn-outline-danger col text-truncate" href="#"><i class="fas fa-trash-alt mr-3"></i>Delete Account</a>
               </div>
            </div>
         </div>
      </div>
   </header>
   <main class="container mt-6">
      <div class="row">
         <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card mb-5 border-0">
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
                        <div class="custom-file col-md-8 mb-1 mr-1">
                           <label for="choosePhoto" class="custom-file-label">Choose Photo</label>
                           <input type="file" name="image" id="choosePhoto" class="custom-file-input" required>
                        </div>
                        <button type="submit" class="btn btn-dark btn-sm text-truncate col mb-1" name="btnUpdatePhoto" title="Update Photo">Update Photo</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="col-lg-7">
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
                  <input type="text" name="firstName" class="form-control" placeholder="First Name" value="<?= $row['first_name'] ?>" required autofocus>
                  <input type="text" name="lastName" class="form-control" placeholder="Last Name" value="<?= $row['last_name'] ?>" required>
               </div>
               <div class="input-group mb-2">
                  <div class="input-group-prepend">
                     <div class="input-group-text bg-lyellow"><i class="fas fa-map-pin"></i></div>
                  </div>
                  <input type="text" name="address" class="form-control" placeholder="Address" value="<?= $row['address'] ?>" required>
               </div>
               <div class="input-group mb-2">
                  <div class="input-group-prepend">
                     <div class="input-group-text bg-lyellow"><i class="fas fa-phone-alt"></i></div>
                  </div>
                  <input type="text" name="contact" class="form-control" placeholder="Contact Number" value="<?= $row['contact_number'] ?>" required>
               </div>
               <textarea name="bio" class="form-control mb-5" style="border-radius: 5px;" cols="30" rows="10" placeholder="Write your bio here"><?= $row['bio'] ?></textarea>

               <div class="input-group mb-2">
                  <div class="input-group-prepend">
                     <div class="input-group-text bg-yellow"><i class="fas fa-id-card"></i></div>
                  </div>
                  <input type="text" name="username" class="form-control font-weight-bold" placeholder="Username" value="<?= $row['username'] ?>" required>
               </div>
               <div class="input-group mb-4">
                  <div class="input-group-prepend">
                     <div class="input-group-text bg-yellow"><i class="fas fa-lock"></i></div>
                  </div>
                  <input type="password" name="passw" class="form-control" placeholder="Enter password to confirm" minlength="8" required>
               </div>
               <?= $error ?>

               <button type="submit" name="btnUpdateInfo" class="btn btn-dark float-right">Save Changes</button>
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