<?php class Plugin_Product_TypeDao{
	var $orm;
	public function Plugin_Product_TypeDao()
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
		
		return $this->orm->get_object_id("plugin_product_type",$objectID,"ptID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_product_type","ptID");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_product_type","status='Open'","ptID desc");
	}

} 
?>