<?php class Plugin_Manufacturing_World_GenDao{
	var $orm;
	public function Plugin_Manufacturing_World_GenDao()
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
		
		return $this->orm->get_object_id("plugin_manufacturing_world_gen",$objectID,"genID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_manufacturing_world_gen","genID");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_manufacturing_world_gen","status='Open'","genID desc");
	}
	public function selectAllByWorldID($worldID)
	{
		return $this->orm->get_object_where("plugin_manufacturing_world_gen","worldID='$worldID'","genID desc");
	}
	public function selectAllByWorldIDAndName($worldID,$name)
	{
		return $this->orm->get_object_where("plugin_manufacturing_world_gen","worldID='$worldID' and country='$name'","genID desc");
	}


} 
?>