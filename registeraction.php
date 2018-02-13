<html>
<head>
<title>Register</title>
<style>

p.act {
	text-align:center;
	color:#32b92d;
}
p.act a {
	text-align:center;
	color:green;
}
</style>
</head>
<body>
<?php
session_start();
function mysqli_result($res,$row=0,$col=0){
    $numrows = mysqli_num_rows($res);
    if ($numrows && $row <= ($numrows-1) && $row >=0){
        mysqli_data_seek($res,$row);
        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col])){
            return $resrow[$col];
        }
    }
    return false;
}
	require_once("database.php");
	global $result;
	$flag=0;
	foreach($_POST as $f1)
	{
		if($f1==NULL)
			$flag = 1;
	}
	if($flag == 1)
	{

echo "error in data";
		//header("location:register.php");

	}
	else
	{

		$phone = filter_var($_POST["phone"],519);

		$college = filter_var($_POST["college"],513);
		$content="";
		if(!$phone)
		{
			$content = "<p class=\"act\">Enter a valid phone number<br>Return to <a href = \"register.php\">Registration Form</a></p>";
		}
		else if(!$college)
		{
			$content = "<p class=\"act\">Enter a valid college<br>Return to <a href = \"register.php\">Registration Form</a></p>";
		}
		else
		{
			$id=$_SESSION["fbuid"];
			$college=mysqli_real_escape_string($result,$college);
			$phone=mysqli_real_escape_string($result,$phone);
			$sql="UPDATE `users` SET `mob`=".$phone.",`college`='".$college."' WHERE `fbuid`=".$id;
			$ref = $result->query($sql);

        $output = "<script>
        window.location='index.php';
        </script>";
	  echo $output;


		}
	}
	print $content;

?>
</body>
</html>
