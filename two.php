<!doctype html>
<html>
<head>
<meta charset="UTF-8" />
<title>提交留言数据</title>
</head>
<body>
<?php
// 定义一个函数getIP()
function getIP()
{
global $ip;
if (getenv("HTTP_CLIENT_IP"))
$ip = getenv("HTTP_CLIENT_IP");
else if(getenv("HTTP_X_FORWARDED_FOR"))
$ip = getenv("HTTP_X_FORWARDED_FOR");
else if(getenv("REMOTE_ADDR"))
$ip = getenv("REMOTE_ADDR");
else $ip = "Unknow";
return $ip;
}

// 使用方法：
//echo getIP();
//echo "<br/>请求地址：".$_POST["lyurl"];
//echo "<br/>发送地址：".getIP();
//echo "<br/>发送时间：".date("Y-m-d H:i:s");
//echo "<br/>留言信息：".$_POST["lymain"];
$ly_url=$_POST["lyurl"];
$ly_clientip=getIP();
$ly_ctime=date("Y-m-d H:i:s");
$ly_info=$_POST["lymain"];

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
if(!$one=$db->query("select max(ly_id) from note_info"))
{
	alerr("查询留言ID号失败！",1);
}
elseif(!$two=$one->fetchArray())
{
	alerr("查询留言ID号后获取失败！",1);
}
$ly_id=$two[0];
$ly_id=$ly_id+1;
if($ly_url=="")
{
	alerr("系统获取网页地址信息错误！无法留言",3,$ly_url);
}
elseif($ly_clientip==""&&$ly_clientip=="Unknow")
{
	alerr("系统无法获取到您的IP地址，无法留言",3,$ly_url);
}
elseif($ly_info=="")
{
	alerr("你没有输入留言或评价或建议信息",1);
}
elseif($db->query("select ly_id from note_info where ly_id=".$ly_id)->fetchArray()[0]!="")
{
	alerr($ly_id."多人同时提交报错！".print_r($addly),1);
}
elseif($db->exec("insert into note_info values(".$ly_id.",'".$ly_url."','".$ly_clientip."','".$ly_ctime."','".$ly_info."','')"))
{
	alerr("留言提交成功！",3,$ly_url);
}
else
{
	alerr("留言提交失败！",1);
}

?>
</body>
</html>