<?php
require_once("Project/plugins/Plugin_Costs_Rice/Dao/Plugin_Costs_RiceDao.php");
require_once("Project/plugins/Plugin_Costs_Rice/Common/plugin_costs_rice.php");

require_once("Project/plugins/Plugin_Costs_Rice/Dao/Plugin_Costs_Rice_DataDao.php");
require_once("Project/plugins/Plugin_Costs_Rice/Common/plugin_costs_rice_data.php");

require_once("Project/plugins/Plugin_Source/Dao/Plugin_SourceDao.php");
require_once("Project/plugins/Plugin_Source/Common/plugin_source.php");

class  ShowCostsRiceData extends TForm
{
	public static $Grid1;
	function ShowCostsRiceData()
	{
		$dao_submodule=new SubModuleDao();
			$o_submodule=$dao_submodule->selectAllBySystem("plugin_costs_rice");

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
			$this->Init("ShowCostsRiceData","Plugin_Costs_Rice","form-horizontal row-border",true);
				
			$costsID=$this->getdata("costsID");

			$dao_costs_rice=new Plugin_Costs_RiceDao();
				$o_costs_rice=$dao_costs_rice->selectById($costsID);

			if($o_costs_rice)
			{

				$form=new THidden();
				$form->set("costsID",$o_costs_rice->costsID,"","",true,"","");
				$this->add($form);

				$form=new TLabel();
				$form->set("costsName",$o_costs_rice->costsName,"","",true,"","");
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
				$form=new TInputfile();
				$form->set('fileexcel',"","","",true,"String",false);
				$form->setAttribute("class","form-control");
				$this->add($form);

				$form=new TButton();
				$form->set("bnexcel","บันทึก Excel","","",true,"String",false);
				$form->setEvent("onclick","frmActionExcel");
				$form->setAttribute("class","btn btn-primary");
				$this->Add($form);

				$form=new TButton();
				$form->set("bn"," เพิ่มข้อมูลใหม่","","",true,"","");
				$form->setEvent("onclick","frmNew");
				$form->setAttribute("class","btn btn-xs btn-primary");
				//$form->setAttribute("data-toggle","modal");
				//$form->setAttribute("href","#myModal1");
				$this->Add($form);
				
				$form=new TTextBox();
				$form->set('areaFarming_box',"","","",true,"String",true); 
				$form->setAttribute("class","form-control");
				$form->setAttribute("placeholder","เนื้อที่เพาะปลูก");
				$this->add($form);

				$form=new TButton();
				$form->set("bnsave","บันทึกข้อมูล","","",true,"String",true);
				$form->setEvent("onclick","frmAction");
				$form->setAttribute("class","btn btn-primary");
				$this->Add($form);

				$dao_source=new Plugin_SourceDao();
					$o_source=$dao_source->selectAllByDataID($costsID."_4_1");

				$form=new THidden();
				$form->set("dataID_source",$costsID."_4_1","","",true,"","");
				$this->add($form);

				$form=new THidden();
				$form->set("sourceID",$o_source[0]->sourceID,"","",true,"","");
				$this->add($form);

				$form=new THidden();
				$form->set("version_source",$o_source[0]->version,"","",true,"","");
				$this->add($form);

				$form=new TTextBox();
				$form->set('sourceName',$o_source[0]->sourceName,"","",true,"String",false); 
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
		
			
			$dao=new Plugin_Costs_Rice_DataDao();
				$o=$dao->selectAllBycostsID($costsID);

			ShowCostsRiceData::$Grid1=new TGridview();
			ShowCostsRiceData::$Grid1->setview("Grid1",$o);

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
			ShowCostsRiceData::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("dataItem","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='รายการ';
			ShowCostsRiceData::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("dataPrice","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='ค่าใช้จ่าย (บาท/ไร่)';
			ShowCostsRiceData::$Grid1->addcontrol($grid);


			ShowCostsRiceData::$Grid1->View=false;
			ShowCostsRiceData::$Grid1->Edit=false;
			ShowCostsRiceData::$Grid1->Delete=$o_per[0]->permissDel;
			$this->Add(ShowCostsRiceData::$Grid1);

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
			ShowCostsRiceData::$Grid1->gotopage($v[1]);
			ShowCostsRiceData::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowCostsRiceData::$Grid1->gotopage($v[1]);
			ShowCostsRiceData::$Grid1->changenumpage($v[0]);
		}
		function Grid1_View($parameter,$sender)
		{
			
		}
		function frmNew($parameter,$sender)
		{
			$costsID=$sender->getdata('costsID');
			$o=new plugin_costs_rice_data();
			$o->costsID=$costsID;
			$o->creationUser=$_SESSION["Session_User_UserID"];
			$o->status="Open";
			$dao=new Plugin_Costs_Rice_DataDao();
				$dao->save($o);

			Refreshs("Plugin_Costs_Rice/ShowCostsRiceData&costsID=$costsID","alert","save");

		}
		
		function Grid1_Editing($parameter,$sender)
		{
			$dao=new Plugin_Costs_Rice_DataDao();

			for($i=ShowCostsRiceData::$Grid1->getstart();$i<ShowCostsRiceData::$Grid1->getstop();$i++)
			{
				$o=new plugin_costs_rice_data();
				

				$o->dataID=ShowCostsRiceData::$Grid1->getvalues("dataID",$i);
				$o->dataItem=ShowCostsRiceData::$Grid1->getvalues("dataItem",$i);
				$o->dataPrice=ShowCostsRiceData::$Grid1->getvalues("dataPrice",$i);

				$o_update=$dao->selectById($o->dataID);
				$o->version=$o_update->version;

				if($o->dataID)
				{
					
					$dao->update($o);
					$o->version="";
					$o->dataID="";
				}

				
				
			}
			
			$costsID=$sender->getdata('costsID');
			Refreshs("Plugin_Costs_Rice/ShowCostsRiceData&costsID=$costsID","alert","update");

		}
		function Grid1_Deleting($parameter,$sender)
		{
			$o=new plugin_costs_rice_data();
			$o->dataID=ShowCostsRiceData::$Grid1->getvalues("dataID",$parameter);
			$dao=new Plugin_Costs_Rice_DataDao();

			$dao->deletes($o);

			$costsID=$sender->getdata('costsID');
			Refreshs("Plugin_Costs_Rice/ShowCostsRiceData&costsID=$costsID","alert","del");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new Plugin_Costs_Rice_DataDao();

			for($i=ShowCostsRiceData::$Grid1->getstart();$i<ShowCostsRiceData::$Grid1->getstop();$i++)
			{
				$o=new plugin_costs_rice_data();
				
				$o->dataID=ShowCostsRiceData::$Grid1->getvalues("dataID",$i);
				
				$o->cartoonpartIDCheck=ShowCostsRiceData::$Grid1->getvalues("cartoonpartIDCheck",$i);
				if($o->cartoonpartIDCheck)
				{
					if($o->dataID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->dataID="";
					}
				}
				
			}
			
			$costsID=$sender->getdata('costsID');
			Refreshs("Plugin_Costs_Rice/ShowCostsRiceData&costsID=$costsID","alert","del");
		}
		function frmSource($parameter,$sender)
		{
			$o=new plugin_source();

			$o->sourceID=$sender->getdata('sourceID');
			$o->version=$sender->getdata('version_source');
			$o->sourceName=$sender->getdata('sourceName');
			$o->dataID=$sender->getdata('dataID_source');

			$dao=new Plugin_SourceDao();
			if($o->sourceID)
			{
				$dao->update($o);
			}
			else
			{
				//msgbox($o->dataID);
				$dao->save($o);
			}

			$costsID=$sender->getdata('costsID');
			Refreshs("Plugin_Costs_Rice/ShowCostsRiceData&costsID=$costsID","alert","save");
		}
		function frmActionExcel($parameter,$sender)
		{
			$costsID=$sender->getdata('costsID');

			$userfile=$sender->getvalue('fileexcel');
			$Datef=Date("d-m-y");
			$Timef=Date("H-i-s");
			$Datef=ereg_replace("-","",$Datef);
			$Timef=ereg_replace("-","",$Timef); 
			$Fname="excel_".$Datef."_".$Timef;

			$excel_file=uploadFile(0,"./Upload/File",$Fname,$userfile);

			$file_name=$excel_file;

			$inputFileType = 'Excel5';
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($file_name);


			$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			
			$dao=new Plugin_Costs_Rice_DataDao();

			for($i=3;$i<=count($sheetData);$i++)
			{
				
				$o=new plugin_costs_rice_data();


				$o->costsID=$costsID;

				$o->dataItem=$sheetData[$i]["A"];
				$o->dataPrice=$sheetData[$i]["B"];
				
				$o->creationUser=$_SESSION["Session_User_UserID"];
				$o->status="Open";
				
				//$o_check_name=$dao->selectAllByThaiIDAndName($o->thaiID,$o->riceType,"3");

				if($o_check_name[0]->dataID)
				{
					$o->dataID=$o_check_name[0]->dataID;
					$o->version=$o_check_name[0]->version;

					$dao->update($o);
				}
				else
				{
					$dao->save($o);	
				}
				
			}
			Refreshs("Plugin_Costs_Rice/ShowCostsRiceData&costsID=$costsID","alert","save");
		}
		
}
?>