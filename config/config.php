<?php
    define('img', 'assets/img/');
    define('url', 'template/pages/');
    define('file', [
    'articles' => 'articles.php',
    'inscription' => 'inscription.php',
    'connexion' => 'connexion.php',
    'ajouterArticle' => 'ajouterArticle.php',
    'article'=> 'article',
    'deconnexion'=> 'deconnexion.php'
    ]);

    $pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'step25', 'step25');

    function insertChamps($sql, $champs, $value)
    {
        $champs = trim(htmlspecialchars($champs));
        $champs=stripslashes($champs);
        $sql->bindParam($champs,$value);
    }
?>