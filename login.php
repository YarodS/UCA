<?php
require_once('Cls_datos/MyUser.php');
require_once('Cls_datos/MySession.php');
$MySession = new MySession();
if($MySession->get('id_user')) header('Location: index.php');
$MyUser = new MyUser();
$msg = '';
$echo = '';
$_REQUEST['user'] = !empty($_REQUEST['user']) ? $_REQUEST['user'] : '';
$_REQUEST['password'] = !empty($_REQUEST['password']) ? $_REQUEST['password'] : '';
if(isset($_REQUEST['btn_login'])){
	$llli = $MyUser->set_login_user(array('p_user' => $_REQUEST['user'],'p_passw' => $_REQUEST['password']));
	if ($llli === 1){
		header('Location: index.php');
	}else{
		$msg = '<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<b>Oh error!</b> No existe el usuario, Comunicase con el Administrador.</div>';
	}
}
$echo .= '<!DOCTYPE html>';
$echo .= '<html>';
$echo .= '<head>';
	$echo .= '<meta charset="utf-8">';
	$echo .= '<meta name="viewport" content="width=device-width, initial-scale=1">';
	$echo .= '<link rel="shortcut icon" href="favicon.png" type="image/x-icon">';
	$echo .= '<title>Login | ITSANET PERU</title>';
	$echo .= '<meta name="author" content="Ruben Caceres <caceresru@gmail.com>">';
	$echo .= '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">';
	$echo .= '<link href="rc/css/20160301020121.css" rel="stylesheet">';
$echo .= '</head>';
$echo .= '<body class="fill-itsanet">';

$echo .= '<div class="box-error">';
	$echo .= ($msg == '') ? '' : $msg;
$echo .= '</div>';
$echo .= '<div class="container-box">';
	$echo .= '<form method="POST" class="form-signin" autocomplete="off">';
		
		$echo .= '<div class="box-software pull-cust">UCA v2.0</div>';
		$echo .= '<img src="rc/img/logo-itsanet.png" class="img-responsive center-block">';
		$echo .= '<h3 class="form-signin-heading text-center">Iniciar sesión</h3>';
		$echo .= '<div class="form-group">';
			//$echo .= '<label for="user">Nombre de Usuario </label>';
			$echo .= '<div class="input-group">';
				$echo .= '<div class="input-group-addon"><i class="glyphicon glyphicon-user"></i></div>';
				$echo .= '<input type="text" id="user" name="user" class="form-control" title="Por favor ingrese su usuario.!" min="4" required placeholder="Usuario" autofocus>';
			$echo .='</div>';
		$echo .= '</div>';
		$echo .= '<div class="form-group">';
			$echo .= '<div class="input-group">';
				$echo .= '<div class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></div>';
				$echo .= '<input type="password" id="password" name="password" class="form-control" title="Por favor ingrese su nueva contraseña." placeholder="Contraseña" required>';
			$echo .= '</div>';
		$echo .= '</div>';
		$echo .= '<button type="submit" class="btn btn-itsanet btn-block" name="btn_login">Ingresar <i class="glyphicon glyphicon-log-in"></i></button>';
	$echo .= '</form>';
$echo .= '</div>';

$echo .= '<footer class="footer"><p class="footer-box">&copy; ' . date('Y') . ' ITSANET PERU S.A.C.</p>';
	//$echo .= '<p><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> 987967975<br><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> caceresru@gmail.com</p></footer>';
$echo .= '<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>';
$echo .= '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>';
$echo .= '<script src="rc/js/20160301020121.js"></script>';
$echo .= '</body>';
$echo .= '</html>';
echo $echo;