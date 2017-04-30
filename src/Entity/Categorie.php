<?php

namespace Axxa\src\Entity;

Use Axxa\Controller\FrontController;

/**
 *
 */
class Categorie extends BaseEntity {

    protected $id;
    protected $categorie;
    protected $description;
    protected $is_valid;

    function __construct($parameters = null) {
        if (!$parameters == null) {
        }
    }

    /**
     * Get the value of Id
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set the value of Id
     * @param mixed id
     * @return self
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of Categorie
     * @return mixed
     */
    public function getCategorie() {
        return $this->categorie;
    }

    /**
     * Set the value of Categorie
     * @param mixed categorie
     * @return self
     */
    public function setCategorie($categorie) {
        $this->categorie = $categorie;
        return $this;
    }

    /**
     * Get the value of Description
     * @return mixed
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set the value of Description
     * @param mixed description
     * @return self
     */
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    /**
     * Get the value of Is Valid
     * @return mixed
     */
    public function getIsValid() {
        return $this->is_valid;
    }

    /**
     * Set the value of Is Valid
     * @param mixed is_valid
     * @return self
     */
    public function setIsValid($is_valid) {
        $this->is_valid = $is_valid;
        return $this;
    }

}

?>
