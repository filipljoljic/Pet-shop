<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__)."/BaseDao.class.php";

class OwnerDao extends BaseDao{

  public function get_owner_by_email($email){
  return $this->query_unique("SELECT * FROM owner WHERE email= :email",["email"=>$email]);
}

  public function get_owner_by_id($id){
  return $this->query_unique("SELECT * FROM owner WHERE id=:id",["id"=>@id]);
}

  public function add_owner($owner){
  $insert="";
  $sql = "INSERT INTO owner ( Name, email, Address, Age, accountId) VALUES ( :Name, :email, :Address, :Age, :accountId)";
$stmt= $this->connection->prepare($sql);
$stmt->execute($owner);
$owner['id'] = $this->connection->lastInsertId();
return $owner;
}

public function update_owner($id, $owner){
  $sql = "UPDATE owner SET Name = :Name, email = :email, Address = :Address, Age=:Age, accountId=:accountId WHERE id=:id";
$stmt= $this->connection->prepare($sql);
$owner['id']=$id;
$stmt->execute($owner);

}

}


 ?>