<?php
	class TButton extends TControl
	{
		function show()
		{
			$att=$this->addAttribute();
			$ev=$this->addEvent("this.value");
			//return "<INPUT TYPE='Button' id='$this->id' NAME='$this->id' value='$this->values' $att $ev >";
			return "<button id='$this->id' NAME='$this->id' $att $ev  type='button'>$this->values</button>";
		}
	}	
?>