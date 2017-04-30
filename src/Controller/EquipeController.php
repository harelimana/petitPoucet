<?php

namespace Axxa\src\Controller;
// Use Axxa\View\Equipe\EquipeView;
/**
 *
 */
class EquipeController extends AbstractController
{

  function __construct()
  {
    # code...
  }
  
  public function renderView(array $args = null) {
        return $this->view->render();
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
        $equipeConnex = new EquipeManager($connexion);
        $equipes = $equipeConnex->retrieveAll();
        return $this->renderView();
    }
}
