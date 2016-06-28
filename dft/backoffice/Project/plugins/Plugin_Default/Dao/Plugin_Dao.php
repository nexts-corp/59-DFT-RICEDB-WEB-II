<?php class Plugin_New_TypeDao{
	var $orm;
	public function Plugin_New_TypeDao()
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
		
		return $this->orm->get_object_id("plugin_new_type",$objectID,"newtypeID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_new_type","newtypeID");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_new_type","status='Open'","newtypeID desc");
	}

} 
?>