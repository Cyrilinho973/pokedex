<header>
  <nav class="fixed-top navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="assets/pokeball.png" style="width: 50px;" class="navbar-logo" alt="Logo pokédex">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link <?= $activeHome ?>" href="./index.php">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $activeTypes ?>" href="?page=typesPokemon">Types</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $activeImages ?>" href="?page=imagesPokemon">Images</a>
          </li>
        </ul>
        <?php if(!isset($_GET['page']) || $_GET["page"] === 'imagesPokemon') : ?>
          <form class="d-flex" role="search" method="post">
            <?php if(!isset($_GET['page'])) : ?>
              <?php $types = $typesManager->getAll() ?>
              <label class="form-label text-success me-2 text-decoration-underline" for="types">Types</label>
              <select class="form-select me-2" name="types" id="types">
                <option value="">All types</option>
                <?php foreach($types as $type) : ?> 
                  <option
                    <?= $type->getId() == $typeSelected ? "selected" : "" ?>
                    value="<?= $type->getId() ?>"><?= $type->getName() ?>
                  </option>
                <?php endforeach ?>
              </select>
            <?php endif ?>
            <input 
              class="form-control me-2" 
              type="search" 
              name="search" 
              value="<?= $input ?>"
              placeholder="Chercher"
            />
            <button class="btn btn-outline-success" type="submit">Chercher</button>
          </form>
        <?php endif ?>
      </div>
    </div>
  </nav>
</header>
