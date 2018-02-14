<?php
session_start();
if (!isset($_SESSION["fbuid"]))
{$output = "<script>
        window.location='index.php';
        </script>";
	  echo $output; }
?>
<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Decipher|2018</title>
	<link rel="icon" href="../images/icon.png" type="image/png" sizes="16x16">
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/mobile.css">
	<script src="js/mobile.js" type="text/javascript"></script>


	<style>
		img.ack {
		width:500px;
		height:300px;

		}
		.ack {
		color:green;
		text-align:center;
			}
		p.ack a {
		color:blue;
		}
	</style>


</head>
<body>
	<div id="page">
		<div id="header">
			<div id="navigation">
				<span id="mobile-navigation">&nbsp;</span>

				<ul id="menu">
					<li class="selected">
						<a href="index.php">HOME</a>
					</li>
					<li>
						<a href="leader.php">LEADER BOARD</a>
					</li>
					<li>
						<a href="rules.php">RULES</a>

					</li>
					<li>
					<a href="https://www.facebook.com/decipher.ritu" target="_blank">ALFRED</a>

					</li>
					<?php

			             	session_start();
					if (isset($_SESSION["fbuid"]))
					echo "<li>
						<a href=\"logout.php\">logout</a>
					</li>";
					?>

				</ul>
			</div>
		</div>
		<div id="body" class="home">
			<div class="header">
				<div>

					<!--php code goes here-->
<?php
	require_once("database.php");
	global $result;
	$level = $_SESSION["level"];
	$answer = $_GET["answer"];

	$name=$_SESSION["name"];
	$sql = "INSERT INTO logs (user,val,level) VALUES ('" .$name. "','" . mysqli_real_escape_string($result,$answer) . "','". $level . "')";

	$ref = $result->query($sql);

	$sql = "SELECT * FROM levels WHERE name = '" . mysqli_real_escape_string($result,$level) . "'" ;
  $answer = preg_replace('/\s+/', '', $answer);
  $answer = str_replace(' ', '', $answer);
	$ref = $result->query($sql);
	$row = mysqli_fetch_assoc($ref);
	$answer=strtolower($answer);
	$ans = $row['answer'];
	$ans=strtolower($ans);
	if(!($ans))
	{
		$content .= "<p class=\"ack\">WAIT FOR MY QUESTION SHERLOCK</p>";
	}


	else if($answer == $row['answer'])
	{
		$level++;
		$_SESSION["level"] = $level;
		if ($level==25)
		  $content = "<img src=\"imgs/levels/winmob.jpg\"><p class=\"ack\">winner<br>";
		else
		$content = "<img src=\"imgs/correct/cr".rand(1,7).".jpg\"><p class=\"ack\">RIGHT ANSWER<br> <a href = \"index.php\">Next Level</a></p>";
		$sql = "UPDATE users SET level = '" . $level . "' WHERE fbuid = '" . $_SESSION["fbuid"] ."'";
		$ref = $result->query($sql);


	}
	else
		{

		$content = "<img class=\"ack\" src=\"imgs/wrong/wr".rand(1,6).".jpg\"><p class=\"ack\">Wrong answer<br> <a href = \"index.php\">TRY AGAIN</a></p>";


		}
	print $content;

?>
	<!--php code goes here-->
				</div>
			</div>

		</div>


	</div>
</body>
</html>
