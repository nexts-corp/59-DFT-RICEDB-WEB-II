<?
/* Class Version 2.0.0.2 
	Date Modifi 11/08/2009
	Make By  Copyrith@2009  Project AUDHOM ELECTRON COMPANY 
*/

include("../../../framework/datasource/connect.php");
include ("../../../framework/datasource/config.php");

//$orm=new ormdao();
class ormdao
{
	public $config=array();

	//public $attributes=array();
	//public $associations=array();
	private $mdb;
	private $clm;
	public function ormdao()
	{
		
		global $Config ;
		//echo $Config["hostname_connect"] ;
		$this->mdb=new ConnectDB;
		$this->mdb->Connect_DB($Config["database_connect"],$Config["hostname_connect"],
		$Config["username_connect"],$Config["password_connect"],$Config["character"]);
	}
	public function Begin()
	{
		$this->mdb->Command_Sql("BEGIN");
	}
	public function Commit()
	{
		$this->mdb->Command_Sql("COMMIT");
	}
	public function RollBack()
	{
		$this->mdb->Command_Sql("ROLLBACK");
	}
	/*public function __set($key,$arg){
			$keys=explode("_",$key);
			//echo "set values : $keys[1] = $arg";
			$this->$keys[1] = $arg;
	}
	 public function __get($key){
		// echo "get values : $key";
			$keys=explode("_",$key);
			return $this->$keys[1] ;
	}
   public function __call($name, $arguments) {
        // Note: value of $name is case sensitive.
      //  echo "Calling object method '$name' "
        //     . implode(', ', $arguments). "\n";
		if($name=="set_userID")
			$this->userID=$arguments[0];
    }*/
	function maparray($o,$data)
	{
		$n=count($data);
		$i=0;
		$classname=get_class($o);
		for($i=0;$i<$n;$i++)
		{
				$serialized[$i] = new $classname;
				$obj=$data[$i];
				while (list($key, $value) = each($obj))
				{
					if(is_numeric($key))
					{
						
					}
					else
					{
                       
						$serialized[$i]->$key=$value;
                        //$serialized[$i]->""
						
						//echo $key.">>".$value."</br>";
					}
					
				}
			//	echo $i."<br>";
		}
		return $serialized;
	}
	public function get_object($class_name,$orderby)
	{
			$o=new $class_name;
			$tb= $class_name;
			global $Config;
			$sql="select * from ".$tb." where Owner='".$Config["Owner"]."'" ;
			if($orderby)
				$sql=$sql." order by $orderby  ";
		//echo $sql;
			$data=$this->mdb->select_data_db($sql);
	
			$obs=$this->maparray($o,$data);
			return $obs;
	}
	public function get_object_id($class_name,$object_id,$orderby)
	{
			$o=new $class_name;
			$tb= $class_name;
			$pk=$o->config["primary_key"];
			$sql="select * from ".$tb ." where $pk='$object_id'  ";
			if($orderby)
				$sql=$sql." order by $orderby  ";
			//echo $sql;
			$data=$this->mdb->select_data_db($sql);
			//echo count($data);
			$obs=$this->maparray($o,$data);
			return $obs[0];
	}
	public function get_object_where($class_name,$where,$orderby)
	{
	//	echo $where;
			$o=new $class_name;
			$tb= $class_name;
			global $Config;
			$pk=$o->config["primary_key"];
			$sql="select * from ".$tb ." where $where and Owner='".$Config["Owner"]."'";
			if($orderby)
				$sql=$sql." order by $orderby  ";
			//echo $sql;
			$data=$this->mdb->select_data_db($sql);
			$obs=$this->maparray($o,$data);
			return $obs;
	}
	public function get_object_sql($class_name,$sql)
	{
			$o=new $class_name;
			//$tb=$o->config["tablename"];
			//$pk=$o->config["primary_key"];
			//$sql="select * from ".$tb ." where $where  order by ".$orderby;
		//	echo $sql;
			$data=$this->mdb->select_data_db($sql);
			$obs=$this->maparray($o,$data);
			return $obs;
	}
	public function save_object(&$object)
	{
		$fname="";
		$fvalue="";
       
		foreach(array_keys(get_class_vars(get_class($object))) as $key)
		{
			global $Config;
			//echo $object->$key;
			if($key!="config")
			{
                //$gkey="get".$key;
				$v=$object->$key;
				 if ($fname=="")
				 {
					 if($v){
						$fname=$key;
						$fvalue="'".$v."'";
					 }
				 }
				else
				{
					if($v){
						$fname=$fname.",".$key;
						$fvalue=$fvalue.",'".$v."'";
					}
				 }
			}
		}
		$classname=get_class($object);
		$pk=$object->config["primary_key"];
	//	echo $pk."xxx";
		$sql="insert into ".$classname." ($fname,version,creationTime,whenModified,Owner)  values($fvalue,1,now(),now(),'".$Config["Owner"]."')";
		//echo $sql;
		$id= $this->mdb->insert_data_db($sql);
		$object->$pk=$id;
		//echo 
		$object->version=1;
		//return $;
		//echo $sql."<br>";
	}

