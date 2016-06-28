<?php
require_once("Project/bussiness/Config_Page_Menu_Bar_SubDao.php");
require_once("Project/common/config_page_menu_bar_sub.php");

 class frmMenuBarSub extends TForm
 {
	 	
		function frmMenuBarSub()
		{
			$this->Init("frmMenuBarSub","Config_Page","form-horizontal row-border",true);
			
			$obj=$this->getdata("object_id");
			$menubarID=$this->getdata("menubarID");

			$dao=new Config_Page_Menu_Bar_SubDao();
			$o=$dao->selectById($obj);
			
			$form=new TLabel();
			$form->set('menubarID',$menubarID,30,30,true,"String",false); 
			$this->add($form);

			$form=new THidden();
			$form->set('menubarsubID',$o->menubarsubID,30,30,true,"String",false); 
			$this->add($form);
			
			$version=new THidden();
			$version->set('version',$o->version,30,30,true,"String",false); 
			$this->add($version);
			
			$form=new TListBox();
			$form->set('menubarsubType',$o->menubarsubType,"","",true,"String",true); 
			$form->additem("Linkin","แสดงเนื้อหา");
			$form->additem("Linkout","ลิงค์ภายนอก");
			$form->setAttribute("class","form-control");
			$this->add($form);
			
			$form=new TTextBox();
			$form->set('menubarsubLink',$o->menubarsubLink,"","",true,"String",false); 
			$form->setAttribute("class","form-control input-width-xxlarge");
			$this->add($form);

			$form=new TTextBox();
			$form->set('menubarsubName',$o->menubarsubName,"","",true,"String",true); 
			$form->setAttribute("class","form-control input-width-xxlarge");
			$this->add($form);

			$form=new TTextBox();
			$form->set('menubarsubNameEn',$o->menubarsubNameEn,"","",true,"String",false); 
			$form->setAttribute("class","form-control input-width-xxlarge");
			$this->add($form);

			$menubarDetail=new TSummereditor();
			$menubarDetail->set('menubarsubDetail',$o->menubarsubDetail,"","",true,"String",true); 
			$this->add($menubarDetail);

			$menubarDetailEn=new TSummereditor();
			$menubarDetailEn->set('menubarsubDetailEn',$o->menubarsubDetailEn,"","",true,"String",true); 
			$this->add($menubarDetailEn);

			$form=new TTextBox();
			$form->set('menubarsubNumber',$o->menubarsubNumber,"2","2",true,"String",false); 
			$form->setAttribute("class","form-control input-width-mini");
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
				$o=new config_page_menu_bar_sub();
				$o->menubarsubID=$sender->getvalue('menubarsubID');
				$o->version=$sender->getvalue('version');
				$o->menubarID=$sender->getvalue('menubarID');
				$o->menubarsubType=$sender->getvalue('menubarsubType');
				$o->menubarsubLink=$sender->getvalue('menubarsubLink');
				$o->menubarsubName=$sender->getvalue('menubarsubName');
				$o->menubarsubNameEn=$sender->getvalue('menubarsubNameEn');
				$o->menubarsubDetail=$sender->getvalue('menubarsubDetail');
				$o->menubarsubDetailEn=$sender->getvalue('menubarsubDetailEn');
				$o->menubarsubNumber=$sender->getvalue('menubarsubNumber');
				

				$o->status=$sender->getvalue('status');
				$o->creationUser=$_SESSION["Session_User_UserID"];
				
				$dao=new Config_Page_Menu_Bar_SubDao();

				if($o->menubarsubID)
			{

				$dao->update($o);
				
				Refreshs("Config_Page.ShowMenuBarSub&menubarID=$o->menubarID","alert","update");
			}
				else
			{
				$dao->save($o);
				Refreshs("Config_Page.ShowMenuBarSub&menubarID=$o->menubarID","alert","save");
					
			}
		}
 }

?>