<?php class Plugin_NewDao{
	var $orm;
	public function Plugin_NewDao()
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
		
		return $this->orm->get_object_id("plugin_new",$objectID,"newID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_new","newID");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_new","status='Open'","newID desc");
	}

} 
?>