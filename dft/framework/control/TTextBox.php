<?php
	class TTextBox extends TControl
	{

		var $Title;

		function show()
		{
			$att=$this->addAttribute();
			$ev=$this->addEvent("this.value");
			
			$typevalidate=$this->FiledType;
			
			$vname="Y";
             if($this->validate==false)
             $vname="N";
				$vname="VALIDATE_".$vname."_".$typevalidate."_".$this->formname."_".$this->id;

			$html.="<INPUT TYPE='text' id='$this->id' NAME='$this->id'  value='$this->values'  $att  $ev>";
			
			$html.="<span id='".$vname."'></span>";
			return $html;
		}
	}
	class TTextBoxtext extends TControl
	{

		var $Title;

		function show()
		{
			$att=$this->addAttribute();
			
			$ev=$this->addEvent("this.value");

			$html.="<INPUT TYPE='text' id='$this->id' NAME='$this->id'  value='$this->values'  title='$this->Title'   $att  $ev>";
			return $html;
		}
	}	
?>