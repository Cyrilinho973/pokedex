<?php

require_once 'controllers/ControllerPokemon.php';
require_once 'controllers/ControllerTypePokemon.php';
require_once 'controllers/ControllerImagePokemon.php';

$controllerPokemon = new ControllerPokemon();
$controllerTypePokemon = new ControllerTypePokemon();
$controllerImagePokemon = new ControllerImagePokemon();

if (!isset($_GET['page'])) {
    $controllerPokemon->showAccueil();
} elseif ($_GET['page'] === 'createPokemon') {
    $controllerPokemon->showCreatePokemon();
} elseif ($_GET['page'] === 'deletePokemon') {
    $controllerPokemon->deletePokemon();
} elseif ($_GET['page'] === 'updatePokemon') {
    $controllerPokemon->showUpdatePokemon();
} elseif ($_GET['page'] === 'typesPokemon') {
    $controllerTypePokemon->showTypesPokemon();
} elseif ($_GET['page'] === 'createTypePokemon') {
    $controllerTypePokemon->showCreateTypePokemon();
} elseif ($_GET['page'] === 'deleteTypePokemon') {
    $controllerTypePokemon->deleteTypePokemon();
} elseif ($_GET['page'] === 'updateTypePokemon') {
    $controllerTypePokemon->showUpdateTypePokemon();
} elseif ($_GET['page'] === 'imagesPokemon') {
    $controllerImagePokemon->showImagesPokemon();
} elseif ($_GET['page'] === 'createImagePokemon') {
    $controllerImagePokemon->showCreateImagePokemon();
} elseif ($_GET['page'] === 'deleteImagePokemon') {
    $controllerImagePokemon->deleteImagePokemon();
} elseif ($_GET['page'] === 'updateImagePokemon') {
    $controllerImagePokemon->showUpdateImagePokemon();
}

echo 'Hello world';