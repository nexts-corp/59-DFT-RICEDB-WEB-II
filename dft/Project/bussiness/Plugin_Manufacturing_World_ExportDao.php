<?php class Plugin_Manufacturing_World_ExportDao{
	var $orm;
	public function Plugin_Manufacturing_World_ExportDao()
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
		
		return $this->orm->get_object_id("plugin_manufacturing_world_export",$objectID,"exportID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_manufacturing_world_export","exportID");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_manufacturing_world_export","status='Open'","exportID desc");
	}
	public function selectAllByWorldID($worldID)
	{
		return $this->orm->get_object_where("plugin_manufacturing_world_export","worldID='$worldID'","exportID desc");
	}
	public function selectAllByWorldIDAndName($worldID,$name)
	{
		return $this->orm->get_object_where("plugin_manufacturing_world_export","worldID='$worldID' and country='$name'","exportID desc");
	}


} 
?>