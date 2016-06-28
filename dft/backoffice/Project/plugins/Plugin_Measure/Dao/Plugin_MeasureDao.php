<?php class Plugin_MeasureDao{
	var $orm;
	public function Plugin_MeasureDao()
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
		
		return $this->orm->get_object_id("plugin_measure",$objectID,"measureID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_measure","measureID desc");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_measure","status='Open'","measureID desc");
	}

} 
?>