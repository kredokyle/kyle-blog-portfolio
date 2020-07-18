<?php
function connection()
{
   $serverName = "localhost";
   $username = "root";
   $passw = "";
   $dbName = "blog";

   // Create a connection
   $conn = new mysqli($serverName, $username, $passw, $dbName);

   // Check connection
   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
   } else {
      return $conn;
   }
}
