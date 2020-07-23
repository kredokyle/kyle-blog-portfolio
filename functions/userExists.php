<?php
function userExists($username)
{
   $sql = "SELECT * FROM accounts WHERE username = '$username'";
   $conn = connection();
   if ($result = $conn->query($sql)) {
      if ($result->num_rows == 0) {
         return false;
      } else return true;
   }
}