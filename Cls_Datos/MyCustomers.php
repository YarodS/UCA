<?php
require_once(dirname(__FILE__) . '/MyPDO.php');
class MyCustomers{
	public function get_cliente_id($params = array()){
		$MyPDOSQL = new MyPDOSQL();
		$prepare = $MyPDOSQL->prepare('
		select
		CLIENTE_ID,
		RAZON_SOCIAL,
		NOMBRE,
		CALLE
		from CLIENTE where CLIENTE_ID = :p_customer');
		$prepare->bindValue(':p_customer', $params['p_customer']);
		$prepare->execute();
		$cached = $prepare->fetch(PDO::FETCH_ASSOC);
		return $cached;
	}
}