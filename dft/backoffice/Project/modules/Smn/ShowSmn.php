<?php
require_once("Project/modules/Smn/Dao/Multi_MediaDao.php");
require_once("Project/modules/Smn/Common/multi_media.php");


 class  ShowSmn extends TForm
 {
	 public static $Grid1;
	 function ShowSmn()
		{
	
		

				$this->Init("ShowSmn","Smn","",true);
						
					
				$alert=$this->getdata("alert");

				$dao=new Multi_MediaDao();
				$o=$dao->selectAll();
				

				ShowSmn::$Grid1=new TGridtable();
				ShowSmn::$Grid1->setgridtable("Grid1",$o);

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
				

					//$o[$i]->part="xxx";
					$part="http://viptourthai.com/backoffice/Upload/Smn/";
					$o[$i]->multiUrl="<img src=".$part."".$o[$i]->multiUrl." width='70px;' height='70px;'>";

				}

			

				$grid=new TLabel();
				$grid->set('multiUrl',$o->multiUrl,30,30,ture,'reqstring','ชื่อ');
				$grid->title='ชื่อภาพ';
				ShowSmn::$Grid1->addcontrol($grid);

			
				$status=new TGridLink();
				$status->set('status',$o->status,30,30,ture,'reqstring','ชื่อ');
				$status->title='สถานะ';
				$status->setEvent("onclick","frmActionStatus");
				ShowSmn::$Grid1->addcontrol($status);

				ShowSmn::$Grid1->View=false;
				ShowSmn::$Grid1->Delete=true;
				$this->Add(ShowSmn::$Grid1);

	 $this->waitevent();
		}
		function Grid1_rowperpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowSmn::$Grid1->gotopage($v[1]);
			ShowSmn::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowSmn::$Grid1->gotopage($v[1]);
			ShowSmn::$Grid1->changenumpage($v[0]);
		}
		function Grid1_View($parameter,$sender)
		{
			$value[1]=ShowSmn::$Grid1->getvalues("usertypeID",$parameter);
			//fRefresh("","page,object_id","Register.frmRegister,$value[1]");
		}
	
		function Grid1_Deleting($parameter,$sender)
		{
			
			$o=new multi_media();
			$o->multiId=ShowSmn::$Grid1->getvalues("multiId",$parameter);
			$dao=new Multi_MediaDao();
			$dao->deletes($o);
			Refreshs("Smn.ShowSmn","alert","del");
		}
		
		
		
		function frmActionStatus($parameter,$sender)
		{
			$o=new multi_media();
			$multiId=ShowSmn::$Grid1->getvalues("multiId",$parameter);

			$dao=new Multi_MediaDao();
			
			$o_chk=$dao->selectById($multiId);
			$o->multiId=$o_chk->multiId;
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

			Refreshs("Smn.ShowSmn","alert","update");
		}
 }
?>