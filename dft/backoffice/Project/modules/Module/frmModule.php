<?php
	require_once("Project/bussiness/ModuleDao.php");
	require_once("Project/common/module.php");

	require_once("Project/bussiness/UserTypeDao.php");
	require_once("Project/common/usertype.php");

	require_once("Project/bussiness/PermissDao.php");
	require_once("Project/common/permiss.php");
	
	require_once("Project/bussiness/SubModuleDao.php");
	require_once("Project/common/submodule.php");

 class frmModule extends TForm
 {
	 	
		function frmModule()
		{
			$this->Init("frmModule","Module","form-horizontal row-border",true);
			
			$obj=$this->getdata("object_id");
			
			$dao=new ModuleDao();
			$o=$dao->selectById($obj);
			
			$moduleID=new THidden();
			$moduleID->set('moduleID',$o->moduleID,30,30,true,"String",false); 
			$this->add($moduleID);

			$version=new THidden();
			$version->set('version',$o->version,30,30,true,"String",false); 
			$this->add($version);
			
			$form=new TTextBox();
			$form->set('moduleSystem',$o->moduleSystem,"","",true,"String",true); 
			$form->setAttribute("class","form-control input-width-xxlarge");
			$form->setAttribute("placeholder","ชื่อโมดูลของระบบ");
			$this->add($form);

			$form=new TTextBox();
			$form->set('moduleName',$o->moduleName,"","",true,"String",true); 
			$form->setAttribute("class","form-control input-width-xxlarge");
			$form->setAttribute("placeholder","ชื่อโมดูล");
			$this->add($form);

			$form=new TTextBox();
			$form->set('moduleSequence',$o->moduleSequence,"","",true,"String",true); 
			$form->setAttribute("class","form-control input-width-mini");
			$this->add($form);
			
			$form=new TTextarea();
			$form->set('moduleDetail',$o->moduleDetail,30,30,true,"String",true); 
			$form->setAttribute("class","form-control");
			$this->add($form);
			
			$form=new TCheckBox();
			$form->set('modulePosition',$o->modulePosition,"","",true,"String",false);
			$form->additem("Top","ด้านบน");
			$form->additem("Left","ด้านซ้าย");
			$form->setAttribute("class","uniform");
			$this->add($form);

			$form=new TCheckBox();
			$form->set('usertypeID',$o->usertypeID,30,30,true,"String",true); 
			$dao_usertype=new UserTypeDao();
			$o_usertype=$dao_usertype->selectAll();
			$form->addobjects($o_usertype,"usertypeID","usertypeName");
			$form->setAttribute("class","uniform");
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
				$o=new module();
				$o->moduleID=$sender->getvalue('moduleID');
				$o->version=$sender->getvalue('version');
				$o->moduleSystem=$sender->getvalue('moduleSystem');
				$o->moduleName=$sender->getvalue('moduleName');
				$o->moduleDetail=$sender->getvalue('moduleDetail');
				
				$usertypeID=$sender->getvalue('usertypeID');
				for($i=0;$i<count($usertypeID);$i++)
					{
						if(($i+1)==count($usertypeID))
						$usertype.=$usertypeID[$i];
						else
						$usertype.=$usertypeID[$i].",";
					}
				$o->usertypeID=$usertype;

				$modulePosition=$sender->getvalue('modulePosition');
				for($i=0;$i<count($modulePosition);$i++)
					{
						if(($i+1)==count($modulePosition))
						$Position.=$modulePosition[$i];
						else
						$Position.=$modulePosition[$i].",";
					}
				$o->modulePosition=$Position;
				$o->moduleSequence=$sender->getvalue('moduleSequence');

				$o->status=$sender->getvalue('status');
				$o->creationUser=$_SESSION["Session_User_UserID"];
				
				$dao=new ModuleDao();
				$dao_submodule=new SubModuleDao();
				$dao_per=new PermissDao();

				if($o->moduleID)
			{
				$dao->update($o);
				
				
				Refreshs("Module.ShowModule","alert","update");
			}
				else
			{
				$dao->save($o);
				Refreshs("Module.ShowModule","alert","save");
					
			}
		}
 }

?>