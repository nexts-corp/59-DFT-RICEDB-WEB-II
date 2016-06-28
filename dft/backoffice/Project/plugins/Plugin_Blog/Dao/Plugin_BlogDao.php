<?php class Plugin_BlogDao{
	var $orm;
	public function Plugin_BlogDao()
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
		
		return $this->orm->get_object_id("plugin_blog",$objectID,"blogID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_blog","blogID");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_blog","status='Open'","blogID desc");
	}

} 
?>