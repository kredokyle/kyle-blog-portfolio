<nav class="navbar navbar-expand-md navbar-light bg-light">
   <!-- BRAND -->
   <h1 class="navbar-brand h3 mb-2">Blogen</h1>

   <!-- BUTTON -->
   <button class="navbar-toggler" data-toggle="collapse" data-target="#adminMenu">
      <span class="navbar-toggler-icon"></span>
   </button>
   <!-- COLLAPSIBLE LIST -->
   <div class="collapse navbar-collapse" id="adminMenu">
      <!-- left list -->
      <ul class="navbar-nav mr-auto">
         <li class="nav-item">
            <a href="posts.php" class="nav-link">Posts</a>
         </li>
         <li class="nav-item">
            <a href="addPost.php" class="nav-link">Add Post</a>
         </li>
      </ul>
      <!-- right list -->
      <ul class="navbar-nav">
         <li class="nav-item mr-2">
            <a href="profile.php" class="nav-link">
               User <?= $_SESSION['username'] ?>
            </a>
         </li>
         <li class="nav-item">
            <a href="logout.php" class="btn btn-outline-danger">Log out</a>
         </li>
      </ul>
   </div>
</nav>