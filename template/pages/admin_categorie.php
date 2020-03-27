<?php
if ($_SESSION) {
    if (isset($_POST['categorieModif'])&&(!empty($_POST['nom_categorie']))){
        $nom=$_POST['nom_categorie'];
        $sql=$pdo->prepare('INSERT INTO categorie (nom) VALUES (:nom)');
        insertChamps($sql,':nom',$nom);
        $sql->execute();
    }


    $sql = $pdo->prepare('SELECT * FROM categorie');
    $sql->execute();
    $res = $sql->fetchAll(PDO::FETCH_OBJ);

    ?>
    <div class="container">
        <h3>Liste des Catégorie</h3>
        <table class="table">
            <thead class="table-info">
                <tr>
                    <th>Intitulé</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <?php
            foreach ($res as $row) {
            ?>
                <tr>
                    <form action="index.php?page=admin_delete&id_categorie1=<?= $row->id_categorie; ?>" method="POST">
                        <td><input type="text" value="<?= $row->nom ?>" name="nom" class="form-control"></td>
                        <td>
                            <button name="categorieModif" type="submit" class="btn btn-success " title="sauvegarder"><i class="fa fa-floppy-o"></i></button>
                            <a class="btn btn-danger " href="index.php?page=admin_delete&id_categorie=<?= $row->id_categorie; ?>" title="supprimer"><i class=" fa fa-trash-o"></i></a>
                    </form>
                    </td>
                </tr>
            <?php

            }

            ?>
        </table>
        <td><a class="btn btn-primary" id="ajouterCategorie" href="#" title="ajouter une catégorie"><i class="fa fa-plus-square"></i></a></td>
    </div>
    <div class="dropdown-divider"></div>

    <div class="container" id="container">
        <form action="" method="POST">
            <div class="form-group">
                <label for="nom_categorie">Saisissez le nom de catégorie</label>
                <input name="nom_categorie" id="nom_categorie" class="form-control bg-dark text-white" type="text">
            </div>
            <button name="categorieModif" type="submit" class="btn btn-success " title="sauvegarder"><i class="fa fa-floppy-o"></i></button>
            <!-- <button name="categorieCancel" id="cancel" type="reset" class="btn btn-info " title="annuler"><i class="fa fa-undo"></i></button> -->

        </form>
    </div>
<?php
}
else{
    header('location:index.php?page=articles');
}
?>

<script>
    document.getElementById('ajouterCategorie').addEventListener('click', () => {
        document.getElementById('container').style.display = 'block';
    })
</script>