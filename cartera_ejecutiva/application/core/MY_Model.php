<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class MY_Model extends CI_model {
		var $aOF = array(
			array("t" => "T_DEMANDANTES", "f" => "ID_UR_ADSCRIP_TRAB"),
			array("t" => "T_DEMANDANTES", "f" => "ID_CATEGORIA"),
			array("t" => "T_DATOS_DEMANDA", "f" => "ID_ACCION_LABORAL"),
			array("t" => "T_DATOS_DEMANDA", "f" => "ID_ESTATUS_PROCESAL"),
			array("t" => "T_DATOS_DEMANDA", "f" => "ID_CONDENA_NO_ECO"),
			array("t" => "T_DATOS_DEMANDA", "f" => "ID_CONDENA_ECO"),
			array("t" => "T_DATOS_DEMANDA", "f" => "ID_APERCIBIMIENTO"),
			array("t" => "T_DATOS_DEMANDA", "f" => "ID_CAUSA_CONCLUSION")
			);


	function getResponsables($ID_PROYECTO,$ID_RESPONSABLE = 0){
		$this->db->select('T_RESPONSABLES.*');
		$this->db->select('C_TITULOS.ABREVIATURA');
		$this->db->from('T_RESPONSABLES');
		$this->db->join('C_TITULOS','C_TITULOS.ID_TITULO = T_RESPONSABLES.ID_TITULO','inner');
		if($ID_PROYECTO > 0){
			$this->db->join('R_PROYECTO_RESPONSABLE','R_PROYECTO_RESPONSABLE.ID_RESPONSABLE = T_RESPONSABLES.ID_RESPONSABLE','inner');
			$this->db->join('T_CARTERA_EJECUTIVA_PROYECTOS','T_CARTERA_EJECUTIVA_PROYECTOS.ID_PROYECTO = R_PROYECTO_RESPONSABLE.ID_PROYECTO','inner');
			$this->db->WHERE('T_CARTERA_EJECUTIVA_PROYECTOS.ID_PROYECTO',$ID_PROYECTO);
		}

		if($ID_RESPONSABLE > 0){
			$this->db->WHERE('T_RESPONSABLES.ID_RESPONSABLE',$ID_RESPONSABLE);
		}

		$this->db->where('T_RESPONSABLES.ESTATUS', 1);
		$this->db->order_by('T_RESPONSABLES.NOMBRE_RESPONSABLE','ASC');
		return $this->db->get()->result_array();
	}

	function getEDN(){
		$this->db->select('ID_EDN AS ID');
		$this->db->select('OBJETIVOS_SEC_EDN AS NAME');
		$this->db->from('C_EDN');
		$this->db->where('ESTATUS', 1);
		$this->db->order_by('ID_EDN','ASC');
		return $this->db->get()->result_array();
	}

	function getAnioProyecto($ID_PROYECTO){
		$this->db->select('ANIO');
		$this->db->from('T_CARTERA_EJECUTIVA_PROYECTOS');
		$this->db->where('ID_PROYECTO', $ID_PROYECTO); 
		$this->db->where('ESTATUS', 1); 
		return $this->db->get()->row('ANIO');
	}

	function getFolioProyecto($ID_PROYECTO){
		$this->db->select('FOLIO_PROYECTO');
		$this->db->from('T_CARTERA_EJECUTIVA_PROYECTOS');
		$this->db->where('ID_PROYECTO', $ID_PROYECTO); 
		$this->db->where('ESTATUS', 1); 
		return $this->db->get()->row('FOLIO_PROYECTO');
	}

	function getDetalleFormato($DOCUMENTO){
		$this->db->select('T_DETALLE_FORMATO.*');
		$this->db->select('T_CARTERA_EJECUTIVA_PROYECTOS.ANIO');
		$this->db->select('T_CARTERA_EJECUTIVA_PROYECTOS.FOLIO_PROYECTO');
		$this->db->from('T_DETALLE_FORMATO');
		$this->db->join('T_CARTERA_EJECUTIVA_PROYECTOS','T_CARTERA_EJECUTIVA_PROYECTOS.ID_PROYECTO = T_DETALLE_FORMATO.ID_PROYECTO','inner');
		$this->db->where('T_DETALLE_FORMATO.DOCUMENTO', $DOCUMENTO); 
		return $this->db->get()->result_array();
	}

	function getFormato($ID_PROYECTO){
		$this->db->select('T_CARTERA_EJECUTIVA_PROYECTOS.ANIO');
		$this->db->select('T_CARTERA_EJECUTIVA_PROYECTOS.FOLIO_PROYECTO');
		$this->db->select('T_CARTERA_EJECUTIVA_PROYECTOS.DOCUMENTO');
		$this->db->from('T_CARTERA_EJECUTIVA_PROYECTOS');
		$this->db->where('T_CARTERA_EJECUTIVA_PROYECTOS.ID_PROYECTO', $ID_PROYECTO); 
		return $this->db->get()->result_array();
	}

	function getColumVal($TBL,$FIELD,$IDFIELD,$IDVAL){
		$this->db->select($FIELD);
		$this->db->from($TBL);
		$this->db->where($IDFIELD, $IDVAL); 
		return $this->db->get()->row($FIELD);
	}


	function existeProyecto($NOMBRE_PROYECTO){
		$this->db->select('*');
		$this->db->from('T_CARTERA_EJECUTIVA_PROYECTOS');
		$this->db->where('NOMBRE_PROYECTO', $NOMBRE_PROYECTO); 
		$this->db->where('ESTATUS', 1); 
		return $this->db->get()->result_array();
	}

	function getTipoProyecto($ID_PROYECTO){
		$this->db->select('ID_TIPO_PROYECTO');
		$this->db->from('T_CARTERA_EJECUTIVA_PROYECTOS');
		$this->db->where('ID_PROYECTO', $ID_PROYECTO); 
		$this->db->where('ESTATUS', 1); 
		return $this->db->get()->row('ID_TIPO_PROYECTO');
	}

	function getFormatosRecibidosX($ID_TIPO_OFICIO){
		$this->db->select('*');
		$this->db->from('C_FORMATOS_RECIBIDOS');
		$this->db->where('ID_TIPO_OFICIO', $ID_TIPO_OFICIO); 
		$this->db->where('ESTATUS', 1); 
		return $this->db->get()->result_array();
	}

	function getFormatosRecibidos($ID_TIPO_PROYECTO = 0,$ID_TIPO_OFICIO = 0){
		$this->db->select('C_FORMATOS_RECIBIDOS.ID_FORMATO');
		$this->db->select('C_TIPO_PROYECTO.TIPO_PROYECTO');
		$this->db->select('C_TIPOS_OFICIOS.DESCRIP_OFICIO');
		$this->db->select('C_FORMATOS_RECIBIDOS.FORMATOS_RECIBIDOS');
		$this->db->from('C_FORMATOS_RECIBIDOS');
		$this->db->join('R_FORMATO_OFICIO_PROYECTO', 'R_FORMATO_OFICIO_PROYECTO.ID_FORMATO = C_FORMATOS_RECIBIDOS.ID_FORMATO', 'inner');
		$this->db->join('C_TIPO_PROYECTO', 'C_TIPO_PROYECTO.ID_TIPO_PROYECTO = R_FORMATO_OFICIO_PROYECTO.ID_TIPO_PROYECTO', 'inner');
		$this->db->join('C_TIPOS_OFICIOS', 'C_TIPOS_OFICIOS.ID_TIPO_OFICIO = R_FORMATO_OFICIO_PROYECTO.ID_TIPO_OFICIO', 'inner');
		$this->db->where('C_FORMATOS_RECIBIDOS.ESTATUS', 1);
		$this->db->where('R_FORMATO_OFICIO_PROYECTO.ESTATUS', 1); 

		if($ID_TIPO_PROYECTO > 0){
			$this->db->where('R_FORMATO_OFICIO_PROYECTO.ID_TIPO_PROYECTO', $ID_TIPO_PROYECTO); 
		}

		if($ID_TIPO_OFICIO > 0){
			$this->db->where('R_FORMATO_OFICIO_PROYECTO.ID_TIPO_OFICIO', $ID_TIPO_OFICIO); 
		}

		return $this->db->get()->result_array();
	}

	function ExisteActividad($ID_PROYECTO,$ID_ACTIVIDAD){
		$this->db->select('ID_DETALLE_ACTIVIDAD');
		$this->db->from('T_DETALLE_ACTIVIDAD');
		$this->db->where('ID_PROYECTO', $ID_PROYECTO); 
		$this->db->where('ID_ACTIVIDAD', $ID_ACTIVIDAD); 
		$this->db->where('ESTATUS', 1); 
		return $this->db->get()->row('ID_DETALLE_ACTIVIDAD');
	}




	function getFormatos($ID_PROYECTO){
		$this->db->select('T_DETALLE_FORMATO.ID_DETALLE_OFICIO,T_DETALLE_FORMATO.ID_PROYECTO,T_DETALLE_FORMATO.DESCRIP_OFICIO,T_DETALLE_FORMATO.FEC_OFICIO_REG,T_DETALLE_FORMATO.VOLANTE,T_DETALLE_FORMATO.ID_FORMATO,T_DETALLE_FORMATO.DOCUMENTO, C_TIPOS_OFICIOS.DESCRIP_OFICIO AS NAME_TIPOS_OFICIOS,C_TIPOS_OFICIOS.ID_TIPO_OFICIO,C_FORMATOS_RECIBIDOS.FORMATOS_RECIBIDOS,C_FORMATOS_RECIBIDOS.ID_FORMATO,DATE_FORMAT(T_DETALLE_FORMATO.FEC_OFICIO_REG,"%d/%m/%Y") AS FEC_OFICIO_REG');
		$this->db->from('T_DETALLE_FORMATO');
		$this->db->join('C_FORMATOS_RECIBIDOS', 'C_FORMATOS_RECIBIDOS.ID_FORMATO = T_DETALLE_FORMATO.ID_FORMATO AND C_FORMATOS_RECIBIDOS.ESTATUS = 1', 'inner');

		$this->db->join('R_FORMATO_OFICIO_PROYECTO', 'R_FORMATO_OFICIO_PROYECTO.ID_FORMATO = C_FORMATOS_RECIBIDOS.ID_FORMATO', 'inner');
		$this->db->join('C_TIPO_PROYECTO', 'C_TIPO_PROYECTO.ID_TIPO_PROYECTO = R_FORMATO_OFICIO_PROYECTO.ID_TIPO_PROYECTO', 'inner');
		$this->db->join('C_TIPOS_OFICIOS', 'C_TIPOS_OFICIOS.ID_TIPO_OFICIO = R_FORMATO_OFICIO_PROYECTO.ID_TIPO_OFICIO', 'inner');
		$this->db->where('T_DETALLE_FORMATO.ID_PROYECTO', $ID_PROYECTO); 
		$this->db->where('T_DETALLE_FORMATO.ESTATUS', 1); 
		$this->db->group_by('T_DETALLE_FORMATO.ID_DETALLE_OFICIO');
		$this->db->order_by("C_TIPOS_OFICIOS.ID_TIPO_OFICIO", "ASC");
		$this->db->order_by("C_FORMATOS_RECIBIDOS.ID_FORMATO", "ASC");
		$res = $this->db->get()->result_array();
		return $res;
	}


	function getActividades($ID_PROYECTO){
		$this->db->select('T_DETALLE_ACTIVIDAD.*,C_ACTIVIDADES.ACTIVIDAD_PROYECTO,DATE_FORMAT(T_DETALLE_ACTIVIDAD.FEC_INI_PLANEADA,"%d/%m/%Y") AS FEC_INI_PLANEADA,DATE_FORMAT(T_DETALLE_ACTIVIDAD.FEC_FIN_PLANEADA,"%d/%m/%Y") AS FEC_FIN_PLANEADA,DATE_FORMAT(T_DETALLE_ACTIVIDAD.FEC_INI_REAL,"%d/%m/%Y") AS FEC_INI_REAL,DATE_FORMAT(T_DETALLE_ACTIVIDAD.FEC_FIN_REAL,"%d/%m/%Y") AS FEC_FIN_REAL');
		$this->db->from('T_DETALLE_ACTIVIDAD');
		$this->db->join('C_ACTIVIDADES', 'C_ACTIVIDADES.ID_ACTIVIDAD = T_DETALLE_ACTIVIDAD.ID_ACTIVIDAD AND C_ACTIVIDADES.ESTATUS = 1', 'inner');
		$this->db->where('ID_PROYECTO', $ID_PROYECTO); 
		$this->db->where('T_DETALLE_ACTIVIDAD.ESTATUS', 1); 
		$this->db->order_by("C_ACTIVIDADES.ID_ACTIVIDAD", "ASC");
		return $this->db->get()->result_array();
	}


	function geTipoActividades($ID_TIPO_PROYECTO){
		$this->db->select('ID_ACTIVIDAD AS ID,ACTIVIDAD_PROYECTO AS NAME');
		$this->db->from('C_ACTIVIDADES');
		$this->db->where('ID_TIPO_PROYECTO', $ID_TIPO_PROYECTO); 
		$this->db->where('ESTATUS', 1); 
		return $this->db->get()->result_array();
	}

	function generaFolio($year){
		$this->db->select('MAX(FOLIO_PROYECTO) AS FOLIO_PROYECTO');
		$this->db->from('T_CARTERA_EJECUTIVA_PROYECTOS');
		$this->db->where('ANIO', $year); 
		return $this->db->get()->row('FOLIO_PROYECTO') + 1;
	}

	function getUrSec($ID_UR){
		$this->db->select('*');
		$this->db->from('C_UR_SECUNDARIAS');
		$this->db->where('ID_UR', $ID_UR); 
		$this->db->where('ESTATUS', 1); 
		return $this->db->get()->result_array();
	}

	function getCarteraInfo($ID_PROYECTO){

		$this->db->select('T_CARTERA_EJECUTIVA_PROYECTOS.*,DATE_FORMAT(FEC_REGISTRO,"%d/%m/%Y") AS FEC_REGISTRO,DATE_FORMAT(FEC_LINEA_BASE_INICIO,"%d/%m/%Y") AS FEC_LINEA_BASE_INICIO,DATE_FORMAT(FEC_LINEA_BASE_FIN,"%d/%m/%Y") AS FEC_LINEA_BASE_FIN');
		$this->db->from('T_CARTERA_EJECUTIVA_PROYECTOS');
		$this->db->where('ID_PROYECTO', $ID_PROYECTO); 
		return $this->db->get()->result_array();
	}

	function getExisteElementoCatalogo($tbl,$id,$name,$value){
		$this->db->select($id);
		$this->db->from($tbl);
		$this->db->where($name, $value); 
		$this->db->where('ESTATUS', 1); 
		return $this->db->get()->row($id);
	}

	function getExisteElementoCatalogoSec($tbl,$id,$idSec,$name,$value,$valueSec,$valueName){
		$this->db->select($id);
		$this->db->from($tbl);
		$this->db->where($name, $valueName);
		$this->db->where($idSec, $valueSec); 
		$this->db->where('ESTATUS', 1); 
		return $this->db->get()->row($id);
	}

	function getExisteIdCatalogo($tbl,$id,$value){
		$this->db->select($id);
		$this->db->from($tbl);
		$this->db->where($id, $value); 
		$this->db->where('ESTATUS', 1); 
		return $this->db->get()->row($id);
	}

	function getExisteIdCatalogoSec($tbl,$id,$idSec,$value,$valueSec){
		$this->db->select($id);
		$this->db->from($tbl);
		$this->db->where($id, $value); 
		$this->db->where($idSec, $valueSec); 
		$this->db->where('ESTATUS', 1); 
		return $this->db->get()->row($id);
	}

	function getDataCatalogo($tbl,$id,$name){
		$this->db->select("$id AS ID,$name AS NAME");
		$this->db->from($tbl);
		return $this->db->get()->result_array();
	}


	function getTableName($id){
		$this->db->select('NOMBRE_CATALOGO');
		$this->db->from('T_CATALOGOS');
		$this->db->where('ID_CATALOGO', $id); 
		$this->db->where('ESTATUS', 1); 
		return $this->db->get()->row('NOMBRE_CATALOGO');
	}

	function getDemandantes($did){
		$this->db->select('ID_DEMANDANTE,NOMBRE_DEMANDANTE,C_UR_ADSCRIPCION_TRABAJADOR.AREA_ADSCRIPCION,CENTRO_TRABAJO,PUESTO,C_CATEGORIA.CATEGORIA');
		$this->db->from('T_DEMANDANTES');
		
		$this->db->join('C_UR_ADSCRIPCION_TRABAJADOR', 'T_DEMANDANTES.ID_UR_ADSCRIP_TRAB = C_UR_ADSCRIPCION_TRABAJADOR.ID_UR_ADSCRIP_TRAB', 'left');
		$this->db->join('C_CATEGORIA', 'T_DEMANDANTES.ID_CATEGORIA = C_CATEGORIA.ID_CATEGORIA', 'left');


		$this->db->where('ID_DEMANDA', $did); 
		$this->db->where('T_DEMANDANTES.ESTATUS', 1); 
		return $this->db->get()->result_array();
	}

	function getSequenceName($id){
		$this->db->select('SEQ');
		$this->db->from('T_CATALOGOS');
		$this->db->where('ID_CATALOGO', $id); 
		$this->db->where('ESTATUS', 1); 
		return $this->db->get()->row('SEQ');
	}

	function getSequenceTable($tbl){
		$this->db->select('SECUENCIA');
		$this->db->from('PLN_SECUENCIAS');
		$this->db->where('TABLA', $tbl); 
		$this->db->where('STATUS', 1); 
		return $this->db->get()->row('SECUENCIA');
	}

	function getCatFromTbl($tbl,$field,$noprefix = true){

		if($noprefix){$this->db->dbprefix = '';}
		$notin = array('X','x','bi','NULL','null');
		$this->db->select($field);
		$this->db->from($tbl);
		$this->db->where_not_in($field, $notin);
		$this->db->group_by(array($field));
		$this->db->order_by($field,'ASC');
		$res = $this->db->get();
		if($noprefix){$this->db->dbprefix = 'PLN_';}
		return $res->result_array();  	
	}

	function getSimpleCbo($table){
		$this->db->select('ID,NAME');
		$this->db->from($table);
		$this->db->where('STATUS', 1); 
		$this->db->order_by('ID','ASC');
		$res = $this->db->get();
		return $res->result_array();  
	}

	function getIdField($val){


		$this->db->select('NOMBRE_ID');
		$this->db->from('T_CATALOGOS');
		if(is_int($val)){
			$this->db->where('ID_CATALOGO', $val); 
		}else{
			$this->db->where('NOMBRE_CATALOGO', $val); 
		}
		$this->db->where('ESTATUS', 1); 
		return $this->db->get()->row('NOMBRE_ID');
	}

	function getNameField($val){
		$this->db->select('NOMBRE_NAME');
		$this->db->from('T_CATALOGOS');
		if(is_int($val)){
			$this->db->where('ID_CATALOGO', $val); 
		}else{
			$this->db->where('NOMBRE_CATALOGO', $val); 
		}
		$this->db->where('ESTATUS', 1); 
		return $this->db->get()->row('NOMBRE_NAME');
	}

	function getDataCbo($table){
		$id = $this->getIdField($table);
		$name = $this->getNameField($table);
		$this->db->select("$id AS ID, $name AS NAME");
		$this->db->from($table);
		$this->db->where('ESTATUS', 1); 
		$this->db->order_by($id,'ASC');
		$res = $this->db->get();
		return $res->result_array();  
	}

	function getAnios(){
		//$this->db->dbprefix = '';
		$this->db->select('ANIO');
		$this->db->from('T_CARTERA_EJECUTIVA_PROYECTOS');
		$this->db->where('ANIO >', 0); 
		$this->db->group_by(array('ANIO'));
		$this->db->order_by('ANIO','DESC');
		$res = $this->db->get();
		//$this->db->dbprefix = 'PLN_';
		return $res->result_array();  
	}




	function buscarFolios($folio,$nombre,$anio,$ur,$fp,$oficio,$pluri){
		$this->db->select('T_CARTERA_EJECUTIVA_PROYECTOS.*,C_FASES_PROYECTO.FASE_PROYECTO,CONCAT(C_UNIDADES_RESPONSABLES.ID_UR, " - ", C_UNIDADES_RESPONSABLES.UNIDAD_RESPONSABLE) AS UR');
		$this->db->from('T_CARTERA_EJECUTIVA_PROYECTOS');
		$this->db->join('C_FASES_PROYECTO', 'C_FASES_PROYECTO.ID_FASE_PROYECTO = T_CARTERA_EJECUTIVA_PROYECTOS.ID_FASE_PROYECTO AND C_FASES_PROYECTO.ESTATUS = 1', 'inner');
		$this->db->join('T_DETALLE_FORMATO','T_DETALLE_FORMATO.ID_PROYECTO = T_CARTERA_EJECUTIVA_PROYECTOS.ID_PROYECTO','LEFT');

		$this->db->join('C_UNIDADES_RESPONSABLES','C_UNIDADES_RESPONSABLES.ID_UR = T_CARTERA_EJECUTIVA_PROYECTOS.ID_UR','LEFT');


		if(intval($folio) > 0){
			$this->db->where('FOLIO_PROYECTO', $folio); 
		}
		if(count($anio) > 0){
			$this->db->where_in('ANIO', $anio );
		}

		if(count($ur) > 0){
			$this->db->where_in('C_UNIDADES_RESPONSABLES.ID_UR', $ur); 
		}

		if(count($fp) > 0){
			$this->db->where_in('T_CARTERA_EJECUTIVA_PROYECTOS.ID_FASE_PROYECTO', $fp); 
		}

		if(strlen($nombre) > 0){
			$this->db->like('NOMBRE_PROYECTO',$nombre);
		}

		if(strlen($oficio) > 0){
			$this->db->like('T_DETALLE_FORMATO.DESCRIP_OFICIO',$oficio);
		}

		if(strlen($pluri) == 2){
			$this->db->like('T_CARTERA_EJECUTIVA_PROYECTOS.PLURIANUALIDAD',$pluri);
		}

		$this->db->group_by('T_CARTERA_EJECUTIVA_PROYECTOS.ID_PROYECTO');
		$res = $this->db->get();
		return $res->result_array();  
	}


	function getInfo($nom,$anio){
		$this->db->dbprefix = '';
		$this->db->select('*');
		$this->db->from('T_DATOS_DEMANDA');
		if(intval($anio) > 0){
			$this->db->where('ANIO', intval($anio)); 
		}
		if(count($nom) > 0 && strlen($nom[0]) > 0){
			$string = getStringLike($nom,'NOM_DEMANDANTE');
			$this->db->where($string);
		}
		$this->db->limit(1000, 0);
		$res = $this->db->get();
		$this->db->dbprefix = 'PLN_';
		return $res->result_array();  
	}

function getInfoNew($_get){
		$nom = explode(' ',$_get['nombre']);
		$anio = $_get['anio'];
		unset($_get['nombre']);
		unset($_get['anio']);

		$campos = "
			T_DATOS_DEMANDA.ID_DEMANDA
			,T_DATOS_DEMANDA.TIPO_ARCHIVO
			,T_DATOS_DEMANDA.DEPARTAMENTO
			,T_DATOS_DEMANDA.REGISTRO_SID_EL_A
			,T_DATOS_DEMANDA.OBSERVACIONES
			,T_DATOS_DEMANDA.ABOGADO_RESP
			,T_DATOS_DEMANDA.EXPEDIENTE
			,T_DATOS_DEMANDA.ANIO
			,T_DATOS_DEMANDA.ENT_PAGADORA
			,T_DATOS_DEMANDA.AUT_CONOCE_JUICIO
			,T_DATOS_DEMANDA.SAL_MEN_RECLAMADO
			,T_DATOS_DEMANDA.CIRCUNS_ORIG_JUICIO
			,T_DATOS_DEMANDA.JURISDICCION
			,T_DATOS_DEMANDA.DICTAMEN
			,T_DATOS_DEMANDA.FEC_RECEP_LAUDO
			,T_DATOS_DEMANDA.FEC_LAUDO_FIRME
			,T_DATOS_DEMANDA.CONDENA_NO_ECO
			,T_DATOS_DEMANDA.EDO_COND_NO_ECO
			,T_DATOS_DEMANDA.CONDENA_ECO
			,T_DATOS_DEMANDA.EDO_COND_ECO
			,T_DATOS_DEMANDA.RIESGO_ECO
			,T_DATOS_DEMANDA.OBSERVA_RIESGO_ECO
			,T_DATOS_DEMANDA.ID_RIESGO_ECO
			,T_DATOS_DEMANDA.CONDENA_LAUDO
			,C_CAUSA_CONCLUSION.CAUSA_CONCLUSION AS ID_CAUSA_CONCLUSION
			,C_APERCIBIMIENTO.APERCIBIMIENTO AS ID_APERCIBIMIENTO
			,T_DATOS_DEMANDA.FECHA_CONCLUSION
			,T_DATOS_DEMANDA.ESTATUS
			,T_DATOS_DEMANDA.ID_ESTATUS_PROCESAL
			,T_DATOS_DEMANDA.DOCUMENTO
			,T_DATOS_DEMANDA.ACTIVO
			,T_DATOS_DEMANDA.FEC_ULT_ACTUALIZACION
			,T_DEMANDANTES.NOMBRE_DEMANDANTE
			,T_DEMANDANTES.CENTRO_TRABAJO
			,T_DEMANDANTES.PUESTO
			,C_UR_ADSCRIPCION_TRABAJADOR.AREA_ADSCRIPCION AS ID_UR_ADSCRIP_TRAB
			,C_CATEGORIA.CATEGORIA AS ID_CATEGORIA
			,C_ACCION_LABORAL.ACCION_LABORAL AS ID_ACCION_LABORAL
		";

		$this->db->select($campos);
		$this->db->from('T_DATOS_DEMANDA');
		$this->db->join('T_DEMANDANTES', 'T_DEMANDANTES.ID_DEMANDA = T_DATOS_DEMANDA.ID_DEMANDA AND T_DEMANDANTES.ESTATUS = 1', 'inner');
		$this->db->join('C_ACCION_LABORAL', 'T_DATOS_DEMANDA.ID_ACCION_LABORAL = C_ACCION_LABORAL.ID_ACCION_LABORAL AND C_ACCION_LABORAL.ESTATUS = 1', 'inner');

		$this->db->join('C_CAUSA_CONCLUSION', 'T_DATOS_DEMANDA.ID_CAUSA_CONCLUSION = C_CAUSA_CONCLUSION.ID_CAUSA_CONCLUSION AND C_CAUSA_CONCLUSION.ESTATUS = 1', 'inner');


		$this->db->join('C_APERCIBIMIENTO', 'T_DATOS_DEMANDA.ID_APERCIBIMIENTO = C_APERCIBIMIENTO.ID_APERCIBIMIENTO AND C_APERCIBIMIENTO.ESTATUS = 1', 'inner');


		$this->db->join('C_CATEGORIA', 'T_DEMANDANTES.ID_CATEGORIA = C_CATEGORIA.ID_CATEGORIA AND C_CATEGORIA.ESTATUS = 1', 'inner');
		$this->db->join('C_UR_ADSCRIPCION_TRABAJADOR', 'T_DEMANDANTES.ID_UR_ADSCRIP_TRAB = C_UR_ADSCRIPCION_TRABAJADOR.ID_UR_ADSCRIP_TRAB AND C_UR_ADSCRIPCION_TRABAJADOR.ESTATUS = 1', 'inner');
		if(intval($anio) > 0){
			$this->db->where('ANIO', intval($anio)); 
		}
		if(count($nom) > 0 && strlen($nom[0]) > 0){
			$string = getStringLike($nom,'NOMBRE_DEMANDANTE');
			$this->db->where($string);
		}
		// Otros Filtros
		
		foreach ($_get as $key => $value) {
			for ($a=0; $a < count($this->aOF); $a++) { 
				if($key == $this->aOF[$a]['f'] && $value > 0){
					$this->db->where($this->aOF[$a]['t'] . '.' . $key, $value); 
				}
			}
		}

		$this->db->limit(1000, 0);
		$res = $this->db->get();
		return $res->result_array();  
	}


}