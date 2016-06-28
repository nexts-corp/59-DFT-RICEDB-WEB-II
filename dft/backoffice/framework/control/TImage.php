<?php
	class TImage extends TControl
	{
		//var $ID;
	//	var $Value;
		var $size;
		var $max;
		var $enable;
		var $width;
		var $height;
	//	var $Event_onChange;		
		function show()
		{
			$att=$this->addAttribute();
			$ev=$this->addEvent("this.value");
			$str="<INPUT TYPE='image' id='$this->id' NAME='$this->id' SRC='$this->values' $att $ev width='$this->width' height='$this->height'>";
			return $str;
		}
	}	
	
	class TImageDetail extends TControl
	{
		//var $ID;
	//	var $Value;
		var $size;
		var $max;
		var $enable;
	//	var $Event_onChange;		
		function show()
		{
			
			$att=$this->addAttribute();
			$ev=$this->addEvent("this.value");
			$html="<table>";
			$html.="<tr><td>";
			$vname="Y";
             if($this->validate==false)
                   $vname="N";
              $vname="VALIDATE_".$vname."_TB_".$this->formname."_".$this->id;
			$chk="this.value=format".$this->FiledType."(this.value,'".$vname."');";

			$str="<center><INPUT TYPE='image' id='$this->id' NAME='$this->id' SRC='$this->values' $att $ev></center><br><center>$de</center>";

			$html.=$str;
			
			$html.="</td>";
			$html.="<td><span id='".$vname."'></span></td></tr></table>";
			return $html;

			
		//	return $str;
		}
	}	
?>