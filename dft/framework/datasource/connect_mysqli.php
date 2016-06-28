<?php
//require ("framework/datasource/config.php");
class ConnectDB {
	var $Dbname, $hostname, $userDb, $passwordDb, $db;
	function Connect_DB($Dbname, $hostname, $userDb, $passwordDb, $character) {
		$this->hostname = $hostname;
		$this->Dbname = $Dbname;
		$this->userDb = $userDb;
		$this->passwordDb = $passwordDb;
		
		$mysqli = new mysqli ( $hostname, $userDb, $passwordDb, $Dbname ) or die ( "ติดต่อไม่ได้" );
		$mysqli->select_db ( $this->Dbname ) or die ( "ไม่มีฐานข้อมูล" );
		
		$mysqli->set_charset($character);
		
		return mysqli_connect_errno ();
	}
	function select_Data_Db($sql) {
		// echo $sql;
		// $dbquery = mysql_db_query($this->Dbname,$sql)or die("อ่านข้อมูลไม่ได้");
		global $Config;
		$mysqli = new mysqli ( $Config ["hostname_connect"], $Config ["username_connect"], $Config ["password_connect"], $Config ["database_connect"] ) or die ( "ติดต่อไม่ได้" );
		$mysqli->set_charset($Config ["character"]);
		// $dbquery = mysql_query($sql)or die("อ่านข้อมูลไม่ได้");
		$dbquery = $mysqli->query ( $sql ) or die ( "อ่านข้อมูลไม่ได้" );
		// $num_rows = mysql_num_rows($dbquery);
		$num_rows = $dbquery->num_rows;
		
		// $num_field=mysql_num_fields($dbquery);
		$num_field = $dbquery->field_count;
		
		$i = 0;
		while ( $i < $num_rows ) {
			// $result[$i] = mysql_fetch_array($dbquery);
			$result [$i] = $dbquery->fetch_array ( MYSQLI_BOTH );
			$i ++;
		}
		
		return $result;
	}
	function insert_Data_Db($sql) {
		global $Config;
		$mysqli = new mysqli ( $Config ["hostname_connect"], $Config ["username_connect"], $Config ["password_connect"], $Config ["database_connect"] ) or die ( "ติดต่อไม่ได้" );
		$mysqli->set_charset($Config ["character"]);
		$dbquery = $mysqli->query ( $sql ) or die ( $mysqli->error );
		return $mysqli->insert_id;
	}
	function Delete_Data_Db($sql) {
		global $Config;
		$mysqli = new mysqli ( $Config ["hostname_connect"], $Config ["username_connect"], $Config ["password_connect"], $Config ["database_connect"] ) or die ( "ติดต่อไม่ได้" );
		$mysqli->set_charset($Config ["character"]);
		$dbquery = $mysqli->query ( $sql ) or die ( "ลบข้อมูลไม่ได้" );
		return $mysqli->affected_rows;
		
	}
	function Update_Data_Db($sql) {
		global $Config;
		$mysqli = new mysqli ( $Config ["hostname_connect"], $Config ["username_connect"], $Config ["password_connect"], $Config ["database_connect"] ) or die ( "ติดต่อไม่ได้" );
		$mysqli->set_charset($Config ["character"]);
		$dbquery = $mysqli->query ( $sql ) or die ( "เปลี่ยนแปลงข้อมูลไม่ได้" );
		return $mysqli->affected_rows;
		
	}
	function Command_Sql($sql) {
		// $dbquery = mysql_db_query($this->Dbname,$sql)or die("error");
		$dbquery = mysql_query ( $sql ) or die ( "error" );
		return $dbquery;
	}
	function Dcode($charInput) {
		$Dcode1 = strrev ( $charInput );
		$n = strlen ( $Dcode1 );
		for($i = 0; $i < $n; $i ++) {
			$Dcode2 = ord ( $Dcode1 {$i} ) + 1;
			$Dcode2 = chr ( $Dcode2 );
			$charOutput = "$charOutput$Dcode2";
		}
		return $charOutput;
	}
	function Ucode($charInput) {
		$Dcode1 = strrev ( $charInput );
		$n = strlen ( $Dcode1 );
		for($i = 0; $i < $n; $i ++) {
			$Dcode2 = ord ( $Dcode1 {$i} ) - 1;
			$Dcode2 = chr ( $Dcode2 );
			$charOutput = "$charOutput$Dcode2";
		}
		return $charOutput;
	}
	function sendmsg($msg, $to, $from, $msgtype, $msgtypeid) {
		$sql = "insert into message_announce(mesage,user_id,msg_from,msg_date,msg_status,msg_type,msg_type_id) values('$msg','$to','$from',now(),'0','$msgtype','$msgtypeid')";
		$this->insert_Data_Db ( $sql );
	}
	function DeInitialize() {
		global $Config ;
		$mysqli = new mysqli($Config["hostname_connect"], $Config["username_connect"],$Config["password_connect"], $Config["database_connect"])or die("ติดต่อไม่ได้");
		
		$mysqli->close();
	}
}
?>