<?php
session_start();
require_once("database.php");
global $result;
echo "<!DOCTYPE html>
<html>
<head>
	<meta charset=\"UTF-8\">
	<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
	<link rel=\"icon\" href=\"../images/icon.png\" type=\"image/png\" sizes=\"16x16\">
	<title>Decipher | 2018</title>
	<link rel=\"stylesheet\" href=\"css/style.css\" type=\"text/css\">
	<link rel=\"stylesheet\" type=\"text/css\" href=\"css/mobile.css\">
	<script src=\"js/mobile.js\" type=\"text/javascript\"></script>
</head>
<body>
	<div id=\"page\">
		<div id=\"header\">
			<div id=\"navigation\">
				<span id=\"mobile-navigation\">&nbsp;</span>

				<ul id=\"menu\">
					<li class=\"selected\">
						<a href=\"index.php\">Home</a>
					</li>
					<li>
						<a href=\"leader.php\">Leader Board</a>
					</li>
					<li>
						<a href=\"rules.php\">Rules</a>

					</li>
					<li>
						<a href=\"https://www.facebook.com/decipher.ritu\" target=\"_blank\">WATSON</a>
					</li>";
					if (isset($_SESSION["fbuid"]))
					echo "<li>
						<a href=\"logout.php\">logout</a>
					</li>";


				echo "</ul>
			</div>
		</div>
		<div id=\"body\" class=\"home\">
			<div class=\"header\">
				<div>";

require_once __DIR__ . '/src/Facebook/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '1557118407736277',
  'app_secret' => '4836676cd67dd92a700d45f5e20a6260',
  'default_graph_version' => 'v2.12',
  ]);

$helper = $fb->getRedirectLoginHelper();
try {
	if (isset($_SESSION['facebook_access_token'])) {
		$accessToken = $_SESSION['facebook_access_token'];
	} else {
  		$accessToken = $helper->getAccessToken();
	}
} catch(Facebook\Exceptions\FacebookResponseException $e) {
 	// When Graph returns an error
 	echo 'Graph returned an error: ' . $e->getMessage();

  	exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
 	// When validation fails or other local issues
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
  	exit;
 }

if (isset($accessToken)) {
	if (isset($_SESSION['facebook_access_token'])) {
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	} else {
		// getting short-lived access token
		$_SESSION['facebook_access_token'] = (string) $accessToken;

	  	// OAuth 2.0 client handler
		$oAuth2Client = $fb->getOAuth2Client();

		// Exchanges a short-lived access token for a long-lived one
		$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);

		$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;

		// setting default access token to be used in script
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}

	// redirect the user back to the same page if it has "code" GET variable
	if (isset($_GET['code'])) {

		header('Location: ./index.php');

	}

	// getting basic info about user
	try {
		$profile_request = $fb->get('/me?fields=name,first_name,last_name');
		$profile = $profile_request->getGraphNode()->asArray();
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
		echo 'Graph returned an error: ' . $e->getMessage();
		session_destroy();
		// redirecting user back to app login page
		header("Location: ./index.php");


		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		//echo 'Facebook SDK returned an error: ' . $e->getMessage();
		echo "<br> Some Error has occured. Please refresh the page. if you are unable too see the question, please contact the FB page";
		exit;
	}

	// printing $profile array on the screen which holds the basic info about user
	//print_r($profile);
	$id=$profile['id'];

	$name=$profile['name'];
	$sql = "SELECT * FROM users WHERE fbuid=".$id;

	$ref = $result->query($sql);
	$count=mysqli_num_rows($ref);
	$row=mysqli_fetch_assoc($ref);


	if ($count==0)
	{
		$sql= "INSERT INTO `users` (`fbuid`, `name`, `level`,`role`) VALUES (".$id.", '".$name."', '0', '1')";
		$ref = $result->query($sql);
		$_SESSION["role"]=1;
		$_SESSION["level"]=0;
		header("Location:register.php");
       // $output = "<script>
        //window.location='register.php';
        //</script>";
	  //echo $output;

	}

	$sql = "SELECT * FROM users WHERE fbuid=".$id;

	$ref = $result->query($sql);
	$row = mysqli_fetch_assoc($ref);
	$_SESSION["role"]=$row['role'];
	$_SESSION["level"]=$row['level'];
	$_SESSION["name"]=$row['name'];
    $_SESSION["fbuid"]=$id;
	if($_SESSION["role"] ==10 )
	{

        $output = "<script>
        window.location='sunny_leone.php';
        </script>";
	  echo $output;
	}

	else if($_SESSION["role"] >=0)
	{
		$id = $_SESSION["level"];

		if($id==18){
		 $output = "<script>
        window.location='winner.html';
        </script>";
	  echo $output;
		}
		$sql = "SELECT * FROM levels WHERE name = '" . mysqli_real_escape_string($result,$id) . "'" ;
		$ref = $result->query($sql);
		 $rowcount=mysqli_num_rows($ref);
		$row = mysqli_fetch_assoc($ref);
		$content = "<div id=\"ques\">
			<h2 id=\"head\">".$row["title"]."</h2>
			<br>".$row['contents']. "</div>";


		if(!($rowcount))
		{$content = "<p class=\"ack\">YOU REACHED ME BATMAN...<br>THATS UNBELIEVABLE..!<br>WAIT HERE TILL I COME WITH NEW RIDDLES</p>";
		}
		else
			$content =$content."<br><div id = \"answerbox\"><form action = \"answer.php\" name = \"answer\"><input id=\"ans\" type = \"text\" name = \"answer\"  autofocus autocomplete=\"off\"><br><input id=\"sub\" type = \"submit\" value = \"Check\"></form>";
print $content;
$sql= "SELECT count( * ) as rank
FROM `users`
WHERE level > (
SELECT level
FROM users
WHERE fbuid =".$_SESSION["fbuid"]." )
OR (
level = (
SELECT level
FROM users
WHERE fbuid =".$_SESSION["fbuid"]." )
AND passtime < (
SELECT passtime
FROM users
WHERE fbuid =".$_SESSION["fbuid"]." )
) AND role not in (-1,10)";
		$ref = $result->query($sql);
		$row = mysqli_fetch_assoc($ref);
		$rank=$row['rank'];
		$rank=$rank+1;
echo "<h2>Your rank  ".$rank."</h2>";

	}
	else if ($_SESSION["role"]<0)
	{
		$content = "<p class=\"ack\">You have been banned from playing.<br> Contact the FB page</p>";
		print $content;
	}


  	// Now you can redirect to another page and use the access token from $_SESSION['facebook_access_token']
} else {
	// if not logged in display
	//$loginUrl = $helper->getLoginUrl('http://unravel.ensemble16.ml/');
	$loginUrl = $helper->getLoginUrl('https://decipher.ritu18.com');
	echo "<div style=\"padding-top:5%;\"><h1>Did You Miss Me ?</h1>
					<span><a href=\"".$loginUrl ."\" class=\"email\">LOGIN WITH FACEBOOK</a></span></div>

					";

}
echo "</div>
			</div>

		</div>


	</div>
</body>
</html>
";
