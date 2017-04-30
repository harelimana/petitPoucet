<?php

//    session_start();
use Axxa\Controller\FrontController;
use Axxa\Utils\config;
use Axxa\Utils\fct_db;
use Axxa\Utils\fct_global;

require_once dirname(__FILE__) . '/../vendor/autoload.php';
require_once dirname(__FILE__) . '../Utils/config.php';
require_once dirname(__FILE__) . '../Utils/fct_db';
require_once dirname(__FILE__) . '../Utils/fct_global';

try {
    $connex = new PDO('mysql:host=localhost;dbname=personne', 'root', 'root');

    $frontController = new \Axxa\src\Controller\FrontController();
    $frontController->processRequest();
    
} catch (PDOException $ex) {
    $ex->$message('error from PDO connection !');
}

// initialisation des variables
$page = isset($_GET["pageName"]) ? $_GET["pageName"] : "home";

if (file_exists("Controller/" . $page . ".php")) {
    require_once dirname(__FILE__) . "Controller/" . $page . ".php";
} else {
    echo "error controller";
    exit;  // check if 'exit' is required here
}
if (preg_match("/^admin/i", $page) == TRUE) {
    require_once dirname(__FILE__) . 'inc/admin_header.php';
} else {
    require_once dirname(__FILE__) . 'inc/public_header.php';
}
?>

<div class="container">
    <div id='content'>
        <?php
        if (file_exists("View/Templates/" . $page . ".php")) {
            include_once("View/Templates/" . $page . ".php");
        } else {
            echo "<h2>Erreur !</h2>";
            echo "<p>Vue non définie</p>";
            exit;
        }
        ?>
    </div>
</div>

</body>
</html>
