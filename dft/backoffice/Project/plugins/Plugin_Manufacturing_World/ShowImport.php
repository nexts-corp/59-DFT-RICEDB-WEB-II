<?php
require_once("Project/plugins/Plugin_Manufacturing_World/Dao/Plugin_Manufacturing_WorldDao.php");
require_once("Project/plugins/Plugin_Manufacturing_World/Common/plugin_manufacturing_world.php");

require_once("Project/plugins/Plugin_Manufacturing_World/Dao/Plugin_Manufacturing_World_ImportDao.php");
require_once("Project/plugins/Plugin_Manufacturing_World/Common/plugin_manufacturing_world_import.php");

require_once("Project/plugins/Plugin_Source/Dao/Plugin_SourceDao.php");
require_once("Project/plugins/Plugin_Source/Common/plugin_source.php");

class  ShowImport extends TForm
{
	public static $Grid1;
	function ShowImport()
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
			$this->Init("ShowImport","Plugin_Manufacturing_World","form-horizontal row-border",true);
				
			$worldID=$this->getdata("worldID");

			$dao_manufacturing_world=new Plugin_Manufacturing_WorldDao();
				$o_manufacturing_world=$dao_manufacturing_world->selectById($worldID);

			if($o_manufacturing_world)
			{

				$form=new THidden();
				$form->set("worldID",$o_manufacturing_world->worldID,"","",true,"","");
				$this->add($form);

				$form=new TLabel();
				$form->set("worldYear",$o_manufacturing_world->worldYear,"","",true,"","");
				$this->add($form);
			}
			

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

				$form=new TButton();
				$form->set("bnauto"," เพิ่มประเทศเริ่มต้น","","",true,"","");
				$form->setEvent("onclick","frmNewAuto");
				$form->setAttribute("class","btn btn-xs btn-primary");
				$this->Add($form);


				$dao_source=new Plugin_SourceDao();
					$o_source=$dao_source->selectAllByDataID($o_manufacturing_world->worldID."_1_5");

				$form=new THidden();
				$form->set("dataID",$o_manufacturing_world->worldID."_1_5","","",true,"","");
				$this->add($form);

				$form=new THidden();
				$form->set("sourceID",$o_source[0]->sourceID,"","",true,"","");
				$this->add($form);

				$form=new THidden();
				$form->set("version_source",$o_source[0]->version,"","",true,"","");
				$this->add($form);

				$form=new TTextBox();
				$form->set('sourceName',$o_source[0]->sourceName,"","",true,"String",true); 
				$form->setAttribute("class","form-control");
				$form->setAttribute("placeholder","แหล่งที่มาของข้อมูล");
				$this->add($form);

				$form=new TButton();
				$form->set("bnsource","เพิ่มแหล่งที่มา","","",true,"",false);
				$form->setEvent("onclick","frmSource");
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
		
			
			$dao=new Plugin_Manufacturing_World_ImportDao();
				$o=$dao->selectAllByWorldID($worldID);

			ShowImport::$Grid1=new TGridview();
			ShowImport::$Grid1->setview("Grid1",$o);

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
			ShowImport::$Grid1->addcontrol($grid);
			
