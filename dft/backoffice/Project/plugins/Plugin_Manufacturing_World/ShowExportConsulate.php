<?php
require_once("Project/plugins/Plugin_Manufacturing_World/Dao/Plugin_Manufacturing_WorldDao.php");
require_once("Project/plugins/Plugin_Manufacturing_World/Common/plugin_manufacturing_world.php");

require_once("Project/plugins/Plugin_Manufacturing_World/Dao/Plugin_Manufacturing_World_Export_ConsulateDao.php");
require_once("Project/plugins/Plugin_Manufacturing_World/Common/plugin_manufacturing_world_export_consulate.php");

require_once("Project/plugins/Plugin_Source/Dao/Plugin_SourceDao.php");
require_once("Project/plugins/Plugin_Source/Common/plugin_source.php");

class  ShowExportConsulate extends TForm
{
	public static $Grid1;
	function ShowExportConsulate()
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
			$this->Init("ShowExportConsulate","Plugin_Manufacturing_World","form-horizontal row-border",true);
				
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
				
				$form=new TInputfile();
				$form->set('fileexcel',"","","",true,"String",false);
				$form->setAttribute("class","form-control");
				$this->add($form);

				$form=new TButton();
				$form->set("bnexcel","บันทึก Excel","","",true,"String",false);
				$form->setEvent("onclick","frmActionExcel");
				$form->setAttribute("class","btn btn-primary");
				$this->Add($form);


				$dao_source=new Plugin_SourceDao();
					$o_source=$dao_source->selectAllByDataID($o_manufacturing_world->worldID."_1_3");

				$form=new THidden();
				$form->set("dataID",$o_manufacturing_world->worldID."_1_3","","",true,"","");
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
		
			
			$dao=new Plugin_Manufacturing_World_Export_ConsulateDao();
				$o=$dao->selectAllByWorldID($worldID);

			ShowExportConsulate::$Grid1=new TGridview();
			ShowExportConsulate::$Grid1->setview("Grid1",$o);

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
			ShowExportConsulate::$Grid1->addcontrol($grid);
			
