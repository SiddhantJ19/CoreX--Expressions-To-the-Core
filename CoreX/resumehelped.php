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
	<br><br><span style="color:#12151a">....</span><h3>search by name : </h3><input type="text" name="search" sixe=35><br><br>

<?php
$servername = "localhost";
$username = "root";
$password = "royya123";
$dbname = "main";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if($_POST['search']!=""){
	$na=test_input($_POST['search']);
	$sql = "SELECT date,name,alias,pic_google,fed,rm,qa,p,s,q1,q2,q3,q4,url,email FROM resumehelped where name='$na' order by date;";
}
else{

$sql = "SELECT date,name,alias,pic_google,fed,rm,qa,p,s,q1,q2,q3,q4,url,email FROM resumehelped order by date;";
}





$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<center><table style=\"width:100%;text-align:left;\"><tr><th>date</th><th>name</th><th>email</th><th>alias</th><th>pic google</th><th>A</th><th>B</th><th>C</th><th>D</th><th>E</th><th>q1</th><th>q2</th><th>q3</th><th>q4</th><th>url</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$x=$row["email"];
        echo "<tr><td>".$row["date"]."</td><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["alias"]."</td><td>".$row["pic_google"]."</td><td>".$row["fed"]."</td><td>".$row["rm"]."</td><td>".$row["qa"]."</td><td>".$row["p"]."</td><td>".$row["s"]."</td><td>".$row["q1"]."</td><td>".$row["q2"]."</td><td>".$row["q3"]."</td><td>".$row["q4"]."</td><td>".$row["url"]."</td></tr>"."<br>";

    }
    echo "</table></center>";
} else {
    echo "0 results";
}



$conn->close();
?>


</form>
