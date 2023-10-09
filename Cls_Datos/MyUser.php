<?php
require_once(dirname(__FILE__) . '/MyPDO.php');
require_once(dirname(__FILE__) . '/MySession.php');
class MyUser{
	public function login($params = array()){
		$MySession = new MySession();
		$MySession->set('id_user', $params['id_user']);
		$MySession->set('user', $params['user']);
		$MySession->set('nom_user', $params['nom_user']);
		$MySession->set('rol', $params['rol']);
	}

	public function set_login_user($params = array()){
		$MyPDOSQL = new MyPDOSQL();
		$prepare = $MyPDOSQL->prepare('
		select USUARIO_ID as id_user,
		USUARIO_ID as user_name,
		NOMBRE as name,
		EMAIL as email,
		ROL_ID
		from SYS_USUARIO where USUARIO_ID= :p_user and password_handheld = :p_passw and CUENTA_BLOQUEDA = 0;');
		$prepare->bindValue(':p_user', $params['p_user']);
		$prepare->bindValue(':p_passw',$params['p_passw']);
		$prepare->execute();
		$cached = $prepare->fetch(PDO::FETCH_ASSOC);
		if((boolean)$cached === true){
			$this->login(array('id_user' => $cached['id_user'],'user' => $cached['user_name'],'nom_user' => $cached['name'],'rol'=>$cached['ROL_ID']));
			return 1;
		}else{
			return 0;
		}
		$MyPDODEPOT = null; unset($MyPDODEPOT); unset($prepare);	
	}
}