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
	$sql = "SELECT date,Name,Email,number,comment FROM helped where Name='$nam';";
}
else{
	$sql = "SELECT date,Name,Email,number,comment FROM helped order by date;";
}



$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<center><table style=\"width:100%;text-align:left;\"><tr><th><b>Date</b></th><th>Name</th><th>Email</th><th>Number</th><th>Comment</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$x=$row["Email"];
        echo "<tr><td>".$row["date"]."</td><td>".$row["Name"]."</td><td>".$row["Email"]."</td><td>".$row["number"]."</td><td>".$row["comment"]."</tr>"."<br>";

    }
    echo "</table></center>";
} else {
    echo "<h4>0 results </h4>";
}



$conn->close();
?>

</form>
