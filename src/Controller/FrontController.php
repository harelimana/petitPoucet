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
        /*
          $view = new SimpleView($this->template);
          $view->setTemplateName('main.tpl.html');
          $view->render();
         */
    //    $parameters = $this->filterParameters($_REQUEST);
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
    
    
/*
    public function sanitize($param) {
        return strip_tags(htmlentities($param));
    }

    public function filterParameters() {
        $pageName = isset($_REQUEST['p']) && !is_null($_REQUEST['p']) ? $this->sanitize($_REQUEST['p']) : 'home'; //maybe here will be set a switch casee for other routes
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
    } */
}
