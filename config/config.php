<?php
    define('img', 'assets/img/');
    define('article', 'assets/img/article/');
    define('user', 'assets/img/user/');
    define('url', 'template/pages/');
    define('file', [
    'articles' => 'articles.php',
    'inscription' => 'inscription.php',
    'connexion' => 'connexion.php',
    'admin_ajouterArticle' => 'admin_ajouterArticle.php',
    'article'=> 'article',
    'deconnexion'=> 'deconnexion.php',
    'admin' => 'admin.php',
    'admin_article' => 'admin_article.php',
    'admin_categorie' => 'admin_categorie.php',
    'admin_commentaire' => 'admin_commentaire.php',
    'admin_utilisateur' => 'admin_utilisateur.php',
    'admin_showArticle' => 'admin_showArticle.php',
    'admin_delete' => 'admin_delete.php',
    'admin_commentaire' => 'admin_commentaire.php',
    'admin_user'=> 'admin_user.php',
    'profil' => 'profil.php'
    ]);

    $pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'step25', 'step25');

    function insertChamps($sql, $champs, $value)
    {
        $champs = trim(htmlspecialchars($champs));
        $champs=stripslashes($champs);
        $sql->bindParam($champs,$value);
    }
?>