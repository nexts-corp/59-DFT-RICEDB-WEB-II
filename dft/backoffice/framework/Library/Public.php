<?php
	/*root();
	function root()
	{
		$current= $_SERVER["REQUEST_URI"];
		$current=explode("/",$current);
		$n=count($current)-3;
		//echo $n;
		//$chk=0;
		for($i=0;$i<$n;$i++)
		{
			//	if($current[$i]==)
			//	if($chk)
					chdir('../');
		}
	}*/
	function permission($usertypelogin,$permiss)
	{
			$o_per=explode(",",$permiss);
			
			$chk=false;
			for($i=0;$i<count($o_per);$i++)
		{

				if($usertypelogin==$o_per[$i])
				{
					$chk=true;
					break;
				}
				else
				{
					$chk=false;
				}
			}
			return $chk;
	}
	function msgbox($msgs)
	{
		?>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
		<script language="JavaScript">
			alert("<?php echo $msgs; ?>");
		</script>
		<?php
	}
	function Refreshs($Page,$keys,$values)
	{
		
		
		//ACTION='index.php';
		echo "<FORM METHOD='POST' id='$Page' ACTION='?page=$Page' name='Refresh'>";
		$key=explode(",",$keys);
		$value=explode(",",$values);

		for($i=0;$i<count($key);$i++)
		{
			echo "<INPUT TYPE='hidden' name='$key[$i]' value='$value[$i]'>";
			//echo $values[$i];
			
		}
		echo "</FORM>";
		echo "<script type=\"text/javascript\">Refresh.submit();</script>";
		
	
			//echo "<meta http-equiv=\"refresh\" content=\"0;url=$option\">";
	}
function fRefresh($Page,$keys,$values)
	{
		$key=explode(",",$keys);
		$value=explode(",",$values);
		$n=count($key);
		$optionvv="?";
		for($i=0;$i<$n;$i++)
		{
		
			if($optionvv=="?")
				$optionvv="?".$key[$i]."=".$value[$i];
			else
				$optionvv=$optionvv."&".$key[$i]."=".$value[$i];
		}
		?>
			<script language="Javascript">
			window.location="<?php echo $optionvv;?>";
			</script>
		<?php
		//echo "<meta http-equiv=\"refresh\" content=\"0;url=$optionvv\">";
	}
	function Refresh($option)
	{
		?>
			<script language="Javascript">
			window.location="<?php echo $option;?>";
			</script>
		<?php
		//echo "<meta http-equiv=\"refresh\" content=\"0;url=$option\">";
	}
function Decode($charInput)
{
	$Dcode1=strrev($charInput);
	$n=strlen($Dcode1);
	for ($i=0;$i<$n;$i++)
	{
		$Dcode2=ord($Dcode1{$i})+1;
		$Dcode2=chr($Dcode2);
		$charOutput="$charOutput$Dcode2";
	}
	return $charOutput;
}
function Uncode($charInput)
{
	$Dcode1=strrev($charInput);
	$n=strlen($Dcode1);
	for ($i=0;$i<$n;$i++)
	{
		$Dcode2=ord($Dcode1{$i})-1;
		$Dcode2=chr($Dcode2);
		$charOutput="$charOutput$Dcode2";
	}
	return $charOutput;
}
function uploadFile($Option,$dirname,$filename,$userfile)
{
	$FileType[0]=array("Allfile");
	$FileType[1]=array("gif","jpg","jpeg","png","bmp","ico");
	$FileType[2]=array("webm","mp4","flv");
	$FileType[3]=array("doc","txt","pdf","ppt","pptx");
	$FileType[4]=array("zip");
	$FileType[5]=array("mp3","MP3");
	$FileType[6]=array("swf");

	$upload_dir = "$dirname/"; 
	$upload_url = $url_dir."/$dirname/"; 
	$message =""; 
	$chk=0;
	if ($userfile)
	{
		$file_name_list="";
		for($j=0;$j<count($userfile['name']);$j++)
		{
		$file_name=$userfile['name'][$j];
		//$file_name=$userfile;
		$list=explode(".",$file_name);
		for($i=0;$i<count($FileType[$Option]);$i++)
			{
				if(Strtolower($list[1])==$FileType[$Option][$i])
				{
					$chk=1;
					break;
				}
			}
		if($Option==0)
			$chk=1;
		if($chk)
		{
		
		$file_name="$filename"."_$j.$list[1]";
		$message=do_upload($upload_dir,$upload_url,$file_name,$userfile['tmp_name'][$j],$userfile['type'][$j],$userfile['size'][$j],$userfile['error'][$j]); 
		echo "$message";
		//$file_name_list="$dirname/$file_name";
		if($list[1])
			$file_name_list.="$dirname/$file_name";
		}
	}//ปิด for j
		return $file_name_list;
	}
}
/*	$Datef=Date("d-m-y");
	$Timef=Date("H-i-s");
	$Datef=ereg_replace("-","",$Datef);
	$Timef=ereg_replace("-","",$Timef); 
	$Fname="topic_".$Datef."_".$Timef;//เปลี่ยนชื่อไฟล
    

	$userfile=$_FILES["msg_file"];
	$file_name=uploadFile(0,"Upload/files",$Fname,$userfile);*/
