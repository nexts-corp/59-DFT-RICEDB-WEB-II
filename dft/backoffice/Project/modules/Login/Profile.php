<?php
require_once("Project/common/usertype.php");
require_once("Project/bussiness/UserTypeDao.php");

require_once("Project/common/user.php");
require_once("Project/bussiness/UserDao.php");

require_once("Project/common/register.php");
require_once("Project/bussiness/RegisterDao.php");

class  Profile extends TForm
 {
	 
		function Profile()
		{

			global $orm;
			$this->Init("Profile","Login","form-horizontal",true);
			
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


					$form=new TTextBox();
					$form->set("username",$o_user->userName,"","",false,"","");
					$form->setAttribute("class","form-control");
					$this->Add($form);

					$form=new TPassword();
					$form->set("userPassword","","","",true,"","");
					$form->setAttribute("class","form-control");
					$this->Add($form);

					$form=new TPassword();
					$form->set("userPasswordConfirm","","","",true,"","");
					$form->setAttribute("class","form-control");
					$this->Add($form);
			
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
					$form->setAttribute("class","form-control");
					$this->Add($form);

					$form=new TTextBox();
					$form->set("registerPhone",$o_register->registerPhone,"","",true,"String",true);
					$form->setAttribute("class","form-control");
					$this->Add($form);

					$form=new TTextBox();
					$form->set("registerEmail",$o_register->registerEmail,"","",true,"String",true);
					$form->setAttribute("class","form-control");
					$this->Add($form);

					$form=new TTextarea();
					$form->set("registerAddress",$o_register->registerAddress,"","",true,"String",true);
					$form->setAttribute("class","form-control");
					$this->Add($form);
					
					$form=new TInputfile();
					$form->set('registerImg',$o_register->registerImg,"","",true,"String",false);
					$form->setAttribute("class","id-input-file-3");
					$this->add($form);

					$bn=new TButton();
					$bn->set("bn","<i class='icon-ok bigger-110'></i>Save","","",true,"String",true);
					$bn->setEvent("onclick","frmAction");
					$bn->setAttribute("class","btn btn-primary");
					$this->Add($bn);




			$this->waitevent();
	
		}
		function frmAction($parameter,$sender)
		{
				$o=new register();
				$o->registerID=$sender->getvalue('registerID');
				$o->version=$sender->getvalue('version');
				$o->registerName=$sender->getvalue('registerName');
				$o->registerEmail=$sender->getvalue('registerEmail');
				$o->registerPhone=$sender->getvalue('registerPhone');
				$o->registerAddress=$sender->getvalue('registerAddress');

				$userfile=$sender->getvalue('registerImg');
					
					$Datef=Date("d-m-y");
					$Timef=Date("H-i-s");
					$Datef=ereg_replace("-","",$Datef);
					$Timef=ereg_replace("-","",$Timef); 
					$Fname="doc_".$Datef."_".$Timef;

				$o->registerImg=uploadFile(0,"./Upload/File",$Fname,$userfile);

				$o->status="Open";
					
				$userPassword=$sender->getvalue('userPassword');
				$userPasswordConfirm=$sender->getvalue('userPasswordConfirm');
				$dao=new RegisterDao();
				
				if($o->registerID)
				{
					$dao->update($o);
				}
					
				
				$dao_user=new UserDao();
				if($userPassword==$userPasswordConfirm)
				{

						$o_user=new user();
						$o_user->userID=$sender->getvalue('userID');
						$o_user->version=$sender->getvalue('versionuser');
						$o_user->userPassword=md5($userPassword);
						$o_user->password=$userPassword;

						if($o_user->userID and !empty($userPassword))
					{
							
							$dao_user->update($o_user);
							//print_r($o_user);
					}

				}
				Refreshs("Login.Profile","alert","update");
		}
		
		
		
 }
 ?>