<?php class Plugin_Price_Rice_World_ChamberDao{
	var $orm;
	public function Plugin_Price_Rice_World_ChamberDao()
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
		
		return $this->orm->get_object_id("plugin_price_rice_world_chamber",$objectID,"chamberID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_price_rice_world_chamber","chamberID");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_price_rice_world_chamber","status='Open'","chamberID desc");
	}
	public function selectAllByWorldID($worldID)
	{
		return $this->orm->get_object_where("plugin_price_rice_world_chamber","worldID='$worldID'","chamberID desc");
	}
	public function selectAllByWorldIDAndName($chamberID,$riceType)
	{
		return $this->orm->get_object_where("plugin_price_rice_world_chamber","worldID='$worldID' and riceType='$riceType'","chamberID desc");
	}

} 
?>