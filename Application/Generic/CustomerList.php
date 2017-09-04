<?php
namespace Application\Generic;

use Application\Database\ConnectionAwareInterface;
use Application\Database\Connection;
use PDO;

class CustomerList implements ConnectionAwareInterface
{
    protected $connection;
    
    public function setConnection(Connection $connection)
    {
        $this->connection = $connection;
    }
    
    public function list()
    {
        $list = [];
        $stmt = $this->connection->pdo->query('SELECT id, name FROM customer');
        while ($customer = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $list[$customer['id']] = $customer['name'];
        }
        return $list;
    }
}

