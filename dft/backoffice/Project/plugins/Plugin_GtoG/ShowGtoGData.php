<?php
require_once("Project/plugins/Plugin_GtoG/Dao/Plugin_GtoGDao.php");
require_once("Project/plugins/Plugin_GtoG/Common/plugin_gtog.php");

require_once("Project/plugins/Plugin_GtoG/Dao/Plugin_Gtog_DataDao.php");
require_once("Project/plugins/Plugin_GtoG/Common/plugin_gtog_data.php");

class  ShowGtoGData extends TForm
{
	public static $Grid1;
	function ShowGtoGData()
	{
		$dao_submodule=new SubModuleDao();
			$o_submodule=$dao_submodule->selectAllBySystem("plugin_gtog");

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
			$this->Init("ShowGtoGData","Plugin_GtoG","form-horizontal row-border",true);
				
			$gtogID=$this->getdata("gtogID");
			$gtogType=$this->getdata("gtogType");

			$dao_gtog=new Plugin_GtoGDao();
				$o_gtog=$dao_gtog->selectById($gtogID);

			if($o_gtog)
			{

				$form=new THidden();
				$form->set("gtogID",$o_gtog->gtogID,"","",true,"","");
				$this->add($form);

				$form=new TLabel();
				$form->set("gtogType",$gtogType,"","",true,"","");
				$this->add($form);

				$form=new TLabel();
				$form->set("gtogDate",$o_gtog->gtogDate,"","",true,"","");
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

				//$form=new TButton();
				//$form->set("bnauto"," เพิ่มประเทศเริ่มต้น","","",true,"","");
				//$form->setEvent("onclick","frmNewAuto");
				//$form->setAttribute("class","btn btn-xs btn-primary");
				//$this->Add($form);
				
				
			}
			
			if($o_per[0]->permissDel=="true")
			{
				$bndelgrid=new TButton();
				$bndelgrid->set("bndelgrid"," ลบข้อมูล","","",true,"","");
				$bndelgrid->setEvent_Confirm("onclick","frmDelAll",true,"คุณต้องการลบข้อมูลใช่หรือไม่");
				$bndelgrid->setAttribute("class","btn btn-xs btn-danger");
				$this->Add($bndelgrid);
			}
		
			
			$dao=new Plugin_Gtog_DataDao();
				$o=$dao->selectAllByGtogID($gtogID,$gtogType);

			
			ShowGtoGData::$Grid1=new TGridview();
			ShowGtoGData::$Grid1->setview("Grid1",$o);

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
			ShowGtoGData::$Grid1->addcontrol($grid);
			
			$grid=new TTextBox();
			$grid->set('gtogPeriod',"","","",true,"",false);
			$grid->title='งวดที่/สัญญาที่';
			$grid->setAttribute("class","form-control");
			ShowGtoGData::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("riceType","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='ชนิดข้าว';
			ShowGtoGData::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("gtogValue","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='ปริมาณ (ตัน)';
			ShowGtoGData::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("gtogPrice","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='ราคา (เหรียญ/ตัน)';
			ShowGtoGData::$Grid1->addcontrol($grid);

			ShowGtoGData::$Grid1->View=false;
			ShowGtoGData::$Grid1->Edit=false;
			ShowGtoGData::$Grid1->Delete=$o_per[0]->permissDel;
			$this->Add(ShowGtoGData::$Grid1);

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
			ShowGtoGData::$Grid1->gotopage($v[1]);
			ShowGtoGData::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowGtoGData::$Grid1->gotopage($v[1]);
			ShowGtoGData::$Grid1->changenumpage($v[0]);
		}
		function Grid1_View($parameter,$sender)
		{
			
		}
		function frmNew($parameter,$sender)
		{

			$o=new plugin_gtog_data();
			$o->gtogID=$sender->getdata('gtogID');
			$o->gtogType=$sender->getdata('gtogType');
			$o->creationUser=$_SESSION["Session_User_UserID"];
			$o->status="Open";
			$dao=new Plugin_Gtog_DataDao();
			$dao->save($o);

			Refreshs("Plugin_GtoG/ShowGtoGData&gtogID=$o->gtogID&gtogType=$o->gtogType","alert","save");
		}
		function frmAction($parameter,$sender)
		{
			$o=new plugin_gtog_data();

			//$o->genID=$sender->getdata('genID');
			$o->gtogID=$sender->getdata('gtogID');
			$o->gtogType=$sender->getdata('gtogType');

			$o->version=$sender->getdata('version');
			$o->gtogPeriod=$sender->getdata('gtogPeriod_box');
			$o->riceType=$sender->getdata('riceType_box');
			$o->gtogValue=$sender->getdata('gtogValue_box');
			$o->gtogPrice=$sender->getdata('gtogPrice_box');

			$o->creationUser=$_SESSION["Session_User_UserID"];
			$o->status="Open";
			$dao=new Plugin_Gtog_DataDao();
			
			if($o->genID)
			{

				//$dao->update($o);
				//Refreshs("Plugin_Manufacturing_World/ShowManufacturingWorld","alert","update");
			}
			else
			{

				$o_check_name=$dao->selectAllByWorldIDAndName($o->gtogID,$o->gtogType);
				if(empty($o_check_name))
					$dao->save($o);

				Refreshs("Plugin_GtoG/ShowGtoGData&gtogID=$o->gtogID&gtogType=$o->gtogType","alert","save");
					
			}
		}
		function Grid1_Editing($parameter,$sender)
		{
			$dao=new Plugin_Gtog_DataDao();

			for($i=ShowGtoGData::$Grid1->getstart();$i<ShowGtoGData::$Grid1->getstop();$i++)
			{
				$o=new plugin_gtog_data();
				

				$o->dataID=ShowGtoGData::$Grid1->getvalues("dataID",$i);
				

				$o->gtogPeriod=ShowGtoGData::$Grid1->getvalues("gtogPeriod",$i);
				$o->riceType=ShowGtoGData::$Grid1->getvalues("riceType",$i);
				$o->gtogValue=ShowGtoGData::$Grid1->getvalues("gtogValue",$i);
				$o->gtogPrice=ShowGtoGData::$Grid1->getvalues("gtogPrice",$i);

				$o_update=$dao->selectById($o->dataID);
				$o->version=$o_update->version;

				if($o->dataID and $o->riceType and $o->gtogValue and $o->gtogPrice)
				{
					
					$dao->update($o);
					$o->version="";
					$o->dataID="";
				}

				
				
			}
			
			$gtogID=$sender->getdata('gtogID');
			$gtogType=$sender->getdata('gtogType');

			Refreshs("Plugin_GtoG/ShowGtoGData&gtogID=$gtogID&gtogType=$gtogType","alert","update");

		}
		function Grid1_Deleting($parameter,$sender)
		{
			$o=new plugin_gtog_data();
			$o->dataID=ShowGtoGData::$Grid1->getvalues("dataID",$parameter);
			$dao=new Plugin_Gtog_DataDao();

			$dao->deletes($o);

			$gtogID=$sender->getdata('gtogID');
			$gtogType=$sender->getdata('gtogType');
			Refreshs("Plugin_GtoG/ShowGtoGData&gtogID=$gtogID&gtogType=$gtogType","alert","del");
		}
		
		function frmDelAll($parameter,$sender)
		{
			$dao=new Plugin_Gtog_DataDao();

			for($i=ShowGtoGData::$Grid1->getstart();$i<ShowGtoGData::$Grid1->getstop();$i++)
			{
				$o=new plugin_gtog_data();
				
				$o->dataID=ShowGtoGData::$Grid1->getvalues("dataID",$i);
				
				$o->cartoonpartIDCheck=ShowGtoGData::$Grid1->getvalues("cartoonpartIDCheck",$i);
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
			
			$gtogID=$sender->getdata('gtogID');
			$gtogType=$sender->getdata('gtogType');
			Refreshs("Plugin_GtoG/ShowGtoGData&gtogID=$gtogID&gtogType=$gtogType","alert","del");
		}
		
		
}
?>