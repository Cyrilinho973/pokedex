<?php
ob_start();
?>

<div class="container">
  <form action="" method="post">
    <label class="form-label" for="name">Nom</label>
    <input 
      required
      type="text" 
      name="name" 
      id="name" 
      class="form-control" 
      minlength="3" 
      maxlength="40" 
      placeholder="Le nom du type de Pokemon"
      <?php if($_GET['page'] === 'updateTypePokemon') : ?>
        value="<?= $type->getName() ?>"
      <?php endif ?>
    />

    <label class="form-label" for="color">Couleur</label>
    <input 
      required
      type="color" 
      name="color" 
      id="color" 
      class="form-control"
      style="width:100px"
      <?php if($_GET['page'] === 'updateTypePokemon') : ?>
        value="<?= $type->getColor() ?>"
      <?php endif ?>
    />

    <?php if($_GET['page'] === 'createTypePokemon') : ?>
      <input type="submit" class="btn btn-success mt-3" value="Créer">
    <?php else : ?>
      <input type="submit" class="btn btn-success mt-3" value="Modifier">
    <?php endif ?>
    <a href="?page=typesPokemon" class="btn btn-danger mt-3">Annuler</a>
  </form>
</div>

<?php
$content = ob_get_clean();
if($_GET['page'] === 'createTypePokemon') {
  $title = 'Create type of Pokemon';
} else {
  $title = 'Update type of Pokemon';
}
$activeHome = "";
$activeTypes = "";
$activeImages = "";
$footer = "w-100 position-absolute bottom-0";

require_once 'views/layout.php';