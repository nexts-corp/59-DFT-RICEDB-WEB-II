<?php


require_once("Project/plugins/Plugin_Gallery/Dao/Plugin_GalleryDao.php");
require_once("Project/plugins/Plugin_Gallery/Common/plugin_gallery.php");

 class frmGallery extends TForm
 {
	 	
		function frmGallery()
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
			$this->Init("frmGallery","Plugin_Gallery","form-horizontal",true);
			
			$obj=$this->getdata("object_id");
			$galleryTypeID=$this->getdata("galleryTypeID");
		
			$dao=new Plugin_GalleryDao();
			$o=$dao->selectById($obj);
			
			$form=new THidden();
			$form->set('galleryID',$o->galleryID,30,30,true,"String",false); 
			$this->add($form);

				$form=new THidden();
			$form->set('galleryTypeID',$galleryTypeID,30,30,true,"String",false); 
			$this->add($form);
			

			// $form=new TTextBox();
			// $form->set('galleryName',$o->galleryName,500,500,true,"String",false);
			// $form->setAttribute("class","form-control");
			// $this->add($form);


			// $form=new TTextBox();
			// $form->set('galleryNameEn',$o->galleryNameEn,500,500,true,"String",false);
			// $form->setAttribute("class","form-control");
			// $this->add($form);
		
				
			$form=new THidden();
			$form->set('version',$o->version,30,30,true,"String",false); 
			$this->add($form);
			

			$form=new TInputfilemulti();
			$form->set('galleryImg',$o->galleryImg,30,30,true,"String",false);
			$form->setAttribute("multiple","multiple");
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
				$o=new plugin_gallery();
				$o->galleryID=$sender->getvalue('galleryID');
				$o->galleryTypeID=$sender->getvalue("galleryTypeID");
				$o->version=$sender->getvalue('version');
				$o->galleryName=$sender->getvalue('galleryName');
				$o->galleryNameEn=$sender->getvalue('galleryNameEn');

				$o->fileType="galleryImg";
			
					$userfile=$sender->getvalue('galleryImg');
			
					$Datef=Date("d-m-y");
					$Timef=Date("H-i-s");
					$Datef=ereg_replace("-","",$Datef);
					$Timef=ereg_replace("-","",$Timef); 
					$Fname="file_".$Datef."_".$Timef;
				
				$filePart=uploadFileMulitTwo(0,"./Upload/Img",$Fname,$userfile);

				$dao=new Plugin_GalleryDao();
				if($o->galleryID)
			{
				$dao->update($o);
				Refreshs("Plugin_Gallery/ShowGallery&galleryTypeID=".$o->galleryTypeID."","alert","update");
				}
				else
			{
					$images_sub=explode(",",$filePart);
					for($i=0;$i<count($images_sub);$i++)
						{
							$o->galleryImg=$images_sub[$i];
							$o->status=$sender->getvalue('status');
							$o->creationUser=$_SESSION["Session_User_UserID"];
							
							if($images_sub[$i])
								$dao->save($o);

							$o->galleryID="";
							$o->version="";
						}
					
				Refreshs("Plugin_Gallery/ShowGallery&galleryTypeID=".$o->galleryTypeID."","alert","save");
					
				}
		}
 }

?>