<?php
ob_start();
?>

<?php if(!$pokemons) : ?>
  <div class="container text-center mt-5 text-danger fs-1">
    <span>
      <?php if(!$input && !$typeSelected) : ?>
        Aucun Pokemon n'existe pour le moment ... 
      <?php else : ?>
        Aucun Pokemon ne correspond à votre recherche ...
      <?php endif ?>
    </span>
    <a href="?page=createPokemon" class="btn btn-success mt-1">Créer</a>
  </div>
<?php else : ?>
  <div class="container">
    <a href="?page=createPokemon" class="btn btn-success mt-5 position-fixed top-10">Créer</a>
    <section class="d-flex flex-wrap justify-content-center">
      <?php foreach($pokemons as $pokemon) : ?>
        <div class="card m-5 text-center opacity-75" style="width: 18rem;">
          <?php if($pokemon->getIdImage() === null) : ?>
            <img src="" class="card-img-top w-50 img-thumbnail mx-auto mt-3 img-fluid" alt=<?= $pokemon->getName() ?>>
          <?php else : ?>
            <?php $image = $imagesManager->getById($pokemon->getIdImage()) ?>
            <img src="<?= $image->getPath() ?>" class="card-img-top w-50 img-thumbnail mx-auto mt-3 img-fluid" alt=<?= $pokemon->getName() ?>>
          <?php endif ?>
          <div class="mt-3">
            <?php if($pokemon->getIdType2() === null) : ?>
              <b>Type : </b>
              <span 
                class="text-light rounded-pill py-1 px-3" 
                style="background-color: <?= $typesManager->get($pokemon->getIdType1())->getColor() ?>">
                <?= $typesManager->get($pokemon->getIdType1())->getName() ?>
              </span>
            <?php else : ?>
              <b>Type : </b>
              <span 
                class="text-light rounded-pill py-1 px-3 me-1"
                style="background-color: <?= $typesManager->get($pokemon->getIdType1())->getColor() ?>">
                <?= $typesManager->get($pokemon->getIdType1())->getName() ?>
              </span> 
              <span 
                class="text-light rounded-pill py-1 px-3"
                style="background-color: <?= $typesManager->get($pokemon->getIdType2())->getColor() ?>">
                <?= $typesManager->get($pokemon->getIdType2())->getName() === null ? "" : $typesManager->get($pokemon->getIdType2())->getName() ?>
              </span>
            <?php endif ?>  
          </div>
          <hr>
          <div class="card-body">
            <h5 class="card-title"><?= $pokemon->getNumber() ?># <?= $pokemon->getName() ?></h5>
            <p class="card-text"><?= $pokemon->getDescription() ?></p>
          </div>
          <div class="card-footer">
            <a href="?page=updatePokemon&id=<?= $pokemon->getId() ?>" class="btn btn-warning float-start">Modifier</a>
            <a href="?page=deletePokemon&id=<?= $pokemon->getId() ?>" class="btn btn-danger float-end">Supprimer</a>
          </div>
        </div>
      <?php endforeach ?>
    </section>
  </div>
<?php endif ?>   

<?php
$content = ob_get_clean();
$title = 'My Pokedex';
$activeHome = "active";
$activeTypes = "";
$activeImages = "";
if(count($pokemons) < 4) {
  $footer = "w-100 position-absolute bottom-0";
} else {
  $footer = "";
}

require_once 'views/layout.php';