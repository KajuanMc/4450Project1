<?php 
session_start();
$id = $_SESSION["id"];
$firstname=$_SESSION["firstname"];
//for developer
//echo "User ID: ".$id."<br>";
?>
<html>
<!--Save under Project -->
    <head>
        <title>HTML/CSS Quiz</title>
        <style>.error{color:#FF0000;}</style>
    </head>
    <body>
        <?php 
        include "user_nav.php";
        //add testinput to lib01
        include "Library01.php";
        $Q1Msg=$Q2Msg=$Q3Msg=$Q4Msg=$Q5Msg="";
$Q1=$Q2=$Q3=$Q4=$Q5="";
 
$flag=0; // no red flag
$quizScore=0;
 
//when user clicked submit button
if($_SERVER["REQUEST_METHOD"]=="POST"){

	// Q1
	if(empty($_POST["Q1"])){
		$Q1Msg = "Please answer this question.";
		$flag=1; 
	}
	else{
		$Q1=test_input($_POST["Q1"]);
		if($Q1=="A"){
			$Q1Msg = "Good job!";
			$quizScore++;
		} else {
			$Q1Msg = "Sorry, not Correct.";
		}
	}
 
	// Q2
	if(empty($_POST["Q2"])){
		$Q2Msg = "Please answer this question.";
		$flag=1; 
	}
	else{
		$Q2=test_input($_POST["Q2"]);
		if($Q2=="C"){
			$Q2Msg = "Good job!";
			$quizScore++;
		} else {
			$Q2Msg = "Sorry, not Correct.";
		}
	}
 
	// Q3
	if(empty($_POST["Q3"])){
		$Q3Msg = "Please answer this question.";
		$flag=1; 
	}
	else{
		$Q3=test_input($_POST["Q3"]);
		if($Q3=="A"){
			$Q3Msg = "Good job!";
			$quizScore++;
		} else {
			$Q3Msg = "Sorry, not Correct.";
		}
	}	
	// Q4
	if(empty($_POST["Q4"])){
		$Q4Msg = "Please answer this question.";
		$flag=1; 
	}
	else{
		$Q4=test_input($_POST["Q4"]);
		if($Q4=="T"){
			$Q4Msg = "Good job!";
			$quizScore++;
		} else {
			$Q4Msg = "Sorry, not Correct.";
		}
	}	
	// Q5
	if(empty($_POST["Q5"])){
		$Q5Msg = "Please answer this question.";
		$flag=1; 
	}
	else{
		$Q5=test_input($_POST["Q5"]);
		if($Q5=="B"){
			$Q5Msg = "Good job!";
			$quizScore++;
		} else {
			$Q5Msg = "Sorry, not Correct.";
		}
	}	
    $quizResult = $quizScore/5 *100;
    if($flag ==0){
        include "connection.php";
        $sqs = "UPDATE users SET php=$quizResult WHERE id=$id";
        $returnValue = mysqli_query($dbc, $sqs);
        echo "The returned value is ".$returnValue."<br>";
        if($returnValue ==1){
            $msg= "Thank you for completing the SQL quiz.";
        }
        else{
            $msg="We have trouble saving your result.";
        }
        echo $msg;
        mysqli_close($dbc);
    }
}
$_SESSION["random"]="This is a random message";
        ?>
        <h1>HTML/CSS Questions</h1>
        <h3>This test will help you evaluate your SQL skills.</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
1. What does HTML stand for ? <span class="error"> * <?php echo $Q1Msg; ?> </span> <br>
<input type="radio" name="Q1" <?php if(isset($Q1)&&$Q1=="A") echo "checked" ; ?> value="A" > Hyper Text Markup Language
<input type="radio" name="Q1" <?php if(isset($Q1)&&$Q1=="B") echo "checked" ; ?> value="B" > Hyperlink and Text Language
<input type="radio" name="Q1" <?php if(isset($Q1)&&$Q1=="C") echo "checked" ; ?> value="C" > Home Text Makeup Language
<br> <br>
 
2. Who makes the web standards? <span class="error"> * <?php echo $Q2Msg; ?> </span> <br>
<input type="radio" name="Q2" <?php if(isset($Q2)&&$Q2=="A") echo "checked" ; ?> value="A" > Google
<input type="radio" name="Q2" <?php if(isset($Q2)&&$Q2=="B") echo "checked" ; ?> value="B" > Mozilla
<input type="radio" name="Q2" <?php if(isset($Q2)&&$Q2=="C") echo "checked" ; ?> value="C" > The World Wide Consortium
<br> <br>
 
3. What does CSS stand for?<span class="error"> * <?php echo $Q3Msg; ?> </span> <br>
<input type="radio" name="Q3" <?php if(isset($Q3)&&$Q3=="A") echo "checked" ; ?> value="A" > Cascading Style Sheet
<input type="radio" name="Q3" <?php if(isset($Q3)&&$Q3=="B") echo "checked" ; ?> value="B" > Cosmetic Styling Sheets
<input type="radio" name="Q3" <?php if(isset($Q3)&&$Q3=="C") echo "checked" ; ?> value="C" > Color Style Sheets
<br> <br>
 
4. Inline elements are displayed without starting a new line. <span class="error"> * <?php echo $Q4Msg; ?> </span> <br>
<input type="radio" name="Q4" <?php if(isset($Q4)&&$Q4=="T") echo "checked" ; ?> value="T" > True
<input type="radio" name="Q4" <?php if(isset($Q4)&&$Q4=="F") echo "checked" ; ?> value="F" > False
<br> <br>
 
5. How do you comment in CSS? <span class="error"> * <?php echo $Q5Msg; ?> </span> <br>
<input type="radio" name="Q5" <?php if(isset($Q5)&&$Q5=="A") echo "checked" ; ?> value="A" > //
<input type="radio" name="Q5" <?php if(isset($Q5)&&$Q5=="B") echo "checked" ; ?> value="B" > /*...*/
<input type="radio" name="Q5" <?php if(isset($Q5)&&$Q5=="C") echo "checked" ; ?> value="C" > <-- ->
<br> <br>
 
<input type="Submit">
 
</form>
    </body>
</html>