<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Cookie注入 - base64编码 -双引号</title>
</head>

<body bgcolor="#000000">
<?php
//including the Mysql connect parameters.
	include("../sql-connections/sql-connect.php");
if(!isset($_COOKIE['uname']))
	{
	//including the Mysql connect parameters.
	include("../sql-connections/sql-connect.php");

	echo '<div style=" margin-top:70px;color:#FFF; font-size:23px; text-align:center">使用Dumb/Dumb登陆后<br>通过修改cookie来获取其他人的信息</font><br>';
	echo '<font size="3" color="#FFFF00">';
 

	echo "<!--Form to post the contents -->";
	echo '<form action=" " name="form1" method="post">';

	echo ' <div style="margin-top:15px; height:30px;">用户名 : &nbsp;&nbsp;&nbsp;';
	echo '   <input type="text"  name="uname" value="Dumb"/>  </div>';
  
	echo ' <div> 密&nbsp;&nbsp;&nbsp;&nbsp;码 : &nbsp; &nbsp; &nbsp;';
	echo '   <input type="text" name="passwd" value="Dumb"/></div></br>';	
	echo '   <div style=" margin-top:9px;margin-left:90px;"><input type="submit" name="submit" value="Submit" /></div>';

	echo '</form>';
	echo '</div>';
	echo '</div>';
	echo '<div style=" margin-top:10px;color:#FFF; font-size:23px; text-align:center">';
	echo '<font size="3" color="#FFFF00">';
	echo '<center><br><br><br>';
	echo '</center>';





	
function check_input($value)
	{
	if(!empty($value))
		{
		$value = substr($value,0,20); // truncation (see comments)
		}
		if (get_magic_quotes_gpc())  // Stripslashes if magic quotes enabled
			{
			$value = stripslashes($value);
			}
		if (!ctype_digit($value))   	// Quote if not a number
			{
			$value = "'" . mysql_real_escape_string($value) . "'";
			}
	else
		{
		$value = intval($value);
		}
	return $value;
	}


	
	echo "<br>";
	echo "<br>";
	
	if(isset($_POST['uname']) && isset($_POST['passwd']))
		{
	
		$uname = check_input($_POST['uname']);
		$passwd = check_input($_POST['passwd']);
		$sql="SELECT  users.username, users.password FROM users WHERE users.username=$uname and users.password=$passwd ORDER BY users.id DESC LIMIT 0,1";
		$result1 = mysql_query($sql);
		$row1 = mysql_fetch_array($result1);
			if($row1)
				{
				setcookie('uname', base64_encode($row1['username']), time()+3600);	
				header ('Location: index.php');
				}
			else
				{
				echo '<font color= "#00ffff" font size="3">';
				//echo "Try again looser";
				print_r(mysql_error());
				echo "</br>";			
				echo "</br>";
				echo '登录失败';	
				echo "</font>";  
				}
			}
		
			echo "</font>";  
	echo '</font>';
	echo '</div>';

}
else
{
	if(!isset($_POST['submit']))
		{
			$cookee = $_COOKIE['uname'];
			echo "<br></font>";
			$format = 'D d M Y - H:i:s';
			$timestamp = time() + 3600;
			echo "<center>";
			echo "<br><br><br><b>";
			echo "<br><br><b>";
			echo '<font color= "#FFFF00" font size = 4 >';
			echo "登陆成功，你可以修改cookie来进行注入了 <br>";
			echo '<font color= "orange" font size = 5 >';			
			echo "你的 COOKIE是 : uname = $cookee <br>到期时间: " . date($format, $timestamp);
			echo "<br></font>";
            $cookee = base64_decode($cookee);
			$cookee1 = '"'. $cookee. '"';
			$sql="SELECT * FROM users WHERE username=$cookee1 LIMIT 0,1";
			$result=mysql_query($sql);
            echo "SQL语句如下：<br>".$sql."<br>执行结果：<br>";
			if (!$result)
  				{
  				die(mysql_error());
  				}
			$row = mysql_fetch_array($result);
			if($row)
				{
			  	echo '<font color= "pink" font size="5">';	
			  	echo '用户名:'. $row['username'];
			  	echo "<br>";
				echo '<font color= "grey" font size="5">';  	
				echo '密&nbsp;&nbsp;&nbsp;&nbsp;码:' .$row['password'];
			  	echo "</font></b>";
				echo "<br>";
				echo '你的 ID:' .$row['id'];
			  	}
			else	
				{
				echo "<center>";
				echo '<br><br><br>';
				echo "<br><br><b>";
				}
			echo '<center>';
			echo '<form action="" method="post">';
			echo '<input  type="submit" name="submit" value="删除Cookie" />';
			echo '</form>';
			echo '</center>';
		}	
	else
		{
		
				setcookie('uname', base64_encode($row1['username']), time()-3600);
				header ('Location: index.php');
		
		}		


			echo "<br>";
			echo "<br>";
			//header ('Location: main.php');
			echo "<br>";
			echo "<br>";

	
}
?>


</body>
</html>
