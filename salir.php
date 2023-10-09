<?php
include_once('Cls_datos/MySession.php');
$MySession = new MySession();
$MySession->destroy();
header('Location: login.php');