<?php class Config_Page_Menu_FooterDao{
	var $orm;
	public function Config_Page_Menu_FooterDao()
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
		
		return $this->orm->get_object_id("config_page_menu_footer",$objectID,"menufooterID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("config_page_menu_footer","menufooterID desc");
	}
	public function selectAllOpen()
	{
		return $this->orm->get_object_where("config_page_menu_footer","status='Open'","menufooterID");
	}

} 
?>