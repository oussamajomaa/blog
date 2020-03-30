<?php
if ($_SESSION) {
    if (isset($_POST['submit'])) {
        $file = $_FILES['file'];
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];
        $fileError = $_FILES['file']['error'];

        // explode retourne un tableau associatif de deux élément après avoir couper le nom du fichier en deux morceaux:
        //le nom et l'extention 
        $fileExt = explode('.', $fileName);

        // Retourne une chaîne en minuscule. Ici la chaine cible c'est le deuxième élément du tableau associatif (extention)
        $fileActualExt = strtolower(end($fileExt));

        //tableau des extentions autorisées 
        $allowed = array('jpg', 'jpeg', 'png');

        //on vérifie si l'extension de notre fichier est parmi celles du tableau
        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 1000000) {
                    // giv a new name to file uploading, it will be the id of user
                    $fileNameNew = $_SESSION['id_utilisateur'] . "." . $fileActualExt;
                    // user is a variable defined in config and equal to:
                    $fileDestination = user . $fileNameNew;

                    //il faut d'abord changer la permission dans le dossier distination: $ chomd 777 nom_dossier
                    if (move_uploaded_file($fileTmpName, $fileDestination)) {
                        $photo_utilisateur = $fileNameNew;
                        $id_utilisateur = $_SESSION['id_utilisateur'];
                        $sql = $pdo->prepare('UPDATE utilisateur set photo_utilisateur=:photo_utilisateur
                                            where id_utilisateur= :id_utilisateur');
                        insertChamps($sql, ':photo_utilisateur', $photo_utilisateur);
                        insertChamps($sql, ':id_utilisateur', $id_utilisateur);
                        $res = $sql->execute();
                        $_SESSION['photo']= $photo_utilisateur;
                        if ($res) {
?>
                            <div class="container col-4">
                                <div class="alert alert-danger alert-dismissible fade show col-md-12" role="alert">
                                    <strong>
                                        <center>Votre Photo a été enregistrée avec succèss.</center>
                                    </strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="container col-4">
                                <div class="alert alert-danger alert-dismissible fade show col-md-12" role="alert">
                                    <strong>
                                        <center>Votre Photo n'a pas été enregistrée !!</center>
                                    </strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="container col-4">
                            <div class="alert alert-danger alert-dismissible fade show col-md-12" role="alert">
                                <strong>
                                    <center>Le fichier n'a pas été téléchargé !!</center>
                                </strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="container col-4">
                        <div class="alert alert-danger alert-dismissible fade show col-md-12" role="alert">
                            <strong>
                                <center>Le fichier est trop gros. il ne faut pas dépasser 1 mo !!</center>
                            </strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="container col-4">
                    <div class="alert alert-danger alert-dismissible fade show col-md-12" role="alert">
                        <strong>
                            <center>Il y a eu une erreur en téléchargant ce type de fichier !!</center>
                        </strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            <?php
            }
        } else {
            ?>
            <div class="container col-4">
                <div class="alert alert-danger alert-dismissible fade show col-md-12" role="alert">
                    <strong>
                        <center>Vous ne pouvez pas télécharger ce type de fichier !!</center>
                    </strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
    <?php
        }
    }
    ?>

    <div class="container mt-5 col-12 col-sm-6 col-md-4">
        <div class="mb-5 rounded p-1 ">
            <h3 class="badge badge-danger">Changer votre photo</h3>
            <div>
                <img class="w-50 mb-2 rounded-circle" src="<?= user . $_SESSION['photo']; ?>" alt="<?= $_SESSION['pseudo'] ?>">
            </div>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="form-group ">
                    <input type="file" name="file" id="fileToUpload" class="form-control btn btn-info">
                </div>
                <div class="form-group ">
                    <input class="btn btn-success form-group" type="submit" value="Télécharger l'image" name="submit">
                </div>
            </form>
        </div>
        <div class="rounded p-1 ">
            <h3 class="badge badge-danger">Changer votre mot de Passe</h3>
            <form action="#" method="post">
                <div class="form-group">
                    <label for="mdp">Ancien mot de passe</label>
                    <input type="password" name="mdp" id="mdp" class="form-control">
                </div>
                <div class="form-group">
                    <label for="mdp">Nouveau mot de passe</label>
                    <input type="password" name="new_mdp" id="new_mdp" class="form-control">
                </div>
                <input class="btn btn-success form-group" type="submit" value="Valider" name="submit">
        </div>
        </form>
    </div>
    </div>
<?php
} else {
    header('location:index.php?page=articles');
}
?>