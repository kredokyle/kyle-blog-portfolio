<?php
session_start();
if (!$_SESSION['account_id']) {
   header("location: logout.php");
   exit;
}

include "functions/connection.php";
include "functions/categories.php";

if (isset($_POST['btnAddCategory'])) {
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
   <?php include "adminMenu.php" ?>
   <header class="jumbotron jumbotron-fluid bg-pink">
      <h2 class="display-4 text-white ml-4 text-truncate"><i class="far fa-folder-open pr-3"></i>Categories</h2>
   </header>
   <main role="main">
      <div class="container mt-6">
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
            <div class="col-lg-7 col-md-10 mx-auto">
               <table class="table table-striped table-hover table-sm">
                  <thead class="thead-dark">
                     <tr>
                        <th class="d-none d-sm-table-cell">Category ID</th>
                        <th>Category Name</th>
                        <th></th>
                        <th></th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $result = getCategories();
                     if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                     ?>
                           <tr>
                              <td class="text-center d-none d-sm-table-cell"><?= $row['id'] ?></td>
                              <td><?= $row['category_name'] ?></td>
                              <td class="text-center px-0">
                                 <a href="#" class="btn btn-outline-secondary btn-sm my-1">Update</a>
                              </td>
                              <td class="px-0">
                                 <a href="#" class="btn btn-outline-danger btn-sm my-1">Delete</a>
                              </td>
                           </tr>
                        <?php
                        }
                     } else {
                        ?>
                        <tr>
                           <td colspan="2" class="text-center">
                              <p class="lead font-italic font-weight-bold mb-0">No category found.</p>
                           </td>
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