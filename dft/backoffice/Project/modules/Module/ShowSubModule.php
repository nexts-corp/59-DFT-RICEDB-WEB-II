<?php
require_once("Project/bussiness/ModuleDao.php");
require_once("Project/common/module.php");

require_once("Project/bussiness/SubModuleDao.php");
require_once("Project/common/submodule.php");

require_once("Project/bussiness/UserTypeDao.php");
require_once("Project/common/usertype.php");

require_once("Project/bussiness/PermissDao.php");
require_once("Project/common/permiss.php");

 class  ShowSubModule extends TForm
 {
	 public static $Grid1;
	 function ShowSubModule()
		{
	 $this->Init("ShowSubModule","Module","",true);
		
				$module=$this->getdata("moduleID");
				
				$dao_module=new ModuleDao();
				$o_module=$dao_module->selectById($module);
	
						$moduleName=new TLabel();
						$moduleName->set("moduleName",$o_module->moduleName,"","",true,"","");
						$this->add($moduleName);

						$moduleIDView=new TLabel();
						$moduleIDView->set("moduleIDView",$o_module->moduleID,"","",true,"","");
						$this->add($moduleIDView);

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

				$dao=new SubModuleDao();
				$o=$dao->selectAllByModule($module);
				
				ShowSubModule::$Grid1=new TGridtable();
				ShowSubModule::$Grid1->setgridtable("Grid1",$o);
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
						
						$o[$i]->usertype="<i class=\"icon-cog\"></i> สิทธิ์";
				}
				
				$submoduleNumber=new TLabel();
				$submoduleNumber->set('submoduleNumber',$o->submoduleNumber,30,30,ture,'reqstring','ชื่อ');
				$submoduleNumber->title='ระดับการแสดงผล';
				ShowSubModule::$Grid1->addcontrol($submoduleNumber);

				$submoduleSystem=new TLabel();
				$submoduleSystem->set('submoduleSystem',$o->submoduleSystem,30,30,ture,'reqstring','ชื่อ');
				$submoduleSystem->title='ชื่อระบบโมดูลย่อย';
				ShowSubModule::$Grid1->addcontrol($submoduleSystem);
				

				$submoduleName=new TLabel();
				$submoduleName->set('submoduleName',$o->submoduleName,30,30,ture,'reqstring','ชื่อ');
				$submoduleName->title='ชื่อโมดูลย่อย';
				ShowSubModule::$Grid1->addcontrol($submoduleName);

				$submoduleUrl=new TLabel();
				$submoduleUrl->set('submoduleUrl',$o->submoduleUrl,30,30,ture,'reqstring','ชื่อ');
				$submoduleUrl->title='Url';
				ShowSubModule::$Grid1->addcontrol($submoduleUrl);
				
				$usertype=new TGridLink();
				$usertype->set('usertype',$o->usertype,30,30,ture,'reqstring','ชื่อ');
				$usertype->title='สิทธิ์';
				$usertype->setEvent("onclick","frmActionUsertype");
				$usertype->setAttribute("class","btn btn-xs");
				ShowSubModule::$Grid1->addcontrol($usertype);
				

				$status=new TGridLink();
				$status->set('status',$o->status,30,30,ture,'reqstring','ชื่อ');
				$status->title='สถานะ';
				$status->setEvent("onclick","frmActionStatus");
				$status->setAttribute("class","ajax-link");
				ShowSubModule::$Grid1->addcontrol($status);
				

				ShowSubModule::$Grid1->View=false;
				ShowSubModule::$Grid1->Edit=true;
				ShowSubModule::$Grid1->Delete=true;
				$this->Add(ShowSubModule::$Grid1);


	 $this->waitevent();
		}
		
		function Grid1_View($parameter,$sender)
		{
			$value[1]=ShowSubModule::$Grid1->getvalues("moduleID",$parameter);
			//fRefresh("","page,object_id","Register.frmRegister,$value[1]");
		}
		 function Grid1_Editing($parameter,$sender)
		{
			$value[1]=ShowSubModule::$Grid1->getvalues("submoduleID",$parameter);
			
			$dao=new SubModuleDao();
			$o=$dao->selectById($value[1]);
			
			Refreshs("Module.frmSubModule&moduleID=$o->moduleID","object_id,",$value[1]);
		}
		function Grid1_Deleting($parameter,$sender)
		{
			$moduleID=$sender->getvalue('moduleIDView');

			$o=new submodule();
			$o->submoduleID=ShowSubModule::$Grid1->getvalues("submoduleID",$parameter);
			$dao=new SubModuleDao();
			$dao->deletes($o);
			Refreshs("Module.ShowSubModule&moduleID=$moduleID","alert","del");
		}
		function frmAction($parameter,$sender)
		{
				$moduleID=$sender->getvalue('moduleIDView');

				Refreshs("Module.frmSubModule&moduleID=$moduleID","","");
				/*
				$o=new submodule();
				$o->submoduleID=$sender->getvalue('submoduleID_');
				$o->version=$sender->getvalue('version');
				$o->submoduleSystem=$sender->getvalue('submoduleSystem');
				$o->moduleID=$sender->getvalue('moduleID');
				$o->submoduleSystem=$sender->getvalue('submoduleSystem');
				$o->submoduleName=$sender->getvalue('submoduleName');
				$o->submoduleEmo=$sender->getvalue('submoduleEmo');
				$o->submoduleNumber=$sender->getvalue('submoduleNumber');
				$o->submoduleUrl=$sender->getvalue('submoduleUrl');
				$o->submoduleDetail=$sender->getvalue('submoduleDetail');
				$o->status=$sender->getvalue('status');
				$dao=new SubModuleDao();
				if($o->submoduleID)
			{
				$dao->update($o);
				Refreshs("Module.ShowSubModule&moduleID=$o->moduleID","alert","update");
				}
				else
			{
				$dao->save($o);

					$o_per=new permiss();

					$o_per->moduleID=$o->moduleID;
					$o_per->submoduleID=$o->submoduleID;
					$o_per->permissView="true";
					$o_per->permissAdd="false";
					$o_per->permissEdit="false";
					$o_per->permissDel="false";
						$dao_module=new ModuleDao();
						$o_module=$dao_module->selectById($o_per->moduleID);
						$usertype=explode(",",$o_module->usertypeID);

						$dao_per=new PermissDao();
						for($i=0;$i<count($usertype);$i++)
							{
								$o_per->usertypeID=$usertype[$i];
								$dao_per->save($o_per);
								$o_per->permissID="";
								$o_per->version="";
							}

				Refreshs("Module.ShowSubModule&moduleID=$o->moduleID","alert","save");
				}
				*/
				
		}
		
		function frmActionPerMiss($parameter,$sender)
		{
			$countsubmodule=$sender->getvalue("countsubmodule");
			$moduleIDusertype=$sender->getvalue("moduleIDusertype");
			
			$dao=new PermissDao();
				for($i=0;$i<$countsubmodule;$i++)
			{
				$o=new permiss();
				$o->permissID=$sender->getvalue("permissID-$i");
				$o->version=$sender->getvalue("version-$i");

				$permissView=$sender->getvalue("permissView-$i");
				if($permissView[0]=="true")
					$o->permissView="true";
				else
					$o->permissView="false";
				$permissAdd=$sender->getvalue("permissAdd-$i");
				if($permissAdd[0]=="true")
					$o->permissAdd="true";
				else
					$o->permissAdd="false";
				$permissEdit=$sender->getvalue("permissEdit-$i");
				if($permissEdit[0]=="true")
					$o->permissEdit="true";
				else
					$o->permissEdit="false";
				$permissDel=$sender->getvalue("permissDel-$i");
				if($permissDel[0]=="true")
					$o->permissDel="true";
				else
					$o->permissDel="false";
				
				$dao->update($o);
				
				$permissView="";
				$permissAdd="";
				$permissEdit="";
				$permissDel="";
				$o->permissID="";
				$o->version="";
				}
			Refreshs("Module.ShowSubModule&moduleID=$moduleIDusertype","alert","update");
				
		}
		function frmActionUsertype($parameter,$sender)
		{

			$value[1]=ShowSubModule::$Grid1->getvalues("submoduleID",$parameter);
			
			$dao=new SubModuleDao();
			$o=$dao->selectById($value[1]);
			
			Refreshs("Module.frmPermission&moduleID=$o->moduleID&submoduleID=$value[1]",",","");

			
		}

		function frmActionStatus($parameter,$sender)
		{
			$o=new submodule();
			$submoduleID=ShowSubModule::$Grid1->getvalues("submoduleID",$parameter);
			$dao=new SubModuleDao();
			$o_chk=$dao->selectById($submoduleID);
			$o->submoduleID=$o_chk->submoduleID;
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

			Refreshs("Module.ShowSubModule&moduleID=$o_chk->moduleID","alert","update");
		}
		
 }
?>