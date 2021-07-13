<?php
require __DIR__ .'/../../vendor/autoload.php';
session_start();
use \Source\api2\Session;
$data = json_decode(file_get_contents('php://input'), true);
$action = $data['action'];
$values = $data['values'];
Session::SelectController($action, $values); 