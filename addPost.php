<?php
session_start();
if (!$_SESSION['account_id']) {
   header("location: logout.php");
   exit;
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
   <title>Blogen | New Post</title>
</head>

<body>
   <?php
   if ($_SESSION['role'] == "A") {
      include "admin_menu.php";
   } else {
      include "user_menu.php";
   }
   ?>
   <header class="jumbotron jumbotron-fluid bg-blue">
      <h2 class="display-4 text-white ml-4"><i class="fas fa-pencil-alt pr-3"></i>Posts</h2>
   </header>
   <main class="container">
      <div class="card">
         <div class="card-header">
            <h3>New Post</h3>
         </div>
         <div class="card-body">
            <div class="form-group row align-items-center my-4">
               <label for="title" class="h5 text-center col-sm-2">Title</label>
               <input type="text" name="title" class="form-control form-control-lg col-sm-9" required autofocus>
            </div>
            <div class="input-group mb-2">
               <div class="input-group-prepend">
                  <div class="input-group-text bg-lblue"><i class="fas fa-calendar-day"></i></div>
               </div>
               <input type="date" name="date" class="form-control" required>
            </div>
            <div class="input-group mb-2">
               <div class="input-group-prepend">
                  <div class="input-group-text bg-lblue"><i class="fas fa-map-pin"></i></div>
               </div>
               <select name="category" class="form-control" required>
                  <option value="">Select category</option>
               </select>
            </div>
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