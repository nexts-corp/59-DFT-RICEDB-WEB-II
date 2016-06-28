<?php class Plugin_Price_Rice_Thai_RiceDao{
	var $orm;
	public function Plugin_Price_Rice_Thai_RiceDao()
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
		
		return $this->orm->get_object_id("plugin_price_rice_thai_rice",$objectID,"riceID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_price_rice_thai_rice","riceID");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_price_rice_thai_rice","status='Open'","riceID desc");
	}
	public function selectAllByThaiID($thaiID,$departmentType)
	{
		return $this->orm->get_object_where("plugin_price_rice_thai_rice","thaiID='$thaiID' and departmentType='$departmentType'","riceID desc");
	}
	public function selectAllByThaiIDAndName($thaiID,$riceType)
	{
		return $this->orm->get_object_where("plugin_price_rice_thai_rice","thaiID='$thaiID' and riceType='$riceType'","riceID desc");
	}
	

} 
?>