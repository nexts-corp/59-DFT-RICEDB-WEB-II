<?php
	class TForm
	{
		var $ID;
		public $action="";
		var $validate;	
		var $control;
		var $cvalues;
		var $page;
		var $class;
		function Init($formname,$page,$class,$validate)
		{
			$this->page=$page;
			$this->ID=$formname;
			$this->action=$action;
			$this->validate=$validate;
			$this->class=$class;
			global $_POST;
			global $_GET;
			global $_FILES;
			reset($_FILES);
			reset($_POST);
			reset($_GET);
			while (list($key, $value) = each($_GET))
			{
				$this->cvalues[$key]=$value;
			}
			while (list($key, $value) = each($_POST))
			{
				$this->cvalues[$key]=$value;
			}
		
			while (list($key, $value) = each($_FILES))
			{
				$this->cvalues[$key]=$value;
			}

			$ajax=$this->getdata("__EVENTTARGET_AJAX_".$this->ID);
			if($ajax==true){
				$this->waitevent();
				exit();
			}
	
		}
		function waitevent()
		{
			$eventt=$this->getdata("__EVENTTARGET_".$this->ID);
			$evenag=$this->getdata("__EVENTARGUMENT_".$this->ID);	
			if ($eventt)
			{
				@call_user_func_array(array($this->ID, $eventt), array($evenag,$this));
			}
		}
		function startform()
		{
			$str="";
			$str= "<form id='$this->ID' name='$this->ID' method='POST' ENCTYPE='multipart/form-data' action='$this->action' class='$this->class'>";
			if($this->validate)
			{
				//onSubmit="return validateForms('form1');"
				$chk1="if (validateForms('".$this->ID."')){";
				$chk2="}";
			}
			else
			{
						$chk1="";
						$chk2="";
			}
			$str=$str." <script type=\"text/javascript\">function __doPostBack_".$this->ID."(eventTarget, eventArgument) { ". $chk1 ."    document.all.".$this->ID.".__EVENTTARGET_".$this->ID.".value = eventTarget;document.all.".$this->ID.".__EVENTARGUMENT_".$this->ID.".value = eventArgument;document.all.".$this->ID.".submit();}".$chk2."
			 function __doPostBack2_".$this->ID."(eventTarget, eventArgument) {  document.all.".$this->ID.".__EVENTTARGET_".$this->ID.".value = eventTarget;document.all.".$this->ID.".__EVENTARGUMENT_".$this->ID.".value = eventArgument;document.all.".$this->ID.".submit();} ";
			
			
		$str=$str."function __doPostBackWithAjax_".$this->ID."(id,targetId,eventTarget,eventArgument){";
	$str=$str."var url=window.location.href ;";
	$str=$str."var o = {};";
    $str=$str."var a = $('#".$this->ID."').serializeArray();";
    $str=$str."$.each(a, function() {";
   $str=$str."     if (o[this.name] !== undefined) {";
   $str=$str."         if (!o[this.name].push) {";
   $str=$str."             o[this.name] = [o[this.name]];";
   $str=$str."     }";
  $str=$str."          o[this.name].push(this.value || '');";
  $str=$str."      } else {";
  $str=$str."          o[this.name] = this.value || '';";
  $str=$str."      }";
  $str=$str."  });";
 	$str=$str."o['__EVENTTARGET_AJAX_".$this->ID."']=true;";
 	$str=$str."o['__EVENTTARGET_".$this->ID."']=eventTarget;";
 	$str=$str."o['__EVENTARGUMENT_".$this->ID."']=eventArgument;";
	//$str=$str."var result = $('#".$this->ID."').serialize() ; alert(result);";
	$str=$str."$.post(";
	$str=$str."	url,";
	$str=$str."o";
	//$str=$str."	{";
	//$str=$str."		\"__EVENTTARGET_AJAX_".$this->ID."\":true,";
	//$str=$str."		\"__EVENTTARGET_".$this->ID."\":eventTarget,";
	//$str=$str."		\"__EVENTARGUMENT_".$this->ID."\":eventArgument";
	//$str=$str."	}";
	$str=$str."	,function(data){";
	$str=$str."		$(\"#\"+targetId).html(data);";
	$str=$str."	}";
	$str=$str.");";
$str=$str."}</script>";

$str=$str."<input type=\"hidden\" name=\"__EVENTTARGET_".$this->ID."\" id=\"__EVENTTARGET_".$this->ID."\" value=\"\" /><input type=\"hidden\" name=\"__EVENTARGUMENT_".$this->ID."\" id=\"__EVENTARGUMENT_".$this->ID."\" value=\"\" />";

			return $str;
		}
		function Add($Object)
		{
			global  $_POST;
			global $_GET;
			$v=$this->cvalues[$Object->id];
			if($v)
				$Object->set_defualt($v);
			// else
		//		$Object->set_defualt($v); 
			$Object->formname=$this->ID;
			$this->control[$Object->id]=$Object;
			return $this->control[$Object->id];
		}		
		function getvalue($name)
		{
		//	echo "$name</br>";
			return $this->control[$name]->values;
		}
		function getdata($name)
		{
			return $this->cvalues[$name];
		}
		function endform()
		{
			return "</form>";
		}
		function show()
		{
			//$filename = $this->page;
			if($this->page)
				$filename = "Project/modules/".$this->page."/".$this->ID.".html";
			else
				$filename = $this->ID.".html";
			//echo $filename;
			$handle = fopen($filename, "r");
			$control= fread($handle, filesize($filename));
			fclose($handle);
			$control=str_ireplace("<omdae:".$this->ID.">",$this->startform(),$control);
			if (count($this->control)>0){
			while (list($key, $value) = each($this->control))
			{
				$cname=get_class($this->control[$key]);
				//echo $key."</br>";
				$control=str_ireplace("<omdae:$cname id='$key' />",$this->control[$key]->show(),$control);
				//echo $control;
			}
			}
			$control=str_ireplace("</omdae:".$this->ID.">",$this->endform(),$control);
			echo $control;
		}
		function show2()
		{
			//$p=explode(".",$this->page);
			if($this->page)
				$filename = "Project/modules/".$this->page."/".$this->ID.".html";
			elseif($this->ID)
				$filename = $this->ID.".html";
			else
				$filename = "Project/modules/Page/pageerror.html";
			//echo $filename;
			$handle = fopen($filename, "r");
			$control= fread($handle, filesize($filename));
			fclose($handle);
			$control=str_ireplace("<omdae:".$this->ID.">",$this->startform(),$control);
			if (count($this->control)>0){
			while (list($key, $value) = each($this->control))
			{
				//if($key=="infologin")
					//echo $key;
				$cname=get_class($this->control[$key]);
				$control=str_ireplace("<omdae:$cname id='$key' />",$this->control[$key]->show(),$control);
			}
			}
			$control=str_ireplace("</omdae:".$this->ID.">",$this->endform(),$control);
			return $control;
		}
		function show3()
		{
			//$p=explode(".",$this->page);
			if($this->page)
				$filename = "Project/plugins/".$this->page."/".$this->ID.".html";
			else
				$filename = "Project/plugins/Page/pageerror.html";
			//echo $filename;
			$handle = fopen($filename, "r");
			$control= fread($handle, filesize($filename));
			fclose($handle);
			$control=str_ireplace("<omdae:".$this->ID.">",$this->startform(),$control);
			if (count($this->control)>0){
			while (list($key, $value) = each($this->control))
			{
				//if($key=="infologin")
					//echo $key;
				$cname=get_class($this->control[$key]);
				$control=str_ireplace("<omdae:$cname id='$key' />",$this->control[$key]->show(),$control);
			}
			}
			$control=str_ireplace("</omdae:".$this->ID.">",$this->endform(),$control);
			return $control;
		}
	}
	?>