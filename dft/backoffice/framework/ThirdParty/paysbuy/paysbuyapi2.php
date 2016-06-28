<?php
ini_set('display_errors', '0');
include("DBEngine_onhost.php");
$Dbs=ConnectDB();
include("includes/nusoap.php");


setcookie ("tmp_orderid", "", time() - 3600);

//post values
//$invoice = mysql_real_escape_string($_POST[orderno]);
//$order_price = mysql_real_escape_string($_POST[orderprice]);

$p_id = $_POST[p_id];
$p_name = $_POST[p_name];
$unit = $_POST[unit];
$order_price = $_POST[p_price];
$p_free = $_POST[p_free];
$invoice = $_POST[ordernumber];
$pay_med = $_POST[pay_med]; //pay_method
$condition = $_POST[condition];
$alldeal = $_POST[alldeal];
$update = $_POST[update];

$s_exist_order = "select * from order_detail where ordernumber = '$ordernumber' ";
$query_exist_order = mysql_query($s_exist_order);
$num_exist = mysql_num_rows($query_exist_order);

if($num_exist<1)
{
	//insert to order_detail
	if($invoice != "" and $p_name != "")
	{
	
		$s_insert_order = "insert into order_detail (detail_id, ordernumber, product_id, product_name, order_email, order_time, order_unit, product_price, price_free) ";
		$s_insert_order .= "values ('', '$invoice', '$p_id', '$p_name', '$_COOKIE[mem_email]', NOW(), '$unit' ,'$order_price', '$p_free')";

		if(mysql_query($s_insert_order))
		{
			//member
			$sqlm = "select * from member where mem_email='$_COOKIE[mem_email]'";
			$querym = mysql_query($sqlm);
			$rem = mysql_fetch_assoc($querym);

			//insert order customer
			if($p_free==1 or $order_price=="0")
			{
				$order_status = "DF";
			}
			else
			{
				$order_status = "N";
			}
			$s_insertc = "insert into order_customer (order_id, ordernumber, ordername, orderemail, orderaddress, ordertel, orderusername, ordertime, orderprice, orderstatus, pay_text) ";
			$s_insertc .= "values ('', '$ordernumber', '$rem[mem_name]', '$rem[mem_email]', '$rem[mem_address]', '$rem[mem_tel]'";
			$s_insertc .=", '$rem[mem_usernamme]', NOW(), '$order_price', '$order_status', '')";

			if(mysql_query($s_insertc))
			{
				require_once 'includes/class.phpmailer.php';
				//send mail
				if($p_free==1 or $order_price=="0")
				{
					//free coupon
					$mail = new PHPMailer();
						
					$body = "<html><head></head><body>";
					$body .="ขอบคุณที่ใช้บริการดีลผ่าน alldealsthailand.com ค่ะ";
					$body .="ชื่อรายการ ".$p_name."<br /><b>รายการดีล</b><br>";
					$body .="<table border='0'><tr><td align=right >หมายเลขสั่งซื้อ : </td><td>".$invoice."</td></tr>";
					$body .="<tr><td align=right>ชื่อ : </td><td>".$rem[mem_name]."</td></tr><tr><td align=right >Email :</td><td>".$rem[mem_email]."</td></tr></table>";
					$body .="<br><b> Deal </b>";
					$body .='<table cellpadding="3">';
					$body .='<tr bgcolor="#cccccc"><td width="30">รายการ</td><td width="300" align="center" >ชื่อ </td><td width="100"  align="center">ราคา</td>';
					$body .='<td width="100"  align="center">จำนวน</td><td width="100"  align="center">รวม</td></tr>';
					$body .='<tr><td width="30">1</td><td width="300">'.$p_name.'</td><td width="100" align="center">'.number_format($order_price).'</td>';
					$body .='<td width="100" align="center">'.$unit.'</td><td width="100" align="center" >'.number_format($order_price).'</td></tr>';
					$body .='<tr  bgcolor="#cccccc"  ><td width="30"></td><td width="300"></td><td width="100" align="right"></td>';
					$body .='<td width="100" align="center">ยอดรวม</td><td width="100" align="center" >'.number_format($order_price).'</td></tr></table><br>';
					$body .="<br /><br/> ท่านสามารถพิมพ์คูปองโดยคลิ๊ก <a href='http://www.alldealsthailand.com/coupon-print.php?did=".$invoice."'>ที่นี่</a>";
					$body .= '<p>หามีข้อสงสัย หรือปัญหาการใช้งานกรุณาติดต่อที่</p>
														<p>อีเมล์ : support@alldealsthailand.com</p>
														<p>โทร : 02-587-0193-4</p>';
					$body .="</body></html>";
						
					$mail->CharSet = "utf-8";
					
					/*
					$mail->IsSMTP();					
					$mail->SMTPDebug = 2;
					$mail->SMTPAuth   = true;
					$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
					$mail->Host       = "smtp.gmail.com";
					$mail->Port       = 587;
					*/
					
					$mail->Username = "info@alldealsthailand.com"; // account SMTP
					$mail->Password = "Thailand1!"; // รหัสผ่าน SMTP
						
					$mail->From = "info@alldealsthailand.com"; // ใครเป็นผู้ส่ง
					$mail->FromName = "info alldealsthailand.com"; // ชื่อผู้ส่งสักนิดครับ
					$mail->Subject  = "แจ้งพิมพ์หมายเลขคูปอง".$invoice;
					
					$mail->IsHTML(true);					
					$mail->Body = $body;
					$mail->AddAddress($_COOKIE[mem_email]);
					$mail->AddBCC("info@alldealsthailand.com","info alldealsthailand.com");
						
					if(!$mail->Send()) {
						echo "Mailer Error: " . $mail->ErrorInfo;
					} else {
						header("Location:deal-completed.php?orn=$invoice");
					}
				}
				else
				{
					//not free
					if($pay_med=="bt" or $pay_med=="cv" or $pay_med=="cc")
					{
						$mail = new PHPMailer();
						//โอนเงิน
						$body = "<html><head></head><body>";
						$body.="ชื่อรายการ ".$p_name."<br /><b>รายการดีล</b><br>";
						$body.="<table border='0'><tr><td align=right >หมายเลขสั่งซื้อ : </td><td>".$invoice."</td></tr>";
						$body.="<tr><td align=right>ชื่อ : </td><td>".$rem[mem_name]."</td></tr><tr><td align=right >Email :</td><td>".$rem[mem_email]."</td></tr></table>";
						$body.="<br><b> Deal </b>";
						$body.='<table cellpadding="3" >';
						$body.='<tr bgcolor="#f4f4f4"  ><td width="30">รายการ</td><td width="300" align="center" >ชื่อ </td><td width="100"  align="center">ราคา</td>';
						$body.='<td width="100"  align="center">จำนวน</td><td width="100"  align="center">รวม</td></tr>';
						$body.='<tr><td width="30">1</td><td width="300">'.$p_name.'</td><td width="100" align="center">'.number_format($order_price).'</td>';
						$body.='<td width="100" align="center">'.$unit.'</td><td width="100" align="center" >'.number_format($order_price).'</td></tr>';
						$body.='<tr  bgcolor="#f4f4f4"  ><td width="30"></td><td width="300"></td><td width="100" align="right"></td>';
						$body.='<td width="100" align="center">ยอดรวม</td><td width="100" align="center" >'.number_format($order_price).'</td></tr></table><br>';
						if($pay_med=="bt")
						{
							//for paysbuy
							$method = 1;
							$opt_fix_method = "";
							
							$body.="<br><br><b>ช่องทางชำระผ่านการโอนเงิน</b><br>";
							$body.='<p><img src="http://www.alldealsthailand.com/images/kbank.jpg" width="35" height="35" title="ธนาคารกสิกร" alt="ธนาคารกสิกร" /> ธนาคาร กสิกรไทย</p>
																<p>หมายเลขบัญชีสำหรับโอนเงิน : 779-2-19189-9</p>
																<p>ชื่อบัญชี : บริษัท ออล แฮนด์ มาร์เก็ตติ้ง จำกัด</p>
																<p>ประเภท : ออมทรัพย์</p>';
							$body.='<p><img src="http://www.alldealsthailand.com/images/ktc.jpg" width="35" height="35" title="ธนาคารกรุงไทย" alt="ธนาคารกรุงไทย" /> ธนาคาร กรุงไทย</p>
																<p>หมายเลขบัญชีสำหรับโอนเงิน : 447-0-09790-5</p>
																<p>ชื่อบัญชี : บริษัท ออล แฮนด์ มาร์เก็ตติ้ง จำกัด</p>
																<p>ประเภท : ออมทรัพย์</p>';
							$body.='<p>กรุณาชำระเงินภายใน 24 ชั่วโมงกับทางธนาคาร</p><p>มิเช่นนั้นบริษัทขอสงวนสิทธิในการรับชำระ และออกคูปอง</p>
									<p>ค่าบริการ 10-30 บาทต่อ 1 รายการ  ( ยอดรวมดังกล่าวไม่ได้รวมค่าธรรมเนียมของผู้ให้บริการ) * ทั้งนี้เพื่อเป็นยืนยันการชำระเงินผ่านทางธนาคารของท่านและเพื่อความสะดวกของลูกค้า ในการใช้คูปองกรุณาแจ้งกลับ alldealsthailandภายใน 24 ชั่วโมง  *</p>
									<p>ลูกค้าจะได้รับคูปองภายใน 1-2 วันทำการหลังจากที่บริษัทฯได้ตรวจสอบเรียบร้อยแล้ว</p>
									<p>ขอบคุณที่ใช้บริการกับทางทีมงาน Alldealsthailand.com</p>';					
							
						}
						elseif ($pay_med == "cv")
						{
							//for paysbuy
							$method = 6;
							$opt_fix_method = 1;
							
							$body .='<p><img src="http://www.alldealsthailand.com/images/counter-service.jpg" width="112" height="32" title="counter service" alt="counter service" /></p>
		<p><b>Alldealsthailand.com ได้รับสิทธิ์จากทาง Paysbuyในการเปิดช่องทางการชำระเงินผ่านทางระบบ Paysbuy.</b></p>
		<p style="width: 790px; margin-left: 10px;">Alldealsthailand.com ได้รับสิทธิ์จาก Paysbuy เพื่อเปิดช่องทางการชำระเงินผ่านระบบ เคาน์เตอร์เซอร์วิส หลังจากที่ท่านเลือกช่องทางการชำระเงินผ่าน Paysbuy Counter Service ระบบจะพาท่านเข้าสู่หน้าการชำระเงินของ Paysbuy
		เมื่อท่านกรอกรายละเอียดการชำระเงินครบถ้วน จึงจะได้รับอีเมลล์แจ้งการชำระเงินจาก Paysbuy และท่านสามารถพิมพ์ใบชำระเงินดังกล่าวเพื่อนำไปชำระเงินได้ที่เคาร์เตอร์เซอร์วิซ (<b>7-11</b>, <b>Tesco Lotus</b>) </p>
		<p style="margin-left: 10px;">หลังจากชำระเงินเรียบร้อยแล้ว ท่าน จะได้รับอีเมลล์ยืนยันเพื่อพิมพ์คูปองของท่านผ่านทางอีเมล์จาก alldealsthailand.comภายใน 1 ถึง 2 วันทำการ.</p>
		<p style="margin-left: 10px;">หมายเหตุ ลูกค้าต้องชำระภายใน 24 ชั่วโมงหลังจากการสั่งซื้อ</p>
		<p style="margin-left: 10px;">ขอบคุณที่ใช้บริการกับทางทีมงาน Alldealsthailand.com</p>';
						}
						elseif ($pay_med == "cc")
						{
							//for paysbuy
							$method = 2;
							$opt_fix_method = 1;
							$body.='<p style="width:790px; margin-left: 10px;">
			การจ่ายผ่านบัตรเครดิตของคุณทั้ง Visa และ มาสเตอร์การ์ด ทางalldealsthailand.comได้ใช้ระบบการจ่ายเงินผ่านทางpaysbuy ดังนั้นระบบจะพาท่านไปสู่หน้าการชำระเงินของpaysbuy
หลังจากชำระเงินเรียบร้อยแล้วผ่านบัตรเครดิต ท่านจะได้รับอีเมลล์ยืนยันเพื่อพิมพ์คูปองของท่านผ่านทางอีเมล์จาก alldealsthailand.comภายใน 30 นาที
		</p>';
						}
						else
						{
								//no case
						}
						
						$body .= '<p>หากมีข้อสงสัย หรือปัญหาการใช้งานกรุณาติดต่อที่</p>
									<p>อีเมล์ : support@alldealsthailand.com</p>
									<p>โทร : 02-587-0193-4</p>';
						$body .="</body></html>";

						$mail->CharSet = "utf-8";
						
						/*
						$mail->IsSMTP();					
						$mail->SMTPDebug = 2;
						$mail->SMTPAuth   = true;
						$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
						$mail->Host       = "smtp.gmail.com";
						$mail->Port       = 587;
						*/
						$mail->Username = "info@alldealsthailand.com"; // account SMTP
						$mail->Password = "Thailand1!"; // รหัสผ่าน SMTP
							
						$mail->From = "info@alldealsthailand.com"; // ใครเป็นผู้ส่ง
						$mail->FromName = "info alldealsthailand.com"; // ชื่อผู้ส่ง
						$mail->Subject  = "แจ้งการสั่งซื้อคูปองหมายเลข ".$invoice;
						$mail->IsHTML(true);					
						$mail->Body = $body;
						$mail->AddAddress($_COOKIE[mem_email]);
						$mail->AddBCC("info@alldealsthailand.com","info alldealsthailand.com");

						if(!$mail->Send())
						{
							echo "Mailer Error: " . $mail->ErrorInfo;
						}
						else
						{
							if($pay_med=="bt")
							{
								//โอนเงิน
								header("Location: thank-you.php");
							}
							else 
							{
								//post values to paysbuy
								$url = "https://www.paysbuy.com/api_paynow/api_paynow.asmx?WSDL";
								$client = new soap_client($url, true);
									
								$psbID = "0707431600";
								$username = "payment@allhandsmarketing.com";
								$secureCode = "22FA9B9399DDAE44293C9262EE877785";
								$inv = $invoice;
								$itm = "Payment for alldealsthailand.com";
								$amt = $order_price; //price
								$paypal_amt = "";
								$curr_type = "TH";
								$com = "";
								//$method = "1"; //1=PAYSBUY Account, 2=Credit Card, 6=counter service
								$language = "T";
									
								//Change to your URL
								$resp_front_url = "http://www.alldealsthailand.com/payment_thank.php";
								$resp_back_url = "http://www.alldealsthailand.com/payment_thank.php";
									
								//Optional data
								$opt_fix_redirect = "";
								//$opt_fix_method = "";
								$opt_name = "";
								$opt_email = "";
								$opt_mobile = "";
								$opt_address = "";
								$opt_detail = "";
									
								$result = "";
									
								//1. Step 1 call method api_paynow_authentication
								$params = array("psbID"=>$psbID, "username"=>$username, "secureCode"=>$secureCode, "inv"=>$inv, "itm"=>$itm, "amt"=>$amt, "paypal_amt"=>$paypal_amt, "curr_type"=>$curr_type, "com"=>$com, "method"=>$method, "language"=>$language, "resp_front_url"=>$resp_front_url, "resp_back_url"=>$resp_back_url, "opt_fix_redirect"=>$opt_fix_redirect, "opt_fix_method"=>$opt_fix_method, "opt_name"=>$opt_name, "opt_email"=>$opt_email, "opt_mobile"=>$opt_mobile, "opt_address"=>$opt_address, "opt_detail"=>$opt_detail);
									
								$result = $client->call('api_paynow_authentication_new', array('parameters' => $params), 'http://tempuri.org/', 'http://tempuri.org/api_paynow_authentication_new', false, true);
									
								if ($client->getError()) {
									echo "<h2>Constructor error</h2><pre>" . $client->getError() . "</pre>";
								} else {
									$result = $result["api_paynow_authentication_newResult"];
								}
								//echo "<br>result ->".$result;
									
								$approveCode = substr($result,0,2);
									
								//echo "<br>approveCode->".$approveCode;
									
								$intLen = strlen($result);
								$strRef = substr($result,2, $intLen-2);
									
								//2. If authentication is successful, then the server responds 00, The process continues redirect to PAYSBUY API Page.
								if($approveCode=="00") {
									echo "<meta http-equiv='refresh'
															content='0;url=https://www.paysbuy.com/api_payment/paynow.aspx?refid=".$strRef."'>";
								} else {
									echo "<br>Can't login to paysbuy server";
								}
							}
							
							
						}//end if send mail
					}//end pay 		
								
				}//end else not free
			}//end if insert data customer
			else 
			{
				echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
				echo "การซื้อดีลไม่สำเร็จกรุณาตรวจสอบดีลอีกครั้ง 1 <br/> <a href='index.php'>กลับ</a>";
			}
		}//end if query data to order_detail
		else
		{
			echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
			echo "การซื้อดีลไม่สำเร็จกรุณาตรวจสอบดีลอีกครั้ง 2<br/> <a href='index.php'>กลับ</a>";
		}
	}//if invoice and name !=''
	else 
	{
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		echo "การซื้อดีลไม่สำเร็จกรุณาตรวจสอบดีลอีกครั้ง 3<br/> <a href='index.php'>กลับ</a>";
	}

}
else 
{
	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
	echo "การซื้อดีลไม่สำเร็จกรุณาตรวจสอบดีลอีกครั้ง 4<br/> <a href='index.php'>กลับ</a>";
}



?>



