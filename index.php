<!doctype html>
<html>
<head>
<meta charset="UTF-8" />
<title>全屏留言板</title>
<style type="text/css">
#lytop
{
	position: fixed;
	top:0px;
	left:0px;
	right:0px;
	height:26px;
	line-height:26px;
	font-size:20px;
	font-family: 黑体;
	border: lightgray solid 2px;
	background: gray;
	color: blue;
}
#lytop p
{
	margin-top:0px;
	margin-bottom:0px;
	margin-left:10px;
	margin-right:10px;
}
#lymiddle
{
	position: fixed;
	top: 30px;
	left: 5px;
	right: 5px;
	bottom:40px;
	font-family: 宋体;
	text-align: center;
	vertical-align:middle;
}
#lymiddle textarea
{
	height: 98%;
	width: 98%;
	margin-top: 2px;
	margin-bottom: 2px;
	margin-left: 5px;
	margin-right: 5px;
	line-height: 30px;
	font-size: 24px;
}
#lybottom
{
	position: fixed;
	bottom: 0px;
	height: 30px;
	left: 0px;
	right: 0px;
	background: gray;
	text-align: right;
	vertical-align:middle;
}
#lybottom input
{
	border: blue solid green;
	background: lightgreen;
	line-height: 20px;
	font-size: 16px;
	margin-top: 2px;
	margin-bottom: 2px;
	margin-right: 10px;
}
</style>
</head>
<body>
<?php
$viewurl="http://".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
if($_GET["url"]!="")
{
	$viewurl=$_GET["url"];
}
?>
<form action="two.php" method="post" >
<input type="hidden" id="lyurl" name="lyurl" value="<?php echo $viewurl; ?>" />
<div id="lytop" name="lytop">
<p>请在此处留下你的建议或留言：</p>
</div>
<div id="lymiddle" name="lymiddle">
<textarea id="lymain" name="lymain">
</textarea>
</div>
<div id="lybottom" name="lybottom">
<input type="submit" value="提交留言" />
</div>
</form>
</body>
</html>