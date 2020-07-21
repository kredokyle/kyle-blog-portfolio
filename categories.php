<?php
session_start();
if (!$_SESSION['account_id']) {
   header("location: logout.php");
   exit;
}

include "functions/connection.php";

function getCategories(){
   $sql = "SELECT * FROM categories";
   $conn = connection();
   if($result = $conn->query($sql)){
      return $result;
   }else{
      die("Error retrieving categories: " . $conn->error);
   }
}

function createCategory($category){
   $sql = "INSERT INTO categories (category_name) VALUES ('$category')";
   $conn = connection();
   if($conn->query($sql)){
      header("refresh: 0");
   }else{
      die("Error adding new category: " . $conn->error);
   }
}

if(isset($_POST['btnAddCategory'])){
   $category = $_POST['category'];

   createCategory($category);
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
   <title>Blogen | Categories</title>
</head>

<body>
   <?php include "admin_menu.php" ?>
   <header class="jumbotron jumbotron-fluid bg-pink">
      <h2 class="display-4 text-white ml-4"><i class="far fa-folder-open pr-3"></i>Categories</h2>
   </header>
   <main role="main">
      <div class="container mt-5">
         <div class="row">
            <div class="col-lg-5 col-md-6 mx-auto">
               <form action="" method="post">
                  <div class="card mb-5 bg-light">
                     <div class="card-header">
                        <h3 class="lead m-0">Add New Category</h3>
                     </div>
                     <div class="card-body bg-white">
                        <div class="input-group mb-3">
                           <div class="input-group-prepend">
                              <div class="input-group-text bg-lpink"><i class="fas fa-sitemap"></i></div>
                           </div>
                           <input type="text" name="category" class="form-control" placeholder="Enter name of category">
                        </div>
                        <button type="submit" name="btnAddCategory" class="btn btn-primary btn-sm float-right">Add</button>
                     </div>
                  </div>
               </form>
            </div>
            <div class="col-lg-7 col-md-12">
               <table class="table table-striped table-hover table-sm">
                  <thead class="thead-dark">
                     <tr>
                        <th>Category ID</th>
                        <th>Category Name</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $result = getCategories();
                     while($row = $result->fetch_assoc()){
                     ?>
                        <tr>
                           <td><?= $row['id'] ?></td>
                           <td><?= $row['category_name'] ?></td>
                        </tr>
                     <?php
                     }
                     ?>
                  </tbody>
               </table>
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