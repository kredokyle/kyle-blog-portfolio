<?php
session_start();
if (!$_SESSION['account_id']) {
   header("location: logout.php");
   exit;
}

include "functions/connection.php";

function getAllPosts()
{
   // title
   // author - username
   // date_posted
   // category
   // Details
   $sql = "SELECT posts.id AS id, posts.post_title AS title, accounts.username AS author, posts.date_posted AS date_posted, categories.category_name AS category
         FROM accounts
         INNER JOIN posts
         ON accounts.id = posts.account_id
         INNER JOIN categories
         ON categories.id = posts.category_id";
   $conn = connection();
   if ($result = $conn->query($sql)) {
      return $result;
   } else {
      die("Error retrieving posts: " . $conn->error);
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
   <title>Blogen | Dashboard</title>
</head>

<body>
   <?php include "adminMenu.php" ?>

   <header>
      <div class="jumbotron jumbotron-fluid bg-blue m-0">
         <h2 class="display-4 text-white ml-4"><i class="fas fa-cog mr-3"></i>Dashboard</h2>
      </div>
      <div class="jumbotron jumbotron-fluid">
         <div class="container">
            <div class="row">
               <div class="col-md my-1">
                  <a class="btn btn-yellow col text-truncate" href="addPost.php" title="Add New Post"><i class="fas fa-plus mr-2"></i>Add New Post</a>
               </div>
               <div class="col-md my-1">
                  <a class="btn btn-yellow col text-truncate" href="categories.php" title="Add New Category"><i class="fas fa-plus mr-2"></i>Add New Category</a>
               </div>
               <div class="col-md my-1">
                  <a class="btn btn-yellow col text-truncate" href="users.php" title="Add New User"><i class="fas fa-plus mr-2"></i>Add New User</a>
               </div>
            </div>
         </div>
      </div>
   </header>
   <main>
      <div class="container mt-6">
         <div class="row">
            <div class="col-lg-8 mb-5">
               <div class="container">
                  <div class="row border-bottom mb-3 p-2">
                     <h3 class="d-inline text-muted">All Posts</h3>
                  </div>
               </div>
               <table class="table table-striped table-hover">
                  <thead class="thead-dark">
                     <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Date Posted</th>
                        <th>Category</th>
                        <th></th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $result = getAllPosts();
                     if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                     ?>
                           <tr>
                              <td><?= $row['title'] ?></td>
                              <td><?= $row['author'] ?></td>
                              <td><?= date_format(date_create($row['date_posted']), "F j, Y") ?></td>
                              <td><?= $row['category'] ?></td>
                              <td>
                                 <a href="viewPost.php?postID=<?= $row['id'] ?>" class="btn btn-outline-dark btn-sm"><i class="fas fa-angle-double-right mr-1"></i>View</a>
                              </td>
                           </tr>
                     <?php
                        }
                     } else {
                        //no post 
                     }
                     ?>
                  </tbody>
               </table>
            </div>
            <aside class="col-lg-4 mx-auto">
               <div class="row">
                  <div class="card text-center mb-4 mx-1 col-lg-12 col-md border-blue">
                     <div class="card-body">
                        <h4>My Posts</h4>
                        <h5><i class="fas fa-pencil-alt mr-2"></i>7</h5>
                        <a class="btn btn-outline-blue" href="post.php">View</a>
                     </div>
                  </div>
                  <div class="card border-pink text-center mb-4 mx-1 col-lg-12 col-md">
                     <div class="card-body">
                        <h4>Categories</h4>
                        <h5><i class="far fa-folder-open mr-2"></i>4</h5>
                        <a class="btn btn-outline-pink" href="category.php">View</a>
                     </div>
                  </div>
                  <div class="card border-yellow text-center mb-4 mx-1 col-lg-12 col-md">
                     <div class="card-body">
                        <h4>Users</h4>
                        <h5><i class="fas fa-users mr-2"></i>4</h5>
                        <a class="btn btn-outline-yellow" href="user.php">View</a>
                     </div>
                  </div>
               </div>
            </aside>
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