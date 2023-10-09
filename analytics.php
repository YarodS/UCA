<?php
require_once('Cls_Datos/MySession.php');
require_once('theme/Header.php');
require_once('theme/Footer.php');
require_once('Cls_Datos/MyAnalytics.php');
$MySession = new MySession();
($MySession->get('id_user') ? $MySession->get('id_user') : header('Location: login.php'));

$MyAnalytics = new MyAnalytics();
$Header = new Header();
$Footer = new Footer();
$_REQUEST['action'] = !empty($_REQUEST['action']) ? $_REQUEST['action'] : '';

$echo = '';
$echo .= $Header->run(array('title' => 'Admin ITSANET PERU'));
$echo .= '<div class="container-fluid">';
  
$echo .='<div class="row">';
  $echo .='<div class="col-md-12">';
    $echo .= '<div class="panel panel-default">';
      $echo .= '<div class="panel-heading">';
        $echo .= '<i class="glyphicon glyphicon-signal"></i> REPORTE POR TIPO DE POSICIONES';
      $echo .= '</div>';
      $echo .='<div class="table-responsive">';
        $echo .= '<table class=table table-hover table-bordered">';
          $echo .= '<thead>';
            $echo .= '<tr>';
              $echo .= '<th colspan="6" class="text-center">GENERAL</th>';
              $echo .= '<th colspan="15" class="text-center">POR MÓDULO</th>';
            $echo .= '</tr>';
            $echo .= '<tr>';     
              $echo .= '<th class="text-center">TIPO</th>';
              $echo .= '<th class="text-center">TOTAL</th>';
              $echo .= '<th class="success text-center">OCUPADAS</th>';
              $echo .= '<th class="success text-center">%</th>';
              $echo .= '<th class="danger text-center">LIBRES</th>';
              $echo .= '<th class="danger text-center">%</th>';
              foreach ($MyAnalytics->uca_get_listNave_lay_out() as $ps) {
              $echo .= '<th class="info text-center" title="'.$ps['DESCRIPCION'].'">'.$ps['NAVE_COD'].'</th>';                
              }
            $echo .= '</tr>';
          $echo .= '</thead>';
          $totals = 0; $ocup = 0; $libr = 0;
          $rsdata = $MyAnalytics->uca_get_analytics_posicion_itsa200(['p_lay_out'=>'RACK']);
          foreach ($rsdata as $i) 
          {
            $echo .= '<tr>';
              $echo .= '<td><span>'.$i['TIPO_POSICION'].'</span></td>';
              $echo .= '<td class="text-center">'.$i['TOTAL'].'</td>';
              $echo .= '<td class="success text-center">'.$i['OCUPADAS'].'</td>';
              $echo .= '<td class="success text-center">'.round(($i['OCUPADAS']*100) / $i['TOTAL']).'%</td>';
              $echo .= '<td class="danger text-center"><a href="exportPositionLibre.php?lay_out='.$i['LAY_OUT'].'&type='.$i['TIPO_POSICION'].'"> <i class="glyphicon glyphicon-download-alt pull-right" title="Total posiciones vacias"></i>'.$i['LIBRES'].'</a></td>';
              $echo .= '<td class="danger text-center">'.round(($i['LIBRES']*100) / $i['TOTAL']).'%</td>';
              $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="javascript:void(0)" data-layout="'.$i['LAY_OUT'].'" data-type="'.$i['TIPO_POSICION'].'" data-nave="A">'.$i['VAC_A'].'</a></td>';
              $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="javascript:void(0)" data-layout="'.$i['LAY_OUT'].'" data-type="'.$i['TIPO_POSICION'].'" data-nave="B">'.$i['VAC_B'].'</a></td>';
              $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="javascript:void(0)" data-layout="'.$i['LAY_OUT'].'" data-type="'.$i['TIPO_POSICION'].'" data-nave="C">'.$i['VAC_C'].'</a></td>';
              $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="javascript:void(0)" data-layout="'.$i['LAY_OUT'].'" data-type="'.$i['TIPO_POSICION'].'" data-nave="D">'.$i['VAC_D'].'</a></td>';
              $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="javascript:void(0)" data-layout="'.$i['LAY_OUT'].'" data-type="'.$i['TIPO_POSICION'].'" data-nave="DI">'.$i['VAC_DI'].'</a></td>';
              $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="javascript:void(0)" data-layout="'.$i['LAY_OUT'].'" data-type="'.$i['TIPO_POSICION'].'" data-nave="E">'.$i['VAC_E'].'</a></td>';
              $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="javascript:void(0)" data-layout="'.$i['LAY_OUT'].'" data-type="'.$i['TIPO_POSICION'].'" data-nave="ES">'.$i['VAC_ES'].'</a></td>';
              $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="javascript:void(0)" data-layout="'.$i['LAY_OUT'].'" data-type="'.$i['TIPO_POSICION'].'" data-nave="ES2">'.$i['VAC_ES2'].'</a></td>';
              $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="javascript:void(0)" data-layout="'.$i['LAY_OUT'].'" data-type="'.$i['TIPO_POSICION'].'" data-nave="ES3">'.$i['VAC_ES3'].'</a></td>';
              $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="javascript:void(0)" data-layout="'.$i['LAY_OUT'].'" data-type="'.$i['TIPO_POSICION'].'" data-nave="F">'.$i['VAC_F'].'</a></td>';
              $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="javascript:void(0)" data-layout="'.$i['LAY_OUT'].'" data-type="'.$i['TIPO_POSICION'].'" data-nave="G">'.$i['VAC_G'].'</a></td>';
              $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="javascript:void(0)" data-layout="'.$i['LAY_OUT'].'" data-type="'.$i['TIPO_POSICION'].'" data-nave="H">'.$i['VAC_H'].'</a></td>';
              $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="javascript:void(0)" data-layout="'.$i['LAY_OUT'].'" data-type="'.$i['TIPO_POSICION'].'" data-nave="I">'.$i['VAC_I'].'</a></td>';
              $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="javascript:void(0)" data-layout="'.$i['LAY_OUT'].'" data-type="'.$i['TIPO_POSICION'].'" data-nave="J">'.$i['VAC_J'].'</a></td>';
              $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="javascript:void(0)" data-layout="'.$i['LAY_OUT'].'" data-type="'.$i['TIPO_POSICION'].'" data-nave="K">'.$i['VAC_K'].'</a></td>';
              $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="javascript:void(0)" data-layout="'.$i['LAY_OUT'].'" data-type="'.$i['TIPO_POSICION'].'" data-nave="L">'.$i['VAC_L'].'</a></td>';
              $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="javascript:void(0)" data-layout="'.$i['LAY_OUT'].'" data-type="'.$i['TIPO_POSICION'].'" data-nave="M">'.$i['VAC_M'].'</a></td>';
              $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="javascript:void(0)" data-layout="'.$i['LAY_OUT'].'" data-type="'.$i['TIPO_POSICION'].'" data-nave="N">'.$i['VAC_N'].'</a></td>';
              $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="javascript:void(0)" data-layout="'.$i['LAY_OUT'].'" data-type="'.$i['TIPO_POSICION'].'" data-nave="o">'.$i['VAC_O'].'</a></td>';
              $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="javascript:void(0)" data-layout="'.$i['LAY_OUT'].'" data-type="'.$i['TIPO_POSICION'].'" data-nave="P">'.$i['VAC_P'].'</a></td>';
              $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="javascript:void(0)" data-layout="'.$i['LAY_OUT'].'" data-type="'.$i['TIPO_POSICION'].'" data-nave="P3">'.$i['VAC_P3'].'</a></td>';
              $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="javascript:void(0)" data-layout="'.$i['LAY_OUT'].'" data-type="'.$i['TIPO_POSICION'].'" data-nave="Q">'.$i['VAC_Q'].'</a></td>';
              $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="javascript:void(0)" data-layout="'.$i['LAY_OUT'].'" data-type="'.$i['TIPO_POSICION'].'" data-nave="R">'.$i['VAC_R'].'</a></td>';
              $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="javascript:void(0)" data-layout="'.$i['LAY_OUT'].'" data-type="'.$i['TIPO_POSICION'].'" data-nave="S">'.$i['VAC_S'].'</a></td>';
              $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="javascript:void(0)" data-layout="'.$i['LAY_OUT'].'" data-type="'.$i['TIPO_POSICION'].'" data-nave="V">'.$i['VAC_V'].'</a></td>';
              $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="javascript:void(0)" data-layout="'.$i['LAY_OUT'].'" data-type="'.$i['TIPO_POSICION'].'" data-nave="X">'.$i['VAC_X'].'</a></td>';
              $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="javascript:void(0)" data-layout="'.$i['LAY_OUT'].'" data-type="'.$i['TIPO_POSICION'].'" data-nave="Z">'.$i['VAC_Z'].'</a></td>';
            $echo .= '</tr>';
            $totals = $totals +$i['TOTAL'];
            $ocup = $ocup + $i['OCUPADAS'];
            $libr = $libr + $i['LIBRES'];
          }
          $data = $MyAnalytics->uca_get_mts_itsa200();
          $echo .= '<tr>';
            $echo .= '<td><span>'.$data['MT2_TYPE_POSITION'].'</span></td>';
            $echo .= '<td class="text-center">'.round($data['MT2_TOTAL']).'</td>';
            $echo .= '<td class="success text-center">'.round($data['MT2_OCUPADAS']).'</td>';
            $echo .= '<td class="success text-center">'.round(($data['MT2_OCUPADAS']*100) / $data['MT2_TOTAL']).'%</td>';
            $echo .= '<td class="danger text-center"><a href="exportPositionLibre.php?lay_out='.$data['MT2_TYPE_POSITION'].'"> <i class="glyphicon glyphicon-download-alt pull-right" title="Total MT2 vacias"></i>'.round($data['MT2_LIBRES']).'</a></td>';
            $echo .= '<td class="danger text-center">'.round(($data['MT2_LIBRES']*100) / $data['MT2_TOTAL']).'%</td>';
            $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="#" data-layout="'.$data['MT2_TYPE_POSITION'].'" data-type="P" data-nave="A">'.round($data['MT2_VAC_A'],2).'</a></td>';
            $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="#" data-layout="'.$data['MT2_TYPE_POSITION'].'" data-type="P" data-nave="B">'.round($data['MT2_VAC_B'],2).'</a></td>';
            $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="#" data-layout="'.$data['MT2_TYPE_POSITION'].'" data-type="P" data-nave="C">'.round($data['MT2_VAC_C'],2).'</a></td>';
            $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="#" data-layout="'.$data['MT2_TYPE_POSITION'].'" data-type="P" data-nave="D">'.round($data['MT2_VAC_D'],2).'</a></td>';
            $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="#" data-layout="'.$data['MT2_TYPE_POSITION'].'" data-type="P" data-nave="DI">'.round($data['MT2_VAC_DI'],2).'</a></td>';
            $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="#" data-layout="'.$data['MT2_TYPE_POSITION'].'" data-type="P" data-nave="E">'.round($data['MT2_VAC_E'],2).'</a></td>';
            $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="#" data-layout="'.$data['MT2_TYPE_POSITION'].'" data-type="P" data-nave="ES">'.round($data['MT2_VAC_ES'],2).'</a></td>';
            $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="#" data-layout="'.$data['MT2_TYPE_POSITION'].'" data-type="P" data-nave="ES2">'.round($data['MT2_VAC_ES2'],2).'</a></td>';
            $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="#" data-layout="'.$data['MT2_TYPE_POSITION'].'" data-type="P" data-nave="ES3">'.round($data['MT2_VAC_ES3'],2).'</a></td>';
            $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="#" data-layout="'.$data['MT2_TYPE_POSITION'].'" data-type="P" data-nave="F">'.round($data['MT2_VAC_F'],2).'</a></td>';
            $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="#" data-layout="'.$data['MT2_TYPE_POSITION'].'" data-type="P" data-nave="G">'.round($data['MT2_VAC_G'],2).'</a></td>';
            $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="#" data-layout="'.$data['MT2_TYPE_POSITION'].'" data-type="P" data-nave="H">'.round($data['MT2_VAC_H'],2).'</a></td>';
            $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="#" data-layout="'.$data['MT2_TYPE_POSITION'].'" data-type="P" data-nave="I">'.round($data['MT2_VAC_I'],2).'</a></td>';
            $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="#" data-layout="'.$data['MT2_TYPE_POSITION'].'" data-type="P" data-nave="J">'.round($data['MT2_VAC_J'],2).'</a></td>';
            $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="#" data-layout="'.$data['MT2_TYPE_POSITION'].'" data-type="P" data-nave="K">'.round($data['MT2_VAC_K'],2).'</a></td>';
            $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="#" data-layout="'.$data['MT2_TYPE_POSITION'].'" data-type="P" data-nave="L">'.round($data['MT2_VAC_L'],2).'</a></td>';
            $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="#" data-layout="'.$data['MT2_TYPE_POSITION'].'" data-type="P" data-nave="M">'.round($data['MT2_VAC_M'],2).'</a></td>';
            $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="#" data-layout="'.$data['MT2_TYPE_POSITION'].'" data-type="P" data-nave="N">'.round($data['MT2_VAC_N'],2).'</a></td>';
            $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="#" data-layout="'.$data['MT2_TYPE_POSITION'].'" data-type="P" data-nave="O">'.round($data['MT2_VAC_O'],2).'</a></td>';
            $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="#" data-layout="'.$data['MT2_TYPE_POSITION'].'" data-type="P" data-nave="P">'.round($data['MT2_VAC_P'],2).'</a></td>';
            $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="#" data-layout="'.$data['MT2_TYPE_POSITION'].'" data-type="P" data-nave="P3">'.round($data['MT2_VAC_P3'],2).'</a></td>';
            $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="#" data-layout="'.$data['MT2_TYPE_POSITION'].'" data-type="P" data-nave="Q">'.round($data['MT2_VAC_Q'],2).'</a></td>';
            $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="#" data-layout="'.$data['MT2_TYPE_POSITION'].'" data-type="P" data-nave="R">'.round($data['MT2_VAC_R'],2).'</a></td>';
            $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="#" data-layout="'.$data['MT2_TYPE_POSITION'].'" data-type="P" data-nave="S">'.round($data['MT2_VAC_S'],2).'</a></td>';
            $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="#" data-layout="'.$data['MT2_TYPE_POSITION'].'" data-type="P" data-nave="T">'.round($data['MT2_VAC_V'],2).'</a></td>';
            $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="#" data-layout="'.$data['MT2_TYPE_POSITION'].'" data-type="P" data-nave="X">'.round($data['MT2_VAC_X'],2).'</a></td>';
            $echo .= '<td class="info text-center"><a data-toggle="modal" data-target=".myModal" class="box_positions" href="#" data-layout="'.$data['MT2_TYPE_POSITION'].'" data-type="P" data-nave="Z">'.round($data['MT2_VAC_Z'],2).'</a></td>';
          $echo .= '</tr>';
        $echo .= '</table>';
      $echo .= '</div>';
    $echo .='</div>';
  $echo .='</div>';
