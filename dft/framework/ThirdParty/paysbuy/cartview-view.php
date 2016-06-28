<?php
include("DBEngine_onhost.php");
$Dbs=ConnectDB();
require_once 'includes/function.php';


$ordernumber = gen_order(10);

$cususer  = $_COOKIE[cususer] ;
$tmpcusorder =  $_COOKIE[tmpcusorder] ;
$mem_id =  $_COOKIE[mem_id] ;

$mem_email = $_COOKIE[mem_email];
$pid = $_POST[p_id];

//check bought deal
if($pid==25)
{
	$payid = 25;
	$sql_check_bought = "select a.*, b.product_id from order_customer as a left join order_detail as b on a.ordernumber = b.ordernumber";
	$sql_check_bought .= " where a.orderemail = '$mem_email' and b.product_id=25 ";
		
	$query_check_bought = mysql_query($sql_check_bought);
	if(mysql_num_rows($query_check_bought)>0)
	{
		header("Location: index.php");
	}
}

//cookie
if($_POST[p_id] != "")
{
	setcookie('tmp_orderid', $_POST[p_id]);
}


$unit = 1;//$_POST[dealorder];
$tmp_orderid = $_COOKIE[tmp_orderid];
if($_COOKIE[mem_email]!='')
{
	if ($pid=="" and $tmp_orderid=="" and empty($_GET)) {
		header("Location: index.php");
	}
}
//product detail
if($tmp_orderid != '')
{
	//check bought
	if($tmp_orderid==25)
	{
		$payid = 25;
		$sql_check_bought = "select * from order_detail where product_id = 25 and order_email = '$_COOKIE[mem_email]' ";
		$query_check_bought = mysql_query($sql_check_bought);
		if(mysql_num_rows($query_check_bought)>0)
		{
			header("Location: index.php");
		}
	}
	$sql_product = "select * from product_detail where p_id='$tmp_orderid'";
}
else
{
	$sql_product = "select * from product_detail where p_id='$pid'";
}

$query = mysql_query($sql_product);
$result = mysql_fetch_assoc($query);

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
<meta name="description" content="รายละเอียดดีล <?php echo $result['p_name'];?>" />
<meta name="keywords" content="<?php echo $result['p_name'];?> ดีลพิเศษ ลดราคา โรงแรม ที่พัก อาหาร ร้านค้า คูปอง ดีล" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="http://www.alldealsthailand.com/images/favicon.ico" type="image/x-icon" />

<?php include("includes/js.css.php");?>
<?php 
if($_POST[useavia]==1)
{
	?>
<?php 
if ($_POST['p_id']!='') {
?>
<!-- Google Code for New Registration Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 997216548;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "Qy1SCKy65gMQpKLB2wM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript"
	src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
	<div style="display: inline;">
		<img height="1" width="1" style="border-style: none;" alt=""
			src="http://www.googleadservices.com/pagead/conversion/997216548/?value=0&amp;label=Qy1SCKy65gMQpKLB2wM&amp;guid=ON&amp;script=0" />
	</div>
</noscript>
<?php 
}//end if post pid!=''
?>
<?php 	
}
?>
<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/basic.css" title="Main" />
<script type="text/javascript" src="js/framework.js"></script>
<script type="text/javascript" src="js/all_ajax.js"></script>

<script type="text/javascript">

function loadmemberlogin(content, act)
{
		var URL = "form-logmem.php" ; 
		var  data = "formtype=" + content + "&action=" + act; 
		ajaxLoad('get', URL, data, 'logdetail' );
		document.getElementById('logdetail').innerHTML="<br><br><center><b>Loading...</b></center><br><br>";
}

function  checkemail(form)
{
	var mem_email = form.mem_email.value ;
	var URL = "checkemail.php" ; 
	var  data = "mem_email=" + mem_email ; 
	ajaxLoad('get', URL, data, 'mailere' );
	document.getElementById('mailere').innerHTML="<b>Loading...</b>";
}

