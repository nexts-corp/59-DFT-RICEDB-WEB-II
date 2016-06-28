<?php
require_once("Project/bussiness/Config_Page_Menu_BarDao.php");
require_once("Project/common/config_page_menu_bar.php");

 class  ShowMenuBar extends TForm
 {
	 public static $Grid1;
	 function ShowMenuBar()
		{
	 $this->Init("ShowMenuBar","Config_Page","",true);
		
				
				$alert=$this->getdata("alert");

				if($alert)
				{
						$alertmsg=new TLabel();
						$alertmsg->set("alertmsg",alerts($alert),"","",true,"","");
						$this->add($alertmsg);
				}

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
				

				$dao=new Config_Page_Menu_BarDao();
				$o=$dao->selectAll();
				
				ShowMenuBar::$Grid1=new TGridtable();
				ShowMenuBar::$Grid1->setgridtable("Grid1",$o);

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
						$o[$i]->submenu="<i class=\"icon-cog\"></i> จัดการเมนูย่อย";
				}
				
				$grid=new TCheckbox();
				$grid->set('cartoonpartIDCheck',"","","40",ture,'reqstring',false);
				$grid->additem(" ","");
				$grid->title=' ';
				ShowMenuBar::$Grid1->addcontrol($grid);

				$grid=new TLabel();
				$grid->set('menubarType',$o->menubarType,30,30,ture,'reqstring','ชื่อ');
				$grid->title='ประเภทเมนูบาร์';
				ShowMenuBar::$Grid1->addcontrol($grid);

				$grid=new TLabel();
				$grid->set('menubarName',$o->menubarName,30,30,ture,'reqstring','ชื่อ');
				$grid->title='ชื่อเมนู';
				ShowMenuBar::$Grid1->addcontrol($grid);

				$grid=new TGridLink();
				$grid->set('submenu',$o->submenu,30,30,ture,'reqstring','ชื่อ');
				$grid->title='เมนูย่อย';
				$grid->setEvent("onclick","frmActionSubmenu");
				$grid->setAttribute("class","btn btn-xs");
				ShowMenuBar::$Grid1->addcontrol($grid);

				$status=new TGridLink();
				$status->set('status',$o->status,30,30,ture,'reqstring','ชื่อ');
				$status->title='สถานะ';
				$status->setEvent("onclick","frmActionStatus");
				ShowMenuBar::$Grid1->addcontrol($status);
				

				ShowMenuBar::$Grid1->View=false;
				ShowMenuBar::$Grid1->Edit=true;
				ShowMenuBar::$Grid1->Delete=true;
				$this->Add(ShowMenuBar::$Grid1);

	 $this->waitevent();
		}
		
		function Grid1_View($parameter,$sender)
		{
			$value[1]=ShowMenuBar::$Grid1->getvalues("menubarID",$parameter);
			//fRefresh("","page,object_id","Register.frmRegister,$value[1]");
		}
		 function Grid1_Editing($parameter,$sender)
		{
			$value[1]=ShowMenuBar::$Grid1->getvalues("menubarID",$parameter);
			Refreshs("Config_Page.frmMenuBar","object_id",$value[1]);
		}
		function Grid1_Deleting($parameter,$sender)
		{
			
			$o=new config_page_menu_bar();
			$o->menubarID=ShowMenuBar::$Grid1->getvalues("menubarID",$parameter);
			$dao=new Config_Page_Menu_BarDao();
			$dao->deletes($o);
			Refreshs("Config_Page.ShowMenuBar","alert","del");
		}
		function frmAction($parameter,$sender)
		{
				fRefresh("","page","Config_Page.frmMenuBar");
		}
		function frmActionSubmenu($parameter,$sender)
		{
				$menubarID=ShowMenuBar::$Grid1->getvalues("menubarID",$parameter);
				fRefresh("","page","Config_Page.ShowMenuBarSub&menubarID=$menubarID");
		}
		function frmActionStatus($parameter,$sender)
		{
			$o=new config_page_menu_bar();
			$menubarID=ShowMenuBar::$Grid1->getvalues("menubarID",$parameter);
			$dao=new Config_Page_Menu_BarDao();
			$o_chk=$dao->selectById($menubarID);
			$o->menubarID=$o_chk->menubarID;
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

			Refreshs("Config_Page.ShowMenuBar","alert","update");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new Config_Page_Menu_BarDao();
				for($i=ShowMenuBar::$Grid1->getstart();$i<ShowMenuBar::$Grid1->getstop();$i++)
			{
				$o=new config_page_menu_bar();
				
				$o->menubarID=ShowMenuBar::$Grid1->getvalues("menubarID",$i);
				
				$o->cartoonpartIDCheck=ShowMenuBar::$Grid1->getvalues("cartoonpartIDCheck",$i);
				if($o->cartoonpartIDCheck)
				{
					if($o->menubarID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->usertypeID="";
					}
				}
				
			}
				Refreshs("Config_Page.ShowMenuBar","alert","del");
		}
 }
?>