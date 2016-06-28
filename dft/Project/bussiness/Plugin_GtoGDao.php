<?php class Plugin_GtoGDao{
	var $orm;
	public function Plugin_GtoGDao()
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
		
		return $this->orm->get_object_id("plugin_gtog",$objectID,"gtogID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_gtog","gtogID");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_gtog","status='Open'","gtogID desc");
	}
	public function selectAllByOpenLimit($limit)
	{
		return $this->orm->get_object_where("plugin_gtog","status='Open'","gtogID desc limit $limit");
	}

} 
?>