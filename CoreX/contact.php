<!DOCTYPE html>
<html>
  <head>
    <style>
    @font-face {
      font-family: corexfont;
      src: url(corexfont.woff);
  }
  @font-face {
    font-family:chaprral;
    src: url(ChaparralPro-Light.otf);
  }
      body {
        margin: 0;
      }
      .color1{color:#cccccc;}
      .color2{color:#b3b3b3;}
      .error {color: #FF0000;}
      #navbar{
        position: absolute;
        height: 5vw;
        width: 100%;
        background-color:rgba(31,34,45,1);
        color:white;
      }
      .navbutton{
        position: relative;
        top:40%;
        font-size: 1.2vw;
        font-family: chaprral;
      }
      #navlogo{
        position: absolute;
        height: 5vw;
        top:0vw;
        width: 15vw;
        left:20vw;
        background-color: rgba(31,34,45,1);
        overflow:hidden;
      }
      @-webkit-keyframes rotating{
        from {
          -webkit-transform: rotate(0deg);
          -o-transform: rotate(0deg);
          transform: rotate(0deg);
        }
        to {
          -webkit-transform: rotate(360deg);
          -o-transform: rotate(360deg);
          transform: rotate(360deg);
        }
      }
      @keyframes rotating {
        from {
          -ms-transform: rotate(0deg);
          -moz-transform: rotate(0deg);
          -webkit-transform: rotate(0deg);
          -o-transform: rotate(0deg);
          transform: rotate(0deg);
        }
        to {
          -ms-transform: rotate(360deg);
          -moz-transform: rotate(360deg);
          -webkit-transform: rotate(360deg);
          -o-transform: rotate(360deg);
          transform: rotate(360deg);
        }
      }
      .rotating {
        -webkit-animation: rotating 90s linear infinite;
        -moz-animation: rotating 90s linear infinite;
        -ms-animation: rotating 90s linear infinite;
        -o-animation: rotating 90s linear infinite;
        animation: rotating 90s linear infinite;
      }
      a.navbutton{
        color: inherit;
        text-decoration: none;
      }

    </style>
  </head>
  <body>
    <div id="navbar" onmouseover="navdown()" onmouseout="navup()">
      <div id="navlogo"  >
        <img src="corexlogo.png" style="position:absolute;width:60%;z-index:1;left:18%;top:35%">
        <img src="logo-wheel.svg" class="rotating" style="position:absolute;width:70%;left:15%;top:-50%;overflow:hidden;" >
      </div>
      <a href="index.html" class="navbutton" style="left:45%;" >About</a>
      <a href="project.html" class="navbutton" style="left:47.5%;" >Projects  </a>
      <a href="manifesto.html" class="navbutton" style="left:50%;"  >Manifesto </a>
      <a href="life6.html" class="navbutton" style="left:52.5%;" >Life  </a>
      <a href="job.php" class="navbutton" style="left:55%;" >Jobs  </a>
      <a href="contact.php" class="navbutton"  style="left:57.5%;" ><b> Contact Us</b>  </a>
    </div>
    <div style="position:absolute;top:0vw;width:100%;overflow:hidden;height:20vw;z-index:-1;" >
      <img src="./manifesto/cover.png" width="100%" >
    </div>
    <div style="position:absolute;background-color:white;top:17vw;left:25vw;width:50%;" >
      <span style="position:relative;font-family:corexfont;font-size:2vw;color:#414345;margin-left:5vw;top:3vw;">Please Leave Your Valuable Feedback here:</span>
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

        <div style="position:relative;top:8vw;font-family:chaprral;font-size:1.2vw;padding-left:4vw;padding-right:4vw;" >
          <span class="error">* required field.</span><br>
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            Name:<br> <input type="text" name="name" value="<?php echo $name;?>">
            <span class="error">* <?php echo $nameErr;?></span>
            <br><br>
            E-mail: <br><input type="text" name="email" value="<?php echo $email;?>">
            <span class="error">* <?php echo $emailErr;?></span>
            <br><br>
           Phone Number:<br> <input type="text" name="phone_number" value="<?php echo $phone;?>">
            <span class="error">*<?php echo $phoneErr;?></span>

            <br><br>
            Comment:<br><textarea name="comment" rows="5" cols="40" onkeydown="length()" maxlength="40"><?php echo $comment;?></textarea>
             <br><br>
            <input type="submit" name="submit" value="Submit">
            <input type="reset" value="change?">
          </form>



</div>

<?php
if($flag1==1){
	if($flag2==1){
		if($flag3==1){


			$sql1="SELECT * FROM register WHERE Email='$email'";
			//$sql1="SELECT * FROM register WHERE Name='".$name."' and password='".$password."' and email='".$email."';";

			$result1 = $conn->query($sql1);
			if ($result1->num_rows > 0) {
				$row=$result1->fetch_assoc();
				echo "<p style='position:absolute;top:32vw;font-size:2vw;font-family:chaprral;' >Your already have a comment</p>";
				//echo "<pre>",print_r($row),"</pre>";

				//replace, update

				if($row['Name']==$name&&$row['number']==$phone){
					$sql2 = "UPDATE register SET comment='$comment', date=CURDATE() WHERE Email='$email';";
					//$sql2="INSERT INTO register where Email='$email' (date,comment)
					//VALUES (CURDATE(),'$comment');";
					if ($conn->query($sql2) === TRUE) {
						echo "<p style='position:absolute;top:34vw;font-size:2vw;font-family:chaprral;' >Record updated</p>";
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
					echo "<p style='position:absolute;top:32vw;font-size:2vw;font-family:chaprral;' >Your comment is added, we will contact you shortly</p>";						//put a modal here, instead of a simple comment
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}

			}

			$conn->close();


		}
	}
}

?>

    </div>
  <img src="./manifesto/areyouready.png" style="width:100%;position:absolute;bottom:-15vw;" >
  <div style="font-family:chaprral;position:absolute;top:66vw;background-color:#14151a;width:100%;height:10vw;" >
    <ul style="margin-left:10vw;position:absolute;list-style: none;">
            <li>
                <h1 class="color1">CorEx</h1>
                <a href="#!/en/mentions-legales"><p  class="color2">Terms &amp; conditions</p></a>
                <p  class="color2">©ITWS1 FALL-2017</p>
              </li>
            </ul>
    <ul style="margin-left:35vw;position:absolute;list-style: none;">
      <li>
        <h3  class="color1">Visit Us</h3>
        <a href="https://www.google.com/maps/d/viewer?mid=19JTfJhly2iU5ydLGBP4sVLwWmSU&hl=en_US" target="_blank"><p  class="color2">Indian Institute of </p></a>
          <p class="color2">  Information Technology,<br><br>
              SriCity , India</p>
      </li>
    </ul>
      <ul style="margin-left:55vw; position:absolute;list-style: none;">
        <li>
          <h3  class="color1">Contact Us</h3>
          <a href="mailto:contact@corex.com?Subject=Hey%20There!" class="color2" target="_top">contact@corex.com</a>
        </li>
      </ul>
      <ul style="margin-left:75vw;position:absolute;list-style: none;">
        <li>
        <h3 class="color1">Follow Us</h3>
        <a href="http://twitter.com" target="_blank"><p class="color2">Twitter </p></a>
        <a href="http://www.facebook.com" target="_blank"><p  class="color2">Facebook</p></a>
        <a href="http://www.linkedin.com" target="_blank"><p  class="color2">LinkedIn</p></a>
      </li>
    </ul>


  </div>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script>
  function navdown(){
    $("#navbar").stop();
    $("#navlogo").stop();
    $(".rotating").stop();
    $("#navbar").animate({height:'10vw'},200);
    $("#navlogo").animate({height:'10vw'},200);
    $(".rotating").animate({top:'-8%'},200);
  }
  function navup(){
    $("#navbar").stop();
    $("#navlogo").stop();
    $(".rotating").stop();
    $("#navbar").animate({height:'5vw'},200);
    $("#navlogo").animate({height:'5vw'},200);
    $(".rotating").animate({top:'-50%'},200);
  }
  </script>
</html>
