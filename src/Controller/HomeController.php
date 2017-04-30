<?php

namespace Axxa\src\Controller;
use Axxa\src\Controller\FrontController;
use Axxa\View\Templates\HomeView;

/**
 *
 */
class HomeController extends DefaultController {
    
    public function __construct($parameters) {
        $this->parameters = $parameters;
    }

    public function renderView(array $parameters = null) {
        return $this->view->render($parameters['homepage']);
    }

    public function executeAction(Request $request) {
        $parameters['action'] = $request->get('action');
        $parameters['method'] = $request->getMethod();
        if (!isset($parameters['action']) || $parameters['action'] == null || $parameters['action'] == 'default') {
            return $this->listAction();
        }
        if (method_exists($this, strtolower($parameters['action']) . 'Action')) {
            $this->{$parameters['action'] . 'Action'}($parameters);
            return $this->renderView();
        } else {
            throw new Exception('page non trouvée');
        }
    }

    public function listAction() {
        $catConnex = new CategorieManager($connexion);
        $categories = $catConnex->retrieveAll();

        $trav = new TravauxRecentsManager($connexion);
        $travauxRecents = $trav->retrieveAll();

        $this->view->setCategories($categories);
        $this->view->setTravauxRecents($travauxRecents);

        return $this->renderView();
    }
    public function defaultAction(Request $request){
      $view = $this->renderView(self::$homePage);
     
        {
            $view = '/View/Templates/homepage.php';
            return $this->render($view);
        }
    }
    
}

?>
