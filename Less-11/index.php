<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>POST - 基于错误 - 单引号 - 字符型</title>
</head>

<body bgcolor="#000000">
<div style=" margin-top:20px;color:#FFF; font-size:24px; text-align:center"> 请登录 </font><br></div>
<div  align="center" style="margin:40px 0px 0px 520px;border:20px; background-color:#0CF; text-align:center; width:400px; height:150px;">

<div style="padding-top:10px; font-size:15px;">
 

<!--Form to post the data for sql injections Error based SQL Injection-->
<form action="" name="form1" method="post">
	<div style="margin-top:15px; height:30px;">用户名 : &nbsp;&nbsp;&nbsp;
	    <input type="text"  name="uname" value=""/>
	</div>  
	<div> 密&nbsp;&nbsp;&nbsp;&nbsp;码  : &nbsp;&nbsp;&nbsp;
		<input type="text" name="passwd" value=""/>
	</div></br>
	<div style=" margin-top:19px;margin-left:70px;">
		<input type="submit" name="submit" value="提交" />
	</div>
</form>

</div></div>

<div style=" margin-top:10px;color:#FFF; font-size:23px; text-align:center">
<font size="6" color="#FFFF00">





<?php
//including the Mysql connect parameters.
include("../sql-connections/sql-connect.php");


// take the variables
if(isset($_POST['uname']) && isset($_POST['passwd']))
{
	$uname=$_POST['uname'];
	$passwd=$_POST['passwd']; 
	@$sql="SELECT username, password FROM users WHERE username='$uname' and password='$passwd' LIMIT 0,1";
	$result=mysql_query($sql);
    echo "SQL语句如下：<br>".$sql."<br>执行结果：<br>";
        if($result)
	{
  		//echo '<font color= "#00ffff">';	
  		while($row = mysql_fetch_array($result))
        {echo "<br>";
		echo '<font color= "#FFFF00" font size = 4>';
		//echo " You Have successfully logged in\n\n " ;
		echo '<font size="3" color="#00ffff">';	
		echo "<br>";
		echo '用户名:'. $row['username'];
		echo "<br>";
		echo '密码:' .$row['password'];
		echo "<br>";
		echo "</font>";
		echo "<br>";
		echo "<br>";
		
  		echo "</font>";}
  	}
	else  
	{
		echo '<font color= "#00ffff" font size="3">';
		//echo "Try again looser";
        echo '登录失败<br>';	
        print_r(mysql_error());
		echo "</br>";
		echo "</br>";
		echo "</br>";
		echo "</font>";  
	}
}

?>


</font>
</div>
</body>
</html>
