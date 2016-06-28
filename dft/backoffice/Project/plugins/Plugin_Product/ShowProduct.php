<?php
require_once("Project/plugins/Plugin_Product/Dao/Plugin_ProductDao.php");
require_once("Project/plugins/Plugin_Product/Common/plugin_product.php");


 class  ShowProduct extends TForm
 {
	 public static $Grid1;
	 function ShowProduct()
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
				$this->Init("ShowProduct","Plugin_Product","",true);
						
					
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

				$ptID1=$this->getdata('ptID');


				$form=new THidden();
				$form->set('ptID',$ptID1,30,30,true,"String",false); 
				$this->add($form);

			
				$dao=new Plugin_ProductDao();
				$o=$dao->selectAllbyPtID($ptID1);
				
				ShowProduct::$Grid1=new TGridtable();
				ShowProduct::$Grid1->setgridtable("Grid1",$o);

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
						$o[$i]->producttypeName=$o_product_type->producttypeName;
						$o[$i]->product="<span class=\"label label-info\">เพิ่มภาพสินค้า</span>";

				}

				$grid=new TCheckbox();
				$grid->set('cartoonpartIDCheck',"","","40",ture,'reqstring',false);
				$grid->additem(" ","");
				$grid->title=' ';
				ShowProduct::$Grid1->addcontrol($grid);
				
				$grid=new TLabel();
				$grid->set('productName',"","","",true,"",false);
				$grid->title='ชื่อสินค้า';
				ShowProduct::$Grid1->addcontrol($grid);

				$grid=new TLabel();
				$grid->set('productPrice',"","","",true,"",false);
				$grid->title='ราคาเต็ม';
				ShowProduct::$Grid1->addcontrol($grid);

				$grid=new TLabel();
				$grid->set('productDiscount',"","","",true,"",false);
				$grid->title='ส่วนลด';
				ShowProduct::$Grid1->addcontrol($grid);

				$product=new TGridLink();
				$product->set('product',$o->product,30,30,ture,'reqstring','ชื่อ');
				$product->title='จัดการภาพสินค้า';
				$product->setEvent("onclick","frmActionImg");
				ShowProduct::$Grid1->addcontrol($product);

				$status=new TGridLink();
				$status->set('status',$o->status,"","","true","","");
				$status->title='สถานะ';
				$status->setEvent("onclick","frmActionStatus");
				ShowProduct::$Grid1->addcontrol($status);

				ShowProduct::$Grid1->View=false;
				ShowProduct::$Grid1->Edit=$o_per[0]->permissEdit;
				ShowProduct::$Grid1->Delete=$o_per[0]->permissDel;
				$this->Add(ShowProduct::$Grid1);


	 $this->waitevent();
		}
		function Grid1_rowperpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowProduct::$Grid1->gotopage($v[1]);
			ShowProduct::$Grid1->changenumpage($v[0]);
		 }
		 function Grid1_nextpage($parameter,$sender)
		{
			$v=explode(",",$parameter);
			ShowProduct::$Grid1->gotopage($v[1]);
			ShowProduct::$Grid1->changenumpage($v[0]);
		}
		function Grid1_View($parameter,$sender)
		{
			//$value[1]=ShowProduct::$Grid1->getvalues("moduleID",$parameter);
			//fRefresh("","page,object_id","Register.frmRegister,$value[1]");
		}
		 function Grid1_Editing($parameter,$sender)
		{
			$value[1]=ShowProduct::$Grid1->getvalues("productID",$parameter);
			Refreshs("Plugin_Product/frmProduct","object_id",$value[1]);
		}
		function Grid1_Deleting($parameter,$sender)
		{
			$o=new plugin_product();
			$o->newID=ShowProduct::$Grid1->getvalues("productID",$parameter);

			$dao=new Plugin_ProductDao();
			$dao->deletes($o);
			Refreshs("Plugin_Product/ShowProduct","alert","del");
		}
			 function frmActionImg($parameter,$sender)
		{
			$productID=ShowProduct::$Grid1->getvalues("productID",$parameter);
			Refreshs("Plugin_Product/ShowGallery&productID=".$productID,"object_id",$value[1]);
		}
		function frmAction($parameter,$sender)
		{		
				$ptID=$sender->getvalue('ptID');
				fRefresh("","page","Plugin_Product/frmProduct&ptID=".$ptID);
		}
		function frmActionStatus($parameter,$sender)
		{
			$o=new plugin_product();
			$productID=ShowProduct::$Grid1->getvalues("productID",$parameter);
			
			$dao=new Plugin_ProductDao();
			$o_chk=$dao->selectById($productID);
			$o->productID=$o_chk->productID;
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

			Refreshs("Plugin_Product/ShowProduct","alert","update");
		}
		function frmDelAll($parameter,$sender)
		{
			$dao=new Plugin_ProductDao();

			for($i=ShowProduct::$Grid1->getstart();$i<ShowProduct::$Grid1->getstop();$i++)
			{
				$o=new plugin_product();
				
				$o->productID=ShowProduct::$Grid1->getvalues("productID",$i);
				
				$o->cartoonpartIDCheck=ShowProduct::$Grid1->getvalues("cartoonpartIDCheck",$i);
				if($o->cartoonpartIDCheck)
				{
					if($o->productID)
					{
						$dao->deletes($o);
						$o->version="";
						$o->productID="";
					}
				}
				
			}
				Refreshs("Plugin_Product/ShowProduct","alert","del");
		}
		
 }
?>