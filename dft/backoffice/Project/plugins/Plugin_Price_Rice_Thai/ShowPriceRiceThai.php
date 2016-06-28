<?php
require_once("Project/plugins/Plugin_Price_Rice_Thai/Dao/Plugin_Price_Rice_ThaiDao.php");
require_once("Project/plugins/Plugin_Price_Rice_Thai/Common/plugin_price_rice_thai.php");

class  ShowPriceRiceThai extends TForm
{
	public static $Grid1;
	public static $Grid2;
	public static $Grid3;
	public static $Grid4;
	public static $Grid5;
	public static $Grid6;
	public static $Grid7;
	public static $Grid8;
	public static $Grid9;
	function ShowPriceRiceThai()
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
			$this->Init("ShowPriceRiceThai","Plugin_Price_Rice_Thai","",true);
				
			
			$alert=$this->getdata("alert");

			if($alert)
			{
				
				$alertmsg=new TLabel();
				$alertmsg->set("alertmsg",alerts($alert),"","",true,"","");
				$this->add($alertmsg);

			}
			
			if($o_per[0]->permissAdd=="true")
			{
				$form=new TTextBox();
				$form->set('thaiDate',"","","",true,"String",true); 
				$form->setAttribute("class","form-control");
				$form->setAttribute("placeholder","ข้อมูล ณ วันที่");
				$this->add($form);

				$form=new TButton();
				$form->set("bn1"," เพิ่มข้อมูลใหม่","","",true,"","");
				$form->setEvent("onclick","frmNew1");
				$form->setAttribute("class","btn btn-primary pull-right");
				$this->Add($form);

				$form=new TButton();
				$form->set("bnsave1","บันทึกข้อมูล","","",true,"String",true);
				$form->setEvent("onclick","frmAction1");
				$form->setAttribute("class","btn btn-primary");
				$this->Add($form);

				$form=new TButton();
				$form->set("bn2"," เพิ่มข้อมูลใหม่","","",true,"","");
				$form->setEvent("onclick","frmNew2");
				$form->setAttribute("class","btn btn-primary pull-right");
				$this->Add($form);

				$form=new TButton();
				$form->set("bnsave2","บันทึกข้อมูล","","",true,"String",true);
				$form->setEvent("onclick","frmAction2");
				$form->setAttribute("class","btn btn-primary");
				$this->Add($form);

				$form=new TButton();
				$form->set("bn3"," เพิ่มข้อมูลใหม่","","",true,"","");
				$form->setEvent("onclick","frmNew3");
				$form->setAttribute("class","btn btn-primary pull-right");
				$this->Add($form);

				$form=new TButton();
				$form->set("bnsave3","บันทึกข้อมูล","","",true,"String",true);
				$form->setEvent("onclick","frmAction3");
				$form->setAttribute("class","btn btn-primary");
				$this->Add($form);

				$form=new TButton();
				$form->set("bn4"," เพิ่มข้อมูลใหม่","","",true,"","");
				$form->setEvent("onclick","frmNew4");
				$form->setAttribute("class","btn btn-primary pull-right");
				$this->Add($form);

				$form=new TButton();
				$form->set("bnsave","บันทึกข้อมูล","","",true,"String",true);
				$form->setEvent("onclick","frmAction4");
				$form->setAttribute("class","btn btn-primary");
				$this->Add($form);

				$form=new TButton();
				$form->set("bn5"," เพิ่มข้อมูลใหม่","","",true,"","");
				$form->setEvent("onclick","frmNew5");
				$form->setAttribute("class","btn btn-primary pull-right");
				$this->Add($form);

				$form=new TButton();
				$form->set("bnsave","บันทึกข้อมูล","","",true,"String",true);
				$form->setEvent("onclick","frmAction5");
				$form->setAttribute("class","btn btn-primary");
				$this->Add($form);

				$form=new TButton();
				$form->set("bn6"," เพิ่มข้อมูลใหม่","","",true,"","");
				$form->setEvent("onclick","frmNew6");
				$form->setAttribute("class","btn btn-primary pull-right");
				$this->Add($form);

				$form=new TButton();
				$form->set("bnsave","บันทึกข้อมูล","","",true,"String",true);
				$form->setEvent("onclick","frmAction6");
				$form->setAttribute("class","btn btn-primary");
				$this->Add($form);

				$form=new TButton();
				$form->set("bn7"," เพิ่มข้อมูลใหม่","","",true,"","");
				$form->setEvent("onclick","frmNew7");
				$form->setAttribute("class","btn btn-primary pull-right");
				$this->Add($form);

				$form=new TButton();
				$form->set("bnsave","บันทึกข้อมูล","","",true,"String",true);
				$form->setEvent("onclick","frmAction7");
				$form->setAttribute("class","btn btn-primary");
				$this->Add($form);

				$form=new TButton();
				$form->set("bn8"," เพิ่มข้อมูลใหม่","","",true,"","");
				$form->setEvent("onclick","frmNew8");
				$form->setAttribute("class","btn btn-primary pull-right");
				$this->Add($form);

				$form=new TButton();
				$form->set("bnsave","บันทึกข้อมูล","","",true,"String",true);
				$form->setEvent("onclick","frmAction8");
				$form->setAttribute("class","btn btn-primary");
				$this->Add($form);

				$form=new TButton();
				$form->set("bn9"," เพิ่มข้อมูลใหม่","","",true,"","");
				$form->setEvent("onclick","frmNew9");
				$form->setAttribute("class","btn btn-primary pull-right");
				$this->Add($form);

				$form=new TButton();
				$form->set("bnsave","บันทึกข้อมูล","","",true,"String",true);
				$form->setEvent("onclick","frmAction9");
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
		
			$dao=new Plugin_Price_Rice_ThaiDao();
			$o1=$dao->selectAllByType("1");
			
			ShowPriceRiceThai::$Grid1=new TGridtable();
			ShowPriceRiceThai::$Grid1->setgridtable("Grid1",$o1);
			for($i=0;$i<count($o1);$i++)
			{
				$o1[$i]->paddydata1="<a href='?page=Plugin_Price_Rice_Thai/ShowPriceRiceThaiPaddy1&thaiID=".$o1[$i]->thaiID."'>ข้าวเปลือกภูมิภาค</a>";
			}
			$grid=new TCheckbox();
			$grid->set('cartoonpartIDCheck',"","","40",ture,'reqstring',false);
			$grid->additem(" ","");
			$grid->title=' ';
			ShowPriceRiceThai::$Grid1->addcontrol($grid);
			
			$grid=new TLabel();
			$grid->set('thaiDate',"","","",true,"",false);
			$grid->title='ข้อมูล ณ วันที่';
			ShowPriceRiceThai::$Grid1->addcontrol($grid);

			$grid=new TLabel();
			$grid->set('paddydata1',"","","","true","","");
			$grid->title='ราคาข้าวเปลือก';
			ShowPriceRiceThai::$Grid1->addcontrol($grid);

			ShowPriceRiceThai::$Grid1->View=false;
			ShowPriceRiceThai::$Grid1->Edit=false;
			ShowPriceRiceThai::$Grid1->Delete=$o_per[0]->permissDel;
			$this->Add(ShowPriceRiceThai::$Grid1);

			$o2=$dao->selectAllByType("2");
			
			ShowPriceRiceThai::$Grid2=new TGridtable();
			ShowPriceRiceThai::$Grid2->setgridtable("Grid2",$o2);
			for($i=0;$i<count($o2);$i++)
			{
				$o2[$i]->paddydata2="<a href='?page=Plugin_Price_Rice_Thai/ShowPriceRiceThaiPaddy2&thaiID=".$o2[$i]->thaiID."'>ราคาข้าวเปลือกเฉลี่ย</a>";
			}
			$grid=new TCheckbox();
			$grid->set('cartoonpartIDCheck',"","","40",ture,'reqstring',false);
			$grid->additem(" ","");
			$grid->title=' ';
			ShowPriceRiceThai::$Grid2->addcontrol($grid);
			
			$grid=new TLabel();
			$grid->set('thaiDate',"","","",true,"",false);
			$grid->title='ข้อมูล ณ วันที่';
			ShowPriceRiceThai::$Grid2->addcontrol($grid);

			$grid=new TGridLink();
			$grid->set('paddydata2',"","","","true","","");
			$grid->title='ราคาข้าวเปลือก';
			ShowPriceRiceThai::$Grid2->addcontrol($grid);

			ShowPriceRiceThai::$Grid2->View=false;
			ShowPriceRiceThai::$Grid2->Edit=false;
			ShowPriceRiceThai::$Grid2->Delete=$o_per[0]->permissDel;
			$this->Add(ShowPriceRiceThai::$Grid2);

			$o3=$dao->selectAllByType("3");
			
			ShowPriceRiceThai::$Grid3=new TGridtable();
			ShowPriceRiceThai::$Grid3->setgridtable("Grid3",$o3);
			for($i=0;$i<count($o3);$i++)
			{
				$o3[$i]->paddydata3="<a href='?page=Plugin_Price_Rice_Thai/ShowPriceRiceThaiPaddy3&thaiID=".$o3[$i]->thaiID."'>ราคาที่เกษตรกรขายได้ที่ไร่-นาเฉลี่ยทั้งประเทศ</a>";
			}
			$grid=new TCheckbox();
			$grid->set('cartoonpartIDCheck',"","","40",ture,'reqstring',false);
			$grid->additem(" ","");
			$grid->title=' ';
			ShowPriceRiceThai::$Grid3->addcontrol($grid);
			
			$grid=new TLabel();
			$grid->set('thaiDate',"","","",true,"",false);
			$grid->title='ข้อมูล ณ วันที่';
			ShowPriceRiceThai::$Grid3->addcontrol($grid);

			$grid=new TGridLink();
			$grid->set('paddydata3',"","","","true","","");
			$grid->title='ราคาข้าวเปลือก';
			ShowPriceRiceThai::$Grid3->addcontrol($grid);

			ShowPriceRiceThai::$Grid3->View=false;
			ShowPriceRiceThai::$Grid3->Edit=false;
			ShowPriceRiceThai::$Grid3->Delete=$o_per[0]->permissDel;
			$this->Add(ShowPriceRiceThai::$Grid3);

			$o4=$dao->selectAllByType("4");
			
			ShowPriceRiceThai::$Grid4=new TGridtable();
			ShowPriceRiceThai::$Grid4->setgridtable("Grid4",$o4);
			for($i=0;$i<count($o4);$i++)
			{
				$o4[$i]->paddydata4="<a href='?page=Plugin_Price_Rice_Thai/ShowPriceRiceThaiPaddy4&thaiID=".$o4[$i]->thaiID."'>ราคารับซื้อรายวันที่ตลาดกลางและตลาดสำคัญ</a>";
			}
			$grid=new TCheckbox();
			$grid->set('cartoonpartIDCheck',"","","40",ture,'reqstring',false);
			$grid->additem(" ","");
			$grid->title=' ';
			ShowPriceRiceThai::$Grid4->addcontrol($grid);
			
			$grid=new TLabel();
			$grid->set('thaiDate',"","","",true,"",false);
			$grid->title='ข้อมูล ณ วันที่';
			ShowPriceRiceThai::$Grid4->addcontrol($grid);

			$grid=new TGridLink();
			$grid->set('paddydata4',"","","","true","","");
			$grid->title='ราคาข้าวเปลือก';
			ShowPriceRiceThai::$Grid4->addcontrol($grid);

			ShowPriceRiceThai::$Grid4->View=false;
			ShowPriceRiceThai::$Grid4->Edit=false;
			ShowPriceRiceThai::$Grid4->Delete=$o_per[0]->permissDel;
			$this->Add(ShowPriceRiceThai::$Grid4);

			$o5=$dao->selectAllByType("5");
			
			ShowPriceRiceThai::$Grid5=new TGridtable();
			ShowPriceRiceThai::$Grid5->setgridtable("Grid5",$o5);
			for($i=0;$i<count($o5);$i++)
			{
				$o5[$i]->paddydata5="<a href='?page=Plugin_Price_Rice_Thai/ShowPriceRiceThaiPaddy5&thaiID=".$o5[$i]->thaiID."'>ราคาขายปลีกตลาดกรุงเทพฯ</a>";
			}
			$grid=new TCheckbox();
			$grid->set('cartoonpartIDCheck',"","","40",ture,'reqstring',false);
			$grid->additem(" ","");
			$grid->title=' ';
			ShowPriceRiceThai::$Grid5->addcontrol($grid);
			
			$grid=new TLabel();
			$grid->set('thaiDate',"","","",true,"",false);
			$grid->title='ข้อมูล ณ วันที่';
			ShowPriceRiceThai::$Grid5->addcontrol($grid);

			$grid=new TGridLink();
			$grid->set('paddydata5',"","","","true","","");
			$grid->title='ราคาข้าวสาร';
			ShowPriceRiceThai::$Grid5->addcontrol($grid);

			ShowPriceRiceThai::$Grid5->View=false;
			ShowPriceRiceThai::$Grid5->Edit=false;
			ShowPriceRiceThai::$Grid5->Delete=$o_per[0]->permissDel;
			$this->Add(ShowPriceRiceThai::$Grid5);

			$o6=$dao->selectAllByType("6");
			
			ShowPriceRiceThai::$Grid6=new TGridtable();
			ShowPriceRiceThai::$Grid6->setgridtable("Grid6",$o6);
			for($i=0;$i<count($o6);$i++)
			{
				$o6[$i]->paddydata6="<a href='?page=Plugin_Price_Rice_Thai/ShowPriceRiceThaiPaddy6&thaiID=".$o6[$i]->thaiID."'>ราคาขายส่งตลาดกรุงเทพฯ</a>";
			}
			$grid=new TCheckbox();
			$grid->set('cartoonpartIDCheck',"","","40",ture,'reqstring',false);
			$grid->additem(" ","");
			$grid->title=' ';
			ShowPriceRiceThai::$Grid6->addcontrol($grid);
			
			$grid=new TLabel();
			$grid->set('thaiDate',"","","",true,"",false);
			$grid->title='ข้อมูล ณ วันที่';
			ShowPriceRiceThai::$Grid6->addcontrol($grid);

			$grid=new TGridLink();
			$grid->set('paddydata6',"","","","true","","");
			$grid->title='ราคาข้าวสาร';
			ShowPriceRiceThai::$Grid6->addcontrol($grid);

			ShowPriceRiceThai::$Grid6->View=false;
			ShowPriceRiceThai::$Grid6->Edit=false;
			ShowPriceRiceThai::$Grid6->Delete=$o_per[0]->permissDel;
			$this->Add(ShowPriceRiceThai::$Grid6);

			$o7=$dao->selectAllByType("7");
			
			ShowPriceRiceThai::$Grid7=new TGridtable();
			ShowPriceRiceThai::$Grid7->setgridtable("Grid7",$o7);
			for($i=0;$i<count($o7);$i++)
			{
				$o7[$i]->paddydata7="<a href='?page=Plugin_Price_Rice_Thai/ShowPriceRiceThaiPaddy7&thaiID=".$o7[$i]->thaiID."'>ราคาข้าวสารของสมาคมโรงสีข้าวไทย</a>";
			}
			$grid=new TCheckbox();
			$grid->set('cartoonpartIDCheck',"","","40",ture,'reqstring',false);
			$grid->additem(" ","");
			$grid->title=' ';
			ShowPriceRiceThai::$Grid7->addcontrol($grid);
			
			$grid=new TLabel();
			$grid->set('thaiDate',"","","",true,"",false);
			$grid->title='ข้อมูล ณ วันที่';
			ShowPriceRiceThai::$Grid7->addcontrol($grid);

			$grid=new TGridLink();
			$grid->set('paddydata7',"","","","true","","");
			$grid->title='ราคาข้าวสาร';
			ShowPriceRiceThai::$Grid7->addcontrol($grid);

			ShowPriceRiceThai::$Grid7->View=false;
			ShowPriceRiceThai::$Grid7->Edit=false;
			ShowPriceRiceThai::$Grid7->Delete=$o_per[0]->permissDel;
			$this->Add(ShowPriceRiceThai::$Grid7);

			$o8=$dao->selectAllByType("8");
			
			ShowPriceRiceThai::$Grid8=new TGridtable();
			ShowPriceRiceThai::$Grid8->setgridtable("Grid8",$o8);
			for($i=0;$i<count($o8);$i++)
			{
				$o8[$i]->paddydata8="<a href='?page=Plugin_Price_Rice_Thai/ShowPriceRiceThaiPaddy8&thaiID=".$o8[$i]->thaiID."'>ราคาข้าวตลาดกรุงเทพฯ</a>";
			}
			$grid=new TCheckbox();
			$grid->set('cartoonpartIDCheck',"","","40",ture,'reqstring',false);
			$grid->additem(" ","");
			$grid->title=' ';
			ShowPriceRiceThai::$Grid8->addcontrol($grid);
			
			$grid=new TLabel();
			$grid->set('thaiDate',"","","",true,"",false);
			$grid->title='ข้อมูล ณ วันที่';
			ShowPriceRiceThai::$Grid8->addcontrol($grid);

			$grid=new TGridLink();
			$grid->set('paddydata8',"","","","true","","");
			$grid->title='ราคาข้าวสาร';
			ShowPriceRiceThai::$Grid8->addcontrol($grid);

			ShowPriceRiceThai::$Grid8->View=false;
			ShowPriceRiceThai::$Grid8->Edit=false;
			ShowPriceRiceThai::$Grid8->Delete=$o_per[0]->permissDel;
			$this->Add(ShowPriceRiceThai::$Grid8);

			$o9=$dao->selectAllByType("9");
			
			ShowPriceRiceThai::$Grid9=new TGridtable();
			ShowPriceRiceThai::$Grid9->setgridtable("Grid9",$o9);
			for($i=0;$i<count($o9);$i++)
			{
				$o9[$i]->paddydata9="<a href='?page=Plugin_Price_Rice_Thai/ShowPriceRiceThaiPaddy9&thaiID=".$o9[$i]->thaiID."'>ราคาข้าวถุง</a>";
			}
			$grid=new TCheckbox();
			$grid->set('cartoonpartIDCheck',"","","40",ture,'reqstring',false);
			$grid->additem(" ","");
			$grid->title=' ';
			ShowPriceRiceThai::$Grid9->addcontrol($grid);
			
			$grid=new TLabel();
			$grid->set('thaiDate',"","","",true,"",false);
			$grid->title='ข้อมูล ณ วันที่';
			ShowPriceRiceThai::$Grid9->addcontrol($grid);

			$grid=new TGridLink();
			$grid->set('paddydata9',"","","","true","","");
			$grid->title='ราคาข้าวถุง';
			ShowPriceRiceThai::$Grid9->addcontrol($grid);

			ShowPriceRiceThai::$Grid9->View=false;
			ShowPriceRiceThai::$Grid9->Edit=false;
			ShowPriceRiceThai::$Grid9->Delete=$o_per[0]->permissDel;
			$this->Add(ShowPriceRiceThai::$Grid9);

	 	$this->waitevent();
	}

