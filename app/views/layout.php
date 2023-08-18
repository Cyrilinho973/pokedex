<!DOCTYPE html>
<html class="h-100" lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body class="h-100" style="background: linear-gradient(0.25turn, #ffcb05, #c7a008, #2a75bb, #3c5aa6);" >
  <div class="h-100 position-relative" >
    <?php include_once("views/header.php") ?>

    <main style="margin-top: 80px;" >
      <?= $content ?>
    </main>

    <?php include_once("views/footer.php") ?>
  </div>
  

  <!-- Option 1 : Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>