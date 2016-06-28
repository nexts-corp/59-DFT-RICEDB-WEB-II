<?php
require_once("Project/plugins/Plugin_Price_Rice_World/Dao/Plugin_Price_Rice_WorldDao.php");
require_once("Project/plugins/Plugin_Price_Rice_World/Common/plugin_price_rice_world.php");

require_once("Project/plugins/Plugin_Price_Rice_World/Dao/Plugin_Price_Rice_World_FobDao.php");
require_once("Project/plugins/Plugin_Price_Rice_World/Common/plugin_price_rice_world_fob.php");

class  ShowPriceRiceWorldData extends TForm
{
	public static $Grid1;
	function ShowPriceRiceWorldData()
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
			$this->Init("ShowPriceRiceWorldData","Plugin_Price_Rice_World","form-horizontal row-border",true);
				
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
		
			
			$dao=new Plugin_Price_Rice_World_FobDao();
				$o=$dao->selectAllByWorldID($worldID);

			ShowPriceRiceWorldData::$Grid1=new TGridview();
			ShowPriceRiceWorldData::$Grid1->setview("Grid1",$o);

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
			ShowPriceRiceWorldData::$Grid1->addcontrol($grid);
			
			$grid=new TTextBox();
			$grid->set('fobType',"","","",true,"",false);
			$grid->title='ชนิดข้าว';
			$grid->setAttribute("class","form-control");
			ShowPriceRiceWorldData::$Grid1->addcontrol($grid);

			$grid=new TListBox();
			$grid->set('fobCountry',"","","",true,"String",true);
			$grid->setAttribute("class","form-control");
			$grid->additem("เวียดนาม","เวียดนาม");
			$grid->additem("อินเดีย","อินเดีย");
			$grid->additem("สหรัฐ","สหรัฐ");
			$grid->additem("กัมพูชา","กัมพูชา");
			$grid->additem("ปากีสถาน","ปากีสถาน");
			ShowPriceRiceWorldData::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("fobValue","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='ราคา FOB (เหรียญสหรัฐ)';
			ShowPriceRiceWorldData::$Grid1->addcontrol($grid);


			ShowPriceRiceWorldData::$Grid1->View=false;
			ShowPriceRiceWorldData::$Grid1->Edit=false;
			ShowPriceRiceWorldData::$Grid1->Delete=$o_per[0]->permissDel;
			$this->Add(ShowPriceRiceWorldData::$Grid1);

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
			ShowPriceRiceWorldData::$Grid1->gotopage($v[1]);
			ShowPriceRiceWorldData::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowPriceRiceWorldData::$Grid1->gotopage($v[1]);
			ShowPriceRiceWorldData::$Grid1->changenumpage($v[0]);
		}
		function Grid1_View($parameter,$sender)
		{
			
		}
		function frmNew($parameter,$sender)
		{
			$o=new plugin_price_rice_world_fob();
			$o->worldID=$sender->getdata('worldID');
			$o->creationUser=$_SESSION["Session_User_UserID"];
			$o->status="Open";
			$dao=new Plugin_Price_Rice_World_FobDao();
			$dao->save($o);

			Refreshs("Plugin_Price_Rice_World/ShowPriceRiceWorldData&worldID=$o->worldID","alert","save");
		}
		function frmAction($parameter,$sender)
		{
			$o=new plugin_price_rice_world_fob();

			//$o->genID=$sender->getdata('genID');
			$o->worldID=$sender->getdata('worldID');
			$o->version=$sender->getdata('version');
			$o->fobType=$sender->getdata('fobType_box');
			$o->fobCountry=$sender->getdata('fobCountry_box');
			$o->fobValue=$sender->getdata('fobValue_box');

			$o->creationUser=$_SESSION["Session_User_UserID"];
			$o->status="Open";
			$dao=new Plugin_Price_Rice_World_FobDao();
			
			if($o->genID)
			{

				//$dao->update($o);
				//Refreshs("Plugin_Manufacturing_World/ShowManufacturingWorld","alert","update");
			}
			else
			{

				$o_check_name=$dao->selectAllByWorldIDAndName($o->worldID,$o->fobCountry);
				if(empty($o_check_name))
					$dao->save($o);

				Refreshs("Plugin_Price_Rice_World/ShowPriceRiceWorldData&worldID=$o->worldID","alert","save");
					
			}
		}
		function Grid1_Editing($parameter,$sender)
		{
			$dao=new Plugin_Price_Rice_World_FobDao();

			for($i=ShowPriceRiceWorldData::$Grid1->getstart();$i<ShowPriceRiceWorldData::$Grid1->getstop();$i++)
			{
				$o=new plugin_price_rice_world_fob();
				

				$o->fobID=ShowPriceRiceWorldData::$Grid1->getvalues("fobID",$i);
				
				$o->fobType=ShowPriceRiceWorldData::$Grid1->getvalues("fobType",$i);
				$o->fobCountry=ShowPriceRiceWorldData::$Grid1->getvalues("fobCountry",$i);
				$o->fobValue=ShowPriceRiceWorldData::$Grid1->getvalues("fobValue",$i);

				$o_update=$dao->selectById($o->fobID);
				$o->version=$o_update->version;

				if($o->fobID and $o->fobType and $o->fobCountry and $o->fobValue)
				{
					
					$dao->update($o);
					$o->version="";
					$o->fobID="";
				}

				
				
			}
			
			$worldID=$sender->getdata('worldID');
			Refreshs("Plugin_Price_Rice_World/ShowPriceRiceWorldData&worldID=$worldID","alert","update");

		}
		function Grid1_Deleting($parameter,$sender)
		{
			$o=new plugin_price_rice_world_fob();
			$o->fobID=ShowPriceRiceWorldData::$Grid1->getvalues("fobID",$parameter);
			$dao=new Plugin_Price_Rice_World_FobDao();

			$dao->deletes($o);

			$worldID=$sender->getdata('worldID');
			Refreshs("Plugin_Price_Rice_World/ShowPriceRiceWorldData&worldID=$worldID","alert","del");
		}
		
