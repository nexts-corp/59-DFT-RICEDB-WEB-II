<?php
require_once("Project/bussiness/UserTypeDao.php");
require_once("Project/common/usertype.php");

 class  ShowUserType extends TForm
 {
	 public static $Grid1;
	 function ShowUserType()
		{
				$this->Init("ShowUserType","Register","",true);

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
				

				$dao=new UserTypeDao();
				$o=$dao->selectAll();
				
				ShowUserType::$Grid1=new TGridtable();
				ShowUserType::$Grid1->setgridtable("Grid1",$o);

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
				ShowUserType::$Grid1->addcontrol($grid);

				$usertypeName=new TLabel();
				$usertypeName->set('usertypeName',$o->usertypeName,30,30,ture,'reqstring','ชื่อ');
				$usertypeName->title='ประเภทผู้ใช้งาน';
				ShowUserType::$Grid1->addcontrol($usertypeName);


				$status=new TGridLink();
				$status->set('status',$o->status,30,30,ture,'reqstring','ชื่อ');
				$status->title='สถานะ';
				$status->setEvent("onclick","frmActionStatus");
				ShowUserType::$Grid1->addcontrol($status);
				

				ShowUserType::$Grid1->View=false;
				ShowUserType::$Grid1->Edit=true;
				ShowUserType::$Grid1->Delete=true;
				$this->Add(ShowUserType::$Grid1);


	 $this->waitevent();
		}
		
		function Grid1_View($parameter,$sender)
		{
			$value[1]=ShowUserType::$Grid1->getvalues("usertypeID",$parameter);
			//fRefresh("","page,object_id","Register.frmRegister,$value[1]");
		}
		 function Grid1_Editing($parameter,$sender)
		{
			$value[1]=ShowUserType::$Grid1->getvalues("usertypeID",$parameter);
			Refreshs("Register.frmUserType","object_id",$value[1]);
		}
		function Grid1_Deleting($parameter,$sender)
		{
			
			$o=new usertype();
			$o->usertypeID=ShowUserType::$Grid1->getvalues("usertypeID",$parameter);
			$dao=new UserTypeDao();
			$dao->deletes($o);
			Refreshs("Register.ShowUserType","alert","del");
		}
		function frmAction($parameter,$sender)
		{
				fRefresh("","page","Register.frmUserType");
		}
		function frmActionStatus($parameter,$sender)
		{
			$o=new usertype();
			$usertypeID=ShowUserType::$Grid1->getvalues("usertypeID",$parameter);
			$dao=new UserTypeDao();
			$o_chk=$dao->selectById($usertypeID);
			$o->usertypeID=$o_chk->usertypeID;
			$o->version=$o_chk->version;
			if($o_chk->status=="Open")
				$o->status="Close";
			else
				$o->status="Open";

			$dao->update($o);

			Refreshs("Register.ShowUserType","alert","update");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new UserTypeDao();
				for($i=ShowUserType::$Grid1->getstart();$i<ShowUserType::$Grid1->getstop();$i++)
			{
				$o=new usertype();
				
				$o->usertypeID=ShowUserType::$Grid1->getvalues("moduleID",$i);
				
				$o->cartoonpartIDCheck=ShowUserType::$Grid1->getvalues("cartoonpartIDCheck",$i);
				if($o->cartoonpartIDCheck)
				{
					if($o->usertypeID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->usertypeID="";
					}
				}
				
			}
				Refreshs("Register.ShowUserType","alert","del");
		}
 }
?>