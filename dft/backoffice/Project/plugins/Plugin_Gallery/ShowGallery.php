<?php

require_once("Project/plugins/Plugin_Gallery/Dao/Plugin_GalleryDao.php");
require_once("Project/plugins/Plugin_Gallery/Common/plugin_gallery.php");

 class  ShowGallery extends TForm
 {
	 public static $Grid1;
	 function ShowGallery()
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
				

			if($o_per[0]->permissView=="true")
				$this->Init("ShowGallery","Plugin_Gallery","",true);
						
					
				$alert=$this->getdata("alert");

				if($alert)
				{
						$alertmsg=new TLabel();
						$alertmsg->set("alertmsg",alerts($alert),"","",true,"","");
						$this->add($alertmsg);
				}
				
				if($o_per[0]->permissAdd=="true")
				{
					$bn=new TButton();
					$bn->set("bn"," เพิ่มข้อมูลใหม่","","",true,"","");
					$bn->setEvent("onclick","frmAction");
					$bn->setAttribute("class","btn btn-xs btn-primary");
					$this->Add($bn);
				}
				
				if($o_per[0]->permissDel=="true")
				{
					$bndelgrid=new TButton();
					$bndelgrid->set("bndelgrid"," ลบข้อมูล","","",true,"","");
					$bndelgrid->setEvent_Confirm("onclick","frmDelAll",true,"คุณต้องการลบข้อมูลใช่หรือไม่");
					$bndelgrid->setAttribute("class","btn btn-xs btn-danger");
					$this->Add($bndelgrid);
				}

				$galleryTypeID=$this->getdata('galleryTypeID');
				
				$dao=new Plugin_GalleryDao();
				$o=$dao->selectAllSearchByType($galleryTypeID);


				ShowGallery::$Grid1=new TGridtable();
				ShowGallery::$Grid1->setgridtable("Grid1",$o);


				for($i=0;$i<count($o);$i++)
				{
					if($o[$i]->status=="Close")//status
					{
							$o[$i]->status="<span class=\"label label-danger\">ปิดการใช้งาน</span>";
						}
						elseif($o[$i]->status=="Open")
					{
							$o[$i]->status="<span class=\"label label-success\">เปิดการใช้งาน</span>";
						}

					$img=str_replace("Img","Thumbs",$o[$i]->galleryImg,$x);

					$o[$i]->galleryImg="<img src=".$img." width='70px;'>";


				}
				

				$form=new THidden();
				$form->set('galleryTypeID',$o->galleryTypeID,30,30,true,"String",false); 
				$this->add($form);

				$grid=new TLabel();
				$grid->set('galleryImg',$o->galleryImg,30,30,ture,'reqstring','ชื่อ');
				$grid->title='ภาพ';
				ShowGallery::$Grid1->addcontrol($grid);
				
			

				$status=new TGridLink();
				$status->set('status',$o->status,30,30,ture,'reqstring','ชื่อ');
				$status->title='สถานะ';
				$status->setEvent("onclick","frmActionStatus");
				ShowGallery::$Grid1->addcontrol($status);

			
				ShowGallery::$Grid1->View=false;
				ShowGallery::$Grid1->Edit=$o_per[0]->permissEdit;
				ShowGallery::$Grid1->Delete=$o_per[0]->permissDel;
				$this->Add(ShowGallery::$Grid1);

	 $this->waitevent();
		}
		function Grid1_rowperpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowGallery::$Grid1->gotopage($v[1]);
			ShowGallery::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowGallery::$Grid1->gotopage($v[1]);
			ShowGallery::$Grid1->changenumpage($v[0]);
		}
		function Grid1_View($parameter,$sender)
		{
			$value[1]=ShowGallery::$Grid1->getvalues("usertypeID",$parameter);
			//fRefresh("","page,object_id","Register.frmRegister,$value[1]");
		}
		 function Grid1_Editing($parameter,$sender)
		{
			 $value[1]=ShowGallery::$Grid1->getvalues("galleryID",$parameter);
			Refreshs("Plugin_Gallery/frmGallery","object_id",$value[1]);

			

		}
		function Grid1_Deleting($parameter,$sender)
		{
			
			$o=new Plugin_Gallery();
			$o->galleryID=ShowGallery::$Grid1->getvalues("galleryID",$parameter);
			$dao=new Plugin_GalleryDao();
				$o_chk=$dao->selectById($o->galleryID);
				if(unlink($o_chk->galleryImg))
					$dao->deletes($o);

			$galleryTypeID=$sender->getvalue('galleryTypeID');
				Refreshs("Plugin_Gallery/ShowGallery&galleryTypeID=$galleryTypeID","alert","del");
		}
		function frmAction($parameter,$sender)
		{
			$galleryTypeID=$sender->getvalue('galleryTypeID');
				Refreshs("Plugin_Gallery/frmGallery&galleryTypeID=$galleryTypeID","alert","del");
		}
		function frmActionStatus($parameter,$sender)
		{
			$o=new Plugin_Gallery();
			$galleryID=ShowGallery::$Grid1->getvalues("galleryID",$parameter);
			$dao=new Plugin_GalleryDao();
			
			$o_chk=$dao->selectById($galleryID);
			$o->galleryID=$o_chk->galleryID;
			$o->version=$o_chk->version;

			if($o_chk->status=="Open")
			{
			$o->status="Close";
			}
			else
			{
			$o->status="Open";
			}
			$dao->update($o);
		
			$galleryTypeID=$sender->getvalue('galleryTypeID');
			Refreshs("Plugin_Gallery/ShowGallery&galleryTypeID=$galleryTypeID","alert","update");
		}
 }
?>