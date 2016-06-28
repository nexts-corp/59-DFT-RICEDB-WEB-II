<?php
	class TInputfile extends TControl
	{
		var $ID;
		var $Value;
		var $size;
		var $max;
		var $enable;
		var $Event_onChange;		
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

		     $str= "<input type='file' id='$this->id' name='".$this->id."[]' imgsrc='$this->values' $att $ev >";
			 //$str= "<input type='file' id='$this->id' name='$this->id' imgsrc='$this->values' $att $ev >";

			$html.=$str;
			
			$html.="</td>";
			$html.="<td><span id='".$vname."'></span></td></tr></table>";
			return $html;

			return $str;
		
		}
	}
	class TInputfilemulti extends TControl
	{
		var $ID;
		var $Value;
		var $size;
		var $max;
		var $enable;
		var $Event_onChange;		
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

		     $str= "<input type='file' id='$this->id' name='".$this->id."[]' imgsrc='$this->values' $att $ev >";
			 //$str= "<input type='file' id='$this->id' name='$this->id' imgsrc='$this->values' $att $ev >";

			$html.=$str;
			
			$html.="</td>";
			$html.="<td><span id='".$vname."'></span></td></tr></table>";
			return $html;

			return $str;
		
		}
	}	
?>