function do_upload($upload_dir, $upload_url,$file_name,$tmp_name,$type,$size,$error)
{
	$temp_name = $tmp_name;//ให้ตัว$temp_name เก็บไฟล์สำรอง
	$file_name = str_replace("\\","",$file_name);//จัดให้อยู่ในรูปแบบ \ชือไฟล์
	$file_name = str_replace("'","",$file_name);//จัดให้อยู่ในรูปแบบ "\ชือไฟล์"
	$file_type = $type; //เก็บประเภทของไฟล์
	$file_size =$size; //เก็บขนาดของไฟล์
	$result    = $error;//เก็บ error ของไฟล์
	$file_url  = $upload_url.$file_name; //เก็บไดเร็กทอรี
	$file_path = $upload_dir.$file_name;//เก็บห้องของไฟล์

	//File Name Check ตรวจสอบชื่อไฟล์
	if ( $file_name =="")
	{ //ถ้าไม่มีชื่อไฟล์ ให้แสดงข้อความ 
		$message = "Invalid File Name Specified";
		return $message;


	}
	

    $result  =  move_uploaded_file($temp_name,$file_path);


}
function uploadFileMulit($Option,$dirname,$filename,$userfile)
{
	
	$FileType[0]=array("Allfile");
	$FileType[1]=array("gif","jpg","jpeg","png","bmp","ico");
	$FileType[2]=array("webm","mp4","flv");
	$FileType[3]=array("doc","txt","pdf","ppt","pptx");
	$FileType[4]=array("zip");
	$FileType[5]=array("mp3","MP3");
	$FileType[6]=array("swf");

	$upload_dir = "$dirname/"; 
	$upload_url = $url_dir."/$dirname/"; 
	$message =""; 
	$chk=0;
	if ($userfile)
	{
		$file_name_list="";
		for($j=0;$j<count($userfile['name']);$j++)
		{
		$file_name=$userfile['name'][$j];
		
		//$file_name=$userfile;
		$list=explode(".",$file_name);
		for($i=0;$i<count($FileType[$Option]);$i++)
			{
				if(Strtolower($list[1])==$FileType[$Option][$i])
				{
					$chk=1;
					break;
				}
			}
		if($Option==0)
			$chk=1;
		if($chk)
		{
		
		$file_name="$filename"."_$j.$list[1]";
		$message=do_uploadMulit($upload_dir,$upload_url,$file_name,$userfile['tmp_name'][$j],$userfile['type'][$j],$userfile['size'][$j],$userfile['error'][$j]); 
		echo "$message";
		//$file_name_list="$dirname/$file_name";
		if($list[1])
			$file_name_list.="$dirname/$file_name".",";
		}
	}//ปิด for j
		return $file_name_list;
	}
}
/*	$Datef=Date("d-m-y");
	$Timef=Date("H-i-s");
	$Datef=ereg_replace("-","",$Datef);
	$Timef=ereg_replace("-","",$Timef); 
	$Fname="topic_".$Datef."_".$Timef;//เปลี่ยนชื่อไฟล
    

	$userfile=$_FILES["msg_file"];
	$file_name=uploadFile(0,"Upload/files",$Fname,$userfile);*/
