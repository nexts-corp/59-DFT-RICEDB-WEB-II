<?php class Plugin_Price_Rice_WorldDao{
	var $orm;
	public function Plugin_Price_Rice_WorldDao()
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
		
		return $this->orm->get_object_id("plugin_price_rice_world",$objectID,"worldID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_price_rice_world","worldID");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_price_rice_world","status='Open'","worldID desc");
	}
	public function selectAllByDataType($dataType)
	{
		return $this->orm->get_object_where("plugin_price_rice_world","dataType='$dataType'","worldID desc");
	}

} 
?>