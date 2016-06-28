<?php class Plugin_SourceDao{
	var $orm;
	public function Plugin_SourceDao()
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
		
		return $this->orm->get_object_id("plugin_source",$objectID,"sourceID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_source","sourceID desc");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_source","status='Open'","sourceID desc");
	}
	public function selectAllSearch($Search)
	{
		return $this->orm->get_object_where("plugin_source","slideName LIKE '%$Search%'","sourceID desc");
	}
	public function selectAllByDataID($dataID)
	{
		return $this->orm->get_object_where("plugin_source","dataID='$dataID'","sourceID desc");
	}

} 
?>