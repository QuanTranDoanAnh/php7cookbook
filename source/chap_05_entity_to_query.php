<?php
use Application\Database\CustomerService;
use Application\Database\Connection;
use Application\Entity\Customer;

define('DB_CONFIG_FILE', '/../data/config/db.config.php');
require __DIR__ . '/../Application/Autoload/Loader.php';
Application\Autoload\Loader::init(__DIR__ . '/..');

// get service instance
$service = new CustomerService(new Connection(include __DIR__ . DB_CONFIG_FILE));
/*
echo "\nSingle Result\n";
var_dump($service->fetchById(rand(1,79)));*/

// sample data
$data = [
    'name' => 'Doug Bierer',
    'balance' => 326.33,
    'email' => 'doug' . rand(0,999) . '@test.com',
    'password' => 'password',
    'status' => 1,
    'security_question' => 'Who\'s on first?',
    'confirm_code' => 12345,
    'level' => 'ADV',
];
// create new Customer
$cust = Customer::arrayToEntity($data, new Customer());
echo "\nCustomer ID BEFORE Insert: {$cust->getId()}\n";
$cust = $service->save($cust);
echo "Customer ID AFTER Insert: {$cust->getId()}\n";

echo "Customer Balance BEFORE Update: {$cust->getBalance()}\n";
$cust->setBalance(999.99);
$service->save($cust);
echo "Customer Balance AFTER Update: {$cust->getBalance()}\n";
var_dump($cust);