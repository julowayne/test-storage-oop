<?php

namespace App\Storage;

use App\Storage\Contracts\StorageInterface;

class DatabaseStorage implements StorageInterface
{

  protected $db;
  function __construct(\PDO $db)
  {
      $this->db = $db;
  }
  function set($key, $value){
    $statement = $this->db->prepare("INSERT INTO items (id, value) VALUES (:id, :value)");
    $statement->execute([
      'id' => $key,
      'value' => serialize($value),
  ]);
  return $this->db->lastInsertId();

  }
  function get($key){
    $statement = $this->db->prepare('SELECT value FROM items WHERE id = :id');
    $statement->execute(['id' => $key]);
    return $statement->fetch()['value'];
  }
  function delete($key){
    $statement = $this->db->prepare('DELETE FROM items WHERE id = :id');
    $statement->execute(['id' => $key]);
    return true;
  }
  function destroy(){
    $this->db->query('DELETE FROM items');
    return true;
  }
  function all(){
    $statement = $this->db->prepare("SELECT * FROM items");
    $statement->execute();
    return $statement->fetchAll();
  }
}