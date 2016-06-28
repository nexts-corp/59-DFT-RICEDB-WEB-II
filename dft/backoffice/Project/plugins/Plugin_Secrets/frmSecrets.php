<?php
require_once("Project/bussiness/Plugin_SecretsDao.php");
require_once("Project/common/plugin_secrets.php");

 class frmSecrets extends TForm
 {
	 	
		function frmSecrets()
		{
			$dao_submodule=new SubModuleDao();
				$o_submodule=$dao_submodule->selectAllBySystem("plugin_secrets");

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
				$this->Init("frmSecrets","Plugin_Secrets","form-horizontal row-border",true);
			
			$obj=$this->getdata("object_id");
			
			
			$dao=new Plugin_SecretsDao();
			$o=$dao->selectById($obj);
			
			$form=new THidden();
			$form->set('secretsID',$o->secretsID,30,30,true,"String",false); 
			$this->add($form);

			$version=new THidden();
			$version->set('version',$o->version,30,30,true,"String",false); 
			$this->add($version);


			$form=new TTextBox();
			$form->set('nameInfo',$o->nameInfo,"","",true,"String",true); 
			$form->setAttribute("class","form-control ");
			$form->setAttribute("placeholder","หัวข้อ");
			$this->add($form);

			$form=new TTextBox();
			$form->set('urlInfo',$o->urlInfo,"","",true,"String",true); 
			$form->setAttribute("class","form-control");
			$form->setAttribute("placeholder","url");
			$this->add($form);

			$form=new TCheckBox();
			$form->set('level1',$o->level1,"","",true,"String",false);
			$form->additem("true","สาธารณะ");
			$form->setAttribute("class","uniform");
			$this->add($form);

			$form=new TCheckBox();
			$form->set('level2',$o->level2,"","",true,"String",false);
			$form->additem("true","ลับปกติ");
			$form->setAttribute("class","uniform");
			$this->add($form);

			$form=new TCheckBox();
			$form->set('level3',$o->level3,"","",true,"String",false);
			$form->additem("true","ลับมาก");
			$form->setAttribute("class","uniform");
			$this->add($form);

			$form=new TCheckBox();
			$form->set('level4',$o->level4,"","",true,"String",false);
			$form->additem("true","ลับที่สุด");
			$form->setAttribute("class","uniform");
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
				$o=new plugin_secrets();
				$o->secretsID=$sender->getvalue('secretsID');
				$o->version=$sender->getvalue('version');

				$o->nameInfo=$sender->getvalue('nameInfo');
				$o->urlInfo=$sender->getvalue('urlInfo');
				$level1=$sender->getvalue('level1');
				$level2=$sender->getvalue('level2');
				$level3=$sender->getvalue('level3');
				$level4=$sender->getvalue('level4');

				if($level1){
					$o->level1="true";
				}else{
					$o->level1="false";
				}
				
				if($level2){
					$o->level2="true";
				}else{
					$o->level2="false";
				}

				if($level3){
					$o->level3="true";
				}else{
					$o->level3="false";
				}

				if($level4){
					$o->level4="true";
				}else{
					$o->level4="false";
				}
				
				$o->status=$sender->getvalue('status');
				$o->creationUser=$_SESSION["Session_User_UserID"];
				
				$dao=new Plugin_SecretsDao();

				if($o->secretsID)
			{
				$dao->update($o);
				Refreshs("Plugin_Secrets/ShowSecrets","alert","update");
			}
			
				$dao->save($o);
				Refreshs("Plugin_Secrets/ShowSecrets","alert","save");
					
			
		}
 }

?>