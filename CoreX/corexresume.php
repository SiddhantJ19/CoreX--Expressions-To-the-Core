<!DOCTYPE HTML>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>

<?php

// define variables and set to empty values
$nameErr = $emailErr =$aliasErr= "";
$name = $email = $q1=$q2=$q3=$q4=$url= "";
$flag1=$flag2=$flag3=$flag4=$c1=$c2=$c3=$c4=$c5=$c6=$pic=$qu1=$qu2=$qu3=$qu4=0;

$servername = "localhost";
$username = "root";
$password = "royya123";
$dbname="main";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo ".";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    $flag1=1;
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
      $flag1=0;
    }
  }

   if (empty($_POST["alias"])) {
    $aliasErr = "alias is required";
  } else {
    $alias = test_input($_POST["alias"]);
    $flag2=1;
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$alias)) {
      $aliasErr = "Only letters and white space allowed";
      $flag2=0;
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    $flag3=1;
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
      $flag3=0;
    }
  }

  //google pic

  if($_POST['pic']=='yes'){
  	$pic=1;
  }
  else{
  	$pic=0;
  }

  //all the checkboxes


  if(isset($_POST['check1'])){
  	$c1=1;
  }

  if(isset($_POST['check2'])){
  	$c2=1;
  }

  if(isset($_POST['check3'])){
  	$c3=1;
  }

  if(isset($_POST['check4'])){
  	$c4=1;
  }

  if(isset($_POST['check5'])){
  	$c5=1;
  }

 /* if(isset($_POST['check6'])){
  	$c6=1;
  }*/



  //all questions

  $q1=test_input($_POST["question1"]);

 	if(str_word_count($q1)==0){
 		$qu1=0;
 	}
 	else if(str_word_count($q1)<100){
 		$qu1=1;
 	}
 	else if(str_word_count($q1)<200){
 		$qu1=2;
 	}
 	else if(str_word_count($q1)<300){
 		$qu1=3;
 	}
 	else{
 		$qu1=4;
 	}

 	$q2=test_input($_POST["question2"]);

 	if(str_word_count($q2)==0){
 		$qu2=0;
 	}
 	else if(str_word_count($q2)<100){
 		$qu2=1;
 	}
 	else if(str_word_count($q2)<200){
 		$qu2=2;
 	}
 	else if(str_word_count($q2)<300){
 		$qu2=3;
 	}
 	else{
 		$qu2=4;
 	}

 	$q3=test_input($_POST["question3"]);

 	if(str_word_count($q3)==0){
 		$qu3=0;
 	}
 	else if(str_word_count($q3)<100){
 		$qu3=1;
 	}
 	else if(str_word_count($q3)<200){
 		$qu3=2;
 	}
 	else if(str_word_count($q3)<300){
 		$qu3=3;
 	}
 	else{
 		$qu3=4;
 	}

 	$q4=test_input($_POST["question4"]);

 	if(str_word_count($q4)==0){
 		$qu4=0;
 	}
 	else if(str_word_count($q4)<100){
 		$qu4=1;
 	}
 	else if(str_word_count($q4)<200){
 		$qu4=2;
 	}
 	else if(str_word_count($q4)<300){
 		$qu4=3;
 	}
 	else{
 		$qu4=4;
 	}



   if (empty($_POST["url"])) {
    $urlErr= "link is must";
  } else {
    $url = test_input($_POST["url"]);
    $flag4=1;


  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>


<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  alias <input type="text" name="alias" value="<?php echo $alias;?>">
  <span class="error">* <?php echo $aliasErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
 	front end developer<input type="checkbox" name="check1" value="check1"><br><br>
 	relation manager...<input type="checkbox" name="check2" value="check2"><br><br>
 	quality assurance....<input type="checkbox" name="check3" value="check3"><br><br>
 	placements.........<input type="checkbox" name="check4" value="check4"><br><br>
 	skills.............<input type="checkbox" name="check5" value="check5"><br><br>

 you have your pic on google or not?
 	yes<input type="radio" name="pic" value="yes"><br><br>
	no<input type="radio" name="pic" value="no">
  <br><br>
  question 1<textarea name="question1" rows="5" cols="40" onkeydown="length()" maxlength="40" value="<?php echo $q1;?>" placeholder="Do you believe that your life flashes before your eyes before you die? Why?"></textarea>
   <br><br>
   question 2<textarea name="question2" rows="5" cols="40" onkeydown="length()" maxlength="40" value="<?php echo $q2;?>" placeholder="Draw a monster, why is that a monster?"></textarea>
   <br><br>
   question 3<textarea name="question3" rows="5" cols="40" onkeydown="length()" maxlength="40" value="<?php echo $q3;?>" placeholder="Do monster make wars, or war makes monsters? Why?"></textarea>
   <br><br>
   question 4<textarea name="question4" rows="5" cols="40" onkeydown="length()" maxlength="40" value="<?php echo $q4;?>" placeholder="Whats the difference between philosophy and religion?"></textarea>
   <br><br>
   <input type="text" name="url">
  <input type="submit" name="submit" value="Submit">
  <input type="reset" value="change?">
</form>

<?php
if($flag1==1){
	if($flag2==1){
		if($flag3==1){
			if($flag4==1){


				$sql1="SELECT * FROM corexjob WHERE Email='$email'";

				$result1 = $conn->query($sql1);
				if ($result1->num_rows > 0) {
					$row=$result1->fetch_assoc();

					echo "you cannot update your record again, use another email";
				}

				else{

					$sql = "INSERT INTO corexjob (date,name,alias,pic_google,fed,rm,qa,p,s,q1,q2,q3,q4,url,email)
					VALUES (CURDATE(),'$name','$alias',$pic,$c1,$c2,$c3,$c4,$c5,$qu1,$qu2,$qu3,$qu4,'$url','$email')";

					if ($conn->query($sql) === TRUE) {
						echo "<h1>your resume is added, we will contact you shortly</h1>";						//put a modal here, instead of a simple comment
					} else {
						echo "Error: " . $sql . "<br>" . $conn->error;
					}

				}

				$conn->close();


			}
		}
	}
}

?>

</body>
</html>
