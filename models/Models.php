<?php

// Modèle pour le constructeur et l'hydratation des objets représentant les tables de la BDD
trait Model1 
{
  public function __construct(array $data) {
    $this->hydrate($data);
  }

  public function hydrate(array $data): void {
    foreach($data as $key => $value) {
      $method = "set" .ucfirst(($key));
      if(method_exists($this, $method)){
        $this->$method($value);
      }
    }
  }
}

trait Model2
{
  private PDO $db;

  public function __construct() {
    $dbName = "studi-pokedex";
    $port = 3306;
    $username = "root";
    $password = "";
    try {
      $this->db = new PDO("mysql:host=localhost;dbname=$dbName;port=$port;charset=utf8", $username, $password);
    } catch(PDOException $exception) {
      echo $exception->getMessage();
    }
  }
}