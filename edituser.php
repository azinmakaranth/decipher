<style>
.details {
	width;100%;
	text-align:center;
	color:red;
}
</style>
<?php 
    session_start();
if ((!isset($_SESSION["fbuid"]))||(($_SESSION["role"])!=10))
{$output = "<script>
        window.location='index.php';
        </script>";
	  echo $output; }
	if($_SESSION["role"] == 10)
	{	require_once("database.php");
	global $result;
	    require_once("adtheme.php");  
		$user = $_GET['id'];
		$sql = "SELECT * FROM users WHERE fbuid = '" . $user . "'";
		$ref = $result->query($sql);
		$row = mysqli_fetch_assoc($ref);
		$content = "<div class=\"details\"><h1 class=\"header\"> User Details</h1>ID : " . $row['fbuid'] . "<br>Name : " . $row['name'] . "<br>College : " . $row['college'] . "<br>Mob NO : " . $row['mob'] . "<br>Email : " . $row['email'] . "<br><form action=\"updateuser.php\"><input type = \"hidden\" name = \"id\" value = \"" . $row['fbuid'] . "\"><br> Level : <input type = \"text\" name = \"level\" value = \"" . $row['level'] . "\">";
		$content = $content . "<br>Role:<input type = \"text\" name = \"role\" value = \"" . $row['role'] . "\">";
		$content = $content . "<br><input type = \"submit\" value=\"update\"></form></div>";
		print $content;
		$name = $row['name'];
		$sql = "SELECT * FROM logs WHERE user = '" . $name . "'ORDER BY time DESC";
		$ref = $result->query($sql);
		$content = "<br><br><div class=\"details\"><h1 class=\"header\"> User Answer Logs</h1>";		
		while($row = mysqli_fetch_assoc($ref))
		{
			
			 $content = $content . "" . $row["user"] . ":" ."  ". $row["val"]."  ".$row["level"]."<br>";
		}
			print $content;
			$sql = "SELECT * FROM accesslogs WHERE user = '" . $name . "' ORDER BY time DESC";
			$ref = $result->query($sql);
			$content = "<br><br><h1 class=\"header\"> User Login Logs</h1>";
			while($row = mysqli_fetch_assoc($ref))
			{
				$content = $content . "From" . $row['ip']." " .$row["time"]."<br>";
			}
			$content.="</div>";
			print $content;
		
	}
	else
		header("location:index.php");
?>