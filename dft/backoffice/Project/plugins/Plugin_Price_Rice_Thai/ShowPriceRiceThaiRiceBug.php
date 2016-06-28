<?php
require_once("Project/plugins/Plugin_Price_Rice_Thai/Dao/Plugin_Price_Rice_ThaiDao.php");
require_once("Project/plugins/Plugin_Price_Rice_Thai/Common/plugin_price_rice_thai.php");

require_once("Project/plugins/Plugin_Price_Rice_Thai/Dao/Plugin_Price_Rice_Thai_RiceBugDao.php");
require_once("Project/plugins/Plugin_Price_Rice_Thai/Common/plugin_price_rice_thai_ricebug.php");

class  ShowPriceRiceThaiRiceBug extends TForm
{
	public static $Grid1;
	function ShowPriceRiceThaiRiceBug()
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
			$this->Init("ShowPriceRiceThaiRiceBug","Plugin_Price_Rice_Thai","form-horizontal row-border",true);
				
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
				$form->set('ricebugType_box',"","","",true,"String",true); 
				$form->setAttribute("class","form-control");
				$form->setAttribute("placeholder","ชนิดข้าวถุง");
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
		
			
			$dao=new Plugin_Price_Rice_Thai_RiceBugDao();
				$o=$dao->selectAllByThaiID($thaiID);

			ShowPriceRiceThaiRiceBug::$Grid1=new TGridview();
			ShowPriceRiceThaiRiceBug::$Grid1->setview("Grid1",$o);

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
			ShowPriceRiceThaiRiceBug::$Grid1->addcontrol($grid);
			
			$grid=new TLabel();
			$grid->set('riceType',"","","",true,"",false);
			$grid->title='ชนิดข้าวเปลือก';
			ShowPriceRiceThaiRiceBug::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("department1","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='ราคากรมการค้าภายใน';
			ShowPriceRiceThaiRiceBug::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set("department2","","","",true,"",false);
			$grid->setAttribute("class","form-control");
			$grid->title='ราคาสมาคมโรงสีข้าวไทย';
			ShowPriceRiceThaiRiceBug::$Grid1->addcontrol($grid);

			ShowPriceRiceThaiRiceBug::$Grid1->View=false;
			ShowPriceRiceThaiRiceBug::$Grid1->Edit=false;
			ShowPriceRiceThaiRiceBug::$Grid1->Delete=$o_per[0]->permissDel;
			$this->Add(ShowPriceRiceThaiRiceBug::$Grid1);

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
			ShowPriceRiceThaiRiceBug::$Grid1->gotopage($v[1]);
			ShowPriceRiceThaiRiceBug::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowPriceRiceThaiRiceBug::$Grid1->gotopage($v[1]);
			ShowPriceRiceThaiRiceBug::$Grid1->changenumpage($v[0]);
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
			$o=new plugin_price_rice_thai_ricebug();

			//$o->genID=$sender->getdata('genID');
			$o->thaiID=$sender->getdata('thaiID');
			$o->version=$sender->getdata('version');
			$o->ricebugType=$sender->getdata('ricebugType_box');
			$o->ricebugPrice=$sender->getdata('ricebugPrice_box');

			$o->creationUser=$_SESSION["Session_User_UserID"];
			$o->status="Open";
			$dao=new Plugin_Price_Rice_Thai_RiceBugDao();
			
			if($o->genID)
			{

				//$dao->update($o);
				//Refreshs("Plugin_Manufacturing_World/ShowManufacturingWorld","alert","update");
			}
			else
			{

				$o_check_name=$dao->selectAllByThaiIDAndName($o->thaiID,$o->ricebugType);
				if(empty($o_check_name))
					$dao->save($o);

				Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThaiRiceBug&thaiID=$o->thaiID","alert","save");
					
			}
		}
		function Grid1_Editing($parameter,$sender)
		{
			$dao=new Plugin_Price_Rice_Thai_RiceBugDao();

			for($i=ShowPriceRiceThaiRiceBug::$Grid1->getstart();$i<ShowPriceRiceThaiRiceBug::$Grid1->getstop();$i++)
			{
				$o=new plugin_price_rice_thai_ricebug();
				

				$o->ricebugID=ShowPriceRiceThaiRice::$Grid1->getvalues("ricebugID",$i);
				
				$o->ricebugPrice=ShowPriceRiceThaiRice::$Grid1->getvalues("ricebugPrice",$i);

				$o_update=$dao->selectById($o->ricebugID);
				$o->version=$o_update->version;

				if($o->ricebugID and $o->ricebugPrice)
				{
					
					$dao->update($o);
					$o->version="";
					$o->ricebugID="";
				}

				
				
			}
			
			$thaiID=$sender->getdata('thaiID');
			Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThaiRiceBug&thaiID=$thaiID","alert","update");

		}
		function Grid1_Deleting($parameter,$sender)
		{
			$o=new plugin_price_rice_thai_ricebug();
			$o->ricebugID=ShowPriceRiceThaiRiceBug::$Grid1->getvalues("ricebugID",$parameter);
			$dao=new Plugin_Price_Rice_Thai_RiceBugDao();

			$dao->deletes($o);

			$thaiID=$sender->getdata('thaiID');
			Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThaiRiceBug&thaiID=$thaiID","alert","del");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new Plugin_Price_Rice_Thai_RiceBugDao();

			for($i=ShowPriceRiceThaiRiceBug::$Grid1->getstart();$i<ShowPriceRiceThaiRiceBug::$Grid1->getstop();$i++)
			{
				$o=new plugin_price_rice_thai_ricebug();
				
				$o->ricebugID=ShowPriceRiceThaiRiceBug::$Grid1->getvalues("ricebugID",$i);
				
				$o->cartoonpartIDCheck=ShowPriceRiceThaiRiceBug::$Grid1->getvalues("cartoonpartIDCheck",$i);
				if($o->cartoonpartIDCheck)
				{
					if($o->ricebugID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->ricebugID="";
					}
				}
				
			}
			
			$thaiID=$sender->getdata('thaiID');
			Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThaiRiceBug&thaiID=$thaiID","alert","del");
		}
		
		
}
?>