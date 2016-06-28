<?php class Plugin_Price_Rice_Thai_PaddyDao{
	var $orm;
	public function Plugin_Price_Rice_Thai_PaddyDao()
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
		
		return $this->orm->get_object_id("plugin_price_rice_thai_paddy",$objectID,"paddyID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_price_rice_thai_paddy","paddyID");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_price_rice_thai_paddy","status='Open'","paddyID desc");
	}
	public function selectAllByThaiID($thaiID,$departmentType)
	{
		return $this->orm->get_object_where("plugin_price_rice_thai_paddy","thaiID='$thaiID' and departmentType='$departmentType'","paddyID");
	}
	public function selectAllByThaiIDAndName($thaiID,$paddyType,$departmentType)
	{
		return $this->orm->get_object_where("plugin_price_rice_thai_paddy","thaiID='$thaiID' and paddyType='$paddyType' and departmentType='$departmentType'","paddyID desc");
	}
	

} 
?>