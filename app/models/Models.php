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
    /* $dbName = "studi_pokedex"; */
    $host = "mysql";
    $dbName = "pokedex";
    $port = 3306;
    $username = "root";
    $charset = "utf8mb4";
    $password = "";
    try {
      /* $pdo = new PDO('mysql:host=localhost;charset=utf8mb4', 'root', ''); */
      $pdo = new PDO(
        dsn: "mysql:host=$host;charset=$charset;port=$port",
        username: $username,
        password: $password,
      );
      $pdo->exec('CREATE DATABASE IF NOT EXISTS '.$dbName);
      /* $this->db = new PDO("mysql:host=localhost;dbname=$dbName;port=$port;charset=utf8", $username, $password); */
      $this->db = new PDO(
        dsn: "mysql:host=$host;dbname=$dbName;charset=$charset;port=$port",
        username: $username,
        password: $password,
      );
      $this->db->exec('CREATE TABLE IF NOT EXISTS type (
            id INT(11) PRIMARY KEY AUTO_INCREMENT, 
            name VARCHAR(30) NOT NULL,
            color VARCHAR(10) NOT NULL         
          ) DEFAULT CHARSET utf8mb4
      ');
      $this->db->exec('CREATE TABLE IF NOT EXISTS image (
              id INT(11) PRIMARY KEY AUTO_INCREMENT, 
              name VARCHAR(80) NOT NULL,
              path VARCHAR(255) NOT NULL        
          ) DEFAULT CHARSET utf8mb4
      ');
      $this->db->exec('CREATE TABLE IF NOT EXISTS pokemon (
            id INT(11) PRIMARY KEY AUTO_INCREMENT,
            number INT(11) NOT NULL,
            name VARCHAR(50) NOT NULL,
            description LONGTEXT NOT NULL,
            idType1 INT(11) NOT NULL,
            idType2 INT(11) NULL,
            idImage INT(11) NULL,
            FOREIGN KEY (idType1) REFERENCES type(id),
            FOREIGN KEY (idType2) REFERENCES type(id),
            FOREIGN KEY (idImage) REFERENCES image(id)
        ) DEFAULT CHARSET utf8mb4
      ');
      
    } catch(PDOException $exception) {
      echo $exception->getMessage();
    }
  }
}