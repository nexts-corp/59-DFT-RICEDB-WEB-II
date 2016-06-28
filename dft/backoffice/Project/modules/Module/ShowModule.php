<?php
require_once("Project/bussiness/ModuleDao.php");
require_once("Project/common/module.php");

require_once("Project/bussiness/SubModuleDao.php");
require_once("Project/common/submodule.php");

require_once("Project/bussiness/PermissDao.php");
require_once("Project/common/permiss.php");

require_once("Project/bussiness/UserTypeDao.php");
require_once("Project/common/usertype.php");
 class  ShowModule extends TForm
 {
	 public static $Grid1;
	 function ShowModule()
		{
	 $this->Init("ShowModule","Module","",true);
					
				
				
				$alert=$this->getdata("alert");

				if($alert)
				{
						$alertmsg=new TLabel();
						$alertmsg->set("alertmsg",alerts($alert),"","",true,"","");
						$this->add($alertmsg);
				}

				$bn=new TButton();
				$bn->set("bn"," เพิ่มข้อมูลใหม่","","",true,"","");
				$bn->setEvent("onclick","frmAction");
				$bn->setAttribute("class","btn btn-xs btn-primary");
				$this->Add($bn);

				$bndelgrid=new TButton();
				$bndelgrid->set("bndelgrid"," ลบข้อมูล","","",true,"","");
				$bndelgrid->setEvent_Confirm("onclick","frmDelAll",true,"คุณต้องการลบข้อมูลใช่หรือไม่");
				$bndelgrid->setAttribute("class","btn btn-xs btn-danger");
				$this->Add($bndelgrid);
			
				$dao=new ModuleDao();
				$o=$dao->selectAll();
				
				ShowModule::$Grid1=new TGridtable();
				ShowModule::$Grid1->setgridtable("Grid1",$o);

				$dao_usertype=new UserTypeDao();
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

						if($o[$i]->usertypeID)//สิทธิการเข้าถึงข้อมูล
					{
						$usertype=explode(",",$o[$i]->usertypeID);
						
						$usertypename="";
							for($j=0;$j<count($usertype);$j++)
						{
								$o_usertype=$dao_usertype->selectById($usertype[$j]);
								$usertypename.="<span><span class=\"icon icon-color icon-check\"/></span>".$o_usertype->usertypeName."</span>";
							}
						
						$o[$i]->usertypeID=$usertypename;
						}
					
					$o[$i]->submodule="<i class=\"icon-cog\"></i> จัดการโมดูลย่อย";
				}

				$grid=new TCheckbox();
				$grid->set('cartoonpartIDCheck',"","","40",ture,'reqstring',false);
				$grid->additem(" ","");
				$grid->title=' ';
				ShowModule::$Grid1->addcontrol($grid);
				
				$moduleSystem=new TLabel();
				$moduleSystem->set('moduleSystem',$o->moduleSystem,30,30,ture,'reqstring','ชื่อ');
				$moduleSystem->title='ชื่อโมดูลระบบ';
				ShowModule::$Grid1->addcontrol($moduleSystem);

				$moduleName=new TLabel();
				$moduleName->set('moduleName',$o->moduleName,30,30,ture,'reqstring','ชื่อ');
				$moduleName->title='ชื่อโมดูล';
				ShowModule::$Grid1->addcontrol($moduleName);

				$usertypeID=new TLabel();
				$usertypeID->set('usertypeID',$o->usertypeID,30,30,ture,'reqstring','ชื่อ');
				$usertypeID->title='การเข้าถึงข้อมูล';
				ShowModule::$Grid1->addcontrol($usertypeID);


				$status=new TGridLink();
				$status->set('status',$o->status,"","","true","","");
				$status->title='สถานะ';
				$status->setEvent("onclick","frmActionStatus");
				ShowModule::$Grid1->addcontrol($status);
				
				$submodule=new TGridLink();
				$submodule->set('submodule',$o->submodule,"","","true","","");
				$submodule->title='โมดูลย่อย';
				$submodule->setEvent("onclick","frmActionSubmodule");
				$submodule->setAttribute("class","btn btn-xs btn-primary");
				ShowModule::$Grid1->addcontrol($submodule);

				ShowModule::$Grid1->View=false;
				ShowModule::$Grid1->Edit=true;
				ShowModule::$Grid1->Delete=true;
				$this->Add(ShowModule::$Grid1);


	 $this->waitevent();
		}
		function Grid1_rowperpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowModule::$Grid1->gotopage($v[1]);
			ShowModule::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowModule::$Grid1->gotopage($v[1]);
			ShowModule::$Grid1->changenumpage($v[0]);
		}
		function Grid1_View($parameter,$sender)
		{
			$value[1]=ShowModule::$Grid1->getvalues("moduleID",$parameter);
			//fRefresh("","page,object_id","Register.frmRegister,$value[1]");
		}
		 function Grid1_Editing($parameter,$sender)
		{
			$value[1]=ShowModule::$Grid1->getvalues("moduleID",$parameter);
			Refreshs("Module.frmModule","object_id",$value[1]);
		}
		function Grid1_Deleting($parameter,$sender)
		{
			
			$o=new module();
			$o->moduleID=ShowModule::$Grid1->getvalues("moduleID",$parameter);

			if($o->moduleID)
			{
				$o_sub_module=new submodule();
				$dao_sub_module=new SubModuleDao();
					$o_sub_module_data=$dao_sub_module->selectAllByModule($o->moduleID);
				
				$dao_sub_module->deletesAll($o_sub_module_data);

				$o_permiss=new permiss();
				$dao_permiss=new PermissDao();
					$o_permiss_data=$dao_permiss->selectAllByModule($o->moduleID);
				
				$dao_permiss->deletesAll($o_permiss_data);
			}


			$dao=new ModuleDao();
			$dao->deletes($o);
			Refreshs("Module.ShowModule","alert","del");
		}
		function frmAction($parameter,$sender)
		{
				fRefresh("","page","Module.frmModule");
		}
		function frmActionSubmodule($parameter,$sender)
		{
				$o->moduleID=ShowModule::$Grid1->getvalues("moduleID",$parameter);
				fRefresh("","page","Module.ShowSubModule&moduleID=$o->moduleID");
		}
		function frmActionStatus($parameter,$sender)
		{
			$o=new module();
			$moduleID=ShowModule::$Grid1->getvalues("moduleID",$parameter);
			$dao=new ModuleDao();
			$o_chk=$dao->selectById($moduleID);
			$o->moduleID=$o_chk->moduleID;
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

			Refreshs("Module.ShowModule","alert","update");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new ModuleDao();
				for($i=ShowModule::$Grid1->getstart();$i<ShowModule::$Grid1->getstop();$i++)
			{
				$o=new module();
				
				$o->moduleID=ShowModule::$Grid1->getvalues("moduleID",$i);
				
				$o->cartoonpartIDCheck=ShowModule::$Grid1->getvalues("cartoonpartIDCheck",$i);
				if($o->cartoonpartIDCheck)
				{
					if($o->moduleID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->moduleID="";
					}
				}
				
			}
				Refreshs("Module.ShowModule","alert","del");
		}
		
 }
?>