function chkform(form)
{

	var mem_password = form.mem_password.value ;
	var mem_re_password = form.mem_re_password.value ;
	var mem_name = form.mem_name.value ;
	var mem_email = form.mem_email.value ;
	var mem_tel = form.mem_tel.value ;
	var useavia = form.useavia.value;
	var condition = form.condition;

	
	if( mem_password != ""  &&   mem_re_password  != "")
	{
		if(  mem_password !=  mem_re_password   )
		{
			document.getElementById('nomatch').innerHTML="<br><font color='red'><b>กรุณากรอกรหัสผ่านให้ตรงกัน</b></font>";
		}
		else
		{
			document.getElementById('nomatch').innerHTML="";
		}
	}

	if( !mem_email.match(/^[\w]{1}[\w\.\-_]*@[\w]{1}[\w\-_\.]*\.[\w]{2,6}$/i) && mem_email != "" )
	{
		document.getElementById('mailere').innerHTML="<br><font color='red'><b>กรุณาตรวจสอบ Email ให้ถูกต้อง</b></font>";
	}
	else
	{
		document.getElementById('mailere').innerHTML="";
	}
	
	if( mem_password != ""  &&    mem_re_password != ""  &&    mem_name != ""  &&    mem_email != ""  && mem_email.match(/^[\w]{1}[\w\.\-_]*@[\w]{1}[\w\-_\.]*\.[\w]{2,6}$/i) &&   mem_password ==  mem_re_password  &&  useavia == "1" && mem_tel != "" && condition.checked==true )
	{
		document.getElementById('btnsubmit').innerHTML="<input  type='Submit'  name='submit'  onclick='regissubmit(this.form)' class='btn_log2'    value=' Submit'  > ";
	}
	else
	{
		document.getElementById('btnsubmit').innerHTML="<input type='Submit' name='Submit'  value=' Submit '  disabled >";
	}
	
	if(  useavia == "0" )
	{
		document.getElementById('btnsubmit').innerHTML="<input type='Submit' name='Submit'  value=' Submit '  disabled >";
	}

}

function popupwin(url)
{
	    var w=850,h=700,winX=(screen.availWidth-w-10),winY=0	    	    
	    window.open(url,"condition","width="+w+",height="+h+",left="+winX+",scrollbars");
}

function regissubmit(form)
{

		var mem_password = form.mem_password.value;
		var mem_re_password = form.mem_re_password.value;
		var mem_name = form.mem_name.value;
		var mem_email = form.mem_email.value;
		var mem_tel = form.mem_tel.value;
		var mem_province = form.mem_province.value;
		var useavia = form.useavia.value;

		var URL = "regissubmit.php"; 
		var data = "mem_password="+mem_password+"&mem_name="+mem_name+"&mem_tel="+mem_tel+"&mem_email="+mem_email+"&mem_province="+mem_province; 
		ajaxLoad('post', URL, data, 'logdetail');
		document.getElementById('logdetail').innerHTML="<b>Loading...</b>";
	
/*
$(function() {
		$.post("regissubmit.php", {	
			mem_email : form.mem_email.value,		
			mem_password : form.mem_password.value,
			mem_name : form.mem_name.value,
			tel : form.mem_tel.value,
			mem_province : form.mem_province.value,
			useavia : form.useavia.value},
			function(result){			
				$("#logdetail").html(result);			
			}
		);
});*/	
}

function passwordsubmit(form)
{
	var mem_email = form.email.value;	
	var URL = "forgot-password.php"; 
	var data = "email="+mem_email;
	
	ajaxLoad('post', URL, data, 'logdetail');
	document.getElementById('logdetail').innerHTML="<b>Loading...</b>";
	
}

