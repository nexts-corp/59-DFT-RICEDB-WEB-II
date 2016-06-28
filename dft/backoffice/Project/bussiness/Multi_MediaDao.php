<?php class Multi_MediaDao{
	var $orm;
	public function Multi_MediaDao()
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
		
		return $this->orm->get_object_id("multi_media",$objectID,"multiId");
	}
	public function selectAll()
	{
		return $this->orm->get_object("multi_media","multiId");
	}

} 
?>