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
include "functions/categories.php";

$postID = $_GET['postID'];
$rowPost = getPost($postID);

function updatePost($postID, $title, $datePosted, $categoryID, $content)
{
   $conn = connection();
   $title = $conn->real_escape_string($title);
   $content = $conn->real_escape_string($content);

   $sql = "UPDATE posts SET title = '$title', content = '$content', date_posted = '$datePosted', category_id = $categoryID WHERE id = $postID";

   if ($conn->query($sql)) {
      header("location: posts.php");
   } else {
      die("Error posting: " . $conn->error);
   }
}

if (isset($_POST['btnSave'])) {
   $title = $_POST['title'];
   $datePosted = $_POST['datePosted'];
   $categoryID = $_POST['category'];
   $content = $_POST['content'];
   updatePost($postID, $title, $datePosted, $categoryID, $content);
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
   <title>Blogen | Edit Post</title>
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
      <a href="viewPost.php?postID=<?= $postID ?>" class="btn btn-outline-secondary btn-sm mb-3 border-0"><i class="fas fa-chevron-left mr-2"></i>Back</a>
      <div class="card border-0">
         <div class="card-header border-0 rounded bg-yellow">
            <h3>Edit Post</h3>
         </div>
         <div class="card-body">
            <form action="" method="POST">
               <div class="row align-items-center my-2 px-3">
                  <label for="title" class="h5 text-center col-sm-2">Title</label>
                  <input type="text" name="title" id="title" class="form-control form-control-lg col-sm-10" value="<?= htmlspecialchars($rowPost['title']) ?>" required autofocus>
               </div>
               <div class="row px-0">
                  <div class="input-group mb-2 col-md-6">
                     <div class="input-group-prepend">
                        <div class="input-group-text bg-lyellow"><i class="fas fa-calendar-day"></i></div>
                     </div>
                     <input type="date" name="datePosted" class="form-control" value="<?= $rowPost['date_posted'] ?>" required>
                  </div>
                  <div class="input-group mb-2 col-md-6">
                     <div class="input-group-prepend">
                        <div class="input-group-text bg-lyellow"><i class="fas fa-sitemap"></i></div>
                     </div>
                     <select name="category" class="form-control" required>
                        <option value="">Select category</option>
                        <?php
                        $result = getCategories();
                        if ($result->num_rows > 0) {
                           while ($rowCat = $result->fetch_assoc()) {
                              if ($rowCat['name'] == $rowPost['category']) {
                                 echo "<option selected value='" . $rowCat['id'] . "'>" . $rowCat['name'] . "</option>";
                              } else {
                                 echo "<option value='" . $rowCat['id'] . "'>" . $rowCat['name'] . "</option>";
                              }
                           }
                        } else {
                           echo "<option disabled>No category found.</option>";
                        }
                        ?>
                     </select>
                  </div>

               </div>
               <textarea name="content" cols="30" rows="10" class="form-control" style="border-radius: 5px;"><?= $rowPost['content'] ?></textarea>

               <button type="submit" name="btnSave" class="btn btn-yellow px-6 mt-5 d-block mx-auto">Save</button>
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