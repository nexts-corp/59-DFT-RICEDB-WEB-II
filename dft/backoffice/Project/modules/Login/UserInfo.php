<?php
require_once("Project/common/usertype.php");
require_once("Project/bussiness/UserTypeDao.php");

require_once("Project/common/user.php");
require_once("Project/bussiness/UserDao.php");

require_once("Project/common/register.php");
require_once("Project/bussiness/RegisterDao.php");

class  UserInfo extends TForm
 {
	 
		function UserInfo()
		{

			global $orm;
			$this->Init("UserInfo","Login","form-horizontal",true);
			
		

			$user=$_SESSION["Session_User_UserID"];
			$UserType=$_SESSION["Session_User_UsertypeID"];

			$dao_user=new UserDao();
			$o_user=$dao_user->selectById($user);
			
					$form=new THidden();
					$form->set("userID",$o_user->userID,"","",false,"","");
					$this->Add($form);

					$form=new THidden();
					$form->set("versionuser",$o_user->version,"","",false,"","");
					$this->Add($form);


					$username=new TLabel();
					$username->set("username",$o_user->userName,"","",false,"","");
					$this->Add($username);

			
					$dao_register=new RegisterDao();
						$o_register=$dao_register->selectById($o_user->registerID);
					
					$form=new THidden();
					$form->set("registerID",$o_register->registerID,"","",true,"String",true);
					$this->Add($form);

					$form=new THidden();
					$form->set("version",$o_register->version,"","",true,"String",true);
					$this->Add($form);

					$form=new TTextBox();
					$form->set("registerName",$o_register->registerName,"","",true,"String",true);
					$this->Add($form);

					$form=new TTextBox();
					$form->set("registerPhone",$o_register->registerPhone,"","",true,"String",true);
					$this->Add($form);

					$form=new TTextBox();
					$form->set("registerEmail",$o_register->registerEmail,"","",true,"String",true);
					$this->Add($form);

					$form=new TTextarea();
					$form->set("registerAddress",$o_register->registerAddress,"","",true,"String",true);
					$this->Add($form);
					



			$this->waitevent();
	
		}
		
		
 }
 ?>