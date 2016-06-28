<?php class Plugin_Info_TypeDao{
	var $orm;
	public function Plugin_Info_TypeDao()
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
		
		return $this->orm->get_object_id("plugin_info_type",$objectID,"infoTypeID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_info_type","infoTypeID");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_info_type","status='Open'","infoTypeID desc");
	}

} 
?>