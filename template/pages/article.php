<?php

if (isset($_SESSION['user'])) {
    if (isset($_POST['submitConnect'])) {
        $id_utilisateur = $_SESSION['id_utilisateur'];
        $id_article = $_GET['id'];
        $date = date('Y-m-d H:i:s');
        $sql1 = $pdo->prepare('INSERT INTO commentaire (titre_comm,commentaire,date_comm,id_article,id_utilisateur)
                            VALUES(:titre_comm,:commentaire,:date_comm,:id_article,:id_utilisateur)');
        insertChamps($sql1, ':titre_comm', $_POST['titre_comm']);
        insertChamps($sql1, ':commentaire', $_POST['commentaire']);
        insertChamps($sql1, ':date_comm', $date);
        insertChamps($sql1, ':id_article', $id_article);
        insertChamps($sql1, ':id_utilisateur', $id_utilisateur);
        $sql1->execute();
    }
}

$sql = $pdo->prepare('SELECT * FROM article 
                    join categorie on article.id_categorie=categorie.id_categorie
                    and id_article=:id_article');

insertChamps($sql, ':id_article', $_GET['id']);
$sql->execute();
$res = $sql->fetch(PDO::FETCH_OBJ);

$sql2 = $pdo->prepare('SELECT * from commentaire
                        join article on commentaire.id_article=article.id_article
                        join utilisateur on commentaire.id_utilisateur=utilisateur.id_utilisateur
                        and commentaire.id_article=:id_article order by date_comm desc');

insertChamps($sql2, ':id_article', $_GET['id']);
$sql2->execute();
$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);

?>
<div class="container">
    <div class="col-sm-12 ">
        <div class="card ">
            <div class="card-body ">
                <h1 class="card-title text-center"><?= $res->titre; ?></h1>
                <img class="d-block w-100 mb-2 " src="<?= article . $res->photo ?>" alt=" Third slide">
                <h5 class="badge badge-danger"><?= $res->date_article; ?></h5>
                <h5 class="badge badge-danger"><?= $res->nom; ?></h5>
                <div class="dropdown-divider"></div>
                <div>
                    <h6 class="text-justify"><?= $res->contenu; ?></h6>
                </div>
                <div class="dropdown-divider"></div>
                <a class="badge badge-info" href="index.php?page=articles">Retour &#8604;</a>
                <div class="dropdown-divider"></div>
                <?php
                if (isset($_SESSION['user'])) {
                ?>
                    <form method="POST">
                        <div class="form-group">
                            <label class="badge badge-dark" for="contenu">Ajouter un commentaire!!</label>
                            <textarea type="password" rows="3" class="form-control" id="contenu" name="commentaire" required autofocus></textarea>
                        </div>
                        <input type="hidden" name="titre_comm" value="<?= $res->titre; ?>">
                        <button type="submit" name="submitConnect" class="btn btn-success" id="submitConnect">Enregistrer</button>
                        <div class="dropdown-divider"></div>
                    </form>

                <?php
                }
                ?>
                <?php
                foreach ($res2 as $row) {
                ?>
                    <div class="row d-flex align-items-center btn btn-dark m-1">
                        <div class="col-12  col-md-1 text-left">
                            <p class="badge badge-dark"><?= $row->pseudo; ?></p>
                            <div>
                                <img style="width: 50px; height:50px" class="rounded-circle" src="<?= user . $row->photo_utilisateur; ?>" alt="">
                            </div>
                        </div>
                        <div class="col-12  col-md-11 text-left">
                            <p class="m-1 p-2 small"><?= $row->date_comm; ?></p>
                            <p class="m-1 p-2 small text-justify"><?= $row->commentaire; ?></p>
                            <p class="m-1 p-2 small text-primary"><?= $row->email; ?></p>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
        </div>
    </div>
</div>