<?php
	class TSubmit extends TControl
	{
	//	var $ID;
	//	var $Value;
	//	var $size;
	//	var $max;
	//	var $enable;
	//	var $Event_onChange;		
		function show()
		{
			$att=$this->addAttribute();
			$ev=$this->addEvent("this.value");
			return "<input type='submit' id='$this->id' NAME='$this->id' value='$this->values' $att $ev>";
		}
		
	}	
?>