<?php
class TListBoxCostom extends TControl
	{
	//	var $name;
	//	var $id;
	//	var $value;
		var $Display;
		var $selected;
		var $onchange;
		var $item;
		function additem($values,$Display)
		{
				$n=count($this->item);
				$this->item[$n]["values"]=$values;
				$this->item[$n]["display"]=$Display;
		}
		function additems($item)
		{
			$this->item=$item;
		}
		function addobjects($objects,$fieldvalus,$fieldname)
		{
			$n=count($objects);
			//echo $fieldname;
			for($i=0;$i<$n;$i++)
			{
				//echo $i;
			//	echo $objects[$i]->cpn_id;
				$this->item[$i]["values"]=$objects[$i]->$fieldvalus;
				$this->item[$i]["display"]=$objects[$i]->$fieldname;

			}
		}
		function show()
		{
			$n=count($this->item);
			$att=$this->addAttribute();
			$ev=$this->addEvent("this.value");
			$str=$str."<ul NAME=\"$this->id\" id =\"$this->id\" $att $ev>";
			
			for($i=0;$i<$n;$i++)
			{
				$v=$this->item[$i]["values"];
				$d=$this->item[$i]["display"];

				if($this->values==$v)
					$str=$str. "<li value='".$v."' selected>".$d."</li>";
				else
					$str=$str. "<li value='".$v."' >".$d."</li>";
			}
			$str=$str. "</ul>";

			//	$html="<table>";
		//	$html.="<tr><td>";
			$html.=$str;
			$vname="Y";
             if($this->validate==false)
                   $vname="N";
              $vname="VALIDATE_".$vname."_TB_".$this->formname."_".$this->id;
				
		//	$html.="</td>";
			$html.="<span id='".$vname."'></span>";
			return $html;
		//	return $str;
		}
		
	}
	

		
	




?>
	