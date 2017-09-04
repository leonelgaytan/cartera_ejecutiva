<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Catalogos Model
* Author:  Ivan Espinoza
* 		   ing.ezpinoza@gmail.com
* Created:  09.09.2016
* Description:  Modelo para acceso de datos del modulo de catalogos.
*/

class Catalogos_model extends MY_Model
{

	function getCatalogos(){
		$this->db->select('ID_CATALOGO AS ID,NOMBRE_CATALOGO AS NAME,DESCRIPTION');
		$this->db->from('T_CATALOGOS');
		$this->db->where('ESTATUS', 1); 
		$res = $this->db->get();
		return $res->result_array();  
	}



	function getItems($tbl){
		if(is_int($tbl)){
			$tbl = $this->getTableName($tbl);
		}

		if(strlen($tbl) > 0){
			$id = getPropCat($tbl,'id');
			$name = getPropCat($tbl,'name');
			$this->db->select("*,$id AS ID,$name AS NAME");
			$this->db->from($tbl);
			$this->db->where('ESTATUS', 1); 
			$this->db->order_by($id, 'ASC'); 
			$res = $this->db->get();
			return $res->result_array();  
		}else{
			return array();
		}

	}

	function getItemsUR($tbl,$value){
		if(is_int($tbl)){
			$tbl = $this->getTableName($tbl);
		}

		if(strlen($tbl) > 0){
			$id = getPropCat($tbl,'id');
			$name = getPropCat($tbl,'name');
			$this->db->select("*,$id AS ID,$name AS NAME");
			$this->db->from('C_UR_SECUNDARIAS');
			$this->db->where('ID_UR', $value); 
			$this->db->where('ESTATUS', 1); 
			$this->db->order_by($id, 'ASC'); 
			$res = $this->db->get();
			return $res->result_array();  
		}else{
			return array();
		}

	}

	function getId($tbl){
		if(is_int($tbl)){
			$tbl = $this->getTableName($tbl);
		}

		if(strlen($tbl) > 0){
			$id = getPropCat($tbl,'id');
			$this->db->select("MAX($id) AS ID");
			$this->db->from($tbl);
			$res = $this->db->get();
			return $res->row('ID');  
		}else{
			return array();
		}

	}

	function getIdUr($tbl,$value){
		if(is_int($tbl)){
			$tbl = $this->getTableName($tbl);
		}

		if(strlen($tbl) > 0){
			$id = getPropCat($tbl,'id');
			$this->db->select("MAX($id) AS ID");
			$this->db->from($tbl);
			$this->db->where('ID_UR', $value); 
			$res = $this->db->get();
			return $res->row('ID');  
		}else{
			return array();
		}

	}


}