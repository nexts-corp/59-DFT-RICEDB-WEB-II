<?php
require_once("Project/plugins/Plugin_Info_Type/Dao/Plugin_Info_TypeDao.php");
require_once("Project/plugins/Plugin_Info_Type/Common/plugin_info_type.php");

 class  ShowInfoType extends TForm
 {
	 public static $Grid1;
	 function ShowInfoType()
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
				$this->Init("ShowInfoType","Plugin_Info_Type","",true);
						
					
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
			
				$dao=new Plugin_Info_TypeDao();
				$o=$dao->selectAll();
				
				ShowInfoType::$Grid1=new TGridtable();
				ShowInfoType::$Grid1->setgridtable("Grid1",$o);

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

						$o[$i]->linksub="<a href='?page=".$o[$i]->url."&infoTypeID=".$o[$i]->infoTypeID."' class='btn btn-xs btn-primary' >ข้อมูลเพิ่มเติม</a>";
				}

				$grid=new TCheckbox();
				$grid->set('cartoonpartIDCheck',"","","40",true,"",false);
				$grid->additem(" ","");
				$grid->title=' ';
				ShowInfoType::$Grid1->addcontrol($grid);
				
				$grid=new TLabel();
				$grid->set('infoTypeName',"","","",true,"",false);
				$grid->title='ประเภทข้อมูล';
				ShowInfoType::$Grid1->addcontrol($grid);

				$linksub=new TGridLink();
				$linksub->set('linksub',$o->linksub,"","","true","","");
				$linksub->title='จัดการ';
				ShowInfoType::$Grid1->addcontrol($linksub);


				$grid=new TLabel();
				$grid->set('infoTypeNumber',"","","",true,"",false);
				$grid->title='ลำดับการแสดงผล';
				ShowInfoType::$Grid1->addcontrol($grid);


				$status=new TGridLink();
				$status->set('status',$o->status,"","","true","","");
				$status->title='สถานะ';
				$status->setEvent("onclick","frmActionStatus");
				ShowInfoType::$Grid1->addcontrol($status);

				ShowInfoType::$Grid1->View=false;
				ShowInfoType::$Grid1->Edit=$o_per[0]->permissEdit;
				ShowInfoType::$Grid1->Delete=$o_per[0]->permissDel;
				$this->Add(ShowInfoType::$Grid1);


	 $this->waitevent();
		}
		function Grid1_rowperpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowInfoType::$Grid1->gotopage($v[1]);
			ShowInfoType::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowInfoType::$Grid1->gotopage($v[1]);
			ShowInfoType::$Grid1->changenumpage($v[0]);
		}
		function Grid1_View($parameter,$sender)
		{
			//$value[1]=ShowInfoType::$Grid1->getvalues("moduleID",$parameter);
			//fRefresh("","page,object_id","Register.frmRegister,$value[1]");
		}
		 function Grid1_Editing($parameter,$sender)
		{
			$value[1]=ShowInfoType::$Grid1->getvalues("infoTypeID",$parameter);
			Refreshs("Plugin_Info_Type/frmInfoType","object_id",$value[1]);
		}
		function Grid1_Deleting($parameter,$sender)
		{
			$o=new plugin_info_type();
			$o->infoTypeID=ShowInfoType::$Grid1->getvalues("infoTypeID",$parameter);

			$dao=new Plugin_Info_TypeDao();
			$dao->deletes($o);
			Refreshs("Plugin_Info_Type/ShowInfoType","alert","del");
		}
		function frmAction($parameter,$sender)
		{
				fRefresh("","page","Plugin_Info_Type/frmInfoType");
		}
		function frmActionStatus($parameter,$sender)
		{
			$o=new plugin_info_type();
			$infoTypeID=ShowInfoType::$Grid1->getvalues("infoTypeID",$parameter);
			
			$dao=new Plugin_Info_TypeDao();
			$o_chk=$dao->selectById($infoTypeID);
			$o->infoTypeID=$o_chk->infoTypeID;
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

			Refreshs("Plugin_Info_Type/ShowInfoType","alert","update");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new Plugin_Info_TypeDao();

			for($i=ShowInfoType::$Grid1->getstart();$i<ShowInfoType::$Grid1->getstop();$i++)
			{
				$o=new plugin_info_type();
				
				$o->infoTypeID=ShowInfoType::$Grid1->getvalues("infoTypeID",$i);
				
				$o->cartoonpartIDCheck=ShowInfoType::$Grid1->getvalues("cartoonpartIDCheck",$i);
				if($o->cartoonpartIDCheck)
				{
					if($o->infoTypeID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->infoTypeID="";
					}
				}
				
			}
				Refreshs("Plugin_Info_Type/ShowInfoType","alert","del");
		}
		
 }
?>