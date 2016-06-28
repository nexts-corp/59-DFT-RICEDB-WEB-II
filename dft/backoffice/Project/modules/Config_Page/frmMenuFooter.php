<?php
require_once("Project/bussiness/Config_Page_Menu_FooterDao.php");
require_once("Project/common/config_page_menu_footer.php");

 class frmMenuFooter extends TForm
 {
	 	
		function frmMenuFooter()
		{
			$this->Init("frmMenuFooter","Config_Page","form-horizontal",true);
			
			$obj=$this->getdata("object_id");
			
			$dao=new Config_Page_Menu_FooterDao();
			$o=$dao->selectById($obj);
			
			$menufooterID=new THidden();
			$menufooterID->set('menufooterID',$o->menufooterID,30,30,true,"String",false); 
			$this->add($menufooterID);
			
			$version=new THidden();
			$version->set('version',$o->version,30,30,true,"String",false); 
			$this->add($version);
			
			$form=new TListBox();
			$form->set('menufooterType',$o->menufooterType,"","",true,"String",true); 
			$form->additem("Linkin","แสดงเนื้อหา");
			$form->additem("Linkout","ลิงค์ภายนอก");
			$form->setAttribute("class","form-control");
			$this->add($form);
			
			$form=new TTextBox();
			$form->set('menufooterLink',$o->menufooterLink,30,30,true,"String",true); 
			$form->setAttribute("class","form-control input-width-xxlarge");
			$this->add($form);

			$form=new TTextBox();
			$form->set('menufooterName',$o->menufooterName,30,30,true,"String",true); 
			$form->setAttribute("class","form-control input-width-xxlarge");
			$this->add($form);

			$form=new TTextBox();
			$form->set('menufooterNameEn',$o->menufooterNameEn,30,30,true,"String",false); 
			$form->setAttribute("class","form-control input-width-xxlarge");
			$this->add($form);


			$form=new TSummereditor();
			$form->set('menufooterDetail',$o->menufooterDetail,"","",true,"String",true);
			$this->add($form);

			$form=new TSummereditor();
			$form->set('menufooterDetailEn',$o->menufooterDetailEn,"","",true,"String",true);
			$this->add($form);


			$form=new TTextBox();
			$form->set('menufooterNumber',$o->menufooterNumber,"2","2",true,"String",false); 
			$form->setAttribute("class","form-control input-width-mini");
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
				$o=new config_page_menu_footer();
				$o->menufooterID=$sender->getvalue('menufooterID');
				$o->version=$sender->getvalue('version');
				$o->menufooterType=$sender->getvalue('menufooterType');
				$o->menufooterLink=$sender->getvalue('menufooterLink');
				$o->menufooterName=$sender->getvalue('menufooterName');
				$o->menufooterNameEn=$sender->getvalue('menufooterNameEn');
				$o->menufooterDetail=$sender->getvalue('menufooterDetail');
				$o->menufooterDetailEn=$sender->getvalue('menufooterDetailEn');
				$o->menufooterNumber=$sender->getvalue('menufooterNumber');
			
				
				$o->status=$sender->getvalue('status');
				$o->creationUser=$_SESSION["Session_User_UserID"];
				
				$dao=new Config_Page_Menu_FooterDao();

				if($o->menufooterID)
			{

				$dao->update($o);
				
				Refreshs("Config_Page.ShowMenuFooter","alert","update");
			}
				else
			{
				$dao->save($o);
				Refreshs("Config_Page.ShowMenuFooter","alert","save");
					
			}
		}
 }

?>