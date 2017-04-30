<<?php

namespace Axxa\src\Controller;

use Axxa\src\Model\AbstractManager;

use Axxa\src\Model\AbstractView;

abstract class AbstractController {

    protected $view;
    protected $entityManager;

    function __construct($args) {
        # code...
    }

    /**
     * Get the value of View
     *
     * @return mixed
     */
    public function getView() {
        return $this->view;
    }

    /**
     * Set the value of View
     *
     * @param mixed view
     *
     * @return self
     */
    public function setView($view) {
        $this->view = $view;

        return $this;
    }

    /**
     * Get the value of Entity Manager
     *
     * @return mixed
     */
    public function getEntityManager() {
        return $this->entityManager;
    }

    /**
     * Set the value of Entity Manager
     *
     * @param mixed entityManager
     *
     * @return self
     */
    public function setEntityManager($entityManager) {
        $this->entityManager = $entityManager;

        return $this;
    }

    public abstract function renderView(array $args);

    public abstract function executeAction($parameters = null);

    protected abstract function listAction();
}
?>
