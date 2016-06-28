<?php class Plugin_SlideDao{
	var $orm;
	public function Plugin_SlideDao()
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
		
		return $this->orm->get_object_id("plugin_slide",$objectID,"slideID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_slide","slideID desc");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_slide","status='Open'","slideID desc");
	}
	public function selectAllSearch($Search)
	{
		return $this->orm->get_object_where("plugin_slide","slideName LIKE '%$Search%'","slideID desc");
	}

} 
?>