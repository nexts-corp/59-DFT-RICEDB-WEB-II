<?php
class TGridtable extends TControl
{

	var $Delete=false;
	var $Edit=false;
	var $show_title=true;
	var $show_page=true;
	var $show_nextpage=1;
	var $show_order=true;
	var $curentpage=1;
	var $rowOfpage=25;
	var $Data;
	var $control;
	
	function setgridtable($id,$Data)
	{
		$this->id=$id;
		$this->Data=$Data;
		global $_POST;
		$page=explode(",",$_POST[$this->id."_currentpage"]);
		if($page[0])
		{
			$this->curentpage=$page[1];
			$this->rowOfpage=$page[0];
		}
	}
	function addcontrol($control)
	{
		$n=count($this->control);
		$this->control[$n]=$control;
	}
	
	function getvalues($fieldname,$row)
	{
		global $_POST;
		global $_GET;
		global $_FILES;
		$data=$_POST[$fieldname];
		//echo $data[0];
		//echo $row;
		$values=$data[$row];
	
		if(isset($values)==false)
		{
			$data=$_GET[$fieldname];
			$values=$data[$row];
		}
		if(isset($values)==false)
		{
			$data=$_FILES[$fieldname];
			$values=$data[$row];
		}
		return $values;
	}
	
	function changenumpage($rowOfpage)
	{
		$this->rowOfpage=$rowOfpage;
	}
	
	function gotopage($page)
	{
		$this->curentpage=$page;
	}
	
	function getstart()
	{	
				$n=count($this->Data);
				$Page=$this->Create_form_page($this->rowOfpage,$this->curentpage,$n);
				$start=$Page[0]*($Page[1]-1);
				
				return $start;
	}
	
	function getstop()
	{
			$n=count($this->Data);
			
			$Page=$this->Create_form_page($this->rowOfpage,$this->curentpage,$n);
			//return $Page[2];
			return $n;
	}
	
	function Title()
	{
		if($this->show_title)
		{
		$n=count($this->control);
		
		$html=$html. "<thead><tr>";
		//$html=$html."<th class=\"table_checkbox\"><input type=\"checkbox\" name=\"select_rows\" class=\"select_rows\" data-tableid=\"dt_gal\" /></th>";
		for($j=0;$j<$n;$j++)
		{
			$control=$this->control[$j];
			$html=$html. "<th>";
				$html=$html."&nbsp;".$control->title;
			$html=$html. "</th>";
		}
	
		// Edit by aek 15-07-2009 : �����Ѻ������ Delete �����ҹ����ش  ������
		if($this->Edit=="true" or $this->Delete=="true")
		{
			$html=$html. "<th class='center'>";
				$html=$html."จัดการ";
			$html=$html. "</th>";
		}
		$html=$html. "</tr></thead>";
		}
		return $html;
	}
	
	function getDelete($rowindex)
	{
		$ev="onclick=\"  if(ConfirmDel()){  javascript:setTimeout('__doPostBack2_".$this->formname."(\'".$this->id."_Deleting"."\',\''+".$rowindex."+'\')', 0);}\"";
			if($this->Delete=="true")
		{
			
			//$html=$html. "<td>";
			$html=$html."<a class='red' href='#' $ev><i class='icon-trash bigger-130'></i></a>";
			//$html=$html. "</td>";
		}
		return $html;
	}

	function getEdit($rowindex)
	{
		$ev="onclick=\"  javascript:setTimeout('__doPostBack2_".$this->formname."(\'".$this->id."_Editing"."\',\''+".$rowindex."+'\')', 0);\"";
		if($this->Edit=="true")
		{
			//$html=$html. "<td>";
			$html=$html."<a class='green' href='#' $ev><i class='icon-pencil bigger-130'></i></a>";
			//$html=$html. "</td>";
		}
		return $html;
	}
		function getSubmit($rowindex)
	{
		$ev="onclick=\"  javascript:setTimeout('__doPostBack2_".$this->formname."(\'".$this->id."_View"."\',\''+".$rowindex."+'\')', 0);\"";
		if($this->View=="true")
		{
			//$html=$html. "<td>";
			$html=$html."<a class=\"btn btn-small\" href=\"#\" $ev alt=\"แสดง\"><i class=\"icon-zoom-in\"></i>View</a>";
			//$html=$html. "</td>";
		}
		return $html;
	}

