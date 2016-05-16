<?php
header('Content-Type: text/html; charset=utf-8');
require_once 'functions.php';

// Create connection
$conn=MysqlConnect();

?>
<?php
$RegisterNum=$Owner=$Karfarma=$Consultant=$Sabt=$Sohbat=$SahebFile=$ProjectCol=$PishFact=$PreCong=$RegTime= '';


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
   $RegisterNum =$conn->real_escape_string($_POST["register"]);
   $Owner_N=$conn->real_escape_string($_POST["ownerName"]);
   $Owner_F=$conn->real_escape_string($_POST["ownerFamily"]);
   $Karfarma_N=$conn->real_escape_string($_POST["karfarmaName"]);
   $Karfarma_F=$conn->real_escape_string($_POST["karfarmaFamily"]);
   $Consultant_N=$conn->real_escape_string($_POST["consultantName"]);
   $Consultant_F=$conn->real_escape_string($_POST["consultantFamily"]);
   $Sabt=$conn->real_escape_string($_POST["sabt"]);
   $Sohbat=$conn->real_escape_string($_POST["sohbat"]);
   $SahebFile_N=$conn->real_escape_string($_POST["sahebFileName"]);
   $SahebFile_F=$conn->real_escape_string($_POST["sahebFileFamily"]);
   $ProjectCol=$conn->real_escape_string($_POST["projectcol"]);
   $PishFact=$conn->real_escape_string($_POST["pishfact"]);
   $RegTime= date("Ymd");
   
   
   $OwnerQ =$conn->query("SELECT `customer_id` FROM `customers` WHERE name like '$Owner_N'  AND family like '$Owner_F';");
//   echo $Owner_N,$Owner_F;
//   var_dump($OwnerQ);
    while ($row = $OwnerQ->fetch_assoc()) {
       $OwnerID = $row['customer_id'];
    }
   
    $ConsultantQ = $conn->query("SELECT `customer_id` FROM `customers` WHERE name like '$Consultant_N'  AND family like '$Consultant_F';");
    while ($row = $ConsultantQ->fetch_assoc()) {
       $ConsultantID = $row['customer_id'];
    }
    $KarfamaQ = $conn->query("SELECT `customer_id` FROM `customers` WHERE name like '$Karfarma_N'  AND family like '$Karfarma_F';");
    while ($row = $KarfamaQ->fetch_assoc()) {
       $KarfarmaID = $row['customer_id'];
    } 
    
    $SahebFileQ = $conn->query("SELECT `customer_id` FROM `customers` WHERE name like '$SahebFile_N'  AND family like '$SahebFile_F';");
    while ($row = $SahebFileQ->fetch_assoc()) {
       $SahebFileID = $row['customer_id'];
    }
    echo $RegisterNum."...".$OwnerID."...".$KarfarmaID."...".$ConsultantID."...".$Sabt."...".$Sohbat."...".$SahebFile."...".$ProjectCol."...".$PishFact."...".$PreCong."...".$RegTime;

   $sql1="INSERT INTO Project (register_number,owner,karfarm_id,consultant_id,sabt_no,sohbat_id,SahebFile_id,Projectcol,pish_factor,pre_congra,register_time) VALUES ('$RegisterNum','$OwnerID','$KarfarmaID','$ConsultantID','$Sabt','$Sohbat','$SahebFileID','$ProjectCol','$PishFact','$PreCong','$RegTime')";
     //$insert=mysql_query($query);
   
   if ($conn->query($sql1)=== TRUE){
     echo "Success! Row ID: {$conn->insert_id}";
   } else {
   echo "Error: " . $sql1 . "<br>" . $conn->error;
    die("Error: {$conn->errno} : {$conn->error}");
   }
   
   }
 ?>
<div style="float:right;">
  <h1> فرم پروژه</h1>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <input name="register" type="text">
  شماره ثبت
  <br><br>
    <input name="ownerName" type="text">
    نام صاحب فایل
    <input name="ownerFamily" type="text">
    نام خانوادگی صاحب فایل
    <br><br>
    <input name="karfarmaName" type="text">نام کارفرما
    <input name="karfarmaFamily" type="text">نام خانوادگی کارفرما
    <br><br>
    <input name="consultantName" type="text">نام مشاور
    <input name="consultantFamily" type="text">نام خانوادگی مشاور
    <br><br>
    <input name="sabt" type="text">شماره ثبت
    <br><br>
    <input name="sohbat" type="text">شماره صحبت
    <br><br>
    <input name="sahebFileName" type="text">نام صاحب فایل
    <input name="sahebFileFamily" type="text">نام خانوادگی صاحب فایل
    <br><br>
    <input name="pishfact" type="number">پیش فاکتور دارد؟
    <br><br>
    <input name="projectcol" type="number">صحبت شده از قبل؟
    <br><br>
  <input type="submit" value="Submit Form">
</form>
</div>
</body>
</html>