	function Grid1_rowperpage($parameter,$sender)
	{
		$v=explode(",",$parameter);
		ShowPriceRiceThai::$Grid1->gotopage($v[1]);
		ShowPriceRiceThai::$Grid1->changenumpage($v[0]);
	 }
	 function Grid1_nextpage($parameter,$sender)
	{
		$v=explode(",",$parameter);
		ShowPriceRiceThai::$Grid1->gotopage($v[1]);
		ShowPriceRiceThai::$Grid1->changenumpage($v[0]);
	}
	function Grid1_View($parameter,$sender)
	{
		
	}
	function frmNew1($parameter,$sender)
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
	function frmNew2($parameter,$sender)
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
	function frmNew3($parameter,$sender)
	{
		$form=new TLabel();
		$form->set('labelModal',"
		<script>

			$( document ).ready(function() {
			    $('#myModal3').modal('show');
			});
		</script>
		",30,30,true,"String",false); 
		$sender->add($form);
	}
	function frmNew4($parameter,$sender)
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
	function frmNew5($parameter,$sender)
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
	function frmNew6($parameter,$sender)
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
	function frmNew7($parameter,$sender)
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
	function frmNew8($parameter,$sender)
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
	function frmNew9($parameter,$sender)
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
	function frmAction1($parameter,$sender)
	{
		$o=new plugin_price_rice_thai();

		$o->thaiDate=$sender->getdata('thaiDate');
		$o->thaiType="1";
		$o->creationUser=$_SESSION["Session_User_UserID"];
		$o->status="Open";
		$dao=new Plugin_Price_Rice_ThaiDao();
		
		
		if($o->thaiID)
		{
			$dao->update($o);
			Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThai","alert","update");
		}
		else
		{
			$dao->save($o);
			Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThai","alert","save");
				
		}
	}
	function frmAction2($parameter,$sender)
	{
		$o=new plugin_price_rice_thai();

		$o->thaiDate=$sender->getdata('thaiDate');
		$o->thaiType="2";
		$o->creationUser=$_SESSION["Session_User_UserID"];
		$o->status="Open";
		$dao=new Plugin_Price_Rice_ThaiDao();
		
		if($o->thaiID)
		{
			$dao->update($o);
			Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThai","alert","update");
		}
		else
		{
			$dao->save($o);
			Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThai","alert","save");
				
		}
	}
	function frmAction3($parameter,$sender)
	{
		$o=new plugin_price_rice_thai();

		$o->thaiDate=$sender->getdata('thaiDate');
		$o->thaiType="3";
		$o->creationUser=$_SESSION["Session_User_UserID"];
		$o->status="Open";
		$dao=new Plugin_Price_Rice_ThaiDao();
		
		if($o->thaiID)
		{
			$dao->update($o);
			Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThai","alert","update");
		}
		else
		{
			$dao->save($o);
			Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThai","alert","save");
				
		}
	}
	function frmAction4($parameter,$sender)
	{
		$o=new plugin_price_rice_thai();

		$o->thaiDate=$sender->getdata('thaiDate');
		$o->thaiType="4";
		$o->creationUser=$_SESSION["Session_User_UserID"];
		$o->status="Open";
		$dao=new Plugin_Price_Rice_ThaiDao();
		
		if($o->thaiID)
		{
			$dao->update($o);
			Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThai","alert","update");
		}
		else
		{
			$dao->save($o);
			Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThai","alert","save");
				
		}
	}
	function frmAction5($parameter,$sender)
	{
		$o=new plugin_price_rice_thai();

		$o->thaiDate=$sender->getdata('thaiDate');
		$o->thaiType="5";
		$o->creationUser=$_SESSION["Session_User_UserID"];
		$o->status="Open";
		$dao=new Plugin_Price_Rice_ThaiDao();
		
		if($o->thaiID)
		{
			$dao->update($o);
			Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThai","alert","update");
		}
		else
		{
			$dao->save($o);
			Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThai","alert","save");
				
		}
	}
	function frmAction6($parameter,$sender)
	{
		$o=new plugin_price_rice_thai();

		$o->thaiDate=$sender->getdata('thaiDate');
		$o->thaiType="6";
		$o->creationUser=$_SESSION["Session_User_UserID"];
		$o->status="Open";
		$dao=new Plugin_Price_Rice_ThaiDao();
		
		if($o->thaiID)
		{
			$dao->update($o);
			Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThai","alert","update");
		}
		else
		{
			$dao->save($o);
			Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThai","alert","save");
				
		}
	}
	function frmAction7($parameter,$sender)
	{
		$o=new plugin_price_rice_thai();

		$o->thaiDate=$sender->getdata('thaiDate');
		$o->thaiType="7";
		$o->creationUser=$_SESSION["Session_User_UserID"];
		$o->status="Open";
		$dao=new Plugin_Price_Rice_ThaiDao();
		
		if($o->thaiID)
		{
			$dao->update($o);
			Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThai","alert","update");
		}
		else
		{
			$dao->save($o);
			Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThai","alert","save");
				
		}
	}
	function frmAction8($parameter,$sender)
	{
		$o=new plugin_price_rice_thai();

		$o->thaiDate=$sender->getdata('thaiDate');
		$o->thaiType="8";
		$o->creationUser=$_SESSION["Session_User_UserID"];
		$o->status="Open";
		$dao=new Plugin_Price_Rice_ThaiDao();
		
		if($o->thaiID)
		{
			$dao->update($o);
			Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThai","alert","update");
		}
		else
		{
			$dao->save($o);
			Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThai","alert","save");
				
		}
	}
	function frmAction9($parameter,$sender)
	{
		$o=new plugin_price_rice_thai();

		$o->thaiDate=$sender->getdata('thaiDate');
		$o->thaiType="9";
		$o->creationUser=$_SESSION["Session_User_UserID"];
		$o->status="Open";
		$dao=new Plugin_Price_Rice_ThaiDao();
		
		msgbox("frmAction9");

		if($o->thaiID)
		{
			//$dao->update($o);
			//Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThai","alert","update");
		}
		else
		{
			//$dao->save($o);
			//Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThai","alert","save");
				
		}
	}
	function Grid1_Deleting($parameter,$sender)
	{
		$o=new plugin_price_rice_thai();
		$o->thaiID=ShowPriceRiceThai::$Grid1->getvalues("thaiID",$parameter);
		$dao=new Plugin_Price_Rice_ThaiDao();

		$dao->deletes($o);
		Refreshs("Plugin_Price_Rice_Thai/ShowPriceRiceThai","alert","del");
	}
}
?>