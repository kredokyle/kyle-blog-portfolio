<?php
session_start();
if (!$_SESSION['account_id']) {
   header("location: logout.php");
   exit;
}

if (!$_GET['postID']) {
   header("location: posts.php");
   exit;
}

include "functions/connection.php";
include "functions/posts.php";
$postID = $_GET['postID'];
$row = getPost($postID);
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
   <title>Blogen | View Post</title>
   <style>
      .fa-grip-lines-vertical {
         color: #f3d250;
      }
   </style>
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
   <main class="container mt-6">
      <div class="row mb-3 p-2 justify-content-between">
         <a href="posts.php" class="btn btn-outline-secondary btn-sm border-0"><i class="fas fa-chevron-left mr-2"></i>Back to Posts</a>
         <?php
         if ($row['account_id'] == $_SESSION['account_id']) {
         ?>
            <a href="editPost.php?postID=<?= $postID ?>" class="btn btn-outline-yellow btn-sm border-0 text-secondary"><i class="fas fa-edit mr-2"></i>Edit Post</a>
         <?php
         }
         ?>
      </div>
      <h3 class="display-3"><?= $row['title'] ?></h3>
      <p class="small row">
         <span class="col-sm">
            by <span class="font-italic font-weight-bold"><?= $row['author'] ?></span>
         </span>
         <span class="col-sm d-none d-sm-block">
            <i class="fas fa-grip-lines-vertical"></i>
         </span>
         <span class="col-sm">
            <?= date_format(date_create($row['date_posted']), "F j, Y") ?>
         </span>
         <span class="col-sm d-none d-sm-block">
            <i class="fas fa-grip-lines-vertical"></i>
         </span>
         <span class="col-sm text-blue">
            <?= $row['category'] ?>
         </span>
      </p>
      <p class="lead mt-5">
         <?= $row['content'] ?>
      </p>
   </main>
   <footer class="bg-lblue text-center w-100" style="margin-top: 400px;">
      <small style="line-height:100px;">Kyle Nurville &copy; 2020</small>
   </footer>
   <script src="js/jquery.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
</body>

</html>