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
	//echo "$Syn...$Table...$ColA...$ColQ...$Value"."\n";
	switch ($Syn)
{
	case "1":
		$result = $connetion-> query("SELECT $ColA FROM  $Table;");
		//var_dump ($result);
		return($result);
		break;
	case "2":
		$result = $connetion->query("SELECT $ColA FROM $Table WHERE $ColQ LIKE '$Value';");
		//echo "2";
		return($result);
		break;
	default:
		break;
		return("error");
}	
}