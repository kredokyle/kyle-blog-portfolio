<?php
function getPost($postID)
{
   $sql = "SELECT posts.id AS id, posts.title AS title, posts.content AS content, posts.date_posted AS date_posted, posts.account_id AS account_id, accounts.username AS author, categories.name AS category
         FROM accounts
         INNER JOIN posts
         ON posts.account_id = accounts.id
         INNER JOIN categories
         ON posts.category_id = categories.id
         WHERE posts.id = $postID";
   $conn = connection();
   if ($result = $conn->query($sql)) {
      return $result->fetch_assoc();
   } else {
      die("Error retrieving post: " . $conn->error);
   }
}
