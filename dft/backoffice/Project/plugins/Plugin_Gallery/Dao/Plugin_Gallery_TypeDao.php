<?php class Plugin_Gallery_TypeDao{
	var $orm;
	public function Plugin_Gallery_TypeDao()
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
		
		return $this->orm->get_object_id("plugin_gallery_type",$objectID,"galleryTypeID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_gallery_type","galleryTypeID  desc");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_gallery_type","status='Open'","galleryTypeID desc");
	}
	public function selectAllSearch($Search)
	{
		return $this->orm->get_object_where("plugin_gallery_type","galleryTypeName LIKE '%$Search%'","galleryTypeID desc");
	}
	public function selectAllSearchByType($galleryTypeID)
	{
		return $this->orm->get_object_where("plugin_gallery_type","gallerytypeID='$galleryTypeID'","galleryTypeID desc");
	}


} 
?>