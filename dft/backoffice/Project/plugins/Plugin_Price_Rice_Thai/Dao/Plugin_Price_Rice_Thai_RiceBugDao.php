<?php class Plugin_Price_Rice_Thai_RiceBugDao{
	var $orm;
	public function Plugin_Price_Rice_Thai_RiceBugDao()
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
		
		return $this->orm->get_object_id("plugin_price_rice_thai_ricebug",$objectID,"ricebugID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_price_rice_thai_ricebug","ricebugID");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_price_rice_thai_ricebug","status='Open'","ricebugID desc");
	}
	public function selectAllByThaiID($thaiID)
	{
		return $this->orm->get_object_where("plugin_price_rice_thai_ricebug","thaiID='$thaiID'","ricebugID desc");
	}
	public function selectAllByThaiIDAndName($thaiID,$ricebugType)
	{
		return $this->orm->get_object_where("plugin_price_rice_thai_ricebug","thaiID='$thaiID' and ricebugType='$ricebugType'","ricebugID desc");
	}
	

} 
?>