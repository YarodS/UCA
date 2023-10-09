<?php
class Footer{
	public function run($echo = ''){
		$echo .= '<footer class="footer"><p> ITSANET - N° 1 en Red Logística de Latinoamerica';
		$echo .= '</p></footer>';
		$echo .= '<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>';		
		$echo .= '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>';
		$echo .= '<script src="rc/js/load-bootstrap.js"></script>';
		$echo .= '<script src="rc/js/20231009145033.js"></script>';
		$echo .= '</body>';
		$echo .= '</html>';
		return $echo;
	}
}