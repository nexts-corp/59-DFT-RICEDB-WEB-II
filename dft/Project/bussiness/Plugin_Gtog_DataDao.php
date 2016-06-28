<?php class Plugin_Gtog_DataDao{
	var $orm;
	public function Plugin_Gtog_DataDao()
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
		
		return $this->orm->get_object_id("plugin_gtog_data",$objectID,"dataID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_gtog_data","dataID");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_gtog_data","status='Open'","dataID desc");
	}
	public function selectAllByGtogID($gtogID,$gtogType)
	{
		return $this->orm->get_object_where("plugin_gtog_data","dataID='$gtogID' and gtogType='$gtogType'","dataID desc");
	}
	public function selectAllByWorldIDAndName($gtogID,$gtogType)
	{
		return $this->orm->get_object_where("plugin_gtog_data","gtogID='$gtogID' and gtogType='$gtogType'","dataID desc");
	}

} 
?>