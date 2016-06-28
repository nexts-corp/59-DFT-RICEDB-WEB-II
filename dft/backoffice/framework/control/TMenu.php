<?php
class TMenu extends TControl
	{
	//	var $name;
	//	var $id;
	//	var $value;
		var $Display;
	//	var $selected;
	//	var $onchange;
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
			//$str=$str."<SELECT NAME=\"$this->id\" id =\"$this->id\" $att $ev>";
			$str=$str."<script language=\"JavaScript\">";
		     $str=$str." function mmLoadMenus() {";
			$str=$str." if (window.mm_menu_".$this->id."_".$this->formname.") return;";
			 $str=$str." window.mm_menu_".$this->id."_".$this->formname." = new Menu(\"root\",83,27,\"\",12,\"#000000\",\"#FFFFFF\",\"#CCCCCC\",\"#000084\",\"left\",\"middle\",3,0,1000,-5,7,true,false,true,0,true,true);";
			for($i=0;$i<$n;$i++)
			{
				$v=$this->item[$i]["values"];
				$d=$this->item[$i]["display"];
				 $str=$str." mm_menu_".$this->id."_".$this->formname.".addMenuItem(\"$v\",\"Location='$d'\");";
			}
			$str=$str." mm_menu_".$this->id."_".$this->formname.".hideOnMouseOut=true;";
			$str=$str." mm_menu_".$this->id."_".$this->formname.".bgColor='#555555';";
			$str=$str." mm_menu_".$this->id."_".$this->formname.".menuBorder=1;";
			$str=$str." mm_menu_".$this->id."_".$this->formname.".menuLiteBgColor='#FFFFFF';";
			$str=$str." mm_menu_".$this->id."_".$this->formname.".menuBorderBgColor='#777777';";

			$str=$str." mm_menu_".$this->id."_".$this->formname.".writeMenus();";
			$str=$str." } ";
			$str=$str." </script>";
			$str=$str."<script language=\"JavaScript1.2\">mmLoadMenus();</script> <a href=\"#\" name=\"".$this->id."\" id=\"".$this->id."\" onmouseover=\"MM_showMenu(window.mm_menu_".$this->id."_".$this->formname.",21,16,null,'".$this->id."')\" onmouseout=\"MM_startTimeout();\">".$this->values."</a>";
			return $str;
		}
		
	}
	?>