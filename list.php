<!doctype html>
<html>
<head>
<meta charset="UTF-8" />
<title>查看全屏留言信息</title>
<base target="_blank" />
</head>
<body>
<?php

function alerr($info,$n,$uri="")
{
	echo "<script language=\"javascript\">";
	echo "window.alert(\"".$info."\");";
	switch($n)
	{
		case "0": break;
		case "1": echo "history.go(-1);"; break;
		case "2": echo "window.close();"; break;
		case "3": echo "location.href=\"".$uri."\";"; break;
	}
	echo "</script>";
	exit(0);
}

include("../data/sqlite3.php");
$db=new DataBase("sqlite3db/quan_ping_liu_yan.db");
/*************************************************************************************************************************
  ly_id      |   ly_url        |    ly_clientip        |   ly_ctime        | ly_info               | ly_bakinfo
--------------------------------------------------------------------------------------------------------------------------
  留言ID号   |   留言请求地址  |  留言客户端IP地址     |  留言创建时间    |  用户留言信息5000字节  |  用户留言备注信息
*************************************************************************************************************************/
if(!$one=$db->query("select * from note_info"))
{
	alerr("查询数据失败！",2);
}
echo "<table border='1' cellspacing='0' cellpadding='0' >";
echo "<tr><th>留言ID号</th><th>留言请求地址</th><th>留言客户端IP地址</th><th>留言创建时间</th><th>用户留言信息</th><th>用户留言备注信息</th></tr>";
while($two=$one->fetchArray())
{
	echo "<tr>";
	echo "<td align='center'>".$two["ly_id"]."</td>";
	echo "<td align='center'><a href=\"".$two["ly_url"]."\">".$two["ly_url"]."</a></td>";
	echo "<td align='center'>".$two["ly_clientip"]."</td>";
	echo "<td align='center'>".$two["ly_ctime"]."</td>";
	echo "<td align='center'>".$two["ly_info"]."</td>";
	echo "<td align='center'>".$two["ly_bakinfo"]."</td>";
	echo "</tr>";
}
echo "</table>";
?>
</body>
</html>