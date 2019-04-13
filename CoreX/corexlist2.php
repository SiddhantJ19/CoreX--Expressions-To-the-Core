



<html>
<head>
	<style>
		table,td,th{border:1px solid white;border-collapse:collapse;
		padding:12px;}
		body{background-color:#12151a;
		opacity:1;
		color:#ffffff;}
		input[type=text] {
			width: 40%;
			padding: 12px 12px;
			margin: 0px 0;
			box-sizing: border-box;
			border-radius:10px;
			background-color:white;
			border:none;
			outline:none;
}
.button {
    background-color: #ffffff; /* Green */
    border: none;
    color: black;
    border-radius:10px;
    padding: 10px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}
h3{
	display:inline;
}
	</style>



</head>
<body>
<form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
	<br><span style="color:#12151a">....</span><h3>search by name :</h3> <input type="text" name="search"><br><br>

<?php
$servername = "localhost";
$username = "root";
$password = "royya123";
$dbname = "main";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

/*/if($_POST['search']!=""){
$sql = "SELECT date,Name,Email,number,comment FROM register where Email not in (select Email from helped) order by date;";

//else{
//$nam=$_POST['search'];
//$sql = "SELECT date,Name,Email,number,comment FROM register where Name='$nam' and Email not in (select Email from helped);";

//}*/
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if($_POST['search']!=""){
	$nam=test_input($_POST['search']);
	$sql = "SELECT date,Name,Email,number,comment FROM register where Name='$nam' and Email not in (select Email from helped);";
}
else{
	$sql = "SELECT date,Name,Email,number,comment FROM register where Email not in (select Email from helped) order by date;";
}



$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<center><table style=\"width:100%;text-align:left;\"><tr><th><b>Date</b></th><th>Name</th><th>Email</th><th>Number</th><th>Comment</th><th>Helped (one at a time)</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$x=$row["Email"];
        echo "<tr><td>".$row["date"]."</td><td>".$row["Name"]."</td><td>".$row["Email"]."</td><td>".$row["number"]."</td><td>".$row["comment"]."<th><input type=\"radio\" name='sd' value='$x'>checked</th></tr>"."<br>";

    }
    echo "</table></center>";
} else {
    echo "<h4>0 results </h4>";
}



$conn->close();
?>

<center><br><button type="submit" class="button">submit</button><span style="color:#12151a">..........</span><button type="reset" class="button">reset</button></center>
</form>
<?php
$servername = "localhost";
$username = "root";
$password = "royya123";
$dbname = "main";

$conn = new mysqli($servername, $username, $password, $dbname);
if($_POST['search']!=""){
	$nam=test_input($_POST['search']);
	$sql = "SELECT date,Name,Email,number,comment FROM register where Name='$nam' and Email not in (select Email from helped);";
}
else{
	$sql = "SELECT date,Name,Email,number,comment FROM register where Email not in (select Email from helped) order by date;";
}
//$sql = "SELECT date,Name,Email,number,comment FROM register where Email not in (select Email from helped) order by date;";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
   if ($_SERVER["REQUEST_METHOD"] == "POST") {

		while($row = $result->fetch_assoc()) {
			$v=$row["Email"];

		  	if (($_POST['sd'])==$v){

			  	//echo $v;
			  	$sql1="select * from register where Email=\"".$v."\";";
				$result1=$conn->query($sql1);
				$row = $result1->fetch_assoc();
				//echo $row['date'];
				$final="insert into helped (date, Name,Email,number,comment) values ('".$row['date']."','".$row['Name']."','".$row['Email']."',".$row['number'].",'".$row['comment']."');";

				if($conn->query($final)){
					echo $row['Email']." added to helped<script>window.location.reload();</script>";
				}
				else{
					echo "could not add ".$row['Email']." to helped";
				}






		  	}

		}

    }

}

else {
    echo "0 results";
}


$conn->close();
?>




</body>

</html>
