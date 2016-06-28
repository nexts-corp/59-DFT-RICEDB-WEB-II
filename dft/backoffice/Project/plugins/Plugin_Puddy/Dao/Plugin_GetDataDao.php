<?php class Plugin_GetDataDao{
	var $orm;
	public function Plugin_GetDataDao()
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
		
		return $this->orm->get_object_id("plugin_getdata",$objectID,"getID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_getdata","getID");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_getdata","status='Open'","getID desc");
	}

} 
?>