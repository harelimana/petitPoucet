<?php

namespace Axxa\View\home;
use Axxa\View\Templates\homepage;

class HomeView extends SimpleView {

    function __construct($home, $categories, $view) {
        # code...
    }

    /**
     * Set the value of Categories
     * @param mixed categories
     * @return self
     */
    public function setCategories(Categorie $categories) {
        $this->categories = $categories;
        return $this;
    }

    public function homeDisplay() {
        $this->render(homepage);
    }
}

?>
