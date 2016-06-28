<?php class UserDao{
	var $orm;
	public function UserDao()
	{
		$this->orm=new ormdao();
	}

	public function save($user)
	{
		 $this->orm->save_object($user);

	}
	public function saves($user)
	{
		 $this->orm->save_objects($user);
	}
	public function update($user)
	{
		$this->orm->update_object($user);

	}
	public function deletes($user)
	{
	 	$this->orm->delete_object($user);

	}
	public function selectById($userID)
	{
		
		return $this->orm->get_object_id("user",$userID,"userID");
	}
	public function selectAll()
	{
		return $this->orm->get_object_sql("user","select * from user  order by userID");
	}
	public function Login($UserName,$Password)
	{
		return $this->orm->get_object_sql("user","select * from user where (userName='$UserName' and userPassword='$Password') and status='Open' order by userID");
	}
	public function selectByIdUser($registerID)
	{
		return $this->orm->get_object_where("user","registerID='$registerID'","userID");
	}
	public function selectByIdUserStu($studentID)
	{
		return $this->orm->get_object_sql("user","select * from user where studentID='$studentID'","userID");
	}
	public function selectByIdUserSupervising($supervisingID)
	{
		return $this->orm->get_object_sql("user","select * from user where supervisingID='$supervisingID'","userID");
	}
	public function CheckMail($email)
	{
		return $this->orm->get_object_where("user","userName='$email'","userID");
	}
	public function selectAllGroupByDate()
	{
		return $this->orm->get_object_sql("user","select count(userID) as countuser,creationTime from user where usertypeID='6' GROUP BY DATE_FORMAT(creationTime,'%Y-%m-%d') order by creationTime desc LIMIT 7");
	}
	public function CheckOldPass($OldPass)
	{
		return $this->orm->get_object_where("user","password='$OldPass'","userID");
	}
} 
?>