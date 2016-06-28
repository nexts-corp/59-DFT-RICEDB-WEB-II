<?php class Plugin_Costs_RiceDao{
	var $orm;
	public function Plugin_Costs_RiceDao()
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
		
		return $this->orm->get_object_id("plugin_costs_rice",$objectID,"costsID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_costs_rice","costsID");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_costs_rice","status='Open'","costsID desc");
	}
	
} 
?>