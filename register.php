<?php
	session_start();
if (!isset($_SESSION["fbuid"]))
{$output = "<script>
        window.location='index.php';
        </script>";
	  echo $output; }
?>

<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Decipher | REGISTER</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/mobile.css">
	<script src="js/mobile.js" type="text/javascript"></script>
  <style>



#log {
	text-align:center;
}
#log p {
	color:brown;
	font-size:1.5em;
}
input {
padding-top:20px;
	padding:10px;
	border:px solid #1E262D;
	width:300px;
}
.input:focus {
	border:3px solid yellow;

}
#sub {
	        padding:10px;

	        color: white;
	        font-size:1em;
            border-radius: 4px;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
			background: rgb(28, 184, 65);
			cursor:pointer;
}

  </style>
  </head>

  <body>
  <div id="page">
		<div id="header">
			<div id="navigation">
				<span id="mobile-navigation">&nbsp;</span>


</div>
</div>
</br></br>
	<div id="log"><form id="reg" name = "register" action ="registeraction.php" method="post">
	<p>College</p><input class="input"  type = "text" name = "college" placeholder="Give short names"required><br><p>Phone Number</p>
	<input class="input"  type = "text" name = "phone" required><br>
	<input id="sub"  type = "submit" value = "submit" required></form><br><br>
	</div>
</body>
</html>
