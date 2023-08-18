<?php
ob_start();
?>

<div class="container">
  <form action="" method="post">
    <label class="form-label" for="number">Numéro</label>
    <input 
      required
      type="number" 
      name="number" 
      id="number" 
      class="form-control" 
      min=1 
      max=1000 
      placeholder="Le numéro du Pokemon"
      <?php if($_GET['page'] === 'updatePokemon') : ?>
        value="<?= $pokemon->getNumber() ?>"
      <?php endif ?>
    />

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
      <?php if($_GET['page'] === 'updatePokemon') : ?>
        value="<?= $pokemon->getName() ?>"
      <?php endif ?>
    />

    <label class="form-label" for="description">Description</label>
    <textarea 
      required
      class="form-control" 
      name="description" 
      id="description" 
      cols="30" 
      rows="6" 
      placeholder="La description du Pokemon" 
      minlength="10" 
      maxlength="200"
      <?php if($_GET['page'] === 'updatePokemon') : ?>
        ><?= $pokemon->getDescription() ?></textarea>
      <?php else : ?>
        ></textarea>
      <?php endif ?>

    <label class="form-label" for="type1">Type 1</label>
    <select required class="form-select" name="type1" id="type1">
      <option value="">--</option>
      <?php foreach($types as $type) : ?> 
        <option 
          <?php if($_GET['page'] === 'updatePokemon') : ?>
            <?= $type->getId() === $pokemon->getIdType1() ? "selected" : "" ?>
          <?php endif ?>
          value="<?= $type->getId() ?>"><?= $type->getName() ?>
        </option>
      <?php endforeach ?>
    </select>

    <label class="form-label" for="type2">Type 2</label>
    <select class="form-select" name="type2" id="type2">
      <option value="">--</option>
      <?php foreach($types as $type) : ?> 
        <option 
          <?php if($_GET['page'] === 'updatePokemon') : ?>
            <?= $type->getId() === $pokemon->getIdType2() ? "selected" : "" ?>
          <?php endif ?>
          value="<?= $type->getId() ?>"><?= $type->getName() ?>
        </option>
      <?php endforeach ?>
    </select>

    <label class="form-label" for="image">Image</label>
    <select class="form-select" name="image" id="image">
      <option value="">--</option>
      <?php foreach($images as $image) : ?> 
        <option 
          <?php if($_GET['page'] === 'updatePokemon') : ?>
            <?= $image->getId() === $pokemon->getIdImage() ? "selected" : "" ?>
          <?php endif ?>
          value="<?= $image->getId() ?>"><?= $image->getName() ?>
        </option>
      <?php endforeach ?>
    </select>

    <?php if($_GET['page'] === 'createPokemon') : ?>
      <input type="submit" class="btn btn-success mt-3" value="Créer">
    <?php else : ?>
      <input type="submit" class="btn btn-success mt-3" value="Modifier">
    <?php endif ?>
    <a href="./index.php" class="btn btn-danger mt-3">Annuler</a>
  </form>
</div>

<?php
$content = ob_get_clean();
if($_GET['page'] === 'createPokemon') {
  $title = 'Create Pokemon';
} else {
  $title = 'Update Pokemon';
}
$activeHome = "";
$activeTypes = "";
$activeImages = "";

require_once 'views/layout.php';