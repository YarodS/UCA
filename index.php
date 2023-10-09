<?php
header('Location: analytics.php');
require_once('Cls_datos/MySession.php');
$MySession = new MySession();
($MySession->get('id_user') ? $MySession->get('id_user') : header('Location: login.php'));
require_once('theme/Header.php');
require_once('theme/Footer.php');
require_once('Cls_datos/MyNclass.php');
$MyNclass = new MyNclass();
$Header = new Header();
$Footer = new Footer();
$echo = '';
$echo .= $Header->run(array('title' => 'Admin ITSANET PERU'));
$_REQUEST['action'] = !empty($_REQUEST['action']) ? $_REQUEST['action'] : '';
$_REQUEST['serie'] = !empty($_REQUEST['serie']) ? $MyNclass->get_ltrim($_REQUEST['serie'],'0') : '';
$_REQUEST['number'] = !empty($_REQUEST['number']) ? $MyNclass->get_ltrim($_REQUEST['number'],'0') : '';
$_REQUEST['cod_cliente'] = !empty($_REQUEST['cod_cliente']) ? $MyNclass->get_ltrim($_REQUEST['cod_cliente'],'0') : '';
$m = isset($_REQUEST['m']) ? $_REQUEST['m'] == 1 ?'<div class="alert alert-success" role="alert"><b>En hora buena!</b> se actualizo correctamente..! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button></div>':'':'';

$echo .= '<div class="well">';
	
$echo .= '</div>';
$echo .= $Footer->run();
echo $echo;