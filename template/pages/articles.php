<?php
$sql = $pdo->prepare('SELECT * FROM article join categorie on article.id_categorie=categorie.id_categorie
                    where statut=1');
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
?>
<div class="container">
    
    <div class="row">
        <?php foreach ($res as $row) {
        ?>
            <div class="col-sm-12 col-md-6 col-lg-4 mb-5">
                <div class="card ">
                    <div class="card-body ">
                        <img class="d-block w-100 mb-2 " style="height:200px" src="<?= article.$row->photo ?> " alt=" Third slide">
                        <h6 class="card-title text-center"><?= $row->titre; ?></h6>
                        <h5 class="badge badge-danger"><?= $row->date_article; ?></h5>
                        <h5 class="card-title badge badge-danger"><?= $row->nom; ?></h5>
                        <div class="dropdown-divider"></div>
                        <div style="height: 100px; overflow:hidden">
                            <h6 class=""><?= $row->contenu; ?></h6>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a class="btn btn-info" href="index.php?page=article&id=<?= $row->id_article; ?>">lire la suite..</a>
                    </div>
                </div>
            </div>



        <?php
        }
        ?>
    </div>

</div>