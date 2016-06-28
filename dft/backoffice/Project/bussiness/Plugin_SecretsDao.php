<?php class Plugin_SecretsDao{
	var $orm;
	public function Plugin_SecretsDao()
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
		
		return $this->orm->get_object_id("plugin_secrets",$objectID,"secretsID");
	}
	public function selectAll()
	{
		return $this->orm->get_object("plugin_secrets","secretsID");
	}
	public function selectAllByOpensecretsID($secretsID)
	{
		return $this->orm->get_object_where("plugin_secrets","status='Open' ","secretsID desc");
	}

} 
?>