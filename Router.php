<?php  
class Router{
	public function __construct(){
		spl_autoload_register(array($this, 'loader'));
	}
	public function loader($class = array()){
		$exceptions = [
			'Header'=>'theme',
			'Footer'=>'theme'
		];
		if (array_key_exists($class, $exceptions)) {
			$filename = dirname(__FILE__).DIRECTORY_SEPARATOR.$exceptions[$class].'/'.$class.'.php';	
		}else{
			if (strpos((string)$class,'View') === false) {
				$filename = dirname(__FILE__).DIRECTORY_SEPARATOR.'Cls_Datos/'.$class.'.php';
			}else{
				$filename = dirname(__FILE__).DIRECTORY_SEPARATOR.'Views/'.$class.'.php';
			}
		}
		if (file_exists($filename)) {
	        require_once($filename);
	    }
	}
}
$Router = new Router();