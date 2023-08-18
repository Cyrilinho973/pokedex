<?php

require_once 'models/PokemonsManager.php';
require_once 'models/Pokemon.php';
require_once 'models/TypesManager.php';
require_once 'models/Type.php';
require_once 'models/ImagesManager.php';
require_once 'models/Image.php';

class ControllerTypePokemon
{
  public function showTypesPokemon(): void
  {
    $typesManager = new TypesManager();
    $types = $typesManager->getAll();

    require_once 'views/typesPokemon.php';
  }

  public function showCreateTypePokemon(): void
  {
    $typesManager = new TypesManager();
    $error = null;
    $_GET["error"] = null;

    try {
      if ($_POST) {
        $name = $_POST["name"];
        $color = $_POST["color"];

        if (strlen($name) < 3 || strlen($name) > 40) {
          throw new Exception("Les données saisies ne sont pas correctes...");
        } else {
          $dataTypePokemon = [
            "name" => $name,
            "color" => $color,
          ];
          $typePokemonCreated = new Type($dataTypePokemon);
          $typesManager->create($typePokemonCreated);
          header("Location: ./index.php?page=typesPokemon");
        }
      }
    } catch (Exception $e) {
      $error = $e->getMessage();
      echo $error;
      $_GET["error"] = $error;
    }

    require_once 'views/createUpdateTypeForm.php';
  }

  public function showUpdateTypePokemon(): void
  {
    $typesManager = new TypesManager();
    $type = $typesManager->get($_GET["id"]);
    $error = null;

    try {
      if ($_POST) {
        $name = $_POST["name"];
        $color = $_POST["color"];

        if (strlen($name) < 3 || strlen($name) > 40) {
          throw new Exception("Les données saisies ne sont pas correctes...");
        } else {
          $dataTypePokemon = [
            "id" => $_GET["id"],
            "name" => $name,
            "color" => $color,
          ];
          $typePokemonUpdated = new Type($dataTypePokemon);
          $typesManager->update($typePokemonUpdated);
          header("Location: ./index.php?page=typesPokemon");
        }
      }
    } catch (Exception $e) {
      $error = $e->getMessage();
      echo $error;
    }

    require_once 'views/createUpdateTypeForm.php';
  }

  public function deleteTypePokemon(): void
  {
    $typesManager = new TypesManager();
    $typesManager->delete($_GET["id"]);
    header("Location: ./index.php?page=typesPokemon");
  }
}