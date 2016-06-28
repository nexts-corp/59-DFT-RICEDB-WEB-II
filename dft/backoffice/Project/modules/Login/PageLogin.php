<?php
require_once("Project/common/user.php");
require_once("Project/bussiness/UserDao.php");


class  PageLogin extends TForm
 {
	 
		function PageLogin()
		{

			global $orm;
			$this->Init("PageLogin","Login","form-validate",true);
			

			$Username=new TTextBox();
			$Username->set("Username","","","",true,"String",true);
			$Username->setAttribute("placeholder","Email address");
			$Username->setAttribute("class","form-control");
			//$Username->setAttribute("data-rule-required","true");
			//$Username->setAttribute("data-rule-email","true");
			$this->Add($Username);

			$Password=new TPassword();
			$Password->set("Password","","","",true,"String",true);
			$Password->setAttribute("placeholder","Password");
			$Password->setAttribute("class","form-control");
			$this->Add($Password);



			$bnlogin=new TLink();
			$bnlogin->set("bnlogin","Sign In <i class=\"icon-angle-right\"></i>","","10",true,"String",true);
			$bnlogin->setEvent("onclick","chklogin");
			$bnlogin->setAttribute("class","submit btn btn-primary pull-right");
			$this->Add($bnlogin);

			$bnpassword=new TLink();
			$bnpassword->set("bnpassword","ลืมรหัสผ่าน ?","","10",true,"String",false);
			$bnpassword->setEvent("onclick","chkpassword");
			$bnpassword->setAttribute("class","button cyan");
			$this->Add($bnpassword);



			$this->waitevent();
	
		}
		function chklogin($parameter,$sender)
		{
			global $orm;
			global $_SESSION;
			global $ConfigPage;

			$attv[0]=$sender->getvalue("Username");
			$attv[1]=$sender->getvalue("Password");
			
			$dao=new UserDao();
			$o=$dao->Login($attv[0],md5($attv[1]));
			
			if($o[0]->userID)
			{

				$_SESSION["Session_User_RegisterID"]=$o[0]->registerID;
				$_SESSION["Session_User_UsertypeID"]=$o[0]->usertypeID;
				$_SESSION["Session_User_UserID"]=$o[0]->userID;
				$_SESSION["Session_User_SuperID"]=$o[0]->userSuper;
				
				$_SESSION["Owner"]=$o[0]->Owner;

					fRefresh("","page","MainPage.HomePage");
				
			}
			else{
					$error=new TLabel();
					$error->set("error","<div class='alert alert-danger fade in'>
																<i class='icon-remove close' data-dismiss='alert'></i>
																<strong>ผิดพลาด!</strong> ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง.
															</div>
								","","",true,"String",true);
					$sender->Add($error);
			//msgboxtempadmin("กรุณาใส่ชื่อผู้ใช้ หรือ รหัสผ่านให้ถูกต้อง");

				//fRefresh("","page","Login.PageLogin");
				}
		}
		function chkpassword($parameter,$sender)
		{
				fRefresh("","page","Login.PagePassword");
		}
		
		
		
 }
 ?>