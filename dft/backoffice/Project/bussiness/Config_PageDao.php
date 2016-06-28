<?php class Config_PageDao{
	var $orm;
	public function Config_PageDao()
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
		
		return $this->orm->get_object_id("config_page",$objectID,"pageID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("config_page","pageID");
	}

	public function selectAllweb($pageID)
	{
		return $this->orm->get_object_where("config_page","pageID='$pageID'","pageID desc");
	}

} 
?>