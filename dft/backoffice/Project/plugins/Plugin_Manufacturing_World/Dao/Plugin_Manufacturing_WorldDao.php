<?php class Plugin_Manufacturing_WorldDao{
	var $orm;
	public function Plugin_Manufacturing_WorldDao()
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
		
		return $this->orm->get_object_id("plugin_manufacturing_world",$objectID,"worldID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_manufacturing_world","worldID");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_manufacturing_world","status='Open'","worldID desc");
	}

} 
?>