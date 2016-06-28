<?php
	require_once("Project/bussiness/Config_Page_AboutusDao.php");
	require_once("Project/common/config_page_aboutus.php");


 class frmAboutUs extends TForm
 {
	 	
		function frmAboutUs()
		{
			$this->Init("frmAboutUs","Config_Page","form-horizontal row-border",true);
			
			$alert=$this->getdata("alert");

				if($alert)
				{
						$alertmsg=new TLabel();
						$alertmsg->set("alertmsg",alerts($alert),"","",true,"","");
						$this->add($alertmsg);
				}


			$obj=$this->getdata("1");

			$dao=new Config_Page_AboutusDao();
			$o=$dao->selectById("1");
			
			$pageID=new THidden();
			$pageID->set('aboutusID',$o->aboutusID,30,30,true,"String",false); 
			$this->add($pageID);
			
			$version=new THidden();
			$version->set('version',$o->version,30,30,true,"String",false); 
			$this->add($version);
			
			$form=new TSummereditor();
			$form->set('aboutusDetailTh',$o->aboutusDetailTh,"","",true,"String",true);
			$this->add($form);

			

			$form=new TSummereditor();
			$form->set('aboutusDetailEn',$o->aboutusDetailEn,"","",true,"String",true);
			$this->add($form);

			

				$pn=new TPanel();
				$pn->set("pn","","","",true,"","");
				$this->add($pn);






		
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
				$o=new config_page_aboutus();
				$o->aboutusID=$sender->getvalue('aboutusID');
				$o->version=$sender->getvalue('version');
				$o->aboutusDetailTh=$sender->getvalue('aboutusDetailTh');
				$o->aboutusDetailEn=$sender->getvalue('aboutusDetailEn');
				$o->status="Open";
				$o->creationUser=$_SESSION["Session_User_UserID"];



				$dao=new Config_Page_AboutusDao();
				if($o->aboutusID)
			{
				$dao->update($o);
				
				Refreshs("Config_Page.frmAboutUs","alert","update");
			}
				else
			{
				$dao->save($o);
				Refreshs("Config_Page.frmAboutUs","alert","save");
					
			}
		}
 }

?>