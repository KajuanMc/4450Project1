<html>
    <head>
        <title>Account Creation</title>
        <style>
         .error{color: #FF0000;}
         </style>
    </head>
    <body>
        <h1>Account Creation</h1>
        <h2>Registration Form</h2>
        <?php
        $firstNameErr=$lastNameErr=$emailErr=$phoneErr=$genderErr=$levelErr=$passwordErr="";
        //adding default value
        $firstname="Firstname";
        $lastname="Lastname";
        $phone="111-222-3333";
        $email="example@ggc.edu";
        $gender=$level=$password1=$password2="";
        $flag=0;//no red flag, ready to insert
        

      
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $firstname = test_input($_POST["firstname"]);
            $lastname = test_input($_POST["lastname"]);
            $email = test_input($_POST["email"]);
            $phone = test_input($_POST["phone"]);
            $gender = $_POST["gender"];
            $level = $_POST["level"];
            $password1 = test_input($_POST["password1"]);
            $password2 = test_input($_POST["password2"]);

            if($firstname=="" || $firstname=="Firstname"){
                $firstNameErr ="First Name is required";
                $flag=1;
            }else{
                if(!preg_match("/^[a-zA-Z ]*$/", $firstname)){
                    $firstNameErr="Only letters and white space allowed.";
                    $flag=1;
                }
            }
            if($lastname=="" || $lastname=="Lastname"){
                $firstNameErr ="Last Name is required";
                $flag=1;
            }else{
                if(!preg_match("/^[a-zA-Z ]*$/", $lastname)){
                    $lastNameErr="Only letters and white space allowed.";
                    $flag=1;
                }
            }
            if($email=="" || $email=="example@ggc.edu"){
                $emailErr ="Email is required";
                $flag=1;
            }else{
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $emailErr="Invalid email format";
                $flag=1;
            }
            }
            if($password1==""||$password2==""){
                $passwordErr= "Password is required!";
                $flag=1;
            }else{
                if($password1 !=$password2){
                    $passwordErr="Passwords must match!";
                    $flag=1;
                }
            }

            if($phone=="" || $phone=="111-222-3333"){
                $phoneErr ="Phone number is required";
                $flag=1;

            }else{
                if(!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $phone)){
                    $phoneErr="Invalid phone number.";
                    $flag=1;
                }
            }
            if($gender=="0"){
                $genderErr="Gender is required!";
                $flag=1;
            }
            if($level=="0"){
                $levelErr="Credit hours required!";
                $flag=1;
            }
            /////insert into DB
            ///////////////////////////Remember to chance values to ones specific to my db
            if($flag==0){
                include "connection.php";
                //check db table, make sure email is not used in the table
                $sqs ="SELECT * FROM users WHERE email = '$email'";
                $qresult = mysqli_query($dbc, $sqs);
                $number =  mysqli_num_rows($qresult);
                //num should be 0, if not, email is already in the DB
                //add logic for phone number
                
                if($number !=0){
                    echo "<h3> Email has been used. Please try a different email. </h3>";
                }else{
                    //insert only when num1 and num2 are 0
                      $sqs = "INSERT INTO users(firstname, lastname, email, phone, gender, pw, level) 
                        VALUES('$firstname','$lastname','$email','$phone','$gender','$password1','$level')"; //db values, add level to db
                        mysqli_query($dbc, $sqs);
                        $registered = mysqli_affected_rows($dbc);
                        echo $registered." User information has been stored successfully!";
                        header("Location:register_success.php");
                    }
              
            }
            
        }//end of post method if statement

        function test_input($data){
            $data = trim($data);
            $data=stripslashes($data);
            $data=htmlspecialchars($data);
            return $data;
        }
        ?>


        <form action =<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="POST">
            First Name: <input type="text" name="firstname" value ="<?php echo $firstname; ?>"> <span class="error">* </span><?php echo $firstNameErr; ?> <br><br>
            Last Name: <input type="text" name="lastname" value ="<?php echo $lastname; ?>"> <span class="error">*</span> <?php echo $lastNameErr; ?> <br><br>
            Email:<input type="text" name="email" value="<?php echo $email; ?>"> <span class ="error">* </span><?php echo $emailErr; ?><br><br>
           
           Password:<input type="password" name="password1" maxLength="30"> <span class ="error">* </span><?php echo $passwordErr; ?><br><br>
           Confirm Password:<input type="password" name="password2" maxLength="30"><span class ="error">* </span><?php echo $passwordErr; ?><br><br>

            Phone Number:<input type="text" name="phone" value="<?php echo $phone; ?>"> <span class ="error">* </span><?php echo $phoneErr; ?><br><br>
            Gender: <span class="error">* <?php echo $genderErr; ?></span><br>
            <input type="radio" name="gender" value="Female" <?php if(isset($gender)&&$gender=="Female") echo "checked"; ?>>Female
            <input type="radio" name="gender" value="Male"<?php if(isset($gender)&&$gender=="Male") echo "checked"; ?>>Male
            <input type="radio" name="gender" value="Other"<?php if(isset($gender)&&$gender=="Other") echo "checked"; ?>>Other
            
            <br><br>


         <br>
            The total number of IT Credits you have earned:<span class="error">* <?php echo $levelErr; ?></span><br>
            <input type ="radio" name="level" value="A"<?php if(isset($level)&&$level=="A") echo "checked"; ?> >Less than 30 hours<br>
            <input type ="radio" name="level" value="B"<?php if(isset($level)&&$level=="B") echo "checked"; ?> >More than 30, less than 60<br>
            <input type ="radio" name="level" value="C"<?php if(isset($level)&&$level=="C") echo "checked"; ?> >More than 60, less than 90<br>
            <input type ="radio" name="level" value="D"<?php if(isset($level)&&$level=="D") echo "checked"; ?> >More than 90 hours<br>
            

            <br><br>
            <input type="submit">
        </form>   
    
    </body>
</html>