<?php
	require_once("Project/bussiness/Config_PageDao.php");
	require_once("Project/common/config_page.php");


 class frmConfigPage extends TForm
 {
	 	
		function frmConfigPage()
		{
			$this->Init("frmConfigPage","Config_Page","form-horizontal row-border",true);
			
			$alert=$this->getdata("alert");

				if($alert)
				{
						$alertmsg=new TLabel();
						$alertmsg->set("alertmsg",alerts($alert),"","",true,"","");
						$this->add($alertmsg);
				}


			$obj=$this->getdata("object_id");

			$dao=new Config_PageDao();
			$o=$dao->selectAllweb("1");
			
			$pageID=new THidden();
			$pageID->set('pageID',$o[0]->pageID,30,30,true,"String",false); 
			$this->add($pageID);
			
			$version=new THidden();
			$version->set('version',$o[0]->version,30,30,true,"String",false); 
			$this->add($version);
			
			$pageWebTitle=new TTextBox();
			$pageWebTitle->set('pageWebTitle',$o[0]->pageWebTitle,"","",true,"String",true);
			$pageWebTitle->setAttribute("class","form-control input-width-xxlarge");
			$this->add($pageWebTitle);

			$pageKeyword=new TTextBox();
			$pageKeyword->set('pageKeyword',$o[0]->pageKeyword,"","",true,"String",true); 
			$pageKeyword->setAttribute("class","form-control input-width-xxlarge");
			$this->add($pageKeyword);

			$pageDescription=new TTextarea();
			$pageDescription->set('pageDescription',$o[0]->pageDescription,"","",true,"String",true);
			$pageDescription->height="8";
			$pageDescription->setAttribute("class","form-control");
			$this->add($pageDescription);
			
			$pageLogo=new TInputfile();
			$pageLogo->set('pageLogo',$o[0]->pageLogo,30,30,true,"String",false);
			$pageLogo->setAttribute("data-style","fileinput");
			$this->add($pageLogo);

			$pageBanner=new TInputfile();
			$pageBanner->set('pageBanner',$o[0]->pageBanner,30,30,true,"String",false);
			$pageBanner->setAttribute("data-style","fileinput");
			$this->add($pageBanner);

			$pageFavicon=new TInputfile();
			$pageFavicon->set('pageFavicon',$o[0]->pageFavicon,30,30,true,"String",false);
			$pageFavicon->setAttribute("data-style","fileinput");
			$this->add($pageFavicon);

			$form=new TTextarea();
			$form->set('pageGoogleAnalytic',$o[0]->pageGoogleAnalytic,"","",true,"String",false);
			$form->height="8";
			$form->setAttribute("class","form-control");
			$this->add($form);

			$form=new TTextarea();
			$form->set('pageFacebookFanpage',$o[0]->pageFacebookFanpage,"","",true,"String",false);
			$form->height="8";
			$form->setAttribute("class","form-control");
			$this->add($form);

			$LineID=new TTextBox();
			$LineID->set('LineID',$o[0]->LineID,"","",true,"String",true); 
			$LineID->setAttribute("class","form-control input-width-xxlarge");
			$this->add($LineID);

			$QrCode=new TInputfile();
			$QrCode->set('QrCode',$o[0]->QrCode,30,30,true,"String",false);
			$QrCode->setAttribute("data-style","fileinput");
			$this->add($QrCode);

			if($o[0]->QrCode){

						$QrCodeView=new TLabel();
						$QrCodeView->set("QrCodeView","<img src=".$o[0]->QrCode.">","","",true,"","");
						$this->add($QrCodeView);

			}

			$webName=new TTextBox();
			$webName->set('webName',$o[0]->webName,"","",true,"String",true); 
			$webName->setAttribute("class","form-control input-width-xxlarge");
			$this->add($webName);
		

			$LinkInstagram=new TTextBox();
			$LinkInstagram->set('LinkInstagram',$o[0]->LinkInstagram,"","",true,"String",true); 
			$LinkInstagram->setAttribute("class","form-control input-width-xxlarge");
			$this->add($LinkInstagram);

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
				$o=new config_page();
				$o->pageID=$sender->getvalue('pageID');
				$o->version=$sender->getvalue('version');
				$o->pageWebTitle=$sender->getvalue('pageWebTitle');
				$o->pageWebTitleEn=$sender->getvalue('pageWebTitleEn');
				$o->pageKeyword=$sender->getvalue('pageKeyword');
				$o->pageKeywordEn=$sender->getvalue('pageKeywordEn');
				$o->pageDescription=$sender->getvalue('pageDescription');
				$o->pageDescriptionEn=$sender->getvalue('pageDescriptionEn');
				$o->pageGoogleAnalytic=$sender->getvalue('pageGoogleAnalytic');



				$dao=new Config_PageDao();
				if($o->pageID)
			{
				$dao->update($o);
				
				Refreshs("Config_Page.frmConfigPage","alert","update");
			}
				else
			{
				$dao->save($o);
				Refreshs("Config_Page.frmConfigPage","alert","save");
					
			}
		}
 }

?>