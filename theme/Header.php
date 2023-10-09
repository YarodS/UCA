<?php
require_once('Cls_datos/MySession.php');
class Header
{
	public function run($params = array(), $echo = '')
	{
		$MySession = new MySession();
		$echo .= '<!DOCTYPE html>';
		$echo .= '<html>';
		$echo .= '<head>';
		$echo .= '<meta charset="utf-8">';
		$echo .= '<meta name="viewport" content="width=device-width, initial-scale=1">';
		$echo .= '<link rel="shortcut icon" href="favicon.png" type="image/x-icon">';
		$echo .= '<title>' . $params['title'] . '</title>';
		$echo .= '<meta name="author" content="Ruben Cáceres <caceresru@gmail.com>">';
		$echo .= '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">';
		$echo .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">';
		$echo .= '<link href="rc/css/20160301020121.css" rel="stylesheet">';
		$echo .= '</head>';
		$echo .= '<body>';
		$echo .= '<nav class="navbar navbar-inverse navbar-fixed-top">';
		$echo .= '<div class="navbar-header">';
		$echo .= '<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">';
		$echo .= '<span class="sr-only">Toggle navigation</span>';
		$echo .= '<span class="icon-bar"></span>';
		$echo .= '<span class="icon-bar"></span>';
		$echo .= '<span class="icon-bar"></span>';
		$echo .= '</button>';
		$echo .= '<a class="navbar-brand" href="index.php"><span class="c-logo">ITSANET</span> PERU</a>';
		$echo .= '</div>';
		$echo .= '<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">';
		$echo .= '<ul class="nav navbar-nav">';
		$echo .= '<li><a href="analytics.php">Analytics</a></li>';
		$echo .= '</ul>';
		$echo .= '<ul class="nav navbar-nav navbar-right">';
		$echo .= '<li class="dropdown">';
		$echo .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> ' . $MySession->get('user') . ' <b class="caret"></b></a>';
		$echo .= '<ul class="dropdown-menu">';
		$echo .= '<li><a><i class="glyphicon glyphicon-eye-open"></i> ' . $MySession->get('nom_user') . '</a></li>';
		$echo .= '<li><a href="salir.php"><span class="glyphicon glyphicon-off"></span> Salir</a></li>';
		$echo .= '</ul>';
		$echo .= '</li>';
		$echo .= '</ul>';
		$echo .= '</div>';
		$echo .= '</nav>';
		return $echo;
	}
}
