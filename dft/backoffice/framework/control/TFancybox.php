<?php

	class TFancybox extends TControl
	{

		var $FancyboxImg;
		var $FancyboxLink;
		var $FancyboxId;
		var $title;
			public $object_id_name;
			public $object_id_value;
		function show()
		{
			$att=$this->addAttribute();
			$ev=$this->addEventValue($this->rowindex);


			return "<a rel='".$this->id."' href='".$this->FancyboxLink."?$this->object_id_name=$this->object_id_value' title=".$this->title.">".$this->FancyboxImg."</a>";

			//return "<a id='aaa' $att href='".$this->FancyboxLink."'>".$this->FancyboxImg."</a>";
			
		}
	}	
?>