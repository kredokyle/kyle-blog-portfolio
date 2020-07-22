<?php
function userExists($username){
   $sql = "SELECT * FROM accounts WHERE username = '$username'";
   $conn = connection();
   if($result = $conn->query($sql)){
      if($result->num_rows == 0){
         return false;
      } else return true;
   }
}

function registerUser($firstName, $lastName, $address, $contact, $username, $passw)
{
   if(!userExists($username)){
      $passw = password_hash($passw, PASSWORD_DEFAULT);
      $sql = "INSERT INTO accounts (username, `password`) VALUES ('$username', '$passw')";
      $conn = connection();
      if ($conn->query($sql)) {
         $last_id = $conn->insert_id;
         $sql = "INSERT INTO users (first_name, last_name, contact_number, `address`, account_id) VALUES ('$firstName', '$lastName', '$contact', '$address', $last_id)";
         if ($conn->query($sql)) {
            header("location: login.php");
            exit;
         } else {
            die("Error adding new user: " . $conn->error);
         }
      } else {
         die("Error adding new account: " . $conn->error);
      }
   }else{
      return "<div class='mt-3 mx-auto alert alert-danger' role='alert'>
         Username already exists.
         </div>";
   }
}

function registerAdmin($firstName, $lastName, $address, $contact, $role, $username, $passw){
   if (!userExists($username)) {
      $passw = password_hash($passw, PASSWORD_DEFAULT);
      $sql = "INSERT INTO accounts (username, `password`, `status`) VALUES ('$username', '$passw', '$role')";
      $conn = connection();
      if ($conn->query($sql)) {
         $last_id = $conn->insert_id;
         $sql = "INSERT INTO users (first_name, last_name, contact_number, `address`, account_id) VALUES ('$firstName', '$lastName', '$contact', '$address', $last_id)";
         if ($conn->query($sql)) {
            header("refresh: 0");
         } else {
            die("Error adding new user: " . $conn->error);
         }
      } else {
         die("Error adding new account: " . $conn->error);
      }
   } else {
      return "<div class='mt-3 mx-auto alert alert-danger' role='alert'>
         Username already exists.
         </div>";
   }
}