<?php class UserTypeDao{
	var $orm;
	public function UserTypeDao()
	{
		$this->orm=new ormdao();
	}

	public function save($usertype)
	{
		 $this->orm->save_object($usertype);

	}
	public function update($usertype)
	{
		$this->orm->update_object($usertype);

	}
	public function deletes($usertype)
	{
	 	$this->orm->delete_object($usertype);

	}
	public function selectById($usertypeID)
	{
		
		return $this->orm->get_object_id("usertype",$usertypeID,"usertypeID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("usertype","usertypeID");
	}

} 
?>