<?php
	require_once("Project/bussiness/UserTypeDao.php");
	require_once("Project/common/usertype.php");

 class frmUserType extends TForm
 {
	 	
		function frmUserType()
		{
			$this->Init("frmUserType","Register","form-horizontal row-border",true);
			
			$obj=$this->getdata("object_id");
			
			$dao=new UserTypeDao();
			$o=$dao->selectById($obj);
			
			$usertypeID=new THidden();
			$usertypeID->set('usertypeID',$o->usertypeID,30,30,true,"String",false); 
			$this->add($usertypeID);

			$version=new THidden();
			$version->set('version',$o->version,30,30,true,"String",false); 
			$this->add($version);
			
			$form=new TTextBox();
			$form->set('usertypeName',$o->usertypeName,30,30,true,"String",true); 
			$form->setAttribute("placeholder","ประเภทผู้ใช้งาน");
			$form->setAttribute("class","form-control input-width-xxlarge");
			$this->add($form);

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
				$o=new usertype();
				$o->usertypeID=$sender->getvalue('usertypeID');
				$o->version=$sender->getvalue('version');
				$o->usertypeName=$sender->getvalue('usertypeName');
				$o->status=$sender->getvalue('status');
				$o->creationUser=$_SESSION["Session_User_UserID"];

				$dao=new UserTypeDao();
				if($o->usertypeID)
			{
				$dao->update($o);
				Refreshs("Register.ShowUserType","alert","update");
				}
				else
			{
					$dao->save($o);
				Refreshs("Register.ShowUserType","alert","save");
					
				}
		}
 }

?>