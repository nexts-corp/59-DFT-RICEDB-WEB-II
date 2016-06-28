<?php
	require_once("Project/bussiness/UserTypeDao.php");
	require_once("Project/common/usertype.php");

	require_once("Project/bussiness/RegisterDao.php");
	require_once("Project/common/register.php");

	require_once("Project/bussiness/UserDao.php");
	require_once("Project/common/user.php");

 class frmRegister extends TForm
 {
	 	
		function frmRegister()
		{
			$this->Init("frmRegister","Register","form-horizontal row-border",true);
			
			$obj=$this->getdata("object_id");
			
			$dao=new RegisterDao();
			$o=$dao->selectById($obj);
			
			$registerID=new THidden();
			$registerID->set('registerID',$o->registerID,30,30,true,"String",false); 
			$this->add($registerID);

			$version=new THidden();
			$version->set('version',$o->version,30,30,true,"String",false); 
			$this->add($version);
			
			$form=new TTextBox();
			$form->set('registerName',$o->registerName,30,30,true,"String",true); 
			$form->setAttribute("class","form-control input-width-xxlarge");
			$this->add($form);

			$form=new TTextBox();
			$form->set('registerPhone',$o->registerPhone,30,30,true,"Telphone",true); 
			$form->setAttribute("class","form-control input-width-xxlarge");
			$this->add($form);

			$form=new TTextBox();
			$form->set('registerEmail',$o->registerEmail,30,30,true,"Email",true); 
			$form->setAttribute("class","form-control input-width-xxlarge");
			$this->add($form);
		
			$form=new TTextarea();
			$form->set('registerAddress',$o->registerAddress,30,30,true,"String",true); 
			$form->setAttribute("class","form-control");
			$this->add($form);
			
		
			$dao_user=new UserDao();
			$o_user=$dao_user->selectByIdUser($obj);
			
			if($obj)
			{
					
					$form=new TTextBox();
					$form->set('userName',$o_user[0]->userName,30,30,false,"String",true); 
					$form->setAttribute("class","form-control input-width-xxlarge");
					$this->add($form);
			}
			else
			{
					$form=new TTextBox();
					$form->set('userName',$o->userName,30,30,true,"String",true); 
					$form->setAttribute("class","form-control input-width-xxlarge");
					$this->add($form);
			}
			
			if($obj)
			{
					
					
					$form=new TPassword();
					$form->set('userPassword',$o_user[0]->userPassword,30,30,false,"String",true); 
					$form->setAttribute("class","form-control input-width-xxlarge");
					$this->add($form);
			}
			else
			{
					$form=new TPassword();
					$form->set('userPassword',$o->userPassword,30,30,true,"String",true); 
					$form->setAttribute("class","form-control input-width-xxlarge");
					$this->add($form);
			}

			$form=new TListBox();
			$form->set('usertypeID',$o_user[0]->usertypeID,"","",true,"String",true); 
				$dao_usertype=new UserTypeDao();
				$o_usertype=$dao_usertype->selectAll();
			for($i=0;$i<count($o_usertype);$i++)
			{
				$form->additem($o_usertype[$i]->usertypeID,$o_usertype[$i]->usertypeName);
			}
			$form->setAttribute("class","form-control");
			$this->add($form);

			$form=new TCheckBox();
			$form->set('userSuper',$o_user[0]->userSuper,"","",true,"String",true); 
				$form->additem("1","ตั้งเป็นผู้ดูแลระบบ");
			$form->setAttribute("class","uniform");
			$this->add($form);


			$form=new TRadio();
			$form->set('levelSecrete',"","","",true,"String",true); 
			$form->additem("level1","ระดับที่ 1");
			$form->additem("level2","ระดับที่ 2");
			$form->additem("level3","ระดับที่ 3");
			$form->additem("level4","ระดับที่ 4");
			$form->setAttribute("class","uniform");
			$this->add($form);

			
			
			$Owner=new TTextBox();
			$Owner->set('Owner',"dft",30,30,false,"String",true);
			$Owner->setAttribute("class","form-control input-width-xxlarge");
			$this->add($Owner);

			$status=new TListBox();
			$status->set('status',$o->status,"","",true,"String",true); 
			$status->additem("Open","เปิดการใช้งาน");
			$status->additem("Close","ปิดการใช้งาน");
			$status->setAttribute("class","form-control");
			$this->add($status);
			
			
			$bn=new TButton();
			$bn->set("bn","บันทึกข้อมูล","","",true,"String",true);
			$bn->setEvent("onclick","frmAction");
			$bn->setAttribute("class","btn btn-primary");
			$this->Add($bn);

			$bnreset=new TResets();
			$bnreset->set("bnreset","ล้างข้อมูล","","",true,"String",true);
			$bnreset->setAttribute("class","btn");
			$this->Add($bnreset);

			$this->waitevent();
		}
		function frmAction($parameter,$sender)
		{
				$o=new register();
				$o->registerID=$sender->getvalue('registerID');
				$o->version=$sender->getvalue('version');
				$o->registerName=$sender->getvalue('registerName');
				$o->registerAddress=$sender->getvalue('registerAddress');
				$o->registerPhone=$sender->getvalue('registerPhone');
				$o->registerEmail=$sender->getvalue('registerEmail');
				$o->configgroupUID=$sender->getvalue('configgroupUID');
				$o->status=$sender->getvalue('status');
				$o->creationUser=$_SESSION["Session_User_UserID"];

				$dao=new RegisterDao();
				if($o->registerID)
			{
				$dao->update($o);
				
					$o_user=new user();
					$dao_user=new UserDao();
					$o_chkuser=$dao_user->selectByIdUser($o->registerID);
					$o_user->userID=$o_chkuser[0]->userID;
					$o_user->version=$o_chkuser[0]->version;
					$o_user->userSuper=$sender->getvalue('userSuper');
					$o_user->usertypeID=$sender->getvalue('usertypeID');
					$o_user->Owner="dft";
						$dao_user->update($o_user);
				Refreshs("Register.ShowRegister","alert","update");
				}
				else
			{
					$dao->save($o);

						$o_user=new user();
						$o_user->userName=$sender->getvalue('userName');
						$o_user->registerID=$o->registerID;
						$o_user->userPassword=md5($sender->getvalue('userPassword'));
						$o_user->password=$sender->getvalue('userPassword');
						$o_user->usertypeID=$sender->getvalue('usertypeID');
						$o_user->userSuper=$sender->getvalue('userSuper');
						$o_user->Owner="dft";
						$o_user->creationUser=$_SESSION["Session_User_UserID"];
						$o_user->status=$sender->getvalue('status');
							$dao_user=new UserDao();
								$dao_user->saves($o_user);

				Refreshs("Register.ShowRegister","alert","save");
				
				}
		}
 }

?>