<?php class Plugin_Blog_TypeDao{
	var $orm;
	public function Plugin_Blog_TypeDao()
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
		
		return $this->orm->get_object_id("plugin_blog_type",$objectID,"blogtypeID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_blog_type","blogtypeID");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_blog_type","status='Open'","blogtypeID desc");
	}

} 
?>