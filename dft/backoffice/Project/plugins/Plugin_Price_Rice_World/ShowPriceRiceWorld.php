<?php
require_once("Project/plugins/Plugin_Price_Rice_World/Dao/Plugin_Price_Rice_WorldDao.php");
require_once("Project/plugins/Plugin_Price_Rice_World/Common/plugin_price_rice_world.php");

class  ShowPriceRiceWorld extends TForm
{
	public static $Grid1;
	public static $Grid2;
	function ShowPriceRiceWorld()
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
			$this->Init("ShowPriceRiceWorld","Plugin_Price_Rice_World","",true);
				
			
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
				$form->set("bn","เพิ่มข้อมูล ต่างประเทศ","","",true,"","");
				$form->setEvent("onclick","frmNew");
				$form->setAttribute("class","btn btn-xs btn-primary");
				$this->Add($form);

				$form=new TButton();
				$form->set("bn1","เพิ่มข้อมูล สภาหอการค้า","","",true,"","");
				$form->setEvent("onclick","frmNew1");
				$form->setAttribute("class","btn btn-xs btn-primary");
				$this->Add($form);

				$form=new TTextBox();
				$form->set('worldData',"","","",true,"String",false); 
				$form->setAttribute("class","form-control");
				$form->setAttribute("placeholder","ข้อมูล ณ วันที่");
				$this->add($form);

				$form=new TTextBox();
				$form->set('worldData1',"","","",true,"String",false); 
				$form->setAttribute("class","form-control");
				$form->setAttribute("placeholder","ข้อมูล ณ วันที่");
				$this->add($form);

				$form=new TButton();
				$form->set("bnsave","บันทึกข้อมูล","","",true,"String",false);
				$form->setEvent("onclick","frmAction");
				$form->setAttribute("class","btn btn-primary");
				$this->Add($form);

				$form=new TButton();
				$form->set("bnsave1","บันทึกข้อมูล","","",true,"String",false);
				$form->setEvent("onclick","frmAction1");
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
		
			$dao=new Plugin_Price_Rice_WorldDao();
			$o=$dao->selectAllByDataType("1");
			
			ShowPriceRiceWorld::$Grid1=new TGridtable();
			ShowPriceRiceWorld::$Grid1->setgridtable("Grid1",$o);

			for($i=0;$i<count($o);$i++)
			{
				$o[$i]->adddata="";
				
				$o[$i]->worlddata="<button class='btn btn-info'>ข้อมูลต่างประเทศ</button>";
			}
			
			$grid=new TLabel();
			$grid->set('worldData',"","","",true,"",false);
			$grid->title='ข้อมูล ณ วันที่';
			ShowPriceRiceWorld::$Grid1->addcontrol($grid);

			$grid=new TGridLink();
			$grid->set('worlddata',"","","","true","","");
			$grid->title='ข้อมูลต่างประเทศ';
			$grid->setEvent("onclick","frmActionWorldData");
			ShowPriceRiceWorld::$Grid1->addcontrol($grid);

			ShowPriceRiceWorld::$Grid1->View=false;
			ShowPriceRiceWorld::$Grid1->Edit=false;
			ShowPriceRiceWorld::$Grid1->Delete=$o_per[0]->permissDel;
			$this->Add(ShowPriceRiceWorld::$Grid1);


			$o2=$dao->selectAllByDataType("2");

			ShowPriceRiceWorld::$Grid2=new TGridtable();
			ShowPriceRiceWorld::$Grid2->setgridtable("Grid2",$o2);
			for($i=0;$i<count($o2);$i++)
			{
				$o2[$i]->chamber="<button class='btn btn-info'>สภาหอการค้า</button>";
			}
			
			$grid=new TLabel();
			$grid->set('worldData',"","","",true,"",false);
			$grid->title='ข้อมูล ณ วันที่';
			ShowPriceRiceWorld::$Grid2->addcontrol($grid);

			$grid=new TGridLink();
			$grid->set('chamber',"","","","true","","");
			$grid->title='สภาหอการค้า';
			$grid->setEvent("onclick","frmActionChamber");
			ShowPriceRiceWorld::$Grid2->addcontrol($grid);

			ShowPriceRiceWorld::$Grid2->View=false;
			ShowPriceRiceWorld::$Grid2->Edit=false;
			ShowPriceRiceWorld::$Grid2->Delete=$o_per[0]->permissDel;
			$this->Add(ShowPriceRiceWorld::$Grid2);


