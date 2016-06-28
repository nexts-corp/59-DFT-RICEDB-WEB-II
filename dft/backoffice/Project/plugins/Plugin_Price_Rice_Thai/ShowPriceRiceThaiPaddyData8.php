<?php
require_once("Project/plugins/Plugin_Price_Rice_Thai/Dao/Plugin_Price_Rice_ThaiDao.php");
require_once("Project/plugins/Plugin_Price_Rice_Thai/Common/plugin_price_rice_thai.php");

require_once("Project/plugins/Plugin_Price_Rice_Thai/Dao/Plugin_Price_Rice_Thai_PaddyDao.php");
require_once("Project/plugins/Plugin_Price_Rice_Thai/Common/plugin_price_rice_thai_paddy.php");

require_once("Project/plugins/Plugin_Price_Rice_Thai/Dao/Plugin_Price_Rice_Thai_Paddy_DataDao.php");
require_once("Project/plugins/Plugin_Price_Rice_Thai/Common/plugin_price_rice_thai_paddy_data.php");

class  ShowPriceRiceThaiPaddyData8 extends TForm
{
	public static $Grid1;
	function ShowPriceRiceThaiPaddyData8()
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
			$this->Init("ShowPriceRiceThaiPaddyData8","Plugin_Price_Rice_Thai","form-horizontal row-border",true);
			
			$paddyID=$this->getdata("paddyID");
			$thaiID=$this->getdata("thaiID");

			$dao_price_rice_thai=new Plugin_Price_Rice_ThaiDao();
				$o_price_rice_thai=$dao_price_rice_thai->selectById($thaiID);

			$dao_price_rice_thai_paddy=new Plugin_Price_Rice_Thai_PaddyDao();
				$o_price_rice_thai_paddy=$dao_price_rice_thai_paddy->selectById($paddyID);


