<?
require_once("Project/plugins/Plugin_New/Dao/Plugin_NewDao.php");
require_once("Project/plugins/Plugin_New/Common/plugin_new.php");

require_once("Project/plugins/Plugin_New_Type/Dao/Plugin_New_TypeDao.php");
require_once("Project/plugins/Plugin_New_Type/Common/plugin_new_type.php");

 class frmNew extends TForm
 {
	 	
		function frmNew()
		{
			$dao_submodule=new SubModuleDao();
				$o_submodule=$dao_submodule->selectAllBySystem("plugin_new");

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
				$this->Init("frmNew","Plugin_New","form-horizontal row-border",true);
			
			$obj=$this->getdata("object_id");
			
			$dao=new Plugin_NewDao();
			$o=$dao->selectById($obj);
			
			$form=new THidden();
			$form->set('newID',$o->newID,30,30,true,"String",false); 
			$this->add($form);

			$version=new THidden();
			$version->set('version',$o->version,30,30,true,"String",false); 
			$this->add($version);

			
			
			$form=new TListBox();
			$form->set('newtypeID',$o->newtypeID,"","",true,"String",true); 
				
				$dao_new_type=new Plugin_New_TypeDao();
				$o_new_type=$dao_new_type->selectAllByOpen();

			$form->addobjects($o_new_type,"newtypeID","newtypeName");
			$form->setAttribute("class","form-control");
			$this->add($form);

			$form=new TTextBox();
			$form->set('newName',$o->newName,"","",true,"String",true); 
			$form->setAttribute("class","form-control input-width-xxlarge");
			$form->setAttribute("placeholder","เพิ่มหัวข้อข่าวสาร");
			$this->add($form);

			$form=new TTextckeditor();
			$form->set('newDetail',$o->newDetail,"","",true,"String",true);
			$form->height="8";
			$form->width="";
			$form->setAttribute("placeholder","รายละเอียดงาน");
			$form->setAttribute("class","form-control wysiwyg");
			$this->add($form);

			$form=new TTextBox();
			$form->set('newNameEn',$o->newNameEn,"","",true,"String",true); 
			$form->setAttribute("class","form-control input-width-xxlarge");
			$form->setAttribute("placeholder","เพิ่มหัวข้อข่าวสาร");
			$this->add($form);

			$form=new TTextckeditor();
			$form->set('newDetailEn',$o->newDetailEn,"","",true,"String",true);
			$form->height="8";
			$form->width="";
			$form->setAttribute("placeholder","รายละเอียดงาน");
			$form->setAttribute("class","form-control wysiwyg");
			$this->add($form);

			$form=new TInputfile();
			$form->set('newImg',$o->newImg,"","",true,"String",false);
			$this->add($form);

			$form=new TInputfile();
			$form->set('newFile',$o->newFile,"","",true,"String",false);
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
				$o=new plugin_new();
				$o->newID=$sender->getvalue('newID');
				$o->version=$sender->getvalue('version');
				$o->newtypeID=$sender->getvalue('newtypeID');
				$o->newName=$sender->getvalue('newName');
				$o->newDetail=$sender->getvalue('newDetail');
				$o->newNameEn=$sender->getvalue('newNameEn');
				$o->newDetailEn=$sender->getvalue('newDetailEn');

					$newFile=$sender->getvalue('newFile');

					$userfile=$sender->getvalue('newImg');
					$Datef=Date("d-m-y");
					$Timef=Date("H-i-s");
					$Datef=ereg_replace("-","",$Datef);
					$Timef=ereg_replace("-","",$Timef); 
					$Fname="fileimg_".$Datef."_".$Timef;

				$o->newImg=uploadFile(0,"./Upload/Img",$Fname,$userfile);


					$Datef=Date("d-m-y");
					$Timef=Date("H-i-s");
					$Datef=ereg_replace("-","",$Datef);
					$Timef=ereg_replace("-","",$Timef); 
					$Fname2="fileimg_".$Datef."_".$Timef;

				$o->newFile=uploadFile(0,"./Upload/Img",$Fname2,$newFile);


				$o->status=$sender->getvalue('status');
				$o->creationUser=$_SESSION["Session_User_UserID"];
				
				$dao=new Plugin_NewDao();

				if($o->newID)
			{
				$dao->update($o);
				Refreshs("Plugin_New/ShowNew","alert","update");
			}
				else
			{
				$dao->save($o);
				Refreshs("Plugin_New/ShowNew","alert","save");
					
			}
		}
 }

?>