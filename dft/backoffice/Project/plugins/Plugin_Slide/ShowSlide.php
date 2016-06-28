<?php
require_once("Project/plugins/Plugin_Slide/Dao/Plugin_SlideDao.php");
require_once("Project/plugins/Plugin_Slide/Common/plugin_slide.php");

 class  ShowSlide extends TForm
 {
	 public static $Grid1;
	 function ShowSlide()
		{
	
			$dao_submodule=new SubModuleDao();
			$o_submodule=$dao_submodule->selectAllBySystem("plugin_slide");

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
				$this->Init("ShowSlide","Plugin_Slide","",true);
						
					
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

		
				
				$dao=new Plugin_SlideDao();
				$o=$dao->selectAll();
				
				ShowSlide::$Grid1=new TGridtable();
				ShowSlide::$Grid1->setgridtable("Grid1",$o);

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

						$img=str_replace('Img', 'Thumbs', $o[$i]->slideImg);

						$o[$i]->slideImgNemo="<img src='".$img."' width='70px'  />";
				}

				
				$grid=new TLabel();
				$grid->set('slideImgNemo',$o->slideImg,30,30,ture,'reqstring','ชื่อ');
				$grid->title='ภาพ';
				ShowSlide::$Grid1->addcontrol($grid);

				$grid=new TLabel();
				$grid->set('slideTitle',$o->slideTitle,30,30,ture,'reqstring','ชื่อ');
				$grid->title='title';
				ShowSlide::$Grid1->addcontrol($grid);

				$status=new TGridLink();
				$status->set('status',$o->status,30,30,ture,'reqstring','ชื่อ');
				$status->title='สถานะ';
				$status->setEvent("onclick","frmActionStatus");
				ShowSlide::$Grid1->addcontrol($status);

				ShowSlide::$Grid1->View=false;
				ShowSlide::$Grid1->Edit=$o_per[0]->permissEdit;
				ShowSlide::$Grid1->Delete=$o_per[0]->permissDel;
				$this->Add(ShowSlide::$Grid1);

	 $this->waitevent();
		}
		function Grid1_rowperpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowSlide::$Grid1->gotopage($v[1]);
			ShowSlide::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowSlide::$Grid1->gotopage($v[1]);
			ShowSlide::$Grid1->changenumpage($v[0]);
		}
		function Grid1_View($parameter,$sender)
		{
			$value[1]=ShowSlide::$Grid1->getvalues("usertypeID",$parameter);
			//fRefresh("","page,object_id","Register.frmRegister,$value[1]");
		}
		 function Grid1_Editing($parameter,$sender)
		{
			$value[1]=ShowSlide::$Grid1->getvalues("slideID",$parameter);
			Refreshs("Plugin_Slide/frmSlide","object_id",$value[1]);
		}
		function Grid1_Deleting($parameter,$sender)
		{
			
			$o=new plugin_slide();
			$o->slideID=ShowSlide::$Grid1->getvalues("slideID",$parameter);
			$dao=new Plugin_SlideDao();
			$dao->deletes($o);
			Refreshs("Plugin_Slide/ShowSlide","alert","del");
		}
		function frmAction($parameter,$sender)
		{
				fRefresh("","page","Plugin_Slide/frmSlide");
		}
		function frmActionStatus($parameter,$sender)
		{
			$o=new plugin_slide();
			$slideID=ShowSlide::$Grid1->getvalues("slideID",$parameter);
			$dao=new Plugin_SlideDao();
			
			$o_chk=$dao->selectById($slideID);
			$o->slideID=$o_chk->slideID;
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

			Refreshs("Plugin_Slide/ShowSlide","alert","update");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new Plugin_SlideDao();

			for($i=ShowSlide::$Grid1->getstart();$i<ShowSlide::$Grid1->getstop();$i++)
			{
				$o=new plugin_slide();
				
				$o->slideID=ShowSlide::$Grid1->getvalues("slideID",$i);
				
				$o->cartoonpartIDCheck=ShowSlide::$Grid1->getvalues("cartoonpartIDCheck",$i);
				if($o->cartoonpartIDCheck)
				{
					if($o->slideID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->slideID="";
					}
				}
				
			}
				Refreshs("Plugin_Slide/ShowSlide","alert","del");
		}
 }
?>