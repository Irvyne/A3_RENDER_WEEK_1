<?php
/**
 * Created by Thibaud BARDIN (Irvyne)
 * This code is under the MIT License (https://github.com/Irvyne/license/blob/master/MIT.md)
 */

require 'autoload.php';
$config = require 'config/database.php';
$userSession = new UserSession();

try {
    $dsn = $config['driver'].':dbname='.$config['dbname'].';host='.$config['host'].';port='.$config['port'].';charset=utf8';
    $pdo = new \PDO($dsn, $config['username'], $config['password']);
} catch (\PDOException $exception) {
    //mail('monadresse@gmail.com', 'Problème de Connexion BDD', $exception->getCode().' '.$exception->getMessage().' '.$exception->getTraceAsString());
    exit('BDD Error');
}