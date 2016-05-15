<?php
function MysqlConnect ()

{
	$servername = "localhost";
	$sql_username = "root";
	$sql_password = "1";
	$dbname="PhpSite1";
	$conn = new mysqli($servername, $sql_username, $sql_password,$dbname);

	if ($conn->connect_errno)
	{
		die("Connection failed: " .  $conn->connect_error. "(".$conn->connect_errno.")");
	}
	return $conn;
}

function MysqlSelect ($Syn,$connetion,$Table,$ColA,$ColQ,$Value){	
	echo "$Syn...$Table...$ColA...$ColQ...$Value"."\n";
	switch ($Syn)
{
	case "1":
		$result = $connetion->query("select $ColA from $Table;");
		echo $connetion->connect_error;
		break;
	case "2":
		$result = $connetion->query("select `$ColA` from `$Table` where `$ColQ` like `$Value`;");
		//echo "2";
		break;
		return($result);
		echo $connetion->connect_error;
	default:
		break;
		return("error");
}	
}