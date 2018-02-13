<style>
p.ack {
	color:green;
	text-align:center;
}
</style>
<?php
function mysqli_result($res,$row=0,$col=0){ 
    $numrows = mysqli_num_rows($res); 
    if ($numrows && $row <= ($numrows-1) && $row >=0){
        mysqli_data_seek($res,$row);
        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col])){
            return $resrow[$col];
        }
    } }
	require_once("database.php");
	global $result;
	require_once("adtheme.php");
	$name = $_GET["name"];
	$title = $_GET["title"];
	$content = $_GET["content"];
	$answer = $_GET["answer"];
	$name = mysqli_real_escape_string($result, $name);
	$title = mysqli_real_escape_string($result, $title);
	
	$answer = mysqli_real_escape_string($result, $answer);
	session_start();
	if($_SESSION["role"] == 10)
	{
	$sql = "SELECT COUNT(*) FROM levels WHERE name = '" . $_GET['name'] . "'";
	$ref = $result->query($sql);
	
	$result1 = mysqli_result($ref,0);
	
	if($result1 != 0)
	{
		$sql = "UPDATE levels SET title = '" .$title. "', contents = '" . $content . "', answer = '" . $answer . "' WHERE name = '" .$name . "'";
		$ref = mysqli_query($result,$sql);
		$content = "<p class=\"ack\">level"." ".$name." "."Updated</p>";
	
	}
	else	
	{
		$sql = "INSERT INTO levels(name, title, contents, answer, stat) VALUES ('" .$name . "','" .$title . "','" . $content . "','" .$answer . "','0')";

		$ref = $result->query($sql);
		if(!$ref)
		{
			echo "Failed to update";
		}

		$content = "<p class=\"ack\">The level"." ".$name." "." was added successfully</p>";
	}
print $content;
	}
	else
	{
	}
	
?>