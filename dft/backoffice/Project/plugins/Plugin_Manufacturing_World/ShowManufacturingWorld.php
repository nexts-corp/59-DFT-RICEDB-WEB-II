<?php
require_once("Project/plugins/Plugin_Manufacturing_World/Dao/Plugin_Manufacturing_WorldDao.php");
require_once("Project/plugins/Plugin_Manufacturing_World/Common/plugin_manufacturing_world.php");

class  ShowManufacturingWorld extends TForm
{
	public static $Grid1;
	function ShowManufacturingWorld()
	{
		$dao_submodule=new SubModuleDao();
			$o_submodule=$dao_submodule->selectAllBySystem("plugin_manufacturing_world");

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
			$this->Init("ShowManufacturingWorld","Plugin_Manufacturing_World","",true);
				
			
			$alert=$this->getdata("alert");

			if($alert)
			{
				
				$alertmsg=new TLabel();
				$alertmsg->set("alertmsg",alerts($alert),"","",true,"","");
				$this->add($alertmsg);

			}
			
			if($o_per[0]->permissAdd=="true")
			{
				$form=new TButton();
				$form->set("bn"," เพิ่มข้อมูลใหม่","","",true,"","");
				$form->setEvent("onclick","frmNew");
				$form->setAttribute("class","btn btn-xs btn-primary");
				//$form->setAttribute("data-toggle","modal");
				//$form->setAttribute("href","#myModal1");
				$this->Add($form);

				$form=new TTextBox();
				$form->set('worldYear',"","","",true,"String",true); 
				$form->setAttribute("class","form-control");
				$form->setAttribute("placeholder","ข้อมูล ณ วันที่");
				$this->add($form);

				$form=new TButton();
				$form->set("bnsave","บันทึกข้อมูล","","",true,"String",true);
				$form->setEvent("onclick","frmAction");
				$form->setAttribute("class","btn btn-primary");
				$this->Add($form);
			}
			
			if($o_per[0]->permissDel=="true")
			{
				$bndelgrid=new TButton();
				$bndelgrid->set("bndelgrid"," ลบข้อมูล","","",true,"","");
				$bndelgrid->setEvent_Confirm("onclick","frmDelAll",true,"คุณต้องการลบข้อมูลใช่หรือไม่");
				$bndelgrid->setAttribute("class","btn btn-xs btn-danger");
				$this->Add($bndelgrid);
			}
		
			$dao=new Plugin_Manufacturing_WorldDao();
			$o=$dao->selectAll();
			
			ShowManufacturingWorld::$Grid1=new TGridtable();
			ShowManufacturingWorld::$Grid1->setgridtable("Grid1",$o);

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
				$o[$i]->adddata="";
				
				$o[$i]->generate="<button class='btn btn-info'>ผลผลิตและการบริโภค</button>";

				$o[$i]->Import="<button class='btn btn-info'>การนำเข้า</button>";

				$o[$i]->Export="<button class='btn btn-info'>การส่งออก</button>";
				$o[$i]->ExportConsulate="<button class='btn btn-info'>การส่งออก (กรมศุลฯ)</button>";
				$o[$i]->ExportTypeRice="<button class='btn btn-info'>การส่งออก แยกตามชนิดข้าว</button>";
				
			}

			$grid=new TCheckbox();
			$grid->set('cartoonpartIDCheck',"","","40",ture,'reqstring',false);
			$grid->additem(" ","");
			$grid->title=' ';
			ShowManufacturingWorld::$Grid1->addcontrol($grid);
			
			$grid=new TLabel();
			$grid->set('worldYear',"","","",true,"",false);
			$grid->title='ข้อมูล ณ วันที่';
			ShowManufacturingWorld::$Grid1->addcontrol($grid);

			$grid=new TGridLink();
			$grid->set('generate',"","","","true","","");
			$grid->title='ข้อมูลการผลิตและบริโภค';
			$grid->setEvent("onclick","frmActionGenerate");
			ShowManufacturingWorld::$Grid1->addcontrol($grid);

			$grid=new TGridLink();
			$grid->set('Export',"","","","true","","");
			$grid->title='การส่งออก';
			$grid->setEvent("onclick","frmActionExport");
			ShowManufacturingWorld::$Grid1->addcontrol($grid);

			$grid=new TGridLink();
			$grid->set('ExportConsulate',"","","","true","","");
			$grid->title='การส่งออก (กรมศุลฯ)';
			$grid->setEvent("onclick","frmActionExportConsulate");
			ShowManufacturingWorld::$Grid1->addcontrol($grid);

			$grid=new TGridLink();
			$grid->set('ExportTypeRice',"","","","true","","");
			$grid->title='การส่งออก แยกตามชนิดข้าว';
			$grid->setEvent("onclick","frmActionExportTypeRice");
			ShowManufacturingWorld::$Grid1->addcontrol($grid);
			
			$grid=new TGridLink();
			$grid->set('Import',"","","","true","","");
			$grid->title='การนำเข้า';
			$grid->setEvent("onclick","frmActionImport");
			ShowManufacturingWorld::$Grid1->addcontrol($grid);


			$status=new TGridLink();
			$status->set('status',$o->status,"","","true","","");
			$status->title='เปิด / ปิด';
			$status->setEvent("onclick","frmActionStatus");
			ShowManufacturingWorld::$Grid1->addcontrol($status);

			ShowManufacturingWorld::$Grid1->View=false;
			ShowManufacturingWorld::$Grid1->Edit=$o_per[0]->permissEdit;
			ShowManufacturingWorld::$Grid1->Delete=$o_per[0]->permissDel;
			$this->Add(ShowManufacturingWorld::$Grid1);


