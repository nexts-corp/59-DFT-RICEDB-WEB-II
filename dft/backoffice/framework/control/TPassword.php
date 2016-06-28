<?php
	class TPassword extends TControl
	{
		//	var $ID;
		//	var $Value;
		var $size;
		var $max;
		var $enable;
		var $Title;
		// var $Event_onChange;		
		function show()
		{
			$att=$this->addAttribute();
			$ev=$this->addEvent("this.value");
			//$html="<table>";
			//$html.="<tr><td>";
				$vname="Y";
            if($this->validate==false)
                  $vname="N";
              $vname="VALIDATE_".$vname."_".$this->FiledType."_".$this->formname."_".$this->id;
			//$chk="this.value=format".$this->FiledType."(this.value,'".$vname."');";

			$html.="<INPUT TYPE='password' id='$this->id' NAME='$this->id' value='$this->values' $att $ev>";
			//return "<INPUT TYPE='password' id='$this->id' NAME='$this->id'  value='$this->values' $att  $ev >";
			
			//$html.="</td>";
			//$html.="<td><span id='".$vname."'></span></td></tr></table>";
			$html.="<span id='".$vname."'></span>";
			return $html;

			
		//	return $str;
		}
	}
	class TPasswordtext extends TControl
	{
		//	var $ID;
		//	var $Value;
		var $size;
		var $max;
		var $enable;
		var $Title;
		// var $Event_onChange;		
		function show()
		{
			$att=$this->addAttribute();
			$ev=$this->addEvent("this.value");

			return "<INPUT TYPE='password' id='$this->id' NAME='$this->id' onmountup='$file' value='$this->values'  title='$this->Title'  $att  $ev >";
			
		}
	}	
?>