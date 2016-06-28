<?php
require_once("Project/plugins/Plugin_Info_Type/Dao/Plugin_Info_TypeDao.php");
require_once("Project/plugins/Plugin_Info_Type/Common/plugin_info_type.php");

 class frmInfoType extends TForm
 {
	 	
		function frmInfoType()
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
				$this->Init("frmInfoType","Plugin_Info_Type","form-horizontal row-border",true);
			
			$obj=$this->getdata("object_id");
			
			$dao=new Plugin_Info_TypeDao();
			$o=$dao->selectById($obj);
			
			$form=new THidden();
			$form->set('infoTypeID',$o->infoTypeID,30,30,true,"String",false); 
			$this->add($form);

			$version=new THidden();
			$version->set('version',$o->version,30,30,true,"String",false); 
			$this->add($version);
			
			$form=new TTextBox();
			$form->set('infoTypeName',$o->infoTypeName,"","",true,"String",true); 
			$form->setAttribute("class","form-control input-width-xxlarge");
			$form->setAttribute("placeholder","หัวข้อ");
			$this->add($form);


			$form=new TTextBox();
			$form->set('infoTypeNumber',$o->infoTypeNumber,"","",true,"String",true); 
			$form->setAttribute("class","form-control input-width-xxlarge");
			$form->setAttribute("placeholder","ลำดับการแสดงผล");
			$this->add($form);


			$form=new TTextBox();
			$form->set('url',$o->url,"","",true,"String",true); 
			$form->setAttribute("class","form-control input-width-xxlarge");
			$form->setAttribute("placeholder","ลิ้งย่อย");
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
				$o=new plugin_info_type();
				$o->infoTypeID=$sender->getvalue('infoTypeID');
				$o->version=$sender->getvalue('version');
				$o->infoTypeName=$sender->getvalue('infoTypeName');
				$o->infoTypeNumber=$sender->getvalue('infoTypeNumber');
				$o->url=$sender->getvalue('url');
				$o->status=$sender->getvalue('status');
				$o->creationUser=$_SESSION["Session_User_UserID"];

				
				
				$dao=new Plugin_Info_TypeDao();

				if($o->infoTypeID)
			{
				$dao->update($o);
				
				
				Refreshs("Plugin_Info_Type/ShowInfoType","alert","update");
			}
				else
			{
				$dao->save($o);
				Refreshs("Plugin_Info_Type/ShowInfoType","alert","save");
					
			}
		}
 }

?>