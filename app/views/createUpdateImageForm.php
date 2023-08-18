<?php
ob_start();
?>

<div class="container">
  <?php if($_GET["error"]) : ?>
    <div class="alert alert-danger text-center" role="alert">
      <?= $_GET["error"] ?>
    </div>
  <?php endif ?>
  <form action="" method="post" enctype="multipart/form-data">
    <label class="form-label" for="name">Nom</label>
    <input 
      required
      type="text" 
      name="name" 
      id="name" 
      class="form-control" 
      minlength="3" 
      maxlength="40" 
      placeholder="Le nom du Pokemon"
      <?php if($_GET['page'] === 'updateImagePokemon') : ?>
        value="<?= $image->getName() ?>"
      <?php elseif($_POST) : ?>
        value="<?= $_POST["name"] ?>"      
      <?php endif ?>
      />

    <label class="form-label" for="image">Image</label>
    <input
      <?php if($_GET['page'] === 'createImagePokemon') : ?>
        required
      <?php endif ?>
      class="form-control" 
      type="file" 
      name="image" 
      id="image" 
    >

    <?php if($_GET['page'] === 'createImagePokemon') : ?>
      <input type="submit" class="btn btn-success mt-3" value="Créer">
    <?php else : ?>
      <input type="submit" class="btn btn-success mt-3" value="Modifier">
    <?php endif ?>
    <a href="?page=imagesPokemon" class="btn btn-danger mt-3">Annuler</a>
  </form>
</div>

<?php
$content = ob_get_clean();
if($_GET['page'] === 'createImagePokemon') {
  $title = 'Create image of Pokemon';
} else {
  $title = 'Update image of Pokemon';
}
$activeHome = "";
$activeTypes = "";
$activeImages = "";
$footer = "w-100 position-absolute bottom-0";

require_once 'views/layout.php';