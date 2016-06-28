<?php
//require_once("backend/Project/bussiness/Config_PageDao.php");
//require_once("backend/Project/common/config_page.php");
	/*
	 กำหนดที่อยู่ของ Template
	*/
	$ConfigPage["Template"]="Template/html2/";
	$ConfigPage["Upload"]="Upload";
	$ConfigPage["Path"]="/cmssabai";
	$ConfigPage["FullPath"]="";
	$ConfigPage["PathWeb"]="";
	$ConfigPage["PathImages"]="backend/";

	/*
		กำหนดที่อยู่ Style ของปุ่ม
	*/
	$ConfigPage["Style"].="
	<script type=\"text/javascript\" src=\"./framework/ckeditor/ckeditor.js\"></script>
	<script language=\"javascript\" src=\"./framework/java/JVaildator.js\"></script>
	<script language=\"javascript\" src=\"./framework/java/calendar.js\"></script>

	<LINK rel=\"stylesheet\" href='./framework/java/calendar_mos.css' type='text/css'>
	<link rel=\"stylesheet\"  href=\"./framework/ThirdParty/NextPage/nextpage.css\" type=\"text/css\" media=\"screen\" />

		";

	//$dao=new Config_PageDao();
		//$o=$dao->selectAll();

	// $ConfigPage["Title"]="deedev.com รับทำเว็บไซต์ ให้คำปรึกษา รับวางระบบ รับตัด psd เป็น html ";
	// $ConfigPage["Description"]="";
	// $ConfigPage["Keywords"]="ดีเดฟ,รับทำเว็บไซต์,รับตัดhtml,แนะนำสื่อการสอน,phpแบบoopเบื้องต้น";
	// $ConfigPage["Shortcut"]=$o[0]->pageFavicon;
	// $ConfigPage["Logo"]=$o[0]->pageLogo;
	// $ConfigPage["Banner"]=$o[0]->pageBanner;
	// $ConfigPage["GoogleAnalytic"]=$o[0]->pageGoogleAnalytic;
	//$ConfigPage["Color"]=$o[0]->configpageColor;


?>
