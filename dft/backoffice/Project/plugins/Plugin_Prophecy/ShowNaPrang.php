<?php
require_once("Project/plugins/Plugin_Planted/Dao/Plugin_PlantedDao.php");
require_once("Project/plugins/Plugin_Planted/Common/plugin_planted.php");

require_once("Project/plugins/Plugin_Planted/Dao/Plugin_Planted_CisnerosDao.php");
require_once("Project/plugins/Plugin_Planted/Common/plugin_planted_cisneros.php");

class  ShowNaPrang extends TForm
{
	public static $Grid1;
	function ShowNaPrang()
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
			$this->Init("ShowNaPrang","Plugin_Planted","form-horizontal row-border",true);
				
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
				$form=new TButton();
				$form->set("bn"," เพิ่มข้อมูลใหม่","","",true,"","");
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
				
				$form=new TTextBox();
				$form->set('province',"","","",true,"String",true); 
				$form->setAttribute("class","form-control");
				$form->setAttribute("placeholder","จังหวัด");
				$this->add($form);

				$form=new TTextBox();
				$form->set('areaFarming_box',"","","",true,"String",true); 
				$form->setAttribute("class","form-control");
				$form->setAttribute("placeholder","เนื้อที่เพาะปลูก (ไร่)");
				$this->add($form);

				$form=new TTextBox();
				$form->set('areaHarvest_box',"","","",true,"String",true); 
				$form->setAttribute("class","form-control");
				$form->setAttribute("placeholder","เนื้อที่เก็บเกี่ยว (ไร่)");
				$this->add($form);

				$form=new TTextBox();
				$form->set('product_box',"","","",true,"String",true); 
				$form->setAttribute("class","form-control");
				$form->setAttribute("placeholder","ผลผลิต (ตัน)");
				$this->add($form);

				$form=new TTextBox();
				$form->set('productFarming_box',"","","",true,"String",true); 
				$form->setAttribute("class","form-control");
				$form->setAttribute("placeholder","ผลผลิตต่อไร่ปลูก (กก)");
				$this->add($form);

				$form=new TTextBox();
				$form->set('productHarvest_box',"","","",true,"String",true); 
				$form->setAttribute("class","form-control");
				$form->setAttribute("placeholder","ผลผลิตต่อไร่เก็บ (กก)");
				$this->add($form);

				$form=new TTextBox();
				$form->set('percent_box',"","","",true,"String",true); 
				$form->setAttribute("class","form-control");
				$form->setAttribute("placeholder","ร้อยละ");
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
		
			
			$dao=new Plugin_Planted_CisnerosDao();
				$o=$dao->selectAllByPlantedID($plantedID,"2");

			ShowNaPrang::$Grid1=new TGridview();
			ShowNaPrang::$Grid1->setview("Grid1",$o);

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
			ShowNaPrang::$Grid1->addcontrol($grid);
			
