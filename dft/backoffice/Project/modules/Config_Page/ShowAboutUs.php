<?php
require_once("Project/bussiness/Config_Page_AboutusDao.php");
	require_once("Project/common/config_page_aboutus.php");

 class  ShowAboutUs extends TForm
 {
	 public static $Grid1;
	 function ShowAboutUs()
		{
	 $this->Init("ShowAboutUs","Config_Page","",true);
		
				
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

			

				$dao=new Config_Page_AboutusDao();
				$o=$dao->selectAll();

			
				
				ShowAboutUs::$Grid1=new TGridtable();
				ShowAboutUs::$Grid1->setgridtable("Grid1",$o);

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
				


				$grid=new TLabel();
				$grid->set('webName',$o->webName,30,30,ture,'reqstring','ชื่อ');
				$grid->title='ชื่อเว็บ';
				ShowAboutUs::$Grid1->addcontrol($grid);


				$status=new TGridLink();
				$status->set('status',$o->status,30,30,ture,'reqstring','ชื่อ');
				$status->title='สถานะ';
				$status->setEvent("onclick","frmActionStatus");
				ShowAboutUs::$Grid1->addcontrol($status);
				

				ShowAboutUs::$Grid1->View=false;
				ShowAboutUs::$Grid1->Edit=true;
				ShowAboutUs::$Grid1->Delete=true;
				$this->Add(ShowAboutUs::$Grid1);

	 $this->waitevent();
		}
		
		function Grid1_View($parameter,$sender)
		{
			$value[1]=ShowAboutUs::$Grid1->getvalues("aboutusID",$parameter);
			//fRefresh("","page,object_id","Register.frmRegister,$value[1]");
		}
		 function Grid1_Editing($parameter,$sender)
		{
			$value[1]=ShowAboutUs::$Grid1->getvalues("aboutusID",$parameter);
			Refreshs("Config_Page.frmAboutUs","object_id",$value[1]);
		}
		function Grid1_Deleting($parameter,$sender)
		{
			
			$o=new config_page_aboutus();
			$o->aboutusID=ShowAboutUs::$Grid1->getvalues("aboutusID",$parameter);
			$dao=new Config_Page_Menu_BarDao();
			$dao->deletes($o);
			Refreshs("Config_Page.ShowAboutUs","alert","del");
		}
		function frmAction($parameter,$sender)
		{
				fRefresh("","page","Config_Page.frmAboutUs");
		}
		function frmActionSubmenu($parameter,$sender)
		{
				$aboutusID=ShowAboutUs::$Grid1->getvalues("aboutusID",$parameter);
				fRefresh("","page","Config_Page.ShowAboutUsSub&aboutusID=$aboutusID");
		}
		function frmActionStatus($parameter,$sender)
		{
			$o=new config_page_aboutus();
			$aboutusID=ShowAboutUs::$Grid1->getvalues("aboutusID",$parameter);
			$dao=new Config_Page_Menu_BarDao();
			$o_chk=$dao->selectById($aboutusID);
			$o->aboutusID=$o_chk->aboutusID;
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

			Refreshs("Config_Page.ShowAboutUs","alert","update");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new Config_Page_Menu_BarDao();
				for($i=ShowAboutUs::$Grid1->getstart();$i<ShowAboutUs::$Grid1->getstop();$i++)
			{
				$o=new config_page_aboutus();
				
				$o->aboutusID=ShowAboutUs::$Grid1->getvalues("aboutusID",$i);
				
				$o->cartoonpartIDCheck=ShowAboutUs::$Grid1->getvalues("cartoonpartIDCheck",$i);
				if($o->cartoonpartIDCheck)
				{
					if($o->aboutusID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->usertypeID="";
					}
				}
				
			}
				Refreshs("Config_Page.ShowAboutUs","alert","del");
		}
 }
?>