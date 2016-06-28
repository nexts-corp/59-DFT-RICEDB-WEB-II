<?php class Plugin_Price_Rice_World_FobDao{
	var $orm;
	public function Plugin_Price_Rice_World_FobDao()
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
		
		return $this->orm->get_object_id("plugin_price_rice_world_fob",$objectID,"worldID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_price_rice_world_fob","worldID");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_price_rice_world_fob","status='Open'","worldID desc");
	}
	public function selectAllByWorldID($worldID)
	{
		return $this->orm->get_object_where("plugin_price_rice_world_fob","worldID='$worldID'","worldID desc");
	}
	public function selectAllByWorldIDAndName($worldID,$fobCountry)
	{
		return $this->orm->get_object_where("plugin_price_rice_world_fob","worldID='$worldID' and fobCountry='$fobCountry'","worldID desc");
	}

} 
?>