			$grid=new TLabel();
			$grid->set('province',"","","",true,"",false);
			$grid->title='จังหวัด';
			ShowNaPrang::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("areaFarming","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='เนื้อที่เพาะปลูก(ไร่)';
			ShowNaPrang::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("areaHarvest","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='เนื้อที่เก็บเกี่ยว(ไร่)';
			ShowNaPrang::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("product","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='ผลผลิต';
			ShowNaPrang::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("productFarming","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='ผลผลิต/ไร่(ปลูก)';
			ShowNaPrang::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("productHarvest","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='ผลผลิต/ไร่(เก็บเกี่ยว)';
			ShowNaPrang::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("percent","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='ร้อยละ';
			ShowNaPrang::$Grid1->addcontrol($grid);


			ShowNaPrang::$Grid1->View=false;
			ShowNaPrang::$Grid1->Edit=false;
			ShowNaPrang::$Grid1->Delete=$o_per[0]->permissDel;
			$this->Add(ShowNaPrang::$Grid1);

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
			ShowNaPrang::$Grid1->gotopage($v[1]);
			ShowNaPrang::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowNaPrang::$Grid1->gotopage($v[1]);
			ShowNaPrang::$Grid1->changenumpage($v[0]);
		}
		function Grid1_View($parameter,$sender)
		{
			
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
			$o->typePlanted="2";

			$o->version=$sender->getdata('version');
			$o->creationUser=$_SESSION["Session_User_UserID"];
			$o->status="Open";

			$dao=new Plugin_Planted_CisnerosDao();
			
			if($o->cisnerosID)
			{

				$dao->update($o);
				Refreshs("Plugin_Manufacturing_World/ShowManufacturingWorld","alert","update");
			}
			else
			{

				$o_check_name=$dao->selectAllByPlantedIDAndName($o->plantedID,$o->province,"2");
				if(empty($o_check_name))
					$dao->save($o);

				Refreshs("Plugin_Planted/ShowNaPrang&plantedID=$o->plantedID","alert","save");
					
			}
		}
		function Grid1_Editing($parameter,$sender)
		{
			$dao=new Plugin_Planted_CisnerosDao();

			for($i=ShowNaPrang::$Grid1->getstart();$i<ShowNaPrang::$Grid1->getstop();$i++)
			{
				$o=new plugin_planted_cisneros();
				

				$o->cisnerosID=ShowNaPrang::$Grid1->getvalues("cisnerosID",$i);
				$o->areaFarming=ShowNaPrang::$Grid1->getvalues("areaFarming",$i);
				$o->areaHarvest=ShowNaPrang::$Grid1->getvalues("areaHarvest",$i);
				$o->product=ShowNaPrang::$Grid1->getvalues("product",$i);
				$o->productFarming=ShowNaPrang::$Grid1->getvalues("productFarming",$i);
				$o->productHarvest=ShowNaPrang::$Grid1->getvalues("productHarvest",$i);
				$o->percent=ShowNaPrang::$Grid1->getvalues("percent",$i);


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
			Refreshs("Plugin_Planted/ShowNaPrang&plantedID=$plantedID","alert","update");

		}
		function Grid1_Deleting($parameter,$sender)
		{
			$o=new plugin_planted_cisneros();
			$o->cisnerosID=ShowNaPrang::$Grid1->getvalues("cisnerosID",$parameter);
			$dao=new Plugin_Planted_CisnerosDao();

			$dao->deletes($o);

			$plantedID=$sender->getdata('plantedID');
			Refreshs("Plugin_Planted/ShowNaPrang&plantedID=$plantedID","alert","del");
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
		function frmNewAuto($parameter,$sender)
		{
			$array = array("เชียงใหม่","เชียงราย","ลำพูน","ลำปาง","ตาก");
			$plantedID=$sender->getdata('plantedID');
			$dao=new Plugin_Planted_CisnerosDao();
			for($i=0;$i<count($array);$i++)
			{
				$o=new plugin_planted_cisneros();

				$o->plantedID=$plantedID;
				$o->typePlanted="2";
				
				$o->province=$array[$i];
				$o->creationUser=$_SESSION["Session_User_UserID"];
				$o->status="Open";

				$o_check_name=$dao->selectAllByPlantedIDAndName($o->plantedID,$o->province,"2");
				if(empty($o_check_name))
					$dao->save($o);

			}
			Refreshs("Plugin_Planted/ShowNaPrang&plantedID=$plantedID","alert","save");
		}
		function frmActionStatus($parameter,$sender)
		{
			$o=new plugin_manufacturing_world();
			$worldID=ShowNaPrang::$Grid1->getvalues("worldID",$parameter);
			
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

			for($i=ShowNaPrang::$Grid1->getstart();$i<ShowNaPrang::$Grid1->getstop();$i++)
			{
				$o=new plugin_planted_cisneros();
				
				$o->cisnerosID=ShowNaPrang::$Grid1->getvalues("cisnerosID",$i);
				
				$o->cartoonpartIDCheck=ShowNaPrang::$Grid1->getvalues("cartoonpartIDCheck",$i);
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
			Refreshs("Plugin_Planted/ShowNaPrang&plantedID=$plantedID","alert","del");
		}
		
}
?>