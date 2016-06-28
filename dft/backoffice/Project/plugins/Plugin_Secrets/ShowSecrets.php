<?php

require_once("Project/bussiness/Plugin_SecretsDao.php");
require_once("Project/common/plugin_secrets.php");

 class  ShowSecrets extends TForm
 {
	 public static $Grid1;
	 function ShowSecrets()
		{
			$dao_submodule=new SubModuleDao();
				$o_submodule=$dao_submodule->selectAllBySystem("plugin_secrets");

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
				$this->Init("ShowSecrets","Plugin_Secrets","",true);
						
					
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

			


			
				$dao=new Plugin_SecretsDao();
				$o=$dao->selectAll();
				
				ShowSecrets::$Grid1=new TGridtable();
				ShowSecrets::$Grid1->setgridtable("Grid1",$o);

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

				
				
				$grid=new TLabel();
				$grid->set('nameInfo',"","","",true,"",false);
				$grid->title='หัวข้อ';
				ShowSecrets::$Grid1->addcontrol($grid);




				$status=new TGridLink();
				$status->set('status',$o->status,"","","true","","");
				$status->title='สถานะ';
				$status->setEvent("onclick","frmActionStatus");
				ShowSecrets::$Grid1->addcontrol($status);

				ShowSecrets::$Grid1->View=false;
				ShowSecrets::$Grid1->Edit=$o_per[0]->permissEdit;
				ShowSecrets::$Grid1->Delete=$o_per[0]->permissDel;
				$this->Add(ShowSecrets::$Grid1);


	 $this->waitevent();
		}
		function Grid1_rowperpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowSecrets::$Grid1->gotopage($v[1]);
			ShowSecrets::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowSecrets::$Grid1->gotopage($v[1]);
			ShowSecrets::$Grid1->changenumpage($v[0]);
		}
		function Grid1_View($parameter,$sender)
		{
			//$value[1]=ShowSecrets::$Grid1->getvalues("moduleID",$parameter);
			//fRefresh("","page,object_id","Register.frmRegister,$value[1]");
		}
		 function Grid1_Editing($parameter,$sender)
		{
			
			$value[1]=ShowSecrets::$Grid1->getvalues("secretsID",$parameter);
			Refreshs("Plugin_Secrets/frmSecrets","object_id",$value[1]);
		}
		function Grid1_Deleting($parameter,$sender)
		{
			$o=new plugin_puddy();
			$o->secretsID=ShowSecrets::$Grid1->getvalues("secretsID",$parameter);

			$dao=new Plugin_SecretsDao();
			$dao->deletes($o);
			Refreshs("Plugin_Secrets/ShowSecrets","alert","del");
		}
		function frmAction($parameter,$sender)
		{
				
				fRefresh("","page","Plugin_Secrets/frmSecrets");
		}
		function frmActionStatus($parameter,$sender)
		{
			$o=new plugin_puddy();
			$newID=ShowSecrets::$Grid1->getvalues("secretsID",$parameter);
			
			$dao=new Plugin_SecretsDao();
			$o_chk=$dao->selectById($secretsID);
			$o->secretsID=$o_chk->secretsID;
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

			Refreshs("Plugin_Secrets/ShowSecrets","alert","update");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new Plugin_SecretsDao();

			for($i=ShowSecrets::$Grid1->getstart();$i<ShowSecrets::$Grid1->getstop();$i++)
			{
				$o=new plugin_puddy();
				
				$o->secretsID=ShowSecrets::$Grid1->getvalues("secretsID",$i);
				
				$o->cartoonpartIDCheck=ShowSecrets::$Grid1->getvalues("cartoonpartIDCheck",$i);
				if($o->cartoonpartIDCheck)
				{
					if($o->secretsID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->secretsID="";
					}
				}
				
			}
				Refreshs("Plugin_Secrets/ShowSecrets","alert","del");
		}
		
 }
?>