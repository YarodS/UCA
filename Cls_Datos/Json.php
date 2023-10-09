<?php
$ll1 = $_REQUEST['page'] . '.php';
require_once($ll1);
require_once('../Router.php');
$ll2 = ucfirst($_REQUEST['action']);
$method = $_REQUEST['method'];
$action = new $ll2();
echo json_encode($action->$method($_REQUEST));
