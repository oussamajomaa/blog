<?php
if ($_SESSION){
    $sql = $pdo->prepare('SELECT * FROM article join categorie on article.id_categorie=categorie.id_categorie');
    $sql->execute();
    $res = $sql->fetchAll(PDO::FETCH_OBJ);
    if ($res) {
    ?>
        <div class="container">
            <h3>Liste des Articles</h3>
            <table class="table">
                <thead class="table-info">
                    <tr>
                        <th>Titre</th>
                        <th>Date</th>
                        <th>Categorie</th>
                        <th>Publié</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php
                foreach ($res as $row) {
                ?>
                    <tr>
                        <td><?= $row->titre; ?></td>
                        <td><?= $row->date_article; ?></td>
                        <td><?= $row->nom; ?></td>
                        <?php if ($row->statut != 0) {
                            echo '<td ><input type="checkbox" checked disabled></td>';
                        } else {
                            echo '<td ><input type="checkbox" disabled></td>';
                        } ?>

                        <td>
                            <!--<a class="badge badge-success" href=""><i class="fa fa-edit"></i></a>-->

                            <a class="badge badge-info " href="index.php?page=admin_showArticle&id=<?= $row->id_article; ?>" title="afficher l'article"><i class="fa fa-eye"></i></a>
                            <a class="badge badge-danger " href="index.php?page=admin_delete&id=<?= $row->id_article; ?>" title="supprimer l'article"><i class=" fa fa-trash-o"></i></i></a>


                        </td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <td><a class="btn btn-primary" href="index.php?page=admin_ajouterArticle" title="ajouter un article"><i class="fa fa-plus-square"></i></a></td>
                </tr>
            </table>
        </div>
    <?php
    } else {
    ?>
        <div class="container col-4">
            <div class="alert alert-danger alert-dismissible fade show col-md-12" role="alert">
                <strong>
                    <center>Aucun article à afficher !!</center>
                </strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <div class="container">
            <a class="btn btn-primary" href="index.php?page=admin_ajouterArticle" title="ajouter un article"><i class="fa fa-plus-square"></i></a>
        </div>
    <?php
    }
}
else{
    header('location:index.php?page=articles');
}
    ?>