function checkcondition()
{
<?php 
if($payid !=25  )
{

?>	var condition = document.getElementById('condition');
	var banktransfer = document.getElementById('banktransfer');
	var counterservice = document.getElementById('counterservice');
	var creditcard = document.getElementById('creditcard');
	
	var unit = document.getElementById('unit');
	<?php 
	if($_COOKIE[mem_email]=='sales@alldealsthailand.com' or $_COOKIE[mem_email]=="suthon@allhandsmarketing.com" or $_COOKIE[mem_email]=="pataraporn@allhandsmarketing.com" or $_COOKIE[mem_email]=="bbnami@gmail.com") {
	?>
	var cash = document.getElementById('cash_med');
	
	<?php 
	}
	if ($result['p_promotion']==1) {
	?>
		var promotion = document.getElementById('promotion');
	<?php 
	}
	?>
	if(unit.value<=0){
		alert('กรุณาระบุจำนวนที่ต้องการซื้อ');
		unit.focus();
		return false;
	}
	
	if((banktransfer.checked==false) && (counterservice.checked==false) && (creditcard.checked==false) 
	<?php 
		if($_COOKIE[mem_email]=="sales@alldealsthailand.com" or $_COOKIE[mem_email]=="suthon@allhandsmarketing.com" or $_COOKIE[mem_email]=="pataraporn@allhandsmarketing.com" or $_COOKIE[mem_email]=="bbnami@gmail.com") {
			echo "&& (cash.checked==false) ";
		}
		if ($result['p_promotion']==1) {
			echo "&& (promotion.checked==false)";
		}
	?>) {
		alert('กรุณาเเลือกช่องทางการชำระเงิน');
				banktransfer.focus();
				return false;
	}
<?php 
}
?>
	
	
	if(condition.checked==false) {
		alert('ท่านยังไม่ได้ยอมรับเงื่อนไขการซื้อดีล');
		condition.focus();
		return false;
	}
	
}

function ebutton()
{
	var condition = document.getElementById('condition');
	var btn_checkout = document.getElementById('checkout');
	if(condition.checked==true){		
		btn_checkout.style.background = '#98CB00';	
	}
	else{
		btn_checkout.style.background = '#ccc';	
	}
}

function showdetail(val)
{
	$(function() {

		$('.paydetails').hide();

		$("#"+val+"_detail").show();
		});

	$("#creditcampaign").click(function(){
		var discount = 0.95 * $("#full_price").val();
		var discountVal = 0.05 * $("#full_price").val();
		var total_discount = discount * $("#unit").val();
		$(".price").html(addCommas($("#unit").val() * $("#full_price").val()));
		$(".new-price").html(addCommas(Math.ceil(total_discount.toFixed(2))));
		//$("#each-price").html(addCommas(discount));
		$(".discount").html(' ลด ' + addCommas((discountVal * $("#unit").val())));
		$("#p_price").val(total_discount.toFixed(2));
	});

	$(".pay-method").click(function(){
		var full_price = $("#full_price").val() * $("#unit").val();
		var discountVal = 0.05 * full_price;
		//$("#unit").val(1);
		$(".new-price").html(addCommas(full_price));
		$(".price").html(addCommas(full_price));
		
		//$("#each-price").html(addCommas(full_price));
		$(".discount").html(' ลด ' + addCommas((discountVal * $("#unit").val())));
		$("#p_price").val(full_price);
		$(".discount").html('');
	});
		
}

function addCommas(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}

