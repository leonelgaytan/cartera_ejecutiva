<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$config['docsPath'] = 'D:/Documentos/cartera_ejecutiva/';
$config['tablas'] = array(
		array(
			'cat'	=>	1,
			'tbl'	=>	'C_ACTIVIDADES',
			'id'	=>	'ID_ACTIVIDAD',
			'name'	=>	'ACTIVIDAD_PROYECTO',
			'label'	=>	'ACTIVIDADES',
			'seq'	=>	''
			),
		array(
			'cat'	=>	1,
			'tbl'	=>	'C_TIPO_PROYECTO',
			'id'	=>	'ID_TIPO_PROYECTO',
			'name'	=>	'TIPO_PROYECTO',
			'label'	=>	'TIPOS DE PROYECTOS',
			'seq'	=>	''
			),

		array(
			'cat'	=>	1,
			'tbl'	=>	'C_CATEGORIAS',
			'id'	=>	'ID_CATEGORIA',
			'name'	=>	'CATEGORIA',
			'label'	=>	'CATEGORÍAS',
			'seq'	=>	''
			),
		array(
			'cat'	=>	1,
			'tbl'	=>	'C_DOMINIOS_TECNOLOGICOS',
			'id'	=>	'ID_DOMINIO_TEC',
			'name'	=>	'DOMINIO_TECNOLOGICO',
			'label'	=>	'DOMINIO TECNOLÓGICO',
			'seq'	=>	''
			),
		array(
			'cat'	=>	1,
			'tbl'	=>	'C_EDN',
			'id'	=>	'ID_EDN',
			'name'	=>	'OBJETIVOS_SEC_EDN',
			'label'	=>	'OBJETIVOS EDN',
			'seq'	=>	''
			),
		array(
			'cat'	=>	1,
			'tbl'	=>	'C_FASES_PROYECTO',
			'id'	=>	'ID_FASE_PROYECTO',
			'name'	=>	'FASE_PROYECTO',
			'label'	=>	'FASES DE PROYECTOS',
			'seq'	=>	''
			),
		array(
			'cat'	=>	1,
			'tbl'	=>	'C_FORMATOS_RECIBIDOS',
			'id'	=>	'ID_FORMATO',
			'name'	=>	'FORMATOS_RECIBIDOS',
			'label'	=>	'FORMATOS RECIBIDOS',
			'seq'	=>	''
			),
		array(
			'cat'	=>	1,
			'tbl'	=>	'C_PGCM',
			'id'	=>	'ID_PGCM',
			'name'	=>	'DESCRIPCION_PGCM',
			'label'	=>	'DESCRIPCIÓN PGCM',
			'seq'	=>	''
			),
		array(
			'cat'	=>	1,
			'tbl'	=>	'C_PND',
			'id'	=>	'ID_PND',
			'name'	=>	'OBJETIVO_PND',
			'label'	=>	'OBJETIVOS PND',
			'seq'	=>	''
			),
		array(
			'cat'	=>	1,
			'tbl'	=>	'C_RIESGOS',
			'id'	=>	'ID_RIEGO_PROYECTO',
			'name'	=>	'RIESGO_PROYECTO',
			'label'	=>	'RIESGO PROYECTOS',
			'seq'	=>	''
			),

		array(
			'cat'	=>	1,
			'tbl'	=>	'C_TITULOS',
			'id'	=>	'ID_TITULO',
			'name'	=>	'DESC_TITULO',
			'label'	=>	'TÍTULOS',
			'seq'	=>	''),


		array(
			'cat'	=>	1,
			'tbl'	=>	'C_UNIDADES_RESPONSABLES',
			'id'	=>	'ID_UR',
			'name'	=>	'UNIDAD_RESPONSABLE',
			'label'	=>	'UNIDADES RESPONSABLES',
			'seq'	=>	''
			),
		array(
			'cat'		=>	1,
			'tbl'		=>	'C_UR_SECUNDARIAS',
			'id'		=>	'ID_UR_SEC',
			'name'		=>	'DESCRIPCION_UR_SEC',
			'label'		=>	'UR_SECUNDARIAS',
			'id_sec'	=>	'ID_UR',
			'seq'		=>	''
			),
		array(
			'cat'		=>	1,
			'tbl'		=>	'C_TIPOS_OFICIOS',
			'id'		=>	'ID_TIPO_OFICIO',
			'name'		=>	'DESCRIP_OFICIO',
			'label'		=>	'TIPOS DE OFICIOS',
			'seq'		=>	''
			),
		array(
			'cat'	=>	0,
			'tbl'	=>	'T_DETALLE_ACTIVIDAD',
			'id'	=>	'ID_DETALLE_ACTIVIDAD',
			'name'	=>	'ID_PROYECTO',
			'label'	=>	'DETALLE ACTIVIDAD',
			'seq'	=>	''
			),
		array(
			'cat'	=>	0,
			'tbl'	=>	'T_DETALLE_FORMATO',
			'id'	=>	'ID_DETALLE_OFICIO',
			'name'	=>	'ID_PROYECTO',
			'label'	=>	'DETALLE FORMATO',
			'seq'	=>	''
			),
		array(
			'cat'	=>	0,
			'tbl'	=>	'T_USUARIOS',
			'id'	=>	'ID_USUARIO',
			'name'	=>	'NOMBRE_USUARIO',
			'label'	=>	'USUARIOS',
			'seq'	=>	''
			),
		array(
			'cat'	=>	0,
			'tbl'	=>	'T_GRUPOS',
			'id'	=>	'ID_GRUPO',
			'name'	=>	'NOMBRE_GRUPO',
			'label'	=>	'GRUPOS',
			'seq'	=>	''
			),
		array(
			'cat'	=>	0,
			'tbl'	=>	'T_USUARIO_GRUPOS',
			'id'	=>	'ID_USUARIO_GRUPOS',
			'name'	=>	'',
			'label'	=>	'USUARIO - GRUPOS',
			'seq'	=>	''
			)
	);

