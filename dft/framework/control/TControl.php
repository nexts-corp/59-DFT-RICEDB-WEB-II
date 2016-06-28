<?php
	class TControl
	{
		var $id ;
		var $title;
		//var $name ;
	    var $values;
		var $attrname;
		var $attrvalue;
		var $eventAjax;
		var $eventname;
		var $eventvalue;
		var $eventconfirm;
		var $eventconfirmValue;
		var $formname;
		var $rowindex;
		//Edit by aek 20-07-2009 : แก้ไขการ set Attribute
		var $addFile;
		var $enable = true;
		var $class = "";
		var $style = "";
		var $readonly = false;
		var $alert = "";
		var $FiledType="String";
		public $validate=true;
		public $validate2=true;
		var $targetId;
		/*		var $accesskey ;		var $class;		var $disabled ;				var $lang;
		var $maxlength ;				var $onblur ;		var $onchange;         var $onclick;
		var $ondatabinding;		var $ondblclick;		var $ondisposed;		var $onfocus;
		var $oninit;		var $onkeydown;		var $onkeypress;         var $onkeyup ;
		var $onload ;		var $onmousedown ;		var $onmousemove ;		var $onmouseout ;
		var $onmouseover ;		var $onmouseup ;		var $onprerender;        var $onselect;
		var $onserverchange;		var $onunload ;		var $readonly ;		var $size ;
		var $tabindex;		var $title;				var $visible;		var $style;  */
		
		function set($id,$values,$length,$size,$enable,$FiledType,$validate)
		{
			$this->id=$id;
			$this->values=$values;
			$this->FiledType=$FiledType;
			/*
			if($length)
				$this->setAttribute("maxlength",$length);
			if($size)
				$this->setAttribute("size",$size);
			//if($enable==false)
			//{
			//	$this->setAttribute("disabled",true);
				//$this->setAttribute("style","background-color:#DDDDDD;border:solid 1px #999999;height:22px;");
				//$this->setAttribute("ReadOnly","true");
			//}
				//if($class)
			//	$this->setAttribute("class",$class);
			if($alert)
				$this->setAttribute("alt",$alert);
			*/
			
			//Edit by aek 20-07-2009 : แก้ไขการ set Attribute
			$this->length = $length;
			$this->size = $size;
			$this->enable = $enable;
			//$this->class = $class;
			$this->style = $style;
			$this->readonly = $readonly;
			$this->validate = $validate;

				
		
			
		}
	
	 function setAttribute($attname,$attvalue)
		{
				$n=count($this->attrname);
				$this->attrname[$n]=$attname;
				$this->attrvalue[$n]=$attvalue;

		}
		
		 function setEvent($Ename,$Evalue)
		{
				$n=count($this->eventname);
				$this->eventname[$n]=$Ename;
				$this->eventvalue[$n]=$Evalue;
				$this->eventconfirm[$n]=false;
				$this->eventAjax[$n]=false;

				
		}
		 function setEventWithAjax($Ename,$Evalue,$targetId)
		{
				$n=count($this->eventname);
				$this->eventname[$n]=$Ename;
				$this->eventvalue[$n]=$Evalue;
				$this->eventconfirm[$n]=false;
				$this->eventAjax[$n]=true;
				$this->targetId[$n]=$targetId;
				
		}
		function setEvent_Confirm($Ename,$Evalue,$confirm,$Msg)
		{
			
				$n=count($this->eventname);
				$this->eventname[$n]=$Ename;
				$this->eventvalue[$n]=$Evalue;
				$this->eventconfirm[$n]=$confirm;
				$this->eventconfirmValue[$n]=$Msg;
				$this->eventAjax[$n]=false;
			//	echo $confirm;
		}
		
		function addAttribute()
		{	
			if($this->length)
				$this->setAttribute("maxlength",$this->length);
				
			if($this->size)
				$this->setAttribute("size",$this->size);
				
			if($this->enable == false)
				$this->setAttribute("disabled",true);
			
			if($this->class)
				$this->setAttribute("class",$this->class);
				
			if($this->style)
				$this->setAttribute("style",$this->style);
				
			if($this->readonly)
				$this->setAttribute("readonly",$this->readonly);
				
			if($this->alert)
				$this->setAttribute("alt",$this->alert);
			
			$na=count($this->attrname);
			$att="";
			for($i=0;$i<$na;$i++)
			{
				$att= $att." ". $this->attrname[$i]  ."='". $this->attrvalue[$i] ."'";
				
			}
			//echo $att;
			return $att;
		}

		function addEvent($getvalue)
		{	
			$na=count($this->eventname);
			$ev="";
			for($i=0;$i<$na;$i++)
			{
				if($this->validate==true && $this->validate2==true){
					if($this->eventconfirm[$i]==true){
						$ev=" ".$this->eventname[$i] ."=\"if(ConfirmMsg('".$this->eventconfirmValue[$i]."')){ javascript:setTimeout('__doPostBack_".$this->formname."(\'".$this->eventvalue[$i]."\',\''+".$getvalue."+'\')', 0)}\"";
					}
					else if($this->eventAjax[$i]==true){
						$ev=" ".$this->eventname[$i] ."=\"javascript:setTimeout('__doPostBackWithAjax_".$this->formname."(\'".$this->id."\',\'".$this->targetId[$i]."\',\'".$this->eventvalue[$i]."\',\''+".$getvalue."+'\')', 0)\"";
					}
					else
					{
						$ev=" ".$this->eventname[$i] ."=\"javascript:setTimeout('__doPostBack_".$this->formname."(\'".$this->eventvalue[$i]."\',\''+".$getvalue."+'\')', 0)\"";
						
					}
				}

				else
				{
						if($this->eventconfirm[$i]==true){
							$ev=" ".$this->eventname[$i] ."=\"if(ConfirmMsg('".$this->eventconfirmValue[$i]."')){ javascript:setTimeout('__doPostBack2_".$this->formname."(\'".$this->eventvalue[$i]."\',\''+".$getvalue."+'\')', 0)}\"";
						}
						else if($this->eventAjax[$i]==true){
						$ev=" ".$this->eventname[$i] ."=\"javascript:setTimeout('__doPostBackWithAjax_".$this->formname."(\'".$this->id."\',\'".$this->targetId[$i]."\',\'".$this->eventvalue[$i]."\',\''+".$getvalue."+'\')', 0)\"";
					}
						else
						{
								$ev=" ".$this->eventname[$i] ."=\"javascript:setTimeout('__doPostBack2_".$this->formname."(\'".$this->eventvalue[$i]."\',\''+".$getvalue."+'\')', 0)\"";
							
						}
					
				}
			}
			return $ev;
		}
		function addEventValue($value)
		{	
			$na=count($this->eventname);
			$ev="";
			//echo $value;

			for($i=0;$i<$na;$i++)
			{
				if($this->validate==true){
				if($this->eventconfirm[$i]==true){
				$ev=" ".$this->eventname[$i] ."=\"if(ConfirmMsg('".$this->eventconfirmValue[$i]."')){javascript:setTimeout('__doPostBack_".$this->formname."(\'".$this->eventvalue[$i]."\',\'$value\')', 0)}\"";
				
				}
				else
				{
					$ev=" ".$this->eventname[$i] ."=\"javascript:setTimeout('__doPostBack2_".$this->formname."(\'".$this->eventvalue[$i]."\',\'$value\')', 0)\"";
					
				}
				}
				else
				{
						if($this->eventconfirm[$i]==true){
				$ev=" ".$this->eventname[$i] ."=\"if(ConfirmMsg('".$this->eventconfirmValue[$i]."')){javascript:setTimeout('__doPostBack2_".$this->formname."(\'".$this->eventvalue[$i]."\',\'$value\')', 0)}\"";

				}
				else
				{
					$ev=" ".$this->eventname[$i] ."=\"javascript:setTimeout('__doPostBack2_".$this->formname."(\'".$this->eventvalue[$i]."\',\'$value\')', 0)\"";
				}
					
				}
			}
			return $ev;
		}
		function set_defualt($values)
		{
			$this->values=$values;
		}
	}
	include("framework/control/TForm.php");
	include("framework/control/TTextBox.php");
	include("framework/control/TListBox.php");
	include("framework/control/TPassword.php");
	include("framework/control/TRadio.php");
	include("framework/control/TCheckBox.php");
	include("framework/control/TTextarea.php");
	include("framework/control/TInputfile.php");
	include("framework/control/THidden.php");
	include("framework/control/TInputdate.php");
	include("framework/control/TImage.php");
	include("framework/control/TSubmit.php");
	include("framework/control/TResets.php");
	include("framework/control/TButton.php");
	include("framework/control/TGridview.php");
	include("framework/control/TGridtable.php");
	include("framework/control/TLabel.php");
	include("framework/control/TLink.php");
	include("framework/control/TMenu.php");
	include("framework/control/TPage.php"); 
	include("framework/control/TPanel.php"); 
	include("framework/control/TFancybox.php"); 
	include("framework/control/TSummereditor.php"); 
	include("framework/control/TDialogBox.php");
	include("framework/control/TListBoxCostom.php");

	
?>