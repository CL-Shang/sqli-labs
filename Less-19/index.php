<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>POST - Headers注入 - Referer部分 - 基于错误</title>
</head>

<body bgcolor="#000000">
<div style=" margin-top:70px;color:#FFF; font-size:23px; text-align:center">通过Referer来查询上次登陆IP</font><br>
<font size="3" color="#FFFF00">
 

<?php
//including the Mysql connect parameters.
include("../sql-connections/sql-connect.php");

	//$uagent = $_SERVER['HTTP_USER_AGENT'];
	$Referer = $_SERVER['HTTP_REFERER'];
	echo "<br>";
	echo '你是从: ' .$Referer. '过来的';
	echo "<br>";
		
	$sql="SELECT * FROM referers WHERE referer='$Referer' LIMIT 0,1";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
        echo "SQL语句如下：<br>".$sql."<br>执行结果：<br>";
		if($row)
			{
			echo '<font color= "#FFFF00" font size = 3 >';
			echo "上次的登陆IP是".$row['ip_address'];
			
			}
		else
			{
            echo '<font color= "#00ffff" font size="3">';
			print_r(mysql_error());
			echo "</br>";			
			echo "</br>";
			echo "你的来源不可靠，不告诉你IP！";	
			echo "</font>";  
			}

?>


</font>
</div>
</body>
</html>
