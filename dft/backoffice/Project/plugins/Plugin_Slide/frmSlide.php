<?php
require_once("Project/plugins/Plugin_Slide/Dao/Plugin_SlideDao.php");
require_once("Project/plugins/Plugin_Slide/Common/plugin_slide.php");

 class frmSlide extends TForm
 {
	 	
		function frmSlide()
		{
			$dao_submodule=new SubModuleDao();
			$o_submodule=$dao_submodule->selectAllBySystem("plugin_slide");

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
			$this->Init("frmSlide","Plugin_Slide","form-horizontal",true);
			
			$obj=$this->getdata("object_id");
			
		
			$dao=new Plugin_SlideDao();
			$o=$dao->selectById($obj);
			
			$form=new THidden();
			$form->set('slideID',$o->slideID,30,30,true,"String",false); 
			$this->add($form);

			$form=new THidden();
			$form->set('version',$o->version,30,30,true,"String",false); 
			$this->add($form);
			
			$form=new TTextBox();
			$form->set('slideTitle',$o->slideTitle,"","",true,"String",true);
			$form->setAttribute("class","form-control");
			$this->add($form);

			$form=new TTextBox();
			$form->set('slideTitleDetails',$o->slideTitleDetails,"","",true,"String",true);
			$form->setAttribute("class","form-control");
			$this->add($form);

			$form=new TInputfile();
			$form->set('slideImg',$o->slideImg,30,30,true,"String",false);
			$this->add($form);

			$form=new TTextBox();
			$form->set('slideLinkUrl',$o->slideLinkUrl,"","",true,"String",true);
			$form->setAttribute("class","form-control");
			$this->add($form);


			$pattern=new TListBox();
			$pattern->set('pattern',$o->pattern,"","",true,"String",true); 
			$pattern->additem("1","เลือกการแสดงรูปแบบที่ 1");
			$pattern->additem("2","เลือกการแสดงรูปแบบที่ 2");
			$pattern->additem("3","เลือกการแสดงรูปแบบที่ 3");
			$pattern->setAttribute("class","form-control");
			$this->add($pattern);

			
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
				$o=new plugin_slide();
				$o->slideID=$sender->getvalue('slideID');
				$o->version=$sender->getvalue('version');
				$o->slideLinkUrl=$sender->getvalue('slideLinkUrl');
				$o->slideTitle=$sender->getvalue('slideTitle');
				$o->pattern=$sender->getvalue('pattern');
				$o->slideTitleDetails=$sender->getvalue('slideTitleDetails');
					
					$userfile=$sender->getvalue('slideImg');
			
					$Datef=Date("d-m-y");
					$Timef=Date("H-i-s");
					$Datef=ereg_replace("-","",$Datef);
					$Timef=ereg_replace("-","",$Timef); 
					$Fname="fileimg_".$Datef."_".$Timef;

				$o->slideImg=uploadFileTwo(0,"./Upload/Img",$Fname,$userfile);


				
				$o->status=$sender->getvalue('status');
				$o->creationUser=$_SESSION["Session_User_UserID"];

				$dao=new Plugin_SlideDao();
				if($o->slideID)
			{
				$dao->update($o);
				Refreshs("Plugin_Slide/ShowSlide","alert","update");
				}
				else
			{
					$dao->save($o);
				Refreshs("Plugin_Slide/ShowSlide","alert","save");
					
				}
		}
 }

?>