<?
require_once("Project/plugins/Plugin_New_Type/Dao/Plugin_New_TypeDao.php");
require_once("Project/plugins/Plugin_New_Type/Common/plugin_new_type.php");

 class  ShowNewType extends TForm
 {
	 public static $Grid1;
	 function ShowNewType()
		{
			$dao_submodule=new SubModuleDao();
				$o_submodule=$dao_submodule->selectAllBySystem("plugin_new_type");

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
				$this->Init("ShowNewType","Plugin_New_Type","",true);
						
					
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
			
				$dao=new Plugin_New_TypeDao();
				$o=$dao->selectAll();
				
				ShowNewType::$Grid1=new TGridtable();
				ShowNewType::$Grid1->set("Grid1",$o);

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
				$grid->set('cartoonpartIDCheck',"","","40",ture,'reqstring',false);
				$grid->additem(" ","");
				$grid->title=' ';
				ShowNewType::$Grid1->addcontrol($grid);
				
				$grid=new TLabel();
				$grid->set('newtypeName',"","","",true,"",false);
				$grid->title='ประเภทข่าวสาร';
				ShowNewType::$Grid1->addcontrol($grid);


				$status=new TGridLink();
				$status->set('status',$o->status,"","","true","","");
				$status->title='สถานะ';
				$status->setEvent("onclick","frmActionStatus");
				ShowNewType::$Grid1->addcontrol($status);

				ShowNewType::$Grid1->View=false;
				ShowNewType::$Grid1->Edit=$o_per[0]->permissEdit;
				ShowNewType::$Grid1->Delete=$o_per[0]->permissDel;
				$this->Add(ShowNewType::$Grid1);


	 $this->waitevent();
		}
		function Grid1_rowperpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowNewType::$Grid1->gotopage($v[1]);
			ShowNewType::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowNewType::$Grid1->gotopage($v[1]);
			ShowNewType::$Grid1->changenumpage($v[0]);
		}
		function Grid1_View($parameter,$sender)
		{
			//$value[1]=ShowNewType::$Grid1->getvalues("moduleID",$parameter);
			//fRefresh("","page,object_id","Register.frmRegister,$value[1]");
		}
		 function Grid1_Editing($parameter,$sender)
		{
			$value[1]=ShowNewType::$Grid1->getvalues("newtypeID",$parameter);
			Refreshs("Plugin_New_Type/frmNewType","object_id",$value[1]);
		}
		function Grid1_Deleting($parameter,$sender)
		{
			$o=new plugin_new_type();
			$o->newtypeID=ShowNewType::$Grid1->getvalues("newtypeID",$parameter);

			$dao=new Plugin_New_TypeDao();
			$dao->deletes($o);
			Refreshs("Plugin_New_Type/ShowNewType","alert","del");
		}
		function frmAction($parameter,$sender)
		{
				fRefresh("","page","Plugin_New_Type/frmNewType");
		}
		function frmActionStatus($parameter,$sender)
		{
			$o=new plugin_new_type();
			$newtypeID=ShowNewType::$Grid1->getvalues("newtypeID",$parameter);
			
			$dao=new Plugin_New_TypeDao();
			$o_chk=$dao->selectById($newtypeID);
			$o->newtypeID=$o_chk->newtypeID;
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

			Refreshs("Plugin_New_Type/ShowNewType","alert","update");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new Plugin_New_TypeDao();

			for($i=ShowNewType::$Grid1->getstart();$i<ShowNewType::$Grid1->getstop();$i++)
			{
				$o=new plugin_new_type();
				
				$o->newtypeID=ShowNewType::$Grid1->getvalues("newtypeID",$i);
				
				$o->cartoonpartIDCheck=ShowNewType::$Grid1->getvalues("cartoonpartIDCheck",$i);
				if($o->cartoonpartIDCheck)
				{
					if($o->newtypeID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->newtypeID="";
					}
				}
				
			}
				Refreshs("Plugin_New_Type/ShowNewType","alert","del");
		}
		
 }
?>