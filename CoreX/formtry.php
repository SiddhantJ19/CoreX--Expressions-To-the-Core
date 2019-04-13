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
$nameErr = $emailErr = $phoneErr = "";
$name = $email = $comment = $phone = "";
$flag1=$flag2=$flag3=$flag4=0;

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

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    $flag2=1;
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
      $flag2=0;
    }
  }



  if (empty($_POST["phone_number"])) {
    $phoneErr= "Phone Numnber is required";
  } else {
    $phone = test_input($_POST["phone_number"]);
    $flag3=1;
    // check if Phone Number is valid

    if($phone<9000000000||$phone>9999999999){
    	$phoneErr="invalid number";
    	$flag3=0;
    }

  }



  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
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
  E-mail: <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
 Phone Number: <input type="text" name="phone_number" value="<?php echo $phone;?>">
  <span class="error">*<?php echo $phoneErr;?></span>

  <br><br>
  Comment:<textarea name="comment" rows="5" cols="40" onkeydown="length()" maxlength="40"><?php echo $comment;?></textarea>
   <br><br>
  <input type="submit" name="submit" value="Submit">
  <input type="reset" value="change?">
</form>

<?php
if($flag1==1){
	if($flag2==1){
		if($flag3==1){


			$sql1="SELECT * FROM register WHERE Email='$email'";
			//$sql1="SELECT * FROM register WHERE Name='".$name."' and password='".$password."' and email='".$email."';";

			$result1 = $conn->query($sql1);
			if ($result1->num_rows > 0) {
				$row=$result1->fetch_assoc();
				echo "<br>you already have a comment.";
				//echo "<pre>",print_r($row),"</pre>";

				//replace, update

				if($row['Name']==$name&&$row['number']==$phone){
					$sql2 = "UPDATE register SET comment='$comment', date=CURDATE() WHERE Email='$email';";
					//$sql2="INSERT INTO register where Email='$email' (date,comment)
					//VALUES (CURDATE(),'$comment');";
					if ($conn->query($sql2) === TRUE) {
						echo "Record updated successfully";
					} else {
						echo "Error updating record: " . $conn->error;
					}

				}
				else{
					echo"this email has already been used, you have put the wrong email";
				}



			}

			else{

				$sql = "INSERT INTO register (date,Name,number, Email,comment)
				VALUES (CURDATE(),'$name',$phone,'$email','$comment')";

				if ($conn->query($sql) === TRUE) {
					echo "<h1>your comment is added, we will contact you shortly</h1>";						//put a modal here, instead of a simple comment
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}

			}

			$conn->close();


		}
	}
}

?>

</body>
</html>
