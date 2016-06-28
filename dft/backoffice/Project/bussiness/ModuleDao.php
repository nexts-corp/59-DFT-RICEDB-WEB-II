<?php class ModuleDao{
	var $orm;
	public function ModuleDao()
	{
		$this->orm=new ormdao();
	}

	public function save($module)
	{
		 $this->orm->save_object($module);

	}
	public function update($module)
	{
		$this->orm->update_object($module);

	}
	public function deletes($module)
	{
	 	$this->orm->delete_object($module);

	}
	public function selectById($moduleID)
	{
		
		return $this->orm->get_object_id("module",$moduleID,"moduleID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("module","moduleID");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_sql("module","select * from module where status='Open' order by moduleSequence desc");
	}
	public function selectAllByOpenPosition($Position)
	{
		return $this->orm->get_object_sql("module","select * from module where status='Open' and modulePosition like '%$Position%' order by moduleSequence");
	}


} 
?>