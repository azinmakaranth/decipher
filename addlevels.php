<?php 
	require_once("database.php");
	global $result;
	session_start();
if ((!isset($_SESSION["fbuid"]))||(($_SESSION["role"])!=10))
{$output = "<script>
        window.location='index.php';
        </script>";
	  echo $output; }


	if($_SESSION["role"] == 10)
	{
		$content = "<form name = \"addlevels\" action = \"processlevels.php\"><br>Level Name:<br><input type = \"text\" name = \"name\"/><br>Level Title:<br><input type = \"text\" name = \"title\"><br> Level Content:<br><textarea name = \"content\" rows = \"20\" cols = \"60\"></textarea><br>Cookie Content:<br><input type = \"text\" name = \"cookie\"><br>Javascript Content:<br><input type = \"text\" name = \"javascript\"><br>Answer:<br><input type = \"text\" name = \"answer\"><br><input type = \"submit\" value = \"submit\"></form>";
	}
	else
	  	Header("Location: index.php");
?>