function do_uploadMulit($upload_dir, $upload_url,$file_name,$tmp_name,$type,$size,$error)
{
	$temp_name = $tmp_name;//ให้ตัว$temp_name เก็บไฟล์สำรอง
	$file_name = str_replace("\\","",$file_name);//จัดให้อยู่ในรูปแบบ \ชือไฟล์
	$file_name = str_replace("'","",$file_name);//จัดให้อยู่ในรูปแบบ "\ชือไฟล์"
	$file_type = $type; //เก็บประเภทของไฟล์
	$file_size =$size; //เก็บขนาดของไฟล์
	$result    = $error;//เก็บ error ของไฟล์
	$file_url  = $upload_url.$file_name; //เก็บไดเร็กทอรี
	$file_path = $upload_dir.$file_name;//เก็บห้องของไฟล์

	//File Name Check ตรวจสอบชื่อไฟล์
	if ( $file_name =="")
	{ //ถ้าไม่มีชื่อไฟล์ ให้แสดงข้อความ 
		$message = "Invalid File Name Specified";
		return $message;
	}
	
    $result  =  move_uploaded_file($temp_name,$file_path);
   // chmod($file_path, 777);

}
function zipextract($upload_dir)
{	
		 
		 if(!empty($upload_dir))
	{
		  $zip=new ZipArchive();
		  $res=$zip->open($upload_dir);
			if($res===true)
			{
				$filezip=explode(".",$upload_dir);
				//print_r($filezip);
				$zip->extractTo($filezip[0]);
				$zip->close();
			}

	}
}


function popup($url,$param,$w=800,$h=600)
{
	?>
		<SCRIPT LANGUAGE="JavaScript">
	window.open('popup.php?page=<?php echo $url;?>&<?php echo $param; ?>','','width=<?php echo $w ;?>,height=<?php echo $h; ?>,scrollbars=0,toolbar=0,location=0,directories=0,status=0,menubar=0,resizable=0');
	</SCRIPT>
	<?php
}
function popupstd($url,$param,$w=800,$h=600)
{
	?>
	<SCRIPT LANGUAGE="JavaScript">
	window.open('popuptest.php?page=<?php echo $url;?>&<?php echo $param; ?>','','width=<?php echo $w ;?>,height=<?php echo $h; ?>,scrollbars=1,toolbar=0,location=0,directories=0,status=0,menubar=0,resizable=0');
	</SCRIPT>
	<?php
}

function popupReports($url,$param,$w=800,$h=600)
{
	?>
		<SCRIPT LANGUAGE="JavaScript">
	window.open('popupReports.php?page=<?php echo $url;?>&<?php echo $param; ?>','','width=<?php echo $w ;?>,height=<?php echo $h; ?>,scrollbars=0,toolbar=0,location=0,directories=0,status=0,menubar=0,resizable=0,scrollbars=1');
	</SCRIPT>
	<?php
}

function cleanVar($value) {
			$value = (trim($value) == "") ? " " : htmlentities(trim($value));
			return $value;
		}


