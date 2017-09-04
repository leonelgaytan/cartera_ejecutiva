<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



	if (!function_exists('validateDate'))
	{
		function validateDate ($fecha = NULL,$format = 'Y-m-d'){
		    $d = DateTime::createFromFormat($format, $fecha);
		    return $d && $d->format($format) == $fecha;
		}
	}


	if (!function_exists('verificaPermiso'))
	{
		function verificaPermiso ($tipo,$redirect = true,$accion = 4){
			$CI =& get_instance();
			$url = base_url() . 'index.php/' . $CI->uri->segment(1) . '/' . $CI->uri->segment(2) . '/error/' . $accion;
			if($tipo == 'generador'){
				if ($CI->ion_auth->in_group('admin') || $CI->ion_auth->in_group('generador')) {
					return true;
				}else{
					if($redirect){
						redirect($url);
					}else{
					$R['success'] = 0;
					$R['head'] = 'Error';
					$R['message'] = 'Privilegios insuficientes para realizar laacción solicitada';

		return $CI->output->set_content_type('application/json')->set_output(json_encode($R));

						exit();
					}

				}
			}elseif($tipo == 'visualizador'){
				if ($CI->ion_auth->in_group('admin') || $CI->ion_auth->in_group('generador') || $CI->ion_auth->in_group('visualizador')) {
					return true;
				}else{
					if($redirect){
						redirect($url);
					}else{
					$R['success'] = 0;
					$R['head'] = '';
					$R['message'] = 'Privilegios insuficientes para realizar laacción solicitada';
						return $CI->output->set_content_type('application/json')->set_output(json_encode($R));
					}

				}
			}else{
				$this->error();
			}

		}
	}

	if (!function_exists('getCaracteres'))
	{
		function getCaracteres ($tipo){
			// 1 : Array para remplazar
			// 2 : Caracteres especiales
			// 3 : Caracteres normales.
			if($tipo == 1){
				return array(
					"À"	=>	"a","Á"	=>	"a","Â"	=>	"a","Ã"	=>	"a","Ä"	=>	"a","Å"	=>	"a","Æ"	=>	"a","Ç"	=>	"c","È"	=>	"e","É"	=>	"e","Ê"	=>	"e","Ë"	=>	"e","Ì"	=>	"i","Í"	=>	"i","Î"	=>	"i","Ï"	=>	"i","Ð"	=>	"d","Ñ"	=>	"n","Ò"	=>	"o","Ó"	=>	"o","Ô"	=>	"o","Õ"	=>	"o","Ö"	=>	"o","Ø"	=>	"o","Ù"	=>	"u","Ú"	=>	"u","Û"	=>	"u","Ü"	=>	"u","Ý"	=>	"y","Þ"	=>	"b","ß"	=>	"s","à"	=>	"a","á"	=>	"a","â"	=>	"a","ã"	=>	"a","ä"	=>	"a","å"	=>	"a","æ"	=>	"a","ç"	=>	"c","è"	=>	"e","é"	=>	"e","ê"	=>	"e","ë"	=>	"e","ì"	=>	"i","í"	=>	"i","î"	=>	"i","ï"	=>	"i","ð"	=>	"o","ñ"	=>	"n","ò"	=>	"o","ó"	=>	"o","ô"	=>	"o","õ"	=>	"o","ö"	=>	"o","ø"	=>	"o","ù"	=>	"u","ú"	=>	"u","û"	=>	"u","ü"	=>	"u","ý"	=>	"y","ý"	=>	"y","þ"	=>	"b","ÿ"	=>	"y","Ŕ"	=>	"R","ŕ"	=>	"r"
				);
			}else if(2){
				return 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýýþÿŔŕ';
			}else if(3){
				return 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuuyybyRr';
			}else{
				return 'No se ha seleccionado un tipo válido.';
			}

		}
	}

	if (!function_exists('cambiaFecha'))
	{
		function cambiaFecha ($fecha = NULL,$format = 'd/m/y'){
			if(!$fecha == NULL){

			$datetime     = DateTime::createFromFormat($format, $fecha);

			$fecha = $datetime->format('d-m-Y');

			}
		    return $fecha;
		}
	}

	if (!function_exists('normaliza'))
	{
		function normaliza ($cadena){
		    $cadena = strtr($cadena, getCaracteres(1));
		    $cadena = strtolower($cadena);
		    return $cadena;
		}
	}


	if (!function_exists('isDocumento'))
	{
		function isDocumento ($archivo){
			$doc = false;
			if(strlen($archivo) > 0 AND $archivo != NULL){
				$arr_doc = explode('.',$archivo);
				if(is_array($arr_doc) && count($arr_doc) == 2 && $arr_doc[1] == 'pdf'){
					return true;
				}

			}

		    return $doc;
		}
	}

	if (!function_exists('getPropCat'))
	{
		function getPropCat ($tbl,$p = 'id'){
			$CI =& get_instance();
			$tablas = $CI->config->item('tablas');
			$prop = 'ID';
			for ($s=0; $s <count($tablas); $s++) { 
				if($tbl == $tablas[$s]['tbl']){
					$prop = $tablas[$s][$p];
				}
			}
			return $prop;
		}
	}

	if (!function_exists('getStringLike'))
	{
		function getStringLike($values,$field){
			$str = ''; 
			for ($a=0; $a <count($values); $a++) { 
				$str .= " LOWER(TRANSLATE($field, 'ÁÉÍÓÚÜÑáéíóúüñ', 'aeiouunaeiouun')) LIKE '%" . normaliza($values[$a]) . "%' OR ";
			}
			return substr($str, 0, -3);
		}
	}

	if (!function_exists('ordenarResultados'))
	{
		function ordenarResultados($values,$data,$field = 'NOMBRE_DEMANDANTE'){
			for ($v=0; $v <count($values); $v++) { 
				for ($d=0; $d <count($data); $d++) { 
					$NOM_DEMANDANTE = normaliza($data[$d][$field]);
					$NOMBRE   = normaliza($values[$v]);

					$pos = strpos($NOM_DEMANDANTE, $NOMBRE);
					if(!isset($data[$d]['COINCIDENCIAS'])){$data[$d]['COINCIDENCIAS'] = 0;}
					if ($pos !== false) {
						$data[$d]['COINCIDENCIAS'] = $data[$d]['COINCIDENCIAS'] + 1;
					}
				}
			}
			return orderMultiDimensionalArray($data,'COINCIDENCIAS',true);

		}
	}

	if (!function_exists('orderMultiDimensionalArray'))
	{
		function orderMultiDimensionalArray ($toOrderArray, $field, $inverse = false) {
		    $position = array();
		    $newRow = array();
		    foreach ($toOrderArray as $key => $row) {
		            $position[$key]  = $row[$field];
		            $newRow[$key] = $row;
		    }
		    if ($inverse) {
		        arsort($position);
		    }
		    else {
		        asort($position);
		    }
		    $returnArray = array();
		    foreach ($position as $key => $pos) {     
		        $returnArray[] = $newRow[$key];
		    }
		    return $returnArray;
		}
	}