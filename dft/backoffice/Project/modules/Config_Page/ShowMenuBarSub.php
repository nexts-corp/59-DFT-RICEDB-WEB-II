<?php
require_once("Project/bussiness/Config_Page_Menu_BarDao.php");
require_once("Project/common/config_page_menu_bar.php");

require_once("Project/bussiness/Config_Page_Menu_Bar_SubDao.php");
require_once("Project/common/config_page_menu_bar_sub.php");
 class  ShowMenuBarSub extends TForm
 {
	 public static $Grid1;
	 function ShowMenuBarSub()
		{
	 $this->Init("ShowMenuBarSub","Config_Page","",true);
		
				
				$alert=$this->getdata("alert");

				if($alert)
				{
						$alertmsg=new TLabel();
						$alertmsg->set("alertmsg",alerts($alert),"","",true,"","");
						$this->add($alertmsg);
				}
				
				$menubarID=$this->getdata("menubarID");

				$dao_config_page_menu_bar=new Config_Page_Menu_BarDao();
				$o_config_page_menu_bar=$dao_config_page_menu_bar->selectById($menubarID);

				$form=new TLabel();
				$form->set("menubarName",$o_config_page_menu_bar->menubarName,"","",true,"","");
				$this->add($form);

				$form=new THidden();
				$form->set('menubarID',$o_config_page_menu_bar->menubarID,30,30,true,"String",false); 
				$this->add($form);


				$bn=new TButton();
				$bn->set("bn"," เพิ่มข้อมูลใหม่","","",true,"","");
				$bn->setEvent("onclick","frmAction");
				$bn->setAttribute("class","btn btn-xs btn-primary");
				$this->Add($bn);

				$bndelgrid=new TButton();
				$bndelgrid->set("bndelgrid"," ลบข้อมูล","","",true,"","");
				$bndelgrid->setEvent_Confirm("onclick","frmDelAll",true,"คุณต้องการลบข้อมูลใช่หรือไม่");
				$bndelgrid->setAttribute("class","btn btn-xs btn-danger");
				$this->Add($bndelgrid);
				

				$dao=new Config_Page_Menu_Bar_SubDao();
				$o=$dao->selectAllByMenuBar($menubarID);
				
				ShowMenuBarSub::$Grid1=new TGridtable();
				ShowMenuBarSub::$Grid1->setgridtable("Grid1",$o);

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
				ShowMenuBarSub::$Grid1->addcontrol($grid);

				$grid=new TLabel();
				$grid->set('menubarsubType',$o->menubarsubType,30,30,ture,'reqstring','ชื่อ');
				$grid->title='ประเภทเมนูบาร์ย่อย';
				ShowMenuBarSub::$Grid1->addcontrol($grid);

				$grid=new TLabel();
				$grid->set('menubarsubName',$o->menubarsubName,30,30,ture,'reqstring','ชื่อ');
				$grid->title='ชื่อเมนูย่อย';
				ShowMenuBarSub::$Grid1->addcontrol($grid);


				$status=new TGridLink();
				$status->set('status',$o->status,30,30,ture,'reqstring','ชื่อ');
				$status->title='สถานะ';
				$status->setEvent("onclick","frmActionStatus");
				ShowMenuBarSub::$Grid1->addcontrol($status);
				

				ShowMenuBarSub::$Grid1->View=false;
				ShowMenuBarSub::$Grid1->Edit=true;
				ShowMenuBarSub::$Grid1->Delete=true;
				$this->Add(ShowMenuBarSub::$Grid1);

	 $this->waitevent();
		}
		
		function Grid1_View($parameter,$sender)
		{
			$value[1]=ShowMenuBarSub::$Grid1->getvalues("menubarID",$parameter);
			//fRefresh("","page,object_id","Register.frmRegister,$value[1]");
		}
		 function Grid1_Editing($parameter,$sender)
		{
			$menubarID=$sender->getvalue('menubarID');
			$value[1]=ShowMenuBarSub::$Grid1->getvalues("menubarsubID",$parameter);
			Refreshs("Config_Page.frmMenuBarSub&menubarID=$menubarID","object_id",$value[1]);
		}
		function Grid1_Deleting($parameter,$sender)
		{
			
			$o=new config_page_menu_bar_sub();
			$o->menubarsubID=ShowMenuBarSub::$Grid1->getvalues("menubarsubID",$parameter);
			$dao=new Config_Page_Menu_Bar_SubDao();
			$dao->deletes($o);
			$menubarID=$sender->getvalue('menubarID');
			Refreshs("Config_Page.ShowMenuBarSub&menubarID=$menubarID","alert","del");
		}
		function frmAction($parameter,$sender)
		{
				$menubarID=$sender->getvalue('menubarID');
				fRefresh("","page","Config_Page.frmMenuBarSub&menubarID=$menubarID");
		}
		function frmActionStatus($parameter,$sender)
		{
			$o=new config_page_menu_bar_sub();
			$menubarsubID=ShowMenuBarSub::$Grid1->getvalues("menubarsubID",$parameter);
			$dao=new Config_Page_Menu_Bar_SubDao();
			$o_chk=$dao->selectById($menubarsubID);
			$o->menubarsubID=$o_chk->menubarsubID;
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
			
			$menubarID=$sender->getvalue('menubarID');
			Refreshs("Config_Page.ShowMenuBarSub&menubarID=$menubarID","alert","update");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new Config_Page_Menu_Bar_SubDao();
				for($i=ShowMenuBarSub::$Grid1->getstart();$i<ShowMenuBarSub::$Grid1->getstop();$i++)
			{
				$o=new config_page_menu_bar_sub();
				
				$o->menubarsubID=ShowMenuBarSub::$Grid1->getvalues("menubarsubID",$i);
				
				$o->cartoonpartIDCheck=ShowMenuBarSub::$Grid1->getvalues("cartoonpartIDCheck",$i);
				if($o->cartoonpartIDCheck)
				{
					if($o->menubarsubID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->usertypeID="";
					}
				}
				
			}
				$menubarID=$sender->getvalue('menubarID');
				Refreshs("Config_Page.ShowMenuBarSub&menubarID=$menubarID","alert","del");
		}
 }
?>