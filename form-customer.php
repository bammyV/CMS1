<?php
header('Content-Type: text/html; charset=utf-8');
require_once 'functions.php';
?>


<?php 


$conn=MysqlConnect();

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
   $Name = $conn->real_escape_string($_POST["name"]);
   $Family= $conn->real_escape_string($_POST["family"]);
   $Tell = $conn->real_escape_string($_POST["tellphone"]);
   $type_name = $_POST["type"];
 
 //retrive from DB
 $ProjID=0;
 //$test=MysqlSelect('1',$conn,'user_type','*','0','0');
 //var_dump($test);
 //$CType_Q0=$conn->fetch_array(MysqlSelect ('show',$conn,'*','type_id',0,0));
 //$CType_Q=$conn->query(MysqlSelect ('2',$conn,'user_type','type_id','type_name',$type_name));
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
    <input name="type" type="text">
    نوع مشتری
    <br><br>
    <div style='text-align:right'> 
    نوع مشتری‌های موجود
    </div>
   <div style='text-align:left'> 
    <?php 
$conn=MysqlConnect();

$result=$conn->query("SELECT * FROM user_type;");
while($row=$result->fetch_array())
{
echo "\n"."<tr>";
		echo "<td>". $row['type_name']. "</td>";
echo "</tr>"."<br />";
}
?>

</div>
    <br><br>
  <input type="submit" value="Submit Form">
</form>
</div>
</body>
</html>
