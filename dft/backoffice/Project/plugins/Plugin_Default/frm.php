<?
require_once("Project/plugins/Plugin_New_Type/Dao/Plugin_New_TypeDao.php");
require_once("Project/plugins/Plugin_New_Type/Common/plugin_new_type.php");

 class frmNewType extends TForm
 {
	 	
		function frmNewType()
		{
			$dao_submodule=new SubModuleDao();
				$o_submodule=$dao_submodule->selectAllBySystem("plugin_new_type");

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
				$this->Init("frmNewType","Plugin_New_Type","form-horizontal row-border",true);
			
			$obj=$this->getdata("object_id");
			
			$dao=new Plugin_New_TypeDao();
			$o=$dao->selectById($obj);
			
			$form=new THidden();
			$form->set('newtypeID',$o->newtypeID,30,30,true,"String",false); 
			$this->add($form);

			$version=new THidden();
			$version->set('version',$o->version,30,30,true,"String",false); 
			$this->add($version);
			
			$form=new TTextBox();
			$form->set('newtypeName',$o->newtypeName,"","",true,"String",true); 
			$form->setAttribute("class","form-control input-width-xxlarge");
			$form->setAttribute("placeholder","ประเภทข่าวสาร");
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
				$o=new plugin_new_type();
				$o->newtypeID=$sender->getvalue('newtypeID');
				$o->version=$sender->getvalue('version');
				$o->newtypeName=$sender->getvalue('newtypeName');

				$o->status=$sender->getvalue('status');
				$o->creationUser=$_SESSION["Session_User_UserID"];
				
				$dao=new Plugin_New_TypeDao();

				if($o->newtypeID)
			{
				$dao->update($o);
				
				
				Refreshs("Plugin_New_Type/ShowNewType","alert","update");
			}
				else
			{
				$dao->save($o);
				Refreshs("Plugin_New_Type/ShowNewType","alert","save");
					
			}
		}
 }

?>