	public function save_objects(&$object)
	{
		$n=count($object);
		$sql="";
		for($i=0;$i<$n;$i++)
		{
			$fname="";
			$fvalue="";
			foreach(array_keys(get_class_vars(get_class($object[$i]))) as $key)
			{
				if($key!="config")
				{
                   //  $gkey="get".$key;
				//$v=$object->$gkey();
				$v=$object[$i]->$key;
					if ($fname=="")
					{
						if($v){
							$fname=$key;
							$fvalue="'".$v."'";
						}
					 }
					else
					{
						if($v){
							$fname=$fname.",".$key;
							$fvalue=$fvalue.",'".$v."'";
						}
					}
				}
			}
			//$pk=$this->config["primary_key"];
			$classname=get_class($object);
			$sql=" insert into ".$classname." ($fname,version,creationTime,whenModified)  values($fvalue,1,now(),now())";
			$this->mdb->insert_data_db($sql);
		}
		//echo $sql;
		
		//echo $sql."<br>";
	}

	public function delete_object($object)
	{
			$pk=$object->config["primary_key"];
             //$gkey="get".$pk;
		   //$v=$object->$gkey();
			$v=$object->$pk;
			$classname=get_class($object);
			$sql="delete from ".$classname." where ".$pk."='".$v."'";
			//echo $sql;
			$this->mdb->delete_data_db($sql);
	}
	public function delete_By_sql($sql)
	{
			$this->mdb->delete_data_db($sql);
	}
	public function delete_objects($object)
	{
		$n=count($object);
		$sql="";
		$classname=get_class($object);
		for($i=0;$i<$n;$i++)
		{
			$pk=$object[$i]->config["primary_key"];
            // $gkey="get".$pk;
			//	$v=$object->$gkey();
			$v=$object[$i]->$pk;
			$sql=" delete from ".$classname." where ".$pk."='".$v."';";
			 $this->mdb->delete_data_db($sql);
		}
		
	}
	public function delete_object_where($object,$where)
	{
		$classname=get_class($object);
		$sql=" delete from ".$classname." where $where";
		$this->mdb->delete_data_db($sql);
	}
	public function update_object($object)
	{
			$pk=$object->config["primary_key"];
			$classname=get_class($o);
			global $Config;
			foreach(array_keys(get_class_vars(get_class($object))) as $key)
			{
				if($key!="config" && $key!=$pk)
				{
                  //   $gkey="get".$key;
				//$value=$object->$gkey();
						if($key!="version" and $key!="creationTime" and $key!="whenModified" )
					{
						$value=$object->$key;

						if($fname=="")
						{
							if($value)
								$fname=$key."='".$value."'";
						}
						else
						{
							if($value)
								$fname=$fname.",".$key."='".$value."'";
						}
					}
				}
			}
			$v=$object->$pk;
			$classname=get_class($object);
			$ve=$object->version;
			$sql="update ".$classname." set $fname,version=version+1,whenModified=now() where $pk='$v' and version=$ve and Owner='".$Config["Owner"]."'";
		//	echo $sql;
			$this->mdb->update_data_db($sql);
	}
	public function update_objects($object)
	{
		$n=count($object);
		$sql="";
		$classname=get_class($object);
		for($i=0;$i<$n;$i++)
		{
			$pk=$object[$i]->config["primary_key"];
			//echo $pk;
			$fname="";
			
			foreach(array_keys(get_class_vars(get_class($object[$i]))) as $key)
			{
				if($key!="config" && $key!=$pk)
				{
                    //   $gkey="get".$key;
			//	$value=$object->$gkey();
				if($key!="version" and $key!="creationTime" and $key!="whenModified" )
					{
						$value=$object[$i]->$key;

						if($fname=="")
						{
							if($value)
								$fname=$key."='".$value."'";
						}
						else
						{
							if($value)
								$fname=$fname.",".$key."='".$value."'";
						}
					}
				}
			}
              // $gkey="get".$pk;
			//	$v=$object->$gkey();
			$v=$object[$i]->$pk;
				$v=$object->version;
			$sql=" update ".$classname." set $fname,version=version+1,whenModified=now() where $pk='$v' and version=$v;";
			//echo $sql;
			$this->mdb->update_data_db($sql);
		}
		
	}
	public function update_object_where($object,$where)
	{
			$pk=$object->config["primary_key"];
			$classname=get_class($object);
			foreach(array_keys(get_class_vars(get_class($object))) as $key)
			{
				if($key!="config" && $key!=$pk)
				{
                 //      $gkey="get".$key;
				//$value=$object->$gkey();
						$value=$object->$key;
						if($fname=="")
						{
							if($value)
								$fname=$key."='".$value."'";
						}
						else
						{
							if($value)
								$fname=$fname.",".$key."='".$value."'";
						}
				}
			}
			//$v=$object->$pk;
			$v=$object->version;
			$sql="update ".$classname." set $fname,version=version+1,whenModified=now() where $where and version=$v";
			//echo $sql;
			$this->mdb->update_data_db($sql);
	}
	public function updatetable($object,$Drop)
	{
		$classname=get_class($object);
		if($this->tableExists($classname))
		{
			if($Drop==true)
			{
				$this->Droptable($classname);
				$this->createtable($object);
			}
			else
			{
				$this->columnExists($object);
			}
		}
		else
		{
			$this->createtable($object);
		}
	}
	private function Createtable($object)
	{
		$classname=get_class($object);
		$tb=$classname;
		$sql="CREATE TABLE  $tb(";
		$fname="";
		$pk=$object->config["primary_key"];
		foreach(array_keys(get_class_vars(get_class($object))) as $key)
		{
			if($key!="config")
			{
				$type=$object->config["properties"][$key];
				if($type=="")
					$type="varchar(50) default NULL";
				if($fname=="")
				{
					$fname="$key $type";
				}
				else
					$fname=$fname .",$key  $type";
			}
		}
		$sql = $sql." ".$fname." ,PRIMARY KEY ($pk) )   ";
		//echo $sql;
		 $this->mdb->Command_Sql($sql);
	}
	private function Droptable($tbname)
	{
		 $this->mdb->Command_Sql("DROP TABLE ".$tbname);
	}
	
