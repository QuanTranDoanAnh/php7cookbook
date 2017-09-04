<?php
use Application\Database\Finder;

require __DIR__ . '/../Application/Autoload/Loader.php';
Application\Autoload\Loader::init(__DIR__ . '/..');

$sql = Finder::select('project')
    ->where()
    ->like('name', '%secret%')
    ->and('priority > 9')
    ->or('code')->in(['4', '5', '7'])
    ->and()->not('created_at')
    ->limit(10)
    ->offset(20);
echo Finder::getSql();