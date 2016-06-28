<?php class Config_Page_Menu_Bar_SubDao{
	var $orm;
	public function Config_Page_Menu_Bar_SubDao()
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
		
		return $this->orm->get_object_id("config_page_menu_bar_sub",$objectID,"menubarsubID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("config_page_menu_bar_sub","menubarsubID desc");
	}
	public function selectAllOpen()
	{
		return $this->orm->get_object_where("config_page_menu_bar_sub","status='Open'","menubarsubID");
	}
	public function selectAllByMenuBar($menubarID)
	{
		return $this->orm->get_object_where("config_page_menu_bar_sub","menubarID='$menubarID'","menubarsubID");
	}
	

} 
?>