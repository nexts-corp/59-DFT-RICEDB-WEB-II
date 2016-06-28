<?php class Plugin_GalleryDao{
	var $orm;
	public function Plugin_GalleryDao()
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
		
		return $this->orm->get_object_id("plugin_gallery",$objectID,"galleryID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_gallery","galleryID  desc");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_gallery","status='Open'","galleryID desc");
	}
	public function selectAllSearch($Search)
	{
		return $this->orm->get_object_where("plugin_gallery","galleryName LIKE '%$Search%'","galleryID desc");
	}
	public function selectAllSearchByType($galleryTypeID)
	{
		return $this->orm->get_object_where("plugin_gallery","galleryTypeID='$galleryTypeID'","galleryID desc");
	}


} 
?>