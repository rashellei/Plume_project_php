//this is added to config bcs its used bel database...
//so it should be reoved from here 
<?php
$conn = new mysqli('localhost', 'root', '',"plume_db");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