	 	$this->waitevent();
	}
		function Grid1_rowperpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowPriceRiceWorld::$Grid1->gotopage($v[1]);
			ShowPriceRiceWorld::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowPriceRiceWorld::$Grid1->gotopage($v[1]);
			ShowPriceRiceWorld::$Grid1->changenumpage($v[0]);
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
		function frmNew1($parameter,$sender)
		{
			$form=new TLabel();
			$form->set('labelModal',"
			<script>

				$( document ).ready(function() {
				    $('#myModal2').modal('show');
				});
			</script>
			",30,30,true,"String",false); 
			$sender->add($form);
		}
		function frmAction($parameter,$sender)
		{
			$o=new plugin_price_rice_world();

			$o->worldID=$sender->getdata('worldID_id');
			$o->version=$sender->getdata('version');
			$o->worldData=$sender->getdata('worldData');
			$o->dataType="1";

			$o->creationUser=$_SESSION["Session_User_UserID"];
			$o->status="Open";
			$dao=new Plugin_Price_Rice_WorldDao();
			
			if($o->worldID)
			{
				$dao->update($o);
				Refreshs("Plugin_Price_Rice_World/ShowPriceRiceWorld","alert","update");
			}
			else
			{
				$dao->save($o);
				Refreshs("Plugin_Price_Rice_World/ShowPriceRiceWorld","alert","save");
					
			}
		}
		function frmAction1($parameter,$sender)
		{
			$o=new plugin_price_rice_world();

			$o->worldID=$sender->getdata('worldID_id');
			$o->version=$sender->getdata('version');
			$o->worldData=$sender->getdata('worldData1');
			$o->dataType="2";

			$o->creationUser=$_SESSION["Session_User_UserID"];
			$o->status="Open";
			$dao=new Plugin_Price_Rice_WorldDao();
			
			if($o->worldID)
			{
				$dao->update($o);
				Refreshs("Plugin_Price_Rice_World/ShowPriceRiceWorld","alert","update");
			}
			else
			{
				$dao->save($o);
				Refreshs("Plugin_Price_Rice_World/ShowPriceRiceWorld","alert","save");
					
			}
		}
		function Grid1_Editing($parameter,$sender)
		{
			$value[1]=ShowPriceRiceWorld::$Grid1->getvalues("worldID",$parameter);

			$dao=new Plugin_Price_Rice_WorldDao();
			$o_update="";
			$o_update=$dao->selectById($value[1]);
			
			$form=new THidden();
			$form->set("worldID_id",$o_update->worldID,"","",true,"String",false); 
			$sender->add($form);

			$form=new THidden();
			$form->set("version",$o_update->version,"","",true,"String",false); 
			$sender->add($form);

			$form=new TTextBox();
			$form->set("worldData",$o_update->worldData,"","",true,"String",true); 
			$form->setAttribute("class","form-control");
			$form->setAttribute("placeholder","ข้อมูล ณ วันที่");
			$sender->add($form);

			$form=new TLabel();
			$form->set('labelModal',"
			<script>

				$( document ).ready(function() {
				    $('#myModal1').modal('show');
				});
			</script>
			",30,30,true,"String",false); 
			$sender->add($form);
			//Refreshs("Plugin_New_Type/frmNewType","object_id",$value[1]);
		}
		function Grid1_Deleting($parameter,$sender)
		{
			$o=new plugin_price_rice_world();
			$o->worldID=ShowPriceRiceWorld::$Grid1->getvalues("worldID",$parameter);
			$dao=new Plugin_Price_Rice_WorldDao();

			$dao->deletes($o);
			Refreshs("Plugin_Price_Rice_World/ShowPriceRiceWorld","alert","del");
		}
		function frmActionStatus($parameter,$sender)
		{
			$o=new plugin_price_rice_world();
			$worldID=ShowPriceRiceWorld::$Grid1->getvalues("worldID",$parameter);
			
			$dao=new Plugin_Price_Rice_WorldDao();
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

			Refreshs("Plugin_Price_Rice_World/ShowPriceRiceWorld","alert","update");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new Plugin_Price_Rice_WorldDao();

			for($i=ShowPriceRiceWorld::$Grid1->getstart();$i<ShowPriceRiceWorld::$Grid1->getstop();$i++)
			{
				$o=new plugin_price_rice_world();
				
				$o->worldID=ShowPriceRiceWorld::$Grid1->getvalues("worldID",$i);
				
				$o->cartoonpartIDCheck=ShowPriceRiceWorld::$Grid1->getvalues("cartoonpartIDCheck",$i);
				if($o->cartoonpartIDCheck)
				{
					if($o->worldID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->worldID="";
					}
				}
				
			}
			
			Refreshs("Plugin_Price_Rice_World/ShowPriceRiceWorld","alert","del");
		}
		function frmActionWorldData($parameter,$sender)
		{
			$worldID=ShowPriceRiceWorld::$Grid1->getvalues("worldID",$parameter);
			fRefresh("","page","Plugin_Price_Rice_World/ShowPriceRiceWorldData&worldID=$worldID");

		}
		function frmActionChamber($parameter,$sender)
		{
			$worldID=ShowPriceRiceWorld::$Grid1->getvalues("worldID",$parameter);
			fRefresh("","page","Plugin_Price_Rice_World/ShowPriceRiceWorldChamber&worldID=$worldID");

		}
		
		
		
		
}
?>