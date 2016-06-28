<?php class Plugin_Manufacturing_World_Export_TypeRiceDao{
	var $orm;
	public function Plugin_Manufacturing_World_Export_TypeRiceDao()
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
		
		return $this->orm->get_object_id("plugin_manufacturing_world_export_typerice",$objectID,"typericeID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_manufacturing_world_export_typerice","typericeID");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_manufacturing_world_export_typerice","status='Open'","typericeID desc");
	}
	public function selectAllByWorldID($worldID)
	{
		return $this->orm->get_object_where("plugin_manufacturing_world_export_typerice","worldID='$worldID'","typericeID desc");
	}
	public function selectAllByWorldIDAndName($worldID,$name)
	{
		return $this->orm->get_object_where("plugin_manufacturing_world_export_typerice","worldID='$worldID' and typericeType='$name'","typericeID desc");
	}


} 
?>