<html>
    <head>
        <title>Admin delete</title>
        <style>
         .error{color: #FF0000;}
         </style>
    </head>
    
    <body>
    <?php
    include "admin_nav.php";
    $id = $_GET["id"];
    echo "User ID is ".$id."<br>";

    include "connection.php";
    $sqs = " SELECT * FROM users WHERE id =$id";

    $result = mysqli_query($dbc, $sqs);
    $numrows = mysqli_num_rows($result);
    if($numrows==1){
        $row=mysqli_fetch_array($result);
        $dbfirstname = $row["firstname"];
        $dblastname = $row["lastname"];
        $dbemail = $row["email"];
        $dbid = $row["id"];
    }else{
        echo "Something is wrong";
    }

    ?>
    <p>Are you sure you want to delete this user?</p>
    <form action="delete.php" method="post">
        <input type ="hidden" name ="id" value="<?php echo $dbid; ?>"><br><br> <!-- the id -->
        First Name: <input type ="text" name ="firstname" value="<?php echo $dbfirstname; ?>"><br><br>
        Last Name: <input type ="text" name ="lastname" value="<?php echo $dblastname; ?>"><br><br>
        Email: <input type ="text" name ="email" value="<?php echo $dbemail; ?>"><br><br>

        <input type ="submit" name ="delete" value=" CONFIRM DELETE">
</form>

    </body>
</html>