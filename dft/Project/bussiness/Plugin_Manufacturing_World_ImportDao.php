<?php class Plugin_Manufacturing_World_ImportDao{
	var $orm;
	public function Plugin_Manufacturing_World_ImportDao()
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
		
		return $this->orm->get_object_id("plugin_manufacturing_world_import",$objectID,"importID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_manufacturing_world_import","importID");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_manufacturing_world_import","status='Open'","importID desc");
	}
	public function selectAllByWorldID($worldID)
	{
		return $this->orm->get_object_where("plugin_manufacturing_world_import","worldID='$worldID'","importID desc");
	}
	public function selectAllByWorldIDAndName($worldID,$name)
	{
		return $this->orm->get_object_where("plugin_manufacturing_world_import","worldID='$worldID' and country='$name'","importID desc");
	}


} 
?>