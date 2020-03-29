<?php
if ($_SESSION){
    if (isset($_POST['submit'])){
        $file=$_FILES['file'];
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];
        $fileError = $_FILES['file']['error'];

        // explode retourne un tableau associatif de deux élément après avoir couper le nom du fichier en deux morceaux:
        //le nom et l'extention 
        $fileExt=explode('.', $fileName);

        // Retourne une chaîne en minuscule. Ici la chaine cible c'est le deuxième élément du tableau associatif (extention)
        $fileActualExt=strtolower(end($fileExt));
        
        //tableau des extentions autorisées 
        $allowed=array('jpg','jpeg','png');

        if (in_array($fileActualExt, $allowed)){
            if ($fileError === 0){
                if ($fileSize <1000000){
                    $fileNameNew = $_SESSION['id_utilisateur'].".". $fileActualExt;
                    $fileDestination= user.$fileNameNew;
                    var_dump($fileDestination);
                    var_dump($fileTmpName);

                    //il faut d'abord changer la permission dans le dossier distination: $ chomd 777 nom_dossier
                    if (move_uploaded_file($fileTmpName, $fileDestination)){
                        echo 'file uploaded';
                        $photo_utilisateur= $fileNameNew;
                        $id_utilisateur=$_SESSION['id_utilisateur'];
                        $sql=$pdo->prepare('UPDATE utilisateur set photo_utilisateur=:photo_utilisateur
                                            where id_utilisateur= :id_utilisateur');
                        insertChamps($sql, ':photo_utilisateur', $photo_utilisateur);
                        insertChamps($sql, ':id_utilisateur', $id_utilisateur);
                        $res=$sql->execute();
                        if ($res){
                            echo 'la photo a été enregistré';
                        }
                        else{
                            echo "la photo n'a pas été enregistré";
                        }
                    }
                    else{
                        echo 'file is not uploaded';
                    }  
                }
                else{
                    echo "Le fichier est trop gros ";
                }

            }
            else{
                echo "Il y a eu une erreur en téléchargant ce type de fichier";
            }
        }
        else{
            echo "Vous ne pouvez pas télécharger ce type de fichier";
        }
    }
?>


    <div class="container mt-5">
        <div class="row">
            <div class="col-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active " id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Votre photo</a>
                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Changer le mot de passe</a>
                </div>
            </div>
            <div class="col-9">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <form action="#" method="post" enctype="multipart/form-data">
                            Select image to upload:
                            <input type="file" name="file" id="fileToUpload">
                            <input type="submit" value="Télécharger l'image" name="submit">
                        </form>
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
                </div>
            </div>
        </div>
    </div>
<?php
} 
else {
    header('location:index.php?page=articles');
}
?>