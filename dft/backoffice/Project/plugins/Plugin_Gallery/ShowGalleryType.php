<?php
require_once("Project/plugins/Plugin_Gallery/Dao/Plugin_Gallery_TypeDao.php");
require_once("Project/plugins/Plugin_Gallery/Common/plugin_gallery_type.php");

require_once("Project/plugins/Plugin_Gallery/Dao/Plugin_GalleryDao.php");
require_once("Project/plugins/Plugin_Gallery/Common/plugin_gallery.php");

 class  ShowGalleryType extends TForm
 {
	 public static $Grid1;
	 function ShowGalleryType()
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
				$this->Init("ShowGalleryType","Plugin_Gallery","",true);
						
					
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



				$dao=new Plugin_Gallery_TypeDao();
				$o=$dao->selectAllSearch($obj);
				

				ShowGalleryType::$Grid1=new TGridtable();
				ShowGalleryType::$Grid1->setgridtable("Grid1",$o);

				for($i=0;$i<count($o);$i++)
				{
						if($o[$i]->status=="Close")
					{
							$o[$i]->status="<span class=\"label label-inverse\">ปิดการใช้งาน</span>";
						}
						elseif($o[$i]->status=="Open")
					{
							$o[$i]->status="<span class=\"label label-success\">เปิดการใช้งาน</span>";
						}
					$o[$i]->roomGallery="เพิ่มรูปภาพ";
					$img=str_replace("Img","Thumbs",$o[$i]->galleryTypeImg,$x);

					$o[$i]->galleryTypeImg="<img src=".$img." width='70px;'>";


				}

				$grid=new TLabel();
				$grid->set('galleryTypeImg',$o->galleryTypeImg,30,30,ture,'img','ชื่อ');
				$grid->title='กิจกรรม';
				ShowGalleryType::$Grid1->addcontrol($grid);

				$grid=new TLabel();
				$grid->set('galleryTypeName',$o->roomName,30,30,ture,'reqstring','ชื่อ');
				$grid->title='ชื่อกิจกรรม';
				ShowGalleryType::$Grid1->addcontrol($grid);

				
				
				$grid=new TGridLink();
				$grid->set('roomGallery',$o->roomGallery,30,30,ture,'reqstring','ชื่อ');
				$grid->title='เพิ่มรูปภาพ';
				$grid->setEvent("onclick","frmActionPromotion");
				$grid->setAttribute("class","btn btn-small");
				ShowGalleryType::$Grid1->addcontrol($grid);

				$status=new TGridLink();
				$status->set('status',$o->status,30,30,ture,'reqstring','ชื่อ');
				$status->title='สถานะ';
				$status->setEvent("onclick","frmActionStatus");
				ShowGalleryType::$Grid1->addcontrol($status);

			
				ShowGalleryType::$Grid1->Edit=$o_per[0]->permissEdit;
				ShowGalleryType::$Grid1->Delete=$o_per[0]->permissDel;
				$this->Add(ShowGalleryType::$Grid1);

	 $this->waitevent();
		}
		function Grid1_rowperpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowGalleryType::$Grid1->gotopage($v[1]);
			ShowGalleryType::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowGalleryType::$Grid1->gotopage($v[1]);
			ShowGalleryType::$Grid1->changenumpage($v[0]);
		}
		function Grid1_View($parameter,$sender)
		{
			$value[1]=ShowGalleryType::$Grid1->getvalues("usertypeID",$parameter);
			//fRefresh("","page,object_id","Register.frmRegister,$value[1]");
		}
		 function Grid1_Editing($parameter,$sender)
		{
			$value[1]=ShowGalleryType::$Grid1->getvalues("galleryTypeID",$parameter);
			Refreshs("Plugin_Gallery/frmGalleryType","object_id",$value[1]);
		}
		function Grid1_Deleting($parameter,$sender)
		{
			
			$o=new plugin_gallery_type();
			$o->galleryTypeID=ShowGalleryType::$Grid1->getvalues("galleryTypeID",$parameter);
			$dao=new Plugin_Gallery_TypeDao();
			$dao->deletes($o);
			Refreshs("Plugin_Gallery/ShowGalleryType","alert","del");
		}
		function frmAction($parameter,$sender)
		{

				fRefresh("","page","Plugin_Gallery/frmGalleryType");
		}
		function frmActionPromotion($parameter,$sender)
		{
				//ผิดตรงนี้ มันต้อง ใส่ ShowGalleryType ให้ตรงกับไฟล์ที่เราเขียนอยู่ เพราะมันนหา class action ไม่เจอ จาก ShowGallery >> ShowGalleryType
				$galleryTypeID=ShowGalleryType::$Grid1->getvalues("galleryTypeID",$parameter);
				fRefresh("","page","Plugin_Gallery/ShowGallery&galleryTypeID=$galleryTypeID");
				
		}
		
		function frmActionStatus($parameter,$sender)
		{
			$o=new plugin_gallery_type();
			$galleryTypeID=ShowGalleryType::$Grid1->getvalues("galleryTypeID",$parameter);

			$dao=new Plugin_Gallery_TypeDao();
			
			$o_chk=$dao->selectById($galleryTypeID);
			$o->galleryTypeID=$o_chk->galleryTypeID;
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

			Refreshs("Plugin_Gallery/ShowGalleryType","alert","update");
		}
 }
?>