	function show()
	{
		//$html= $this->Create_Display_page();
		$html=$html."<table class='table table-striped table-bordered table-hover table-checkable datatable'>";
		$html=$html."".$this->Title();
		$n=count($this->control);
		
		//$numcol=$n+2;
		$Data=$this->Data;
		//echo $this->Edit;
		$start=$this->getstart();
		$stop=$this->getstop();
		
		//echo $stop;
		$html=$html."<tbody>";
		for($i=$start;$i<$stop;$i++)
		{
			$k=$i+1;

				$html=$html."<tr class='selectable'>";

				

				$h=new THidden();
				$pk=$Data[$i]->config["primary_key"];
				//echo $pk;
				$h->set("".$pk."[".$i."]",$Data[$i]->$pk,"","",false,"","");
				$html=$html."".$h->show();
				
				$h=new THidden();
				$h->set("class_name[".$i."]",$Data[$i]->class_name,"","",false,"","");
				$html=$html."".$h->show();
				

			for($j=0;$j<$n;$j++)
			{
				$control=$this->control[$j];
				$Fname=$control->id;
				$name=$Fname;
				$value=$Data[$i]->$Fname;
				
				$Fname=$Fname."[".$i."]";
				$control->id=$Fname;
				$control->formname=$this->formname;
				$control->values=$value;
				$control->rowindex=$i;
				$control->object_id_name=$Data[$i]->config['primary_key'];
				$cn=$control->object_id_name;
				$control->object_id_value=$Data[$i]->$cn;
				//echo eval("$Data[$i]->$cn;");
				
				$html=$html."<td>";
				$html=$html."&nbsp;".$control->show();
				$html=$html."</td>";
				$Fname="";
				$control->id=$name;
			}
			//echo $Data[$i]->class_name;
			// Edit by aek 15-07-2009 : �����Ѻ������ Delete �����ҹ����ش
			
			if($this->Delete== "true" or $this->Edit=="true")
			{
			$html=$html."<td class='center'>";
			//$html=$html." ".$this->getSubmit($i);
			$html=$html." ".$this->getEdit($i);
			$html=$html." ".$this->getDelete($i);
			$html=$html."</td>";
			}
			
			$html=$html."</tr>";
		}
			$html=$html."</tbody>";
			$html=$html."<INPUT TYPE='hidden' name='".$this->id."_currentpage' value='".$this->rowOfpage.",".$this->curentpage."'>";
		$html=$html."</table>";
		//$html=$html."".$this->Create_Select_page();
		//echo $html;
		return $html;
	}
	
