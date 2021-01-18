<?php

namespace App\Storage;

use App\Storage\Contracts\StorageInterface;

class FileStorage implements StorageInterface
{
  function __construct()
  {
      if (!is_dir( __DIR__ . '/items/')){
          mkdir( __DIR__ . '/items/' );       
      }
  }
  function set($key, $value){
      file_put_contents(__DIR__ . '/items/' . $key, serialize($value));
  }
  function get($key){
    return unserialize(file_get_contents(__DIR__ . '/items/' . $key));
  }
  function delete($key){
    return unlink(__DIR__ . '/items/' . $key);
  }
  function destroy(){
    // array_map( 'unlink', array_filter((array) glob("__DIR__ . '/items/*") ) );
    $files = glob(__DIR__ . '/items/*'); 
    foreach($files as $file){ 
      if(is_file($file)) {
        unlink($file);
      }
    }
  }
  function all(){
    return unserialize(file_get_contents(__DIR__ . '/items/*'));
  }
}