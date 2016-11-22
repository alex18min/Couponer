<?php

// CONFIGURATION MANAGER

// BASE CLASSES

//require_once('frgCore/classes/ExceptionManager.php');
//require_once('frgCore/classes/ConfManager.php');

// CLASSES AUTOLOADER

$oConfig = new ConfManager(array('modules'));
function autoLoader($class){
    try {
        global $oConfig;
        $oConfig->autoLoader($class);
    } catch (ExceptionManager $e) {
        throw $e;
    }
}

// AUTOLOADER
spl_autoload_register('autoLoader');

// EXCEPTION HANDLER
function exceptionHandler($e){
    global $oConfig;
    $oConfig->exceptionHandler($e);
}

// ERROR HANDLER
function errorHandler($errno, $errstr, $errfile, $errline){
    global $oConfig;
    $oConfig->errorHandler($errno, $errstr, $errfile, $errline);
}

// OVERRIDE DEFAULT HANDLERS
set_exception_handler('exceptionHandler');
set_error_handler('errorHandler');

// ************************* //
// ADDITIONAL MODULES CONFIG //
// ************************* //

$activeModules = array();

// SETEFI

$setefi = null;

if(in_array('setefi', $activeModules)) {

    // DEFINE MERCHANT DATA

    $setefiObj = new stdClass();

    $setefiObj->domain = 'http://127.0.0.1:8080';
    $setefiObj->gateway = 'https://test.monetaonline.it';
    $setefiObj->id = '93022543';
    $setefiObj->password = 'Zenais2015';
    $setefiObj->responseToMerchantUrl = $setefiObj->domain.'/notify.php';
    $setefiObj->recoveryUrl = $setefiObj->domain.'/recovery.php';
    $setefiObj->currencyCode = '978';
    $setefiObj->language = 'ITA';

    $setefi = new setefiController($setefiObj);

}





