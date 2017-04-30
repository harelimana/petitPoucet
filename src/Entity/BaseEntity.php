<?php
/**
 * Description of BaseEntity
 * @author axxa
 */
class BaseEntity {
  protected $id;
    /**
     * Get the value of Description of BaseEntity
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Set the value of Description of BaseEntity
     * @param mixed id
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
}
