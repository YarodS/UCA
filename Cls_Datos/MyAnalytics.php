<?php
require_once(dirname(__FILE__) . '/MyPDO.php');
class MyAnalytics extends MyPDOSQL
{
	public function uca_get_listNave_lay_out($params = [])
	{
		$cnn_ = new MyPDOSQLITSA200();
		$prepare = $cnn_->prepare('exec uca_sp_get_listNave_lay_out');
		$prepare->execute();
		return $prepare->fetchAll(PDO::FETCH_ASSOC);
	}

	public function uca_get_analytics_posicion_itsa200($params = [])
	{
		$cnn_ = new MyPDOSQLITSA200();
		$prepare = $cnn_->prepare('exec uca_sp_get_analytics_posicion :p_lay_out');
		$prepare->bindValue(':p_lay_out', $params['p_lay_out']);
		$prepare->execute();
		return $prepare->fetchAll(PDO::FETCH_ASSOC);
	}
	public function uca_get_mts_itsa200()
	{
		$cnn_ = new MyPDOSQLITSA200();
		$prepare = $cnn_->prepare('exec uca_sp_get_mts2');
		$prepare->execute();
		return $prepare->fetch(PDO::FETCH_ASSOC);
	}
	public function uca_get_analytics_position_type_ocup_itsa200()
	{
		$cnn_ = new MyPDOSQLITSA200();
		$prepare = $cnn_->prepare('exec uca_sp_get_analytics_position_type_ocup');
		$prepare->execute();
		return $prepare->fetch(PDO::FETCH_ASSOC);
	}
	public function uca_get_analytics_position_customers()
	{
		$cnn_ = new MyPDOSQLITSA200();
		$prepare = $cnn_->prepare('exec uca_sp_get_analytics_position_customers');
		$prepare->execute();
		return $prepare->fetchAll(PDO::FETCH_ASSOC);
	}
	public function uca_get_position_occupied_customer($params = [])
	{
		$cnn_ = new MyPDOSQLITSA200();
		$prepare = $cnn_->prepare('exec uca_sp_get_position_occupied_customer :p_cliente_id');
		$prepare->bindValue(':p_cliente_id', $params['p_cliente_id']);
		$prepare->execute();
		return $prepare->fetchAll(PDO::FETCH_ASSOC);
	}

	public function uca_get_position_libres_nave_tp($params = [])
	{
		$params['p_type_post'] = !empty($params['p_type_post']) ? $params['p_type_post'] : NULL;
		$cnn_ = new MyPDOSQLITSA200();
		$prepare = $cnn_->prepare('exec uca_sp_get_position_libres_nave_tp :p_type_post, :p_nave, :p_lay_out');
		$prepare->bindValue(':p_type_post', $params['p_type_post']);
		$prepare->bindValue(':p_nave', $params['p_nave']);
		$prepare->bindValue(':p_lay_out', $params['p_lay_out']);
		$prepare->execute();
		return $prepare->fetchAll(PDO::FETCH_ASSOC);
	}
}
