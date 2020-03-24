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
    include 'template/pages/accueil.php';
}


include 'template/template-parts/footer.php';
