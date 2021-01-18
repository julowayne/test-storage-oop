<?php

namespace App\Storage;

use App\Storage\Contracts\StorageInterface;

class SessionStorage implements StorageInterface
{
  function set($key, $value){
    $_SESSION['items']['name'] = serialize('Jules TD');
    $_SESSION['items']['age'] = serialize(29);
  }
  function get($key){
    return unserialize($_SESSION['items'][$key]);
  }
  function delete($key){
    unset($_SESSION['items'][$key]);
  }
  function destroy(){
    unset($_SESSION['items']);
  }
  function all(){
    return unserialize($_SESSION['items']);
  }
}