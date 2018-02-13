<style>
p#ack {
	color:green;
	text-align:center;
}
</style>
<?php 
	session_start();
if ((!isset($_SESSION["fbuid"]))||(($_SESSION["role"])!=10))
{$output = "<script>
        window.location='index.php';
        </script>";
        echo "hai";
	  echo $output; }
	require_once("database.php");
	global $result;
	require_once("adtheme.php");
	
	
	if($_SESSION["role"] == 10)
	{
		$id = $_GET['id'];
		$role = $_GET['role'];
		$level = $_GET['level'];
	
		$sql = "UPDATE users SET role = '" . $role . "', level = '" . $level . "' WHERE fbuid = '" . $id ."'";
		$ref = $result->query($sql);
		$content = "<p id=\"ack\">User updated<p>";
		print $content;
		header("location:index.php");
	}
	else
	 header("location:index.php");
	
?>