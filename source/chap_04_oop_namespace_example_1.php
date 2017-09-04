<?php
// primitive autoloader
function __autoload($class)
{
    echo "Argument Passed to Autoloader = $class\n";
    include __DIR__ . '/../' . str_replace('\\', DIRECTORY_SEPARATOR, $class) . ".php";
}

use Application\Entity;
$name = new Entity\Name();
$address = new Entity\Address();
$profile = new Entity\Profile();

var_dump($name);
var_dump($address);
var_dump($profile);