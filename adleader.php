<html>
<head>
<title>Leaderboard</title>
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
#paging {
	text-align:center;
	background-color:#333300;
}

a.link {
	padding:2px;
	border:1px solid white;	
	color:#ff99ff;
}

</style>
</head>
<?php
	session_start();
	if ((!isset($_SESSION["fbuid"]))||(($_SESSION["role"])!=10))
{$output = "<script>
        window.location='index.php';
        </script>";
	  echo $output; }
	require_once("database.php");
	global $result;
	if ($_SESSION["role"]!=10)
	{
		Header("Location:index.php");
	}
		require_once("adtheme.php");
	
	$sql = "SELECT name,level,college FROM users ORDER BY name";
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
	$sql = "SELECT * FROM users WHERE role!=10 ORDER BY name LIMIT $offset,$per";
	$ref = $result->query($sql);
	$rank=$offset+1;

	echo"
	<table id=\"tab\">
	 <tr>
    <th>Rank</th>
    <th>Name</th>
	<th>College</th>
    <th>Level</th>
    </tr>";
  
	while($row = mysqli_fetch_assoc($ref))
	{
		echo "<tr class=\"row\"><td>".$rank."</td><td><a href=\"edituser.php?id=".$row["fbuid"]."\">".$row["name"]."</a></td><td>".$row["college"]."</td><td>".$row["level"]."</td></tr>";
		$rank++;
	} 
	?></table>
	<div id="paging">
	<?php
	if($page>1)
	{
		?><a class="link" href="adleader.php?page=<?php echo $page-1?>"><?php echo "previous " ?></a> <?php
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
		
		?><a class="link" href="adleader.php?page=<?php echo $i?>"><?php echo $i." " ?></a> <?php
	}		
	if($pagecount>$page)
	{
			?><a class="link" href="adleader.php?page=<?php echo $page+1?>"><?php echo "Next " ?></a> <?php
	}
?>
</div>
</html>