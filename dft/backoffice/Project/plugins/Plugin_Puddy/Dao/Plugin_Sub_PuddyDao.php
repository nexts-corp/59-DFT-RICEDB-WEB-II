<?php class Plugin_Sub_PuddyDao{
	var $orm;
	public function Plugin_Sub_PuddyDao()
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
		
		return $this->orm->get_object_id("plugin_sub_puddy",$objectID,"subPuddyID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_sub_puddy","subPuddyID desc");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("plugin_sub_puddy","status='Open'  ","subPuddyID desc");
	 }
	public function selectBypuddyID($puddyID)
	{
		return $this->orm->get_object_where("plugin_sub_puddy","puddyID='$puddyID' ","subPuddyID desc");
	}
	// public function selectAllBySqlptID()
	// {
	// 	return $this->orm->get_object_sql("plugin_sub_puddy","SELECT * From plugin_sub_puddy hr Left Join plugin_product_type pt on hr.plugin_ID = pt.ptID WHERE hr.plugin_Name='ptID' and hr.plugin_ID !='' Order By hr.totalUser asc" );
	// }
	// public function selectAllBySqlblogID()
	// {
	// 	return $this->orm->get_object_sql("plugin_sub_puddy","SELECT * From plugin_sub_puddy hr Left Join plugin_blog bg on hr.plugin_ID = bg.blogID WHERE plugin_Name='blogID' and hr.plugin_ID !='' Order By hr.totalUser asc" );
	// }



} 
?>