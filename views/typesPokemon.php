<?php
ob_start();
?>

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
    

<?php
$content = ob_get_clean();
$title = 'My Types of Pokemon';
$activeHome = "";
$activeTypes = "active";
$activeImages = "";

require_once 'views/layout.php';