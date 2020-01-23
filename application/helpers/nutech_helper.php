<?php

/*
  Document   : nutech_helper
  Created on : Jul 25, 2018 5:18:36 PM
  Author     : Andedi
  Description: Purpose of the PHP File follows.
 */

function function_terbilang($x) {
    $x = abs($x);
    $angka = array("", "satu", "dua", "tiga", "empat", "lima",
    "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($x <12) {
        $temp = " ". $angka[$x];
    } else if ($x <20) {
        $temp = function_terbilang($x - 10). " belas";
    } else if ($x <100) {
        $temp = function_terbilang($x/10)." puluh". function_terbilang($x % 10);
    } else if ($x <200) {
        $temp = " Seratus" . function_terbilang($x - 100);
    } else if ($x <1000) {
        $temp = function_terbilang($x/100) . " ratus" . function_terbilang($x % 100);
    } else if ($x <2000) {
        $temp = " Seribu" . function_terbilang($x - 1000);
    } else if ($x <1000000) {
        $temp = function_terbilang($x/1000) . " ribu" . function_terbilang($x % 1000);
    } else if ($x <1000000000) {
        $temp = function_terbilang($x/1000000) . " juta" . function_terbilang($x % 1000000);
    } else if ($x <1000000000000) {
        $temp = function_terbilang($x/1000000000) . " milyar" . function_terbilang(fmod($x,1000000000));
    } else if ($x <1000000000000000) {
        $temp = function_terbilang($x/1000000000000) . " trilyun" . function_terbilang(fmod($x,1000000000000));
    }
        return $temp;
}

function hari_ini($hariku){
  $hari = $hariku;
 
  switch($hari){
    case 'Sun':
      $hari_ini = "Minggu";
    break;
 
    case 'Mon':     
      $hari_ini = "Senin";
    break;
 
    case 'Tue':
      $hari_ini = "Selasa";
    break;
 
    case 'Wed':
      $hari_ini = "Rabu";
    break;
 
    case 'Thu':
      $hari_ini = "Kamis";
    break;
 
    case 'Fri':
      $hari_ini = "Jumat";
    break;
 
    case 'Sat':
      $hari_ini = "Sabtu";
    break;
    
    default:
      $hari_ini = "Tidak di ketahui";   
    break;
  }
 
  return "<b>" . $hari_ini . "</b>";
 
}

function idr_currency($nominal) {
  return number_format($nominal, 0, ',', '.');
}

function format_time($time)
{
	return date("H:i",strtotime ($time));
}

function format_date_old($date)
{
	return date("d F Y ", strtotime($date));
}

function format_date($date) {
  $date = date("Y-m-d ", strtotime($date));
    $data = explode('-', $date);

    $month = array(
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    );

    return (int)$data[2]." {$month[$data[1]]} {$data[0]}";
}

function format_dateTime($date)
{
	return date("d F Y H:i", strtotime($date));
}
function format_dateTimeHis($date)
{
  return date("d F Y H:i:s", strtotime($date));
}

function success_color($text)
{
	return "<font color='#00FF00'><b>".$text."</font></b>";
}
function failed_color($text)
{
  return "<font color='red'><b>".$text."</font></b>";
}
function pending_color($text)
{
	return "<font color='orange'><b>".$text."</font></b>";
}

function success_label($text)
{
  return "<span style='border-radius: 5px 5px 5px 5px !important;' class='label label-success'>".$text."<span>";
}

function failed_label($text)
{
  return "<span style='border-radius: 5px 5px 5px 5px !important;' class='label label-danger'>".$text."<span>";
}

function warning_label($text)
{
  return "<span class='label label-warning'>".$text."<span>";
}

function is_phone_number($phone) {
  $prefix = '+628';
  if (substr($phone, 0, 4) == $prefix) {
    return TRUE;
  } else {
    return FALSE;
  }
}

function save_base64img($base64_string, $save_path) {
  $imageData = base64_decode($base64_string);
  $source = imagecreatefromstring($imageData);
  $save = imagejpeg($source, $save_path, 86);
  imagedestroy($source);

  return $save;
}

function generate_ymd_dir($path, $y = '', $m = '', $d = '') {
  $THIS =& get_instance();
  $THIS->load->helper('file');


  if (!file_exists($path . '/index.html')) {
    write_file($path . '/index.html', '');
  }

  $y = ($y == '') ? date('Y') : $y;
  $y = $path . '/' . $y;
  if (!is_dir($y)) {
    if (mkdir($y, 0755, TRUE))
      write_file($y . '/index.html', '');
  }

  $m = ($m == '') ? date('m') : $m;
  $ym = $y . '/' . $m;
  if (!is_dir($ym)) {
    if (mkdir($ym, 0755, TRUE))
      write_file($ym . '/index.html', '');
  }

  $d = ($d == '') ? date('d') : $d;
  $ymd = $y . '/' . $m . '/' . $d;
  if (!is_dir($ymd)) {
    if (mkdir($ymd, 0755, TRUE))
      write_file($ymd . '/index.html', '');
  }

  return $ymd;
}

if(!function_exists('validate_ajax')){
  function validate_ajax() {
    $CI   =& get_instance();
    if (!$CI->input->is_ajax_request()) {
      redirect('error_401');
    }
  }
}

if(!function_exists('headerForm')){
  function headerForm($title){
    $html  = '<div class="portlet-title">';
    $html .= '<div class="caption">';
    $html .= ''.$title.'</div><div class="tools">';
    $html .= '<button type="button" id="close" name="close" class="btn btn-box-tool btn-xs btn-primary" onclick="closeModal()"><i class="fa fa-times"></i></button></div></div>';

    return $html;
  }
}

if(!function_exists('createBtnForm')){
  function createBtnForm($type){
    $html  = '<div class="box-footer text-right">';
    $html .= '<button type="button" class="btn btn-sm btn-default" onclick="closeModal()"><i class="fa fa-close"></i> Cancel</button> ';
    $html .= '<button type="submit" class="btn btn-sm btn-primary" id="saveBtn" id="saveBtn"><i class="fa fa-check"></i> '.$type.'</button>';
    $html .= '</div>';

    return $html;
  }
}

if(!function_exists('json_api')){
  function json_api($code,$message,$data=''){
    if($data == ''){
      $array = array(
        'code'  => $code, 
        'message' => $message
      );
    }
    else
    {
      $array = array(
        'code'  => $code, 
        'message' => $message,
        'data'   => $data
      );
    }
    return json_encode($array);
  }
}

function get_config_param($type) {
  $THIS =& get_instance();
  $THIS->load->model('global_model');
  $config_param = $THIS->global_model->getconfigParam_byType($type);
  $arrayName = array();
  foreach ($config_param as $key => $value) {
          $arrayName[$value->param_name] = $value->param_value; 
  }
  return $arrayName;
}
?>
