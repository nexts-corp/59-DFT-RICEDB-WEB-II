<?php
require_once("Project/bussiness/Config_Page_Menu_BarDao.php");
require_once("Project/common/config_page_menu_bar.php");

 class frmMenuBar extends TForm
 {
	 	
		function frmMenuBar()
		{
			$this->Init("frmMenuBar","Config_Page","form-horizontal row-border",true);
			
			$obj=$this->getdata("object_id");
			
			$dao=new Config_Page_Menu_BarDao();
			$o=$dao->selectById($obj);
			
			$menubarID=new THidden();
			$menubarID->set('menubarID',$o->menubarID,30,30,true,"String",false); 
			$this->add($menubarID);
			
		
			$version=new THidden();
			$version->set('version',$o->version,30,30,true,"String",false); 
			$this->add($version);
			
			$form=new TListBox();
			$form->set('menubarType',$o->menubarType,"","",true,"String",true); 
			$form->additem("Linkin","แสดงเนื้อหา");
			$form->additem("Linkout","ลิงค์ภายนอก");
			$form->additem("SubMenu","ลิงค์หลัก");
			$form->additem("Plugin","ปลั๊กอิน");
			$form->setAttribute("class","form-control");
			$this->add($form);

			$form=new TTextBox();
			$form->set('menubarName',$o->menubarName,"","",true,"String",true); 
			$form->setAttribute("class","form-control input-width-xxlarge");
			$this->add($form);

			$form=new TTextBox();
			$form->set('pluginName',$o->pluginName,"","",true,"String",false); 
			$form->setAttribute("class","form-control input-width-xxlarge");
			$this->add($form);

			$form=new TTextBox();
			$form->set('menubarLink',$o->menubarLink,"","",true,"String",false); 
			$form->setAttribute("class","form-control input-width-xxlarge");
			$this->add($form);

		

			$form=new TSummereditor();
			$form->set('menubarDetail',$o->menubarDetail,"","",true,"String",true);
			$this->add($form);

			$form=new TSummereditor();
			$form->set('menubarDetailEn',$o->menubarDetailEn,"","",true,"String",true);
			$this->add($form);

			

			$form=new TTextBox();
			$form->set('menubarNumber',$o->menubarNumber,"2","2",true,"String",false); 
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
				$o=new config_page_menu_bar();
				$o->menubarID=$sender->getvalue('menubarID');
				$o->version=$sender->getvalue('version');
				$o->menubarType=$sender->getvalue('menubarType');
				$o->menubarName=$sender->getvalue('menubarName');
				
				$o->menubarLink=$sender->getvalue('menubarLink');
				$o->menubarDetail=$sender->getvalue('menubarDetail');
		
				$o->menubarNumber=$sender->getvalue('menubarNumber');
				$o->pluginName=$sender->getvalue('pluginName');
				

				$o->status=$sender->getvalue('status');
				$o->creationUser=$_SESSION["Session_User_UserID"];
				
				$dao=new Config_Page_Menu_BarDao();

				if($o->menubarID)
			{

				$dao->update($o);
				
				Refreshs("Config_Page.ShowMenuBar","alert","update");
			}
				else
			{
				$dao->save($o);
				Refreshs("Config_Page.ShowMenuBar","alert","save");
					
			}
		}
 }

?>