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
      <a href="job.php" class="navbutton" style="left:55%;" ><b> Jobs</b>  </a>
      <a href="contact.php" class="navbutton"  style="left:57.5%;" >Contact Us  </a>
    </div>
    <div style="position:absolute;top:0vw;width:100%;overflow:hidden;height:20vw;z-index:-1;" >
      <img src="./manifesto/cover.png" width="100%" >
    </div>
    <div style="position:absolute;background-color:white;top:17vw;left:25vw;width:50%;" >
      <span style="position:relative;font-family:corexfont;font-size:2vw;color:#414345;margin-left:5vw;top:3vw;">This is Your Chance of Working With Us:</span>
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


        <div style="position:relative;top:8vw;font-family:chaprral;font-size:1.2vw;padding-left:4vw;padding-right:4vw;" >
          <span class="error">* required field.</span>
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            Name: <br><input type="text" name="name" value="<?php echo $name;?>">
            <span class="error">* <?php echo $nameErr;?></span>
            <br><br>
            Alias:<br> <input type="text" name="alias" value="<?php echo $alias;?>">
            <span class="error">* <?php echo $aliasErr;?></span>
            <br><br>
            E-mail:<br> <input type="text" name="email" value="<?php echo $email;?>">
            <span class="error">* <?php echo $emailErr;?></span>
            <br><br>
           	<input type="checkbox" name="check1" value="check1"> Front end developer <br><br>
           	<input type="checkbox" name="check2" value="check2"> Relation manager <br><br>
           	<input type="checkbox" name="check3" value="check3"> Quality assurance <br><br>
           	<input type="checkbox" name="check4" value="check4"> Placements <br><br>
           	<input type="checkbox" name="check5" value="check5"> Skills devlopment <br><br>

           Do you have your pic on google?<br>
           	<input type="radio" name="pic" value="yes"> yes<br><br>
          	<input type="radio" name="pic" value="no">no
            <br><br>
            Question 1<br><textarea name="question1" rows="5" cols="40" onkeydown="length()" maxlength="40" value="<?php echo $q1;?>" placeholder="Do you believe that your life flashes before your eyes before you die? Why?"></textarea>
             <br><br>
             Question 2<br><textarea name="question2" rows="5" cols="40" onkeydown="length()" maxlength="40" value="<?php echo $q2;?>" placeholder="Draw a monster, why is that a monster?"></textarea>
             <br><br>
             Question 3<br><textarea name="question3" rows="5" cols="40" onkeydown="length()" maxlength="40" value="<?php echo $q3;?>" placeholder="Do monster make wars, or war makes monsters? Why?"></textarea>
             <br><br>
             Question 4<br><textarea name="question4" rows="5" cols="40" onkeydown="length()" maxlength="40" value="<?php echo $q4;?>" placeholder="Whats the difference between philosophy and religion?"></textarea>
             <br><br>
             Link to your website/profile/resume <br>
             <input type="text" name="url"><br><br>
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

          					echo "<br><span style='font-size:2vw;' >your response is already recorded,only one response per email is allowed ";
          				}

          				else{

          					$sql = "INSERT INTO corexjob (date,name,alias,pic_google,fed,rm,qa,p,s,q1,q2,q3,q4,url,email)
          					VALUES (CURDATE(),'$name','$alias',$pic,$c1,$c2,$c3,$c4,$c5,$qu1,$qu2,$qu3,$qu4,'$url','$email')";

          					if ($conn->query($sql) === TRUE) {
          						echo "<h1>Your response is added, we will contact you shortly</h1>";						//put a modal here, instead of a simple comment
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




</div>


    </div>
  <img src="./manifesto/areyouready.png" style="width:100%;position:absolute;bottom:-65vw;" >
  <div style="font-family:chaprral;position:absolute;top:117vw;background-color:#14151a;width:100%;height:10vw;" >
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
