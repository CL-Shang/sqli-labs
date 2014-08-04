<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Less-25a Trick with OR & AND Blind</title>
</head>

<body bgcolor="#000000">

<font size="3" color="#FFFF00">


<?php
//including the Mysql connect parameters.
include("../sql-connections/sql-connect.php");


// take the variables
if(isset($_GET['id']))
{
$id=$_GET['id'];


	//fiddling with comments
	$id= blacklist($id);
	//echo "<br>";
	//echo $id;
	//echo "<br>";
	$hint=$id;

// connectivity 
$sql="SELECT * FROM users WHERE id=$id LIMIT 0,1";
$result=mysql_query($sql);
    echo "SQL语句如下：<br>".$sql."<br>执行结果：<br>";
$row = mysql_fetch_array($result);

	if($row)
	{
  		echo "<font size='5' color= '#99FF00'>";	
	  	echo 'Your Login name:'. $row['username'];
		//echo 'YOU ARE IN ........';	  	
		echo "<br>";
	  	echo 'Your Password:' .$row['password'];
	  	echo "</font>";
  	}
	else 
	{
		echo '<font size="5" color="#FFFF00">';
		//echo 'You are in...........';
		//print_r(mysql_error());
		//echo "You have an error in your SQL syntax";
		echo "</br></font>";	
		echo '<font color= "#00ffff" font size= 3>';	
	
	}
}
function blacklist($id)
{
	$id= preg_replace('/or/i',"", $id);			//strip out OR (non case sensitive)
	$id= preg_replace('/AND/i',"", $id);		//Strip out AND (non case sensitive)
	
	return $id;
}



?>

</font> </div></br></br></br>
</body>
</html>
