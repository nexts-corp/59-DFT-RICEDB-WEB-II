<?php
require_once("Project/bussiness/ModuleDao.php");
require_once("Project/common/module.php");

require_once("Project/bussiness/SubModuleDao.php");
require_once("Project/common/submodule.php");

require_once("Project/bussiness/UserTypeDao.php");
require_once("Project/common/usertype.php");

require_once("Project/bussiness/PermissDao.php");
require_once("Project/common/permiss.php");

 class frmPermission extends TForm
 {
	 	
		function frmPermission()
		{
			$this->Init("frmPermission","Module","form-horizontal",true);
			
			$submoduleID=$this->getdata("submoduleID");

			$module=$this->getdata("moduleID");

			$dao_module=new ModuleDao();
				$o_module=$dao_module->selectById($module);

						$moduleSystem=new TLabel();
						$moduleSystem->set("moduleSystem",$o_module->moduleSystem,"","",true,"","");
						$this->add($moduleSystem);

						$moduleIDView=new TLabel();
						$moduleIDView->set("moduleIDView",$o_module->moduleID,"","",true,"","");
						$this->add($moduleIDView);

			$dao_per=new PermissDao();
			$dao_usertype=new UserTypeDao();
			$dao_submodule=new SubModuleDao();
			

			$o_submodule=$dao_submodule->selectById($submoduleID);//ตรวจสอบชื่อ submodule
						
			$submoduleNametype=new TLabel();
			$submoduleNametype->set("submoduleNametype",$o_submodule->submoduleName,"","",true,"","");
			$this->add($submoduleNametype);

				$pn=new TPanel();
				$pn->set("pn","","","",true,"","");
				$this->add($pn);
			
			$countusertype=explode(",",$o_module->usertypeID);
			for($i=0;$i<count($countusertype);$i++)
				{
			$o_usertype=$dao_usertype->selectById($countusertype[$i]);
			$o_per=$dao_per->selectAllBySubModule($submoduleID,$countusertype[$i]);//ตรวจสอบสิทธิ
			$pn->append("<omdae:THidden id='countsubmodule' />");
			$pn->append("<omdae:THidden id='permissID-$i' />");
			$pn->append("<omdae:THidden id='version-$i' />");
			$pn->append("<omdae:THidden id='usertypeID-$i' />");
			
			
			$pn->append("
			<div class='widget widget-4'>
				<div class='widget-head'><h4 class='heading'>$o_usertype->usertypeName</h4></div>
				<div class='separator'></div>
					<div class='row-fluid'>
				
			");
			$pn->append("<div class='form-group'>
											<label class='control-label col-md-3'>เข้าถึงการแสดงข้อมูล : </label>
											  <div class='col-md-9'>
													<omdae:TCheckbox id='permissView-$i' />
											 </div>
										</div>  ");

			$pn->append("<div class='form-group'>
											<label class='control-label col-md-3'>เข้าถึงการเพิ่มข้อมูล : </label>
											  <div class='col-md-9'>
													<omdae:TCheckbox id='permissAdd-$i' />
											 </div>
										</div>  ");

			$pn->append("<div class='form-group'>
											<label class='control-label col-md-3'>เข้าถึงการแก้ไขข้อมูล : </label>
											  <div class='col-md-9'>
													<omdae:TCheckbox id='permissEdit-$i' />
											 </div>
										</div>  ");

			$pn->append("<div class='form-group'>
											<label class='control-label col-md-3'>เข้าถึงการลบข้อมูล : </label>
											  <div class='col-md-9'>
													<omdae:TCheckbox id='permissDel-$i' />
											 </div>
										</div>  ");
			
			$pn->append("
									</div>
								</div><hr />");
			
			$permissID=new THidden();
			$permissID->set("permissID-$i",$o_per[0]->permissID,30,30,true,"String",false); 
			$this->add($permissID);

			$version=new THidden();
			$version->set("version-$i",$o_per[0]->version,30,30,true,"String",false); 
			$this->add($version);
			
			
			$permissView=new TCheckbox();
			$permissView->set("permissView-$i",$o_per[0]->permissView,30,30,true,"String",true); 
			$permissView->additem("true","แสดงข้อมูล");
			$permissView->setAttribute("class","uniform");
			$this->add($permissView);

			$permissAdd=new TCheckbox();
			$permissAdd->set("permissAdd-$i",$o_per[0]->permissAdd,30,30,true,"String",true); 
			$permissAdd->additem("true","การเพิ่มข้อมูล");
			$permissAdd->setAttribute("class","uniform");
			$this->add($permissAdd);

			$permissEdit=new TCheckbox();
			$permissEdit->set("permissEdit-$i",$o_per[0]->permissEdit,30,30,true,"String",true); 
			$permissEdit->additem("true","การแก้ไขข้อมูล");
			$permissEdit->setAttribute("class","uniform");
			$this->add($permissEdit);

			$permissDel=new TCheckbox();
			$permissDel->set("permissDel-$i",$o_per[0]->permissDel,30,30,true,"String",true); 
			$permissDel->additem("true","การลบข้อมูล");
			$permissDel->setAttribute("class","uniform");
			$this->add($permissDel);
			
			
			$countsubmodule=new THidden();
			$countsubmodule->set("countsubmodule",count($countusertype),30,30,true,"String",false); 
			$this->add($countsubmodule);
			
			$usertypeID=new THidden();
			$usertypeID->set("usertypeID-$i",$o_usertype->usertypeID,30,30,true,"String",false); 
			$this->add($usertypeID);
			
				}
			

			$submoduleIDView=new THidden();
			$submoduleIDView->set("submoduleIDView",$submoduleID,30,30,true,"String",false); 
			$this->add($submoduleIDView);

			$bnper=new TButton();
			$bnper->set("bn","บันทึกข้อมูล","","",true,"String",true);
			$bnper->setEvent("onclick","frmAction");
			$bnper->setAttribute("class","btn btn-primary");
			$this->Add($bnper);

			$bnreset=new TResets();
			$bnreset->set("bnreset","ล้างข้อมูล","","",true,"String",true);
			$bnreset->setAttribute("class","btn");
			$this->Add($bnreset);

			$this->waitevent();
		}
		function frmAction($parameter,$sender)
		{
			$countsubmodule=$sender->getvalue("countsubmodule");
			$moduleIDusertype=$sender->getvalue("moduleIDusertype");
			
		
			$dao=new PermissDao();
				for($i=0;$i<$countsubmodule;$i++)
			{
				$o=new permiss();
				$o->moduleID=$sender->getvalue("moduleIDView");
				$o->submoduleID=$sender->getvalue("submoduleIDView");
				$o->permissID=$sender->getvalue("permissID-$i");
				
				$o->version=$sender->getvalue("version-$i");
				$o->usertypeID=$sender->getvalue("usertypeID-$i");
				$o->creationUser=$_SESSION["Session_User_UserID"];
				$o->status="Open";
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
				
				if($o->permissID)
				{
					$dao->update($o);
				}
				else
				{
					$dao->save($o);
				}
				
				$permissView="";
				$permissAdd="";
				$permissEdit="";
				$permissDel="";
				$o->permissID="";
				$o->version="";
				}
			Refreshs("Module.ShowSubModule&moduleID=$o->moduleID","alert","update");
		}
 }

?>