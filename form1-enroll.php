<!DOCTYPE HTML>
<html>
<head>
  <title>
    UsersData
  </title>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>
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
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  $name =$Family = $email = $phone = $gender = $Addres = $website = $Username = $PassW = $Idcard = $Shenasname = $UType =$State = $EnDate = $Grade ="";
  $UsernameErr = '';
  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
$Name =$conn->real_escape_string($_POST["name"]);
$Family= $conn->real_escape_string($_POST["Family"]);
$Email = $conn->real_escape_string($_POST["email"]);
$Phone=$conn->real_escape_string($_POST["phone"]);
$Address=$conn->real_escape_string($_POST["Address"]);
//mysql_real_escape_string($_POST["addres"]);
//$website=$_POST["website"]);
$Username = $conn->real_escape_string($_POST["UserName"]);
//echo $Username;
$result0 = $conn->query("select * from User where username like '$Username';");
if ( ($result0 -> num_rows)> 0)
  {
    echo "username ".$Username ." alredy exist";
    die();
  }

$UPassw=$conn->real_escape_string($_POST["PassWord"]);
$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
$Passw =crypt($UPassw, sprintf('$2a$%02d$', $hash_cost).$salt);
$Idcard=$conn->real_escape_string($_POST["Idcard"]);
$result0 = $conn->query("select * from User where Idcard_number like '$Idcard';");
if ( ($result0 -> num_rows)> 0)
  {
    echo "شماره ملی ".$Idcard ." تکراری است".'<br />';
    die();
  }
$Shenasname=$conn->real_escape_string($_POST["Shenasname"]);
$result0 = $conn->query("select * from User where shenasname_no like '$Shenasname';");
if ( ($result0 -> num_rows)> 0)
  {
    echo "شماره شناسنامه ".$Shenasname ." تکراری است".'<br />';
    die();
  }
$UType=$conn->real_escape_string($_POST["UType"]);
$State=$conn->real_escape_string($_POST["State"]);
//$EnDate=$_POST["EnDate"]);
$Grade=$conn->real_escape_string($_POST["Grade"]);
$EnDate= date("Ymd");
echo "<h2>Your Input:</h2>";
echo $Name;
echo "<br>";
echo $Email;
echo "<br>";
echo $Family;
echo "<br>";
echo $Address;
echo "<br>";
echo $Username;
echo "<br>";
echo $Passw;
echo "<br>";
echo $Idcard;
echo "<br>";
echo $Shenasname;
echo "<br>";
echo $UType;
echo "<br>";
echo $State;
echo "<br>";
echo $Grade;
echo "<br>";
echo $EnDate;
echo "<br>";

var_dump($_POST);

$sql1="INSERT INTO User (Username,pass,email,Adress,Name,Family,phone,Idcard_number,user_type,shenasname_no,state,enroll_date,grade,salt) VALUES ('$Username','$Passw','$Email','$Address','$Name','$Family','$Phone','$Idcard','$UType','$Shenasname','$State','$EnDate','$Grade','$salt')";
  //$insert=mysql_query($query);
if ($conn->query($sql1)=== TRUE){
  echo "Success! Row ID: {$conn->insert_id}";
} else {
echo "Error: " . $sql1 . "<br>" . $conn->error;
 die("Error: {$conn->errno} : {$conn->error}");
}
$conn->close();
}
unset($_POST);
?>
<div style="float:right;">
  <h1> ورود داده </h1>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <input name="name" type="text">
  نام
  <br><br>
  <input name="email" type="email">
  ایمیل
  <br><br>
    <input name="Family" type="text">نام خانوادگی
    <br><br>
    <input name="phone" type="tel">تلفن
    <br><br>
    <input name="Address" rows="5" cols="40">آدرس
    <br><br>
    <input type="text" name="UserName" value="<?php echo $Username;?>">نام کاربری
    <span class="error"><?php echo $UsernameErr;?></span>
    <br><br>
    <input name="PassWord" type="psw">پسورد
    <br><br>
    <input name="Idcard" type="text">شماره ملی
    <br><br>
    <input name="Shenasname" type="text">شماره شناسنامه
    <br><br>
    <input name="UType" type="text">نوع کاربر
    <br><br>
    <input name="State" type="text">محل سکونت
    <br><br>
    <input name="Grade" type="number">grade
    <br><br>
  <input type="submit" value="Submit Form">
</form>
</div>
</body>
</html>
