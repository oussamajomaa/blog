<?php
if (isset($_POST['ajouterArticle'])) {
    $date = date("Y-m-d");
    $sql = $pdo->prepare("INSERT INTO article (titre,photo,contenu,statut,id_categorie,date_article)
                        VALUES (:titre,:photo,:contenu,:statut,:id_categorie,:date_article)");
    insertChamps($sql, ':titre', $_POST['titre']);
    insertChamps($sql, ':date_article', $date);
    insertChamps($sql, ':photo', $_POST['photo']);
    insertChamps($sql, ':contenu', $_POST['contenu']);
    insertChamps($sql, ':statut', 0);
    insertChamps($sql, ':id_categorie', $_POST['id_categorie']);
    insertChamps($sql, ':date_article', $date);
    $res=$sql->execute();
}
?>


<div class="container col-sm-12 col-md-10 col-lg-8">
    <div class="text-center">
        <h3 class="text-success">Ajouter un article</h3>
    </div>
    <form action="" method="POST">

        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" class="form-control" id="titre" name="titre" required>
        </div>
        <div class="form-group">
            <label for="date_article">Adresse Mail</label>
            <input type="date" class="form-control" id="date_article" name="date_article" required>
        </div>
        <div class="form-group">
            <label for="photo">Image</label>
            <input type="text" class="form-control" id="photo" name="photo" required>
        </div>
        <div class="form-group">
            <label for="contenu">Contenu de l'article</label>
            <textarea type="password" rows="10" class="form-control" id="contenu" name="contenu" required></textarea>
        </div>
        <div class="form-group">
            <label for="categorie">Catégorie</label>
            <select class="form-control" name="categorie" id="categorie" required>
                <option hidden selected></option>
                <?php
                $sql = $pdo->prepare('SELECT * FROM categorie order by nom');
                $sql->execute();
                $res = $sql->fetchAll(PDO::FETCH_OBJ);
                var_dump($res);
                foreach ($res as $row) {
                ?>
                    <option value="<?= $row->id_categorie ?>"><?= $row->nom; ?></option>
                <?php

                }
                ?>
            </select>
            <input type="hidden" name="id_categorie" value="" id="id">
        </div>
        <button type="submit" class="btn btn-success" name="ajouterArticle">Enregistrer</button>
    </form>
</div>

<script>
    let select = document.querySelector('#categorie');
    select.addEventListener('change', () => {
        document.getElementById('id').value=(select.value);
    });


</script>