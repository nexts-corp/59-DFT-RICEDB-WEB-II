<?php
require_once("Project/plugins/Plugin_Planted/Dao/Plugin_PlantedDao.php");
require_once("Project/plugins/Plugin_Planted/Common/plugin_planted.php");

require_once("Project/plugins/Plugin_Planted/Dao/Plugin_Planted_CisnerosDao.php");
require_once("Project/plugins/Plugin_Planted/Common/plugin_planted_cisneros.php");

require_once("Project/plugins/Plugin_Source/Dao/Plugin_SourceDao.php");
require_once("Project/plugins/Plugin_Source/Common/plugin_source.php");

class  ShowCisneros extends TForm
{
	public static $Grid1;
	function ShowCisneros()
	{
		$dao_submodule=new SubModuleDao();
			$o_submodule=$dao_submodule->selectAllBySystem("plugin_planted");

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
			$this->Init("ShowCisneros","Plugin_Planted","form-horizontal row-border",true);
				
			$plantedID=$this->getdata("plantedID");

			$dao_planted=new Plugin_PlantedDao();
				$o_planted=$dao_planted->selectById($plantedID);

			if($o_planted)
			{

				$form=new THidden();
				$form->set("plantedID",$o_planted->plantedID,"","",true,"","");
				$this->add($form);

				$form=new TLabel();
				$form->set("plantedYear",$o_planted->plantedYear,"","",true,"","");
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
				$form->set("bn"," เพิ่มข้อมูลจังหวัด","","",true,"","");
				$form->setEvent("onclick","frmNew");
				$form->setAttribute("class","btn btn-xs btn-primary");
				//$form->setAttribute("data-toggle","modal");
				//$form->setAttribute("href","#myModal1");
				$this->Add($form);

				$form=new TButton();
				$form->set("bnauto"," เพิ่มจังหวัดเริ่มต้น","","",true,"","");
				$form->setEvent("onclick","frmNewAuto");
				$form->setAttribute("class","btn btn-xs btn-primary");
				$this->Add($form);
				

				$dao_source=new Plugin_SourceDao();
					$o_source=$dao_source->selectAllByDataID($plantedID."_2_1");

				$form=new THidden();
				$form->set("dataID",$plantedID."_2_1","","",true,"","");
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
		
			
			$dao=new Plugin_Planted_CisnerosDao();
				$o=$dao->selectAllByPlantedID($plantedID,"1");

			ShowCisneros::$Grid1=new TGridview();
			ShowCisneros::$Grid1->setview("Grid1",$o);

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
			ShowCisneros::$Grid1->addcontrol($grid);
			
			$grid=new TTextBox();
			$grid->set('province',"","","",true,"",false);
			$grid->title='จังหวัด';
			$grid->setAttribute("class","form-control");
			ShowCisneros::$Grid1->addcontrol($grid);

			$grid=new TListBox();
			$grid->set('typerice',"","","",true,"",false);
			$grid->title='ประเภทข้าว';
			$grid->additem("ข้าวเจ้า","ข้าวเจ้า");
			$grid->additem("ข้าวเหนียว","ข้าวเหนียว");
			$grid->setAttribute("class","form-control");
			ShowCisneros::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("areaFarming","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='เนื้อที่เพาะปลูก(ไร่)';
			ShowCisneros::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("areaHarvest","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='เนื้อที่เก็บเกี่ยว(ไร่)';
			ShowCisneros::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("product","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='ผลผลิต(ตัน)';
			ShowCisneros::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("productFarming","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='ผลผลิต/ไร่เพาะปลูก(ก.ก)';
			ShowCisneros::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("productHarvest","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='ผลผลิต/ไร่เก็บเกี่ยว (ก.ก)';
			ShowCisneros::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("percent","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='ร้อยละเนื้อที่เพาะปลูก';
			ShowCisneros::$Grid1->addcontrol($grid);


			ShowCisneros::$Grid1->View=false;
			ShowCisneros::$Grid1->Edit=false;
			ShowCisneros::$Grid1->Delete=$o_per[0]->permissDel;
			$this->Add(ShowCisneros::$Grid1);

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
			ShowCisneros::$Grid1->gotopage($v[1]);
			ShowCisneros::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowCisneros::$Grid1->gotopage($v[1]);
			ShowCisneros::$Grid1->changenumpage($v[0]);
		}
		function Grid1_View($parameter,$sender)
		{
			
		}
		function frmNew($parameter,$sender)
		{

			$o=new plugin_planted_cisneros();
			$o->plantedID=$sender->getdata('plantedID');
			$o->typePlanted="1";
			$o->creationUser=$_SESSION["Session_User_UserID"];
			$o->status="Open";

			$dao=new Plugin_Planted_CisnerosDao();
			$dao->save($o);
			Refreshs("Plugin_Planted/ShowCisneros&plantedID=$o->plantedID","alert","save");
		}
		function frmAction($parameter,$sender)
		{
			$o=new plugin_planted_cisneros();

			//$o->genID=$sender->getdata('genID');
			$o->plantedID=$sender->getdata('plantedID');
			$o->province=$sender->getdata('province');
			$o->typerice=$sender->getdata('typerice_box');
			$o->areaFarming=$sender->getdata('areaFarming_box');
			$o->areaHarvest=$sender->getdata('areaHarvest_box');
			$o->product=$sender->getdata('product_box');
			$o->productFarming=$sender->getdata('productFarming_box');
			$o->productHarvest=$sender->getdata('productHarvest_box');
			$o->percent=$sender->getdata('percent_box');
			$o->typePlanted="1";

			$o->version=$sender->getdata('version');
			$o->creationUser=$_SESSION["Session_User_UserID"];
			$o->status="Open";

			$dao=new Plugin_Planted_CisnerosDao();
			
			if($o->cisnerosID)
			{

				//$dao->update($o);
				//Refreshs("Plugin_Manufacturing_World/ShowManufacturingWorld","alert","update");
			}
			else
			{

				$o_check_name=$dao->selectAllByPlantedIDAndName($o->plantedID,$o->province,"1");
				if(empty($o_check_name))
					$dao->save($o);

				Refreshs("Plugin_Planted/ShowCisneros&plantedID=$o->plantedID","alert","save");
					
			}
		}
		function Grid1_Editing($parameter,$sender)
		{
			$dao=new Plugin_Planted_CisnerosDao();

			for($i=ShowCisneros::$Grid1->getstart();$i<ShowCisneros::$Grid1->getstop();$i++)
			{
				$o=new plugin_planted_cisneros();
				
				$o->province=ShowCisneros::$Grid1->getvalues("province",$i);
				$o->cisnerosID=ShowCisneros::$Grid1->getvalues("cisnerosID",$i);
				$o->typerice=ShowCisneros::$Grid1->getvalues("typerice",$i);
				$o->areaFarming=ShowCisneros::$Grid1->getvalues("areaFarming",$i);
				$o->areaHarvest=ShowCisneros::$Grid1->getvalues("areaHarvest",$i);
				$o->product=ShowCisneros::$Grid1->getvalues("product",$i);
				$o->productFarming=ShowCisneros::$Grid1->getvalues("productFarming",$i);
				$o->productHarvest=ShowCisneros::$Grid1->getvalues("productHarvest",$i);
				$o->percent=ShowCisneros::$Grid1->getvalues("percent",$i);


				$o_update=$dao->selectById($o->cisnerosID);
				$o->version=$o_update->version;

				if($o->cisnerosID)
				{
					
					$dao->update($o);
					$o->version="";
					$o->cisnerosID="";
				}

				
				
			}
			
			$plantedID=$sender->getdata('plantedID');
			Refreshs("Plugin_Planted/ShowCisneros&plantedID=$plantedID","alert","update");

		}
		function Grid1_Deleting($parameter,$sender)
		{
			$o=new plugin_planted_cisneros();
			$o->cisnerosID=ShowCisneros::$Grid1->getvalues("cisnerosID",$parameter);
			$dao=new Plugin_Planted_CisnerosDao();

			$dao->deletes($o);

			$plantedID=$sender->getdata('plantedID');
			Refreshs("Plugin_Planted/ShowCisneros&plantedID=$plantedID","alert","del");
		}
		
		function frmNewAuto($parameter,$sender)
		{
			$array = array("เชียงใหม่","เชียงราย","ลำพูน","ลำปาง","ตาก");
			$plantedID=$sender->getdata('plantedID');
			$dao=new Plugin_Planted_CisnerosDao();
			for($i=0;$i<count($array);$i++)
			{
				$o=new plugin_planted_cisneros();

				$o->plantedID=$plantedID;
				$o->typePlanted="1";
				
				$o->province=$array[$i];
				$o->creationUser=$_SESSION["Session_User_UserID"];
				$o->status="Open";

				$o_check_name=$dao->selectAllByPlantedIDAndName($o->plantedID,$o->province,"1");
				if(empty($o_check_name))
					$dao->save($o);

			}
			Refreshs("Plugin_Planted/ShowCisneros&plantedID=$plantedID","alert","save");
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
			$dao=new Plugin_Planted_CisnerosDao();

			for($i=ShowCisneros::$Grid1->getstart();$i<ShowCisneros::$Grid1->getstop();$i++)
			{
				$o=new plugin_planted_cisneros();
				
				$o->cisnerosID=ShowCisneros::$Grid1->getvalues("cisnerosID",$i);
				
				$o->cartoonpartIDCheck=ShowCisneros::$Grid1->getvalues("cartoonpartIDCheck",$i);
				if($o->cartoonpartIDCheck)
				{
					if($o->cisnerosID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->cisnerosID="";
					}
				}
				
			}
			
			$plantedID=$sender->getdata('plantedID');
			Refreshs("Plugin_Planted/ShowCisneros&plantedID=$plantedID","alert","del");
		}
		function frmActionExcel($parameter,$sender)
		{
			$plantedID=$sender->getdata('plantedID');


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
			
			$dao=new Plugin_Planted_CisnerosDao();

			for($i=3;$i<=count($sheetData);$i++)
			{
				
				$o=new plugin_planted_cisneros();

				$o->plantedID=$plantedID;

				$o->province=$sheetData[$i]["A"];
				$o->typerice=$sheetData[$i]["B"];
				$o->areaFarming=$sheetData[$i]["C"];
				$o->areaHarvest=$sheetData[$i]["D"];
				$o->product=$sheetData[$i]["E"];
				$o->productFarming=$sheetData[$i]["F"];
				$o->productHarvest=$sheetData[$i]["G"];
				$o->percent=$sheetData[$i]["H"];

				$o->creationUser=$_SESSION["Session_User_UserID"];
				$o->status="Open";
				
				$o_check_name=$dao->selectAllByPlantedIDAndName($o->plantedID,$o->province,"1");

				if($o_check_name[0]->cisnerosID)
				{
					$o->cisnerosID=$o_check_name[0]->cisnerosID;
					$o->version=$o_check_name[0]->version;

					$dao->update($o);
				}
				else
				{
					$dao->save($o);	
				}
				
			}
			Refreshs("Plugin_Planted/ShowCisneros&plantedID=$plantedID","alert","save");
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

			$plantedID=$sender->getdata('plantedID');
			Refreshs("Plugin_Planted/ShowCisneros&plantedID=$plantedID","alert","save");
		}
		
}
?>