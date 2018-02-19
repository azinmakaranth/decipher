<?php
session_start();
require_once("database.php");
global $result;
$set_session = false;
echo "<!DOCTYPE html>
<html>
<head>
	<meta charset=\"UTF-8\">
	<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
	<link rel=\"icon\" href=\"../images/dec.png\" type=\"image/png\" sizes=\"16x16\">
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
					{ echo "<li>
						<a href=\"logout.php\">logout</a>
					</li>";
            $set_session = true;
			  	}

				echo "</ul>
			</div>
		</div>
		<div id=\"body\" class=\"home\">
			<div class=\"header\">
				<div>";
/*
require_once __DIR__ . '/src/Facebook/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '527667570960032',
  'app_secret' => '802bab5fecb18e9e789756e9b9e1d409',
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
*/
	// printing $profile array on the screen which holds the basic info about user
	//print_r($profile);


		$sql = "SELECT * FROM levels WHERE name = '0'" ;
		$ref = $result->query($sql);
		 $rowcount=mysqli_num_rows($ref);
		$row = mysqli_fetch_assoc($ref);
		$content = "<div id=\"ques\">
			<h2 id=\"head\">".$row["title"]."</h2>
			<br>".$row['contents']. "</div>";


		if(!($rowcount))
		{//$content = "<img src=\"images/jim.jpg\"/ class = \"coming\" style=""><p class=\"ack\">Ah! You're a bit early Sherlock<br>That's.... unusual<br>Anyway wait here honey, I am not finished with you</p>";
		 $content = "<p class=\"ack\">HaHaHaHa.... you're early Sherlock<br>I was just testing you<br>The game starts tonight</p>";
		}
		else
			$content =$content."<br><div id = \"answerbox\"><form action = \"answer.php\" name = \"answer\"><input id=\"ans\" type = \"text\" name = \"answer\"  autofocus autocomplete=\"off\"><br><input id=\"sub\" type = \"submit\" value = \"Check\"></form>";
print $content;


echo
	"</div>
				</div>

			</div>

		</div>
	</body>
	</html>
	";
