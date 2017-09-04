<?php
namespace Application\Database;

use PDOException;
use Throwable;

class Paginate
{
    const DEFAULT_LIMIT = 20;
    const DEFAULT_OFFSET = 0;
    protected $sql;
    protected $page;
    protected $linesPerPage;
    
    public function __construct($sql, $page, $linesPerPage)
    {
        $offset = $page * $linesPerPage;
        var_dump($sql);
        if ($sql instanceof Finder) {
            $sql->limit($linesPerPage);
            $sql->offset($offset);
            $this->sql = $sql::getSql();
        } elseif (is_string($sql)) {
            echo "Init SQL: " . $sql;
            switch (TRUE) {
                case (stripos($sql, 'LIMIT') && stripos($sql, 'OFFSET')):
                    // no action needed
                    break;
                case (stripos($sql, 'LIMIT')) :
                    $sql .= ' OFFSET ' . self::DEFAULT_OFFSET;
                    break;
                case (stripos($sql, 'OFFSET')) :
                    $sql .= ' LIMIT ' . self::DEFAULT_LIMIT;
                    break;
                default :
                    $sql .= ' LIMIT ' . self::DEFAULT_LIMIT;
                    $sql .= ' OFFSET ' . self::DEFAULT_OFFSET;
                    break;
            }
            if (preg_match('/LIMIT \d+.*OFFSET \d+/', $sql)) {
                $this->sql = preg_replace('/LIMIT \d+.*OFFSET \d+/',
                    'LIMIT ' . $linesPerPage . ' OFFSET ' . $offset,
                    $sql);
            }
            
            if (preg_match('/OFFSET \d+.*LIMIT \d+/', $sql)) {
                $this->sql = preg_replace('/OFFSET \d+.*LIMIT \d+/',
                    'LIMIT ' . $linesPerPage . ' OFFSET ' . $offset,
                    $sql);
            }
        }
        
    }
    
    public function paginate(Connection $connection, $fetchMode, $params=array())
    {
        try {
            $stmt = $connection->pdo->prepare($this->sql);
            if (!$stmt) return FALSE;
            if ($params) {
                $stmt->execute($params);
            } else {
                $stmt->execute();
            }
            while ($result = $stmt->fetch($fetchMode)) yield $result;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return FALSE;
        } catch (Throwable $e) {
            error_log($e->getMessage());
            return FALSE;
        }
    }
    
    public function getSql() {
        return $this->sql;
    }
    
}

