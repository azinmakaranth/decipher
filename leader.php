<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Leaderboard</title>
	<link rel="icon" href="../images/dec.png" type="image/png" sizes="16x16">
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/mobile.css">
	<script src="js/mobile.js" type="text/javascript"></script>
</head>
<body>
	<div id="page">
		<div id="header">
			<div id="navigation">
				<span id="mobile-navigation">&nbsp;</span>

				<ul id="menu">
					<li class="selected">
						<a href="index.php">Home</a>
					</li>
					<li>
						<a href="leader.php">Leader Board</a>
					</li>
					<li>
						<a href="rules.php">RULES</a>

					</li>
					<li>
						<a href="https://www.facebook.com/decipher.ritu" target="_blank">WATSON</a>	
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
		<div id="body">

				 <div class="container tablestyle">

          <h1 id="rank" align="center" style="color:red"> brains</h1>

		<h4>
            <table width="100%"   >
            <tr align="justify"  height="40" ><th width="10%" style="color:red">RANK</th><th width="25%" style="color:red">NAME</th><th width="16%" style="color:red">COLLEGE</th><th width="10%" style="color:red">LEVEL</th></tr>

            <!-- start here-->
	<?php
	session_start();
	require_once("database.php");
	global $result;
	$sql = "SELECT name,level,college FROM users WHERE role!=-1 ORDER BY level DESC";
	$ref = $result->query($sql);
	$count=mysqli_num_rows($ref);
	$per=20;
	$pagecount=ceil($count/$per);

	$page=$_GET["page"];
	if ($page=="")
	{
		$page=1;
	}
	if ($page==1)
	{
		$offset=0;
	}
	else {
		$offset=($page-1)*$per;
	}
	$sql = "SELECT name,level,college FROM users WHERE role not in(-1,10) ORDER BY level DESC, passtime ASC LIMIT $offset,$per";
	$ref = $result->query($sql);
	$rank=$offset+1;



	while($row = mysqli_fetch_assoc($ref))
	{
$arr = explode(' ',trim($row["name"]));
$arr2 = explode(' ',trim($row["college"]));

if($page==1){
		echo "<tr class=\"row\" id=\"rank".$rank."\"><td>".$rank."</td><td>".$arr[0]."</td><td>".$arr2[0]."</td><td>".$row["level"]."</td></tr>";
		$rank++;
		}
		else{
		echo "<tr class=\"row\"><td>".$rank."</td><td>".$arr[0]."</td><td>".$arr2[0]."</td><td>".$row["level"]."</td></tr>";
		$rank++;
		}
	}
	?></table>
	<div id="paging">
<?php
	if($page>1)
	{
		?><a class="link" href="leader.php?page=<?php echo $page-1?>"><?php echo "previous " ?></a> <?php
	}
	$adjacents=2;
	$start = ($page < $adjacents ? 1 : $page - $adjacents);
    $end = ($page > $pagecount - $adjacents ? $pagecount : $page + $adjacents);
     if($start==0)
	 {
		 $start=1;
	 }
	for ($i=$start;$i<=$end;$i++)
	{

		?><a class="link" href="leader.php?page=<?php echo $i?>"><?php echo $i." " ?></a> <?php
	}
	if($pagecount>$page)
	{
			?><a class="link" href="leader.php?page=<?php echo $page+1?>"><?php echo "Next " ?></a> <?php
	}
?>

</div>
           <!-- end here-->







      </h4>
	  </div>

		</div>

	</div>
</body>
</html>
