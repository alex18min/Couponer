<?php

$appRoot = getcwd();

require_once('config/requirements.php');

$object = false;
$classArgs = null;
$method = null;
$methodArgs = null;


$inputData = json_decode(file_get_contents('php://input'));


if (isset($inputData->classArgs)) {
    $classArgs = $inputData->classArgs;
}

if (isset($inputData->method)) {
    $method = $inputData->method;
}

if (isset($inputData->methodArgs)) {
    $methodArgs = $inputData->methodArgs;
}

try {
    $rest = new restAPI($inputData->class, $classArgs, $method, $methodArgs);
    $retVal = array();
    $retVal['status'] = 'success';
    $retVal['result'] = $rest->call();
} catch (ExceptionManager $e) {
    $retVal = ['status' => 'error', 'message' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()];
}

echo json_encode($retVal);