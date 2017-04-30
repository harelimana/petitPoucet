<?php

namespace Axxa\src\View;

/**
 *
 */
class AbstractView {

    protected $templateName;
    protected $templateDir;

    function __construct() {
        # code...
    }

    public function render() {
        
    }

    /**
     * Get the value of Template Name
     * @return mixed
     */
    public function getTemplateName() {
        return $this->templateName;
    }

    /**
     * Set the value of Template Name
     * @param mixed templateName
     * @return self
     */
    public function setTemplateName($templateName) {
        $this->templateName = $templateName;

        return $this;
    }

    /**
     * Get the value of Template Dir
     * @return mixed
     */
    public function getTemplateDir() {
        return $this->templateDir;
    }

    /**
     * Set the value of Template Dir
     * @param mixed templateDir
     * @return self
     */
    public function setTemplateDir($templateDir) {
        $this->templateDir = $templateDir;

        return $this;
    }

}
