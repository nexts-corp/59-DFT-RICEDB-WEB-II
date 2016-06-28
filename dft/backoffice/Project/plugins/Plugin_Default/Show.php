<?php
require_once("Project/plugins/Plugin_/Dao/Plugin_Dao.php");
require_once("Project/plugins/Plugin_/Common/plugin_.php");

class  FileDefault extends TForm
{
	public static $Grid1;
	function FileDefault()
	{
		$dao_submodule=new SubModuleDao();
			$o_submodule=$dao_submodule->selectAllBySystem("plugin_system");

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
			$this->Init("FileDefault","Plugin_Folder","",true);
				
			
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
				$form->set('worldYear',"","","",true,"String",true); 
				$form->setAttribute("class","form-control");
				$form->setAttribute("placeholder","ปีที่ลงข้อมูล");
				$this->add($form);

				$form=new TButton();
				$form->set("bnsave","บันทึกข้อมูล","","",true,"String",true);
				$form->setEvent("onclick","frmAction");
				$form->setAttribute("class","btn btn-primary");
				$this->Add($form);
			}
			
			if($o_per[0]->permissDel=="true")
			{
				$form=new TButton();
				$form->set("bndelgrid"," ลบข้อมูล","","",true,"","");
				$form->setEvent_Confirm("onclick","frmDelAll",true,"คุณต้องการลบข้อมูลใช่หรือไม่");
				$form->setAttribute("class","btn btn-xs btn-danger");
				$this->Add($form);
			}
		
			$dao=new Plugin_Dao();
			$o=$dao->selectAll();
			
			FileDefault::$Grid1=new TGridtable();
			FileDefault::$Grid1->setgridtable("Grid1",$o);

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
				
				
			}

			$grid=new TCheckbox();
			$grid->set('cartoonpartIDCheck',"","","40",ture,'reqstring',false);
			$grid->additem(" ","");
			$grid->title=' ';
			FileDefault::$Grid1->addcontrol($grid);
			
			$grid=new TLabel();
			$grid->set('worldYear',"","","",true,"",false);
			$grid->title='ปีที่ลงข้อมูล';
			FileDefault::$Grid1->addcontrol($grid);

			$grid=new TGridLink();
			$grid->set('status',"","","","true","","");
			$grid->title='เปิด / ปิด';
			$grid->setEvent("onclick","frmActionStatus");
			FileDefault::$Grid1->addcontrol($grid);

			FileDefault::$Grid1->View=false;
			FileDefault::$Grid1->Edit=$o_per[0]->permissEdit;
			FileDefault::$Grid1->Delete=$o_per[0]->permissDel;
			$this->Add(FileDefault::$Grid1);


	 	$this->waitevent();
	}
	
	function Grid1_rowperpage($parameter,$sender)
	{
		$v=explode(",",$parameter);
		FileDefault::$Grid1->gotopage($v[1]);
		FileDefault::$Grid1->changenumpage($v[0]);
	}
	function Grid1_nextpage($parameter,$sender)
	{
		$v=explode(",",$parameter);
		FileDefault::$Grid1->gotopage($v[1]);
		FileDefault::$Grid1->changenumpage($v[0]);
	}
	function Grid1_View($parameter,$sender)
	{
		
	}
	function Grid1_Editing($parameter,$sender)
	{
		$objectID=FileDefault::$Grid1->getvalues("objectID",$parameter);

		$dao=new Plugin_Dao();
		$o_update="";
		$o_update=$dao->selectById($objectID);
		
		$form=new THidden();
		$form->set("_id",$o_update->,"","",true,"String",false); 
		$sender->add($form);

		$form=new THidden();
		$form->set("version",$o_update->,"","",true,"String",false); 
		$sender->add($form);

		$form=new TTextBox();
		$form->set("",$o_update->,"","",true,"String",true); 
		$form->setAttribute("class","form-control");
		$form->setAttribute("placeholder","Title");
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
	}
	function Grid1_Deleting($parameter,$sender)
	{
		$o=new plugin_common();
		$o->objectID=FileDefault::$Grid1->getvalues("objectID",$parameter);
		$dao=new Plugin_Dao();

		$dao->deletes($o);
		Refreshs("Plugin_Refreshs","alert","del");
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
		$o=new plugin_common();

		$o->objectID=$sender->getdata('objectID');
		$o->version=$sender->getdata('version');
		$o->worldYear=$sender->getdata('worldYear');
		$o->creationUser=$_SESSION["Session_User_UserID"];
		$o->status="Open";
		$dao=new Plugin_Dao();
		
		if($o->objectID)
		{
			$dao->update($o);
			Refreshs("Plugin_Refreshs","alert","update");
		}
		else
		{
			$dao->save($o);
			Refreshs("Plugin_Refreshs","alert","save");
				
		}
	}
	function frmActionStatus($parameter,$sender)
	{
		$o=new plugin_common();
		$objectID=FileDefault::$Grid1->getvalues("objectID",$parameter);
		
		$dao=new Plugin_Dao();
		$o_chk=$dao->selectById($objectID);
		$o->objectID=$o_chk->objectID;
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

		Refreshs("Plugin_Refreshs","alert","update");
	}
	function frmDelAll($parameter,$sender)
	{
		$dao=new Plugin_Dao();

		for($i=FileDefault::$Grid1->getstart();$i<FileDefault::$Grid1->getstop();$i++)
		{
			$o=new plugin_common();
			
			$o->objectID=FileDefault::$Grid1->getvalues("objectID",$i);
			
			$o->cartoonpartIDCheck=FileDefault::$Grid1->getvalues("cartoonpartIDCheck",$i);
			if($o->cartoonpartIDCheck)
			{
				if($o->objectID)
				{
					$dao->deletes($o);
					$o->version="";
					$o->objectID="";
				}
			}
			
		}
		
		Refreshs("Plugin_Refreshs","alert","del");
	}
		
}
?>