			$grid=new TTextBox();
			$grid->set('country',"","","",true,"",false);
			$grid->title='ประเทศ';
			$grid->setAttribute("class","form-control");
			ShowImport::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("ricevalues","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='ปริมาณ (ล้านตันข้าวสาร)';
			ShowImport::$Grid1->addcontrol($grid);


			ShowImport::$Grid1->View=false;
			ShowImport::$Grid1->Edit=false;
			ShowImport::$Grid1->Delete=$o_per[0]->permissDel;
			$this->Add(ShowImport::$Grid1);

			$form=new TButton();
			$form->set("bnupdate","อับเดตข้อมูล","","",true,"String",false);
			$form->setEvent("onclick","Grid1_Editing");
			$form->setAttribute("class","btn btn-primary");
			$this->Add($form);

	 	$this->waitevent();
	}
		function Grid1_rowperpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowImport::$Grid1->gotopage($v[1]);
			ShowImport::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowImport::$Grid1->gotopage($v[1]);
			ShowImport::$Grid1->changenumpage($v[0]);
		}
		function Grid1_View($parameter,$sender)
		{
			
		}
		function Grid1_Editing($parameter,$sender)
		{
			$dao=new Plugin_Manufacturing_World_ImportDao();

			for($i=ShowImport::$Grid1->getstart();$i<ShowImport::$Grid1->getstop();$i++)
			{
				$o=new plugin_manufacturing_world_import();
				

				$o->importID=ShowImport::$Grid1->getvalues("importID",$i);
				
				$o->country=ShowImport::$Grid1->getvalues("country",$i);
				$o->ricevalues=ShowImport::$Grid1->getvalues("ricevalues",$i);

				$o_update=$dao->selectById($o->importID);
				$o->version=$o_update->version;

				if($o->importID and $o->ricevalues)
				{
					
					$dao->update($o);
					$o->version="";
					$o->importID="";
				}

				
				
			}
			
			$worldID=$sender->getdata('worldID');
			Refreshs("Plugin_Manufacturing_World/ShowImport&worldID=$worldID","alert","update");

		}
		function Grid1_Deleting($parameter,$sender)
		{
			$o=new plugin_manufacturing_world_import();
			$o->importID=ShowImport::$Grid1->getvalues("importID",$parameter);
			$dao=new Plugin_Manufacturing_World_ImportDao();

			$dao->deletes($o);

			$worldID=$sender->getdata('worldID');
			Refreshs("Plugin_Manufacturing_World/ShowImport&worldID=$worldID","alert","del");
		}
		function frmNew($parameter,$sender)
		{
			$o=new plugin_manufacturing_world_import();
			$o->worldID=$sender->getdata('worldID');
			$o->creationUser=$_SESSION["Session_User_UserID"];
			$o->status="Open";

			$dao=new Plugin_Manufacturing_World_ImportDao();
				$dao->save($o);

			Refreshs("Plugin_Manufacturing_World/ShowImport&worldID=$o->worldID","alert","save");

		}
		function frmNewAuto($parameter,$sender)
		{
			$array = array("อื่นๆ","สหรัฐ","ซาอุดิอาระเบีย","อิหร่าน","อินโดนีเซีย","ฟิลิปินส์","ไนจีเรีย","จีน");
			$worldID=$sender->getdata('worldID');
			$dao=new Plugin_Manufacturing_World_ImportDao();
			for($i=0;$i<count($array);$i++)
			{
				$o=new plugin_manufacturing_world_import();

				$o->worldID=$worldID;
				$o->country=$array[$i];
				$o->creationUser=$_SESSION["Session_User_UserID"];
				$o->status="Open";

				$o_check_name=$dao->selectAllByWorldIDAndName($worldID,$o->country);
				if(empty($o_check_name))
					$dao->save($o);

			}
			Refreshs("Plugin_Manufacturing_World/ShowImport&worldID=$worldID","alert","save");
		}
		function frmAction($parameter,$sender)
		{
			$o=new plugin_manufacturing_world_import();

			//$o->genID=$sender->getdata('genID');
			$o->worldID=$sender->getdata('worldID');
			$o->version=$sender->getdata('version');
			$o->country=$sender->getdata('country');
			$o->ricevalues=$sender->getdata('ricevalues_box');

			$o->creationUser=$_SESSION["Session_User_UserID"];
			$o->status="Open";
			$dao=new Plugin_Manufacturing_World_ImportDao();
			
			if($o->exportID)
			{

				$dao->update($o);
				Refreshs("Plugin_Manufacturing_World/ShowManufacturingWorld","alert","update");
			}
			else
			{

				$o_check_name=$dao->selectAllByWorldIDAndName($o->worldID,$o->country);
				if(empty($o_check_name))
					$dao->save($o);

				Refreshs("Plugin_Manufacturing_World/ShowImport&worldID=$o->worldID","alert","save");
					
			}
		}
		function frmActionStatus($parameter,$sender)
		{
			$o=new plugin_manufacturing_world();
			$worldID=ShowImport::$Grid1->getvalues("worldID",$parameter);
			
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
			$dao=new Plugin_Manufacturing_World_ImportDao();

			for($i=ShowImport::$Grid1->getstart();$i<ShowImport::$Grid1->getstop();$i++)
			{
				$o=new plugin_manufacturing_world_import();
				
				$o->importID=ShowImport::$Grid1->getvalues("importID",$i);
				
				$o->cartoonpartIDCheck=ShowImport::$Grid1->getvalues("cartoonpartIDCheck",$i);
				if($o->cartoonpartIDCheck)
				{
					if($o->importID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->importID="";
					}
				}
				
			}
			
			$worldID=$sender->getdata('worldID');
			Refreshs("Plugin_Manufacturing_World/ShowImport&worldID=$worldID","alert","del");
		}
		function frmSource($parameter,$sender)
		{

			$o=new plugin_source();

			$o->sourceID=$sender->getdata('sourceID');
			$o->version=$sender->getdata('version_source');
			$o->sourceName=$sender->getdata('sourceName');
			$o->dataID=$sender->getdata('dataID');

			$dao=new Plugin_SourceDao();
			if($o->sourceID)
			{
				$dao->update($o);
			}
			else
			{
				$dao->save($o);
			}

			$worldID=$sender->getdata('worldID');
			Refreshs("Plugin_Manufacturing_World/ShowImport&worldID=$worldID","alert","save");
		}
		
}
?>