			if($o_price_rice_thai)
			{

				$form=new TLabel();
				$form->set("thaiID",$o_price_rice_thai->thaiID,"","",true,"","");
				$this->add($form);

				$form=new TLabel();
				$form->set("thaiDate",$o_price_rice_thai->thaiDate,"","",true,"","");
				$this->add($form);
			}
			if($o_price_rice_thai_paddy)
			{

				$form=new THidden();
				$form->set("paddyID",$o_price_rice_thai_paddy->paddyID,"","",true,"","");
				$this->add($form);

				$form=new TLabel();
				$form->set("paddyType",$o_price_rice_thai_paddy->paddyType,"","",true,"","");
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
				$form->set('paddyType_box',"","","",true,"String",true); 
				$form->setAttribute("class","form-control");
				$form->setAttribute("placeholder","ชนิดข้าวเปลือก");
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
		
			
			$dao=new Plugin_Price_Rice_Thai_Paddy_DataDao();
				$o=$dao->selectAllByPaddyID($paddyID);

			ShowPriceRiceThaiPaddyData8::$Grid1=new TGridview();
			ShowPriceRiceThaiPaddyData8::$Grid1->setview("Grid1",$o);


			$grid=new TCheckbox();
			$grid->set('cartoonpartIDCheck',"","","40",ture,'reqstring',false);
			$grid->additem(" ","");
			$grid->title=' ';
			ShowPriceRiceThaiPaddyData8::$Grid1->addcontrol($grid);
			
			$grid=new TTextBox();
			$grid->set('data1',"","","",true,"",false);
			$grid->title='ชนิดข้าว';
			$grid->setAttribute("class","form-control");
			ShowPriceRiceThaiPaddyData8::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set('data2',"","","",true,"",false);
			$grid->title='ราคากระสอบละ';
			$grid->setAttribute("class","form-control");
			ShowPriceRiceThaiPaddyData8::$Grid1->addcontrol($grid);

			ShowPriceRiceThaiPaddyData8::$Grid1->View=false;
			ShowPriceRiceThaiPaddyData8::$Grid1->Edit=false;
			ShowPriceRiceThaiPaddyData8::$Grid1->Delete=$o_per[0]->permissDel;
			$this->Add(ShowPriceRiceThaiPaddyData8::$Grid1);

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
			ShowPriceRiceThaiPaddyData8::$Grid1->gotopage($v[1]);
			ShowPriceRiceThaiPaddyData8::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowPriceRiceThaiPaddyData8::$Grid1->gotopage($v[1]);
			ShowPriceRiceThaiPaddyData8::$Grid1->changenumpage($v[0]);
		}
		function Grid1_View($parameter,$sender)
		{
			
		}
		function frmNew($parameter,$sender)
		{
			$o=new plugin_price_rice_thai_paddy_data();

			$o->paddyID=$sender->getdata('paddyID');
			$o->thaiID=$sender->getdata('thaiID');

			$o->creationUser=$_SESSION["Session_User_UserID"];
			$o->status="Open";
			$dao=new Plugin_Price_Rice_Thai_Paddy_DataDao();
			
			if($o->genID)
			{

				//$dao->update($o);
				//Refreshs("Plugin_Manufacturing_World/ShowManufacturingWorld","alert","update");
			}
			else
			{

				//$o_check_name=$dao->selectAllByThaiIDAndName($o->thaiID,$o->paddyType,"1");
				//if(empty($o_check_name))
					$dao->save($o);

				Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThaiPaddyData8&paddyID=$o->paddyID&thaiID=$o->thaiID","alert","save");
					
			}
		}
		function frmAction($parameter,$sender)
		{
			
		}
		function Grid1_Editing($parameter,$sender)
		{
			$dao=new Plugin_Price_Rice_Thai_Paddy_DataDao();

			for($i=ShowPriceRiceThaiPaddyData8::$Grid1->getstart();$i<ShowPriceRiceThaiPaddyData8::$Grid1->getstop();$i++)
			{
				$o=new plugin_price_rice_thai_paddy_data();
				

				$o->dataID=ShowPriceRiceThaiPaddyData8::$Grid1->getvalues("dataID",$i);
				$o->data1=ShowPriceRiceThaiPaddyData8::$Grid1->getvalues("data1",$i);
				$o->data2=ShowPriceRiceThaiPaddyData8::$Grid1->getvalues("data2",$i);

				$o_update=$dao->selectById($o->dataID);
				$o->version=$o_update->version;

				if($o->dataID)
				{
					
					$dao->update($o);
					$o->version="";
					$o->dataID="";
				}

				
				
			}
			
			$paddyID=$sender->getdata('paddyID');
			$thaiID=$sender->getdata('thaiID');
			Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThaiPaddyData8&paddyID=$paddyID&thaiID=$thaiID","alert","update");

		}
		function Grid1_Deleting($parameter,$sender)
		{
			$o=new plugin_price_rice_thai_paddy_data();
			$o->dataID=ShowPriceRiceThaiPaddyData8::$Grid1->getvalues("dataID",$parameter);
			$dao=new Plugin_Price_Rice_Thai_Paddy_DataDao();

			$dao->deletes($o);

			$paddyID=$sender->getdata('paddyID');
			$thaiID=$sender->getdata('thaiID');
			Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThaiPaddyData8&paddyID=$paddyID&thaiID=$thaiID","alert","del");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new Plugin_Price_Rice_Thai_Paddy_DataDao();

			for($i=ShowPriceRiceThaiPaddyData8::$Grid1->getstart();$i<ShowPriceRiceThaiPaddyData8::$Grid1->getstop();$i++)
			{
				$o=new plugin_price_rice_thai_paddy_data();
				
				$o->dataID=ShowPriceRiceThaiPaddyData8::$Grid1->getvalues("dataID",$i);
				
				$o->cartoonpartIDCheck=ShowPriceRiceThaiPaddyData8::$Grid1->getvalues("cartoonpartIDCheck",$i);
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
			
			$paddyID=$sender->getdata('paddyID');
			$thaiID=$sender->getdata('thaiID');
			Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThaiPaddyData8&paddyID=$paddyID&thaiID=$thaiID","alert","del");
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

			for($i=3;$i<=count($sheetData);$i++)
			{
				
				$o=new plugin_price_rice_thai_paddy();

				$o->thaiID=$thaiID;

				$o->paddyType=$sheetData[$i]["A"];
				$o->department1=$sheetData[$i]["B"];
				$o->departmentType="1";

				$o->creationUser=$_SESSION["Session_User_UserID"];
				$o->status="Open";
				
				$o_check_name=$dao->selectAllByThaiIDAndName($o->thaiID,$o->paddyType,"1");
				
				if($o_check_name[0]->paddyID)
				{
					$o->paddyID=$o_check_name[0]->paddyID;
					$o->version=$o_check_name[0]->version;

					$dao->update($o);
				}
				else
				{
					$dao->save($o);	
				}
				
			}
			Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThaiPaddyData8&thaiID=$thaiID","alert","save");
		}
		
		
}
?>