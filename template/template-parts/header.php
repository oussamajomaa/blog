<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>MonBlog</title>


</head>

<body>

    <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><img style="width:35px" src="<?= img ?>blog.png" alt=""></a>

        <?php
        if (isset($_SESSION['user'])) {
        ?>
            <a href="#" class="badge badge-success">Bonjour <?= $_SESSION['user']; ?></a>
        <?php
        }
        ?>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link " href="index.php?page=articles">Articles <span class="sr-only">(current)</span></a>
                </li>
                <?php
                if (isset($_SESSION['user'])) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=deconnexion">Déconnexion</a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=connexion">Connexion</a>
                    </li>
                <?php
                }
                if ($_SESSION['roles'] != 0) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=ajouterArticle">Admin</a>
                    </li>

                <?php
                }
                ?>

            </ul>

        </div>
    </nav>

    <div class="dropdown-divider"></div>