<?php class Plugin_Price_Rice_ThaiDao{
	var $orm;
	public function Plugin_Price_Rice_ThaiDao()
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
		
		return $this->orm->get_object_id("plugin_price_rice_thai",$objectID,"thaiID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_price_rice_thai","thaiID");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_price_rice_thai","status='Open'","thaiID desc");
	}
	public function selectAllByType($thaiType)
	{
		return $this->orm->get_object_where("plugin_price_rice_thai","thaiType='$thaiType'","thaiID desc");
	}

} 
?>