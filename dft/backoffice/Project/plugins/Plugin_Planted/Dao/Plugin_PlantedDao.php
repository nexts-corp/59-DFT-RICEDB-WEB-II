<?php class Plugin_PlantedDao{
	var $orm;
	public function Plugin_PlantedDao()
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
		
		return $this->orm->get_object_id("plugin_planted",$objectID,"plantedID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_planted","plantedID");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_planted","status='Open'","plantedID desc");
	}

} 
?>