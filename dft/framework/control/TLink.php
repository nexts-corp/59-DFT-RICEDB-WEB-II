<?php
class TLink extends TControl
{		
		var $Linkvalue;
		function show()
		{
			$att=$this->addAttribute();
			if($this->Linkvalue)
			{
				$ev=$this->addEventValue($this->Linkvalue);
				
			}
			else
			{
				$ev=$this->addEvent("this.name");
			}
			//	echo $ev;
				
			return "<A HREF='#' id='$this->id' NAME='$this->id' $att  $ev>$this->values</A>";
			//return "$this->values";
		}
}	
class TLinkE extends TControl
{		
		var $Linkvalue;
		var $Title;
		function show()
		{
			$att=$this->addAttribute();
			//$ev=$this->addEvent("this.value");
			if($this->Linkvalue)
			{
				$ev=$this->addEventValue($this->Linkvalue);
				
			}
			else
			{
				$ev=$this->addEvent("this.value");
			}
			return "<A id='$this->id' NAME='$this->id' href='?page=".$this->Linkvalue."' $att $ev title='".$this->Title."'>$this->values</A>";
			//return "$this->values";
		}
}

class TLinkFile extends TControl
{		
		var $Linkvalue;
		function show()
		{
			$att=$this->addAttribute();
			if($this->Linkvalue)
				$ev=$this->addEventValue($this->Linkvalue);
			else
				$ev=$this->addEvent("this.name");
			return "<A id='$this->id' NAME='$this->id' href='".$this->Linkvalue."' $att $ev>$this->values</A>";
			//return "$this->values";
		}
}


class TLinkE_Bank extends TControl
{		
		var $Linkvalue;
		function show()
		{
			$att=$this->addAttribute();
			//if($this->Linkvalue)
			//	$ev=$this->addEventValue($this->Linkvalue);
			//else
			//	$ev=$this->addEvent("this.name");
			return "<A id='$this->id' NAME='$this->id' href='http://".$this->Linkvalue."' $att target='_blank'>$this->values</A>";
			//return "$this->values";
		}
}

class TGridLink extends TControl
{		
		//var $Link;
		function show()
		{
			$att=$this->addAttribute();
			$ev=$this->addEventValue($this->rowindex);

			//$ev=$this->addEvent("this.name");
			return "<A  HREF='#' id='$this->id' NAME='$this->id' $att  $ev>$this->values</A>";
			//return "$this->values";
		}
}
class TGridLinkImg extends TControl
{		
		//var $Link;
		public $LinkImage;

		function show()
		{
			$att=$this->addAttribute();
			$ev=$this->addEventValue($this->rowindex);
			//$ev=$this->addEvent("this.name");
			return "<A HREF='#' id='$this->id' NAME='$this->id' $att   $ev>$this->LinkImage</A>";
			//return "$this->values";
		}
}

class TGridLinkE extends TControl
{		
		//var $Link;
		public $Linkvalue;
		public $object_id_name;
		public $object_id_value;
		function show()
		{
			//$att=$this->addAttribute();
			//$ev=$this->addEventValue($this->rowindex);
			//$ev=$this->addEvent("this.name");
			//return "<A HREF='#' id='$this->id' NAME='$this->id' $att  $ev>$this->values</A>";
			return "<A HREF='?page=$this->Linkvalue&$this->object_id_name=$this->object_id_value'  id='$this->id' NAME='$this->id'>$this->values</A>";
			//return "$this->values";
		}
}
class TGridLink2 extends TControl
{		
		//var $Link;
		//public $const_valus="";
		public $Linkvalue;
		public $LinkImage;
		function show()
		{
			//$att=$this->addAttribute();
			//$ev=$this->addEventValue($this->rowindex);
			//$ev=$this->addEvent("this.name");
			//echo $this->const_valus;
			//if ($this->const_values=="")
		//	{
			//
			//	return "<A HREF='#' id='$this->id' NAME='$this->id' $att  $ev>$this->values</A>";
			//}
			//else
			//{
				return "<A HREF='?page=$this->Linkvalue&object_id=$this->values' id='$this->id' NAME='$this->id' >$this->LinkImage</A>";
				
			//}
			//return "$this->values";
		}
		
}	
class TGridLinkE3 extends TControl
{		
		//var $Link;
		public $Linkvalue;
		public $object_id_name;
		public $object_id_value;
		public $objectValueImg;
		function show()
		{
			//$att=$this->addAttribute();
			//$ev=$this->addEventValue($this->rowindex);
			//$ev=$this->addEvent("this.name");
			//return "<A HREF='#' id='$this->id' NAME='$this->id' $att  $ev>$this->values</A>";
			return "<A HREF='?page=$this->Linkvalue&$this->object_id_name=$this->object_id_value' id='$this->id' NAME='$this->id' >$this->objectValueImg</A>";
			//return "$this->values";
		}
	
}
?>