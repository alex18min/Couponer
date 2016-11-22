<?php
// File di requirements di progetto

// Definizione ambiente di sviluppo

$dev = true;
$devStatus = '';

// Root dell'applicazione

if ($dev) {
    $appRoot = '';
    $appUrl = '';
} else {
    $appRoot = $_SERVER['DOCUMENT_ROOT'] . '/couponer/';
    $appUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/';
}

// Requirements proprietari del core

require_once($appRoot . 'modules/core/exceptionManager/controllers/ExceptionManager.php');
require_once($appRoot . 'modules/core/confManager/controllers/ConfManager.php');

// Requirements proprietari del progetto

require_once($appRoot . 'config/config.php');

// DATABASE CONNECTION
if ($dev) {
    $oDbConnector = new DbConnector('localhost', 'root', '', 'coupon', 'mysql');
} else {
    $oDbConnector = new DbConnector('localhost', 'alexcar5_coupon', 'Ac755834', 'alexcar5_couponer', 'mysql');
}