$echo .='</div>';

//Model de position
$echo .='<div class="modal fade myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">';
  $echo .= '<div class="modal-dialog" role="document">';
    $echo .= '<div class="modal-content">';
    $echo .= '</div>';
  $echo .= '</div>';
$echo .= '</div>';
//end models position

// reporte detallado por clientes
$echo .='<div class="row">';
  $echo .='<div class="col-lg-12">';
    $echo .= '<div class="panel panel-default">';
      $echo .= '<div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> REPORTE DE POSICIONES DETALLADO POR CLIENTE</div>';
      $echo .='<div class="table-responsive">';
      $echo .= '<table class="table table-hover table-bordered t-small">';
        $echo .= '<thead>';
        $echo .= '<tr>';
          $echo .= '<th rowspan="2" class="text-center" style="font-size:15px">Cliente</th>';
          $echo .= '<th colspan="2" style="background-color: #ffd8bd; font-weight: bold;" class="text-center">ESTANTERIA</th>';
          $echo .= '<th colspan="2" style="background-color: #bcddee; font-weight: bold;" class="text-center">JAULA</th>';
          $echo .= '<th colspan="2" style="background-color: #ece7f6; font-weight: bold;" class="text-center">SHORT</th>';
          $echo .= '<th colspan="2" style="background-color: #dde9c5; font-weight: bold;" class="text-center">HIGH</th>';
          $echo .= '<th colspan="2" style="background-color: #e0bcbf; font-weight: bold;" class="text-center">STANDARD</th>';
          $echo .= '<th colspan="2" style="background-color: #bcc7e6; font-weight: bold;" class="text-center">STANDARD BPA</th>';
          $echo .= '<th colspan="2" style="background-color: #96b4e7; font-weight: bold;" class="text-center">LABORATORIO</th>';
          $echo .= '<th colspan="2" style="background-color: #b7b794; font-weight: bold;" class="text-center">SHORT CONTROLADOS</th>';
          $echo .= '<th colspan="2" style="background-color: #e9e6e1; font-weight: bold;" class="text-center">SHORT DIGESA</th>';
          $echo .= '<th colspan="2" style="background-color: #ceccc5; font-weight: bold;" class="text-center">SHORT DIGEMID</th>';
          $echo .= '<th colspan="2" style="background-color: #ceccc5; font-weight: bold;" class="text-center">GAVETAS</th>';
          $echo .= '<th colspan="2" style="background-color: #eeaa01; font-weight: bold;" class="text-center">PISO M2</th>';
      $echo .= '</tr>';
      $echo .= '<tr>';
        $echo .= '<th style="background-color: #ffd8bd" class="text-center">OCUP</th>';
        $echo .= '<th style="background-color: #ffd8bd" class="text-center">%</th>';
        $echo .= '<th style="background-color: #bcddee" class="text-center">OCUP</th>';
        $echo .= '<th style="background-color: #bcddee" class="text-center">%</th>';
        $echo .= '<th style="background-color: #ece7f6" class="text-center">OCUP</th>';
        $echo .= '<th style="background-color: #ece7f6" class="text-center">%</th>';
        $echo .= '<th style="background-color: #dde9c5" class="text-center">OCUP</th>';
        $echo .= '<th style="background-color: #dde9c5" class="text-center">%</th>';
        $echo .= '<th style="background-color: #e0bcbf" class="text-center">OCUP</th>';
        $echo .= '<th style="background-color: #e0bcbf" class="text-center">%</th>';
        $echo .= '<th style="background-color: #bcc7e6" class="text-center">OCUP</th>';
        $echo .= '<th style="background-color: #bcc7e6" class="text-center">%</th>';
        $echo .= '<th style="background-color: #96b4e7" class="text-center">OCUP</th>';
        $echo .= '<th style="background-color: #96b4e7" class="text-center">%</th>';
        $echo .= '<th style="background-color: #b7b794" class="text-center">OCUP</th>';
        $echo .= '<th style="background-color: #b7b794" class="text-center">%</th>';
        $echo .= '<th style="background-color: #e9e6e1" class="text-center">OCUP</th>';
        $echo .= '<th style="background-color: #e9e6e1" class="text-center">%</th>';
        $echo .= '<th style="background-color: #ceccc5" class="text-center">OCUP</th>';
        $echo .= '<th style="background-color: #ceccc5" class="text-center">%</th>';
        $echo .= '<th style="background-color: #ceccc5" class="text-center">OCUP</th>';
        $echo .= '<th style="background-color: #ceccc5" class="text-center">%</th>';
        $echo .= '<th style="background-color: #eeaa01" class="text-center">OCUP</th>';
        $echo .= '<th style="background-color: #eeaa01" class="text-center">%</th>';
      $echo .= '</tr>';
        $echo .= '</thead>';
        $lll1 = $MyAnalytics->uca_get_analytics_position_type_ocup_itsa200();
        foreach ($MyAnalytics->uca_get_analytics_position_customers() as $ii) {
          $echo .= '<tr>';
            $echo .= '<td><a href="exportPosition.php?id='.$ii['CLIENTE_ID'].'"> <i class="glyphicon glyphicon-download-alt pull-right"></i>'.$ii['RAZON_SOCIAL'].' <span class="badge pull-right" title="Total de Ocupacion RACK">'.($ii['total_posi'] - $ii['piso_ocup_pos']).'</span></a></td>';
            $echo .= '<td style="background-color: #ffd8bd; font-weight: bold;" class="text-center">'.$ii['estan_ocup'].'</td>';
            $echo .= '<td style="background-color: #ffd8bd; font-weight: bold;" class="text-center">'.@round(($ii['estan_ocup'] / $lll1['t_stanteria_ucup']) * 100,2).'%</td>';

            $echo .= '<td style="background-color: #bcddee; font-weight: bold;" class="text-center">'.$ii['jaul_ocup'].'</td>';
            $echo .= '<td style="background-color: #bcddee; font-weight: bold;" class="text-center">'.@round(($ii['jaul_ocup'] / $lll1['t_jaula_ucup']) * 100,2).'%</td>';
            
            $echo .= '<td style="background-color: #ece7f6; font-weight: bold;" class="text-center">'.$ii['short_ocup'].'</td>';
            $echo .= '<td style="background-color: #ece7f6; font-weight: bold;" class="text-center">'.@round(($ii['short_ocup'] / $lll1['t_short_ucup']) * 100,2).'%</td>';
            
            $echo .= '<td style="background-color: #dde9c5; font-weight: bold;" class="text-center">'.$ii['high_ocup'].'</td>';
            $echo .= '<td style="background-color: #dde9c5; font-weight: bold;" class="text-center">'.@round(($ii['high_ocup'] / $lll1['t_high_ucup']) * 100,2).'%</td>';

            $echo .= '<td style="background-color: #e0bcbf; font-weight: bold;" class="text-center">'.$ii['stand_ocup'].'</td>';
            $echo .= '<td style="background-color: #e0bcbf; font-weight: bold;" class="text-center">'.@round(($ii['stand_ocup'] / $lll1['t_stand_ucup']) * 100,2).'%</td>';
            
            $echo .= '<td style="background-color: #bcc7e6; font-weight: bold;" class="text-center">'.$ii['standbpa_ocup'].'</td>';
            $echo .= '<td style="background-color: #bcc7e6; font-weight: bold;" class="text-center">'.@round(($ii['standbpa_ocup'] / $lll1['t_standbpa_ucup']) * 100,2).'%</td>';

            $echo .= '<td style="background-color: #96b4e7; font-weight: bold;" class="text-center">'.$ii['laboratorio_ocup'].'</td>';
            $echo .= '<td style="background-color: #96b4e7; font-weight: bold;" class="text-center">'.@round(($ii['laboratorio_ocup'] / ($lll1['t_laboratorio_ucup'] == 0 ? 1 : $lll1['t_laboratorio_ucup'])) * 100,2).'%</td>';

            $echo .= '<td style="background-color: #b7b794; font-weight: bold;" class="text-center">'.$ii['shortcontrolados_ocup'].'</td>';
            $echo .= '<td style="background-color: #b7b794; font-weight: bold;" class="text-center">'.@round(($ii['shortcontrolados_ocup'] / $lll1['t_shortdcontrolados_ucup']) * 100,2).'%</td>';
            
            $echo .= '<td style="background-color: #e9e6e1; font-weight: bold;" class="text-center">'.$ii['shortdigesa_ocup'].'</td>';
            $echo .= '<td style="background-color: #e9e6e1; font-weight: bold;" class="text-center">'.@round(($ii['shortdigesa_ocup'] / $lll1['t_shortdigesa_ucup']) * 100,2).'%</td>';

            $echo .= '<td style="background-color: #ceccc5; font-weight: bold;" class="text-center">'.$ii['shortdigemid_ocup'].'</td>';
            $echo .= '<td style="background-color: #ceccc5; font-weight: bold;" class="text-center">'.@round(($ii['shortdigemid_ocup'] / $lll1['t_shortbdigemid_ucup']) * 100,2).'%</td>';

            $echo .= '<td style="background-color: #ceccc5; font-weight: bold;" class="text-center">'.$ii['gavetas_ocup'].'</td>';
            $echo .= '<td style="background-color: #ceccc5; font-weight: bold;" class="text-center">'.@round(($ii['gavetas_ocup'] / $lll1['t_gavetas_ucup']) * 100,2).'%</td>';

            $echo .= '<td style="background-color: #eeaa01; font-weight: bold;" class="text-center" title="Cantidad de Posiciones: ('.$ii['piso_ocup_pos'].')">'.@round($ii['piso_ocup']).'</td>';
            $echo .= '<td style="background-color: #eeaa01; font-weight: bold;" class="text-center">'.@round(($ii['piso_ocup'] / round($data['MT2_OCUPADAS'])) * 100).'%</td>';
          $echo .= '</tr>';
        }
      $echo .= '</table>';
      $echo .= '</div>';
    $echo .= '</div>';
  $echo .='</div>';
$echo .='</div>';
$echo .= '</div>';

$echo .= '
<style>
  .glyphicon.fast-right-spinner 
  {
    -webkit-animation: glyphicon-spin-r 1s infinite linear;
    animation: glyphicon-spin-r 1s infinite linear;
  }

  @keyframes glyphicon-spin-r 
  {
    0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }

    100% {
        -webkit-transform: rotate(359deg);
        transform: rotate(359deg);
    }
  }

  @keyframes glyphicon-spin-l 
  {
    0% {
        -webkit-transform: rotate(359deg);
        transform: rotate(359deg);
    }

    100% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
  }
</style>';

$echo .= $Footer->run();
echo $echo;