<?php
require_once("Project/plugins/Plugin_Price_Rice_Thai/Dao/Plugin_Price_Rice_ThaiDao.php");
require_once("Project/plugins/Plugin_Price_Rice_Thai/Common/plugin_price_rice_thai.php");

require_once("Project/plugins/Plugin_Price_Rice_Thai/Dao/Plugin_Price_Rice_Thai_PaddyDao.php");
require_once("Project/plugins/Plugin_Price_Rice_Thai/Common/plugin_price_rice_thai_paddy.php");

require_once("Project/plugins/Plugin_Price_Rice_Thai/Dao/Plugin_Price_Rice_Thai_Paddy_DataDao.php");
require_once("Project/plugins/Plugin_Price_Rice_Thai/Common/plugin_price_rice_thai_paddy_data.php");

class  ShowPriceRiceThai1 extends TForm
{
	public static $Grid1;
	function ShowPriceRiceThai1()
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
		
		if($o_per[0]->permissView=="true" or $_SESSION["Session_User_UsertypeID"]=="2")
			$this->Init("ShowPriceRiceThai1","Plugin_Price_Rice_Thai","",true);
				
			
			$alert=$this->getdata("alert");

			if($alert)
			{
				
				$alertmsg=new TLabel();
				$alertmsg->set("alertmsg",alerts($alert),"","",true,"","");
				$this->add($alertmsg);

			}
			
			$form=new TButton();
			$form->set("bn","เพิ่ม ข้อมูล ณ วันที่","","",true,"","");
			$form->setEvent("onclick","frmNew");
			$form->setAttribute("class","btn btn-xs btn-primary");
			$this->Add($form);


			$form=new TInputfile();
			$form->set('fileexcel',"","","",true,"String",false);
			$this->add($form);

			$form=new TButton();
			$form->set("bnexcel","บันทึก Excel","","",true,"String",false);
			$form->setEvent("onclick","frmActionExcelUpload");
			$form->setAttribute("class","btn btn-primary");
			$this->Add($form);

			$bndelgrid=new TButton();
			$bndelgrid->set("bndelgrid"," ลบข้อมูล","","",true,"","");
			$bndelgrid->setEvent_Confirm("onclick","frmDelAll",true,"คุณต้องการลบข้อมูลใช่หรือไม่");
			$bndelgrid->setAttribute("class","btn btn-xs btn-danger");
			$this->Add($bndelgrid);
	
		
			$dao=new Plugin_Price_Rice_ThaiDao();
			$o=$dao->selectAllByType("1");
			
			ShowPriceRiceThai1::$Grid1=new TGridview();
			ShowPriceRiceThai1::$Grid1->setview("Grid1",$o);

			for($i=0;$i<count($o);$i++)
			{
				if($o[$i]->thaiDate)
				{
					
					$o[$i]->excel="<span class='btn btn-success'>ดาวน์โหลด Excel ต้นแบบ</span>";
					$o[$i]->excelreport="<span class='btn btn-success'>รายงานข้อมูลแบบ Excel</span>";
				}

			}
			$grid=new TCheckbox();
			$grid->set('cartoonpartIDCheck',"","","40",ture,'reqstring',false);
			$grid->additem(" ","");
			$grid->title=' ';
			ShowPriceRiceThai1::$Grid1->addcontrol($grid);
			
			$grid=new TTextBox();
			$grid->set('thaiDate',"","","",true,"",false);
			$grid->title='ข้อมูล ณ วันที่';
			$grid->setAttribute("class","form-control");
			$grid->setAttribute("placeholder","ข้อมูล ณ วันที่");
			ShowPriceRiceThai1::$Grid1->addcontrol($grid);

			$grid=new TGridLink();
			$grid->set('excel',"","","","true","","");
			$grid->title='ตาราง Excel';
			$grid->setEvent("onclick","frmActionExcel");
			ShowPriceRiceThai1::$Grid1->addcontrol($grid);