	function Create_form_page($NumRow,$NextPage,$counter)
	{
		$counter=$counter;
		if(!$NumRow)
			$NumRow=10;
		$NumRow=$NumRow;
		$NextPage+=$Next;
		if(!$NextPage)
			$NextPage=1;
		$NumPage=$counter/$NumRow;
		$NumPage=(int)$NumPage;
		if($counter%$NumRow)
				$NumPage+=1;
		if($NextPage>$NumPage)
				$NextPage=$NumPage;
		if($counter<$NumRow*$NextPage)
				$Max=$counter;
		else
			$Max=$NumRow*$NextPage;
		$i=0;
		if($Max==0)
			$Max=-10;
		$Page[0]=$NumRow;
		$Page[1]=$NextPage;
		$Page[2]=$Max;
		$Page[3]=$NumPage;
		if($counter)
			return $Page;
	}
	function Create_Display_page()
	{
		if($this->show_page)
		{
		$ev="onchange=\"  javascript:setTimeout('__doPostBack_".$this->formname."(\'".$this->id."_rowperpage"."\',\''+this.options[NumRow.selectedIndex].value+',1'+'\')', 0);\"";

			//$html=$html."<table width='100%'><tr>";
			//$html=$html.="<td>";
			$html=$html."<select Name=\"$NumRN\" id=\"NumRow\" $ev style=\"width: 60px;margin:10px 10px 5px 10px;\">";

						for( $i=10; $i <= 100;$i+=10)
						{
							if($i==$this->rowOfpage)
									$html=$html." <option selected value='$i'>$i</option>\n";
							else
									$html=$html." <option value='$i'>$i</option>\n";
						}
				$html=$html."</select>";
				//$html=$html.="</td>";

				//$html=$html.="<td align='right'><div class=\"input-append\"><input id=\"appendedInputButton\" type=\"text\"><button class=\"btn\" type=\"button\" $ev1>Search</button></div> </td>";
				//$html=$html.="</tr></table>";
		}
		return $html;
	}
	function Create_Select_page()
	{
		if($this->show_nextpage==1)
			$html=$this->Create_Select_page1();
		if($this->show_nextpage==2)
			$html=$this->Create_Select_page2();
		if($this->show_nextpage==3)
			$html=$this->Create_Select_page3();
		return $html;
	}
	function Create_Select_page1()
	{
		$ev="onchange=\"  javascript:setTimeout('__doPostBack_".$this->formname."(\'".$this->id."_nextpage"."\',\'".$this->rowOfpage.",'+this.options[NextPage.selectedIndex].value+'\')', 0);\"";
		$n=count($this->Data);
		$html=$html."<TABLE  class='content' width='100%'>";
		$html=$html."<TR>";
		$html=$html."<TD width='50%'><p>จำนวนแถวข้อมูลทั้งหมด: &nbsp;<B>$n</B> </p><TD>";
		$html=$html."<TD width='50%' align='right'>";
		//echo $n;
		$page=$this->Create_form_page($this->rowOfpage,$this->curentpage,$n);
	 if($this->rowOfpage<$n){
				$html=$html."แสดงหน้าที่&nbsp;";
				$html=$html."<select Name=\"NextPage\" id=\"NextPage\" $ev style=\"width: 60px\">";
					
						for( $i=1; $i <= $page[3];$i++)
						{
							if($i==$this->curentpage)
									$html=$html."<option selected value='$i'>$i</option>";
							else
									$html=$html."<option value='$i'>$i</option>";
						}
						$html=$html."</select>";
		}
		$html=$html."</TD>";
	$html=$html."</TR>";
	$html=$html."</TABLE>";
	return $html;
	
	}
function Create_Select_page2()
	{
		$n=count($this->Data);
		$page=$this->Create_form_page($this->rowOfpage,$this->curentpage,$n);

		$html=$html."<TABLE  class='content' width='100%'>";
		$html=$html."<TR>";
		$html=$html."<TD width='100%' align='right'><table><tr>";
		
		 if($this->rowOfpage<$n){
				$first=1;
				$Back=$this->curentpage-1;
				if($Back<1)
					$Back=1;
				$Next=$this->curentpage+1;
				if($Next>$page[3])
					$Next=$page[3];
				$Last=$page[3];
					$evF="onclick=\"  javascript:setTimeout('__doPostBack_".$this->formname."(\'".$this->id."_nextpage"."\',\'".$this->rowOfpage.",$first\')', 0);\"";
					$evB ="onclick=\"  javascript:setTimeout('__doPostBack_".$this->formname."(\'".$this->id."_nextpage"."\',\'".$this->rowOfpage.",$Back\')', 0);\"";
					$evN="onclick=\"  javascript:setTimeout('__doPostBack_".$this->formname."(\'".$this->id."_nextpage"."\',\'".$this->rowOfpage.",$Next\')', 0);\"";
					$evL="onclick=\"  javascript:setTimeout('__doPostBack_".$this->formname."(\'".$this->id."_nextpage"."\',\'".$this->rowOfpage.",$Last\')', 0);\"";
				$html=$html."<td><A HREF='#' $evF><FONT  size='3'  style='font-family:webdings'>9</FONT></A></td>";
				$html=$html."<td><A HREF='#' $evB><FONT  size='3'    style='font-family:webdings'>3</FONT></A></td>";
				$html=$html."<td><A HREF='#' $evN><FONT  size='3'    style='font-family:webdings'>4</FONT></A></td>";
				$html=$html."<td><A HREF='#' $evL><FONT  size='3'    style='font-family:webdings'>:</FONT></A></td>";
		}
		$html=$html."</tr></table></TD>";
		$html=$html."</TR>";
		$html=$html."</TABLE>";
		return $html;

	}
	function Create_Select_page3()
	{
		$n=count($this->Data);
		$page=$this->Create_form_page($this->rowOfpage,$this->curentpage,$n);

		$html=$html."<TABLE  class='content' width='100%'>";
		$html=$html."<TR>";
		$html=$html."<td width='50%'><B>Total</B> :&nbsp;$n</td><TD width='50%' align='right'><table><tr>";
		
		 if($this->rowOfpage<$n){
				$first=1;
				$Back=$this->curentpage-1;
				if($Back<1)
					$Back=1;
				$Next=$this->curentpage+1;
				if($Next>$page[3])
					$Next=$page[3];
				$Last=$page[3];
					$evF="onclick=\"  javascript:setTimeout('__doPostBack_".$this->formname."(\'".$this->id."_nextpage"."\',\'".$this->rowOfpage.",$first\')', 0);\"";
					$evB ="onclick=\"  javascript:setTimeout('__doPostBack_".$this->formname."(\'".$this->id."_nextpage"."\',\'".$this->rowOfpage.",$Back\')', 0);\"";
					$evN="onclick=\"  javascript:setTimeout('__doPostBack_".$this->formname."(\'".$this->id."_nextpage"."\',\'".$this->rowOfpage.",$Next\')', 0);\"";
					$evL="onclick=\"  javascript:setTimeout('__doPostBack_".$this->formname."(\'".$this->id."_nextpage"."\',\'".$this->rowOfpage.",$Last\')', 0);\"";
				$html=$html."<td><A HREF='#' $evF><FONT  size='3'  style='font-family:webdings'>9</FONT></A></td>";
				$html=$html."<td><A HREF='#' $evB><FONT  size='3'    style='font-family:webdings'>3</FONT></A></td>";
				$html=$html."<td><A HREF='#' $evN><FONT  size='3'    style='font-family:webdings'>4</FONT></A></td>";
				$html=$html."<td><A HREF='#' $evL><FONT  size='3'    style='font-family:webdings'>:</FONT></A></td>";
		}
		$html=$html."</tr></table></TD>";
		$html=$html."</TR>";
		$html=$html."</TABLE>";
		return $html;
	}
}

?>