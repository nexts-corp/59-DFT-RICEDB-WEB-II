<?php
require_once("Project/plugins/Plugin_Puddy/Dao/Plugin_Sub_PuddyDao.php");
require_once("Project/plugins/Plugin_Puddy/Common/plugin_sub_puddy.php");

require_once("Project/plugins/Plugin_Puddy/Dao/Plugin_ProvinceDao.php");
require_once("Project/plugins/Plugin_Puddy/Common/plugin_province.php");

require_once("Project/bussiness/Plugin_GetDataDao.php");
require_once("Project/common/plugin_getdata.php");



 class frmSubPuddy extends TForm
 {
	 	
		function frmSubPuddy()
		{
			$dao_submodule=new SubModuleDao();
				$o_submodule=$dao_submodule->selectAllBySystem("plugin_info_type");

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
				
			if($o_per[0]->permissAdd=="true")
				$this->Init("frmSubPuddy","Plugin_Puddy","form-horizontal row-border",true);
			
			$obj=$this->getdata("object_id");
			
			
			$dao=new Plugin_Sub_PuddyDao();
			$o=$dao->selectById($obj);
			
			$form=new THidden();
			$form->set('subPuddyID',$o->subPuddyID,30,30,true,"String",false); 
			$this->add($form);

			$version=new THidden();
			$version->set('version',$o->version,30,30,true,"String",false); 
			$this->add($version);

			$form=new TListBox();
			$form->set('listType',"","","",true,"String",true);
			$form->additem("normal","เพิ่มข้อมูลในรูปแบบปกติ");
			$form->additem("excel","เพิ่มข้อมูลในรูปแบบ Exel");
			$form->additem("bot","เพิ่มข้อมูลในรูปแบบ ดึงข้อมูล");
			$form->setAttribute("class","form-control");
			$form->setAttribute("placeholder","");
			$this->add($form);

			$dao_Provice=new Plugin_ProvinceDao();
			$o_proviece=$dao_Provice->selectAllSql();

			$form=new TListBox();
			$form->set('province',$o->province,"","",true,"String",false);
			$form->additem("","--เลือกจังหวัด--");
			for($i=0;$i<count($o_proviece);$i++){
				$form->additem($o_proviece[$i]->PROVINCE_NAME,$o_proviece[$i]->PROVINCE_NAME);
			}
			$form->setAttribute("class","form-control ");
			$form->setAttribute("placeholder","หัวข้อ");
			$this->add($form);

			$dayAndWeek=array('สัปดาห์ก่อน','วันอาทิตย์','วันจันทร์','วันอังคาร','วันพุธ','วันพฤหัสบดี','วันศุกร์','วันเสาร์','สัปดาห์นี้');

			$form=new TListBox();
			$form->set('dayAndWeek',$o->dayAndWeek,"","",true,"String",false);
			for($i=0;$i<count($dayAndWeek);$i++){
				$form->additem($dayAndWeek[$i],$dayAndWeek[$i]);
			} 
			$form->setAttribute("class","form-control");
			$form->setAttribute("placeholder","");
			$this->add($form);


			$form=new TTextBox();
			$form->set('details',$o->details,"","",true,"String",false); 
			$form->setAttribute("class","form-control");
			$form->setAttribute("placeholder","รายละเอียด");
			$this->add($form);


			$form=new TTextBox();
			$form->set('startLink',$o->startLink,"","",true,"String",false); 
			$form->setAttribute("class","form-control");
			$form->setAttribute("placeholder","ลิ้งเริ่มต้น");
			$this->add($form);

			$form=new TTextBox();
			$form->set('endLink',$o->endLink,"","",true,"String",false); 
			$form->setAttribute("class","form-control");
			$form->setAttribute("placeholder","ลิ้งสิ้นสุด");
			$this->add($form);


			$form=new TInputfile();
			$form->set('exelFile',$o->exelFile,"","",true,"String",false);
			$this->add($form);




			$form=new TListBox();
			$form->set('status',$o->status,"","",true,"String",true); 
			$form->additem("Open","เปิดการใช้งาน");
			$form->additem("Close","ปิดการใช้งาน");
			$form->setAttribute("class","form-control");
			$this->add($form);
			
			
			$bn=new TButton();
			$bn->set("bn","บันทึกข้อมูล","","",true,"String",true);
			$bn->setEvent("onclick","frmAction");
			$bn->setAttribute("class","btn btn-primary");
			$this->Add($bn);

			$bnexcel=new TButton();
			$bnexcel->set("bnexcel","บันทึกข้อมูลด้วย excel ไฟล์","","",true,"String",true);
			$bnexcel->setEvent("onclick","frmAddExcel");
			$bnexcel->setAttribute("class","btn btn-primary");
			$this->Add($bnexcel);

			$bnreset=new TResets();
			$bnreset->set("bnreset","ล้างข้อมูล","","",true,"String",true);
			$bnreset->setAttribute("class","btn");
			$this->Add($bnreset);

			$this->waitevent();
		}
		function frmAction($parameter,$sender)
		{
				
				$o=new plugin_sub_puddy();
				$o->subPuddyID=$sender->getvalue('subPuddyID');
				$o->version=$sender->getvalue('version');
				$o->puddyID=$_SESSION["Session_PuddyID"];
				$o->province=$sender->getvalue('province');
				$o->dayAndWeek=$sender->getvalue('dayAndWeek');
				$o->details=$sender->getvalue('details');
				
				$o->status=$sender->getvalue('status');
				$o->creationUser=$_SESSION["Session_User_UserID"];
				
				$dao=new Plugin_Sub_PuddyDao();

				if($o->subPuddyID)
			{
				$dao->update($o);
				Refreshs("Plugin_Puddy/ShowPuddy","alert","update");
			}

				$dao->save($o);
				Refreshs("Plugin_Puddy/ShowPuddy","alert","save");




		}
		function frmAddExcel($parameter,$sender){

				$o_xl=new plugin_getdata();


				$userfile=$sender->getvalue('exelFile');
			
					$Datef=Date("d-m-y");
					$Timef=Date("H-i-s");
					$Datef=ereg_replace("-","",$Datef);
					$Timef=ereg_replace("-","",$Timef); 
					$Fname="fileimg_".$Datef."_".$Timef;

				$o_xl->excelFile=uploadFile(0,"./Upload/File/",$Fname,$userfile);

				$o_xl->puddyID=$_SESSION["Session_PuddyID"];
				$o_xl->status="Open";
				$o_xl->creationUser=$_SESSION["Session_User_UserID"];

				$dao_exl= new Plugin_GetDataDao();

				$dao_exl->save($o_xl);

				$o_exl=$dao_exl->selectAllByOpenPuddyID($_SESSION["Session_PuddyID"]);

				$inputFileName=$o_exl[0]->excelFile;; 


				$inputFileType = PHPExcel_IOFactory::identify($inputFileName); 
				$objReader = PHPExcel_IOFactory::createReader($inputFileType); 
				$objReader->setReadDataOnly(true); 
				$objPHPExcel = $objReader->load($inputFileName); 
 
				$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);

				$highestRow = $objWorksheet->getHighestRow();

				$highestColumn = $objWorksheet->getHighestColumn();

				$headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);

				$headingsArray = $headingsArray[1];

				 

				$r = -1;

				$namedDataArray = array();

			    for ($row = 2; $row <= $highestRow; ++$row) {

				$dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
				if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
				++$r;
				foreach($headingsArray as $columnKey => $columnHeading) {
				$namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
						}
					}
				}	


				foreach ($namedDataArray as $result) {

							$o=new plugin_sub_puddy();
							$o->province=$result['province'];
							$o->dayAndWeek=$result['dayAndWeek'];
							$o->details=$result['details'];
							$o->puddyID=$_SESSION["Session_PuddyID"];
							$o->status="Open";
							$o->creationUser=$_SESSION["Session_User_UserID"];

							$dao=new Plugin_Sub_PuddyDao();
							$dao->save($o);
						
				}	
				
				Refreshs("Plugin_Puddy/ShowPuddy","alert","save");
		}

 }

?>