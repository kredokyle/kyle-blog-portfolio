<?php
function getCategories()
{
   $sql = "SELECT * FROM categories";
   $conn = connection();
   if ($result = $conn->query($sql)) {
      return $result;
   } else {
      die("Error retrieving categories: " . $conn->error);
   }
}

function createCategory($category)
{
   $sql = "INSERT INTO categories (category_name) VALUES ('$category')";
   $conn = connection();
   if ($conn->query($sql)) {
      header("refresh: 0");
   } else {
      die("Error adding new category: " . $conn->error);
   }
}