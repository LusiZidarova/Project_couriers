<?php
session_start();
spl_autoload_register();

$dbInfo = parse_ini_file("Config/db.ini");
$pdo = new PDO($dbInfo['dsn'], $dbInfo['user'], $dbInfo['pass']);
$db = new \Database\PDODatabase($pdo);

$template = new \Core\Template();
$dataBinder = new \Core\DataBinder();
$employeeRepository = new \App\Repository\EmployeeRepository($db, $dataBinder);
$encryptionService = new \App\Service\Encryption\ArgonEncryptionService();
$employeeService = new \App\Service\EmployeeService($employeeRepository, $encryptionService);
$officeRepository = new \App\Repository\OfficeRepository($db,$dataBinder);
$officeService = new \App\Service\OfficeService($officeRepository,$employeeService);
$townRepository = new \App\Repository\TownRepository($db,$dataBinder);
$townService = new \App\Service\TownService($townRepository,$employeeService);
$vehicleRepository = new \App\Repository\VehicleRepository($db,$dataBinder);
$vehicleService = new \App\Service\VehicleService($vehicleRepository,$employeeService);


$employeeHttpHandler = new \App\Http\EmployeeHttpHandler($template, $dataBinder, $employeeService,$employeeRepository,$officeService);
$townHttpHandler = new \App\Http\TownHttpHandler($template, $dataBinder,  $townService,$employeeService);
$officeHttpHandler = new \App\Http\OfficeHttpHandler($template, $dataBinder,  $townService,$officeService,$employeeService);
$vehicleHttpHandler = new \App\Http\VehicleHttpHandler($template, $dataBinder,  $vehicleService,$officeService,$employeeService);
