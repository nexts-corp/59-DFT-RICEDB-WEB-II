<?php
require_once("Project/plugins/Plugin_Blog_Type/Dao/Plugin_Blog_TypeDao.php");
require_once("Project/plugins/Plugin_Blog_Type/Common/plugin_blog_type.php");

 class  ShowBlogType extends TForm
 {
	 public static $Grid1;
	 function ShowBlogType()
		{
			$dao_submodule=new SubModuleDao();
				$o_submodule=$dao_submodule->selectAllBySystem("plugin_blog_type");

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
				$this->Init("ShowBlogType","Plugin_Blog_Type","",true);
						
					
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
			
				$dao=new Plugin_Blog_TypeDao();
				$o=$dao->selectAll();
				
				ShowBlogType::$Grid1=new TGridtable();
				ShowBlogType::$Grid1->setgridtable("Grid1",$o);

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
				}

				$grid=new TCheckbox();
				$grid->set('cartoonpartIDCheck',"","","40",true,"",false);
				$grid->additem(" ","");
				$grid->title=' ';
				ShowBlogType::$Grid1->addcontrol($grid);
				
				$grid=new TLabel();
				$grid->set('blogtypeName',"","","",true,"",false);
				$grid->title='ประเภทบทความ';
				ShowBlogType::$Grid1->addcontrol($grid);


				$status=new TGridLink();
				$status->set('status',$o->status,"","","true","","");
				$status->title='สถานะ';
				$status->setEvent("onclick","frmActionStatus");
				ShowBlogType::$Grid1->addcontrol($status);

				ShowBlogType::$Grid1->View=false;
				ShowBlogType::$Grid1->Edit=$o_per[0]->permissEdit;
				ShowBlogType::$Grid1->Delete=$o_per[0]->permissDel;
				$this->Add(ShowBlogType::$Grid1);


	 $this->waitevent();
		}
		function Grid1_rowperpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowBlogType::$Grid1->gotopage($v[1]);
			ShowBlogType::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowBlogType::$Grid1->gotopage($v[1]);
			ShowBlogType::$Grid1->changenumpage($v[0]);
		}
		function Grid1_View($parameter,$sender)
		{
			//$value[1]=ShowBlogType::$Grid1->getvalues("moduleID",$parameter);
			//fRefresh("","page,object_id","Register.frmRegister,$value[1]");
		}
		 function Grid1_Editing($parameter,$sender)
		{
			$value[1]=ShowBlogType::$Grid1->getvalues("blogtypeID",$parameter);
			Refreshs("Plugin_Blog_Type/frmBlogType","object_id",$value[1]);
		}
		function Grid1_Deleting($parameter,$sender)
		{
			$o=new plugin_blog_type();
			$o->blogtypeID=ShowBlogType::$Grid1->getvalues("blogtypeID",$parameter);

			$dao=new Plugin_Blog_TypeDao();
			$dao->deletes($o);
			Refreshs("Plugin_Blog_Type/ShowBlogType","alert","del");
		}
		function frmAction($parameter,$sender)
		{
				fRefresh("","page","Plugin_Blog_Type/frmBlogType");
		}
		function frmActionStatus($parameter,$sender)
		{
			$o=new plugin_blog_type();
			$blogtypeID=ShowBlogType::$Grid1->getvalues("blogtypeID",$parameter);
			
			$dao=new Plugin_Blog_TypeDao();
			$o_chk=$dao->selectById($blogtypeID);
			$o->blogtypeID=$o_chk->blogtypeID;
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

			Refreshs("Plugin_Blog_Type/ShowBlogType","alert","update");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new Plugin_Blog_TypeDao();

			for($i=ShowBlogType::$Grid1->getstart();$i<ShowBlogType::$Grid1->getstop();$i++)
			{
				$o=new plugin_blog_type();
				
				$o->blogtypeID=ShowBlogType::$Grid1->getvalues("blogtypeID",$i);
				
				$o->cartoonpartIDCheck=ShowBlogType::$Grid1->getvalues("cartoonpartIDCheck",$i);
				if($o->cartoonpartIDCheck)
				{
					if($o->blogtypeID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->blogtypeID="";
					}
				}
				
			}
				Refreshs("Plugin_Blog_Type/ShowBlogType","alert","del");
		}
		
 }
?>