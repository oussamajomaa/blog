<?php
if ((!empty($_GET['id'])) && (isset($_GET['id']))) {
    $id_article=$_GET['id'];
    
    $sql = $pdo->prepare('DELETE from commentaire where id_article=:id_article');
    insertChamps($sql, ':id_article', $id_article);
    $sql->execute();
    $sql = $pdo->prepare('DELETE from article where id_article=:id_article');
    insertChamps($sql, ':id_article', $id_article);
    $sql->execute();
   
    header('location: index.php?page=admin_article');
}

if ((!empty($_GET['id_commentaire'])) && (isset($_GET['id_commentaire']))) {
    $id_commentaire= $_GET['id_commentaire'];

    $sql = $pdo->prepare('DELETE from commentaire where id_commentaire=:id_commentaire');
    insertChamps($sql, ':id_commentaire', $id_commentaire);
    $sql->execute();
    header('location: index.php?page=admin_commentaire');
}

if ((isset($_POST['categorieModif'])) && (isset($_GET['id_categorie1']))) {
    $id_categorie = $_GET['id_categorie1'];
    $nom=$_POST['nom'];
    $sql = $pdo->prepare('UPDATE categorie SET nom=:nom where id_categorie=:id_categorie');
    insertChamps($sql, ':nom', $nom);
    insertChamps($sql, ':id_categorie', $id_categorie);
    $sql->execute();
    header('location: index.php?page=admin_categorie');
}



?>