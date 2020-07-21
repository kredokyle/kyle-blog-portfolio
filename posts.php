<?php
session_start();
if (!$_SESSION['account_id']) {
   header("location: logout.php");
   exit;
}

include "functions/connection.php";

function getPosts()
{
   $id = $_SESSION['account_id'];
   $sql = "SELECT posts.id AS id, posts.post_title AS post_title, categories.category_name AS category, posts.date_posted AS date_posted
         FROM posts
         INNER JOIN categories
         ON posts.category_id = categories.id
         WHERE posts.account_id = $id";
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
   <meta name="Description" content="Enter your description here" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
   <link rel="stylesheet" href="main.css">
   <title>Blogen | Posts</title>
</head>

<body>
   <?php
   if ($_SESSION['role'] == "A") {
      include "adminMenu.php";
   } else {
      include "userMenu.php";
   }
   ?>
   <header class="jumbotron jumbotron-fluid bg-blue">
      <h2 class="display-4 text-white ml-4"><i class="fas fa-pencil-alt pr-3"></i>Posts</h2>
   </header>
   <main class="container mt-5">
      <div class="container">
         <div class="row border-bottom mb-3 p-2 justify-content-between">
            <h3 class="d-inline text-muted">My Posts</h3>
            <a href="addPost.php" class="btn btn-outline-blue"><i class="fas fa-plus mr-2"></i>New Post</a>
         </div>
      </div>
      <table class="table table-hover">
         <thead class="thead-dark">
            <tr>
               <th>Title</th>
               <th>Date Posted</th>
               <th>Category</th>
               <th></th>
            </tr>
         </thead>
         <tbody>
            <?php
            $result = getPosts();
            if ($result->num_rows > 0) {
               while ($row = $result->fetch_assoc()) {
            ?>
                  <tr>
                     <td><?= $row['post_title'] ?></td>
                     <td><?= $row['date_posted'] ?></td>
                     <td><?= $row['category'] ?></td>
                     <td>
                        <a href="postDetails.php?id=<?= $row['id'] ?>" class="btn btn-outline-dark btn-sm"><i class="fas fa-angle-double-right mr-1"></i>Details</a>
                     </td>
                  </tr>
               <?php
               }
            } else {
               ?>
               <tr>
                  <td colspan="5" class="text-center">
                     <p class="lead font-italic font-weight-bold mb-0">No post found.</p>
                  </td>
               </tr>
            <?php } ?>
         </tbody>
      </table>
   </main>

   <footer class="bg-lblue text-center w-100" style="margin-top: 300px;">
      <small style="line-height:100px;">Kyle Nurville &copy; 2020</small>
   </footer>
   <script src="js/jquery.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
</body>

</html>