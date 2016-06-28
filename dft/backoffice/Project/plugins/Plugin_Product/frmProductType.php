<?php
require_once("Project/plugins/Plugin_Product/Dao/Plugin_Product_TypeDao.php");
require_once("Project/plugins/Plugin_Product/Common/plugin_product_type.php");

 class frmProductType extends TForm
 {
	 	
		function frmProductType()
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
			$this->Init("frmProductType","Plugin_Product","form-horizontal",true);
			
			$obj=$this->getdata("object_id");
			
		
			$dao=new Plugin_Product_TypeDao();
			$o=$dao->selectById($obj);
			
			$form=new THidden();
			$form->set('ptID',$o->ptID,30,30,true,"String",false); 
			$this->add($form);

			$form=new THidden();
			$form->set('version',$o->version,30,30,true,"String",false); 
			$this->add($form);
			
			$form=new TTextBox();
			$form->set('ptTitle',$o->ptTitle,"","",true,"String",true);
			$form->setAttribute("class","form-control");
			$this->add($form);

			

			$form=new TSummereditor();
			$form->set('ptTitleDetails',$o->ptTitleDetails,"","",true,"String",true);
			$this->add($form);

			$form=new TInputfile();
			$form->set('ptImg',$o->ptImg,30,30,true,"String",false);
			$this->add($form);

			
			
			$status=new TListBox();
			$status->set('status',$o->status,"","",true,"String",true); 
			$status->additem("Open","เปิดการใช้งาน");
			$status->additem("Close","ปิดการใช้งาน");
			$this->add($status);
			
			
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
				$o=new plugin_product_type();
				$o->ptID=$sender->getvalue('ptID');
				$o->version=$sender->getvalue('version');
				$o->ptTitle=$sender->getvalue('ptTitle');
				$ptTitleDetails=$sender->getvalue('ptTitleDetails');

				$o->ptTitleDetails=str_replace("'", "\'", $ptTitleDetails);
					
					$userfile=$sender->getvalue('ptImg');
			
					$Datef=Date("d-m-y");
					$Timef=Date("H-i-s");
					$Datef=ereg_replace("-","",$Datef);
					$Timef=ereg_replace("-","",$Timef); 
					$Fname="fileimg_".$Datef."_".$Timef;

				$o->ptImg=uploadFileTwo(0,"./Upload/File",$Fname,$userfile);


				
				$o->status=$sender->getvalue('status');
				$o->creationUser=$_SESSION["Session_User_UserID"];
			
				$dao=new Plugin_Product_TypeDao();
				if($o->ptID)
			{
				$dao->update($o);
				Refreshs("Plugin_Product/ShowProductType","alert","update");
				}
				else
			{
					$dao->save($o);
				Refreshs("Plugin_Product/ShowProductType","alert","save");
					
				}
		}
 }

?>