<?php

namespace Axxa\src\Controller;

/**
 *
 */
class FrontController extends DefaultController {

    private $template;

    function __construct() {
        # code...
    }

    public static $routes = array(
        'home' => 'HomeController',
        'equipe' => 'EquipeController',
        'projets' => 'ProjetsController',
        'News' => 'NewsController',
        'categorie' => 'CategoriesController'
    );

    public function processRequest() {

        $parameters = $this->filterParameters($_REQUEST);

        try {

            $controller = $this->mappingControllers($parameters['pageName']);
            $response = $controller->executeAction($parameters['action'], $parameters['method'], $parameters);
            return $response;
        } catch (\Exception $e) {
            $v = new ErrorView();
            $v->setErrrorCode($e->getCode(), $e->getMessage());
            echo $v->render();
        }
    }

    public function mappingControllers() {
        if (key_exists($pageName, self::$routes)) {
            $controllerClass = __DIR__ . "\\" . self::$routes[$pageName];
            return new $controllerClass(); // On retourne une instance de page demandée
        } else {
            throw new \Exception('page not found', 404);
        }
    }

    public function executeAction($parameters) {
        $this->sanitize($parameters);
        return;
    }

    public function postSubmit($post_submit, $get_id, $post_categorie, $post_description, $post_is_visible) {
        if (!$post_submit) {
            $result = getCategories($get_id);
        } else {

            if (!$post_categorie) {
                $msg .= "<p class='red'>&rarr; categorie obligatoire</p>";
            }
            if (!$post_description) {
                $msg .= "<p class='red'>&rarr; decription obligatoire</p>";
            }
            if (!$post_is_visible) {
                $msg .= "<p class='red'>&rarr; is_visible obligatoire</p>";
            }
        }
        return $result;
    }

    public function insertException($insert) {
        if ($insert) {
            $msg .= "<p><b>&rarr; Insertion effectuée avec succès.</b></p>\n";
        } else {
            $msg .= "<p><b>&rarr; Oupsss... problème lors de l'insertion....</b></p>\n";
        }
        return $msg;
    }

    public function updateException($update) {
        if ($update) {
            $msg .= "<p><b>&rarr; Insertion effectuée avec succès.</b></p>\n";
        } else {
            $msg .= "<p><b>&rarr; Oupsss... problème lors de l'insertion....</b></p>\n";
        }
        return $msg;
    }

    public function sanitize($parameters) {
        if (!isset($_SESSION["admin_user_id"]) || empty($_SESSION["admin_user_id"]) || !is_numeric($_SESSION["admin_user_id"]) || !is_numeric($_SESSION["access_level"]) || $_SESSION["access_level"] != 1) {
            require_once dirname(__FILE__) . "Entity/Categorie.php";
            $result = getCategories(0);
        } else {
            $msg = "";
            require_once dirname(__FILE__) . "Entity/Categorie.php";
            $get_action = isset($parameters["action"]) ? $parameters["action"] : "";
            $get_id = isset($parameters["user_id"]) ? $parameters["user_id"] : 0;
            // recuperer les variables
            $post_categorie = isset($parameters["categorie"]) ? $parameters["categorie"] : "";
            $post_description = isset($parameters["description"]) ? $parameters["description"] : "";
            $post_is_visible = isset($parameters["is_visible"]) ? $parameters["is_visible"] : "";
            $post_submit = isset($parameters["submit"]) ? $parameters["submit"] : "";
        }

        switch ($get_action) {
            case "add":
                if ((!$post_categorie) || (!$post_description) || (!$post_is_visible)) {
                    $this->postSubmit($post_submit, $post_categorie, $post_description, $post_is_visible);
                    $page = "admin_categories_add"; // je dois faire appel à une vue "add_view"
                } else {
                    $insert = insertCategories($post_categorie, $post_description, $post_is_visible);
                    $this->insertException($insert);

                    $result = getCategories(0);
                    $page = "admin_categories_view"; // je dois faire appel à une vue "admin_view"
                }

                break;

            case "update":
                if ((!$post_categorie) || (!$post_description) || (!$post_is_visible)) {
                    $this->postSubmit($post_submit, $post_categorie, $post_description, $post_is_visible);
                    $page = "admin_categories_update";
                } else {
                    $update = updateCategories($post_categorie, $post_description, $post_is_visible);
                    $this->updateException($update);

                    $result = getCategories(0);
                    $page = "admin_categories_view";
                }

                break;
            case "desactive":
                $desactive = desactiveCategories($get_id);

                if ($desactive) {
                    $msg .= "<p><b>&rarr; Désactivation effectuée avec succès.</b></p>\n";
                } else {
                    $msg .= "<p><b>&rarr; Oupsss... problème lors de la désactivation....</b></p>\n";
                }

                $result = getCategories(0);
                $page = "admin_categories_view";

                break;

            case "active":
                $active = activeCategories($get_id);

                if ($active) {
                    $msg .= "<p><b>&rarr; Activation effectuée avec succès.</b></p>\n";
                } else {
                    $msg .= "<p><b>&rarr; Oupsss... problème lors de l'activation....</b></p>\n";
                }

                $result = getCategories(0);
                $page = "admin_categories_view";

                break;

            case "delete":
                $delete = deleteCategories($get_id);

                if ($delete) {
                    $msg .= "<p><b>&rarr; Suppression effectuée avec succès.</b></p>\n";
                } else {
                    $msg .= "<p><b>&rarr; Oupsss... problème lors de la suppression....</b></p>\n";
                }

                $result = getCategories(0);
                $page = "admin_categories_view";
                break;

            default:
                $result = getCategories(0);
                $page = "admin_categories_view";
                break;
        }
        return strip_tags(htmlentities($parameters));
    }

    public function filterParameters() {
        $pageName = isset($_REQUEST['pageName']) && !is_null($_REQUEST['pageName']) ? $this->sanitize($_REQUEST['pageName']) : 'home'; //maybe here will be set a switch casee for other routes
        $action = isset($_REQUEST['action']) && !is_null($_REQUEST['action']) ? $this->sanitize($_REQUEST['action']) : 'default';
        $method = $_SERVER['REQUEST_METHOD'];
        $parameters = array();
        foreach ($_REQUEST as $key => $val) {
            if ($key != 'page' && $key != 'action') {
                // TODO : filtrez les paramètres (pensez aux licornes qui tuent des chatons lorsque  vous ne le faites pas)
                $parameters[$key] = $this->sanitize($val);
            }
        }
        return array('method' => $method, 'action' => $action, 'pageName' => $pageName, 'parameters' => $parameters);
    }

}
