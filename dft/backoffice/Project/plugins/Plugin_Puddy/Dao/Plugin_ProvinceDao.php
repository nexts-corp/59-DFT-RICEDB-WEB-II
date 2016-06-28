<?php class Plugin_ProvinceDao{
	var $orm;
	public function Plugin_ProvinceDao()
	{
		$this->orm=new ormdao();
	}

	public function save($object)
	{
		 $this->orm->save_object($object);

	}
	public function update($object)
	{
		$this->orm->update_object($object);

	}
	public function deletes($object)
	{
	 	$this->orm->delete_object($object);

	}
	public function selectById($objectID)
	{
		
		return $this->orm->get_object_id("plugin_province",$objectID,"PROVINCE_ID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_province","PROVINCE_ID  desc");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_province","status='Open'","PROVINCE_ID desc");
	}
	public function selectAllSearch($Search)
	{
		return $this->orm->get_object_where("plugin_province","PROVINCE_NAME LIKE '%$Search%'","PROVINCE_ID desc");
	}
	public function selectAllSql()
	{
		return $this->orm->get_object_sql("plugin_province","select * from plugin_province  order by PROVINCE_ID");
	}
	public function selectAllSqlPROVINCE_ID($PROVINCE_ID)
	{
		return $this->orm->get_object_sql("plugin_province","select * from plugin_province where PROVINCE_ID='$PROVINCE_ID' order by PROVINCE_ID");
	}



} 
?>