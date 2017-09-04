<?php
use Application\Database\Paginate;

require __DIR__ . '/../Application/Autoload/Loader.php';
Application\Autoload\Loader::init(__DIR__ . '/..');

$sql = 'SELECT * FROM project LIMIT 20';
$paginator = new Paginate($sql, 3, 35);
echo $paginator->getSql() . PHP_EOL;