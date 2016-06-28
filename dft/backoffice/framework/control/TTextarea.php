<?php
	class TTextarea extends TControl
	{
	///	var $ID;
	//	var $Value;
		var $width;
		var $height;
		var $max;
		var $enable;
	//	var $Event_onChange;		
		function show()
		{
				$att=$this->addAttribute();
				$ev=$this->addEvent("this.value");
				

			//$html="<table>";
			//$html.="<tr><td>";
			$vname="Y";
             if($this->validate==false)
                   $vname="N";
              $vname="VALIDATE_".$vname."_TB_".$this->formname."_".$this->id;
			$chk="this.value=format".$this->FiledType."(this.value,'".$vname."');";

			$str= "<TEXTAREA NAME='$this->id' rows='$this->height' cols='$this->width' id='$this->id' $att $ev>$this->values</TEXTAREA>";
			$html.=$str;
			
			$html.="<span id='".$vname."'></span>";
			//$html.="</td>";
			//$html.="<td><span id='".$vname."'></span></td></tr></table>";
			return $html;

				return $str;
		}
	}	
?>