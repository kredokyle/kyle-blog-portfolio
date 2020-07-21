<?php
session_start();
if (!$_SESSION['account_id']) {
   header("location: logout.php");
   exit;
}

$error = "";

include "functions/connection.php";

function getUsers()
{
   $sql = "SELECT users.id AS id, users.first_name AS first_name, users.last_name AS last_name, users.address AS `address`, users.contact_number AS contact, accounts.username AS username, accounts.status AS `role`
   FROM users
   INNER JOIN accounts
   ON accounts.id = users.account_id";

   $conn = connection();

   if ($result = $conn->query($sql)) {
      return $result;
   } else {
      die("Error retrieving users: " . $conn->error);
   }
}

include "functions/register.php";

if (isset($_POST['btnAddUser'])) {
   $firstName = $_POST['firstName'];
   $lastName = $_POST['lastName'];
   $address = $_POST['address'];
   $contact = $_POST['contact'];
   $role = $_POST['role'];
   $username = $_POST['username'];
   $passw = $_POST['passw'];
   $confirmPassw = $_POST['confirmPassw'];

   if ($passw == $confirmPassw) {
      registerAdmin($firstName, $lastName, $address, $contact, $role, $username, $passw);
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
   <title>Blogen | Users</title>
</head>

<body>
   <?php include "admin_menu.php" ?>
   <header class="jumbotron jumbotron-fluid bg-yellow">
      <h2 class="display-4 text-white ml-4"><i class="fas fa-users pr-3"></i>Users</h2>
   </header>
   <main>
      <div class="container mt-5">
         <div class="row">
            <div class="col-xl-5 col-lg-10 mx-auto">
               <form action="" method="post">
                  <div class="card mb-5 bg-light">
                     <div class="card-header">
                        <h3 class="lead m-0">Add New User</h3>
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
                              <div class="input-group-text bg-lyellow"><i class="fas fa-user-tag"></i></div>
                           </div>
                           <select name="role" class="form-control">
                              <option value="A">Admin</option>
                              <option value="U">User</option>
                           </select>
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
                        <div class="input-group mb-2">
                           <div class="input-group-prepend">
                              <div class="input-group-text bg-lyellow"></div>
                           </div>
                           <input type="password" name="confirmPassw" class="form-control col" placeholder="Confirm Password" minlength="8">
                        </div>
                        <p class="text-muted text-right"><small>Password must be 8 or more characters long.</small></p>
                        <?= $error ?>
                        <div class="mt-5">
                           <button name="btnAddUser" class="btn btn-dark btn-block">Register</button>
                        </div>
                     </div> <!-- card body -->
                  </div> <!-- card -->
               </form>
            </div>
            <!--left form-->
            <div class="col-xl-7 col-lg-12">
               <table class="table table-striped table-bordered table-sm">
                  <thead class="thead-dark">
                     <tr>
                        <th>USER #</th>
                        <th>NAME</th>
                        <th>ADDRESS</th>
                        <th>CONTACT</th>
                        <th>USERNAME</th>
                        <th>ROLE</th>
                        <th></th>
                        <th></th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $result = getUsers();
                     while ($row = $result->fetch_assoc()) {
                     ?>
                        <tr>
                           <td><?= $row['id'] ?></td>
                           <td><?= $row['first_name'] . " " . $row['last_name'] ?></td>
                           <td><?= $row['address'] ?></td>
                           <td><?= $row['contact'] ?></td>
                           <td><?= $row['username'] ?></td>
                           <td><?php
                              if($row['role'] == "A") echo "Admin";
                              else echo "User";
                           ?></td>
                           <td></td>
                           <td></td>
                        </tr>
                     <?php
                     }
                     ?>
                  </tbody>
               </table>
            </div> <!-- right table-->
         </div> <!-- closing row -->
      </div>
      <!--closing container-->
   </main>
   <footer class="bg-lblue text-center w-100" style="margin-top: 200px;">
      <small style="line-height:100px;">Kyle Nurville &copy; 2020</small>
   </footer>

   <script src="js/jquery.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
</body>

</html>