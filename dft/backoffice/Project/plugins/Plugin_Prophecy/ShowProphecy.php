<?php
require_once("Project/plugins/Plugin_Prophecy/Dao/Plugin_ProphecyDao.php");
require_once("Project/plugins/Plugin_Prophecy/Common/plugin_prophecy.php");

class  ShowProphecy extends TForm
{
	public static $Grid1;
	function ShowProphecy()
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
			$this->Init("ShowProphecy","Plugin_Prophecy","",true);
				
			
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
				$form->set('prophecyYear',"","","",true,"String",true); 
				$form->setAttribute("class","form-control");
				$form->setAttribute("placeholder","ข้อมูล ณ วันที่");
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
		
			$dao=new Plugin_ProphecyDao();
			$o=$dao->selectAll();
			
			ShowProphecy::$Grid1=new TGridtable();
			ShowProphecy::$Grid1->setgridtable("Grid1",$o);

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

				$o[$i]->Cisneros="<button class='btn btn-info'>ข้อมูลนาปี / นาปรัง</button>";

				//$o[$i]->NaPrang="<button class='btn btn-info'>นาปรัง</button>";
			}

			$grid=new TCheckbox();
			$grid->set('cartoonpartIDCheck',"","","40",ture,'reqstring',false);
			$grid->additem(" ","");
			$grid->title=' ';
			ShowProphecy::$Grid1->addcontrol($grid);
			
			$grid=new TLabel();
			$grid->set('prophecyYear',"","","",true,"",false);
			$grid->title='ข้อมูล ณ วันที่';
			ShowProphecy::$Grid1->addcontrol($grid);

			$grid=new TGridLink();
			$grid->set('Cisneros',"","","","true","","");
			$grid->title='นาปี/นาปรัง';
			$grid->setEvent("onclick","frmActionCisneros");
			ShowProphecy::$Grid1->addcontrol($grid);

			$status=new TGridLink();
			$status->set('status',$o->status,"","","true","","");
			$status->title='เปิด / ปิด';
			$status->setEvent("onclick","frmActionStatus");
			ShowProphecy::$Grid1->addcontrol($status);

			ShowProphecy::$Grid1->View=false;
			ShowProphecy::$Grid1->Edit=$o_per[0]->permissEdit;
			ShowProphecy::$Grid1->Delete=$o_per[0]->permissDel;
			$this->Add(ShowProphecy::$Grid1);


	 	$this->waitevent();
	}
		function Grid1_rowperpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowProphecy::$Grid1->gotopage($v[1]);
			ShowProphecy::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowProphecy::$Grid1->gotopage($v[1]);
			ShowProphecy::$Grid1->changenumpage($v[0]);
		}
		function Grid1_View($parameter,$sender)
		{
			
		}
		function frmAction($parameter,$sender)
		{
			$o=new plugin_prophecy();

			$o->prophecyID=$sender->getdata('prophecyID_id');
			$o->version=$sender->getdata('version');
			$o->prophecyYear=$sender->getdata('prophecyYear');
			
			$o->creationUser=$_SESSION["Session_User_UserID"];
			$o->status="Open";
			$dao=new Plugin_ProphecyDao();
			
			if($o->prophecyID)
			{
				$dao->update($o);
				Refreshs("Plugin_Prophecy/ShowProphecy","alert","update");
			}
			else
			{
				$dao->save($o);
				Refreshs("Plugin_Prophecy/ShowProphecy","alert","save");
					
			}
		}
		function Grid1_Editing($parameter,$sender)
		{
			$value[1]=ShowProphecy::$Grid1->getvalues("prophecyID",$parameter);

			$dao=new Plugin_ProphecyDao();
			$o_update="";
			$o_update=$dao->selectById($value[1]);
			
			$form=new THidden();
			$form->set("prophecyID_id",$o_update->prophecyID,"","",true,"String",false); 
			$sender->add($form);

			$form=new THidden();
			$form->set("version",$o_update->version,"","",true,"String",false); 
			$sender->add($form);

			$form=new TTextBox();
			$form->set("prophecyYear",$o_update->prophecyYear,"","",true,"String",true); 
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
			$o=new plugin_prophecy();
			$o->prophecyID=ShowProphecy::$Grid1->getvalues("prophecyID",$parameter);
			$dao=new Plugin_ProphecyDao();

			$dao->deletes($o);
			Refreshs("Plugin_Prophecy/ShowProphecy","alert","del");
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
			$o=new plugin_prophecy();
			$prophecyID=ShowProphecy::$Grid1->getvalues("prophecyID",$parameter);
			
			$dao=new Plugin_ProphecyDao();
			$o_chk=$dao->selectById($prophecyID);
			$o->prophecyID=$o_chk->prophecyID;
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

			Refreshs("Plugin_Prophecy/ShowProphecy","alert","update");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new Plugin_ProphecyDao();

			for($i=ShowProphecy::$Grid1->getstart();$i<ShowProphecy::$Grid1->getstop();$i++)
			{
				$o=new plugin_prophecy();
				
				$o->prophecyID=ShowProphecy::$Grid1->getvalues("prophecyID",$i);
				
				$o->cartoonpartIDCheck=ShowProphecy::$Grid1->getvalues("cartoonpartIDCheck",$i);
				if($o->cartoonpartIDCheck)
				{
					if($o->prophecyID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->prophecyID="";
					}
				}
				
			}
			
			Refreshs("Plugin_Planted/ShowPlanted","alert","del");
		}
		function frmActionCisneros($parameter,$sender)
		{
			$prophecyID=ShowProphecy::$Grid1->getvalues("prophecyID",$parameter);
			fRefresh("","page","Plugin_Prophecy/ShowCisneros&prophecyID=$prophecyID");

		}
		function frmActionNaPrang($parameter,$sender)
		{
			$prophecyID=ShowPlanted::$Grid1->getvalues("prophecyID",$parameter);
			fRefresh("","page","Plugin_Prophecy/ShowNaPrang&prophecyID=$prophecyID");

		}
		
		
		
		
}
?>