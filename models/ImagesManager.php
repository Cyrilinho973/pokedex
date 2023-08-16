<?php

require_once 'Models.php';

class ImagesManager {
  use Model2;

  public function create(Image $image): void {
    $req = $this->db->prepare("INSERT INTO `image` (name, path) VALUE (:name, :path)");    
    $req->bindValue(":name", $image->getName(), PDO::PARAM_STR);
    $req->bindValue(":path", $image->getPath(), PDO::PARAM_STR);
    $req->execute();
    $req->closeCursor();
  }

  public function getAll(): array {
    $images = [];
    $req = $this->db->query("SELECT * FROM `image` ORDER BY name");
    $datas = $req->fetchAll();
    foreach($datas as $data){
      $image = new Image($data);
      $images [] = $image;
    }
    $req->closeCursor();
    return $images;
  }

  public function getById(int $id): Image {
    $req = $this->db->prepare("SELECT * FROM `image` WHERE id = :id");
    $req->bindValue(":id", $id, PDO::PARAM_INT);
    $req->execute();
    $data = $req->fetch(PDO::FETCH_ASSOC);
    $image = new Image($data);
    $req->closeCursor();
    return $image;
  }

  public function getAllByName(string $input): array {
    $images = [];
    $req = $this->db->prepare("SELECT * FROM `image` WHERE name LIKE :input");
    $req->bindValue(":input", "%$input%", PDO::PARAM_STR);
    $req->execute();
    $datas = $req->fetchAll();
    foreach($datas as $data){
      $image = new Image($data);
      $images [] = $image;
    }
    $req->closeCursor();
    return $images;
  }

  public function update(image $image): void {
    $req = $this->db->prepare("UPDATE `image` SET name = :name, path = :path WHERE id = :id");
    $req->bindValue(":name", $image->getName(), PDO::PARAM_STR);
    $req->bindValue(":path", $image->getPath(), PDO::PARAM_STR);
    $req->bindValue(":id", $image->getId(), PDO::PARAM_INT);
    $req->execute();
    $req->closeCursor();
  }

  public function delete($id): void {
    $req = $this->db->prepare("DELETE FROM `image` WHERE id = :id");
    $req->bindValue(":id", $id, PDO::PARAM_INT);
    $req->execute();
    $req->closeCursor();
  }
}