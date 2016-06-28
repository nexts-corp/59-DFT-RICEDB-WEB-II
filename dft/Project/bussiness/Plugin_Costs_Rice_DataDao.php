<?php class Plugin_Costs_Rice_DataDao{
	var $orm;
	public function Plugin_Costs_Rice_DataDao()
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
		
		return $this->orm->get_object_id("plugin_costs_rice_data",$objectID,"dataID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_costs_rice_data","dataID");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_costs_rice_data","status='Open'","dataID desc");
	}
	public function selectAllBycostsID($costsID)
	{
		return $this->orm->get_object_where("plugin_costs_rice_data","status='Open'","dataID desc");
	}
	
} 
?>