			$grid=new TTextBox();
			$grid->set('country',"","","",true,"",false);
			$grid->title='ประเทศ';
			$grid->setAttribute("class","form-control");
			ShowExportConsulate::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("quantity","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='ปริมาณ (ก.ก)';
			ShowExportConsulate::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("consulateValue","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='มูลค่า (เหรียญสหรัฐ)';
			ShowExportConsulate::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("consulateShare","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='% Share';
			ShowExportConsulate::$Grid1->addcontrol($grid);


			ShowExportConsulate::$Grid1->View=false;
			ShowExportConsulate::$Grid1->Edit=false;
			ShowExportConsulate::$Grid1->Delete=$o_per[0]->permissDel;
			$this->Add(ShowExportConsulate::$Grid1);

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
			ShowExportConsulate::$Grid1->gotopage($v[1]);
			ShowExportConsulate::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowExportConsulate::$Grid1->gotopage($v[1]);
			ShowExportConsulate::$Grid1->changenumpage($v[0]);
		}
		function Grid1_View($parameter,$sender)
		{
			
		}
		function frmNew($parameter,$sender)
		{
			$o=new plugin_manufacturing_world_export_consulate();
			$o->worldID=$sender->getdata('worldID');
			$o->creationUser=$_SESSION["Session_User_UserID"];
			$o->status="Open";

			$dao=new Plugin_Manufacturing_World_Export_ConsulateDao();
			$dao->save($o);
			Refreshs("Plugin_Manufacturing_World/ShowExportConsulate&worldID=$o->worldID","alert","save");
		}
		function frmAction($parameter,$sender)
		{
			$o=new plugin_manufacturing_world_export_consulate();

			//$o->genID=$sender->getdata('genID');
			$o->worldID=$sender->getdata('worldID');
			$o->version=$sender->getdata('version');
			$o->country=$sender->getdata('country');
			$o->quantity=$sender->getdata('quantity_box');
			$o->consulateValue=$sender->getdata('consulateValue_box');
			$o->consulateShare=$sender->getdata('consulateShare_box');

			$o->creationUser=$_SESSION["Session_User_UserID"];
			$o->status="Open";
			$dao=new Plugin_Manufacturing_World_Export_ConsulateDao();
			
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

				Refreshs("Plugin_Manufacturing_World/ShowExportConsulate&worldID=$o->worldID","alert","save");
					
			}
		}

		function Grid1_Editing($parameter,$sender)
		{
			$dao=new Plugin_Manufacturing_World_Export_ConsulateDao();

			for($i=ShowExportConsulate::$Grid1->getstart();$i<ShowExportConsulate::$Grid1->getstop();$i++)
			{
				$o=new plugin_manufacturing_world_export_consulate();
				

				$o->consulateID=ShowExportConsulate::$Grid1->getvalues("consulateID",$i);
				
				$o->country=ShowExportConsulate::$Grid1->getvalues("country",$i);
				$o->quantity=ShowExportConsulate::$Grid1->getvalues("quantity",$i);
				$o->consulateValue=ShowExportConsulate::$Grid1->getvalues("consulateValue",$i);
				$o->consulateShare=ShowExportConsulate::$Grid1->getvalues("consulateShare",$i);

				$o_update=$dao->selectById($o->consulateID);
				$o->version=$o_update->version;

				if($o->consulateID and $o->quantity)
				{
					
					$dao->update($o);
					$o->version="";
					$o->consulateID="";
				}

				
				
			}
			
			$worldID=$sender->getdata('worldID');
			Refreshs("Plugin_Manufacturing_World/ShowExportConsulate&worldID=$worldID","alert","update");

		}
		function Grid1_Deleting($parameter,$sender)
		{
			$o=new plugin_manufacturing_world_export_consulate();
			$o->consulateID=ShowExportConsulate::$Grid1->getvalues("consulateID",$parameter);
			$dao=new Plugin_Manufacturing_World_Export_ConsulateDao();

			$dao->deletes($o);

			$worldID=$sender->getdata('worldID');
			Refreshs("Plugin_Manufacturing_World/ShowExportConsulate&worldID=$worldID","alert","del");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new Plugin_Manufacturing_World_Export_ConsulateDao();

			for($i=ShowExportConsulate::$Grid1->getstart();$i<ShowExportConsulate::$Grid1->getstop();$i++)
			{
				$o=new plugin_manufacturing_world_export_consulate();
				
				$o->consulateID=ShowExportConsulate::$Grid1->getvalues("consulateID",$i);
				
				$o->cartoonpartIDCheck=ShowExportConsulate::$Grid1->getvalues("cartoonpartIDCheck",$i);
				if($o->cartoonpartIDCheck)
				{
					if($o->consulateID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->consulateID="";
					}
				}
				
			}
			
			$worldID=$sender->getdata('worldID');
			Refreshs("Plugin_Manufacturing_World/ShowExportConsulate&worldID=$worldID","alert","del");
		}
		function frmActionExcel($parameter,$sender)
		{
			$worldID=$sender->getdata('worldID');


			$userfile=$sender->getvalue('fileexcel');
			$Datef=Date("d-m-y");
			$Timef=Date("H-i-s");
			$Datef=ereg_replace("-","",$Datef);
			$Timef=ereg_replace("-","",$Timef); 
			$Fname="excel_".$Datef."_".$Timef;

			$excel_file=uploadFile(0,"./Upload/File",$Fname,$userfile);


				
			//$file_name=$userfile["name"][0];
			$file_name=$excel_file;

			$inputFileType = 'Excel5';
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($file_name);


			$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			
			$dao=new Plugin_Manufacturing_World_Export_ConsulateDao();

			for($i=3;$i<=count($sheetData);$i++)
			{
				
				$o=new plugin_manufacturing_world_export_consulate();

				$o->worldID=$worldID;
				$o->country=$sheetData[$i]["A"];
				$o->quantity=$sheetData[$i]["B"];
				$o->consulateValue=$sheetData[$i]["C"];
				$o->consulateShare=$sheetData[$i]["D"];

				$o->creationUser=$_SESSION["Session_User_UserID"];
				$o->status="Open";
				
				$o_check_name=$dao->selectAllByWorldIDAndName($worldID,$o->country);

				if($o_check_name[0]->consulateID)
				{
					$o->consulateID=$o_check_name[0]->consulateID;
					$o->version=$o_check_name[0]->version;

					$dao->update($o);
				}
				else
				{
					$dao->save($o);	
				}
				
			}
			Refreshs("Plugin_Manufacturing_World/ShowExportConsulate&worldID=$worldID","alert","save");
			
			

			
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
			Refreshs("Plugin_Manufacturing_World/ShowExportConsulate&worldID=$worldID","alert","save");
		}
		
		
}
?>