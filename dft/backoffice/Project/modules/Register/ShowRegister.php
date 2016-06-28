<?php
require_once("Project/bussiness/RegisterDao.php");
require_once("Project/common/register.php");

require_once("Project/bussiness/UserDao.php");
require_once("Project/common/user.php");

require_once("Project/bussiness/UserTypeDao.php");
require_once("Project/common/usertype.php");

require_once("Project/bussiness/SubModuleDao.php");
require_once("Project/common/submodule.php");

require_once("Project/bussiness/PermissDao.php");
require_once("Project/common/permiss.php");

 class  ShowRegister extends TForm
 {
	 public static $Grid1;
	 function ShowRegister()
		{
	 $this->Init("ShowRegister","Register","",true);
		
				$dao_submodule=new SubModuleDao();
				$o_submodule=$dao_submodule->selectAllBySystem("learning_course");
				
				$dao_per=new PermissDao();
				$o_per=$dao_per->selectAllByPermiss($o_submodule[0]->submoduleID,$_SESSION["Session_User_UsertypeID"]);

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


				$dao=new RegisterDao();
				$dao_user=new UserDao();
				$dao_usertype=new UserTypeDao();

				

							$o=$dao->selectAllSql();

					
						

				ShowRegister::$Grid1=new TGridtable();
				ShowRegister::$Grid1->setgridtable("Grid1",$o);

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

						

						$o_user=$dao_user->selectByIdUser($o[$i]->registerID);
				}
				
				$grid=new TCheckbox();
				$grid->set('cartoonpartIDCheck',"","","40",ture,'reqstring',false);
				$grid->additem(" ","");
				$grid->title=' ';
				ShowRegister::$Grid1->addcontrol($grid);

				$registerID=new TLabel();
				$registerID->set('registerID',$o->registerID,30,30,ture,'reqstring','ชื่อ');
				$registerID->title='รหัสสมาชิก';
				ShowRegister::$Grid1->addcontrol($registerID);

				$registerName=new TLabel();
				$registerName->set('registerName',$o->registerName,30,30,ture,'reqstring','ชื่อ');
				$registerName->title='ชื่อ-นามสกุล';
				ShowRegister::$Grid1->addcontrol($registerName);

				$registerPhone=new TLabel();
				$registerPhone->set('registerPhone',$o->registerPhone,30,30,ture,'reqstring','ชื่อ');
				$registerPhone->title='เบอร์ติดต่อ';
				ShowRegister::$Grid1->addcontrol($registerPhone);

				$registerEmail=new TLabel();
				$registerEmail->set('registerEmail',$o->registerEmail,30,30,ture,'reqstring','ชื่อ');
				$registerEmail->title='อีเมล์';
				ShowRegister::$Grid1->addcontrol($registerEmail);
				

				$creationTime=new TLabel();
				$creationTime->set('usertypeName',$o->usertypeName,30,30,ture,'reqstring','ชื่อ');
				$creationTime->title='ประเภท';
				ShowRegister::$Grid1->addcontrol($creationTime);

				$status=new TGridLink();
				$status->set('status',$o->status,30,30,ture,'reqstring','ชื่อ');
				$status->title='สถานะ';
				$status->setEvent("onclick","frmActionStatus");
				ShowRegister::$Grid1->addcontrol($status);
				

				ShowRegister::$Grid1->View=false;
				ShowRegister::$Grid1->Edit=true;
				ShowRegister::$Grid1->Delete=true;
				$this->Add(ShowRegister::$Grid1);


	 $this->waitevent();
		}
		function showByStatus($parameter,$sender){

				$showStatus=$sender->getvalue('showStatus');
		Refreshs("Register.ShowRegister","object_id",$showStatus);


		}
		function Grid1_rowperpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowRegister::$Grid1->gotopage($v[1]);
			ShowRegister::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowRegister::$Grid1->gotopage($v[1]);
			ShowRegister::$Grid1->changenumpage($v[0]);
		}

		function Grid1_View($parameter,$sender)
		{
			$value[1]=ShowRegister::$Grid1->getvalues("registerID",$parameter);
			//fRefresh("","page,object_id","Register.frmRegister,$value[1]");
		}
		 function Grid1_Editing($parameter,$sender)
		{
			$value[1]=ShowRegister::$Grid1->getvalues("registerID",$parameter);
			Refreshs("Register.frmRegister","object_id",$value[1]);
		}
		function Grid1_Deleting($parameter,$sender)
		{
			
			$o=new register();
			$o->registerID=ShowRegister::$Grid1->getvalues("registerID",$parameter);
			$dao=new RegisterDao();
			$dao->deletes($o);

			$o_use=new user();
			$dao_user=new UserDao();
			$o_user=$dao_user->selectByIdUser($o->registerID);
			$o_use->userID=$o_user[0]->userID;
			$dao_user->deletes($o_use);

			Refreshs("Register.ShowRegister","alert","del");
		}
		function frmAction($parameter,$sender)
		{
				fRefresh("","page","Register.frmRegister");
		}

		function frmActionStatus($parameter,$sender)
		{
			$o=new register();
			$registerID=ShowRegister::$Grid1->getvalues("registerID",$parameter);
			$dao=new RegisterDao();
			$o_chk=$dao->selectById($registerID);
			$o->registerID=$o_chk->registerID;
			$o->version=$o_chk->version;
			if($o_chk->status=="Open")
				$o->status="Close";
			else
				$o->status="Open";

			$dao->update($o);

			Refreshs("Register.ShowRegister","alert","update");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new RegisterDao();
				for($i=ShowRegister::$Grid1->getstart();$i<ShowRegister::$Grid1->getstop();$i++)
			{
				$o=new register();
				
				$o->registerID=ShowRegister::$Grid1->getvalues("registerID",$i);
				
				$o->cartoonpartIDCheck=ShowRegister::$Grid1->getvalues("cartoonpartIDCheck",$i);
				if($o->cartoonpartIDCheck)
				{
					if($o->registerID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->usertypeID="";
					}
				}
				
			}
				Refreshs("Register.ShowRegister","alert","del");
		}

 }
?>