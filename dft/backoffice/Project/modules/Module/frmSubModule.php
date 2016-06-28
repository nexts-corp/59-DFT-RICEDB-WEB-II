<?php
require_once("Project/bussiness/ModuleDao.php");
require_once("Project/common/module.php");

require_once("Project/bussiness/SubModuleDao.php");
require_once("Project/common/submodule.php");

require_once("Project/bussiness/UserTypeDao.php");
require_once("Project/common/usertype.php");

require_once("Project/bussiness/PermissDao.php");
require_once("Project/common/permiss.php");

 class frmSubModule extends TForm
 {
	 	
		function frmSubModule()
		{
			$this->Init("frmSubModule","Module","form-horizontal row-border",true);
			
			$obj=$this->getdata("object_id");
			
			$module=$this->getdata("moduleID");

			$dao_module=new ModuleDao();
				$o_module=$dao_module->selectById($module);

						$moduleName=new TLabel();
						$moduleName->set("moduleName",$o_module->moduleName,"","",true,"","");
						$this->add($moduleName);

						$moduleIDView=new TLabel();
						$moduleIDView->set("moduleIDView",$o_module->moduleID,"","",true,"","");
						$this->add($moduleIDView);

			$dao=new SubModuleDao();
			$o_submodule=$dao->selectById($obj);

				$moduleID=new THidden();
				$moduleID->set('moduleID',$module,30,30,true,"String",false); 
				$this->add($moduleID);
				
				$submoduleID_=new THidden();
				$submoduleID_->set('submoduleID_',$o_submodule->submoduleID,30,30,true,"String",false); 
				$this->add($submoduleID_);

				$version=new THidden();
				$version->set('version',$o_submodule->version,30,30,true,"String",false); 
				$this->add($version);

				$form=new TTextBox();
				$form->set('submoduleSystem',$o_submodule->submoduleSystem,"","",true,"String",true); 
				$form->setAttribute("class","form-control input-width-xxlarge");
				$this->add($form);
				
				$form=new TTextBox();
				$form->set('submoduleName',$o_submodule->submoduleName,"","",true,"String",true); 
				$form->setAttribute("class","form-control input-width-xxlarge");
				$this->add($form);
				
				$form=new TTextBox();
				$form->set('submoduleEmo',$o_submodule->submoduleEmo,100,30,true,"String",false); 
				$form->setAttribute("class","form-control input-width-xxlarge");
				$this->add($form);

				$form=new TTextBox();
				$form->set('submoduleNumber',$o_submodule->submoduleNumber,30,30,true,"String",false); 
				$form->setAttribute("class","form-control input-width-xxlarge");
				$this->add($form);

				$form=new TTextBox();
				$form->set('submoduleUrl',$o_submodule->submoduleUrl,100,30,true,"String",true); 
				$form->setAttribute("class","form-control input-width-xxlarge");
				$this->add($form);

				$form=new TTextarea();
				$form->set('submoduleDetail',$o_submodule->submoduleDetail,"","",true,"String",true); 
				$form->setAttribute("class","form-control");
				$this->add($form);

				$status=new TListBox();
				$status->set('status',$o_submodule->status,"","",true,"String",true); 
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
				$o=new submodule();
				$o->submoduleID=$sender->getvalue('submoduleID_');
				$o->version=$sender->getvalue('version');
				$o->submoduleSystem=$sender->getvalue('submoduleSystem');
				$o->moduleID=$sender->getvalue('moduleID');
				$o->submoduleSystem=$sender->getvalue('submoduleSystem');
				$o->submoduleName=$sender->getvalue('submoduleName');
				$o->submoduleEmo=$sender->getvalue('submoduleEmo');
				$o->submoduleNumber=$sender->getvalue('submoduleNumber');
				$o->submoduleUrl=$sender->getvalue('submoduleUrl');
				$o->submoduleDetail=$sender->getvalue('submoduleDetail');
				$o->status=$sender->getvalue('status');
				$o->creationUser=$_SESSION["Session_User_UserID"];

				$dao=new SubModuleDao();
				if($o->submoduleID)
			{
				$dao->update($o);
					Refreshs("Module.ShowSubModule&moduleID=$o->moduleID","alert","update");
				}
				else
			{
				$dao->save($o);
					Refreshs("Module.ShowSubModule&moduleID=$o->moduleID","alert","save");
				}
		}
 }

?>