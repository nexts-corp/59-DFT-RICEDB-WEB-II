<?php
include("DBEngine_onhost.php");
$Dbs=ConnectDB();

//tracking
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	$ip = $_SERVER['HTTP_CLIENT_IP'];
}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
elseif (!empty($_SERVER['REMOTE_ADDR'])) {
	$ip = $_SERVER['REMOTE_ADDR'];
}
else {
	$ip = "could not track";
}

if (!empty($_SERVER['HTTP_REFERER'])) {
	$referUrl = $_SERVER['HTTP_REFERER'];
}else {
	$referUrl = "no refer url";
}

$sql = "insert into tracking (track_id, track_ip, track_refer, track_url, track_date) values ('', '$ip', '$referUrl', '$_SERVER[REQUEST_URI]', NOW())";
@mysql_query($sql);
//end tracking

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>All Deals Thailand</title>
<meta name="description"	content="best deal for shopping online" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="http://www.alldealsthailand.com/images/favicon.ico" type="image/x-icon" />

<?php include("includes/js.css.php");?>
<link rel="stylesheet" type="text/css" href="css/basic.css" title="Main" />
<script src="js/framework.js"></script>
<script src="js/all_ajax.js"></script>
<script type="text/javascript">
function popupwin(url)
{
	   	window.open(url,"condition","width=850,height=900,left="+(screen.availWidth-850-10)+",scrollbars,menubar=1");
}
</script>

</head>

<body>
<!-- Header -->
<?php include("headerx.php");?>
<!--end header-->

<!-- Main Nav -->
<?php include("menubar.php");?>
<!--end main_nav-->

<!--  Body Detail -->
<div class="wrapper">

<!-- content-->
	 <div id="content">
		<div style="margin: 30px 0; font: bold 16px arial;">ออกจากหน้านี้ <a href="index.php" style="color:red;">คลิ๊ก</a></div>
		
		<div style="font:bold 24px arial;">ขอบคุณที่ใช้บริการกับ alldealsthailand.com</div>
		<div style="margin: 20px;">
		<p>
		<?php
if($payment_result!='')
{
	
	$result_status = substr($payment_result, 0,2);	
	$invoice = substr($payment_result,2);
	
	//$sql = "select a.*,b.* from order_customer a left join order_detail b on a.ordernumber= b.ordernumber where a.ordernumber='$ordernumber'";
	$sql = "select * from order_detail where invoice_number = '$invoice'";
	$query = mysql_query($sql);
	$nums = mysql_num_rows($query);
	
	if($nums > 0)
	{
		
		if($result_status=="00")
		{
			//completed 
			//$sql_update = "update order_customer set orderstatus='PC' where ordernumber='$ordernumber' limit 1";
			echo "การชำระเงินเสร็จเรียบร้อยแล้ว ท่านสามารถพิมพ์คูปองผ่าน <a href='http://www.alldealsthailand.com/my-coupon.php'>ระบบคูปองของฉัน</a><br/>หากมีข้อสงสัย หรือพบปัญหาการใช้งานกรุณติดต่อที่ sales@alldealsthailand.com";
			
		}
		else if($result_status=="99")
		{
			//not complete
			//header("Location: index.php");
			echo "การชำระไม่สำเร็จ หากมีปัญหาการใช้งานกรุณาแจ้ง sales@alldealsthailand.com";
		}
		else 
		{
			//inprocess
			//header("Location: index.php");
		}
	}
	
	
}else 
{
	//header("Location: index.php");
	
}
//redirect to index.php
// 
?>
		</p>
		
		
		</div>
	
	</div>
	  <!--end content-->
	  
	<div class="clear"></div>
	
</div>
<!--end wrap-->
<?php include("includes/footer.php");?>

<!-- End body  Detail -->


</body>
</html>

