<?php class Plugin_Product_ImgDao{
	var $orm;
	public function Plugin_Product_ImgDao()
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
		
		return $this->orm->get_object_id("plugin_product_img",$objectID,"imgID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_product_img","imgID desc");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_product_img","status='Open'","imgID desc");
	}
	public function selectAllSearch($Search)
	{
		return $this->orm->get_object_where("plugin_product_img","slideName LIKE '%$Search%'","imgID desc");
	}

} 
?>