	 	$this->waitevent();
	}
		function Grid1_rowperpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowManufacturingWorld::$Grid1->gotopage($v[1]);
			ShowManufacturingWorld::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowManufacturingWorld::$Grid1->gotopage($v[1]);
			ShowManufacturingWorld::$Grid1->changenumpage($v[0]);
		}
		function Grid1_View($parameter,$sender)
		{
			
		}
		function Grid1_Editing($parameter,$sender)
		{
			$value[1]=ShowManufacturingWorld::$Grid1->getvalues("worldID",$parameter);

			$dao=new Plugin_Manufacturing_WorldDao();
			$o_update="";
			$o_update=$dao->selectById($value[1]);
			
			$form=new THidden();
			$form->set("worldID_id",$o_update->worldID,"","",true,"String",false); 
			$sender->add($form);

			$form=new THidden();
			$form->set("version",$o_update->version,"","",true,"String",false); 
			$sender->add($form);

			$form=new TTextBox();
			$form->set("worldYear",$o_update->worldYear,"","",true,"String",true); 
			$form->setAttribute("class","form-control");
			$form->setAttribute("placeholder","ข้อมูล ณ วันที่");
			$sender->add($form);

			$form=new TLabel();
			$form->set('labelModal',"
			<script>

				$( document ).ready(function() {
				    $('#myModal1').modal('show');
				});
			</script>
			",30,30,true,"String",false); 
			$sender->add($form);
			//Refreshs("Plugin_New_Type/frmNewType","object_id",$value[1]);
		}
		function Grid1_Deleting($parameter,$sender)
		{
			$o=new plugin_manufacturing_world();
			$o->worldID=ShowManufacturingWorld::$Grid1->getvalues("worldID",$parameter);
			$dao=new Plugin_Manufacturing_WorldDao();

			$dao->deletes($o);
			Refreshs("Plugin_Manufacturing_World/ShowManufacturingWorld","alert","del");
		}
		function frmNew($parameter,$sender)
		{
			$form=new TLabel();
			$form->set('labelModal',"
			<script>

				$( document ).ready(function() {
				    $('#myModal1').modal('show');
				});
			</script>
			",30,30,true,"String",false); 
			$sender->add($form);
		}
		function frmAction($parameter,$sender)
		{
			$o=new plugin_manufacturing_world();

			$o->worldID=$sender->getdata('worldID_id');
			$o->version=$sender->getdata('version');
			$o->worldYear=$sender->getdata('worldYear');
			$o->creationUser=$_SESSION["Session_User_UserID"];
			$o->status="Open";
			$dao=new Plugin_Manufacturing_WorldDao();
			
			if($o->worldID)
			{
				$dao->update($o);
				Refreshs("Plugin_Manufacturing_World/ShowManufacturingWorld","alert","update");
			}
			else
			{
				$dao->save($o);
				Refreshs("Plugin_Manufacturing_World/ShowManufacturingWorld","alert","save");
					
			}
		}
		function frmActionStatus($parameter,$sender)
		{
			$o=new plugin_manufacturing_world();
			$worldID=ShowManufacturingWorld::$Grid1->getvalues("worldID",$parameter);
			
			$dao=new Plugin_Manufacturing_WorldDao();
			$o_chk=$dao->selectById($worldID);
			$o->worldID=$o_chk->worldID;
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

			Refreshs("Plugin_Manufacturing_World/ShowManufacturingWorld","alert","update");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new Plugin_Manufacturing_WorldDao();

			for($i=ShowManufacturingWorld::$Grid1->getstart();$i<ShowManufacturingWorld::$Grid1->getstop();$i++)
			{
				$o=new plugin_manufacturing_world();
				
				$o->worldID=ShowManufacturingWorld::$Grid1->getvalues("worldID",$i);
				
				$o->cartoonpartIDCheck=ShowManufacturingWorld::$Grid1->getvalues("cartoonpartIDCheck",$i);
				if($o->cartoonpartIDCheck)
				{
					if($o->worldID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->worldID="";
					}
				}
				
			}
			
			Refreshs("Plugin_Manufacturing_World/ShowManufacturingWorld","alert","del");
		}
		function frmActionGenerate($parameter,$sender)
		{
			$worldID=ShowManufacturingWorld::$Grid1->getvalues("worldID",$parameter);
			fRefresh("","page","Plugin_Manufacturing_World/ShowGenerate&worldID=$worldID");

		}
		function frmActionExport($parameter,$sender)
		{
			$worldID=ShowManufacturingWorld::$Grid1->getvalues("worldID",$parameter);
			fRefresh("","page","Plugin_Manufacturing_World/ShowExport&worldID=$worldID");

		}
		function frmActionImport($parameter,$sender)
		{
			$worldID=ShowManufacturingWorld::$Grid1->getvalues("worldID",$parameter);
			fRefresh("","page","Plugin_Manufacturing_World/ShowImport&worldID=$worldID");
		}
		function frmActionExportConsulate($parameter,$sender)
		{
			$worldID=ShowManufacturingWorld::$Grid1->getvalues("worldID",$parameter);
			fRefresh("","page","Plugin_Manufacturing_World/ShowExportConsulate&worldID=$worldID");
		}
		function frmActionExportTypeRice($parameter,$sender)
		{
			$worldID=ShowManufacturingWorld::$Grid1->getvalues("worldID",$parameter);
			fRefresh("","page","Plugin_Manufacturing_World/ShowExportTypeRice&worldID=$worldID");
		}
		
		
		
		
}
?>