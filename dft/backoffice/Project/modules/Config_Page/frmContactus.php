<?php
	require_once("Project/bussiness/Config_Page_ContactusDao.php");
	require_once("Project/common/config_page_contactus.php");


 class frmContactUs extends TForm
 {
	 	
		function frmContactUs()
		{
			$this->Init("frmContactUs","Config_Page","form-horizontal row-border",true);
			
			$alert=$this->getdata("alert");

				if($alert)
				{
						$alertmsg=new TLabel();
						$alertmsg->set("alertmsg",alerts($alert),"","",true,"","");
						$this->add($alertmsg);
				}


			$obj=$this->getdata("object_id");

			$dao=new Config_Page_ContactusDao();
			$o=$dao->selectAll();
			
			$pageID=new THidden();
			$pageID->set('contactusID',$o[0]->contactusID,30,30,true,"String",false); 
			$this->add($pageID);
			
			$version=new THidden();
			$version->set('version',$o[0]->version,30,30,true,"String",false); 
			$this->add($version);
			
			$form=new TTextBox();
			$form->set('companyTh',$o[0]->companyTh,"","",true,"String",true);
			$form->setAttribute("class","form-control input-width-xxlarge");
			$this->add($form);

			$form=new TTextBox();
			$form->set('companyEn',$o[0]->companyEn,"","",true,"String",true);
			$form->setAttribute("class","form-control input-width-xxlarge");
			$this->add($form);

			$form=new TTextarea();
			$form->set('addressTh',$o[0]->addressTh,"","",true,"String",true);
			$form->height="8";
			$form->setAttribute("class","form-control wysiwyg");
			$this->add($form);

			$form=new TTextarea();
			$form->set('addressEn',$o[0]->addressEn,"","",true,"String",true);
			$form->height="8";
			$form->setAttribute("class","form-control wysiwyg");
			$this->add($form);

			$form=new TTextBox();
			$form->set('fax',$o[0]->fax,"","",true,"String",true);
			$form->setAttribute("class","form-control input-width-xxlarge");
			$this->add($form);
			
			$form=new TTextBox();
			$form->set('email',$o[0]->email,"","",true,"String",true);
			$form->setAttribute("class","form-control input-width-xxlarge");
			$this->add($form);

			$form=new TTextBox();
			$form->set('fax',$o[0]->fax,"","",true,"String",true);
			$form->setAttribute("class","form-control input-width-xxlarge");
			$this->add($form);

			$form=new TTextBox();
			$form->set('phone',$o[0]->phone,"","",true,"String",true);
			$form->setAttribute("class","form-control input-width-xxlarge");
			$this->add($form);

			$form=new TTextarea();
			$form->set('contactusDetail',$o[0]->contactusDetail,"","",true,"String",false);
			$form->height="8";
			$form->setAttribute("class","form-control wysiwyg");
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
				$o=new config_page_contactus();
				$o->contactusID=$sender->getvalue('contactusID');
				$o->version=$sender->getvalue('version');
				$o->companyTh=$sender->getvalue('companyTh');
				$o->companyEn=$sender->getvalue('companyEn');
				$o->addressTh=$sender->getvalue('addressTh');
				$o->addressEn=$sender->getvalue('addressEn');
				$o->fax=$sender->getvalue('fax');
				$o->email=$sender->getvalue('email');
				$o->creationUser=$_SESSION["Session_User_UserID"];
				$o->status="Open";


				$dao=new Config_Page_ContactusDao();
				if($o->contactusID)
			{
				$dao->update($o);
				
				Refreshs("Config_Page.frmContactUs","alert","update");
			}
				else
			{
				$dao->save($o);
				Refreshs("Config_Page.frmContactUs","alert","save");
					
			}
		}
 }

?>