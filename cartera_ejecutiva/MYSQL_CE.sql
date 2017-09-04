/*
Navicat MySQL Data Transfer

Source Server         : MySQLLocal
Source Server Version : 50536
Source Host           : localhost:3306
Source Database       : cartera_ejecutiva

Target Server Type    : MYSQL
Target Server Version : 50536
File Encoding         : 65001

Date: 2017-01-11 15:06:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for c_categorias
-- ----------------------------
DROP TABLE IF EXISTS `c_categorias`;
CREATE TABLE `c_categorias` (
`ID_CATEGORIA`  decimal(1,0) NULL DEFAULT NULL ,
`CATEGORIA`  varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`ESTATUS`  decimal(1,0) NOT NULL 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci

;

-- ----------------------------
-- Records of c_categorias
-- ----------------------------
BEGIN;
INSERT INTO `c_categorias` VALUES ('1', 'OPTIMIZACION', '1'), ('2', 'DIGITALIZACION', '1'), ('3', 'SIMPLIFICACION', '1'), ('4', 'RACIONALIZACION', '1');
COMMIT;

-- ----------------------------
-- Table structure for c_dominios_tecnologicos
-- ----------------------------
DROP TABLE IF EXISTS `c_dominios_tecnologicos`;
CREATE TABLE `c_dominios_tecnologicos` (
`ID_DOMINIO_TEC`  decimal(1,0) NOT NULL ,
`DOMINIO_TENOLOGICO`  longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`ESTATUS`  decimal(1,0) NOT NULL 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci

;

-- ----------------------------
-- Records of c_dominios_tecnologicos
-- ----------------------------
BEGIN;
INSERT INTO `c_dominios_tecnologicos` VALUES ('1', 'SEGURIDAD', '1'), ('2', 'COMPUTO CENTRAL Y DISTRIBUIDO', '1'), ('3', 'COMPUTO USUARIO FINAL', '1'), ('4', 'COMUNICACIONES', '1'), ('5', 'COLABORACION Y CORREO ELECTRONICO', '1'), ('6', 'INTERNET/INTRANET', '1'), ('7', 'APLICATIVOS', '1'), ('8', 'BASE DE DATOS Y DATAWAREHOUSING', '1'), ('9', 'SISTEMAS DE CONTROL INDUSTRIALES', '1');
COMMIT;

-- ----------------------------
-- Table structure for c_edn
-- ----------------------------
DROP TABLE IF EXISTS `c_edn`;
CREATE TABLE `c_edn` (
`ID_EDN`  decimal(2,0) NOT NULL ,
`OBJETIVOS_SEC_EDN`  longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`ESTATUS`  decimal(1,0) NOT NULL 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci

;

-- ----------------------------
-- Records of c_edn
-- ----------------------------
BEGIN;
INSERT INTO `c_edn` VALUES ('1', 'Generar y coordinar acciones orientadas hacia el logro de un gobierno abierto.', '1'), ('2', 'Instrumentar la Ventanilla Única Nacional para trámites y servicios.', '1'), ('3', 'Coordinar una política digital de gestión en el territorio nacional.', '1'), ('4', 'Implementar una Política de TIC sustentable para la Administración Pública Federal.', '1'), ('5', 'Adoptar una comunicación digital centrada en el ciudadano.', '1'), ('6', 'Desarrollar el mercado de bienes y servicios digitales.', '1'), ('7', 'Potenciar el desarrollo del comercio electrónico.', '1'), ('8', 'Generar nuevos mecanismos de contratación que fomenten la innovación y el emprendimiento a través de la democratización del gasto público.', '1'), ('9', 'Promover la inclusión financiera mediante esquemas de banca móvil.', '1'), ('10', 'Desarrollar una política nacional de adopción y uso de las TIC en el proceso de enseñanza-aprendizaje en el Sistema Educativo Nacional.', '1'), ('11', 'Ampliar la oferta educativa a través de medios digitales.', '1'), ('12', 'Mejorar la gestión educativa mediante el uso de las TIC.', '1'), ('13', 'Desarrollar una agenda digital de cultura.', '1'), ('14', 'Impulsar un modelo de gobierno de información en salud que apoye la convergencia de los sistemas de información en salud.', '1'), ('15', 'Consolidar el Sistema Nacional de Información Básica en Materia de Salud con la finalidad de establecer la personalidad única en salud y fomente el uso eficiente de la capacidad instalada.', '1'), ('16', 'Impulsar la Digitalización de los Servicios de Salud por medio del Certificado Electrónico de Nacimiento (CeN) y la Cartilla Electrónica de Vacunación (CeV) que apoye la mejora del modelo de atención médica.', '1'), ('17', 'Impulsar el intercambio de información de los Sistemas de Información de Registro Electrónico para la Salud, entre los que se encuentran los Expedientes Clínicos Electrónicos, para apoyar la convergencia de los sistemas de información en salud.', '1'), ('18', 'Impulsar mecanismo de Telesalud y Telemedicina para aumentar la cobertura de los servicios de salud.', '1'), ('19', 'Impulsar la innovación cívica para resolver problemas de interés público por medio de las TIC.', '1'), ('20', 'Usar datos para el desarrollo y el mejoramiento de políticas públicas.', '1'), ('21', 'Generar herramientas y aplicaciones de denuncia ciudadana en múltiples plataformas.', '1'), ('22', 'Desarrollar instrumentos digitales para la prevención social de la violencia que involucren la participación ciudadana.', '1'), ('23', 'Prevenir y mitigar los daños causados por desastres naturales mediante el uso de las TIC instrumentos digitales para la prevención social de la violencia que involucren la participación ciudadana.', '1'), ('24', 'Habilitadores de Inclusión de Habilidades Digitales.', '1'), ('25', 'Habilitadores de interoperabilidad.', '1'), ('26', 'Habilitadores de Marco Jurídico.', '1'), ('27', 'Habilitadores de Datos Abiertos.', '1'), ('28', 'Habilitador de Conectividad', '1'), ('29', 'No alineado', '1');
COMMIT;

-- ----------------------------
-- Table structure for c_fases_proyecto
-- ----------------------------
DROP TABLE IF EXISTS `c_fases_proyecto`;
CREATE TABLE `c_fases_proyecto` (
`ID_FASE_PROYECTO`  decimal(1,0) NOT NULL ,
`FASE_PROYECTO`  longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`ESTATUS`  decimal(1,0) NOT NULL 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci

;

-- ----------------------------
-- Records of c_fases_proyecto
-- ----------------------------
BEGIN;
INSERT INTO `c_fases_proyecto` VALUES ('1', 'ANTEPROYECTO', '1'), ('2', 'DEFINICION', '1'), ('3', 'PLANEACION', '1'), ('4', 'EJECUCION', '1'), ('5', 'CIERRE', '1'), ('6', 'COMPLETADO', '1'), ('7', 'CONGELADO', '1'), ('8', 'CANCELADO', '1');
COMMIT;

-- ----------------------------
-- Table structure for c_formatos_recibidos
-- ----------------------------
DROP TABLE IF EXISTS `c_formatos_recibidos`;
CREATE TABLE `c_formatos_recibidos` (
`ID_FORMATO`  decimal(2,0) NOT NULL ,
`FORMATOS_RECIBIDOS`  longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`ESTATUS`  decimal(1,0) NOT NULL 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci

;

-- ----------------------------
-- Records of c_formatos_recibidos
-- ----------------------------
BEGIN;
INSERT INTO `c_formatos_recibidos` VALUES ('1', 'DGTIC-PE-01 PETIC', '1'), ('2', 'DGTIC-PE-04-ALINEACION DEL PROYECTO', '1'), ('3', 'ADP-F1 ACTA CONSTITUCION DEL PROECTO', '1'), ('4', 'ADP-F2 ACTA DE ACEPTACION DE ENTREGABLES', '1'), ('5', 'ADP-F3 ACTA DE ACEPTACION DE ENTREGABLES', '1'), ('6', 'P-23-E REPORTE DE AVANCE', '1'), ('7', 'DGTIC-AOP-01 APLICATIVOS MOVILES', '1'), ('8', 'DGTIC-AOP-02 BASE DE DATOS', '1'), ('9', 'DGTIC-AOP-03 CENTRO DE DATOS', '1'), ('10', 'DGTIC-AOP-04 HARDWARE', '1'), ('11', 'DGTIC-AOP-05 SISTEMAS Y SERVICIOS', '1'), ('12', 'DGTIC-AOP-06 SOFTWARE', '1'), ('13', 'OFICIO DE CANCELACION', '1');
COMMIT;

-- ----------------------------
-- Table structure for c_pgcm
-- ----------------------------
DROP TABLE IF EXISTS `c_pgcm`;
CREATE TABLE `c_pgcm` (
`ID_PGCM`  decimal(2,1) NOT NULL ,
`DESCRIPCION_PGCM`  longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`ESTATUS`  decimal(1,0) NOT NULL 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci

;

-- ----------------------------
-- Records of c_pgcm
-- ----------------------------
BEGIN;
INSERT INTO `c_pgcm` VALUES ('1.1', 'Fomentar la participación ciudadana en las políticas públicas y en la prevención de la corrupción.', '1'), ('1.2', 'Promover una cultura de legalidad que aumente la confianza de los mexicanos en el gobierno y prevenga  la corrupción.', '1'), ('1.3', 'Garantizar el acceso a la información y la protección de los datos personales en la APF.', '1'), ('1.4', 'Mejorar la transparencia de la información socialmente útil de la APF.', '1'), ('1.5', 'Fortalecer el uso de la información presupuestaria.', '1'), ('1.6', 'Fomentar la participación ciudadana a través de la innovación en el uso de las TIC y los datos abiertos', '1'), ('1.7', 'Consolidar los sistemas institucionales de archivo y administración de documentos', '1'), ('2.1', 'Impulsar una planeación nacional basada en resultados', '1'), ('2.2', 'Vincular el SED con las asignaciones presupuestarias.', '1'), ('2.3', 'Fortalecer el proceso de seguimiento y evaluación al desempeño de la APF.', '1'), ('2.4', 'Mejorar la calidad del gasto federalizado con base en los preceptos del SED.', '1'), ('2.5', 'Garantizar que los programas y proyectos de inversión registrados en la cartera de inversión, sean aquellos con mayor rentabilidad social.', '1'), ('3.1', 'Orientar las estructuras orgánicas y ocupaciones hacia los objetivos estratégicos.', '1'), ('3.2', 'Fortalecer el uso eficiente de los recursos destinados a servicios personales y gasto de operación.', '1'), ('3.3', 'Promover la implementación de estrategias de contratación orientadas a la obtención del máximo valor por la inversión', '1'), ('3.4', 'Promover una administración moderna y transparente del patrimonio inmobiliario federal.', '1'), ('4.1', 'Transformar los procesos de las dependencias y entidades.', '1'), ('4.2', 'Fortalecer la profesionalización de los servicios públicos.', '1'), ('4.3', 'Obtener las mejores condiciones en la contratación de bienes, servicios y obras públicas de la APF.', '1'), ('4.4', 'Fortalecer la planeación y control de los recursos humanos, alineados a los objetivos y metas estratégicas institucionales', '1'), ('4.5', 'Simplificar la regulación que rige a las dependencias y entidades para garantizar la eficiente operación del gobierno.', '1'), ('5.1', 'Propiciar la transformación Gubernamental mediante las tecnologías de información y comunicación', '1'), ('5.2', 'Contribuir a la convergencia de los sistemas a la portabilidad de coberturas en los servicios de salud del Sistema Nacional de Salud mediante la utilización de TIC.', '1'), ('5.3', 'Propiciar la transformación del modelo educativo con herramientas tecnológicas.', '1'), ('5.4', 'Desarrollar la economía digital que impulse el mercado de TIC, el apoyo a actividades productivas y al capital.', '1'), ('5.5', 'Fortalecer la seguridad ciudadana utilizando medios digitales.', '1'), ('5.6', 'Establecer y operar los habilitadores de TIC para la conectividad y asequibilidad, inclusión digital e Interoperabilidad.', '1'), ('5.7', 'Establecer y operar el Marco Jurídico para las TIC.', '1');
COMMIT;

-- ----------------------------
-- Table structure for c_pnd
-- ----------------------------
DROP TABLE IF EXISTS `c_pnd`;
CREATE TABLE `c_pnd` (
`ID_PND`  decimal(1,0) NOT NULL ,
`OBJETIVO_PND`  longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`ESTATUS`  decimal(1,0) NOT NULL 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci

;

-- ----------------------------
-- Records of c_pnd
-- ----------------------------
BEGIN;
INSERT INTO `c_pnd` VALUES ('1', 'MEXICO EN PAZ', '1'), ('2', 'MEXICO INCLUYENTE', '1'), ('3', 'MEXICO CON EDUACION DE CALIDAD', '1'), ('4', 'MEXICO PROSPERO', '1'), ('5', 'MEXICO CON RESPONSABILIDAD GLOBAL', '1');
COMMIT;

-- ----------------------------
-- Table structure for c_riesgos
-- ----------------------------
DROP TABLE IF EXISTS `c_riesgos`;
CREATE TABLE `c_riesgos` (
`ID_RIEGO_PROYECTO`  decimal(1,0) NOT NULL ,
`RIESGO_PROYECTO`  longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
`ESTATUS`  decimal(1,0) NOT NULL 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci

;

-- ----------------------------
-- Records of c_riesgos
-- ----------------------------
BEGIN;
INSERT INTO `c_riesgos` VALUES ('1', 'BAJO', '1'), ('2', 'MEDIO', '1'), ('3', 'ALTO', '1');
COMMIT;

-- ----------------------------
-- Table structure for c_titulos
-- ----------------------------
DROP TABLE IF EXISTS `c_titulos`;
CREATE TABLE `c_titulos` (
`ID_TITULO`  decimal(2,0) NOT NULL ,
`ABREVIATURA`  varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`DESC_TITULO`  longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`ESTATUS`  decimal(1,0) NOT NULL 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci

;

-- ----------------------------
-- Records of c_titulos
-- ----------------------------
BEGIN;
INSERT INTO `c_titulos` VALUES ('1', 'Abgdo.', 'ABOGADO', '1'), ('2', 'Adm.', 'ADMINISTRADOR', '1'), ('3', 'Anl.', 'ANALISTA', '1'), ('4', 'Arq.', 'ARQUITECTO', '1'), ('5', 'Bach.', 'BACHILLER', '1'), ('6', 'C.', 'CIUDADANO', '1'), ('7', 'Coord.', 'COORDINADOR', '1'), ('8', 'CP.', 'CONTADOR PÚBLICO', '1'), ('9', 'Cdor.', 'CONTADOR', '1'), ('10', 'Dir.', 'DIRECTOR', '1'), ('11', 'Dira.', 'DIRECTORA', '1'), ('12', 'Dr.', 'DOCTOR', '1'), ('13', 'Dra.', 'DOCTORA', '1'), ('14', 'Econ.', 'ECONOMISTA', '1'), ('15', 'Ing.', 'INGENIERO', '1'), ('16', 'Lic.', 'LICENCIADO', '1'), ('17', 'Not.', 'NOTARIO', '1'), ('18', 'Prof.', 'PROFESOR', '1'), ('19', 'Profa.', 'PROFESORA', '1'), ('20', 'Mtro.', 'MAESTRO', '1'), ('21', 'Mtra.', 'MAESTRA', '1'), ('22', 'Ing.', 'INGENIERO', '1'), ('23', 'C.P.', 'CONTADOR PUBLICO', '1');
COMMIT;

-- ----------------------------
-- Table structure for c_unidades_responsables
-- ----------------------------
DROP TABLE IF EXISTS `c_unidades_responsables`;
CREATE TABLE `c_unidades_responsables` (
`ID_UR`  varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`UNIDAD_RESPONSABLE`  longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`ESTATUS`  decimal(1,0) NOT NULL 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci

;

-- ----------------------------
-- Records of c_unidades_responsables
-- ----------------------------
BEGIN;
INSERT INTO `c_unidades_responsables` VALUES ('K00', 'UNIVERSIDAD ABIERTA Y A DISTANCIA DE MEXICO', '1'), ('L00', 'COORDINACION NACIONAL DEL SERVICIO PROFESIONAL DOCENTE', '1'), ('M00', 'TECNOLOGICO NACIONAL DE MEXICO', '1'), ('N00', 'COORDINACION GENERAL @PRENDE.MX', '1'), ('100', 'OFICINA DEL C. SECRETARIO DE EDUCACION PUBLICA', '1'), ('110', 'DIRECCION GENERAL DE COMUNICACION SOCIAL', '1'), ('111', 'UNIDAD DE ASUNTOS JURIDICOS', '1'), ('114', 'COORD. GRAL. DE DELEGACIONES FEDERALES DE LA SEP', '1'), ('115', 'COORDINACION GENERAL DE EDUCACION INTERCULTURAL  Y BILINGUE', '1'), ('116', 'ORGANO INTERNO DE CONTROL', '1'), ('117', 'UNIDAD DE SEGUIMIENTO DE COMPROMISOS E INSTRUCCIONES PRESIDE', '1'), ('120', 'JEFATURA DE LA OFICINA DEL SECRETARIO', '1'), ('121', 'DELEGACION FEDERAL DE LA SEP EN EL EDO DE AGUASCALIENTES', '1'), ('122', 'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE BAJA CAL.NORTE', '1'), ('123', 'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE BAJA CAL. SUR', '1'), ('124', 'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE CAMPECHE', '1'), ('125', 'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE COAHUILA', '1'), ('126', 'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE COLIMA', '1'), ('127', 'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE CHIAPAS', '1'), ('128', 'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE CHIHUAHUA', '1'), ('130', 'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE DURANGO', '1'), ('131', 'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE GUANAJUATO', '1'), ('132', 'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE GUERRERO', '1'), ('133', 'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE HIDALGO', '1'), ('134', 'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE JALISCO', '1'), ('135', 'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE MEXICO', '1'), ('136', 'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE MICHOACAN', '1'), ('137', 'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE MORELOS', '1'), ('138', 'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE NAYARIT', '1'), ('139', 'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE NUEVO LEON', '1'), ('140', 'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE OAXACA', '1'), ('141', 'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE PUEBLA', '1'), ('142', 'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE QUERETARO', '1'), ('143', 'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE QUINTANA ROO', '1'), ('144', 'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE SAN LUIS POTOSI', '1'), ('145', 'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE SINALOA', '1'), ('146', 'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE SONORA', '1'), ('147', 'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE TABASCO', '1'), ('148', 'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE TAMAULIPAS', '1'), ('149', 'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE TLAXCALA', '1'), ('150', 'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE VERACRUZ', '1'), ('151', 'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE YUCATAN', '1'), ('152', 'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE ZACATECAS', '1'), ('153', 'COORDINACION DE ORGANOS DESCONCENTRADOS Y DEL SECT. PAR', '1'), ('200', 'SUBSECRETARIA DE PLANEACIÓN, EVALUACIÓN Y COORDINACIÓN', '1'), ('210', 'DIR GRAL DE PLANEACION PROGRAMACION Y ESTADISTICA EDUCATIVA', '1'), ('211', 'DIRECCION GENERAL DE ACREDITACION, INCORPORACION Y REVALIDAC', '1'), ('212', 'DIRECCION GENERAL DE EVALUACION DE POLITICAS', '1'), ('215', 'COORDINACION NACIONAL DE CARRERA MAGISTERIAL', '1'), ('216', 'DIRECCION GENERAL DE TELEVISION EDUCATIVA', '1'), ('217', 'DIRECCION GENERAL DE RELACIONES INTERNACIONALES', '1'), ('218', 'DIRECCIÓN GENERAL DEL SISTEMA DE INFORMACION Y GESTION EDUCATIVA', '1'), ('300', 'SUBSECRETARIA DE EDUCACION BASICA', '1'), ('310', 'DIRECCION GENERAL DE DESARROLLO DE LA GESTION EDUCATIVA', '1'), ('311', 'DIRECCIÓN GENERAL DE MATERIALES EDUCATIVOS', '1'), ('312', 'DIRECCION GENERAL DE DESARROLLO CURRICULAR', '1'), ('313', 'DIRECCION GENERAL DE EDUCACION INDIGENA', '1'), ('314', 'DIR GRAL DE FORMACION CONTINUA ACTUALIZACIÓN Y DESARROLLO P', '1'), ('500', 'SUBSECRETARIA DE EDUCACION SUPERIOR', '1'), ('511', 'DIRECCION GENERAL DE EDUCACION SUPERIOR UNIVERSITARIA', '1'), ('512', 'DIRECCION GENERAL DE PROFESIONES', '1'), ('514', 'COORD, GENERAL DE UNIVERSIDADES TECNOLOGICAS Y POLITECNICAS', '1'), ('515', 'DIRECCION GRAL. DE EDUC.SUPERIOR PARA PROFESIONALES DE LA ED', '1'), ('600', 'SUBSECRETARIA DE EDUCACION MEDIA SUPERIOR', '1'), ('610', 'DIRECCION GENERAL DE EDUCACION TECNOLOGICA AGROPECUARIA', '1'), ('611', 'DIRECCION GENERAL DE EDUCACION TECNOLOGICA INDUSTRIAL', '1'), ('613', 'DIRECCION GENERAL DE CENTROS DE FORMACION PARA EL TRABAJO', '1'), ('615', 'DIRECCION GRAL. DE EDUCACION EN CIENCIA Y TECNOLOGIA DEL MAR', '1'), ('616', 'DIRECCION GENERAL DEL BACHILLERATO', '1'), ('700', 'OFICIALIA MAYOR', '1'), ('710', 'DIRECCIÓN GENERAL DE PRESUPUESTO Y RECURSOS FINANCIEROS', '1'), ('711', 'DIRECCION GENERAL DE PERSONAL', '1'), ('712', 'DIRECCION GENERAL DE RECURSOS MATERIALES Y SERVICIOS', '1'), ('713', 'DIREC GRAL DE TECNOLOGIAS DE LA INFORMACION Y COMUNICACIONES', '1'), ('714', 'DIRECCION GENERAL DE INNOVACION, CALIDAD Y ORGANIZACION', '1'), ('CCA', 'CONACULTA', '1');
COMMIT;

-- ----------------------------
-- Table structure for c_ur_secundarias
-- ----------------------------
DROP TABLE IF EXISTS `c_ur_secundarias`;
CREATE TABLE `c_ur_secundarias` (
`ID_UR`  varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`ID_UR_SEC`  varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`DESCRIPCION_UR_SEC`  longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`NOMBRE_RESPONSABLE_OF`  longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
`ESTATUS`  decimal(1,0) NOT NULL 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci

;

-- ----------------------------
-- Records of c_ur_secundarias
-- ----------------------------
BEGIN;
INSERT INTO `c_ur_secundarias` VALUES ('200', '1', 'DIRECCIÓN GENERAL DEL SISTEMA DE INFORMACIÓN Y GESTIÓN EDUCATIVA', 'C.P. JORGE QUIROZ TÉLLEZ   ', '1'), ('200', '2', 'DIRECCIÓN GENERAL DE EVALUACIÓN DE POLÍTICAS', 'LIC. ANA MARÍA LUZ ACEVES ESTRADA      ', '1'), ('500', '1', 'ÁREA DE TIC EN LA SUBSECRETARÍA DE EDUCACIÓN SUPERIOR', 'MTRO. JUAN JOSÉ GONZÁLEZ MORENO ', '1'), ('500', '2', 'COORDINACIÓN DE ASESORES DE LA SUBSECRETARIA DE EDUCACIÓN SUPERIOR', 'DR. JUAN JOSÉ SERRATO VELASCO   ', '1'), ('600', '1', 'COORDINACIÓN SECTORIAL DE OPERACIÓN TÉCNICA Y FINANCIERA DE LA SUBSECRETARIA DE EDUCACIÓN MEDIA SUPERIOR', 'LIC. DANIEL ÁVILA FERNÁNDEZ   ', '1'), ('600', '2', 'COORDINACIÓN GENERAL DE LA UCA PROFORHCOM', 'MTRA. CLAUDIA NATERAS SANDOVAL', '1'), ('713', '1', 'DIRECCIÓN DE ADMINISTRACIÓN DE PROYECTOS DE SISTEMAS INFORMÁTICOS', 'ING. MARÍA ELENA LÓPEZ FRANCISCO', '1'), ('713', '2', 'DIRECCIÓN DE DICTAMINACIÓN TÉCNICA Y GESTIÓN DE CONTRATACIÓN DE TIC', 'LIC. MONTSERRAT CAMPOS SANDOVAL', '1'), ('713', '3', 'DIRECCIÓN DE INFRAESTRUCTURA DE COMUNICACIONES', 'ING. MARIO RAMÓN BALLESTEROS ARANDA', '1'), ('713', '4', 'DIRECCIÓN GENERAL ADJUNTO DE PROYECTOS INFORMATICOS', 'LIC. ROBERTO CARLOS SARABIA MARTÍNEZ', '1'), ('713', '5', 'DIRECCIÓN DE SISTEMAS INFORMÁTICOS', 'LIC. ISAURO ABRAHAM AGUIRRE LÓPEZ', '1'), ('713', '6', 'DIRECCIÓN DE ADMINISTRACIÓN DE LA INFRAESTRUCTURA DE CÓMPUTO', 'ING. LUIS JORGE TEJADA FIGUEROA', '1'), ('713', '7', 'DIRECCION DE ADMINISTRACION DE PROYECTOS', 'LIC. REBECA SERAFÍN PULIDO', '1');
COMMIT;

-- ----------------------------
-- Table structure for sysdiagrams
-- ----------------------------
DROP TABLE IF EXISTS `sysdiagrams`;
CREATE TABLE `sysdiagrams` (
`name`  varchar(0) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`principal_id`  int(11) NOT NULL ,
`diagram_id`  int(11) NOT NULL ,
`version`  int(11) NULL DEFAULT NULL ,
`definition`  longblob NULL ,
PRIMARY KEY (`diagram_id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci

;

-- ----------------------------
-- Records of sysdiagrams
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for t_cartera_ejecutiva_proyectos
-- ----------------------------
DROP TABLE IF EXISTS `t_cartera_ejecutiva_proyectos`;
CREATE TABLE `t_cartera_ejecutiva_proyectos` (
`ANIO`  decimal(4,0) NOT NULL ,
`FEC_REGISTRO`  date NOT NULL ,
`FOLIO_PROYECTO`  decimal(3,0) NOT NULL ,
`VERSION`  decimal(1,0) NOT NULL ,
`ID_UR`  varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`ID_UR_SEC`  varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`OFICIO_SALIDA`  decimal(4,0) NULL DEFAULT NULL ,
`NOMBRE_PROYECTO`  longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`OFICIO_REGISTRO`  longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
`FEC_OFICIO_REGISTRO`  date NULL DEFAULT NULL ,
`VOLANTE_REGISTRO`  varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`FEC_LINEA_BASE_INICIO`  date NOT NULL ,
`FEC_LINEA_BASE_FIN`  date NOT NULL ,
`PLURIANUALIDAD`  varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`PRESUPUESTO_ESTIMADO`  decimal(18,0) NOT NULL ,
`NOMBRE_LIDER_PROYECTO`  longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`ID_FASE_PROYECTO`  decimal(1,0) NOT NULL ,
`ID_DOMINIO_TEC`  char(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`ID_PGCM`  varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`ID_EDN`  varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`ID_TITULO_ELABORO`  varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`NOMBRE_ELABORO`  longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`CARGO_ELABORO`  longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`ID_TITULO_REVISO`  varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`NOMBRE_REVISO`  longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`CARGO_REVISO`  longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`ID_TITULO_APROBO`  varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`NOMBRE_APROBO`  longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`CARGO_APROBO`  longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`OFICIO_ENVIO_DPNTIC`  varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`OFICIO_RECEP_MOD`  varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`VOLANTE_RECEP_MOD`  varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`ID_FORMATO`  longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
`FEC_MODIFICACION`  date NOT NULL ,
`CREATE_BY`  decimal(4,0) NULL DEFAULT NULL ,
`CREATE_ON`  date NULL DEFAULT NULL 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci

;

-- ----------------------------
-- Records of t_cartera_ejecutiva_proyectos
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for t_grupos
-- ----------------------------
DROP TABLE IF EXISTS `t_grupos`;
CREATE TABLE `t_grupos` (
`ID_GRUPO`  int(11) NOT NULL AUTO_INCREMENT ,
`NOMBRE_GRUPO`  char(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`DESCRIPTION`  char(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
PRIMARY KEY (`ID_GRUPO`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci
AUTO_INCREMENT=4

;

-- ----------------------------
-- Records of t_grupos
-- ----------------------------
BEGIN;
INSERT INTO `t_grupos` VALUES ('1', 'admin', 'Administrador'), ('2', 'generador', 'Generador'), ('3', 'visualizador', 'Visualizador');
COMMIT;

-- ----------------------------
-- Table structure for t_login_attemps
-- ----------------------------
DROP TABLE IF EXISTS `t_login_attemps`;
CREATE TABLE `t_login_attemps` (
`ID_ATTEMPS`  int(11) NOT NULL ,
`IP_ADDRESS`  char(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`LOGIN`  char(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`TIME`  char(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
PRIMARY KEY (`ID_ATTEMPS`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci

;

-- ----------------------------
-- Records of t_login_attemps
-- ----------------------------
BEGIN;
INSERT INTO `t_login_attemps` VALUES ('1', '127.0.0.1', 'TEST', 'TEST');
COMMIT;

-- ----------------------------
-- Table structure for t_usuario_grupos
-- ----------------------------
DROP TABLE IF EXISTS `t_usuario_grupos`;
CREATE TABLE `t_usuario_grupos` (
`ID_USUARIO_GRUPOS`  int(11) NOT NULL AUTO_INCREMENT ,
`ID_USUARIO`  int(11) NULL DEFAULT NULL ,
`ID_GRUPO`  int(11) NULL DEFAULT NULL ,
PRIMARY KEY (`ID_USUARIO_GRUPOS`),
FOREIGN KEY (`ID_GRUPO`) REFERENCES `t_grupos` (`ID_GRUPO`) ON DELETE RESTRICT ON UPDATE RESTRICT,
FOREIGN KEY (`ID_USUARIO`) REFERENCES `t_usuarios` (`ID_USUARIO`) ON DELETE RESTRICT ON UPDATE RESTRICT,
INDEX `ID_GRUPO` (`ID_GRUPO`) USING BTREE ,
INDEX `ID_USUARIO` (`ID_USUARIO`) USING BTREE 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci
AUTO_INCREMENT=1005

;

-- ----------------------------
-- Records of t_usuario_grupos
-- ----------------------------
BEGIN;
INSERT INTO `t_usuario_grupos` VALUES ('1', '1', '1'), ('2', '1', '2'), ('3', '1', '3'), ('1004', '3', '1');
COMMIT;

-- ----------------------------
-- Table structure for t_usuarios
-- ----------------------------
DROP TABLE IF EXISTS `t_usuarios`;
CREATE TABLE `t_usuarios` (
`ID_USUARIO`  int(11) NOT NULL AUTO_INCREMENT ,
`IP_ADDRESS`  char(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`NOMBRE_USUARIO`  char(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`PASSWORD`  char(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`SALT`  char(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`EMAIL`  char(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`ACTIVATION_CODE`  char(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`FORGOTTEN_PASSWORD_CODE`  char(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`FORGOTTEN_PASSWORD_TIME`  char(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`REMEMBER_CODE`  char(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`CREATED_ON`  char(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`LAST_LOGIN`  char(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`ACTIVE`  int(11) NULL DEFAULT NULL ,
`FIRST_NAME`  char(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`LAST_NAME`  char(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`COMPANY`  char(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`PHONE`  char(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
PRIMARY KEY (`ID_USUARIO`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci
AUTO_INCREMENT=4

;

-- ----------------------------
-- Records of t_usuarios
-- ----------------------------
BEGIN;
INSERT INTO `t_usuarios` VALUES ('1', '127.0.0.1', 'iezpinoza', '$2y$08$eK7WJnQd5nUQvLX0btuwGOT3MZ/3T/zvu1Yd5VCf95lUJF2z7rWKG', null, 'ing.ezpinoza@gmail.com', null, null, null, null, '1268889823', '1484165652', '1', 'Ivan', 'Espinoza', 'Tecnoogia Aplicada', '5512239821'), ('3', '::1', 'omare', '$2y$08$QLPelwhxmMZis9RaBtot3.FSrwADQ3vXR6jfYq9vRrKd9QRHsPqKC', null, 'omar.xancopinca@nube.sep.gob.mx', null, null, null, null, '1484165668', null, '1', 'Omar Eduardo', 'Xancopinca', 'SEP', '0');
COMMIT;

-- ----------------------------
-- Auto increment value for t_grupos
-- ----------------------------
ALTER TABLE `t_grupos` AUTO_INCREMENT=4;

-- ----------------------------
-- Auto increment value for t_usuario_grupos
-- ----------------------------
ALTER TABLE `t_usuario_grupos` AUTO_INCREMENT=1005;

-- ----------------------------
-- Auto increment value for t_usuarios
-- ----------------------------
ALTER TABLE `t_usuarios` AUTO_INCREMENT=4;
SET FOREIGN_KEY_CHECKS=1;
