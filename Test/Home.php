<?php

require_once '../Autoloads.php';

$service = new \API\Service\Home();
$results = array();

$Test = true;
$email = 'bang@bang.mvc';

$results['TestSuccess'] = $service->TestSuccess($email);
$results['TestUnSuccess'] = $service->TestUnSuccess($email);

EchoTestResult($results);