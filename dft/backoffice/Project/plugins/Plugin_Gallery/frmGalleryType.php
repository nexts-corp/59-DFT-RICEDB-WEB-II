<?php
require_once("Project/plugins/Plugin_Gallery/Dao/Plugin_Gallery_TypeDao.php");
require_once("Project/plugins/Plugin_Gallery/Common/plugin_gallery.php");
require_once("Project/plugins/Plugin_Gallery/Common/plugin_gallery_type.php");

 class frmGalleryType extends TForm
 {
	 	
		function frmGalleryType()
		{
			$dao_submodule=new SubModuleDao();
			$o_submodule=$dao_submodule->selectAllBySystem("plugin_gallery_type");

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
			$this->Init("frmGalleryType","Plugin_Gallery","form-horizontal",true);
			
			$obj=$this->getdata("object_id");
			
			$dao=new Plugin_Gallery_TypeDao();
			$o=$dao->selectById($obj);
			
			$form=new THidden();
			$form->set('galleryTypeID',$o->galleryTypeID,30,30,true,"String",false); 
			$this->add($form);

			$form=new THidden();
			$form->set('version',$o->version,30,30,true,"String",false); 
			$this->add($form);
			
			$form=new TTextBox();
			$form->set('galleryTypeName',$o->galleryTypeName,"","",true,"String",true);
			$form->setAttribute("class","form-control");
			$this->add($form);

		
				$form=new TTextBox();
			$form->set('galleryTypeNameEn',$o->galleryTypeNameEn,"","",true,"String",true);
			$form->setAttribute("class","form-control");
			$this->add($form);
		


			$form=new TInputfile();
			$form->set('galleryTypeImg',$o->galleryTypeImg,30,30,true,"String",false);
			$this->add($form);

			if($o->galleryTypeImg)
				{
						$form=new TLabel();
						$form->set('galleryTypeImgView',"<img src=".$o->galleryTypeImg.">",30,30,true,"String",true);
						$this->add($form);
				}

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
				$o=new plugin_gallery_type();
				$o->galleryTypeID=$sender->getvalue('galleryTypeID');
				$o->version=$sender->getvalue('version');
				$o->galleryTypeName=$sender->getvalue('galleryTypeName');
				$o->galleryTypeNameEn=$sender->getvalue('galleryTypeNameEn');
				$o->details=$sender->getvalue('details');

					$userfile=$sender->getvalue('galleryTypeImg');
			
					$Datef=Date("d-m-y");
					$Timef=Date("H-i-s");
					$Datef=ereg_replace("-","",$Datef);
					$Timef=ereg_replace("-","",$Timef); 
					$Fname="fileimg_".$Datef."_".$Timef;

				$o->galleryTypeImg=uploadFileTwo(0,"./Upload/Img",$Fname,$userfile);

				
				$o->status=$sender->getvalue('status');
				$o->creationUser=$_SESSION["Session_User_UserID"];

				$dao=new Plugin_Gallery_TypeDao();
				if($o->galleryTypeID)
			{
				$dao->update($o);
				Refreshs("Plugin_Gallery/ShowGalleryType","alert","update");
				}
				else
			{
					$dao->save($o);
				Refreshs("Plugin_Gallery/ShowGalleryType","alert","save");
					
				}
		}
 }

?>