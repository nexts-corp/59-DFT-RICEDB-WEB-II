<?php
require_once("Project/plugins/Plugin_Costs_Rice/Dao/Plugin_Costs_RiceDao.php");
require_once("Project/plugins/Plugin_Costs_Rice/Common/plugin_costs_rice.php");

class  ShowCostsRice extends TForm
{
	public static $Grid1;
	function ShowCostsRice()
	{
		$dao_submodule=new SubModuleDao();
			$o_submodule=$dao_submodule->selectAllBySystem("plugin_costs_rice");

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
			$this->Init("ShowCostsRice","Plugin_Costs_Rice","form-horizontal row-border",true);
				
			
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

				$form=new TTextBox();
				$form->set('costsName',"","","",true,"String",true); 
				$form->setAttribute("class","form-control");
				$form->setAttribute("placeholder","ชนิดข้อมูล");
				$this->add($form);

				$form=new TTextBox();
				$form->set('province',"","","",true,"String",true); 
				$form->setAttribute("class","form-control");
				$form->setAttribute("placeholder","พื้นที่ข้อมูล");
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
		
			$dao=new Plugin_Costs_RiceDao();
			$o=$dao->selectAll();
			
			ShowCostsRice::$Grid1=new TGridtable();
			ShowCostsRice::$Grid1->setgridtable("Grid1",$o);

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
				$o[$i]->adddata="";
				
				$o[$i]->additem="<button class='btn btn-info'>รายการ</button>";
			}

			$grid=new TCheckbox();
			$grid->set('cartoonpartIDCheck',"","","40",ture,'reqstring',false);
			$grid->additem(" ","");
			$grid->title=' ';
			ShowCostsRice::$Grid1->addcontrol($grid);
			
			$grid=new TLabel();
			$grid->set('costsName',"","","",true,"",false);
			$grid->title='ชนิดข้อมูล';
			ShowCostsRice::$Grid1->addcontrol($grid);

			$grid=new TLabel();
			$grid->set('province',"","","",true,"",false);
			$grid->title='พื้นที่ข้อมูล';
			ShowCostsRice::$Grid1->addcontrol($grid);

			$grid=new TGridLink();
			$grid->set('additem',"","","","true","","");
			$grid->title='ข้อมูลรายการ';
			$grid->setEvent("onclick","frmActionItem");
			ShowCostsRice::$Grid1->addcontrol($grid);

			ShowCostsRice::$Grid1->View=false;
			ShowCostsRice::$Grid1->Edit=$o_per[0]->permissEdit;
			ShowCostsRice::$Grid1->Delete=$o_per[0]->permissDel;
			$this->Add(ShowCostsRice::$Grid1);


	 	$this->waitevent();
	}
		function Grid1_rowperpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowCostsRice::$Grid1->gotopage($v[1]);
			ShowCostsRice::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowCostsRice::$Grid1->gotopage($v[1]);
			ShowCostsRice::$Grid1->changenumpage($v[0]);
		}
		function Grid1_View($parameter,$sender)
		{
			
		}
		function frmAction($parameter,$sender)
		{
			$o=new plugin_costs_rice();

			$o->costsID=$sender->getdata('costsID_id');
			$o->version=$sender->getdata('version');
			$o->costsName=$sender->getdata('costsName');
			$o->province=$sender->getdata('province');
			$o->creationUser=$_SESSION["Session_User_UserID"];
			$o->status="Open";
			$dao=new Plugin_Costs_RiceDao();
			
			if($o->costsID)
			{
				$dao->update($o);
				Refreshs("Plugin_Costs_Rice/ShowCostsRice","alert","update");
			}
			else
			{
				$dao->save($o);
				Refreshs("Plugin_Costs_Rice/ShowCostsRice","alert","save");
					
			}
		}
		function Grid1_Editing($parameter,$sender)
		{
			$value[1]=ShowCostsRice::$Grid1->getvalues("costsID",$parameter);

			$dao=new Plugin_Costs_RiceDao();
			$o_update="";
			$o_update=$dao->selectById($value[1]);
			
			$form=new THidden();
			$form->set("costsID_id",$o_update->costsID,"","",true,"String",false); 
			$sender->add($form);

			$form=new THidden();
			$form->set("version",$o_update->version,"","",true,"String",false); 
			$sender->add($form);

			$form=new TTextBox();
			$form->set("costsName",$o_update->costsName,"","",true,"String",true); 
			$form->setAttribute("class","form-control");
			$form->setAttribute("placeholder","ชนิดข้อมูล");
			$sender->add($form);

			$form=new TTextBox();
			$form->set("province",$o_update->province,"","",true,"String",true); 
			$form->setAttribute("class","form-control");
			$form->setAttribute("placeholder","พื้นที่ข้อมูล");
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
			$o=new plugin_costs_rice();
			$o->costsID=ShowCostsRice::$Grid1->getvalues("costsID",$parameter);
			$dao=new Plugin_Costs_RiceDao();

			$dao->deletes($o);
			Refreshs("Plugin_Costs_Rice/ShowCostsRice","alert","del");
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
		function frmActionStatus($parameter,$sender)
		{
			$o=new plugin_costs_rice();
			$costsID=ShowCostsRice::$Grid1->getvalues("costsID",$parameter);
			
			$dao=new Plugin_Costs_RiceDao();
			$o_chk=$dao->selectById($costsID);
			$o->costsID=$o_chk->costsID;
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

			Refreshs("Plugin_Costs_Rice/ShowCostsRice","alert","update");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new Plugin_Costs_RiceDao();

			for($i=ShowCostsRice::$Grid1->getstart();$i<ShowCostsRice::$Grid1->getstop();$i++)
			{
				$o=new plugin_costs_rice();
				
				$o->costsID=ShowCostsRice::$Grid1->getvalues("costsID",$i);
				
				$o->cartoonpartIDCheck=ShowManufacturingWorld::$Grid1->getvalues("cartoonpartIDCheck",$i);
				if($o->cartoonpartIDCheck)
				{
					if($o->costsID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->costsID="";
					}
				}
				
			}
			
			Refreshs("Plugin_Costs_Rice/ShowCostsRice","alert","del");
		}
		function frmActionItem($parameter,$sender)
		{
			$costsID=ShowCostsRice::$Grid1->getvalues("costsID",$parameter);
			fRefresh("","page","Plugin_Costs_Rice/ShowCostsRiceData&costsID=$costsID");

		}
		
		
		
		
}
?>