$(function(){
	$("#unit").keydown(function(event) {
        if( event.keyCode == 46 || event.keyCode == 8 ){
                
        }
        else{
//           if(event.keyCode < 48 || event.keyCode > 57 && (event.keyCode < 96 || event.keyCode > 105 )){
     	  if( key == 8 || key == 9 || key == 46 || (key >= 37 && key <= 40) || (key >= 48 && key <= 57) || (key >= 96 && key <= 105)) {
               event.preventDefault(); 
           } 
        }        
    });
    
	$("#unit").keyup(function(){
		var unit = $(this).val();
		
		if(isNaN(unit)){
			$(this).val(1);
		}else{
			var new_val = Number(unit);
			<?php 
			if($result[p_price1]!=0)
			{
			?>		
			var old_price = <?php echo $result[p_price1];?>;
			<?php 
			}else {
			?>
			var old_price = 0;
			<?php
			}
			?>
			//alert(unit.charCodeAt(0));
			if(unit.substring(0)=="0" && unit.substring(1)=="0"){
				$(".unitnotify").show();
			}else if(unit.substring(0)!="0"){				
				$(".unitnotify").hide();
			}else{				
				$(".unitnotify").show();
			}
			$(this).val(new_val);
			if($("#promotion").attr('checked')) {
				var new_price = addCommas(Math.ceil((new_val*old_price*0.95).toFixed(2)));
				var discountVal = 0.05 * $("#full_price").val();
				$(".price").html(addCommas($("#unit").val() * $("#full_price").val()));
				$("#p_price").val((new_val*old_price*0.95).toFixed(2));
				$(".discount").html(' ลด ' + addCommas((discountVal * $("#unit").val())));
			}else {
				var new_price = addCommas(Math.ceil(new_val*old_price));
				$(".price").html(addCommas($("#unit").val() * $("#full_price").val()));
				
			}				
						
			$(".new-price").html(new_price);
		}
		if(unit=="0" || unit=="" || unit=="00"){
			$(this).val(0);
			$(".unitnotify").show();
			//$(".new-price").html(0);			
		}		
	});
	
});
</script>
<?php 
include_once 'includes/analytics.php';
?>

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
			<div style="height: 50px;"></div>
			<!-- Login -->
			<?php
			if($cususer  == ""  ||  $regisx=="1" ){
				?>
			<div class="logmember" id="logdetail"></div>
			<?php
			if($regisx == "1"){
				?>
			<script>
loadmemberlogin('memregis','none');
</script>
			<?php
			}
			elseif($_POST[mem_email] !='' and $_POST[mem_password] != '')
			{
				$mem_password = mysql_real_escape_string($_POST['mem_password']);
				$mem_name = mysql_real_escape_string($_POST['mem_name']);
				$mem_email =  mysql_real_escape_string($_POST['mem_email']);
				$mem_tel =  mysql_real_escape_string($_POST['mem_tel']);
				$mem_province = mysql_real_escape_string($_POST['mem_province']);

				$sql_checkmem = "select mem_email from member where mem_email='$mem_email'";
				$query = mysql_query($sql_checkmem);
				$num_email = mysql_num_rows($query);

				if($num_email>0)
				{
					?>
			<h3>ลงทะเบียนสมาชิก</h3>
			<br /> <br />
			<div style="text-align: center">
				<b>ไม่สามารถทำการลงทะเบียนได้ </b><br />
				เนื่องจากมีการใช้งานอีเมล์นี้แล้ว<br />
				หากท่านลืมรหัสผ่านกรุณาคลิีกลิ้งค์ด้านล่าง
			</div>
			<br /> <br /> [ <a href="javascript:loadmemberlogin('forget','none');">ลืมรหัสผ่าน</a>
			]
			<?php 
				}else
				{
					$time = time();

					//$insert = "insert into  member set mem_password='$mem_password', mem_name='$mem_name', mem_email='$mem_email', province='$mem_province', mem_tel='$mem_tel' ";
					//$insert.=",  mem_address='$mem_address' , registime='$time' ";
					$insert ="INSERT INTO `member` (`mem_id`, `mem_usernamme`, `mem_password`, `mem_name`, `mem_email`, `province`, `mem_tel`, `mem_address`, `mem_status`, `registime`, `registerdate`) ";
					$insert .= "VALUES (NULL, '', '$mem_password', '$mem_name', '$mem_email', '$mem_province', '$mem_tel', '$mem_address', '', '$time', NOW())";

					DBexec($Dbs,$insert);
					?>
			<h3>ลงทะเบียนสมาชิก</h3>
			<br /> <br />
			<div style="text-align: center">
				<b>ลงทะเบียนเรียบร้อยแล้ว </b><br />
			</div>
			<br /> <br /> [ <a href="cartview-view.php?formtype=memlogin">เข้าสู่ระบบ</a>
			]
			<?php 
				}//end else
				?>
			<?php 		
			}else if($_GET[forget] == "1"){
				?>
			<script>
loadmemberlogin('forget','none');
</script>
			<?php
			}
			else if ($_GET[a]=="lucky")
			{
				?>
			<script>
	loadmemberlogin('memlogin','lucky');
	</script>
			<?php 
			}elseif ($_GET[act] == 'login'){
			?>
			<script>
				loadmemberlogin('memlogin','none');
			</script>
			<?php 
			}else{
				?>
			<script>
loadmemberlogin('memlogin','none');
</script>
			<?php 
			}
			?>
			<div style="height: 50px;"></div>
			<?php
			}
			?>
			<!-- End Login -->

			<?php
			if($cususer <> "")
			{
				$total = $result[p_price1] * $unit;
				?>
			<h2>ดูคำสั่งซื้อ</h2>

			<p style="margin-top: 10px;">รายการสั่งซื้อของคุณใกล้สำเร็จแล้วโปรดตรวจสอบข้อมูลด้านล่างก่อนชำระเงิน</p>
			<br />

			<form name="deallist" method="post" action="payf.php" onsubmit="return checkcondition();">
				<ul class="cart_head">
					<li class="ct01" style="background-color: #ccc;">รายการ</li>
					<li class="ct02" style="background-color: #ccc;">ชื่อ</li>
					<li class="ct04" style="background-color: #ccc;">ราคา</li>
					<li class="ct03" style="background-color: #ccc;">จำนวน</li>
					<li class="ct05" style="background-color: #ccc;">รวม</li>
					<!-- <li class="ct06" style="background-color: #ccc;">&nbsp;</li> -->
				</ul>
				<div class="clear"></div>
				<?php
				if($bxx == "brx1")
				{
					$bxx = "brx2";
				}
				else
				{
					$bxx = "brx1";
				}
				?>

				<ul class="cart_detail  <?php echo $bxx;?>">
					<li class="ct01">1.</li>
					<li class="ct02"><?php 
					if($result[p_id]==25)
					{
						echo "สุดพิเศษดีล 0 บาทลุ้นเป็นผู้โชคดีรับรางวันที่พัก สุดหรู 3  วัน 2 คืน พร้อมอาหารเช้าสำหรับ 2 คน<br/>";
					}
					echo $result[p_name];
					?>
					</li>
					<li class="ct04" id="each-price"><?php
					if($result[p_free] != "1"){
						?> ฿<?php echo number_format($result[p_price1]);?><?php
					}else{
					 $result[p_price]  = 0 ;
					 echo "0";
					}
					?>
					</li>
					<li class="ct03">
						<input type="text" name="unit" id="unit" size="5" value="1" <?php if($result[p_id]==25){echo 'disabled="disabled"';}?> maxlength="2" style="text-align: center;" onKeyup="javascript:return isNumeric(this,'กรุณาป้อนจำนวนตัวเลข');" />
						<input type="hidden" name="p_id" value="<?php echo $result[p_id];?>" />
						<input type="hidden" name="p_name" value="<?php echo $result[p_name];?>" />						
						<input type="hidden" name="p_price" id="p_price" value="<?php echo $result[p_price1];?>" />
						<input type="hidden" name="p_free" value="<?php echo $result[p_free];?>" />
						<input type="hidden" name="ordernumber" value="<?php echo $ordernumber;?>" />
						<input type="hidden" name="full_price" id="full_price" value="<?php echo $result[p_price1];?>" />
					</li>

					<li class="ct05"><?php

					if($result[p_free] != "1"){
						echo "฿".'<span class="price">'.number_format($total)."</span>";
					}else
					{
					 echo "0";
					}
					?><span class="discount"></span>
					</li>

				</ul>

				<div class="clear"></div>
				<p class="unitnotify" style="width: 400px; float: right; color: red; display: none;">กรุณาใส่จำนวนที่ต้องการ</p>
				<div class="clear"></div>
				<div style="font: bold 13px tahoma; width: 800px; text-align: left;">
					<div style="float: right; width: 300px; margin-top: 10px;">
						<span>ราคารวม : </span><span style="margin-left: 90px;">฿</span><span class="new-price" id="discount-price"><?php echo number_format($total);?>
						</span>
					</div>
				</div>

				<div class="clear"></div>
				<div style="height: 20px;"></div>
				<div class="ffmember">
					<div class="ffmem_h">ข้อมูลสมาชิก</div>
					<?php

					$sql ="select * from member  where  mem_email='$_COOKIE[mem_email]'";
					$res = DBexec($Dbs,$sql);
					$arr = DBfetch_array($res,0);

					?>
					<ul>
						<li class="or01">ชื่อ :</li>
						<li class="or02"><?php echo $arr[mem_name];?></li>
						<li class="or01">อีเมล์ :</li>
						<li class="or02"><?php echo $arr[mem_email];?></li>
						<li class="or01">จังหวัด :</li>
						<li class="or02"><?php echo $arr[province];?></li>
						<li class="or01">โทร :</li>
						<li class="or02"><?php echo $arr[mem_tel];?></li>
					</ul>
					<div class="clear"></div>
				</div>
				<?php 
				if($payid != 25)
				{
					?>
				<div class="ffmem_h">ช่องทางการชำระเงิน</div>
				<?php
				if($_COOKIE[mem_email]=='sales@alldealsthailand.com' or $_COOKIE[mem_email]=="suthon@allhandsmarketing.com" or $_COOKIE[mem_email]=="pataraporn@allhandsmarketing.com" or $_COOKIE[mem_email]=="bbnami@gmail.com") {
				?>
				<div id="cash" class="paymethod">
					<input type="radio" name="pay_med" id="cash_med" class="pay-method" value="cash" onclick="showdetail(this.value);"> ชำระเงินสด
				</div>
				
				<?php
				}
				if ($result['p_promotion']=='1') {
				?>
				
				<div id="creditcampaign" class="paymethod">
					<input type="radio" name="pay_med" id="promotion" value="promotion" onclick="showdetail(this.value);"> <span style="color: red;">ลดเพิ่ม 5% เพียงจ่ายผ่านบัตรเครดิต visa/master</span>
				</div>
				<?php
				}
				?>
				<div id="bank_transfer" class="paymethod">
					<input type="radio" name="pay_med" id="banktransfer" class="pay-method" value="bt" onclick="showdetail(this.value);" /> ชำระผ่านการโอนเงินที่ธนาคาร
				</div>
				<div style="display: none;" id="bt_detail" class="paydetails">
					<p>กรุณาชำระเงินภายใน 24 ชั่วโมงกับทางธนาคารตามหมายเลขบัญชี
						alldealsthailand.com ดังต่อไปนี้</p>
					<ul class="transferlist">
						<li>
							<p>
								<img src="images/kbank.jpg" width="35" height="35" title="ธนาคารกสิกร" alt="ธนาคารกสิกร" /> ธนาคาร กสิกรไทย
							</p>
							<p>หมายเลขบัญชีสำหรับโอนเงิน : 779-2-19189-9</p>
							<p>ชื่อบัญชี : บริษัท ออล แฮนด์ มาร์เก็ตติ้ง จำกัด</p>
							<p>ประเภท : ออมทรัพย์</p>
						</li>
						<li>
							<p>
								<img src="images/ktc.jpg" width="35" height="35" title="ธนาคารกรุงไทย" alt="ธนาคารกรุงไทย" /> ธนาคาร กรุงไทย
							</p>
							<p>หมายเลขบัญชีสำหรับโอนเงิน : 477-0-09790-5</p>
							<p>ชื่อบัญชี : บริษัท ออล แฮนด์ มาร์เก็ตติ้ง จำกัด</p>
							<p>ประเภท : ออมทรัพย์</p>
						</li>
					</ul>

					<p style="margin-top: 7px;">มิเช่นนั้นบริษัทขอสงวนสิทธิในการรับชำระ
						และออกคูปอง</p>

					<ul class="transferlist">
						<li>ค่าบริการ 10-30 บาทต่อ 1 รายการ (
							ยอดรวมดังกล่าวไม่ได้รวมค่าธรรมเนียมของผู้ให้บริการ)</li>
						<li><font color="red">*</font> <span
							style="font: bold 14px tahoma; color: #000;">ทั้งนี้เพื่อเป็นยืนยันการชำระเงินผ่านทางธนาคารของท่านและเพื่อความสะดวกของลูกค้า
								ในการใช้คูปองกรุณาแจ้งกลับ alldealsthailand.com ภายใน 24 ชั่วโมง</span>
						</li>
						<li><font color="red">*</font> <span
							style="font: bold 14px tahoma; color: #000;">ลูกค้าจะได้รับคูปองทางอีเมล์ภายใน
								1-2 วันทำการหลังจากที่บริษัทฯได้ตรวจสอบเรียบร้อยแล้ว</span></li>
						<li><font color="red">หมายเหตุ</font>
							กรณีที่ไม่ได้รับอีเมล์ภายในระยะเวลาที่กำหนด กรุณาตรวจสอบที่ junk
							mail หรือ ติดต่อหมายเลข 02-587-0193 - 4 ในวันเวลาทำการ</li>

					</ul>
					<p>ขอบคุณที่ใช้บริการกับทางทีมงาน alldealsthailand.com</p>
				</div>

				<div id="counter" class="paymethod">
					<input type="radio" name="pay_med" id="counterservice" class="pay-method" value="cv" onclick="showdetail(this.value);" /> ชำระผ่านเคาน์เตอร์เซอร์วิส
				</div>
				<div style="display: none;" id="cv_detail" class="paydetails">
					<div style="margin-bottom: 10px;">
						<p style="width:770px; text-align:center;">
							<img src="images/counter-service.jpg" width="112" height="32" title="counter service" alt="counter service" />
						</p>
						<p>
							<b>alldealsthailand.com ได้รับสิทธิ์จากทาง
								Paysbuyในการเปิดช่องทางการชำระเงินผ่านทางระบบ Paysbuy.</b>
						</p>
					</div>

					<p style="width: 790px; margin-bottom: 10px;">
						alldealsthailand.com ได้รับสิทธิ์จาก Paysbuy
						เพื่อเปิดช่องทางการชำระเงินผ่านระบบ เคาน์เตอร์เซอร์วิส
						หลังจากที่ท่านเลือกช่องทางการชำระเงินผ่าน Paysbuy Counter Service
						ระบบจะพาท่านเข้าสู่หน้าการชำระเงินของ Paysbuy
						เมื่อท่านกรอกรายละเอียดการชำระเงินครบถ้วน
						จึงจะได้รับอีเมลล์แจ้งการชำระเงินจาก Paysbuy
						และท่านสามารถพิมพ์ใบชำระเงินดังกล่าวเพื่อนำไปชำระเงินได้ที่เคาร์เตอร์เซอร์วิซ
						(<b>7-11</b>, <b>Tesco Lotus</b>)
					</p>
					<p style="margin-bottom: 10px;">หลังจากชำระเงินเรียบร้อยแล้ว ท่าน
						จะได้รับอีเมลล์ยืนยันเพื่อพิมพ์คูปองของท่านผ่านทางอีเมล์จาก
						alldealsthailand.com ภายใน 1 ถึง 2 วันทำการ.</p>
					<p style="margin-bottom: 10px;">หมายเหตุ ลูกค้าต้องชำระภายใน 24
						ชั่วโมงหลังจากการสั่งซื้อ</p>
					<p style="margin-bottom: 10px;">ขอบคุณที่ใช้บริการกับทางทีมงาน
						alldealsthailand.com</p>
				</div>

				<div id="credit_card" class="paymethod">
					<input type="radio" name="pay_med" id="creditcard" class="pay-method" value="cc" onclick="showdetail(this.value);" /> บัตรเครดิต
				</div>
				<div style="display: none;" id="cc_detail" class="paydetails">
					<p>
						<b>การชำระผ่านบัตรเครดิต</b>
					</p>
					<p style="width: 790px; margin-left: 10px;">
						การจ่ายผ่านบัตรเครดิตของคุณทั้ง Visa และ มาสเตอร์การ์ด
						ทางalldealsthailand.comได้ใช้ระบบการจ่ายเงินผ่านทางpaysbuy
						ดังนั้นระบบจะพาท่านไปสู่หน้าการชำระเงินของpaysbuy
						หลังจากชำระเงินเรียบร้อยแล้วผ่านบัตรเครดิต
						ท่านจะได้รับอีเมลล์ยืนยันเพื่อพิมพ์คูปองของท่านผ่านทางอีเมล์จาก
						alldealsthailand.com ภายใน 30 นาที</p>
					<p style="width: 790px; text-align: center;">
						<img src="images/mastercard-visa.jpg" width="200" height="55" title="mastercard visa" alt=" mastercard visa" />
					</p>
				</div>
				<?php 
				}//end if pid != 25
				?>
				<div style="text-align: right; margin: 15px; width: 730px;">
					<input type="checkbox" name="condition" id="condition" onclick="ebutton(this.form)" /> <span>ฉันยอมรับ</span>
						<a href="#" onclick="popupwin('condition-pop.php')" style="font-weight: bold; text-decoration: underline; color: red;">เงื่อนไขข้อตกลง</a>
				</div>
				<div class="btncheck">
					<input type="hidden" name="alldeal" value="1" /> <input type="hidden" name="update" value="1" />
					<input type="button" name="back" value=" ถอยกลับ " class="btncheckout" onclick="javascrip:history.back(1);" />
					<input type="submit" name="checkout" id="checkout" value=" ดำเนินการต่อ " class="btncheckout" style="background: #ccc" />
				</div>

			</form>

			<?php
}
?>
		</div>
		<!--end content-->

		<div class="clear"></div>
	</div>
	<!--end wrap-->
	<?php include("includes/footer.php");?>
	<!-- End body  Detail -->
</body>
</html>
