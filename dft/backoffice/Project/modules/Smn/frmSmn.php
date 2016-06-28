<?php
require_once("Project/plugins/Plugin_AcademicPositions/Dao/Plugin_Academic_PositionsDao.php");
require_once("Project/plugins/Plugin_AcademicPositions/Common/plugin_academic_positions.php");


 class frmAcademicPositions extends TForm
 {
	 	
		function frmAcademicPositions()
		{
			$dao_submodule=new SubModuleDao();
			$o_submodule=$dao_submodule->selectAllBySystem("plugin_academic_positions");

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
			$this->Init("frmAcademicPositions","Plugin_AcademicPositions","form-horizontal",true);
			
			$obj=$this->getdata("object_id");
			
			$dao=new Plugin_Academic_PositionsDao();
			$o=$dao->selectById($obj);
			
			$form=new THidden();
			$form->set('AcademicPositionsID',$o->AcademicPositionsID,30,30,true,"String",false); 
			$this->add($form);

			$form=new THidden();
			$form->set('version',$o->version,30,30,true,"String",false); 
			$this->add($form);
			
			$form=new TTextBox();
			$form->set('AcademicPositionsName',$o->AcademicPositionsName,500,500,true,"String",true);
			$form->setAttribute("class","form-control");
			$this->add($form);

			$form=new TTextBox();
			$form->set('AcademicPositionsNameEn',$o->AcademicPositionsNameEn,500,500,true,"String",true);
			$form->setAttribute("class","form-control");
			$this->add($form);

			

			$status=new TListBox();
			$status->set('status',$o->status,"","",true,"String",true); 
			$status->additem("Open","เปิดการใช้งาน");
			$status->additem("Close","ปิดการใช้งาน");
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
				$o=new plugin_academic_positions();
				$o->AcademicPositionsID=$sender->getvalue('AcademicPositionsID');
				$o->version=$sender->getvalue('version');
				$o->AcademicPositionsName=$sender->getvalue('AcademicPositionsName');
				$o->AcademicPositionsNameEn=$sender->getvalue('AcademicPositionsNameEn');

					$userfile=$sender->getvalue('AcademicPositionsImg');
			
					$Datef=Date("d-m-y");
					$Timef=Date("H-i-s");
					$Datef=ereg_replace("-","",$Datef);
					$Timef=ereg_replace("-","",$Timef); 
					$Fname="fileimg_".$Datef."_".$Timef;


				
				$o->status=$sender->getvalue('status');
				$o->creationUser=$_SESSION["Session_User_UserID"];

				$dao=new Plugin_Academic_PositionsDao();
				if($o->AcademicPositionsID)
			{
				$dao->update($o);
				Refreshs("Plugin_AcademicPositions/ShowAcademicPositions","alert","update");
				}
				else
			{
					$dao->save($o);
				Refreshs("Plugin_AcademicPositions/ShowAcademicPositions","alert","save");
					
				}
		}
 }

?>