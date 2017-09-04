<?php
namespace Application\Entity;

class Base
{
    protected $id;
    //private $key = 12345;
    protected $mapping = ['id' => 'id'];
    
    public function getId(): ?int
    {
        return $this->id;
    }
    /*
    public function setId()
    {
        $this->id = $this->generateRandId();
    }
    
    protected function generateRandId()
    {
        return unpack('H*', random_bytes(8))[1];
    }*/
    
    public function setId($id)
    {
        $this->id = (int) $id;
    }
    
    public static function arrayToEntity($data, Base $instance)
    {
        if ($data && is_array($data)) {
            foreach ($instance->mapping as $dbColumn => $propertyName) {
                if (isset($data[$dbColumn])) {
                    $method = 'set' .ucfirst($propertyName);
                    $instance->$method($data[$dbColumn]);
                }
            }
            return $instance;
        }
        return FALSE;
    }
    
    public function entityToArray()
    {
        $data = array();
        foreach ($this->mapping as $dbColumn => $propertyName) {
            $method = 'get' . ucfirst($propertyName);
            $data[$dbColumn] = $this->$method() ?? NULL;
        }
        return $data;
    }
}

