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
    $_GET["error"] = null;

    try {
      if ($_POST) {
        $extensions = array('jpg', 'jpeg', 'png', 'gif');
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
          $fileInfo = pathinfo($_FILES["image"]['name']);
          if ($_FILES["image"]["size"] < 2000000) {
            if (in_array($fileInfo['extension'], $extensions)) {
              $invalidCharacters = array('', '/', '.');
              $fileName = str_replace($invalidCharacters, "-", strtolower($_POST['name']));
              $filePath = "./assets/" .$fileName. "." .$fileInfo['extension'];
              move_uploaded_file(
                $_FILES["image"]['tmp_name'], 
                $filePath,
              );
              $dataImage = [
                "name" => $_POST["name"],
                "path" => $filePath,
              ];
              $imageCreated = new Image($dataImage);
              $imagesManager->create($imageCreated);
            } else {
              throw new Exception("Le fichier soumis possède une extension non valide (autorisé : jpg, jpeg, png et gif) !");
            }           
          } else {
            throw new Exception("Le fichier soumis est supérieur à 2MO !");
          }
        } else {
          throw new Exception("Le fichier n'a pas été téléchargé !");
        }
        header("Location: ./index.php?page=imagesPokemon");
      }
    } catch (Exception $e) {
      $error = $e->getMessage();
      echo $error;
      $_GET["error"] = $error;
    }

    require_once 'views/createUpdateImageForm.php';
  }

  public function showUpdateImagePokemon(): void
  {
    $imagesManager = new ImagesManager();
    $image = $imagesManager->getById($_GET["id"]);
    $error = null;
    $_GET["error"] = null;

    try {
      if ($_POST) {
        $extensions = array('jpg', 'jpeg', 'png', 'gif');
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
          $fileInfo = pathinfo($_FILES["image"]['name']);
          if ($_FILES["image"]["size"] < 2000000) {
            if (in_array($fileInfo['extension'], $extensions)) {
              $invalidCharacters = array('', '/', '.');
              $fileName = str_replace($invalidCharacters, "-", strtolower($_POST['name']));
              $filePath = "./assets/" .$fileName. "." .$fileInfo['extension'];
              move_uploaded_file(
                $_FILES["image"]['tmp_name'], 
                $filePath,
              );
            $dataImage = [
              "id" => $_GET["id"],
              "name" => $_POST["name"],
              "path" => $filePath,
            ];
            } else {
              throw new Exception("Le fichier soumis possède une extension non valide (autorisé : jpg, jpeg, png et gif) !");
            }
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
    $image = $imagesManager->getById($_GET["id"]);
    unlink($image->getPath());
    $imagesManager->delete($_GET["id"]);
    header("Location: ./index.php?page=imagesPokemon");
  }
}