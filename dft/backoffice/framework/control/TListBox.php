<?php
class TListBox extends TControl
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
			$str=$str."<SELECT NAME=\"$this->id\" id =\"$this->id\" $att $ev>";
			
			for($i=0;$i<$n;$i++)
			{
				$v=$this->item[$i]["values"];
				$d=$this->item[$i]["display"];

				if($this->values==$v)
					$str=$str. "<option value='".$v."' selected>".$d."</option>";
				else
					$str=$str. "<option value='".$v."' >".$d."</option>";
			}
			$str=$str. "</select>";

			//	$html="<table>";
		//	$html.="<tr><td>";
			$html.=$str;
			$vname="Y";
             if($this->validate==false)
                   $vname="N";
              $vname="VALIDATE_".$vname."_TB_".$this->formname."_".$this->id;
				
		//	$html.="</td>";
		//	$html.="<td><span id='".$vname."'></span></td></tr></table>";
			return $html;
		//	return $str;
		}
		
	}
	
class TListBoxMultiple extends TControl
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
			for($i=0;$i<$n;$i++)
			{
				$this->item[$i]["values"]=$objects[$i]->$fieldvalus;
				$this->item[$i]["display"]=$objects[$i]->$fieldname;

			}
		}
		function show()
		{
			$n=count($this->item);
			$att=$this->addAttribute();
			$ev=$this->addEvent("this.value");
			$str=$str."<SELECT NAME=\"$this->id[]\" id =\"$this->id\" $att $ev multiple>";
			$cv= explode(",",$this->values);
			for($i=0;$i<$n;$i++)
			{
				$v=$this->item[$i]["values"];
				$d=$this->item[$i]["display"];
				
				//msgbox($this->values[0]);
				$sele=false;
				for($j=0;$j<=$n;$j++)
				{
						if($cv[$j]==$v)
							$sele=true;
				}

				if($sele==true)
					$str=$str. "<option value='".$v."' selected>".$d."</option>";
				else
					$str=$str. "<option value='".$v."' >".$d."</option>";
				
			}
			$str=$str. "</select>";

			$html.=$str;
			$vname="Y";
             if($this->validate==false)
                   $vname="N";
              $vname="VALIDATE_".$vname."_TB_".$this->formname."_".$this->id;
			return $html;
		}
		
	}

	?>
