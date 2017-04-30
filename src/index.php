<?php
//    session_start();
use Axxa\Controller\FrontController;

require_once dirname(__FILE__) . '/../vendor/autoload.php';

try {
    $connex = new PDO('mysql:host=localhost;dbname=personne', 'root', 'root');

    $controller = new \Axxa\src\Controller\HomeController();

    switch ($controller) {
        case "HomeController":
            $response = $controller->executeAction(array('action' => 'home'));
        case "CategorieController":
            $response = $controller->executeAction(array('action' => 'categorie'));
        case "TravauxController":
            $response = $controller->executeAction(array('action' => 'travaux'));
        default:
            $response = $controller->executeAction(array('action' => 'default'));
    }
    echo $response;

} catch (PDOException $ex) {
    $ex->$message('error from PDO connection !');
}

//    session_start();
require_once dirname(__FILE__) . '../base/config.php';

// initialisation des variables
$page = isset($_GET["p"]) ? $_GET["p"] : "public_home";

if (file_exists("controler/" . $page . ".php")) {
    include_once("controler/" . $page . ".php");
} else {
    echo "error controler";
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
        if (file_exists("view/" . $page . ".php")) {
            include_once("view/" . $page . ".php");
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
