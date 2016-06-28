<?php

require_once("Project/plugins/Plugin_Puddy/Dao/Plugin_Sub_PuddyDao.php");
require_once("Project/plugins/Plugin_Puddy/Common/plugin_sub_puddy.php");

 class  ShowSubPuddy extends TForm
 {
	 public static $Grid1;
	 function ShowSubPuddy()
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
				$this->Init("ShowSubPuddy","Plugin_Puddy","",true);
						
					
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

				$puddyID=$this->getdata('puddyID');

				$_SESSION["Session_PuddyID"]=$puddyID;

			
				$dao=new Plugin_Sub_PuddyDao();
				$o=$dao->selectBypuddyID($puddyID);
				
				ShowSubPuddy::$Grid1=new TGridtable();
				ShowSubPuddy::$Grid1->setgridtable("Grid1",$o);

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

				}

				
				
				$grid=new TLabel();
				$grid->set('province',"","","",true,"",false);
				$grid->title='จังหวัด';
				ShowSubPuddy::$Grid1->addcontrol($grid);

				$grid=new TLabel();
				$grid->set('dayAndWeek',"","","",true,"",false);
				$grid->title='วันหรือสัปดาห์';
				ShowSubPuddy::$Grid1->addcontrol($grid);


				$grid=new TLabel();
				$grid->set('details',"","","",true,"",false);
				$grid->title='รายละเอียด';
				ShowSubPuddy::$Grid1->addcontrol($grid);

		

				$status=new TGridLink();
				$status->set('status',$o->status,"","","true","","");
				$status->title='สถานะ';
				$status->setEvent("onclick","frmActionStatus");
				ShowSubPuddy::$Grid1->addcontrol($status);

				ShowSubPuddy::$Grid1->View=false;
				ShowSubPuddy::$Grid1->Edit=$o_per[0]->permissEdit;
				ShowSubPuddy::$Grid1->Delete=$o_per[0]->permissDel;
				$this->Add(ShowSubPuddy::$Grid1);


	 $this->waitevent();
		}
		function Grid1_rowperpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowSubPuddy::$Grid1->gotopage($v[1]);
			ShowSubPuddy::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowSubPuddy::$Grid1->gotopage($v[1]);
			ShowSubPuddy::$Grid1->changenumpage($v[0]);
		}
		function Grid1_View($parameter,$sender)
		{
			//$value[1]=ShowSubPuddy::$Grid1->getvalues("moduleID",$parameter);
			//fRefresh("","page,object_id","Register.frmRegister,$value[1]");
		}
		 function Grid1_Editing($parameter,$sender)
		{
			$infoTypeID=$_SESSION["Session_puddyID"];
			$value[1]=ShowSubPuddy::$Grid1->getvalues("subPuddyID",$parameter);
			Refreshs("Plugin_Puddy/frmSubPuddy&puddyID=".$puddyID,"object_id",$value[1]);
		}
		function Grid1_Deleting($parameter,$sender)
		{
			$o=new plugin_sub_puddy();
			$o->subPuddyID=ShowSubPuddy::$Grid1->getvalues("subPuddyID",$parameter);

			$dao=new Plugin_Sub_PuddyDao();
			$dao->deletes($o);
			Refreshs("Plugin_Puddy/ShowSubPuddy","alert","del");
		}
		function frmAction($parameter,$sender)
		{
				$puddyID=$_SESSION["Session_PuddyID"];
				fRefresh("","page","Plugin_Puddy/frmSubPuddy&puddyID=".$puddyID);
		}
		function frmActionStatus($parameter,$sender)
		{
			$o=new plugin_sub_puddy();
			$newID=ShowSubPuddy::$Grid1->getvalues("subPuddyID",$parameter);
			
			$dao=new Plugin_Sub_PuddyDao();
			$o_chk=$dao->selectById($subPuddyID);
			$o->subPuddyID=$o_chk->subPuddyID;
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

			Refreshs("Plugin_Puddy/ShowSubPuddy","alert","update");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new Plugin_Sub_PuddyDao();

			for($i=ShowSubPuddy::$Grid1->getstart();$i<ShowSubPuddy::$Grid1->getstop();$i++)
			{
				$o=new plugin_sub_puddy();
				
				$o->subPuddyID=ShowSubPuddy::$Grid1->getvalues("subPuddyID",$i);
				
				$o->cartoonpartIDCheck=ShowSubPuddy::$Grid1->getvalues("cartoonpartIDCheck",$i);
				if($o->cartoonpartIDCheck)
				{
					if($o->subPuddyID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->subPuddyID="";
					}
				}
				
			}
				Refreshs("Plugin_Puddy/ShowSubPuddy","alert","del");
		}
		
 }
?>