<?php class Plugin_PuddyDao{
	var $orm;
	public function Plugin_PuddyDao()
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
		
		return $this->orm->get_object_id("plugin_puddy",$objectID,"puddyID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_puddy","puddyID");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_puddy","status='Open'","puddyID desc");
	}

} 
?>