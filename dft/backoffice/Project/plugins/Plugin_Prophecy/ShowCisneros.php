<?php
require_once("Project/plugins/Plugin_Prophecy/Dao/Plugin_ProphecyDao.php");
require_once("Project/plugins/Plugin_Prophecy/Common/plugin_prophecy.php");

require_once("Project/plugins/Plugin_Prophecy/Dao/Plugin_Prophecy_DataDao.php");
require_once("Project/plugins/Plugin_Prophecy/Common/plugin_prophecy_data.php");

require_once("Project/plugins/Plugin_Source/Dao/Plugin_SourceDao.php");
require_once("Project/plugins/Plugin_Source/Common/plugin_source.php");

class  ShowCisneros extends TForm
{
	public static $Grid1;
	function ShowCisneros()
	{
		$dao_submodule=new SubModuleDao();
			$o_submodule=$dao_submodule->selectAllBySystem("plugin_prophecy");

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
			$this->Init("ShowCisneros","Plugin_Prophecy","form-horizontal row-border",true);
				
			$prophecyID=$this->getdata("prophecyID");

			$dao_prophecy=new Plugin_ProphecyDao();
				$o_prophecy=$dao_prophecy->selectById($prophecyID);

			if($o_prophecy)
			{

				$form=new THidden();
				$form->set("prophecyID",$o_prophecy->prophecyID,"","",true,"","");
				$this->add($form);

				$form=new TLabel();
				$form->set("prophecyYear",$o_prophecy->prophecyYear,"","",true,"","");
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
				$form->set("bn"," เพิ่มข้อมูลการพยากรณ์","","",true,"","");
				$form->setEvent("onclick","frmNew");
				$form->setAttribute("class","btn btn-xs btn-primary");
				//$form->setAttribute("data-toggle","modal");
				//$form->setAttribute("href","#myModal1");
				$this->Add($form);
			

				$dao_source=new Plugin_SourceDao();
					$o_source=$dao_source->selectAllByDataID($prophecyID."_3_1");

				$form=new THidden();
				$form->set("dataID_source",$prophecyID."_3_1","","",true,"","");
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
		
			
			$dao=new Plugin_Prophecy_DataDao();
				$o=$dao->selectAllByProphecyID($prophecyID);

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

			$grid=new TListBox();
			$grid->set("typePlanted","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='นาปี / นาปรัง';
			$grid->additem("1","นาปี");
			$grid->additem("2","นาปรัง");
			ShowCisneros::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("areaFarming","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='เนื้อที่เพาะปลูก(ไร่)';
			ShowCisneros::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("areaFarmingValue","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='ปริมาณ เพิ่ม-ลด จากปีที่ผ่านมา';
			ShowCisneros::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("areaFarmingPercent","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='ร้อยละ เพิ่ม-ลด จากปีที่ผ่านมา';
			ShowCisneros::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("product","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='ผลผลิต(ตัน)';
			ShowCisneros::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("productValue","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='ปริมาณ เพิ่ม-ลด จากปีที่ผ่านมา';
			ShowCisneros::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("productPercent","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='ร้อยละ เพิ่ม-ลด จากปีที่ผ่านมา';
			ShowCisneros::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("productFarming","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='ผลผลิต/ไร่(ก.ก)';
			ShowCisneros::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("productFarmingValue","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='ปริมาณ เพิ่ม-ลด จากปีที่ผ่านมา';
			ShowCisneros::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("productFarmingPercent","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='ร้อยละ เพิ่ม-ลด จากปีที่ผ่านมา';
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
			$o=new plugin_prophecy_data();
			$o->prophecyID=$sender->getdata('prophecyID');
			$o->creationUser=$_SESSION["Session_User_UserID"];
			$o->status="Open";
			$dao=new Plugin_Prophecy_DataDao();
			$dao->save($o);

			Refreshs("Plugin_Prophecy/ShowCisneros&prophecyID=$o->prophecyID","alert","save");
		}
		function frmAction($parameter,$sender)
		{
			$o=new plugin_prophecy_data();

			//$o->genID=$sender->getdata('genID');
			$o->typePlanted=$sender->getdata('typePlanted_box');
			$o->prophecyID=$sender->getdata('prophecyID');
			$o->areaFarming=$sender->getdata('areaFarming_box');
			$o->areaFarmingValue=$sender->getdata('areaFarmingValue_box');
			$o->areaFarmingPercent=$sender->getdata('areaFarmingPercent_box');
			$o->product=$sender->getdata('product_box');
			$o->productValue=$sender->getdata('productValue_box');
			$o->productPercent=$sender->getdata('productPercent_box');
			$o->productFarming=$sender->getdata('productFarming_box');
			$o->productFarmingValue=$sender->getdata('productFarmingValue_box');
			$o->productFarmingPercent=$sender->getdata('productFarmingPercent_box');
			$o->typePlanted=$sender->getdata('typePlanted_box');

			$o->version=$sender->getdata('version');
			$o->creationUser=$_SESSION["Session_User_UserID"];
			$o->status="Open";

			$dao=new Plugin_Prophecy_DataDao();
			
			if($o->cisnerosID)
			{

				$dao->update($o);
				Refreshs("Plugin_Manufacturing_World/ShowManufacturingWorld","alert","update");
			}
			else
			{

				$o_check_name=$dao->selectAllByProphecyID($o->prophecyID);
				if(empty($o_check_name))
					$dao->save($o);

				Refreshs("Plugin_Prophecy/ShowCisneros&prophecyID=$o->prophecyID","alert","save");
					
			}
		}
		function Grid1_Editing($parameter,$sender)
		{
			$dao=new Plugin_Prophecy_DataDao();

			for($i=ShowCisneros::$Grid1->getstart();$i<ShowCisneros::$Grid1->getstop();$i++)
			{
				$o=new plugin_prophecy_data();
				

				$o->dataID=ShowCisneros::$Grid1->getvalues("dataID",$i);
				$o->typePlanted=ShowCisneros::$Grid1->getvalues("typePlanted",$i);
				$o->areaFarming=ShowCisneros::$Grid1->getvalues("areaFarming",$i);
				$o->areaFarmingValue=ShowCisneros::$Grid1->getvalues("areaFarmingValue",$i);
				$o->areaFarmingPercent=ShowCisneros::$Grid1->getvalues("areaFarmingPercent",$i);
				$o->product=ShowCisneros::$Grid1->getvalues("product",$i);
				$o->productValue=ShowCisneros::$Grid1->getvalues("productValue",$i);
				$o->productPercent=ShowCisneros::$Grid1->getvalues("productPercent",$i);
				$o->productFarming=ShowCisneros::$Grid1->getvalues("productFarming",$i);
				$o->productFarmingValue=ShowCisneros::$Grid1->getvalues("productFarmingValue",$i);
				$o->productFarmingPercent=ShowCisneros::$Grid1->getvalues("productFarmingPercent",$i);


				$o_update=$dao->selectById($o->dataID);
				$o->version=$o_update->version;

				if($o->dataID)
				{
					
					$dao->update($o);
					$o->version="";
					$o->dataID="";
				}

				
				
			}
			
			$prophecyID=$sender->getdata('prophecyID');
			Refreshs("Plugin_Prophecy/ShowCisneros&prophecyID=$prophecyID","alert","update");

		}
		function Grid1_Deleting($parameter,$sender)
		{
			$o=new plugin_prophecy_data();
			$o->dataID=ShowCisneros::$Grid1->getvalues("dataID",$parameter);
			$dao=new Plugin_Prophecy_DataDao();

			$dao->deletes($o);

			$prophecyID=$sender->getdata('prophecyID');
			Refreshs("Plugin_Prophecy/ShowCisneros&prophecyID=$prophecyID","alert","del");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new Plugin_Prophecy_DataDao();

			for($i=ShowCisneros::$Grid1->getstart();$i<ShowCisneros::$Grid1->getstop();$i++)
			{
				$o=new plugin_prophecy_data();
				
				$o->dataID=ShowCisneros::$Grid1->getvalues("dataID",$i);
				
				$o->cartoonpartIDCheck=ShowCisneros::$Grid1->getvalues("cartoonpartIDCheck",$i);
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
			
			$prophecyID=$sender->getdata('prophecyID');
			Refreshs("Plugin_Prophecy/ShowCisneros&prophecyID=$prophecyID","alert","del");
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
				//msgbox(print_r($o->dataID));
				$dao->save($o);
			}

			$prophecyID=$sender->getdata('prophecyID');
			Refreshs("Plugin_Prophecy/ShowCisneros&prophecyID=$prophecyID","alert","save");
		}
		
}
?>