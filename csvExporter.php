<?php
$appRoot = getcwd();
require_once($appRoot.'/config/requirements.php');
$filename = 'transazioni_globalskyregister_'.date('d_m_Y_h_i');

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename={$filename}.csv");
header("Pragma: no-cache");
header("Expires: 0");

$csv = new exportsController();
$csv->exportCSV();
