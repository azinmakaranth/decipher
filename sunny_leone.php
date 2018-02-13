<style>
tr{
	color:ivory;
	text-align:center;	
}
th {
	color:yellow;
}
#tab{
	width:100%;
	text-align:center;
	background-color:grey;
}
#cont {
	width:100%;
	text-align:center;
	color:black;
}
.ques {
	color:blue;
}
a.link {
	padding:2px;
	border:1px solid white;
	background-color:orange;
}
form {
	width:100%;
	text-align:center;
	color:red;
}
div#cont{
	text-align:center;
}
div#cont img{
	max-width:300px;
	max-height:300px;
}
@media only screen and (max-width: 500px) {
	div#cont img {
		width:180px;
} }
</style>


<?php 
session_start();
if($_SESSION["role"]!=10)
{
	Header("Location:index.php");
}
  else{
	require_once("database.php");
	global $result;
	require_once("adtheme.php");
	$work=$_GET["work"];
  if($work==2)//add/edit levels
	{
		echo "<form name = \"addlevels\" action = \"processlevels.php\"><br>Level Name:<br><input type = \"text\" name = \"name\"/><br>Level Title:<br><input type = \"text\" name = \"title\"><br> Level Content:<br><textarea name = \"content\" rows = \"20\" cols = \"60\"></textarea><br>Answer:<br><input type = \"text\" name = \"answer\"><br><input type = \"submit\" value = \"submit\"></form>";
	}
	else if ($work==1)//user answer logs
	{
	$sql = "SELECT * FROM logs ORDER BY time DESC";
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
	$sql = "SELECT user,val,level,time FROM logs ORDER BY time DESC LIMIT $offset,$per";
	$ref = $result->query($sql);
	$rank=$offset+1;

	echo"
	<table id=\"tab\">
	 <tr>
    <th>SIno.</th>
    <th>User</th>
	<th>val</th>
    <th>Level</th>
	<th>Time</th>
    </tr>";
  
	while($row = mysqli_fetch_assoc($ref))
	{
		echo "<tr><td>".$rank."</td><td>".$row["user"]."</td><td>".$row["val"]."</td><td>".$row["level"]."</td><td>".$row["time"]."</td></tr>";
		$rank++;
	} 
	?></table>
	<div id="paging">
	<?php
	if($page>1)
	{
		?><a class="link" href="sunny_leone.php?work=1&page=<?php echo $page-1?>"><?php echo "previous " ?></a> <?php
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
		
		?><a class="link" href="sunny_leone.php?work=1&page=<?php echo $i?>"><?php echo $i." " ?></a> <?php
	}		
	if($pagecount>$page)
	{
			?><a class="link" href="sunny_leone.php?work=1&page=<?php echo $page+1?>"><?php echo "Next " ?></a> <?php
	}

	}
	else if($work==4) // view levels
	{
			$level = $_GET["l"];
		if ($_GET["l"]=="")
		{
			$level=0;
		}
		$sql = "SELECT * FROM levels ORDER BY name";
		$ref = $result->query($sql);
		echo "<div id=\"cont\">";
		while($row = mysqli_fetch_assoc($ref))
		{
			echo "<a class =\"link\" href = \"sunny_leone.php?work=4&l=".$row["name"]."\">".$row["name"]."</a>";
		}
		$sql = "SELECT * FROM levels WHERE name = '" . $level . "'";
		$ref = $result->query($sql);
		$row = mysqli_fetch_assoc($ref);
		

		echo "<p class=\"disp\">".$row["name"]."</p><br>"."<p class=\"disp\">".$row["title"]."</p><br>"."<div class=\"ques\">".$row["contents"] ."<br><p>Answer:"."  ".$row["answer"]."</p><br></div></div>";


  }}
?>