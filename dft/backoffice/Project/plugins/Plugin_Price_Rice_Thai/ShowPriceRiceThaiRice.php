<?php
require_once("Project/plugins/Plugin_Price_Rice_Thai/Dao/Plugin_Price_Rice_ThaiDao.php");
require_once("Project/plugins/Plugin_Price_Rice_Thai/Common/plugin_price_rice_thai.php");

require_once("Project/plugins/Plugin_Price_Rice_Thai/Dao/Plugin_Price_Rice_Thai_RiceDao.php");
require_once("Project/plugins/Plugin_Price_Rice_Thai/Common/plugin_price_rice_thai_rice.php");

class  ShowPriceRiceThaiRice extends TForm
{
	public static $Grid1;
	function ShowPriceRiceThaiRice()
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
			$this->Init("ShowPriceRiceThaiRice","Plugin_Price_Rice_Thai","form-horizontal row-border",true);
				
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
				//$form->setAttribute("data-toggle","modal");
				//$form->setAttribute("href","#myModal1");
				$this->Add($form);

				//$form=new TButton();
				//$form->set("bnauto"," เพิ่มประเทศเริ่มต้น","","",true,"","");
				//$form->setEvent("onclick","frmNewAuto");
				//$form->setAttribute("class","btn btn-xs btn-primary");
				//$this->Add($form);
				
				$form=new TTextBox();
				$form->set('riceType_box',"","","",true,"String",true); 
				$form->setAttribute("class","form-control");
				$form->setAttribute("placeholder","ชนิดข้าวสาร");
				$this->add($form);

				$form=new TTextBox();
				$form->set('department1_box',"","","",true,"String",true); 
				$form->setAttribute("class","form-control");
				$form->setAttribute("placeholder","ราคาจากกรมการค้าภายใน");
				$this->add($form);

				$form=new TTextBox();
				$form->set('department2_box',"","","",true,"String",true); 
				$form->setAttribute("class","form-control");
				$form->setAttribute("placeholder","ราคาจากสมาคมโรงสีข้าวไทย");
				$this->add($form);

				$form=new TTextBox();
				$form->set('ricebugPrice_box',"","","",true,"String",true); 
				$form->setAttribute("class","form-control");
				$form->setAttribute("placeholder","ราคาข้าวถุง");
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
		
			
			$dao=new Plugin_Price_Rice_Thai_RiceDao();
				$o=$dao->selectAllByThaiID($thaiID);

			ShowPriceRiceThaiRice::$Grid1=new TGridview();
			ShowPriceRiceThaiRice::$Grid1->setview("Grid1",$o);

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
			ShowPriceRiceThaiRice::$Grid1->addcontrol($grid);
			
