<?php class Plugin_Manufacturing_World_Export_ConsulateDao{
	var $orm;
	public function Plugin_Manufacturing_World_Export_ConsulateDao()
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
		
		return $this->orm->get_object_id("plugin_manufacturing_world_export_consulate",$objectID,"consulateID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_manufacturing_world_export_consulate","consulateID");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_manufacturing_world_export_consulate","status='Open'","consulateID desc");
	}
	public function selectAllByWorldID($worldID)
	{
		return $this->orm->get_object_where("plugin_manufacturing_world_export_consulate","worldID='$worldID'","consulateID desc");
	}
	public function selectAllByWorldIDAndName($worldID,$name)
	{
		return $this->orm->get_object_where("plugin_manufacturing_world_export_consulate","worldID='$worldID' and country='$name'","consulateID desc");
	}


} 
?>