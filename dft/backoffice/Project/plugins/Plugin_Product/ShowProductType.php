<?php
require_once("Project/plugins/Plugin_Product/Dao/Plugin_Product_TypeDao.php");
require_once("Project/plugins/Plugin_Product/Common/plugin_product_type.php");

 class  ShowProductType extends TForm
 {
	 public static $Grid1;
	 function ShowProductType()
		{
	
			$dao_submodule=new SubModuleDao();
			$o_submodule=$dao_submodule->selectAllBySystem("plugin_product");

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
				$this->Init("ShowProductType","Plugin_Product","",true);
						
					
				$alert=$this->getdata("alert");

				if($alert)
				{
						$alertmsg=new TLabel();
						$alertmsg->set("alertmsg",alerts($alert),"","",true,"","");
						$this->add($alertmsg);
				}
				
				if($o_per[0]->permissAdd=="true")
				{
					$bn=new TButton();
					$bn->set("bn"," เพิ่มข้อมูลใหม่","","",true,"","");
					$bn->setEvent("onclick","frmAction");
					$bn->setAttribute("class","btn btn-xs btn-primary");
					$this->Add($bn);
				}
				
				if($o_per[0]->permissDel=="true")
				{
					$bndelgrid=new TButton();
					$bndelgrid->set("bndelgrid"," ลบข้อมูล","","",true,"","");
					$bndelgrid->setEvent_Confirm("onclick","frmDelAll",true,"คุณต้องการลบข้อมูลใช่หรือไม่");
					$bndelgrid->setAttribute("class","btn btn-xs btn-danger");
					$this->Add($bndelgrid);
				}

		
				
				$dao=new Plugin_Product_TypeDao();
				$o=$dao->selectAll();
				
				ShowProductType::$Grid1=new TGridtable();
				ShowProductType::$Grid1->setgridtable("Grid1",$o);

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
						$img=str_replace('Img', 'Thumbs', $o[$i]->ptImg);
						$o[$i]->ptImgD="<img src='".$img."' width='70px'  />";
						$o[$i]->product="<span class=\"label label-info\">เพิ่มสินค้า</span>";

				}

				
				$grid=new TLabel();
				$grid->set('ptImgD',$o->ptImg,30,30,ture,'reqstring','ชื่อ');
				$grid->title='ภาพ';
				ShowProductType::$Grid1->addcontrol($grid);

				$grid=new TLabel();
				$grid->set('ptTitle',$o->ptTitle,30,30,ture,'reqstring','ชื่อ');
				$grid->title='title';
				ShowProductType::$Grid1->addcontrol($grid);

				$product=new TGridLink();
				$product->set('product',$o->product,30,30,ture,'reqstring','ชื่อ');
				$product->title='จัดการสินค้า';
				$product->setEvent("onclick","frmActionproduct");
				ShowProductType::$Grid1->addcontrol($product);

				$status=new TGridLink();
				$status->set('status',$o->status,30,30,ture,'reqstring','ชื่อ');
				$status->title='สถานะ';
				$status->setEvent("onclick","frmActionStatus");
				ShowProductType::$Grid1->addcontrol($status);

				ShowProductType::$Grid1->View=false;
				ShowProductType::$Grid1->Edit=$o_per[0]->permissEdit;
				ShowProductType::$Grid1->Delete=$o_per[0]->permissDel;
				$this->Add(ShowProductType::$Grid1);

	 $this->waitevent();
		}
		function Grid1_rowperpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowProductType::$Grid1->gotopage($v[1]);
			ShowProductType::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowProductType::$Grid1->gotopage($v[1]);
			ShowProductType::$Grid1->changenumpage($v[0]);
		}
		function Grid1_View($parameter,$sender)
		{
			$value[1]=ShowProductType::$Grid1->getvalues("usertypeID",$parameter);
			//fRefresh("","page,object_id","Register.frmRegister,$value[1]");
		}
		 function Grid1_Editing($parameter,$sender)
		{
			$value[1]=ShowProductType::$Grid1->getvalues("ptID",$parameter);
			Refreshs("Plugin_Product/frmProductType","object_id",$value[1]);
		}
		 function frmActionproduct($parameter,$sender)
		{
			$ptID=ShowProductType::$Grid1->getvalues("ptID",$parameter);
			Refreshs("Plugin_Product/ShowProduct&ptID=".$ptID,"",$value[1]);
		}
		function Grid1_Deleting($parameter,$sender)
		{
			
			$o=new plugin_product_type();
			$o->ptID=ShowProductType::$Grid1->getvalues("ptID",$parameter);
			$dao=new Plugin_Product_TypeDao();
			$dao->deletes($o);
			Refreshs("Plugin_Product/ShowProductType","alert","del");
		}
		function frmAction($parameter,$sender)
		{
				fRefresh("","page","Plugin_Product/frmProductType");
		}
		function frmActionStatus($parameter,$sender)
		{
			$o=new plugin_product_type();
			$ptID=ShowProductType::$Grid1->getvalues("ptID",$parameter);
			$dao=new Plugin_Product_TypeDao();
			
			$o_chk=$dao->selectById($ptID);
			$o->ptID=$o_chk->ptID;
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

			Refreshs("Plugin_Product/ShowProductType","alert","update");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new Plugin_Product_TypeDao();

			for($i=ShowProductType::$Grid1->getstart();$i<ShowProductType::$Grid1->getstop();$i++)
			{
				$o=new plugin_product_type();
				
				$o->ptID=ShowProductType::$Grid1->getvalues("ptID",$i);
				
				$o->cartoonpartIDCheck=ShowProductType::$Grid1->getvalues("cartoonpartIDCheck",$i);
				if($o->cartoonpartIDCheck)
				{
					if($o->ptID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->ptID="";
					}
				}
				
			}
				Refreshs("Plugin_Product/ShowProductType","alert","del");
		}
 }
?>