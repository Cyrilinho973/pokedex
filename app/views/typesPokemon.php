<?php
ob_start();
?>

  <?php if(!$types) : ?>
    <div class="container text-center mt-5 text-danger fs-1">
      <span>Aucun type de Pokemon n'existe encore ...</span>
      <a href="?page=createTypePokemon" class="btn btn-success mt-1">Créer</a>
    </div>
  <?php else : ?>
    <div class="container">
      <a href="?page=createTypePokemon" class="btn btn-success mt-5 position-fixed top-10">Créer</a>
      <section class="d-flex flex-wrap justify-content-center">
        <?php foreach($types as $type) : ?>
          <div class="card m-5 text-center opacity-75" style="width: 18rem;">
            <div class="card-body mt-3">
              <div>
                <span 
                  class="text-light rounded-pill py-1 px-3" 
                  style="background-color: <?= $type->getColor() ?>">
                  <?= $type->getName() ?>
                </span>
              </div>
              <br>
              <span>
                color : <?= $type->getColor() ?>
              </span>
            </div>
            <div class="card-footer">
              <a href="?page=updateTypePokemon&id=<?= $type->getId() ?>" class="btn btn-warning float-start">Modifier</a>
              <a href="?page=deleteTypePokemon&id=<?= $type->getId() ?>" class="btn btn-danger float-end">Supprimer</a>
            </div>
          </div>
        <?php endforeach ?>
      </section>
    </div>
  <?php endif ?>  

<?php
$content = ob_get_clean();
$title = 'My Types of Pokemon';
$activeHome = "";
$activeTypes = "active";
$activeImages = "";
if(count($types) < 4) {
  $footer = "w-100 position-absolute bottom-0";
} else {
  $footer = "";
}

require_once 'views/layout.php';