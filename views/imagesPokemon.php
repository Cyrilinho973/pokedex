<?php
ob_start();
?>

<?php if(!$images) : ?>
  <div class="container text-center mt-5 text-danger fs-1">
    <span>Aucune image de Pokemon ne correspond à votre recherche ...</span>
  </div>
<?php else : ?>
  <div class="container">
    <a href="?page=createImagePokemon" class="btn btn-success mt-5 position-fixed top-10">Créer</a>
    <section class="d-flex flex-wrap justify-content-center">
      <?php foreach($images as $image) : ?>
        <div class="card m-5 text-center opacity-75" style="width: 18rem;">
          <div class="card-body">
            <img src="<?= $image->getPath() ?>" class="card-img-top w-50 img-thumbnail mx-auto mt-3 img-fluid" alt=<?= $image->getName() ?>>
            <h5 class="card-title"><?= $image->getName() ?></h5>
          </div>
          <div class="card-footer">
            <a href="?page=updateImagePokemon&id=<?= $image->getId() ?>" class="btn btn-warning float-start">Modifier</a>
            <a href="?page=deleteImagePokemon&id=<?= $image->getId() ?>" class="btn btn-danger float-end">Supprimer</a>
          </div>
        </div>
      <?php endforeach ?>
    </section>
  </div>
  <?php endif ?>    

<?php
$content = ob_get_clean();
$title = 'My Images of Pokemon';
$activeHome = "";
$activeTypes = "";
$activeImages = "active";
if(count($images) < 4) {
  $footer = "w-100 position-absolute bottom-0";
} else {
  $footer = "";
}

require_once 'views/layout.php';