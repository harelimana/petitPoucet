<?php

namespace Axxa\src\Model;

abstract class AbstractManager {

    abstract public function setConnection(\PDO $pdo);

    abstract protected function getConnection();

    abstract public function create(BaseEntity $entity);

    abstract public function update(BaseEntity $entity);

    abstract public function delete(BaseEntity $entity);

    abstract public function retrieve($id);

    abstract public function retrieveAll();
}
