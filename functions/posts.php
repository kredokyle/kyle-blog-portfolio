<?php
function getPost($postID)
{
   $sql = "SELECT posts.id AS id, posts.post_title AS post_title, posts.post_message, posts.date_posted AS date_posted, posts.account_id AS account_id, accounts.username AS author, categories.category_name AS category
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
