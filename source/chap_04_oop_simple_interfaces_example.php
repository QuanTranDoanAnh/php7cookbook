<?php
use Application\Generic\ListFactory;
use Application\Generic\CountryList;
use Application\Generic\CustomerList;

define('DB_CONFIG_FILE', '/../data/config/db.config.php');
require __DIR__ . '/../Application/Autoload/Loader.php';
Application\Autoload\Loader::init(__DIR__ . '/..');
$params = include __DIR__ . DB_CONFIG_FILE;

$list = ListFactory::factory(new CountryList(), $params);
foreach ($list->list() as $item) echo $item . ' ';

$list = ListFactory::factory(new CustomerList(), $params);
foreach ($list->list() as $item) echo $item . ' ';