<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">


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
                <?php
                if (isset($_SESSION['user'])) {
                    if ($_SESSION['roles'] != 1) {
                ?>
                        <li class="nav-item ">
                            <a class="nav-link text-light" href="index.php?page=articles">Articles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="index.php?page=profil">Pofile <i class="fa fa-user"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="index.php?page=deconnexion">Déconnexion</a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="nav-item ">
                            <a class="nav-link text-light" href="index.php?page=admin_article">Articles <i class="fa fa-file-text-o"></i></a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-light" href="index.php?page=admin_categorie">Categorie</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-light" href="index.php?page=admin_commentaire">Commentaires</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-light" href="index.php?page=admin_user">Utilisateurs <i class="fa fa-users"></i></a>
                        </li>
                    <?php
                    }
                } else {
                    ?>
                    <li class="nav-item ">
                        <a class="nav-link " href="index.php?page=articles">Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=connexion">Connexion</a>
                    </li>
                <?php

                }
                ?>
            </ul>

        </div>
        <?php
        if ($_SESSION['roles'] != 1) {
        ?>
            <a class="btn btn-success text-light" href="index.php?page=deconnexion">Admin</a>
        <?php
        } else {
        ?>
            <a class="btn btn-success text-light" href="index.php?page=deconnexion"><i class="fa fa-sign-out" style="font-size:16px"></i></a>
        <?php
        }
        ?>

    </nav>

    <div class="dropdown-divider"></div>