<?php
header('Content-Type: text/html; charset=utf-8');
$servername = "localhost";
$sql_username = "root";
$sql_password = "1";
$dbname="PhpSite1";
$conn = new mysqli($servername, $sql_username, $sql_password,$dbname);

if ($conn->connect_errno)
{
    die("Connection failed: " .  $conn->connect_error. "(".$conn->connect_errno.")");
}
?>
<?php if ($_SERVER["REQUEST_METHOD"] == "POST")
{
   $Name = $conn->real_escape_string($_POST["name"]);
   $Family= $conn->real_escape_string($_POST["family"]);
   $Tell = $conn->real_escape_string($_POST["tellphone"]);
   $type_name = $_POST["type"];
 

 //retrive from DB
 $ProjID=0;
 $CType_Q = $conn->query("SELECT `type_id` FROM `user_type` WHERE `type_name` like '$type_name';"); 
 
  while ($row = $CType_Q->fetch_assoc()) {
       $CType = $row['type_id'];
    }
 echo $ProjID."...".$Name."...".$Family."...".$CType."...".$Tell;            
$sql1="INSERT INTO customers (project_id, name, family, customer_type, Tel_no) VALUES ('$ProjID','$Name','$Family','$CType','$Tell');";

if ($conn->query($sql1)=== TRUE){
  echo "Success! Row ID: {$conn->insert_id}";
} else {
echo "Error: " . $sql1 . "<br>" . $conn->error;
 die("Error: {$conn->errno} : {$conn->error}");
}
}
?>
<div style="float:right;">
  <h1> فرم ورود مشتری</h1>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <input name="name" type="text">
  نام
  <br><br>
    <input name="family" type="text">نام خانوادگی
    <br><br>
    <input name="tellphone" type="tel">تلفن
    <br><br>
    <input name="type" type="text">نوع مشتری
    <br><br>
  <input type="submit" value="Submit Form">
</form>
</div>
</body>
</html>
