<?php
require_once("Project/plugins/Plugin_Measure/Dao/Plugin_MeasureDao.php");
require_once("Project/plugins/Plugin_Measure/Common/plugin_measure.php");

class  ShowMeasureUser extends TForm
{
	public static $Grid1;
	function ShowMeasureUser()
	{
		$dao_submodule=new SubModuleDao();
			$o_submodule=$dao_submodule->selectAllBySystem("plugin_measure");

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
			$this->Init("ShowMeasureUser","Plugin_Measure","form-horizontal row-border",true);
				
			
			$alert=$this->getdata("alert");

			if($alert)
			{
				
				$alertmsg=new TLabel();
				$alertmsg->set("alertmsg",alerts($alert),"","",true,"","");
				$this->add($alertmsg);

			}
			
			$form=new TButton();
			$form->set("bn","เพิ่มมาตรการช่วยเหลือ","","",true,"","");
			$form->setEvent("onclick","frmNew");
			$form->setAttribute("class","btn btn-xs btn-primary");
			//$form->setAttribute("data-toggle","modal");
			//$form->setAttribute("href","#myModal1");
			$this->Add($form);


			$bndelgrid=new TButton();
			$bndelgrid->set("bndelgrid"," ลบข้อมูลที่เลือก","","",true,"","");
			$bndelgrid->setEvent_Confirm("onclick","frmDelAll",true,"คุณต้องการลบข้อมูลใช่หรือไม่");
			$bndelgrid->setAttribute("class","btn btn-xs btn-danger");
			$this->Add($bndelgrid);

		
			$dao=new Plugin_MeasureDao();
			$o=$dao->selectAll();
			
			ShowMeasureUser::$Grid1=new TGridview();
			ShowMeasureUser::$Grid1->setview("Grid1",$o);

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
			ShowMeasureUser::$Grid1->addcontrol($grid);
			
			$grid=new TTextBox();
			$grid->set('measureDepartment',"","","",true,"",false);
			$grid->title='หน่วยงาน';
			$grid->setAttribute("class","form-control");
			$grid->setAttribute("placeholder","หน่วยงาน");
			ShowMeasureUser::$Grid1->addcontrol($grid);

			$grid=new TTextarea();
			$grid->set('measureDetail',"","","",true,"",false);
			$grid->title='มาตรการ';
			$grid->setAttribute("class","form-control");
			$grid->setAttribute("placeholder","มาตรการ");
			ShowMeasureUser::$Grid1->addcontrol($grid);

			$grid=new TTextarea();
			$grid->set('measureTarget',"","","",true,"",false);
			$grid->title='เป้าหมาย';
			$grid->setAttribute("class","form-control");
			$grid->setAttribute("placeholder","ปริมาณเป้าหมาย");
			ShowMeasureUser::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set('measureTime',"","","",true,"",false);
			$grid->title='ระยะเวลาดำเนินการ';
			$grid->setAttribute("class","form-control");
			$grid->setAttribute("placeholder","ระยะเวลาดำเนินการ");
			ShowMeasureUser::$Grid1->addcontrol($grid);

			$grid=new TTextBox();
			$grid->set('measureYear',"","","",true,"",false);
			$grid->title='ปีที่มีมาตรการ';
			$grid->setAttribute("class","form-control");
			$grid->setAttribute("placeholder","ปีที่มีมาตรการ");
			ShowMeasureUser::$Grid1->addcontrol($grid);

			ShowMeasureUser::$Grid1->View=false;
			ShowMeasureUser::$Grid1->Edit=true;
			ShowMeasureUser::$Grid1->Delete=true;
			$this->Add(ShowMeasureUser::$Grid1);


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
			ShowMeasureUser::$Grid1->gotopage($v[1]);
			ShowMeasureUser::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowMeasureUser::$Grid1->gotopage($v[1]);
			ShowMeasureUser::$Grid1->changenumpage($v[0]);
		}
		function Grid1_View($parameter,$sender)
		{
			

		}
		function frmNew($parameter,$sender)
		{
			$o=new plugin_measure();

			$o->creationUser=$_SESSION["Session_User_UserID"];
			$o->status="Open";

			$dao=new Plugin_MeasureDao();

			$dao->save($o);
				Refreshs("Plugin_Measure/ShowMeasureUser","alert","save");
		}
		function Grid1_Editing($parameter,$sender)
		{
			$dao=new Plugin_MeasureDao();

			for($i=ShowMeasureUser::$Grid1->getstart();$i<ShowMeasureUser::$Grid1->getstop();$i++)
			{
				$o=new plugin_measure();
				

				$o->measureID=ShowMeasureUser::$Grid1->getvalues("measureID",$i);
				

				$o->measureDepartment=ShowMeasureUser::$Grid1->getvalues("measureDepartment",$i);
				$o->measureDetail=ShowMeasureUser::$Grid1->getvalues("measureDetail",$i);
				$o->measureTarget=ShowMeasureUser::$Grid1->getvalues("measureTarget",$i);
				$o->measureTime=ShowMeasureUser::$Grid1->getvalues("measureTime",$i);
				$o->measureYear=ShowMeasureUser::$Grid1->getvalues("measureYear",$i);

				$o_update=$dao->selectById($o->measureID);
				$o->version=$o_update->version;

				if($o->measureID)
				{
					
					$dao->update($o);
					$o->version="";
					$o->measureID="";
				}

				
				
			}

			Refreshs("Plugin_Measure/ShowMeasureUser","alert","update");

		}
		function Grid1_Deleting($parameter,$sender)
		{
			$o=new plugin_measure();
			$o->measureID=ShowMeasureUser::$Grid1->getvalues("measureID",$parameter);
			$dao=new Plugin_MeasureDao();

			$dao->deletes($o);
			Refreshs("Plugin_Measure/ShowMeasureUser","alert","del");
		}
		
		function frmActionStatus($parameter,$sender)
		{
			$o=new plugin_measure();
			$measureID=ShowMeasureUser::$Grid1->getvalues("measureID",$parameter);
			
			$dao=new Plugin_MeasureDao();
			$o_chk=$dao->selectById($measureID);
			$o->measureID=$o_chk->measureID;
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

			Refreshs("Plugin_Measure/ShowMeasureUser","alert","update");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new Plugin_MeasureDao();

			for($i=ShowMeasureUser::$Grid1->getstart();$i<ShowMeasureUser::$Grid1->getstop();$i++)
			{
				$o=new plugin_measure();
				
				$o->measureID=ShowMeasureUser::$Grid1->getvalues("measureID",$i);
				
				$o->cartoonpartIDCheck=ShowMeasureUser::$Grid1->getvalues("cartoonpartIDCheck",$i);
				if($o->cartoonpartIDCheck)
				{
					if($o->measureID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->measureID="";
					}
				}
				
			}
			
			Refreshs("Plugin_Measure/ShowMeasureUser","alert","del");
		}
		
}
?>