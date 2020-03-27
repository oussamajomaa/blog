<?php
if ($_SESSION) {


    $sql = $pdo->prepare('SELECT COUNT(commentaire.id_article),nom,titre,article.id_article FROM commentaire
                        join article on commentaire.id_article=article.id_article
                        join categorie on article.id_categorie=categorie.id_categorie
                        join utilisateur on commentaire.id_utilisateur=utilisateur.id_utilisateur
                        group by commentaire.id_article');
    $sql->execute();
    $res = $sql->fetchAll(PDO::FETCH_OBJ);

    if ($res) {
?>
        <div class="container">
            <?php
            foreach ($res as $row) {
            ?>

                <table class="table ">

                    <thead class="table-info ">
                        <tr>
                            <th class='th_titre '><span class="badge badge-dark"><?= $row->titre; ?></span></th>
                            <th class="th_liste"></th>
                            <th class="th_titre"><span class="badge badge-dark"><?= $row->nom; ?></span></th>
                            <th class="th_liste"></th>
                            <th class="th_liste"><a class="allComment badge badge-success" href="#"><i class="fa fa-chevron-down"></i> Liste des Commentaires</a></th>
                        </tr>

                    </thead>
                    <?php
                    $sq = $pdo->prepare('SELECT * FROM commentaire
                                        join article on commentaire.id_article=article.id_article
                                        join categorie on article.id_categorie=categorie.id_categorie
                                        join utilisateur on commentaire.id_utilisateur=utilisateur.id_utilisateur
                                        where commentaire.id_article=:id_article');
                    insertChamps($sq, ':id_article', $row->id_article);
                    $sq->execute();
                    $re = $sq->fetchAll(PDO::FETCH_OBJ);
                    if ($re) {
                    ?>
                        <?php
                        foreach ($re as $ro) {
                        ?>
                            <tr class="tr">
                                <td colspan="5">
                                    <div class="row d-flex align-items-center btn btn-dark m-1">
                                        <div class="col-12  col-md-1 text-left">
                                            <p class="badge badge-dark"><?= $ro->pseudo; ?></p>
                                            <div>
                                                <img style="width: 50px" src="<?= user . $ro->photo_utilisateur; ?>" alt="">
                                            </div>
                                        </div>
                                        <div class="col-12  col-md-11 text-left">
                                            <p class="m-1 p-2 small"><?= $ro->date_comm; ?></p>
                                            <p class="m-1 p-2 small text-justify"><?= $ro->commentaire; ?></p>
                                            <p class="m-1 p-2 small text-primary"><?= $ro->email; ?></p>
                                            <a class="badge badge-danger " href="index.php?page=admin_delete&id_commentaire=<?= $ro->id_commentaire; ?>" title="supprimer"><i class=" fa fa-trash-o"></i></a>
                                        </div>
                                    </div>
                                    <div class="row m-1">
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                <?php
                    }
                }
                ?>
                </table>
        </div>
<?php
    }
} else {
    header('location:index.php?page=articles');
}
?>

<script>
    let allComment = document.querySelectorAll('.allComment');

    for (let i = 0; i < allComment.length; i++) {

        allComment[i].addEventListener('click', () => {
            let tr = allComment[i].parentElement.parentElement.parentElement.parentElement.querySelectorAll('.tr');
            console.log(tr)
            $(tr).toggle();
        })
    }
</script>