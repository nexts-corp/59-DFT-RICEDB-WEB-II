<?php class RegisterDao{
	var $orm;
	public function RegisterDao()
	{
		$this->orm=new ormdao();
	}

	public function save($register)
	{
		 $this->orm->save_object($register);

	}
	public function update($register)
	{
		$this->orm->update_object($register);

	}
	public function deletes($register)
	{
	 	$this->orm->delete_object($register);

	}
	public function selectById($registerID)
	{
		
		return $this->orm->get_object_id("register",$registerID,"registerID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("register","registerID desc");
	}
	public function selectAllByOpen()
	{
		return $this->orm->get_object_where("register","status='Open'","registerID desc");
	}
	public function selectAllBySupplier()
	{
		return $this->orm->get_object_sql("register","select * from register regis inner join user user on regis.registerID=user.registerID where usertypeID='7'");
	}
	public function selectCheckEmail($email)
	{
		return $this->orm->get_object_where("register","registerEmail='$email'","registerID desc");
	}
	public function selectAllByOpenregisterID($registerID)
	{
		return $this->orm->get_object_where("register","registerID='$registerID'","registerID desc");
	}

	public function selectAllSql(){
		return $this->orm->get_object_sql("register","SELECT * FROM register mb Left JOIN user us on mb.registerID=us.registerID Left JOIN usertype ut on us.usertypeID=ut.usertypeID ","registerID desc");
	}

} 
?>