<?php


require_once("Project/plugins/Plugin_Puddy/Dao/Plugin_PuddyDao.php");
require_once("Project/plugins/Plugin_Puddy/Common/plugin_puddy.php");

 class  ShowPuddy extends TForm
 {
	 public static $Grid1;
	 function ShowPuddy()
		{
			$dao_submodule=new SubModuleDao();
				$o_submodule=$dao_submodule->selectAllBySystem("plugin_info_type");

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
				$this->Init("ShowPuddy","Plugin_Puddy","",true);
						
					
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

				$infoTypeID=$this->getdata('infoTypeID');

				$_SESSION["Session_infoTypeID"]=$infoTypeID;

			
				$dao=new Plugin_PuddyDao();
				$o=$dao->selectAll();
				
				ShowPuddy::$Grid1=new TGridtable();
				ShowPuddy::$Grid1->setgridtable("Grid1",$o);

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

						$o[$i]->startDate=thaiDate2($o[$i]->startDate);
						$o[$i]->endDate=thaiDate2($o[$i]->endDate);

						$o[$i]->addDetails='<a class="btn btn-xs" href="?page=Plugin_Puddy/ShowSubPuddy&puddyID='.$o[$i]->puddyID.'"><i class="icon-cog"></i> เพิ่มรายละเอียด </a> ';
				}

				
				
				$grid=new TLabel();
				$grid->set('puddyName',"","","",true,"",false);
				$grid->title='หัวข้อ';
				ShowPuddy::$Grid1->addcontrol($grid);

				$grid=new TLabel();
				$grid->set('startDate',"","","",true,"",false);
				$grid->title='วันที่เริ่ม';
				ShowPuddy::$Grid1->addcontrol($grid);


				$grid=new TLabel();
				$grid->set('endDate',"","","",true,"",false);
				$grid->title='วันที่สิ้นสุด';
				ShowPuddy::$Grid1->addcontrol($grid);

				$grid=new TLabel();
				$grid->set('addDetails',"","","",true,"",false);
				$grid->title='จัดการ';
				ShowPuddy::$Grid1->addcontrol($grid);


				$status=new TGridLink();
				$status->set('status',$o->status,"","","true","","");
				$status->title='สถานะ';
				$status->setEvent("onclick","frmActionStatus");
				ShowPuddy::$Grid1->addcontrol($status);

				ShowPuddy::$Grid1->View=false;
				ShowPuddy::$Grid1->Edit=$o_per[0]->permissEdit;
				ShowPuddy::$Grid1->Delete=$o_per[0]->permissDel;
				$this->Add(ShowPuddy::$Grid1);


	 $this->waitevent();
		}
		function Grid1_rowperpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowPuddy::$Grid1->gotopage($v[1]);
			ShowPuddy::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowPuddy::$Grid1->gotopage($v[1]);
			ShowPuddy::$Grid1->changenumpage($v[0]);
		}
		function Grid1_View($parameter,$sender)
		{
			//$value[1]=ShowPuddy::$Grid1->getvalues("moduleID",$parameter);
			//fRefresh("","page,object_id","Register.frmRegister,$value[1]");
		}
		 function Grid1_Editing($parameter,$sender)
		{
			$infoTypeID=$_SESSION["Session_infoTypeID"];
			$value[1]=ShowPuddy::$Grid1->getvalues("puddyID",$parameter);
			Refreshs("Plugin_Puddy/frmPuddy&infoTypeID=".$infoTypeID,"object_id",$value[1]);
		}
		function Grid1_Deleting($parameter,$sender)
		{
			$o=new plugin_puddy();
			$o->puddyID=ShowPuddy::$Grid1->getvalues("puddyID",$parameter);

			$dao=new Plugin_PuddyDao();
			$dao->deletes($o);
			Refreshs("Plugin_Puddy/ShowPuddy","alert","del");
		}
		function frmAction($parameter,$sender)
		{
				$infoTypeID=$_SESSION["Session_infoTypeID"];
				fRefresh("","page","Plugin_Puddy/frmPuddy&infoTypeID=".$infoTypeID);
		}
		function frmActionStatus($parameter,$sender)
		{
			$o=new plugin_puddy();
			$newID=ShowPuddy::$Grid1->getvalues("puddyID",$parameter);
			
			$dao=new Plugin_PuddyDao();
			$o_chk=$dao->selectById($puddyID);
			$o->puddyID=$o_chk->puddyID;
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

			Refreshs("Plugin_Puddy/ShowPuddy","alert","update");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new Plugin_PuddyDao();

			for($i=ShowPuddy::$Grid1->getstart();$i<ShowPuddy::$Grid1->getstop();$i++)
			{
				$o=new plugin_puddy();
				
				$o->puddyID=ShowPuddy::$Grid1->getvalues("puddyID",$i);
				
				$o->cartoonpartIDCheck=ShowPuddy::$Grid1->getvalues("cartoonpartIDCheck",$i);
				if($o->cartoonpartIDCheck)
				{
					if($o->puddyID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->puddyID="";
					}
				}
				
			}
				Refreshs("Plugin_Puddy/ShowPuddy","alert","del");
		}
		
 }
?>