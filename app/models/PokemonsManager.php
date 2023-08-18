<?php

require_once 'Models.php';

class PokemonsManager {
  use Model2;

  public function create(Pokemon $pokemon): void {
    $req = $this->db->prepare("INSERT INTO `pokemon` (number, name, description, idType1, idType2, idImage) VALUE (:number, :name, :description, :idType1, :idType2, :idImage)");
    $req->bindValue(":number", $pokemon->getNumber(), PDO::PARAM_INT);
    $req->bindValue(":name", $pokemon->getName(), PDO::PARAM_STR);
    $req->bindValue(":description", $pokemon->getDescription(), PDO::PARAM_STR);
    $req->bindValue(":idType1", $pokemon->getIdType1(), PDO::PARAM_INT);
    if($pokemon->getIdType2() === null){
      $req->bindValue(":idType2", $pokemon->getIdType2(), PDO::PARAM_NULL);
    } else {
      $req->bindValue(":idType2", $pokemon->getIdType2(), PDO::PARAM_INT);
    }
    $req->bindValue(":idImage", $pokemon->getIdImage(), PDO::PARAM_INT);
    $req->execute();
    $req->closeCursor();
  }

  public function get(int $id): Pokemon {
    $req = $this->db->prepare("SELECT * FROM `pokemon` WHERE id = :id");
    $req->bindValue(":id", $id, PDO::PARAM_INT);
    $req->execute();
    $data = $req->fetch(PDO::FETCH_ASSOC);
    $pokemon = new Pokemon($data);
    $req->closeCursor();
    return $pokemon;
  }

  public function getAll(): array {
    $pokemons = [];
    $req = $this->db->query("SELECT * FROM `pokemon` ORDER BY number");
    $datas = $req->fetchAll();
    foreach($datas as $data){
      $pokemon = new Pokemon($data);
      $pokemons [] = $pokemon;
    }
    $req->closeCursor();
    return $pokemons;
  }

  public function getAllByString(string $input): array {
    $pokemons = [];
    $req = $this->db->prepare("SELECT * FROM `pokemon` WHERE name LIKE :input ORDER BY number");
    $req->bindValue(":input", "%$input%", PDO::PARAM_STR);
    $req->execute();
    $datas = $req->fetchAll();
    foreach($datas as $data){
      $pokemon = new Pokemon($data);
      $pokemons [] = $pokemon;
    }
    $req->closeCursor();
    return $pokemons;
  }

  public function getAllByType(string $type, string $input): array {
    $pokemons = [];
    $req = $this->db->prepare("SELECT * FROM `pokemon` WHERE (idType1 LIKE :type OR idType2 LIKE :type) AND (name LIKE :input) ORDER BY number");
    $req->bindValue(":type", $type, PDO::PARAM_STR);
    $req->bindValue(":input", "%$input%", PDO::PARAM_STR);
    $req->execute();
    $datas = $req->fetchAll();
    foreach($datas as $data){
      $pokemon = new Pokemon($data);
      $pokemons [] = $pokemon;
    }
    $req->closeCursor();
    return $pokemons;
  }

  public function update(Pokemon $pokemon): void {
    $req = $this->db->prepare("UPDATE `pokemon` SET name = :name, number = :number, description = :description, idType1 = :idType1, idType2 = :idType2, idImage = :idImage WHERE id = :id");
    $req->bindValue(":number", $pokemon->getNumber(), PDO::PARAM_INT);
    $req->bindValue(":name", $pokemon->getName(), PDO::PARAM_STR);
    $req->bindValue(":description", $pokemon->getDescription(), PDO::PARAM_STR);
    $req->bindValue(":idType1", $pokemon->getIdType1(), PDO::PARAM_INT);
    $req->bindValue(":idType2", $pokemon->getIdType2(), PDO::PARAM_INT);
    $req->bindValue(":idImage", $pokemon->getIdImage(), PDO::PARAM_STR);
    $req->bindValue(":id", $pokemon->getId(), PDO::PARAM_INT);
    $req->execute();
    $req->closeCursor();
  }

  public function delete($id): void {
    $req = $this->db->prepare("DELETE FROM `pokemon` WHERE id = :id");
    $req->bindValue(":id", $id, PDO::PARAM_INT);
    $req->execute();
    $req->closeCursor();
  }
}