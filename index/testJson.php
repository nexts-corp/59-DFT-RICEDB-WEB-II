<?php
mysql_query("SET NAMES UTF8");
mysql_query("SET character_set_results=utf8");
mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_connection=utf8");

require("connections/connection.php");
//$p_id = $_POST['inpID'];

$qstring = "select * from feedback ORDER BY id ASC";
$query  = mysql_query($qstring) or die ("flashVar=error");

$mix = "[";
while($rec = mysql_fetch_array($query)){
        $mix.='{"a":"'.$rec['student'].'","b":"';
        $mix.=$rec['valuez'].'"},';
}
$mix .= '{"a":"471725312","b":"ขอขอบคุณทุก Feedback ครับ"}]';
echo $mix;
?>