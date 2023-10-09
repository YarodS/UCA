<?php
class MySession{
	function __construct(){
		if(!session_id()){
			session_start();
		}
	}
	public function get($pp1){
		return isset($_SESSION[$pp1]) ? $_SESSION[$pp1] : false;
	}
	public function set($pp1, $pp2){
		$_SESSION[$pp1] = $pp2;
	}
	public function delete($pp1){
		unset($_SESSION[$pp1]);
	}
	public function destroy(){
		session_unset();
		session_destroy();
		setcookie (session_name(), '', time()-300, '/', '', 0);
	}
	public function p_redirect(){
		$l1 = explode("/", substr($_SERVER['PHP_SELF'],1)); //0 app
		$l2 = rtrim($l1[1], '.php'); // page
		$app 			= $this->get('app');
		$id_user	= $this->get('id_user');
		$page_next = $this->get('p_default');
		$page_next = ($app === $l1[0]?($id_user?$page_next:''):'salir.php');
		return ['rout'=>$page_next,'p_current'=> $l2,'id_user'=>$id_user];
	}
}