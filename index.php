<?php 
session_start();
?>
<html>
    <head>
        <title>Project 1- Login</title>
        <style>
         .error{color: #FF0000;}
         </style>
    </head>
    <body>
        <?php
        function test_input($data){
            $data = trim($data);
            $data=stripslashes($data);
            $data=htmlspecialchars($data);
            return $data;
        }
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $email = test_input($_POST["email"]);//needs to match name
            $pw = test_input($_POST["pw"]);//try to avoid using password as variable name(also is the name of the password in the box)

            include "connection.php";
            //query based on email
            $sqs ="SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($dbc, $sqs);
            $numrows = mysqli_num_rows($result);
            if($numrows==1){
                $row = mysqli_fetch_array($result);
                $dbpw=$row["pw"];//pw is the name of the column in the db table
                $dbfirstname=$row["firstname"];
                $user_type=$row["user_type"];
                $_SESSION["id"]=$row["id"];
                $_SESSION["email"]=$row["email"];
                $_SESSION["firstname"]=$row["firstname"];
                if($user_type == 0){
                    echo "Welcome to the admin side,".$dbfirstname."!";
                    mysqli_close($dbc);
                    header("Location:admin_nav.php");
                }

;                if($pw == $dbpw){
                    echo "Welcome to our website, ".$dbfirstname."!<br>";
                    mysqli_close($dbc);
                    //automatically moves user to home page upon sucessful log in
                    header("Location:user_nav.php");
                }else{
                    echo "Sorry, your password is not correct.";
                }
            }elseif($numrows==0){
                echo "Email is not in our system. Please register first.";
            }
            else{
                echo "Error. Something is wrong. Please try again later.";
            }
        }

    ?>




        <h1>Phase 1 - Project 1</h1>
        <p>Submitted by Kajuan McEachin</p>
        <hr>
        <h1>Welcome to Project 1</h1>
        <p>If you already have an account, please log in.</p>
        <p>Otherwise, please <a href = "account_creation.php"> sign up.</a></p>
        <form action =<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="POST">
        Email:<input type ="text" name = "email" maxLength="50"> <br><br>
        Password: <input type ="password" name ="pw" maxLength="22"><br><br>

        <input type = "submit" name ="Login" value ="LOG IN">
        </form>


    </body>
    </html>