			$grid=new TGridLink();
			$grid->set('excelreport',"","","","true","","");
			$grid->title='รายงาน Excel';
			$grid->setEvent("onclick","frmActionExcelReport");
			ShowPriceRiceThai1::$Grid1->addcontrol($grid);

			ShowPriceRiceThai1::$Grid1->View=true;
			ShowPriceRiceThai1::$Grid1->Edit=false;
			ShowPriceRiceThai1::$Grid1->Delete=true;
			$this->Add(ShowPriceRiceThai1::$Grid1);

			$form=new TButton();
			$form->set("bnupdate","อับเดตข้อมูล","","",true,"String",false);
			$form->setEvent("onclick","Grid1_Editing");
			$form->setAttribute("class","btn btn-xs btn-info");
			$this->Add($form);


	 	$this->waitevent();
	}

	function Grid1_rowperpage($parameter,$sender)
	{
		$v=explode(",",$parameter);
		ShowPriceRiceThai1::$Grid1->gotopage($v[1]);
		ShowPriceRiceThai1::$Grid1->changenumpage($v[0]);
	 }
	 function Grid1_nextpage($parameter,$sender)
	{
		$v=explode(",",$parameter);
		ShowPriceRiceThai1::$Grid1->gotopage($v[1]);
		ShowPriceRiceThai1::$Grid1->changenumpage($v[0]);
	}
	function Grid1_View($parameter,$sender)
	{
		$thaiID=ShowPriceRiceThai1::$Grid1->getvalues("thaiID",$parameter);

		Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThaiView1&thaiID=$thaiID","alert","");
	}
	function frmNew($parameter,$sender)
	{
		$o=new plugin_price_rice_thai();

		$o->thaiType="1";
		$o->creationUser=$_SESSION["Session_User_UserID"];
		$o->status="Open";

		$dao=new Plugin_Price_Rice_ThaiDao();

		$dao->save($o);
			Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThai1","alert","save");
	}
	function Grid1_Editing($parameter,$sender)
	{
		$dao=new Plugin_Price_Rice_ThaiDao();

		for($i=ShowPriceRiceThai1::$Grid1->getstart();$i<ShowPriceRiceThai1::$Grid1->getstop();$i++)
		{
			$o=new plugin_price_rice_thai();
			

			$o->thaiID=ShowPriceRiceThai1::$Grid1->getvalues("thaiID",$i);
			

			$o->thaiDate=ShowPriceRiceThai1::$Grid1->getvalues("thaiDate",$i);

			$o_update=$dao->selectById($o->thaiID);
			$o->version=$o_update->version;

			if($o->thaiID)
			{
				
				$dao->update($o);
				$o->version="";
				$o->thaiID="";
			}

			
			
		}

		Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThai1","alert","update");

	}
	function Grid1_Deleting($parameter,$sender)
	{
		$o=new plugin_price_rice_thai();
		$o->thaiID=ShowPriceRiceThai1::$Grid1->getvalues("thaiID",$parameter);
		$dao=new Plugin_Price_Rice_ThaiDao();

		$dao->deletes($o);
		Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThai1","alert","del");
	}
	function frmActionExcel($parameter,$sender)
	{
		//require_once './framework/ThirdParty/PHPExcel/Classes/PHPExcel.php';

		$thaiID=ShowPriceRiceThai1::$Grid1->getvalues("thaiID",$parameter);

		$dao_price_rice_thai=new Plugin_Price_Rice_ThaiDao();
			$o_price_rice_thai=$dao_price_rice_thai->selectById($thaiID);

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'ข้อมูล ณ วันที่ '.$o_price_rice_thai->thaiDate);
		$objPHPExcel->getActiveSheet()->setCellValue('B1',$o_price_rice_thai->thaiID);
		$objPHPExcel->getActiveSheet()->setCellValue('C1','ราคาข้าวเปลือกภูมิภาค');

		$objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'ชนิดข้าวเปลือก');
        $objPHPExcel->getActiveSheet()->setCellValue('B2', 'จังหวัด');
        $objPHPExcel->getActiveSheet()->setCellValue('C2', 'สัปดาห์ก่อน ต่ำ-สูง');
        $objPHPExcel->getActiveSheet()->setCellValue('D2', 'จันทร์');
        $objPHPExcel->getActiveSheet()->setCellValue('E2', 'อังคาร');
        $objPHPExcel->getActiveSheet()->setCellValue('F2', 'พุธ');
        $objPHPExcel->getActiveSheet()->setCellValue('G2', 'พฤหัสบดี');
        $objPHPExcel->getActiveSheet()->setCellValue('H2', 'ศุกร์');
        $objPHPExcel->getActiveSheet()->setCellValue('I2', 'สัปดาห์นี้ ต่ำ-สูง');

        $RiceList = array(
	    '1'        => 'ข้าวเปลือกเจ้า 5% นาปี',
	    '2'        => 'ข้าวเปลือกหอมมะลิ ชนิดสีได้ต้นข้าว 36-42 กรัม',
	    '3'        => 'ข้าวเปลือกหอมมะลิที่ปลูกในภาคเหนือตอนล่างหรือภาคกลาง ชนิดสีได้ต้นข้าว 34-40 กรัม',
		'4'        => 'ข้าวเปลือกปทุมธานี นาปี ชนิดสีได้ต้นข้าว 36 กรัม',
		'5'        => 'ข้าวเปลือกเหนียว 10% เมล็ดยาว',
		'6'        => 'ข้าวเปลือกเหนียว 10% เมล็ดสั้น (คละ)',
		'7'        => '');

		$rice1 = array('จังหวัดสุโขทัย','จังหวัดชัยนาท','จังหวัดพระนครศรีอยุธยา','จังหวัดสิงห์บุรี','จังหวัดพิจิตร','จังหวัดฉะเชิงเทรา','จังหวัดพิษณุโลก','จังหวัดสุพรรณบุรี','จังหวัดนครสรรค์');

		$rice2 = array('จังหวัดกาฬสินธุ์','จังหวัดนครราชีมา','จังหวัดยโสธร','จังหวัดสุรินทร์','จังหวัดอุบลราชธานี','จังหวัดขอนแก่น','จังหวัดอุดรธานี','จังหวัดร้อยเอ็ด','จังหวัดเชียงใหม่','จังหวัดพะเยา');

		$rice3 = array('จังหวัดนครสรรค์','จังหวัดพิษณุโลก','จังหวัดแพร่','จังหวัดเพชรบูรณ์');

		$rice4 = array('จังหวัดชัยนาท','จังหวัดสิงห์บุรี','จังหวัดสุพรรณบุรี');

		$rice5 = array('จังหวัดเชียงใหม่','จังหวัดสกลนคร','จังหวัดขอนแก่น','จังหวัดอุดรธานี','จังหวัดกาฬสินธุ์');

		$rice6 = array('จังหวัดสกลนคร','จังหวัดอุดรธานี','จังหวัดขอนแก่น');
			
			

            $countrow=3;

			for($i=1;$i<count($RiceList);$i++)
			{

				$objPHPExcel->setActiveSheetIndex(0);
	            $objPHPExcel->getActiveSheet()->setCellValue('A'.$countrow.'',$RiceList[$i]);
	            if($i=="1")
	            {
	            	
	            	for($j=0;$j<count($rice1);$j++)
	            	{
	            		$countrow++;
	            		$objPHPExcel->setActiveSheetIndex(0);
	            		$objPHPExcel->getActiveSheet()->setCellValue('B'.$countrow.'',$rice1[$j]);
	            	}
	            }

	            if($i=="2")
	            {
	            	
	            	for($j=0;$j<count($rice2);$j++)
	            	{
	            		$countrow++;
	            		$objPHPExcel->setActiveSheetIndex(0);
	            		$objPHPExcel->getActiveSheet()->setCellValue('B'.$countrow.'',$rice2[$j]);
	            	}
	            }

	            if($i=="3")
	            {
	            	
	            	for($j=0;$j<count($rice3);$j++)
	            	{
	            		$countrow++;
	            		$objPHPExcel->setActiveSheetIndex(0);
	            		$objPHPExcel->getActiveSheet()->setCellValue('B'.$countrow.'',$rice3[$j]);
	            	}
	            }

	            if($i=="4")
	            {
	            	
	            	for($j=0;$j<count($rice4);$j++)
	            	{
	            		$countrow++;
	            		$objPHPExcel->setActiveSheetIndex(0);
	            		$objPHPExcel->getActiveSheet()->setCellValue('B'.$countrow.'',$rice4[$j]);
	            	}
	            }

	            if($i=="5")
	            {
	            	
	            	for($j=0;$j<count($rice5);$j++)
	            	{
	            		$countrow++;
	            		$objPHPExcel->setActiveSheetIndex(0);
	            		$objPHPExcel->getActiveSheet()->setCellValue('B'.$countrow.'',$rice5[$j]);
	            	}
	            }

	            if($i=="6")
	            {
	            	
	            	for($j=0;$j<count($rice6);$j++)
	            	{
	            		$countrow++;
	            		$objPHPExcel->setActiveSheetIndex(0);
	            		$objPHPExcel->getActiveSheet()->setCellValue('B'.$countrow.'',$rice6[$j]);
	            	}
	            }
	            
	 

	            $countrow++;
			}
			$objPHPExcel->getActiveSheet()->setTitle('ข้าวเปลือกภูมิภาค');
			$objPHPExcel->setActiveSheetIndex(0);


			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="ข้าวเปลือกภูมิภาค.xls"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
			exit;

	}
	function frmActionExcelUpload($parameter,$sender)
	{
		//$thaiID=$sender->getdata('thaiID');


		$userfile=$sender->getvalue('fileexcel');
		$Datef=Date("d-m-y");
		$Timef=Date("H-i-s");
		$Datef=ereg_replace("-","",$Datef);
		$Timef=ereg_replace("-","",$Timef); 
		$Fname="excel_".$Datef."_".$Timef;

		$excel_file=uploadFile(0,"./Upload/File",$Fname,$userfile);

		$file_name=$excel_file;

		if($file_name)
		{
			$inputFileType = 'Excel5';
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($file_name);


			$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		}
		
		
		$dao=new Plugin_Price_Rice_Thai_PaddyDao();
		$dao_data=new Plugin_Price_Rice_Thai_Paddy_DataDao();

		$thaiID=$sheetData['1']["B"];
		for($i=3;$i<=count($sheetData);$i++)
		{

			$check_value_a=$sheetData[$i]["A"];

			if($check_value_a)
			{
				$o=new plugin_price_rice_thai_paddy();
				$o->thaiID=$thaiID;
				$o->paddyType=$sheetData[$i]["A"];
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

				$check_id_paddy=$o->paddyID;
				
			}

			$check_value_b=$sheetData[$i]["B"];
			if($check_value_b)
			{

				$check_data1=$dao_data->selectAllByPaddyIDAndData1($check_id_paddy,$check_value_b);
				
				$o_data=new plugin_price_rice_thai_paddy_data();
				$o_data->paddyID=$check_id_paddy;
				$o_data->thaiID=$thaiID;

				$o_data->data1=$sheetData[$i]["B"];
				$o_data->data2=$sheetData[$i]["C"];
				$o_data->data3=$sheetData[$i]["D"];
				$o_data->data4=$sheetData[$i]["E"];
				$o_data->data5=$sheetData[$i]["F"];
				$o_data->data6=$sheetData[$i]["G"];
				$o_data->data7=$sheetData[$i]["H"];
				$o_data->data8=$sheetData[$i]["I"];

				$o_data->status="Open";
				$o_data->creationUser=$_SESSION["Session_User_UserID"];
				

				if($check_data1[0]->dataID)
				{
					$o_data->dataID=$check_data1[0]->dataID;
					$o_data->version=$check_data1[0]->version;
					$dao_data->update($o_data);
				}
				else
				{
					$dao_data->save($o_data);
				}
				
			}
			
		}
		Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThai1","alert","save");
	}
	function frmActionExcelReport($parameter,$sender)
	{
		$thaiID=ShowPriceRiceThai1::$Grid1->getvalues("thaiID",$parameter);

		$dao_price_rice_thai=new Plugin_Price_Rice_ThaiDao();
			$o_price_rice_thai=$dao_price_rice_thai->selectById($thaiID);

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'ข้อมูล ณ วันที่ '.$o_price_rice_thai->thaiDate);
		$objPHPExcel->getActiveSheet()->setCellValue('B1',$o_price_rice_thai->thaiID);
		$objPHPExcel->getActiveSheet()->setCellValue('C1','ราคาข้าวเปลือกภูมิภาค');

		$objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'ชนิดข้าวเปลือก');
        $objPHPExcel->getActiveSheet()->setCellValue('B2', 'จังหวัด');
        $objPHPExcel->getActiveSheet()->setCellValue('C2', 'สัปดาห์ก่อน ต่ำ-สูง');
        $objPHPExcel->getActiveSheet()->setCellValue('D2', 'จันทร์');
        $objPHPExcel->getActiveSheet()->setCellValue('E2', 'อังคาร');
        $objPHPExcel->getActiveSheet()->setCellValue('F2', 'พุธ');
        $objPHPExcel->getActiveSheet()->setCellValue('G2', 'พฤหัสบดี');
        $objPHPExcel->getActiveSheet()->setCellValue('H2', 'ศุกร์');
        $objPHPExcel->getActiveSheet()->setCellValue('I2', 'สัปดาห์นี้ ต่ำ-สูง');

        $countrow=3;

        $dao_price_thai_paddy=new Plugin_Price_Rice_Thai_PaddyDao();
        $dao_price_thai_paddy_data=new Plugin_Price_Rice_Thai_Paddy_DataDao();

        	$o_price_thai_paddy=$dao_price_thai_paddy->selectAllByThaiID($thaiID,"1");

        $countrow=3;
		for($i=0;$i<count($o_price_thai_paddy);$i++)
		{

			$objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$countrow.'',$o_price_thai_paddy[$i]->paddyType);

            $o_price_thai_paddy_data=$dao_price_thai_paddy_data->selectAllByPaddyID($o_price_thai_paddy[$i]->paddyID,"1");
            if($o_price_thai_paddy_data)
            {
            	for($j=0;$j<count($o_price_thai_paddy_data);$j++)
            	{
            		$countrow++;
            		$objPHPExcel->setActiveSheetIndex(0);
            		$objPHPExcel->getActiveSheet()->setCellValue('B'.$countrow.'',$o_price_thai_paddy_data[$j]->data1);
            		$objPHPExcel->getActiveSheet()->setCellValue('C'.$countrow.'',$o_price_thai_paddy_data[$j]->data2);
            		$objPHPExcel->getActiveSheet()->setCellValue('D'.$countrow.'',$o_price_thai_paddy_data[$j]->data3);
            		$objPHPExcel->getActiveSheet()->setCellValue('E'.$countrow.'',$o_price_thai_paddy_data[$j]->data4);
            		$objPHPExcel->getActiveSheet()->setCellValue('F'.$countrow.'',$o_price_thai_paddy_data[$j]->data5);
            		$objPHPExcel->getActiveSheet()->setCellValue('G'.$countrow.'',$o_price_thai_paddy_data[$j]->data6);
            		$objPHPExcel->getActiveSheet()->setCellValue('H'.$countrow.'',$o_price_thai_paddy_data[$j]->data7);
            		$objPHPExcel->getActiveSheet()->setCellValue('I'.$countrow.'',$o_price_thai_paddy_data[$j]->data8);

            	}
            }

            $countrow++;

        }

        $objPHPExcel->getActiveSheet()->setTitle('ข้าวเปลือกภูมิภาค');
		$objPHPExcel->setActiveSheetIndex(0);


			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="ข้าวเปลือกภูมิภาค.xls"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
			exit;

	}
}
?>