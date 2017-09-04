<?php
namespace Application\Generic;

use Application\Database\ConnectionAwareInterface;
use Application\Database\Connection;
use Exception;

class ListFactory
{
    const ERROR_AWARE = 'Class must be Connection Aware';
    
    public static function factory(ConnectionAwareInterface $class, $dbParams)
    {
        if ($class instanceof ConnectionAwareInterface) {
            $class->setConnection(new Connection($dbParams));
            return $class;
        } else {
            throw new Exception(self::ERROR_AWARE);
        }
        
        return FALSE;
    }
}

