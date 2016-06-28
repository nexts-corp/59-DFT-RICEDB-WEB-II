<?php class Plugin_ProductDao{
	var $orm;
	public function Plugin_ProductDao()
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
		
		return $this->orm->get_object_id("plugin_product",$objectID,"productID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_product","productID desc");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_product","status='Open'","productID desc");
	}
	public function selectAllSearch($Search)
	{
		return $this->orm->get_object_where("plugin_product","slideName LIKE '%$Search%'","productID desc");
	}
	public function selectAllbyPtID($ptID)
	{
		return $this->orm->get_object_where("plugin_product","ptID='".$ptID."'","productID desc");
	}

} 
?>