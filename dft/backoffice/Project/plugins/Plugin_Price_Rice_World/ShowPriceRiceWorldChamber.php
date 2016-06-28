<?php
require_once("Project/plugins/Plugin_Price_Rice_World/Dao/Plugin_Price_Rice_WorldDao.php");
require_once("Project/plugins/Plugin_Price_Rice_World/Common/plugin_price_rice_world.php");

require_once("Project/plugins/Plugin_Price_Rice_World/Dao/Plugin_Price_Rice_World_ChamberDao.php");
require_once("Project/plugins/Plugin_Price_Rice_World/Common/plugin_price_rice_world_chamber.php");

class  ShowPriceRiceWorldChamber extends TForm
{
	public static $Grid1;
	function ShowPriceRiceWorldChamber()
	{
		$dao_submodule=new SubModuleDao();
			$o_submodule=$dao_submodule->selectAllBySystem("plugin_price_rice_world");

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
			$this->Init("ShowPriceRiceWorldChamber","Plugin_Price_Rice_World","form-horizontal row-border",true);
				
			$worldID=$this->getdata("worldID");

			$dao_price_rice_world=new Plugin_Price_Rice_WorldDao();
				$o_price_rice_world=$dao_price_rice_world->selectById($worldID);

			if($o_price_rice_world)
			{

				$form=new THidden();
				$form->set("worldID",$o_price_rice_world->worldID,"","",true,"","");
				$this->add($form);

				$form=new TLabel();
				$form->set("worldData",$o_price_rice_world->worldData,"","",true,"","");
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

			}
			
			if($o_per[0]->permissDel=="true")
			{
				$bndelgrid=new TButton();
				$bndelgrid->set("bndelgrid"," ลบข้อมูล","","",true,"","");
				$bndelgrid->setEvent_Confirm("onclick","frmDelAll",true,"คุณต้องการลบข้อมูลใช่หรือไม่");
				$bndelgrid->setAttribute("class","btn btn-xs btn-danger");
				$this->Add($bndelgrid);
			}
		
			
			$dao=new Plugin_Price_Rice_World_ChamberDao();
				$o=$dao->selectAllByWorldID($worldID);

			ShowPriceRiceWorldChamber::$Grid1=new TGridview();
			ShowPriceRiceWorldChamber::$Grid1->setview("Grid1",$o);

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
			ShowPriceRiceWorldChamber::$Grid1->addcontrol($grid);
			
			$grid=new TTextBox();
			$grid->set('riceType',"","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='ชนิดข้าว';
			ShowPriceRiceWorldChamber::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("fobBefore","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='ราคา FOB ต่อเมตริกตัน งวดก่อน(เหรียญสหรัฐ)';
			ShowPriceRiceWorldChamber::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("fobAfter","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='ราคา FOB ต่อเมตริกตัน งวดนี้(เหรียญสหรัฐ)';
			ShowPriceRiceWorldChamber::$Grid1->addcontrol($grid);


			ShowPriceRiceWorldChamber::$Grid1->View=false;
			ShowPriceRiceWorldChamber::$Grid1->Edit=false;
			ShowPriceRiceWorldChamber::$Grid1->Delete=$o_per[0]->permissDel;
			$this->Add(ShowPriceRiceWorldChamber::$Grid1);

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
			ShowPriceRiceWorldChamber::$Grid1->gotopage($v[1]);
			ShowPriceRiceWorldChamber::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowPriceRiceWorldChamber::$Grid1->gotopage($v[1]);
			ShowPriceRiceWorldChamber::$Grid1->changenumpage($v[0]);
		}
		function Grid1_View($parameter,$sender)
		{
			
		}
		function frmNew($parameter,$sender)
		{
			$o=new plugin_price_rice_world_chamber();
			$o->worldID=$sender->getdata('worldID');

			$o->creationUser=$_SESSION["Session_User_UserID"];
			$o->status="Open";
			$dao=new Plugin_Price_Rice_World_ChamberDao();

			$dao->save($o);
			Refreshs("Plugin_Price_Rice_World/ShowPriceRiceWorldChamber&worldID=$o->worldID","alert","save");
		}
		function frmAction($parameter,$sender)
		{
			$o=new plugin_price_rice_world_chamber();

			//$o->genID=$sender->getdata('genID');
			$o->worldID=$sender->getdata('worldID');
			$o->version=$sender->getdata('version');
			$o->riceType=$sender->getdata('riceType_box');
			$o->fobBefore=$sender->getdata('fobBefore_box');
			$o->fobAfter=$sender->getdata('fobAfter_box');

			$o->creationUser=$_SESSION["Session_User_UserID"];
			$o->status="Open";
			$dao=new Plugin_Price_Rice_World_ChamberDao();
			
			if($o->genID)
			{

				//$dao->update($o);
				//Refreshs("Plugin_Manufacturing_World/ShowManufacturingWorld","alert","update");
			}
			else
			{

				$o_check_name=$dao->selectAllByWorldIDAndName($o->worldID,$o->riceType);
				if(empty($o_check_name))
					$dao->save($o);

				Refreshs("Plugin_Price_Rice_World/ShowPriceRiceWorldChamber&worldID=$o->worldID","alert","save");
					
			}
		}
		function Grid1_Editing($parameter,$sender)
		{
			$dao=new Plugin_Price_Rice_World_ChamberDao();

			for($i=ShowPriceRiceWorldChamber::$Grid1->getstart();$i<ShowPriceRiceWorldChamber::$Grid1->getstop();$i++)
			{
				$o=new plugin_price_rice_world_chamber();
				

				$o->chamberID=ShowPriceRiceWorldChamber::$Grid1->getvalues("chamberID",$i);
				

				$o->riceType=ShowPriceRiceWorldChamber::$Grid1->getvalues("riceType",$i);
				$o->fobBefore=ShowPriceRiceWorldChamber::$Grid1->getvalues("fobBefore",$i);
				$o->fobAfter=ShowPriceRiceWorldChamber::$Grid1->getvalues("fobAfter",$i);

				$o_update=$dao->selectById($o->chamberID);
				$o->version=$o_update->version;

				if($o->chamberID and $o->riceType and $o->fobBefore and $o->fobAfter)
				{
					
					$dao->update($o);
					$o->version="";
					$o->chamberID="";
				}

				
				
			}
			
			$worldID=$sender->getdata('worldID');
			Refreshs("Plugin_Price_Rice_World/ShowPriceRiceWorldChamber&worldID=$worldID","alert","update");

		}
		function Grid1_Deleting($parameter,$sender)
		{
			$o=new plugin_price_rice_world_chamber();
			$o->chamberID=ShowPriceRiceWorldChamber::$Grid1->getvalues("chamberID",$parameter);
			$dao=new Plugin_Price_Rice_World_ChamberDao();

			$dao->deletes($o);

			$worldID=$sender->getdata('worldID');
			Refreshs("Plugin_Price_Rice_World/ShowPriceRiceWorldChamber&worldID=$worldID","alert","del");
		}
		
		function frmDelAll($parameter,$sender)
		{
			$dao=new Plugin_Price_Rice_World_ChamberDao();

			for($i=ShowPriceRiceWorldChamber::$Grid1->getstart();$i<ShowPriceRiceWorldChamber::$Grid1->getstop();$i++)
			{
				$o=new plugin_price_rice_world_chamber();
				
				$o->chamberID=ShowPriceRiceWorldChamber::$Grid1->getvalues("chamberID",$i);
				
				$o->cartoonpartIDCheck=ShowPriceRiceWorldChamber::$Grid1->getvalues("cartoonpartIDCheck",$i);
				if($o->cartoonpartIDCheck)
				{
					if($o->chamberID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->chamberID="";
					}
				}
				
			}
			
			$worldID=$sender->getdata('worldID');
			Refreshs("Plugin_Price_Rice_World/ShowPriceRiceWorldChamber&worldID=$worldID","alert","del");
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

			$file_name=$excel_file;
			$inputFileType = 'Excel5';
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($file_name);

			$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			
			$dao=new Plugin_Price_Rice_World_ChamberDao();

			for($i=3;$i<=count($sheetData);$i++)
			{
				
				$o=new plugin_price_rice_world_chamber();

				$o->worldID=$worldID;

				$o->riceType=$sheetData[$i]["A"];
				$o->fobBefore=$sheetData[$i]["B"];
				$o->fobAfter=$sheetData[$i]["C"];

				$o->creationUser=$_SESSION["Session_User_UserID"];
				$o->status="Open";
				
				$o_check_name=$dao->selectAllByWorldIDAndName($o->worldID,$o->riceType);

				if($o_check_name[0]->chamberID)
				{
					$o->chamberID=$o_check_name[0]->chamberID;
					$o->version=$o_check_name[0]->version;

					$dao->update($o);
				}
				else
				{
					$dao->save($o);	
				}
				
			}
			Refreshs("Plugin_Price_Rice_World/ShowPriceRiceWorldChamber&worldID=$worldID","alert","save");
		}
		
		
}
?>