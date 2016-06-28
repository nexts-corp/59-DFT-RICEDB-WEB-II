<?php
require_once("Project/bussiness/Config_PageDao.php");
require_once("Project/common/config_page.php");

 class  ShowConfigPage extends TForm
 {
	 public static $Grid1;
	 function ShowConfigPage()
		{
	 $this->Init("ShowConfigPage","Config_Page","",true);
		
				
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
				
				$dao=new Config_PageDao();
				$o=$dao->selectAll();
				
				ShowConfigPage::$Grid1=new TGridtable();
				ShowConfigPage::$Grid1->setgridtable("Grid1",$o);

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
				$grid->set('pageIDCheck',"","","40",ture,'reqstring',false);
				$grid->additem(" ","");
				$grid->title=' ';
				ShowConfigPage::$Grid1->addcontrol($grid);

				$web=new TLabel();
				$web->set('web',$o->web,30,30,ture,'reqstring','ชื่อ');
				$web->title='ชื่อเว็บ';
				ShowConfigPage::$Grid1->addcontrol($web);

				

				$status=new TGridLink();
				$status->set('status',$o->status,30,30,ture,'reqstring','ชื่อ');
				$status->title='สถานะ';
				$status->setEvent("onclick","frmActionStatus");
				ShowConfigPage::$Grid1->addcontrol($status);
				

				ShowConfigPage::$Grid1->View=false;
				ShowConfigPage::$Grid1->Edit=true;
				ShowConfigPage::$Grid1->Delete=true;
				$this->Add(ShowConfigPage::$Grid1);

	 $this->waitevent();
		}
		
		function Grid1_View($parameter,$sender)
		{
			$value[1]=ShowUserType::$Grid1->getvalues("usertypeID",$parameter);
			//fRefresh("","page,object_id","Register.frmRegister,$value[1]");
		}
		 function Grid1_Editing($parameter,$sender)
		{
			$value[1]=ShowConfigPage::$Grid1->getvalues("pageID",$parameter);
			Refreshs("Config_Page.frmConfigPage","object_id",$value[1]);
		}
		function Grid1_Deleting($parameter,$sender)
		{
			
			$o=new config_page();
			$o->pageID=ShowConfigPage::$Grid1->getvalues("pageID",$parameter);
			$dao=new Config_PageDao();
			$dao->deletes($o);
			Refreshs("Config_Page.ShowConfigPage","alert","del");
		}
		function frmAction($parameter,$sender)
		{
				fRefresh("","page","Config_Page.frmConfigPage");
		}
		function frmActionStatus($parameter,$sender)
		{
			$o=new config_page();
			$pageID=ShowConfigPage::$Grid1->getvalues("pageID",$parameter);
			$dao=new Config_PageDao();
			$o_chk=$dao->selectById($pageID);
			$o->pageID=$o_chk->pageID;
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

			Refreshs("Config_Page.ShowConfigPage","alert","update");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new Config_PageDao();
				for($i=ShowConfigPage::$Grid1->getstart();$i<ShowConfigPage::$Grid1->getstop();$i++)
			{
				$o=new config_page();
				
				$o->pageID=ShowConfigPage::$Grid1->getvalues("pageID",$i);
				
				$o->pageIDCheck=ShowConfigPage::$Grid1->getvalues("pageIDCheck",$i);
				if($o->pageIDCheck)
				{
					if($o->pageID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->pageID="";
					}
				}
				
			}
				Refreshs("Config_Page.ShowConfigPage","alert","del");
		}
 }
?>