<?php


if (isset($_POST['btnSauvegarder'])) {
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $id_article = $_GET['id'];
    $photo = $_POST['photo'];
    $date_article = $_POST['date_article'];
    $id_categorie = $_POST['id_categorie'];
    if ($_POST['statut']){
        $statut=1;
    }
    else{
        $statut=0;
    }
    $sql = $pdo->prepare('UPDATE article SET 
                        titre=:titre, contenu=:contenu, photo=:photo, 
                        date_article=:date_article, id_categorie=:id_categorie, statut=:statut 
                        WHERE id_article=:id_article ');
    insertChamps($sql, ':titre', $titre);
    insertChamps($sql, ':contenu', $contenu);
    insertChamps($sql, ':id_article', $id_article);
    insertChamps($sql, ':photo', $photo);
    insertChamps($sql, ':date_article', $date_article);
    insertChamps($sql, ':id_categorie', $id_categorie);
    insertChamps($sql, ':statut', $statut);
    $sql->execute();
}

$sql = $pdo->prepare('SELECT * FROM article 
                    join categorie on article.id_categorie=categorie.id_categorie 
                    and id_article=:id_article');
insertChamps($sql, ':id_article', $_GET['id']);
$sql->execute();
$res = $sql->fetch(PDO::FETCH_OBJ);

?>
<div class="container">
    <div class="col-sm-12 ">
        <div class="card ">
            <div class="card-body ">
                <form action="" method="POST">
                    <div class="row">
                        <div class="form-group col-12 col-sm-6 col-md-3 ">
                            <label for="titre">Titre</label>
                            <input name="titre" id="titre" class="form-control text-center bg-dark text-white" value="<?= $res->titre; ?>">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-md-3 ">
                            <label for="date">Date</label>
                            <input name="date_article" id="date" class="form-control bg-dark text-white" type="text" value="<?= $res->date_article; ?>">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-md-3">
                            <label for="photo">Image</label>
                            <input name="photo" id="photo" class="form-control bg-dark text-white" type="text" value="<?= $res->photo; ?>">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-md-3 ">
                            <label for="categorie">Catégorie</label>
                            <select class="form-control bg-dark text-white" name="categorie" id="categorie" required >
                                <option><?= $res->nom; ?></option>
                                <?php
                                $sql1 = $pdo->prepare('SELECT * FROM categorie order by nom');
                                $sql1->execute();
                                $res1 = $sql1->fetchAll(PDO::FETCH_OBJ);

                                foreach ($res1 as $row1) {
                                ?>
                                    <option value="<?= $row1->id_categorie ?>"><?= $row1->nom; ?></option>
                                <?php

                                }
                                ?>
                            </select>
                            <input type="hidden" name="id_categorie" value="<?= $res->id_categorie ?>" id="id">
                        </div>
                    </div>
                    <img class="d-block w-100 mb-2" src="<?= article . $res->photo ?>" alt=" Third slide">
                    <div class='form-group'>
                        <label for="contenu">Contenu</label>
                        <textarea name="contenu" rows="10" class="form-control bg-dark text-white" id="contenu" name="contenu" required><?= $res->contenu; ?></textarea>
                    </div>
                    <div class='form-group'>
                        <label for="statut">Publier</label>
                        <?php if ($res->statut != 0) {
                        ?>
                            <input name="statut" id="statut" class="" type="checkbox" checked>
                        <?php
                        } else {
                        ?>
                            <input name="statut" id="statut" class="" type="checkbox">
                        <?php
                        }
                        ?>
                    </div>
                    <div class="dropdown-divider"></div>
                    <button type="submit" name="btnSauvegarder" class="btn btn-success"><i class="fa fa-floppy-o"></i> Sauvegarder</button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    let select = document.querySelector('#categorie');
    select.addEventListener('change', () => {
        document.getElementById('id').value = (select.value);
    });
</script>