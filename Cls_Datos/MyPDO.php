<?php
class MyPDOSQL extends PDO
{
	private $dns = "sqlsrv:server=192...;Database=GTWV400";
	private $username = "";
	private $password = "";
	public function __construct()
	{
		try {
			parent::__construct($this->dns, $this->username, $this->password);
			$this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die(print_r('No Tiene Conexión a BD,Vuelva intentarlo mas tarde 1' . $e->getMessage()));
			exit();
		}
	}
}

class MyPDOSQLITSA200 extends PDO
{
	private $dns = "sqlsrv:server=192...;Database=ITSAUCA200"; 
	private $username = "USER";
	private $password = "PASS";
	public function __construct()
	{
		try {
			parent::__construct($this->dns, $this->username, $this->password);
			$this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die(print_r('No Tiene Conexión a BD,Vuelva intentarlo mas tarde 200' . $e->getMessage()));
			exit();
		}
	}
}
