<?php class Plugin_Price_Rice_Thai_Paddy_DataDao{
	var $orm;
	public function Plugin_Price_Rice_Thai_Paddy_DataDao()
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
		
		return $this->orm->get_object_id("plugin_price_rice_thai_paddy_data",$objectID,"dataID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_price_rice_thai_paddy_data","dataID");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_price_rice_thai_paddy_data","status='Open'","dataID desc");
	}
	public function selectAllByPaddyID($paddyID)
	{
		return $this->orm->get_object_where("plugin_price_rice_thai_paddy_data","paddyID='$paddyID'","dataID");
	}
	public function selectAllByThaiIDAndName($thaiID,$paddyType,$departmentType)
	{
		return $this->orm->get_object_where("plugin_price_rice_thai_paddy_data","thaiID='$thaiID' and paddyType='$paddyType' and departmentType='$departmentType'","dataID desc");
	}
	public function selectAllByPaddyIDAndData1($paddyID,$data1)
	{
		return $this->orm->get_object_where("plugin_price_rice_thai_paddy_data","paddyID='$paddyID' and data1='$data1'","dataID desc");
	}
	

} 
?>