<?php
include("DBEngine_onhost.php");
$Dbs=ConnectDB();


$payment_result = $_POST[result];

?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
if($payment_result!='')
{
	
	$result_status = substr($payment_result, 0,2);	
// 	$invoice = substr($payment_result,2);
	$order_number = substr($payment_result,2);
	
	//$sql = "select a.*,b.* from order_customer a left join order_detail b on a.ordernumber= b.ordernumber where a.ordernumber='$ordernumber'";
// 	$sql = "select * from order_detail where invoice_number = '$invoice'";
	$sql = "select * from order_detail where ordernumber = '$order_number'";
	$query = mysql_query($sql);
	$nums = mysql_num_rows($query);
	
	if($nums > 0)
	{
		$reorder = mysql_fetch_assoc($query);
		
		if($result_status=="00")
		{
			//completed 
			//$sql_update = "update order_customer set orderstatus='PC' where ordernumber='$ordernumber' limit 1";
// 			$sql_update = "update order_detail set order_status='PC' where invoice_number='$invoice' limit 1";
			$sql_update = "update order_detail set order_status='PC', pay_date = NOW() where ordernumber='$order_number' limit 1";
			
			if(mysql_query($sql_update))
			{
				
				require_once 'includes/class.phpmailer.php';
				$mail = new PHPMailer();
				//send mail
				$total_price = $reorder[order_unit] * $reorder[product_price];
				$body = "ขอบคุณที่ใช้บริการดีลผ่าน alldealsthailand.com ค่ะ";
				$body .="ชื่อรายการ ".$reorder[product_name]."<br /><b>รายการดีล</b><br>";
				$body.="<table><tr><td align=right >หมายเลขสั่งซื้อ : </td><td>".$reorder[ordernumber]."</td></tr>";
				$body.="<tr><td align=right>ชื่อ : </td><td>".$reorder[order_name]."</td></tr><tr><td align=right >Email :</td><td>".$reorder[order_email]."</td></tr></table>";
				$body.="<br><b> Deal </b>";
				
				$body.="<table cellpadding=\"3\" >";
				$body.="<tr bgcolor=\"#f4f4f4\"  ><td width=\"30\">รายการ</td><td width=\"300\" align=\"center\" >ชื่อ </td><td width=\"100\"  align=\"center\">ราคา</td>";
				$body.="<td width=\"100\"  align=\"center\">จำนวน</td><td width=\"100\"  align=\"center\">รวม</td></tr>";
					
				$body.="<tr><td width=\"30\">1</td><td width=\"300\">".$reorder[product_name]."</td><td width=\"100\" align=\"center\">".number_format($reorder[product_price])."</td>";
				$body.="<td width=\"100\" align=\"center\">".$reorder[order_unit]."</td><td width=\"100\" align=\"center\" >".number_format($total_price)."</td></tr>";
				
				
				$body.="<tr  bgcolor=\"#f4f4f4\"  ><td width=\"30\"></td><td width=\"300\"></td><td width=\"100\" align=\"right\"></td>";
				$body.="<td width=\"100\" align=\"center\">ยอดรวม</td><td width=\"100\" align=\"center\" >".number_format($total_price)."</td></tr></table><br>";								
// 				$body.="<br /><br/> ท่านสามารถพิมพ์คูปองโดยคลิ๊ก <a href='http://www.alldealsthailand.com/coupon-print.php?did=".$reorder[ordernumber]."'>ที่นี่</a>";
				$body.="<br /><br/> ท่านสามารถพิมพ์คูปองโดยคลิ๊ก <a href='http://www.alldealsthailand.com/my-coupon.php'>ที่นี่</a>";
				/*
				$subject = "แจ้งพิมพ์หมายเลขคูปอง : $ordernumber  ";
				$tomail = "$reorder[orderemail]";
				$from = "info@alldealsthailand.com";				
				$headers = "From: alldealsthailand.com <$from>\n";
				$headers.="Content-Type: text/html; charset=utf-8\n";
				$headers.="Bcc: info@alldealsthailand.com,auapong@allhandsmarketing.com\n";
				$s = mail( $tomail ,$subject,$body, $headers);
				*/
				
			$mail->CharSet = "utf-8";
					
					/*
					$mail->IsSMTP();					
					$mail->SMTPDebug = 2;
					$mail->SMTPAuth   = true;
					$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
					$mail->Host       = "smtp.gmail.com";
					$mail->Port       = 587;
					*/
					
					$mail->Username = "sales@alldealsthailand.com"; // account SMTP
					$mail->Password = "Thailand1!"; // รหัสผ่าน SMTP
						
					$mail->From = "sales@alldealsthailand.com"; // ใครเป็นผู้ส่ง
					$mail->FromName = "sales alldealsthailand.com"; // ชื่อผู้ส่งสักนิดครับ
					$mail->Subject  = "แจ้งพิมพ์หมายเลขคูปอง".$reorder[ordernumber];
					
					$mail->IsHTML(true);					
					$mail->Body = $body;
					$mail->AddAddress($reorder[order_email]);
					$mail->AddBCC("sales@alldealsthailand.com","sales alldealsthailand.com");
// 					$mail->AddBCC("auapong@allhandsmarketing.com");
					$mail->AddBCC("suthon@allhandsmarketing.com");
					$mail->AddBCC("pataraporn@allhandsmarketing.com");
						
					if(!$mail->Send()) {
						echo "Mailer Error: " . $mail->ErrorInfo;
					} else {
						//header("Location:deal-completed.php?orn=$invoice");
						
					}
					echo "การชำระเงินเสร็จเรียบร้อยแล้ว หากมีข้อสงสัย หรือพบปัญหาการใช้งานกรุณติดต่อที่ sales@alldealsthailand.com";
				
				//header("Location: index.php");
			}
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

?>

