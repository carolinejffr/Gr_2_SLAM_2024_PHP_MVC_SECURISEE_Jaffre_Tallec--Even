<?= $this->renderSection("preHTML") ?>

<!DOCTYPE HTML>
<html class="text-bg-dark p-3">
<head>
    <!-- Le titre de la page est modifiable -->
	<title><?= $this->renderSection("titre") ?></title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Nous utilisons le framework Bootstrap 5.3 pour la partie graphique du site -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
<header>
	<img src="logo_GSB_64.png" alt="logo">
    <h1>GSB Application Note de Frais
    <!-- Le h1 de la page est modifiable -->
    <?= $this->renderSection("h1") ?>
    </h1>
</header>
<body style="margin: 50px;" class="text-bg-dark p-3">

    <!-- Le contenu de la page est modifiable -->
    <?= $this->renderSection("contenu") ?>

</body>
<footer>
    <br/>
    <br/>
    <br/>
    <h5>GSB - Galaxy Swiss Bourdin. Tous droits réservés. EST. 2023</h5>
</footer>
</html>
