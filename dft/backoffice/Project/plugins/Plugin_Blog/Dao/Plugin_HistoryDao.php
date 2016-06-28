<?php class Plugin_HistoryDao{
	var $orm;
	public function Plugin_HistoryDao()
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
		
		return $this->orm->get_object_id("plugin_history",$objectID,"historyID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_history","historyID desc");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_history","status='Open'  ","historyID desc");
	}
	public function selectByCheckNameAndID($pluginName,$ptID)
	{
		return $this->orm->get_object_where("plugin_history","plugin_Name='$pluginName' and plugin_ID='$ptID' ","historyID desc");
	}
	public function selectAllBySqlptID()
	{
		return $this->orm->get_object_sql("plugin_history","SELECT * From plugin_history hr Left Join plugin_product_type pt on hr.plugin_ID = pt.ptID WHERE hr.plugin_Name='ptID' and hr.plugin_ID !='' Order By hr.totalUser asc" );
	}
	public function selectAllBySqlblogID()
	{
		return $this->orm->get_object_sql("plugin_history","SELECT * From plugin_history hr Left Join plugin_blog bg on hr.plugin_ID = bg.blogID WHERE plugin_Name='blogID' and hr.plugin_ID !='' Order By hr.totalUser asc" );
	}



} 
?>