<?php
require_once("database.php");
$sql="INSERT INTO accesslogs(id,ip,user) VALUES(10934,'testip','amUser')";
$ref = $result->query($sql) or die('error');
$sql1="select* from  accesslogs";
$ref1 = $result->query($sql1);
$count=mysqli_num_rows($ref1);
$row=mysqli_fetch_assoc($ref1);

echo  $row["user"] ;

?>
