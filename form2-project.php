<?php
header('Content-Type: text/html; charset=utf-8');
$servername = "localhost";
$sql_username = "root";
$sql_password = "1";
$dbname="PhpSite1";
$hash_cost=5;

// Create connection
$conn = new mysqli($servername, $sql_username, $sql_password,$dbname);

// Check connection
//echo '<pre>',print_r($conn),'</pre>';
if ($conn->connect_errno)
{
    die("Connection failed: " .  $conn->connect_error. "(".$conn->connect_errno.")");
}
?>
<?php
$RegisterNum=$Owner=$Karfarma=$Consultant=$Sabt=$Sohbat=$SahebFile=$ProjectCol=$PishFact=$PreCong=$RegTime= '';


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
   $RegisterNum =$conn->real_escape_string($_POST["register"]);
   $Owner=$conn->real_escape_string($_POST["owner"]);
   $Karfarma=$conn->real_escape_string($_POST["karfarma"]);
   $Consultant=$conn->real_escape_string($_POST["consultant"]);
   $Sabt=$conn->real_escape_string($_POST["sabt"]);
   $Sohbat=$conn->real_escape_string($_POST["sohbat"]);
   $SahebFile=$conn->real_escape_string($_POST["sahebFile"]);
   $ProjectCol=$conn->real_escape_string($_POST["projectcol"]);
   $PishFact=$conn->real_escape_string($_POST["pishfact"]);
   $RegTime= date("Ymd");


   $sql1="INSERT INTO Project (register_number,owner,karfarm_id,consultant_id,sabt_no,sohbat_id,SahebFile_id,Projectcol,pish_factor,pre_congra,register_time) VALUES ('$Username','$Passw','$Email','$Address','$Name','$Family','$Phone','$Idcard','$UType','$Shenasname','$State','$EnDate','$Grade','$salt')";
     //$insert=mysql_query($query);
   if ($conn->query($sql1)=== TRUE){
     echo "Success! Row ID: {$conn->insert_id}";
   } else {
   echo "Error: " . $sql1 . "<br>" . $conn->error;
    die("Error: {$conn->errno} : {$conn->error}");
   }

   }

 ?>
