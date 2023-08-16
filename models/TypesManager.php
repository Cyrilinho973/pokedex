<?php

require_once 'Models.php';

class TypesManager {
  use Model2;

  public function create(Type $type): void {
    $req = $this->db->prepare("INSERT INTO `type` (name, color) VALUE (:name, :color)");    
    $req->bindValue(":name", $type->getName(), PDO::PARAM_STR);
    $req->bindValue(":color", $type->getColor(), PDO::PARAM_STR);
    $req->execute();
    $req->closeCursor();
  }

  public function get(int $id): Type {
    $req = $this->db->prepare("SELECT * FROM `type` WHERE id = :id");
    $req->bindValue(":id", $id, PDO::PARAM_INT);
    $req->execute();
    $data = $req->fetch(PDO::FETCH_ASSOC);
    $type = new Type($data);
    $req->closeCursor();
    return $type;
  }

  public function getAll(): array {
    $types = [];
    $req = $this->db->query("SELECT * FROM `type` ORDER BY name");
    $datas = $req->fetchAll();
    foreach($datas as $data){
      $type = new Type($data);
      $types [] = $type;
    }
    $req->closeCursor();
    return $types;
  }

  public function update(Type $type): void {
    $req = $this->db->prepare("UPDATE `type` SET name = :name, color = :color WHERE id = :id");
    
    $req->bindValue(":name", $type->getName(), PDO::PARAM_STR);
    $req->bindValue(":color", $type->getColor(), PDO::PARAM_STR);
    $req->bindValue(":id", $type->getId(), PDO::PARAM_INT);
    $req->execute();
    $req->closeCursor();
  }

  public function delete($id): void {
    $req = $this->db->prepare("DELETE FROM `type` WHERE id = :id");
    $req->bindValue(":id", $id, PDO::PARAM_INT);
    $req->execute();
    $req->closeCursor();
  }
}