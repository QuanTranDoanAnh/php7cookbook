<?php
namespace Application\Generic;

use Application\Database\ConnectionAwareInterface;
use Application\Database\Connection;

class CountryListUsingTrait implements ConnectionAwareInterface
{
    use ListTrait;
    
    protected $connection;
    protected $key = 'iso3';
    protected $value = 'name';
    protected $table = 'iso_country_codes';
    
    public function setConnection(Connection $connection)
    {
        $this->connection = $connection;
    }
}