	private function tableExists($tbname)
	{
		$sql="show tables from ".$this->mdb->Dbname;
		$data=$this->mdb->select_Data_Db($sql);
		$n=count($data);
		for($i=0;$i<$n;$i++)
		{
		//	echo $data[$i][0];
			if($tbname==$data[$i][0])
			{
			//	echo "xxx";
				return true;
				break;
			}
		}
	}
	private function getcolumn($tbname)
	{
		$sql="SHOW COLUMNS FROM  $tbname";
		return $this->mdb->select_Data_Db($sql);
	}
	private function addcolumn($tbname,$fld)
	{
		$sql="ALTER TABLE $tbname ADD $fld";
		$this->mdb->select_Data_Db($sql);
	}

	private function columnExists($object)
	{
		//0	������ͧ up
		//1 �յ�ͧ���
		$classname=get_class($object);
		$clm=$this->getcolumn($classname);
		$up=-1;
			foreach(array_keys(get_class_vars(get_class($object))) as $key)
			{
				if($key!="config")
				{
					$type=$object->config["properties"][$key];
					$n=count($clm);
					for($i=0;$i<$n;$i++)
					{
						if($key==$clm[$i]["Field"])
						{
							$up=0;
							break;
						}
					}
					if($up==-1)
					{
						if($type=="")
							$type="varchar(50) default NULL";
						$fname="$key $type";
						$this->addcolumn($classname,$fname);
					}
				$up=-1;
				}
			}
			
		

	}
}

?>