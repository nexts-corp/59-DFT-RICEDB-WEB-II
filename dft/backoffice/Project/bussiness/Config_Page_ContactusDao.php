<?php class Config_Page_ContactusDao{
	var $orm;
	public function Config_Page_ContactusDao()
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
		
		return $this->orm->get_object_id("config_page_contactus",$objectID,"contactusID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("config_page_contactus","contactusID");
	}

} 
?>