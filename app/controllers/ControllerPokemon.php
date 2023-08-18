<?php

require_once 'models/PokemonsManager.php';
require_once 'models/Pokemon.php';
require_once 'models/Type.php';
require_once 'models/ImagesManager.php';
require_once 'models/Image.php';

class ControllerPokemon
{
  public function showAccueil(): void
  {
    $pokemonsManager = new PokemonsManager();
    $pokemons = $pokemonsManager->getAll();
    $typesManager = new TypesManager();
    $imagesManager = new ImagesManager();
    $typeSelected = "";
    $input = "";

    try {
      if ($_POST) {
        $input = $_POST["search"];
        $typeSelected = $_POST["types"];
        if(!$typeSelected) {
          $pokemons = $pokemonsManager->getAllByString($input);
        } else {
          $pokemons = $pokemonsManager->getAllByType($typeSelected, $input);
        }
        
        include 'views/accueil.php';
      }
    } catch (Exception $e) {
      $error = $e->getMessage();
      echo $error;
    }

    include 'views/accueil.php';
  }

  public function showCreatePokemon(): void
  {
    $pokemonsManager = new PokemonsManager();
    $typesManager = new TypesManager();
    $types = $typesManager->getAll();
    $imagesManager = new ImagesManager();
    $images = $imagesManager->getAll();
    $error = null;

    try {
      if ($_POST) {
        $number = $_POST["number"];
        $name = $_POST["name"];
        $description = $_POST["description"];
        $idType1 = $_POST["type1"];
        $idType2 = $_POST["type2"] === "" ? null : $_POST["type2"];
        $idImage = $_POST["image"] === "" ? null : $_POST["image"];

        if ($number < 1 || $number > 1000 || strlen($name) < 3 || strlen($name) > 40 || strlen($description) < 10 || strlen($description) > 200) {
          throw new Exception("Les données saisies ne sont pas correctes...");
        } else {
          $dataPokemon = [
            "number" => $number,
            "name" => $name,
            "description" => $description,
            "idType1" => $idType1,
            "idType2" => $idType2,
            "idImage" => $idImage
          ];
          $pokemonCreated = new Pokemon($dataPokemon);
          $pokemonsManager->create($pokemonCreated);
          header("Location: ./index.php");
        }
      }
    } catch (Exception $e) {
      $error = $e->getMessage();
      echo $error;
    }

    require_once 'views/createUpdatePokemonForm.php';
  }

  public function showUpdatePokemon(): void
  {
    $pokemonsManager = new PokemonsManager();
    $pokemon = $pokemonsManager->get($_GET["id"]);
    $typesManager = new TypesManager();
    $types = $typesManager->getAll();
    $imagesManager = new ImagesManager();
    $images = $imagesManager->getAll();
    $error = null;

    try {
      if ($_POST) {
        $number = $_POST["number"];
        $name = $_POST["name"];
        $description = $_POST["description"];
        $idType1 = $_POST["type1"];
        $idType2 = $_POST["type2"] === "" ? null : $_POST["type2"];
        $idImage = $_POST["image"] === "" ? null : $_POST["image"];

        if ($number < 1 || $number > 1000 || strlen($name) < 3 || strlen($name) > 40 || strlen($description) < 10 || strlen($description) > 200) {
          throw new Exception("Les données saisies ne sont pas correctes...");
        } else {
          $dataPokemon = [
            "id" => $_GET["id"],
            "number" => $number,
            "name" => $name,
            "description" => $description,
            "idType1" => $idType1,
            "idType2" => $idType2,
            "idImage" => $idImage
          ];
          $pokemonUpdated = new Pokemon($dataPokemon);
          $pokemonsManager->update($pokemonUpdated);
          header("Location: ./index.php");
        }
      }
    } catch (Exception $e) {
      $error = $e->getMessage();
      echo $error;
    }

    require_once 'views/createUpdatePokemonForm.php';
  }

  public function deletePokemon(): void
  {
    $pokemonsManager = new PokemonsManager();
    $pokemonsManager->delete($_GET["id"]);
    header("Location: ./index.php");
  }
}