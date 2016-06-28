<?php
require_once("Project/bussiness/Config_Page_Menu_FooterDao.php");
require_once("Project/common/config_page_menu_footer.php");

 class  ShowMenuFooter extends TForm
 {
	 public static $Grid1;
	 function ShowMenuFooter()
		{
	 $this->Init("ShowMenuFooter","Config_Page","",true);
		
				
				$alert=$this->getdata("alert");

				if($alert)
				{
						$alertmsg=new TLabel();
						$alertmsg->set("alertmsg",alerts($alert),"","",true,"","");
						$this->add($alertmsg);
				}

				$bn=new TButton();
				$bn->set("bn","<i></i> เพิ่มข้อมูลใหม่","","",true,"",true);
				$bn->setEvent("onclick","frmAction");
				$bn->setAttribute("class","btn btn-xs btn-primary");
				$this->Add($bn);

				$bndelgrid=new TButton();
				$bndelgrid->set("bndelgrid"," ลบข้อมูล","","",true,"","");
				$bndelgrid->setEvent_Confirm("onclick","frmDelAll",true,"คุณต้องการลบข้อมูลใช่หรือไม่");
				$bndelgrid->setAttribute("class","btn btn-xs btn-danger");
				$this->Add($bndelgrid);
				
				$dao=new Config_Page_Menu_FooterDao();
				$o=$dao->selectAll();
				
				ShowMenuFooter::$Grid1=new TGridtable();
				ShowMenuFooter::$Grid1->setgridtable("Grid1",$o);

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
				$grid->set('menufooterIDCheck',"","","40",ture,'reqstring',false);
				$grid->additem(" ","");
				$grid->title=' ';
				ShowMenuFooter::$Grid1->addcontrol($grid);

				$menufooterName=new TLabel();
				$menufooterName->set('menufooterName',$o->menufooterName,30,30,ture,'reqstring','ชื่อ');
				$menufooterName->title='ชื่อเมนู';
				ShowMenuFooter::$Grid1->addcontrol($menufooterName);

				$menufooterLink=new TLabel();
				$menufooterLink->set('menufooterLink',$o->menufooterLink,30,30,ture,'reqstring','ชื่อ');
				$menufooterLink->title='Link';
				ShowMenuFooter::$Grid1->addcontrol($menufooterLink);


				$status=new TGridLink();
				$status->set('status',$o->status,30,30,ture,'reqstring','ชื่อ');
				$status->title='สถานะ';
				$status->setEvent("onclick","frmActionStatus");
				ShowMenuFooter::$Grid1->addcontrol($status);
				

				ShowMenuFooter::$Grid1->View=false;
				ShowMenuFooter::$Grid1->Edit=true;
				ShowMenuFooter::$Grid1->Delete=true;
				$this->Add(ShowMenuFooter::$Grid1);

	 $this->waitevent();
		}
		
		function Grid1_View($parameter,$sender)
		{
			$value[1]=ShowUserType::$Grid1->getvalues("usertypeID",$parameter);
			//fRefresh("","page,object_id","Register.frmRegister,$value[1]");
		}
		 function Grid1_Editing($parameter,$sender)
		{
			$value[1]=ShowMenuFooter::$Grid1->getvalues("menufooterID",$parameter);
			Refreshs("Config_Page.frmMenuFooter","object_id",$value[1]);
		}
		function Grid1_Deleting($parameter,$sender)
		{
			
			$o=new config_page_menu_footer();
			$o->menufooterID=ShowMenuFooter::$Grid1->getvalues("menufooterID",$parameter);
			$dao=new Config_Page_Menu_FooterDao();
			$dao->deletes($o);
			Refreshs("Config_Page.ShowMenuFooter","alert","del");
		}
		function frmAction($parameter,$sender)
		{
				fRefresh("","page","Config_Page.frmMenuFooter");
		}
		function frmActionStatus($parameter,$sender)
		{
			$o=new config_page_menu_footer();
			$menufooterID=ShowMenuFooter::$Grid1->getvalues("menufooterID",$parameter);
			$dao=new Config_Page_Menu_FooterDao();
			$o_chk=$dao->selectById($menufooterID);
			$o->menufooterID=$o_chk->menufooterID;
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

			Refreshs("Config_Page.ShowMenuFooter","alert","update");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new Config_Page_Menu_FooterDao();
				for($i=ShowMenuFooter::$Grid1->getstart();$i<ShowMenuFooter::$Grid1->getstop();$i++)
			{
				$o=new config_page_menu_footer();
				
				$o->menufooterID=ShowMenuFooter::$Grid1->getvalues("menufooterID",$i);
				
				$o->menufooterIDCheck=ShowMenuFooter::$Grid1->getvalues("menufooterIDCheck",$i);
				if($o->menufooterIDCheck)
				{
					if($o->menufooterID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->menufooterID="";
					}
				}
				
			}
				Refreshs("Config_Page.ShowMenuFooter","alert","del");
		}
 }
?>