<html>  
  <head>
        <title>Admin Edit Users</title>
        <style>
         .error{color: #FF0000;}
         </style>
    </head>
    
    <body>
        <h1>Admin Edit User Page</h1>
<?php
include "admin_nav.php";
$id = $_GET["id"];
echo "The id of this user is ".$id."<br>";

include "connection.php";
$sqs = "SELECT * FROM users WHERE id=$id";
echo "SQL statement is ".$sqs."<br>";
?>
     </body>
</html>