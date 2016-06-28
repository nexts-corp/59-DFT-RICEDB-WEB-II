<?php
require_once("Project/plugins/Plugin_GtoG/Dao/Plugin_GtoGDao.php");
require_once("Project/plugins/Plugin_GtoG/Common/plugin_gtog.php");

class  ShowGtoG extends TForm
{
	public static $Grid1;
	function ShowGtoG()
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
			$this->Init("ShowGtoG","Plugin_GtoG","",true);
				
			
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
				$form->set('gtogDate',"","","",true,"String",true); 
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
		
			$dao=new Plugin_GtoGDao();
			$o=$dao->selectAll();
			
			ShowGtoG::$Grid1=new TGridtable();
			ShowGtoG::$Grid1->setgridtable("Grid1",$o);

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

				$o[$i]->bulogdata="<button class='btn btn-info'>ขายให้ BULOG</button>";
				$o[$i]->cofcodata="<button class='btn btn-info'>ขายให้ COFCO</button>";
				$o[$i]->nfadata="<button class='btn btn-info'>ขายให้ NFA</button>";
			}

			$grid=new TCheckbox();
			$grid->set('cartoonpartIDCheck',"","","40",ture,'reqstring',false);
			$grid->additem(" ","");
			$grid->title=' ';
			ShowGtoG::$Grid1->addcontrol($grid);
			
			$grid=new TLabel();
			$grid->set('gtogDate',"","","",true,"",false);
			$grid->title='ข้อมูล ณ วันที่';
			ShowGtoG::$Grid1->addcontrol($grid);

			$grid=new TGridLink();
			$grid->set('bulogdata',"","","","true","","");
			$grid->title='ขายให้ BULOG';
			$grid->setEvent("onclick","frmActionBulogdata");
			ShowGtoG::$Grid1->addcontrol($grid);

			$grid=new TGridLink();
			$grid->set('cofcodata',"","","","true","","");
			$grid->title='ขายให้ COFCO';
			$grid->setEvent("onclick","frmActionCofcodata");
			ShowGtoG::$Grid1->addcontrol($grid);

			$grid=new TGridLink();
			$grid->set('nfadata',"","","","true","","");
			$grid->title='ขายให้ NFA';
			$grid->setEvent("onclick","frmActionNfadata");
			ShowGtoG::$Grid1->addcontrol($grid);

			ShowGtoG::$Grid1->View=false;
			ShowGtoG::$Grid1->Edit=$o_per[0]->permissEdit;
			ShowGtoG::$Grid1->Delete=$o_per[0]->permissDel;
			$this->Add(ShowGtoG::$Grid1);


	 	$this->waitevent();
	}
		function Grid1_rowperpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowGtoG::$Grid1->gotopage($v[1]);
			ShowGtoG::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowGtoG::$Grid1->gotopage($v[1]);
			ShowGtoG::$Grid1->changenumpage($v[0]);
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
			$o=new plugin_gtog();

			$o->gtogID=$sender->getdata('gtogID_id');
			$o->version=$sender->getdata('version');
			$o->gtogDate=$sender->getdata('gtogDate');
			$o->creationUser=$_SESSION["Session_User_UserID"];
			$o->status="Open";
			$dao=new Plugin_GtoGDao();
			
			if($o->gtogID)
			{
				$dao->update($o);
				Refreshs("Plugin_GtoG/ShowGtoG","alert","update");
			}
			else
			{
				$dao->save($o);
				Refreshs("Plugin_GtoG/ShowGtoG","alert","save");
					
			}
		}
		function Grid1_Editing($parameter,$sender)
		{
			$value[1]=ShowGtoG::$Grid1->getvalues("gtogID",$parameter);

			$dao=new Plugin_GtoGDao();
			$o_update="";
			$o_update=$dao->selectById($value[1]);
			
			$form=new THidden();
			$form->set("gtogID_id",$o_update->gtogID,"","",true,"String",false); 
			$sender->add($form);

			$form=new THidden();
			$form->set("version",$o_update->version,"","",true,"String",false); 
			$sender->add($form);

			$form=new TTextBox();
			$form->set("gtogDate",$o_update->gtogDate,"","",true,"String",true); 
			$form->setAttribute("class","form-control");
			$form->setAttribute("placeholder","ณ วันที่ลงข้อมูล");
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
			$o=new plugin_gtog();
			$o->gtogID=ShowGtoG::$Grid1->getvalues("gtogID",$parameter);
			$dao=new Plugin_GtoGDao();

			$dao->deletes($o);
			Refreshs("Plugin_GtoG/ShowGtoG","alert","del");
		}
		function frmActionStatus($parameter,$sender)
		{
			$o=new plugin_gtog();
			$gtogID=ShowGtoG::$Grid1->getvalues("gtogID",$parameter);
			
			$dao=new Plugin_GtoGDao();
			$o_chk=$dao->selectById($gtogID);
			$o->gtogID=$o_chk->gtogID;
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

			Refreshs("Plugin_GtoG/ShowGtoG","alert","update");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new Plugin_GtoGDao();

			for($i=ShowGtoG::$Grid1->getstart();$i<ShowGtoG::$Grid1->getstop();$i++)
			{
				$o=new plugin_gtog();
				
				$o->gtogID=ShowGtoG::$Grid1->getvalues("gtogID",$i);
				
				$o->cartoonpartIDCheck=ShowGtoG::$Grid1->getvalues("cartoonpartIDCheck",$i);
				if($o->cartoonpartIDCheck)
				{
					if($o->gtogID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->gtogID="";
					}
				}
				
			}
			
			Refreshs("Plugin_GtoG/ShowGtoG","alert","del");
		}
		function frmActionBulogdata($parameter,$sender)
		{
			$gtogID=ShowGtoG::$Grid1->getvalues("gtogID",$parameter);
			fRefresh("","page","Plugin_GtoG/ShowGtoGData&gtogID=$gtogID&gtogType=BULOG");

		}
		function frmActionCofcodata($parameter,$sender)
		{
			$gtogID=ShowGtoG::$Grid1->getvalues("gtogID",$parameter);
			fRefresh("","page","Plugin_GtoG/ShowGtoGData&gtogID=$gtogID&gtogType=COFCO");

		}
		function frmActionNfadata($parameter,$sender)
		{
			$gtogID=ShowGtoG::$Grid1->getvalues("gtogID",$parameter);
			fRefresh("","page","Plugin_GtoG/ShowGtoGData&gtogID=$gtogID&gtogType=NFA");

		}
		
		
		
		
		
}
?>