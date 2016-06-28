<?php
require_once("Project/plugins/Plugin_Product/Dao/Plugin_ProductDao.php");
require_once("Project/plugins/Plugin_Product/Common/plugin_product.php");


 class frmProduct extends TForm
 {
	 	
		function frmProduct()
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
				
			if($o_per[0]->permissAdd=="true")
				$this->Init("frmProduct","Plugin_Product","form-horizontal row-border",true);
			
			$obj=$this->getdata("object_id");
			
			$dao=new Plugin_ProductDao();
			$o=$dao->selectById($obj);
			
			$form=new THidden();
			$form->set('productID',$o->productID,30,30,true,"String",false); 
			$this->add($form);

			$version=new THidden();
			$version->set('version',$o->version,30,30,true,"String",false); 
			$this->add($version);

			$ptID=new THidden();
			$ptID->set('ptID',$o->ptID,30,30,true,"String",false); 
			$this->add($ptID);
		
			$form=new TTextBox();
			$form->set('productName',$o->productName,"","",true,"String",true); 
			$form->setAttribute("class","form-control input-width-xxlarge");
			$form->setAttribute("placeholder","ชื่อสินค้า");
			$this->add($form);

			$form=new TSummereditor();
			$form->set('productDetail',$o->productDetail,"","",true,"String",true);
			$form->setAttribute("placeholder","รายละเอียดสินค้า");
			$form->setAttribute("class","form-control wysiwyg");
			$this->add($form);
			
			$form=new TTextBox();
			$form->set('productPrice',$o->productPrice,"","",true,"String",true); 
			$form->setAttribute("class","form-control input-width-large");
			$form->setAttribute("placeholder","ราคาเต็ม");
			$this->add($form);

			$form=new TTextBox();
			$form->set('productDiscount',$o->productDiscount,"","",true,"String",false); 
			$form->setAttribute("class","form-control input-width-large");
			$form->setAttribute("placeholder","ลดเหลือ");
			$this->add($form);

			$form=new TTextBox();
			$form->set('productTag',$o->productTag,"","",true,"String",true); 
			$form->setAttribute("class","form-control tags");
			$this->add($form);

			$form=new TInputfile();
			$form->set('productImg',$o->productImg,"","",true,"String",false);
			$this->add($form);

			$form=new TListBox();
			$form->set('status',$o->status,"","",true,"String",true); 
			$form->additem("Open","เปิดการใช้งาน");
			$form->additem("Close","ปิดการใช้งาน");
			$form->setAttribute("class","form-control");
			$this->add($form);
			
			$bn=new TButton();
			$bn->set("bn","บันทึกข้อมูล","","",true,"String",true);
			$bn->setEvent("onclick","frmAction");
			$bn->setAttribute("class","btn btn-primary");
			$this->Add($bn);

			$bnreset=new TResets();
			$bnreset->set("bnreset","ล้างข้อมูล","","",true,"String",true);
			$bnreset->setAttribute("class","btn");
			$this->Add($bnreset);

			$this->waitevent();
		}
		function frmAction($parameter,$sender)
		{
				$o=new plugin_product();
				$o->productID=$sender->getvalue('productID');
				$o->ptID=$sender->getvalue('ptID');
				$o->version=$sender->getvalue('version');
				$o->productName=$sender->getvalue('productName');
				$o->productDetail=$sender->getvalue('productDetail');
				$o->productPrice=$sender->getvalue('productPrice');
				$o->productDiscount=$sender->getvalue('productDiscount');
				$o->productTag=$sender->getvalue('productTag');

					$userfile=$sender->getvalue('productImg');
					$Datef=Date("d-m-y");
					$Timef=Date("H-i-s");
					$Datef=ereg_replace("-","",$Datef);
					$Timef=ereg_replace("-","",$Timef); 
					$Fname="fileimg_".$Datef."_".$Timef;

				$o->productImg=uploadFileTwo(0,"./Upload/File",$Fname,$userfile);


				$o->status=$sender->getvalue('status');
				$o->creationUser=$_SESSION["Session_User_UserID"];
				
				$dao=new Plugin_ProductDao();

				if($o->productID)
			{
				$dao->update($o);
				Refreshs("Plugin_Product/ShowProduct&ptID=".$o->ptID,"alert","update");
			}
				else
			{
				$dao->save($o);
				Refreshs("Plugin_Product/ShowProduct&ptID=".$o->ptID,"alert","save");
					
			}
		}
 }

?>