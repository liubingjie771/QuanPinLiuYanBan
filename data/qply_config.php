<!doctype html>
<html>
<head>
<meta charset="UTF-8" />
<title>全屏留言数据库初始化</title>
<style type="text/css">
#suc
{
	background: green;
	font-weight: bold;
	font-size: 20px;
	color: lightgreen;
}
#fail
{
	background: #FF0000;
	font-weight: bold;
	font-size: 20px;
	color: #FF99FF;
}
</style>
</head>
<?php
//system("rm -rf sqlite3db/quan_ping_liu_yan.db");
include("sqlite3.php");
$db=new DataBase("sqlite3db/quan_ping_liu_yan.db");

/*************************************************************************************************************************
  ly_id      |   ly_url        |    ly_clientip        |   ly_ctime        | ly_info               | ly_bakinfo
--------------------------------------------------------------------------------------------------------------------------
  留言ID号   |   留言请求地址  |  留言客户端IP地址     |  留言创建时间    |  用户留言信息5000字节  |  用户留言备注信息
*************************************************************************************************************************/
$info[0]="drop table note_info";
$info[1]="create table note_info(ly_id int unique,ly_url varchar(1000) not null,ly_clientip varchar(20) not null,ly_ctime datetime not null,ly_info varchar(5000) not null,ly_bakinfo varchar(1000))";
$info[2]="insert into note_info values(2000,'http://lyclub.f3322.net:82/toupiao/','10.0.0.5','2019-02-05 12:13:01','测试留言初始化信息','')";

for($i=0;$i<count($info);$i++)
{
	echo "<p>";
	echo $info[$i];
	if($db->exec($info[$i]))
	{
		echo "<font id=\"suc\">成功</font>";
	}
	else
	{
		echo "<font id=\"fail\">失败</font>";
	}
	echo "</p>";
}
?>