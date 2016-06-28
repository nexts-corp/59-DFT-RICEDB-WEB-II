<?php
require_once("Project/plugins/Plugin_Price_Rice_Thai/Dao/Plugin_Price_Rice_ThaiDao.php");
require_once("Project/plugins/Plugin_Price_Rice_Thai/Common/plugin_price_rice_thai.php");

require_once("Project/plugins/Plugin_Price_Rice_Thai/Dao/Plugin_Price_Rice_Thai_PaddyDao.php");
require_once("Project/plugins/Plugin_Price_Rice_Thai/Common/plugin_price_rice_thai_paddy.php");

require_once("Project/plugins/Plugin_Price_Rice_Thai/Dao/Plugin_Price_Rice_Thai_Paddy_DataDao.php");
require_once("Project/plugins/Plugin_Price_Rice_Thai/Common/plugin_price_rice_thai_paddy_data.php");

class  ShowPriceRiceThaiPaddy9 extends TForm
{
	public static $Grid1;
	function ShowPriceRiceThaiPaddy9()
	{
		$dao_submodule=new SubModuleDao();
			$o_submodule=$dao_submodule->selectAllBySystem("plugin_price_rice_thai");

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
			$this->Init("ShowPriceRiceThaiPaddy9","Plugin_Price_Rice_Thai","form-horizontal row-border",true);
				
			$thaiID=$this->getdata("thaiID");

			$dao_price_rice_thai=new Plugin_Price_Rice_ThaiDao();
				$o_price_rice_thai=$dao_price_rice_thai->selectById($thaiID);

			if($o_price_rice_thai)
			{

				$form=new THidden();
				$form->set("thaiID",$o_price_rice_thai->thaiID,"","",true,"","");
				$this->add($form);

				$form=new TLabel();
				$form->set("thaiDate",$o_price_rice_thai->thaiDate,"","",true,"","");
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
				$this->Add($form);
				
				$form=new TTextBox();
				$form->set('paddyType_box',"","","",true,"String",true); 
				$form->setAttribute("class","form-control");
				$form->setAttribute("placeholder","ชนิดข้าวถุง");
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
		
			
			$dao=new Plugin_Price_Rice_Thai_PaddyDao();
				$o=$dao->selectAllByThaiID($thaiID,"9");

			ShowPriceRiceThaiPaddy9::$Grid1=new TGridview();
			ShowPriceRiceThaiPaddy9::$Grid1->setview("Grid1",$o);

			for($i=0;$i<count($o);$i++)
			{
				$o[$i]->paddydata="เพิ่มข้อมูลราคาข้าวถุง";
			}

			$grid=new TCheckbox();
			$grid->set('cartoonpartIDCheck',"","","40",ture,'reqstring',false);
			$grid->additem(" ","");
			$grid->title=' ';
			ShowPriceRiceThaiPaddy9::$Grid1->addcontrol($grid);
			
			$grid=new TLabel();
			$grid->set('paddyType',"","","",true,"",false);
			$grid->title='ชนิดข้าวถุง';
			ShowPriceRiceThaiPaddy9::$Grid1->addcontrol($grid);

			$grid=new TGridLink();
			$grid->set('paddydata',"","","","true","","");
			$grid->title='ราคาข้าวถุง';
			$grid->setEvent("onclick","frmActionPaddyData");
			ShowPriceRiceThaiPaddy9::$Grid1->addcontrol($grid);

			ShowPriceRiceThaiPaddy9::$Grid1->View=false;
			ShowPriceRiceThaiPaddy9::$Grid1->Edit=false;
			ShowPriceRiceThaiPaddy9::$Grid1->Delete=$o_per[0]->permissDel;
			$this->Add(ShowPriceRiceThaiPaddy9::$Grid1);

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
			ShowPriceRiceThaiPaddy9::$Grid1->gotopage($v[1]);
			ShowPriceRiceThaiPaddy9::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowPriceRiceThaiPaddy9::$Grid1->gotopage($v[1]);
			ShowPriceRiceThaiPaddy9::$Grid1->changenumpage($v[0]);
		}
		function Grid1_View($parameter,$sender)
		{
			
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
			$o=new plugin_price_rice_thai_paddy();

			//$o->genID=$sender->getdata('genID');
			$o->thaiID=$sender->getdata('thaiID');
			$o->version=$sender->getdata('version');
			$o->paddyType=$sender->getdata('paddyType_box');
			$o->departmentType="9";

			$o->creationUser=$_SESSION["Session_User_UserID"];
			$o->status="Open";
			$dao=new Plugin_Price_Rice_Thai_PaddyDao();
			
			if($o->genID)
			{

				//$dao->update($o);
				//Refreshs("Plugin_Manufacturing_World/ShowManufacturingWorld","alert","update");
			}
			else
			{

				$o_check_name=$dao->selectAllByThaiIDAndName($o->thaiID,$o->paddyType,"9");
				if(empty($o_check_name))
					$dao->save($o);

				Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThaiPaddy9&thaiID=$o->thaiID","alert","save");
					
			}
		}
		function Grid1_Deleting($parameter,$sender)
		{
			$o=new plugin_price_rice_thai_paddy();
			$o->paddyID=ShowPriceRiceThaiPaddy9::$Grid1->getvalues("paddyID",$parameter);
			$dao=new Plugin_Price_Rice_Thai_PaddyDao();

			$dao->deletes($o);

			$thaiID=$sender->getdata('thaiID');
			Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThaiPaddy9&thaiID=$thaiID","alert","del");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new Plugin_Price_Rice_Thai_PaddyDao();

			for($i=ShowPriceRiceThaiPaddy9::$Grid1->getstart();$i<ShowPriceRiceThaiPaddy9::$Grid1->getstop();$i++)
			{
				$o=new plugin_price_rice_thai_paddy();
				
				$o->paddyID=ShowPriceRiceThaiPaddy9::$Grid1->getvalues("paddyID",$i);
				
				$o->cartoonpartIDCheck=ShowPriceRiceThaiPaddy9::$Grid1->getvalues("cartoonpartIDCheck",$i);
				if($o->cartoonpartIDCheck)
				{
					if($o->paddyID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->paddyID="";
					}
				}
				
			}
			
			$thaiID=$sender->getdata('thaiID');
			Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThaiPaddy9&thaiID=$thaiID","alert","del");
		}
		function frmActionPaddyData($parameter,$sender)
		{
			$paddyID=ShowPriceRiceThaiPaddy9::$Grid1->getvalues("paddyID",$parameter);
			$thaiID=$sender->getdata('thaiID');
			fRefresh("","page","Plugin_Price_Rice_Thai/ShowPriceRiceThaiPaddyData9&paddyID=$paddyID&thaiID=$thaiID");
		}

		function frmActionExcel($parameter,$sender)
		{
			$thaiID=$sender->getdata('thaiID');


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
			
			$dao=new Plugin_Price_Rice_Thai_PaddyDao();
			$dao_data=new Plugin_Price_Rice_Thai_Paddy_DataDao();

			for($i=3;$i<=count($sheetData);$i++)
			{
				
				$o=new plugin_price_rice_thai_paddy();

				$o->thaiID=$thaiID;

				$o->paddyType=$sheetData[$i]["A"];
				$o->departmentType="9";

				$o->creationUser=$_SESSION["Session_User_UserID"];
				$o->status="Open";
				
				$o_check_name=$dao->selectAllByThaiIDAndName($o->thaiID,$o->paddyType,"9");
				
				if($o_check_name[0]->paddyID)
				{
					$o->paddyID=$o_check_name[0]->paddyID;
					$o->version=$o_check_name[0]->version;

					if($o->paddyID)
					{
						$dao->update($o);

						$o_data=new plugin_price_rice_thai_paddy_data();
						$o_data->paddyID=$o->paddyID;
						$o_data->thaiID=$thaiID;
						$o_data->data1=$sheetData[$i]["B"];
						$o_data->data2=$sheetData[$i]["C"];

						if($o_data->paddyID)
						{
							$dao_data->save($o_data);
						}
					}
					
				}
				else
				{
					if($o->paddyType)
					{
						$dao->save($o);

						$o_data=new plugin_price_rice_thai_paddy_data();
						$o_data->paddyID=$o->paddyID;
						$o_data->thaiID=$thaiID;
						$o_data->data1=$sheetData[$i]["B"];
						$o_data->data2=$sheetData[$i]["C"];

						if($o_data->paddyID)
						{
							$dao_data->save($o_data);
						}
					}
					
				}
				
			}
			Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThaiPaddy9&thaiID=$thaiID","alert","save");
		}
		
		
}
?>