<?php
Class ConnectDB
{
	var $Dbname,$hostname,$userDb,$passwordDb,$db;   

	function Connect_DB($Dbname,$hostname,$userDb,$passwordDb,$character)
	{
		$this->hostname=$hostname;
		$this->Dbname=$Dbname;
		$this->userDb=$userDb;
		$this->passwordDb=$passwordDb;

		mysql_connect($hostname, $userDb, $passwordDb)or die("ติดต่อไม่ได้"); 
		$this->db = mysql_select_db($this->Dbname)or die("ไม่มีฐานข้อมูล"); 
		//$sql="select charecter_resulf "
		$cs1 = "SET character_set_results=$character";
		mysql_query($cs1) or die('Error query: ' . mysql_error()); 

		$cs2 = "SET character_set_client = $character";
		mysql_query($cs2) or die('Error query: ' . mysql_error()); 

		$cs3 = "SET character_set_connection = $character";
		mysql_query($cs3) or die('Error query: ' . mysql_error());
		return mysql_errno();
	}
	function select_Data_Db($sql)
	{
	//	echo $sql;
		//$dbquery = mysql_db_query($this->Dbname,$sql)or die("อ่านข้อมูลไม่ได้"); 
		$dbquery = mysql_query($sql)or die("อ่านข้อมูลไม่ได้"); 
		$num_rows = mysql_num_rows($dbquery);
		$num_field=mysql_num_fields($dbquery);
		$i=0;
		while($i<$num_rows)
			{
				$result[$i] = mysql_fetch_array($dbquery);
				$i++;
			}
		return $result;
	}
	function insert_Data_Db($sql)
	{
	//	echo $sql;
		//$dbquery = mysql_db_query($this->Dbname,$sql)or die(mysql_Error()); 
		$dbquery = mysql_query($sql)or die(mysql_Error()); 
		return mysql_insert_id();
	}
	function Delete_Data_Db($sql)
	{
		//$dbquery = mysql_db_query($this->Dbname,$sql)or die("ลบข้อมูลไม่ได้"); 
		$dbquery = mysql_query($sql)or die("ลบข้อมูลไม่ได้"); 
		return mysql_affected_rows();
	}

	function Update_Data_Db($sql)
	{
		//$dbquery = mysql_db_query($this->Dbname,$sql)or die("เปลี่ยนแปลงข้อมูลไม่ได้"); 
		$dbquery = mysql_query($sql)or die("เปลี่ยนแปลงข้อมูลไม่ได้"); 
		return mysql_affected_rows();
	}
	function Command_Sql($sql)
	{
		//$dbquery = mysql_db_query($this->Dbname,$sql)or die("error"); 
		$dbquery = mysql_query($sql)or die("error"); 
		return $dbquery ;
	}
	
function getRuning($tbname,$idname)
{
	 $sql="select max($idname) as Runing from $tbname ";
	$did=$this->select_data_db($sql);
	$id=$did[0]["Runing"]+1;
	$fld=mysql_list_fields($this->Dbname,$tbname);
	$Len=mysql_field_len($fld,$idname);
	$k=strlen($id);
	 for($i=$k;$i<$Len;$i++)
		 $id="0".$id;
	 return $id;
}
function getRuning2($tbname,$idname,$idby,$idbyvalue)
{
	$sql="select max($idname) as Runing from $tbname where $idby='$idbyvalue'";
	//echo $sql;
	$did=$this->select_data_db($sql);
	$id=$did[0]["Runing"]+1;
	$fld=mysql_list_fields($this->Dbname,$tbname);
	$Len=mysql_field_len($fld,$idname);
		$k=strlen($id);
	 for($i=$k;$i<$Len;$i++)
		 $id="0".$id;
	 return $id;
}
function getRuning3($tbname,$idname,$catid,$sizeid,$yid,$bid)
{
	$sql="select max(substring_index($idname,'-',-1)) as Runing from $tbname where subcategory_id='$catid' and durable_size='$sizeid' and budgetyear='$yid' and budgettype='$bid'";
	//echo $sql;
	$did=$this->select_data_db($sql);
	$id=$did[0]["Runing"]+1;
	$k=strlen($id);
	 for($i=$k;$i<4;$i++)
		 $id="0".$id;
	// echo $id;
	 return $id;
}
function Dcode($charInput)
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
function Ucode($charInput)
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
function sendmsg($msg,$to,$from,$msgtype,$msgtypeid)
	{
	$sql="insert into message_announce(mesage,user_id,msg_from,msg_date,msg_status,msg_type,msg_type_id) values('$msg','$to','$from',now(),'0','$msgtype','$msgtypeid')";
	 $this->insert_Data_Db($sql);
}
	function DeInitialize()
	{
		mysql_close();	
	}
	}
	?>