/*function sendmyfri($MailTo,$MailSubject,$MailMessage,$MailFrom)
{

	$Headers = "MIME-Version: 1.0\r\n" ;
	$Headers .= "Content-type: text/html; charset=windows-874\r\n" ;

	$Headers .= "From: ".$MailFrom." <".$MailFrom.">\r\n" ;
	$Headers .= "Reply-to: ".$MailFrom." <".$MailFrom.">\r\n" ;
	$Headers .= "X-Priority: 3\r\n" ;
	$Headers .= "X-Mailer: PHP mailer\r\n" ;

        if(@mail($MailTo, $MailSubject , $MailMessage, $Headers, $MailFrom))
        {
        return "Send Mail True" ;  //ส่งเรียบร้อย
        }else{
        return "Send Mail False" ; //ไม่สามารถส่งเมล์ได้
        }
}*/				
	function page_navigator($before_p,$plus_p,$total,$total_p,$chk_page){     
					 global $urlquery_str;  
					 $pPrev=$chk_page-1;  
					 $pPrev=($pPrev>=0)?$pPrev:0;  
					 $pNext=$chk_page+1;  
					 $pNext=($pNext>=$total_p)?$total_p-1:$pNext;       
					 $lt_page=$total_p-4;  
					 if($chk_page>0){    
						$str=  "<a  href='?s_page=$pPrev' class='naviPN'>Prev</a>";  
					 }  
					 if($total_p>=11){  
						 if($chk_page>=4){  
							  $str=$str. "<a $nClass href='?s_page=0'>1</a><a class='SpaceC'>. . .</a>";     
						 }  
						 if($chk_page<4){  
							 for($i=0;$i<$total_p;$i++){    
								 $nClass=($chk_page==$i)?"class='selectPage'":"";  
								 if($i<=4){  
								  $str=$str."<a $nClass href='?s_page=$i'>".intval($i+1)."</a> ";     
								 }  
								 if($i==$total_p-1 ){   
								  $str=$str."<a class='SpaceC'>. . .</a><a $nClass href='?s_page=$i'>".intval($i+1)."</a> ";     
								 }         
							 }  
						 }  
						 if($chk_page>=4 && $chk_page<$lt_page){  
							 $st_page=$chk_page-3;  
							 for($i=1;$i<=5;$i++){  
								 $nClass=($chk_page==($st_page+$i))?"class='selectPage'":"";  
								  $str=$str."<a $nClass href='?s_page=".intval($st_page+$i)."'>".intval($st_page+$i+1)."</a> ";      
							 }  
							 for($i=0;$i<$total_p;$i++){    
								 if($i==$total_p-1 ){   
								 $nClass=($chk_page==$i)?"class='selectPage'":"";  
								  $str=$str."<a class='SpaceC'>. . .</a><a $nClass href='?s_page=$i'>".intval($i+1)."</a> ";     
								 }         
							 }                                     
						 }     
						 if($chk_page>=$lt_page){  
							 for($i=0;$i<=4;$i++){  
								 $nClass=($chk_page==($lt_page+$i-1))?"class='selectPage'":"";  
								 $str=$str."<a $nClass href='?s_page=".intval($lt_page+$i-1)."'>".intval($lt_page+$i)."</a> ";     
							 } 
						 }          
					 }else{  
						 for($i=0;$i<$total_p;$i++){    
							 $nClass=($chk_page==$i)?"class='selectPage'":"";  
							$str=$str. "<a href='?s_page=$i' $nClass  >".intval($i+1)."</a> ";     
						 }         
					 }     
					 if($chk_page<$total_p-1){  
						$str=$str."<a href='?s_page=$pNext'  class='naviPN'>Next</a>";  
					 }  
					 return $str;
				 }  

				 function page_navigatorBroad($before_p,$plus_p,$total,$total_p,$chk_page,$pagemain,$obj){     
					 global $urlquery_str;  
					 $pPrev=$chk_page-1;  
					 $pPrev=($pPrev>=0)?$pPrev:0;  
					 $pNext=$chk_page+1;  
					 $pNext=($pNext>=$total_p)?$total_p-1:$pNext;       
					 $lt_page=$total_p-4;  
					 if($chk_page>0){    
						$str=  "<a  href='?page=".$pagemain."&s_page=$pPrev&objid=".$obj."' class='naviPN'>Prev</a>";  
					 }  
					 if($total_p>=11){  
						 if($chk_page>=4){  
							  $str=$str. "<a $nClass href='?page=".$pagemain."&s_page=0&objid=".$obj."'>1</a><a class='SpaceC'>. . .</a>";     
						 }  
						 if($chk_page<4){  
							 for($i=0;$i<$total_p;$i++){    
								 $nClass=($chk_page==$i)?"class='selectPage'":"";  
								 if($i<=4){  
								  $str=$str."<a $nClass href='?page=".$pagemain."&s_page=$i&objid=".$obj."'>".intval($i+1)."</a> ";     
								 }  
								 if($i==$total_p-1 ){   
								  $str=$str."<a class='SpaceC'>. . .</a><a $nClass href='?page=".$pagemain."&s_page=$i&objid=".$obj."'>".intval($i+1)."</a> ";     
								 }         
							 }  
						 }  
						 if($chk_page>=4 && $chk_page<$lt_page){  
							 $st_page=$chk_page-3;  
							 for($i=1;$i<=5;$i++){  
								 $nClass=($chk_page==($st_page+$i))?"class='selectPage'":"";  
								  $str=$str."<a $nClass href='?page=".$pagemain."&s_page=".intval($st_page+$i)."&objid=".$obj."'>".intval($st_page+$i+1)."</a> ";      
							 }  
							 for($i=0;$i<$total_p;$i++){    
								 if($i==$total_p-1 ){   
								 $nClass=($chk_page==$i)?"class='selectPage'":"";  
								  $str=$str."<a class='SpaceC'>. . .</a><a $nClass href='?page=".$pagemain."&s_page=$i&objid=".$obj."'>".intval($i+1)."</a> ";     
								 }         
							 }                                     
						 }     
						 if($chk_page>=$lt_page){  
							 for($i=0;$i<=4;$i++){  
								 $nClass=($chk_page==($lt_page+$i-1))?"class='selectPage'":"";  
								 $str=$str."<a $nClass href='?page=".$pagemain."&s_page=".intval($lt_page+$i-1)."&objid=".$obj."'>".intval($lt_page+$i)."</a> ";     
							 } 
						 }          
					 }else{  
						 for($i=0;$i<$total_p;$i++){    
							 $nClass=($chk_page==$i)?"class='selectPage'":"";  
							$str=$str. "<a href='?page=".$pagemain."&s_page=$i&objid=".$obj."' $nClass  >".intval($i+1)."</a> ";     
						 }         
					 }     
					 if($chk_page<$total_p-1){  
						$str=$str."<a href='?page=".$pagemain."&s_page=$pNext&objid=".$obj."'  class='naviPN'>Next</a>";  
					 }  
					 return $str;
				 }
		
		function subtext($input, $range, $encoding="UTF-8", $dotted = true)
			{
					if($dotted and (mb_strlen($input) > $range))
						return mb_substr($input,0,$range,$encoding) . "...";
					else
						return mb_substr($input,0,$range,$encoding);
			}

		function number_pad($number,$n) {
					return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
			}

	function thaiDate($datetime) {
	//	list($date,$time) = split(' ',$datetime); // แยกวันที่ กับ เวลาออกจากกัน
	//	list($H,$i,$s) = split(':',$time); // แยกเวลา ออกเป็น ชั่วโมง นาที วินาที
		list($m,$d,$Y) = explode('/',$datetime); // แยกวันเป็น ปี เดือน วัน
		$Y = $Y+543; // เปลี่ยน ค.ศ. เป็น พ.ศ.

	switch($m) {
		case "01":	$m = "ม.ค."; break;
		case "02":	$m = "ก.พ."; break;
		case "03":	$m = "มี.ค."; break;
		case "04":	$m = "เม.ย."; break;
		case "05":	$m = "พ.ค."; break;
		case "06":	$m = "มิ.ย."; break;
		case "07":	$m = "ก.ค."; break;
		case "08":	$m = "ส.ค."; break;
		case "09":	$m = "ก.ย."; break;
		case "10":	$m = "ต.ค."; break;
		case "11":	$m = "พ.ย."; break;
		case "12":	$m = "ธ.ค."; break;
					}
		return $d." ".$m." ".$Y;
			}

function thaiDate2($datetime) {
			list($date,$time) = explode(' ',$datetime); // แยกวันที่ กับ เวลาออกจากกัน
			list($H,$i,$s) = explode(':',$time); // แยกเวลา ออกเป็น ชั่วโมง นาที วินาที
			list($Y,$m,$d,) = explode('-',$date); // แยกวันเป็น ปี เดือน วัน
			$Y = $Y; // เปลี่ยน ค.ศ. เป็น พ.ศ.
	
	switch($m) {
		case "01":	$m = "มกราคม"; break;
		case "02":	$m = "กุมภาพันธ์"; break;
		case "03":	$m = "มีนาคม"; break;
		case "04":	$m = "เมษายน"; break;
		case "05":	$m = "พฤษภาคม"; break;
		case "06":	$m = "มิถุนายน"; break;
		case "07":	$m = "กรกฎาคม"; break;
		case "08":	$m = "สิงหาคม"; break;
		case "09":	$m = "กันยายน"; break;
		case "10":	$m = "ตุลาคม"; break;
		case "11":	$m = "พฤศจิกายน"; break;
		case "12":	$m = "ธันวาคม"; break;
					}
		return $d." ".$m." ".$Y;
			}

?>