<?php class Plugin_ProphecyDao{
	var $orm;
	public function Plugin_ProphecyDao()
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
		
		return $this->orm->get_object_id("plugin_prophecy",$objectID,"prophecyID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_prophecy","prophecyID");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_prophecy","status='Open'","prophecyID desc");
	}
	public function selectAllByOpenLimit($limit)
	{
		return $this->orm->get_object_where("plugin_prophecy","status='Open'","prophecyID desc Limit $limit");
	}

} 
?>