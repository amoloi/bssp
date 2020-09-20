<?php
/**
 * Description of JBlac_Model
 *
 * @author Innocent J Blac
 */
class JBlac_ObjectModel
{

    protected $id = null;

    protected $createdOn = null;

    protected $createdBy = null;

    protected $modifiedOn = null;

    protected $modifiedBy = null;

    /*
    * The constructor
    */
    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }
    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function getModifiedOn()
    {
        return $this->modifiedOn;
    }

    public function getModifiedBy()
    {
        return $this->modifiedBy;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
        return $this;
    }

    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    public function setModifiedOn($modifiedOn)
    {
        $this->modifiedOn = $modifiedOn;
        return $this;
    }

    public function setModifiedBy($modifiedBy)
    {
        $this->modifiedBy = $modifiedBy;
        return $this;
    }


}