		function frmNewAuto($parameter,$sender)
		{
			$array = array("อื่นๆ","ฟิลิปินส์","เมียนมาร์","ไทย","เวียดนาม","บังคลาเทศ","อินโดนีเซีย","อินเดีย","จีน");
			$worldID=$sender->getdata('worldID');
			$dao=new Plugin_Manufacturing_World_GenDao();
			for($i=0;$i<count($array);$i++)
			{
				$o=new plugin_manufacturing_world_gen();

				$o->worldID=$worldID;
				$o->country=$array[$i];
				$o->creationUser=$_SESSION["Session_User_UserID"];
				$o->status="Open";

				$o_check_name=$dao->selectAllByWorldIDAndName($worldID,$o->country);
				if(empty($o_check_name))
					$dao->save($o);

			}
			Refreshs("Plugin_Manufacturing_World/ShowGenerate&worldID=$worldID","alert","save");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new Plugin_Price_Rice_World_FobDao();

			for($i=ShowPriceRiceWorldData::$Grid1->getstart();$i<ShowPriceRiceWorldData::$Grid1->getstop();$i++)
			{
				$o=new plugin_price_rice_world_fob();
				
				$o->fobID=ShowPriceRiceWorldData::$Grid1->getvalues("fobID",$i);
				
				$o->cartoonpartIDCheck=ShowPriceRiceWorldData::$Grid1->getvalues("cartoonpartIDCheck",$i);
				if($o->cartoonpartIDCheck)
				{
					if($o->fobID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->fobID="";
					}
				}
				
			}
			
			$worldID=$sender->getdata('worldID');
			Refreshs("Plugin_Price_Rice_World/ShowPriceRiceWorldData&worldID=$worldID","alert","del");
		}
		
		
}
?>