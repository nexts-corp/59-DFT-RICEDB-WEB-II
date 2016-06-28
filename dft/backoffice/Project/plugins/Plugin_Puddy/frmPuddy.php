<?php
require_once("Project/plugins/Plugin_Puddy/Dao/Plugin_PuddyDao.php");
require_once("Project/plugins/Plugin_Puddy/Common/plugin_puddy.php");


 class frmPuddy extends TForm
 {
	 	
		function frmPuddy()
		{
			$dao_submodule=new SubModuleDao();
				$o_submodule=$dao_submodule->selectAllBySystem("plugin_info_type");

					$form=new TLabel();
					$form->set("submoduleName",$o_submodule[0]->submoduleName,"","",true,"","");
					$this->add($form);

					$form=new TLabel();
					$form->set("submoduleDetail",$o_submodule[0]->submoduleDetail,"","",true,"","");
					$this->add($form);

					$form=new TLabel();
					$form->set("submoduleUrl",$o_submodule[0]->submoduleUrl,"","",true,"","");
					$this->add($form);

			$dao_per=new PermissDao();
				$o_per=$dao_per->selectAllByPermiss($o_submodule[0]->submoduleID,$_SESSION["Session_User_UsertypeID"]);
				
			if($o_per[0]->permissAdd=="true")
				$this->Init("frmPuddy","Plugin_Puddy","form-horizontal row-border",true);
			
			$obj=$this->getdata("object_id");
			
			
			$dao=new Plugin_PuddyDao();
			$o=$dao->selectById($obj);
			
			$form=new THidden();
			$form->set('puddyID',$o->puddyID,30,30,true,"String",false); 
			$this->add($form);

			$version=new THidden();
			$version->set('version',$o->version,30,30,true,"String",false); 
			$this->add($version);


			$form=new TTextBox();
			$form->set('puddyName',$o->puddyName,"","",true,"String",true); 
			$form->setAttribute("class","form-control ");
			$form->setAttribute("placeholder","หัวข้อ");
			$this->add($form);

			$form=new TTextBox();
			$form->set('startDate',$o->startDate,"","",true,"String",true); 
			$form->setAttribute("class","form-control cDate");
			$form->setAttribute("placeholder","เริ่มวันที่");
			$this->add($form);


			$form=new TTextBox();
			$form->set('endDate',$o->endDate,"","",true,"String",true); 
			$form->setAttribute("class","form-control cDate");
			$form->setAttribute("placeholder","สิ้นสุดวันที่");
			$this->add($form);


			$form=new TListBox();
			$form->set('status',$o->status,"","",true,"String",true); 
			$form->additem("Open","เปิดการใช้งาน");
			$form->additem("Close","ปิดการใช้งาน");
			$form->setAttribute("class","form-control");
			$this->add($form);
			
			
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
				$o=new plugin_puddy();
				$o->puddyID=$sender->getvalue('puddyID');
				$o->version=$sender->getvalue('version');
				$o->infoTypeID=$_SESSION["Session_infoTypeID"];
				$o->puddyName=$sender->getvalue('puddyName');
				$o->startDate=$sender->getvalue('startDate');
				$o->endDate=$sender->getvalue('endDate');
				
				$o->status=$sender->getvalue('status');
				$o->creationUser=$_SESSION["Session_User_UserID"];
				
				$dao=new Plugin_PuddyDao();

				if($o->puddyID)
			{
				$dao->update($o);
				Refreshs("Plugin_Puddy/ShowPuddy","alert","update");
			}
			
				

				$dao->save($o);
				Refreshs("Plugin_Puddy/ShowPuddy","alert","save");
					
			
		}
 }

?>