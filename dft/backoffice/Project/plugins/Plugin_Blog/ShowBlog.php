<?php
require_once("Project/plugins/Plugin_Blog/Dao/Plugin_BlogDao.php");
require_once("Project/plugins/Plugin_Blog/Common/plugin_blog.php");

require_once("Project/plugins/Plugin_Blog_Type/Dao/Plugin_Blog_TypeDao.php");
require_once("Project/plugins/Plugin_Blog_Type/Common/plugin_blog_type.php");

 class  ShowBlog extends TForm
 {
	 public static $Grid1;
	 function ShowBlog()
		{
			$dao_submodule=new SubModuleDao();
				$o_submodule=$dao_submodule->selectAllBySystem("plugin_blog");

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
				$this->Init("ShowBlog","Plugin_Blog","",true);
						
					
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
			
				$dao=new Plugin_BlogDao();
				$dao_blog_type=new Plugin_Blog_TypeDao();
				$o=$dao->selectAll();
				
				ShowBlog::$Grid1=new TGridtable();
				ShowBlog::$Grid1->setgridtable("Grid1",$o);

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
						$o_blog_type=$dao_blog_type->selectById($o[$i]->blogtypeID);
						$o[$i]->blogtypeName=$o_blog_type->blogtypeName;
				}

				$grid=new TCheckbox();
				$grid->set('cartoonpartIDCheck',"","","40",ture,'reqstring',false);
				$grid->additem(" ","");
				$grid->title=' ';
				ShowBlog::$Grid1->addcontrol($grid);
				
				$grid=new TLabel();
				$grid->set('blogName',"","","",true,"",false);
				$grid->title='หัวข้อบทความ';
				ShowBlog::$Grid1->addcontrol($grid);

				$grid=new TLabel();
				$grid->set('blogtypeName',"","","",true,"",false);
				$grid->title='ประเภทบทความ';
				ShowBlog::$Grid1->addcontrol($grid);

				$status=new TGridLink();
				$status->set('status',$o->status,"","","true","","");
				$status->title='สถานะ';
				$status->setEvent("onclick","frmActionStatus");
				ShowBlog::$Grid1->addcontrol($status);

				ShowBlog::$Grid1->View=false;
				ShowBlog::$Grid1->Edit=$o_per[0]->permissEdit;
				ShowBlog::$Grid1->Delete=$o_per[0]->permissDel;
				$this->Add(ShowBlog::$Grid1);


	 $this->waitevent();
		}
		function Grid1_rowperpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowBlog::$Grid1->gotopage($v[1]);
			ShowBlog::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowBlog::$Grid1->gotopage($v[1]);
			ShowBlog::$Grid1->changenumpage($v[0]);
		}
		function Grid1_View($parameter,$sender)
		{
			//$value[1]=ShowBlog::$Grid1->getvalues("moduleID",$parameter);
			//fRefresh("","page,object_id","Register.frmRegister,$value[1]");
		}
		 function Grid1_Editing($parameter,$sender)
		{
			$value[1]=ShowBlog::$Grid1->getvalues("blogID",$parameter);
			Refreshs("Plugin_Blog/frmBlog","object_id",$value[1]);
		}
		function Grid1_Deleting($parameter,$sender)
		{
			$o=new plugin_blog();
			$o->blogID=ShowBlog::$Grid1->getvalues("blogID",$parameter);

			$dao=new Plugin_BlogDao();
			$dao->deletes($o);
			Refreshs("Plugin_Blog/ShowBlog","alert","del");
		}
		function frmAction($parameter,$sender)
		{
				fRefresh("","page","Plugin_Blog/frmBlog");
		}
		function frmActionStatus($parameter,$sender)
		{
			$o=new plugin_blog();
			$newID=ShowBlog::$Grid1->getvalues("blogID",$parameter);
			
			$dao=new Plugin_BlogDao();
			$o_chk=$dao->selectById($blogID);
			$o->blogID=$o_chk->blogID;
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

			Refreshs("Plugin_Blog/ShowBlog","alert","update");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new Plugin_BlogDao();

			for($i=ShowBlog::$Grid1->getstart();$i<ShowBlog::$Grid1->getstop();$i++)
			{
				$o=new plugin_blog();
				
				$o->blogID=ShowBlog::$Grid1->getvalues("blogID",$i);
				
				$o->cartoonpartIDCheck=ShowBlog::$Grid1->getvalues("cartoonpartIDCheck",$i);
				if($o->cartoonpartIDCheck)
				{
					if($o->blogID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->blogID="";
					}
				}
				
			}
				Refreshs("Plugin_Blog/ShowBlog","alert","del");
		}
		
 }
?>