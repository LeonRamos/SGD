<?php

require_once __DIR__ . '../src/config/config.php';
require_once CONTROLLER_PATH . 'LoginController.php';

$controller = new LoginController();
$controller->logout();
