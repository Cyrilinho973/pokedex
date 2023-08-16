<?php

require_once './models/PokemonsManager.php';
require_once './models/Pokemon.php';
require_once './models/TypesManager.php';
require_once './models/Type.php';
require_once './models/ImagesManager.php';
require_once './models/Image.php';

class ControllerImagePokemon
{
  public function showImagesPokemon(): void
  {
    $imagesManager = new ImagesManager();
    $images = $imagesManager->getAll();
    $input = "";

    try {
      if ($_POST) {
        $input = $_POST["search"];
        $images = $imagesManager->getAllByName($input);
        include 'views/imagesPokemon.php';
      }
    } catch (Exception $e) {
      $error = $e->getMessage();
      echo $error;
    }

    require_once 'views/imagesPokemon.php';
  }

  public function showCreateImagePokemon(): void
  {
    $imagesManager = new ImagesManager();
    $error = null;

    try {
      if ($_POST) {
        if ($_FILES["image"]["error"] === UPLOAD_ERR_OK) {
          if ($_FILES["image"]["size"] < 2000000) {
            $dataImage = [
              "name" => $_POST["name"],
              "path" => "./assets/" . $_FILES["image"]["full_path"]
            ];
            $imageCreated = new Image($dataImage);
            $imagesManager->create($imageCreated);
          } else {
            throw new Exception("Le fichier soumis est supérieur à 2MO...");
          }
        } else {
          throw new Exception("Le fichier n'a pas été téléchargé...");
        }
        header("Location: ./index.php?page=imagesPokemon");
      }
    } catch (Exception $e) {
      $error = $e->getMessage();
      echo $error;
    }

    require_once 'views/createUpdateImageForm.php';
  }

  public function showUpdateImagePokemon(): void
  {
    $imagesManager = new ImagesManager();
    $image = $imagesManager->getById($_GET["id"]);
    $error = null;

    try {
      if ($_POST) {
        if ($_FILES["image"]["error"] === UPLOAD_ERR_OK) {
          if ($_FILES["image"]["size"] < 2000000) {
            $dataImage = [
              "id" => $_GET["id"],
              "name" => $_POST["name"],
              "path" => "./assets/" . $_FILES["image"]["full_path"]
            ];
          } else {
            throw new Exception("Le fichier soumis est supérieur à 2MO...");
          }
        } else {
          $dataImage = [
            "id" => $_GET["id"],
            "name" => $_POST["name"],
            "path" => $image->getPath()
          ];
        }
        $imageUpdated = new Image($dataImage);
        $imagesManager->update($imageUpdated);
        header("Location: ./index.php?page=imagesPokemon");
      } else {
      }
    } catch (Exception $e) {
      $error = $e->getMessage();
      echo $error;
    }

    require_once 'views/createUpdateImageForm.php';
  }

  public function deleteImagePokemon(): void
  {
    $imagesManager = new ImagesManager();
    $imagesManager->delete($_GET["id"]);
    header("Location: ./index.php?page=imagesPokemon");
  }
}