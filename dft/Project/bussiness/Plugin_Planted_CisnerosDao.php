<?php class Plugin_Planted_CisnerosDao{
	var $orm;
	public function Plugin_Planted_CisnerosDao()
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
		
		return $this->orm->get_object_id("plugin_planted_cisneros",$objectID,"cisnerosID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_planted_cisneros","cisnerosID");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_planted_cisneros","status='Open'","cisnerosID desc");
	}
	public function selectAllByPlantedID($plantedID,$typePlanted)
	{
		return $this->orm->get_object_where("plugin_planted_cisneros","plantedID='$plantedID' and typePlanted='$typePlanted'","cisnerosID desc");
	}
	public function selectAllByPlantedIDAndName($plantedID,$name,$typePlanted)
	{
		return $this->orm->get_object_where("plugin_planted_cisneros","plantedID='$plantedID' and province='$name' and typePlanted='$typePlanted'","cisnerosID desc");
	}
	
} 
?>