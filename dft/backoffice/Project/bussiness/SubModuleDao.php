<?php class SubModuleDao{
	var $orm;
	public function SubModuleDao()
	{
		$this->orm=new ormdao();
	}

	public function save($submodule)
	{
		 $this->orm->save_object($submodule);

	}
	public function update($submodule)
	{
		$this->orm->update_object($submodule);

	}
	public function deletes($submodule)
	{
	 	$this->orm->delete_object($submodule);

	}
	public function deletesAll($submodule)
	{
	 	$this->orm->delete_objects($submodule);
	}
	
	public function selectById($submoduleID)
	{
		
		return $this->orm->get_object_id("submodule",$submoduleID,"submoduleID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("submodule","submoduleID");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("submodule","status='Open'","submoduleID desc");
	}

	public function selectAllBySystem($namesystem)
	{
		return $this->orm->get_object_sql("submodule","select * from submodule where submoduleSystem='$namesystem'");
	}

	public function selectAllByModule($moduleID)
	{
		return $this->orm->get_object_where("submodule","moduleID='$moduleID'","submoduleNumber");
	}
	public function selectAllByModuleView($moduleID)
	{
		return $this->orm->get_object_sql("submodule","select * from submodule where moduleID='$moduleID' and status='Open' order by submoduleNumber");
	}


} 
?>