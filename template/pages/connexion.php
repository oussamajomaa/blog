<?php

if (isset($_POST['submitConnect'])) {
    $email = $_POST["email"];
    $mdp = trim(htmlspecialchars($_POST["mdp"]));

    $sql = $pdo->prepare('SELECT * FROM utilisateur where email=:email');
    insertChamps($sql, ':email', $email);

    $sql->execute();
    $res = $sql->fetch(PDO::FETCH_OBJ);

    if (!$res) { ?>
        <div class="container col-4">
            <div class="alert alert-danger alert-dismissible fade show col-md-12" role="alert">
                <strong>
                    <center>Nom d'utilisateur ou mot de passe incorrect.</center>
                </strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <?php
    } else {
        // store the password in the table into a variable
        $motdepasse = $res->mdp;
        // verify if the password entered matches the password in the table
        $validpasse = password_verify($mdp, $motdepasse);
        if ($validpasse) {
            $_SESSION['user'] = $res->pseudo;
            $_SESSION['id_utilisateur'] = $res->id_utilisateur;
            $_SESSION['roles'] = $res->roles;
            
            header("Location:index.php?page=articles");
        } else { ?>
            <div class="container col-4">
                <div class="alert alert-danger alert-dismissible fade show col-md-12" role="alert">
                    <strong>
                        <center>Nom d'utilisateur ou mot de passe incorrect.</center>
                    </strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
    <?php
        }
    }
}
?>

<div class="container col-sm-12 col-md-8 col-lg-4">
    <div class="text-center">
        <img class="w-25 " src="<?= img; ?>user.png" alt="">
    </div>
    <form method="POST">
        <div class="form-group">
            <label for="email">Adresse Mail</label>
            <input type="email" name="email" class="form-control" id="email" autofocus>
        </div>
        <div class="form-group">
            <label for="mdp">Mot de Passe</label>
            <input type="password" name="mdp" class="form-control" id="mdp">
        </div>

        <button type="submit" name="submitConnect" class="btn btn-success col-sm-12" id="submitConnect">SE CONNECTER</button>
        <div class="container">
            <div class="row">
                <a class="nav-item " href="index.php?page=inscription">S'inscrire</a>
            </div>
        </div>
    </form>
</div>