			$grid=new TLabel();
			$grid->set('riceType',"","","",true,"",false);
			$grid->title='ชนิดข้าวเปลือก';
			ShowPriceRiceThaiRice::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("department1","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='ราคาจากกรมการค้าภายใน';
			ShowPriceRiceThaiRice::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("department2","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='ราคาจากสมาคมโรงสีข้าวไทย';
			ShowPriceRiceThaiRice::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("ricebugPrice","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='ราคาข้าวถุง';
			ShowPriceRiceThaiRice::$Grid1->addcontrol($grid);

			ShowPriceRiceThaiRice::$Grid1->View=false;
			ShowPriceRiceThaiRice::$Grid1->Edit=false;
			ShowPriceRiceThaiRice::$Grid1->Delete=$o_per[0]->permissDel;
			$this->Add(ShowPriceRiceThaiRice::$Grid1);

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
			ShowPriceRiceThaiRice::$Grid1->gotopage($v[1]);
			ShowPriceRiceThaiRice::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowPriceRiceThaiRice::$Grid1->gotopage($v[1]);
			ShowPriceRiceThaiRice::$Grid1->changenumpage($v[0]);
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
			$o=new plugin_price_rice_thai_rice();

			//$o->genID=$sender->getdata('genID');
			$o->thaiID=$sender->getdata('thaiID');
			$o->version=$sender->getdata('version');
			$o->riceType=$sender->getdata('riceType_box');
			$o->department1=$sender->getdata('department1_box');
			$o->department2=$sender->getdata('department2_box');
			$o->ricebugPrice=$sender->getdata('ricebugPrice_box');

			$o->creationUser=$_SESSION["Session_User_UserID"];
			$o->status="Open";
			$dao=new Plugin_Price_Rice_Thai_RiceDao();
			
			if($o->genID)
			{

				//$dao->update($o);
				//Refreshs("Plugin_Manufacturing_World/ShowManufacturingWorld","alert","update");
			}
			else
			{

				$o_check_name=$dao->selectAllByThaiIDAndName($o->thaiID,$o->riceType);
				if(empty($o_check_name))
					$dao->save($o);

				Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThaiRice&thaiID=$o->thaiID","alert","save");
					
			}
		}
		function Grid1_Editing($parameter,$sender)
		{
			$dao=new Plugin_Price_Rice_Thai_RiceDao();

			for($i=ShowPriceRiceThaiRice::$Grid1->getstart();$i<ShowPriceRiceThaiRice::$Grid1->getstop();$i++)
			{
				$o=new plugin_price_rice_thai_rice();
				

				$o->riceID=ShowPriceRiceThaiRice::$Grid1->getvalues("riceID",$i);
				

				$o->department1=ShowPriceRiceThaiRice::$Grid1->getvalues("department1",$i);
				$o->department2=ShowPriceRiceThaiRice::$Grid1->getvalues("department2",$i);
				$o->ricebugPrice=ShowPriceRiceThaiRice::$Grid1->getvalues("ricebugPrice",$i);

				$o_update=$dao->selectById($o->riceID);
				$o->version=$o_update->version;

				if($o->riceID and $o->department1 and $o->department2)
				{
					
					$dao->update($o);
					$o->version="";
					$o->riceID="";
				}

				
				
			}
			
			$thaiID=$sender->getdata('thaiID');
			Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThaiRice&thaiID=$thaiID","alert","update");

		}
		function Grid1_Deleting($parameter,$sender)
		{
			$o=new plugin_price_rice_thai_rice();
			$o->riceID=ShowPriceRiceThaiRice::$Grid1->getvalues("riceID",$parameter);
			$dao=new Plugin_Price_Rice_Thai_RiceDao();

			$dao->deletes($o);

			$thaiID=$sender->getdata('thaiID');
			Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThaiRice&thaiID=$thaiID","alert","del");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new Plugin_Price_Rice_Thai_RiceDao();

			for($i=ShowPriceRiceThaiRice::$Grid1->getstart();$i<ShowPriceRiceThaiRice::$Grid1->getstop();$i++)
			{
				$o=new plugin_price_rice_thai_rice();
				
				$o->riceID=ShowPriceRiceThaiRice::$Grid1->getvalues("riceID",$i);
				
				$o->cartoonpartIDCheck=ShowPriceRiceThaiRice::$Grid1->getvalues("cartoonpartIDCheck",$i);
				if($o->cartoonpartIDCheck)
				{
					if($o->riceID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->riceID="";
					}
				}
				
			}
			
			$thaiID=$sender->getdata('thaiID');
			Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThaiRice&thaiID=$thaiID","alert","del");
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
			
			$dao=new Plugin_Price_Rice_Thai_RiceDao();

			for($i=3;$i<=count($sheetData);$i++)
			{
				
				$o=new plugin_price_rice_thai_rice();

				$o->plantedID=$plantedID;

				$o->riceType=$sheetData[$i]["A"];
				$o->department1=$sheetData[$i]["B"];
				$o->department2=$sheetData[$i]["C"];
				$o->ricebugPrice=$sheetData[$i]["D"];

				$o->creationUser=$_SESSION["Session_User_UserID"];
				$o->status="Open";
				
				$o_check_name=$dao->selectAllByThaiIDAndName($o->thaiID,$o->riceType);

				if($o_check_name[0]->riceID)
				{
					$o->riceID=$o_check_name[0]->riceID;
					$o->version=$o_check_name[0]->version;

					$dao->update($o);
				}
				else
				{
					$dao->save($o);	
				}
				
			}
			Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThaiRice&thaiID=$plantedID","alert","save");
		}
		
		
}
?>