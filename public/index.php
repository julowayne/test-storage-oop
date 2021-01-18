<?php


session_start();


require __DIR__ . "/../vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

// Connexion a la DB
try {
  $db = new PDO("mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}", $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
} catch (PDOException $e) {
  die($e->getMessage());
}

$store = new App\Storage\SessionStorage;

// $store = new App\Storage\FileStorage;

// $store = new App\Storage\DatabaseStorage($db);




// $store->set('name', 'Clément');
// $store->set('age', 33);
// $store->delete('name');
$store->destroy();
echo $store->get('name');
echo $store->get('age');
// echo $_SESSION['items']['name'];
// echo $_SESSION['items']['age'];
// print_r($store->get('name'));
print_r($store->all());