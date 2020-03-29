<?php
if ($_SESSION) {

    $sql = $pdo->prepare('SELECT * FROM utilisateur');
    $sql->execute();
    $res = $sql->fetchAll(PDO::FETCH_OBJ);

?>
    <div class="container">
        <h3>Liste des utilisateurs</h3>
        <table class="table">
            <thead class="table-info">
                <tr>
                    <th>Pseudo</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Photo</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <?php
            foreach ($res as $row) {
            ?>
                <tr>
                    <td><?= $row->pseudo ?></td>
                    <td><?= $row->email ?></td>
                    <td><?= $row->roles ?></td>
                    <td><img width="10%" src="<?= user.$row->photo_utilisateur ?>" alt=""></td>
                    <td>
                        <a class="btn btn-danger " href="index.php?page=admin_delete&id_utilisateur=<?= $row->id_utilisateur; ?>" title="supprimer"><i class=" fa fa-trash-o"></i></a>
                    </td>
                </tr>
            <?php

            }

            ?>
        </table>
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
} else {
    header('location:index.php?page=articles');
}
?>