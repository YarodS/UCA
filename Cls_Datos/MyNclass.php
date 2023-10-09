<?php
date_default_timezone_set('America/Lima');
require_once(dirname(__FILE__) . '/MyPDO.php');
class MyNclass{
	public function get_hora(){
		return date('H:i:s');
	}
	public function get_dia(){
		return date('Y-m-d');
	}
	public function money_format($format,$number) {
		return  $format.'. ' . number_format((float)$number, 2, '.', '');
	}
	public function msg_table(){
		return '<div class="alert alert-warning" role="alert">No hay Registros</div>';
	}
	public function get_ceros($number,$log){
		return str_pad((int) $number,$log,'0',STR_PAD_LEFT);
	}
	public function get_ltrim($dato,$caract){
		return ltrim($dato,''.$caract.'');
	}
	public function msg_warning_list(){
		return '<div class="alert alert-warning" role="alert"><b>OOOPS!</b> No hay Registros..! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
	}
	public function get_tools_windows($params = array()){
		switch ($params['opt']) {
			case 'iprint':
				return ' <a href="'.$params['href'].'.php?'.$_SERVER['QUERY_STRING'].'" class="btn btn-info btn-sm pull-right" title="Imprimir" id="btn_print"><i class="fo-icon glyphicon glyphicon-print closed"></i></a> ';
			break;
			case 'close':
				return ' <a href="'.$params['href'].'.php'.$params['q'].'" class="btn btn-danger btn-sm pull-right" title="Cerrar la pestaña"><i class="fo-icon glyphicon glyphicon-remove closed"></i></a> ';
			break;
			case 'refresh':
				return ' <a href="'.$params['href'].'" class="btn btn-default btn-sm pull-right" title="Actualizar Pagina" id="btn-reload"><i class="fo-icon glyphicon glyphicon-refresh"></i></a> ';
			break;
			case 'excel':
				return ' <a href="'.$params['href'].'.php?'.$_SERVER['QUERY_STRING'].'" class="btn btn-success btn-sm pull-right" title="Exportar a Excel">Exportar <i class="fo-icon glyphicon glyphicon-list-alt closed"></i></a> ';
			break;
			case 'pdf':
				return '<a href="'.$params['href'].'.php?'.$_SERVER['QUERY_STRING'].'" class="btn btn-danger btn-sm pull-right" title="Exportar a pdf"><i class="fo-icon glyphicon glyphicon-file closed"></i></a> ';
			break;
			case 'send':
				return '<a href="'.$params['href'].'.php?'.$_SERVER['QUERY_STRING'].$params['q'].'" class="btn btn-info btn-sm pull-right" title="Enviar pdf"><i class="fo-icon glyphicon glyphicon-send closed"></i></a> ';
			break;
			case 'modal':
				return ' <a href="'.$params['href'].'" class="btn btn-success btn-sm pull-right" title="Exportar a Excel" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fo-icon glyphicon glyphicon-list-alt closed"></i></a> ';
			break;
			case 'newmodal':
				return ' <a href="'.$params['href'].'" class="btn btn-itsanet btn-sm pull-right newobjet" data-new="'.$params['data'].'" title="Nuevo" data-toggle="modal" data-target="#myModal"><i class="fo-icon glyphicon glyphicon-plus closed"></i> Nuevo</a>';
			break;
			case 'newcust':
				return ' <a href="'.$params['href'].'" class="btn btn-default btn-sm pull-right newobjet" data-new="'.$params['data'].'" title="Nuevo"><i class="fo-icon glyphicon glyphicon-plus"></i> Nuevo</a>';
			break;
		}
	}
	public function get_months(){
		$meses = array(1=> "Enero",2=>"Febrero",3=>"Marzo",4=>"Abril",5=>"Mayo",6=>"Junio",7=>"Julio",8=>"Agosto",9=>"Septiembre",10=>"Octubre",11=>"Noviembre",12=>"Diciembre");
		return $meses;
	}
	public function get_lastDayMonth($params = array()) {
		return date("d",(mktime(0,0,0,$params['p_month']+1,1,$params['p_year'])-1));
	}
}
