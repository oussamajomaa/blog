<?php

session_start();
include 'config/config.php';
include 'template/template-parts/header.php';



if (isset($_GET['page']) && !empty($_GET["page"])) {
    if (array_key_exists($_GET['page'], file)) {
        include url . $_GET['page'] . '.php';
    }
} 
else {
    if ($_SESSION['roles'] != 1){
        include 'template/pages/articles.php';
    }
    else{
        include 'template/pages/admin_article.php';
    }
}


include 'template/template-parts/footer.php';
