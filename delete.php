<?php 
if($_SERVER["REQUEST_METHOD"]=="POST"){
echo "Ready to delete";
    include "connection.php";
    $id=$_POST["id"];

    //delete based on email
   // $email=$_POST["email"];
$email =mysqli_real_escape_string($dbc, trim($_POST["email"]));
$qs = "DELETE FROM users WHERE id = $id";
mysqli_query($dbc, $qs);
echo "User id: ".$id." has been deleted. ";
echo "Please <a href = 'admin_manage.php'>click here</a> to go back.";
    
}
?>