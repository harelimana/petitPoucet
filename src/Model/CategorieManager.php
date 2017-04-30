<?php

namespace Axxa\src\model;
use PDO;
/**
 *
 */
class CategorieManager extends AbstractManager {
protected $connex;
    function __construct() {
      try {
          $connex = new PDO('mysql:host=localhost;dbname=personne', 'root', 'root');
      } catch (PDOException $ex) {
          $ex->$message('error from PDO connection !');
      }
      return $connex;
    }

    public function setConnection(\PDO $connex) {
        $this->connexion = $connex;
    }

    public function getConnection() {
        return $this->$connex;
    }

    public function create(BaseEntity $entity) {

    }

    public function update(BaseEntity $entity) {

    }

    public function delete(BaseEntity $entity) {

    }

    public function retrieve($id) {

    }

    public function retrieveAll() {

    }

}
