<?php class PermissDao{
	var $orm;
	public function PermissDao()
	{
		$this->orm=new ormdao();
	}

	public function save($permiss)
	{
		 $this->orm->save_object($permiss);

	}
	public function update($permiss)
	{
		$this->orm->update_object($permiss);

	}
	public function deletes($permiss)
	{
	 	$this->orm->delete_object($permiss);
	}
	public function deletesAll($permiss)
	{
	 	$this->orm->delete_objects($permiss);
	}

	public function selectById($permissID)
	{
		
		return $this->orm->get_object_id("permiss",$permissID,"permissID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("permiss","permissID");
	}
	public function selectAllBySubModule($submoduleID,$userType)
	{
		return $this->orm->get_object_where("permiss","submoduleID='$submoduleID' and usertypeID='$userType'","permissID desc");
	}
	public function selectAllBySubModuleUser($submoduleID,$usertypeID)
	{
		return $this->orm->get_object_where("permiss","submoduleID='$submoduleID' and usertypeID='$usertypeID'","permissID desc");
	}
	
	public function selectAllByModule($moduleID)
	{
		return $this->orm->get_object_where("permiss","moduleID='$moduleID'","permissID desc");
	}
	public function selectAllByPermiss($submoduleID,$usertypeID)
	{
		return $this->orm->get_object_sql("permiss","select * from permiss where submoduleID='$submoduleID' and usertypeID='$usertypeID' order by permissID desc");
	}

} 
?>