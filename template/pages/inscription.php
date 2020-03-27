<?php


if (isset($_POST['submitInsert'])) {
    $email = $_POST["email"];
    $sql = $pdo->prepare('SELECT email FROM utilisateur where email=:email');
    insertChamps($sql, ':email', $email);
    $sql->execute();
    $res = $sql->fetch();

    if ($res) {
?>
        <div class="container col-4">
            <div class="alert alert-danger alert-dismissible fade show col-md-12" role="alert">
                <strong>
                    <center>Ce mail existe déjà</center>
                </strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
<?php
    } else {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $sql = $pdo->prepare('INSERT INTO utilisateur (pseudo,email,mdp,roles) 
                          VALUES (:pseudo,:email,:mdp,:roles)');

            insertChamps($sql, ':pseudo', $_POST['pseudo']);
            insertChamps($sql, ':email', $email);
            $mdp = password_hash($_POST['mdp'], PASSWORD_BCRYPT);
            insertChamps($sql, ':mdp', $mdp);
            insertChamps($sql, ':roles', 0);
            $sql->execute();
            header('location:index.php?page=connexion');
        }
    }
}


?>



<div class="container col-sm-12 col-md-8 col-lg-4">
    <div class="text-center">
        <h3 class="text-success">INSCRIPTION</h3>
    </div>
    <form action="" method="POST">

        <div class="form-group">
            <label for="pseudo">Pseudo</label>
            <input type="text" class="form-control" id="pseudo" name="pseudo" required>
        </div>
        <div class="form-group">
            <label for="email">Adresse Mail</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="mdp">Mot de Passe</label>
            <input type="password" class="form-control" id="mdp" name="mdp" required>
        </div>
        


        <!-- <div class="form-group">
            <label for="confirm_mdp">Confirmer le Mot de Passe</label>
            <input type="password" class="form-control" id="confirm_mdp" required>
        </div> -->
        <button type="submit" class="btn btn-success" name="submitInsert">Enregistrer</button>
    </form>
</div>