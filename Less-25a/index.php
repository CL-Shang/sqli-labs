<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GET - 基于错误 - 过滤OR&amp;AND</title>
</head>

<body bgcolor="#000000">
<div style=" margin-top:70px;color:#FFF; font-size:23px; text-align:center">已知index.php有get参数，参数名称为id<br>请构造注入语句获取额外信息</font><br>
<font size="3" color="#FFFF00">


<?php
//including the Mysql connect parameters.
include("../sql-connections/sql-connect.php");


// take the variables
if(isset($_GET['id']))
{
    $id=$_GET['id'];
	$id= blacklist($id);
    $sql="SELECT * FROM users WHERE id=$id LIMIT 0,1";
    $result=mysql_query($sql);
    echo "SQL语句如下：<br>".$sql."<br>执行结果：<br>";
    $row = mysql_fetch_array($result);
    if($row)
	{
  	echo '<font color= "#00ffff">';	
  	echo '你的用户名:'. $row['username'];
  	echo "<br>";
  	echo '你的密码:' .$row['password'];
    echo "<br>";
  	echo "</font>";
  	}
	else 
	{
	echo '<font color= "#FFFF00">';
	print_r(mysql_error());
	echo "</font>";  
	}
}
function blacklist($id)
{
	$id= preg_replace('/or/i',"", $id);			//strip out OR (non case sensitive)
	$id= preg_replace('/AND/i',"", $id);		//Strip out AND (non case sensitive)
	$id= preg_replace('/[--]/',"", $id);		//Strip out --
	$id= preg_replace('/[#]/',"", $id);			//Strip out #
    return $id;
}

?>

</font> </div></br></br></br>
</body>
</html>
