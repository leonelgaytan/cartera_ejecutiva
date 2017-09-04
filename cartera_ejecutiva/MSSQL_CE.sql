/*
Navicat SQL Server Data Transfer

Source Server         : Omar
Source Server Version : 110000
Source Host           : 10.75.157.108:1433
Source Database       : CARTERA _EJECUTIVA
Source Schema         : dbo

Target Server Type    : SQL Server
Target Server Version : 110000
File Encoding         : 65001

Date: 2017-01-11 15:05:49
*/


-- ----------------------------
-- Table structure for C_CATEGORIAS
-- ----------------------------
DROP TABLE [C_CATEGORIAS]
GO
CREATE TABLE [C_CATEGORIAS] (
[ID_CATEGORIA] numeric(1) NULL ,
[CATEGORIA] varchar(50) NULL ,
[ESTATUS] numeric(1) NOT NULL DEFAULT ((1)) 
)


GO

-- ----------------------------
-- Records of C_CATEGORIAS
-- ----------------------------
BEGIN TRANSACTION
GO
INSERT INTO [C_CATEGORIAS] ([ID_CATEGORIA], [CATEGORIA], [ESTATUS]) VALUES (N'1', N'OPTIMIZACION', N'1'), (N'2', N'DIGITALIZACION', N'1'), (N'3', N'SIMPLIFICACION', N'1'), (N'4', N'RACIONALIZACION', N'1')
GO
GO
COMMIT TRANSACTION
GO

-- ----------------------------
-- Table structure for C_DOMINIOS_TECNOLOGICOS
-- ----------------------------
DROP TABLE [C_DOMINIOS_TECNOLOGICOS]
GO
CREATE TABLE [C_DOMINIOS_TECNOLOGICOS] (
[ID_DOMINIO_TEC] numeric(1) NOT NULL ,
[DOMINIO_TENOLOGICO] varchar(MAX) NOT NULL ,
[ESTATUS] numeric(1) NOT NULL DEFAULT ((1)) 
)


GO

-- ----------------------------
-- Records of C_DOMINIOS_TECNOLOGICOS
-- ----------------------------
BEGIN TRANSACTION
GO
INSERT INTO [C_DOMINIOS_TECNOLOGICOS] ([ID_DOMINIO_TEC], [DOMINIO_TENOLOGICO], [ESTATUS]) VALUES (N'1', N'SEGURIDAD', N'1'), (N'2', N'COMPUTO CENTRAL Y DISTRIBUIDO', N'1'), (N'3', N'COMPUTO USUARIO FINAL', N'1'), (N'4', N'COMUNICACIONES', N'1'), (N'5', N'COLABORACION Y CORREO ELECTRONICO', N'1'), (N'6', N'INTERNET/INTRANET', N'1'), (N'7', N'APLICATIVOS', N'1'), (N'8', N'BASE DE DATOS Y DATAWAREHOUSING', N'1'), (N'9', N'SISTEMAS DE CONTROL INDUSTRIALES', N'1')
GO
GO
COMMIT TRANSACTION
GO

-- ----------------------------
-- Table structure for C_EDN
-- ----------------------------
DROP TABLE [C_EDN]
GO
CREATE TABLE [C_EDN] (
[ID_EDN] numeric(2) NOT NULL ,
[OBJETIVOS_SEC_EDN] varchar(MAX) NOT NULL ,
[ESTATUS] numeric(1) NOT NULL DEFAULT ((1)) 
)


GO

-- ----------------------------
-- Records of C_EDN
-- ----------------------------
BEGIN TRANSACTION
GO
INSERT INTO [C_EDN] ([ID_EDN], [OBJETIVOS_SEC_EDN], [ESTATUS]) VALUES (N'1', N'Generar y coordinar acciones orientadas hacia el logro de un gobierno abierto.', N'1'), (N'2', N'Instrumentar la Ventanilla Única Nacional para trámites y servicios.', N'1'), (N'3', N'Coordinar una política digital de gestión en el territorio nacional.', N'1'), (N'4', N'Implementar una Política de TIC sustentable para la Administración Pública Federal.', N'1'), (N'5', N'Adoptar una comunicación digital centrada en el ciudadano.', N'1'), (N'6', N'Desarrollar el mercado de bienes y servicios digitales.', N'1'), (N'7', N'Potenciar el desarrollo del comercio electrónico.', N'1'), (N'8', N'Generar nuevos mecanismos de contratación que fomenten la innovación y el emprendimiento a través de la democratización del gasto público.', N'1'), (N'9', N'Promover la inclusión financiera mediante esquemas de banca móvil.', N'1'), (N'10', N'Desarrollar una política nacional de adopción y uso de las TIC en el proceso de enseñanza-aprendizaje en el Sistema Educativo Nacional.', N'1'), (N'11', N'Ampliar la oferta educativa a través de medios digitales.', N'1'), (N'12', N'Mejorar la gestión educativa mediante el uso de las TIC.', N'1'), (N'13', N'Desarrollar una agenda digital de cultura.', N'1'), (N'14', N'Impulsar un modelo de gobierno de información en salud que apoye la convergencia de los sistemas de información en salud.', N'1'), (N'15', N'Consolidar el Sistema Nacional de Información Básica en Materia de Salud con la finalidad de establecer la personalidad única en salud y fomente el uso eficiente de la capacidad instalada.', N'1'), (N'16', N'Impulsar la Digitalización de los Servicios de Salud por medio del Certificado Electrónico de Nacimiento (CeN) y la Cartilla Electrónica de Vacunación (CeV) que apoye la mejora del modelo de atención médica.', N'1'), (N'17', N'Impulsar el intercambio de información de los Sistemas de Información de Registro Electrónico para la Salud, entre los que se encuentran los Expedientes Clínicos Electrónicos, para apoyar la convergencia de los sistemas de información en salud.', N'1'), (N'18', N'Impulsar mecanismo de Telesalud y Telemedicina para aumentar la cobertura de los servicios de salud.', N'1'), (N'19', N'Impulsar la innovación cívica para resolver problemas de interés público por medio de las TIC.', N'1'), (N'20', N'Usar datos para el desarrollo y el mejoramiento de políticas públicas.', N'1'), (N'21', N'Generar herramientas y aplicaciones de denuncia ciudadana en múltiples plataformas.', N'1'), (N'22', N'Desarrollar instrumentos digitales para la prevención social de la violencia que involucren la participación ciudadana.', N'1'), (N'23', N'Prevenir y mitigar los daños causados por desastres naturales mediante el uso de las TIC instrumentos digitales para la prevención social de la violencia que involucren la participación ciudadana.', N'1'), (N'24', N'Habilitadores de Inclusión de Habilidades Digitales.', N'1'), (N'25', N'Habilitadores de interoperabilidad.', N'1'), (N'26', N'Habilitadores de Marco Jurídico.', N'1'), (N'27', N'Habilitadores de Datos Abiertos.', N'1'), (N'28', N'Habilitador de Conectividad', N'1'), (N'29', N'No alineado', N'1')
GO
GO
COMMIT TRANSACTION
GO

-- ----------------------------
-- Table structure for C_FASES_PROYECTO
-- ----------------------------
DROP TABLE [C_FASES_PROYECTO]
GO
CREATE TABLE [C_FASES_PROYECTO] (
[ID_FASE_PROYECTO] numeric(1) NOT NULL ,
[FASE_PROYECTO] varchar(MAX) NOT NULL ,
[ESTATUS] numeric(1) NOT NULL DEFAULT ((1)) 
)


GO

-- ----------------------------
-- Records of C_FASES_PROYECTO
-- ----------------------------
BEGIN TRANSACTION
GO
INSERT INTO [C_FASES_PROYECTO] ([ID_FASE_PROYECTO], [FASE_PROYECTO], [ESTATUS]) VALUES (N'1', N'ANTEPROYECTO', N'1'), (N'2', N'DEFINICION', N'1'), (N'3', N'PLANEACION', N'1'), (N'4', N'EJECUCION', N'1'), (N'5', N'CIERRE', N'1'), (N'6', N'COMPLETADO', N'1'), (N'7', N'CONGELADO', N'1'), (N'8', N'CANCELADO', N'1')
GO
GO
COMMIT TRANSACTION
GO

-- ----------------------------
-- Table structure for C_FORMATOS_RECIBIDOS
-- ----------------------------
DROP TABLE [C_FORMATOS_RECIBIDOS]
GO
CREATE TABLE [C_FORMATOS_RECIBIDOS] (
[ID_FORMATO] numeric(2) NOT NULL ,
[FORMATOS_RECIBIDOS] varchar(MAX) NOT NULL ,
[ESTATUS] numeric(1) NOT NULL DEFAULT ((1)) 
)


GO

-- ----------------------------
-- Records of C_FORMATOS_RECIBIDOS
-- ----------------------------
BEGIN TRANSACTION
GO
INSERT INTO [C_FORMATOS_RECIBIDOS] ([ID_FORMATO], [FORMATOS_RECIBIDOS], [ESTATUS]) VALUES (N'1', N'DGTIC-PE-01 PETIC', N'1'), (N'2', N'DGTIC-PE-04-ALINEACION DEL PROYECTO', N'1'), (N'3', N'ADP-F1 ACTA CONSTITUCION DEL PROECTO', N'1'), (N'4', N'ADP-F2 ACTA DE ACEPTACION DE ENTREGABLES', N'1'), (N'5', N'ADP-F3 ACTA DE ACEPTACION DE ENTREGABLES', N'1'), (N'6', N'P-23-E REPORTE DE AVANCE', N'1'), (N'7', N'DGTIC-AOP-01 APLICATIVOS MOVILES', N'1'), (N'8', N'DGTIC-AOP-02 BASE DE DATOS', N'1'), (N'9', N'DGTIC-AOP-03 CENTRO DE DATOS', N'1'), (N'10', N'DGTIC-AOP-04 HARDWARE', N'1'), (N'11', N'DGTIC-AOP-05 SISTEMAS Y SERVICIOS', N'1'), (N'12', N'DGTIC-AOP-06 SOFTWARE', N'1'), (N'13', N'OFICIO DE CANCELACION', N'1')
GO
GO
COMMIT TRANSACTION
GO

-- ----------------------------
-- Table structure for C_PGCM
-- ----------------------------
DROP TABLE [C_PGCM]
GO
CREATE TABLE [C_PGCM] (
[ID_PGCM] numeric(2,1) NOT NULL ,
[DESCRIPCION_PGCM] varchar(MAX) NOT NULL ,
[ESTATUS] numeric(1) NOT NULL DEFAULT ((1)) 
)


GO

-- ----------------------------
-- Records of C_PGCM
-- ----------------------------
BEGIN TRANSACTION
GO
INSERT INTO [C_PGCM] ([ID_PGCM], [DESCRIPCION_PGCM], [ESTATUS]) VALUES (N'1.1', N'Fomentar la participación ciudadana en las políticas públicas y en la prevención de la corrupción.', N'1'), (N'1.2', N'Promover una cultura de legalidad que aumente la confianza de los mexicanos en el gobierno y prevenga  la corrupción.', N'1'), (N'1.3', N'Garantizar el acceso a la información y la protección de los datos personales en la APF.', N'1'), (N'1.4', N'Mejorar la transparencia de la información socialmente útil de la APF.', N'1'), (N'1.5', N'Fortalecer el uso de la información presupuestaria.', N'1'), (N'1.6', N'Fomentar la participación ciudadana a través de la innovación en el uso de las TIC y los datos abiertos', N'1'), (N'1.7', N'Consolidar los sistemas institucionales de archivo y administración de documentos', N'1'), (N'2.1', N'Impulsar una planeación nacional basada en resultados', N'1'), (N'2.2', N'Vincular el SED con las asignaciones presupuestarias.', N'1'), (N'2.3', N'Fortalecer el proceso de seguimiento y evaluación al desempeño de la APF.', N'1'), (N'2.4', N'Mejorar la calidad del gasto federalizado con base en los preceptos del SED.', N'1'), (N'2.5', N'Garantizar que los programas y proyectos de inversión registrados en la cartera de inversión, sean aquellos con mayor rentabilidad social.', N'1'), (N'3.1', N'Orientar las estructuras orgánicas y ocupaciones hacia los objetivos estratégicos.', N'1'), (N'3.2', N'Fortalecer el uso eficiente de los recursos destinados a servicios personales y gasto de operación.', N'1'), (N'3.3', N'Promover la implementación de estrategias de contratación orientadas a la obtención del máximo valor por la inversión', N'1'), (N'3.4', N'Promover una administración moderna y transparente del patrimonio inmobiliario federal.', N'1'), (N'4.1', N'Transformar los procesos de las dependencias y entidades.', N'1'), (N'4.2', N'Fortalecer la profesionalización de los servicios públicos.', N'1'), (N'4.3', N'Obtener las mejores condiciones en la contratación de bienes, servicios y obras públicas de la APF.', N'1'), (N'4.4', N'Fortalecer la planeación y control de los recursos humanos, alineados a los objetivos y metas estratégicas institucionales', N'1'), (N'4.5', N'Simplificar la regulación que rige a las dependencias y entidades para garantizar la eficiente operación del gobierno.', N'1'), (N'5.1', N'Propiciar la transformación Gubernamental mediante las tecnologías de información y comunicación', N'1'), (N'5.2', N'Contribuir a la convergencia de los sistemas a la portabilidad de coberturas en los servicios de salud del Sistema Nacional de Salud mediante la utilización de TIC.', N'1'), (N'5.3', N'Propiciar la transformación del modelo educativo con herramientas tecnológicas.', N'1'), (N'5.4', N'Desarrollar la economía digital que impulse el mercado de TIC, el apoyo a actividades productivas y al capital.', N'1'), (N'5.5', N'Fortalecer la seguridad ciudadana utilizando medios digitales.', N'1'), (N'5.6', N'Establecer y operar los habilitadores de TIC para la conectividad y asequibilidad, inclusión digital e Interoperabilidad.', N'1'), (N'5.7', N'Establecer y operar el Marco Jurídico para las TIC.', N'1')
GO
GO
COMMIT TRANSACTION
GO

-- ----------------------------
-- Table structure for C_PND
-- ----------------------------
DROP TABLE [C_PND]
GO
CREATE TABLE [C_PND] (
[ID_PND] numeric(1) NOT NULL ,
[OBJETIVO_PND] varchar(MAX) NOT NULL ,
[ESTATUS] numeric(1) NOT NULL DEFAULT ((1)) 
)


GO

-- ----------------------------
-- Records of C_PND
-- ----------------------------
BEGIN TRANSACTION
GO
INSERT INTO [C_PND] ([ID_PND], [OBJETIVO_PND], [ESTATUS]) VALUES (N'1', N'MEXICO EN PAZ', N'1'), (N'2', N'MEXICO INCLUYENTE', N'1'), (N'3', N'MEXICO CON EDUACION DE CALIDAD', N'1'), (N'4', N'MEXICO PROSPERO', N'1'), (N'5', N'MEXICO CON RESPONSABILIDAD GLOBAL', N'1')
GO
GO
COMMIT TRANSACTION
GO

-- ----------------------------
-- Table structure for C_RIESGOS
-- ----------------------------
DROP TABLE [C_RIESGOS]
GO
CREATE TABLE [C_RIESGOS] (
[ID_RIEGO_PROYECTO] numeric(1) NOT NULL ,
[RIESGO_PROYECTO] varchar(MAX) NULL ,
[ESTATUS] numeric(1) NOT NULL DEFAULT ((1)) 
)


GO

-- ----------------------------
-- Records of C_RIESGOS
-- ----------------------------
BEGIN TRANSACTION
GO
INSERT INTO [C_RIESGOS] ([ID_RIEGO_PROYECTO], [RIESGO_PROYECTO], [ESTATUS]) VALUES (N'1', N'BAJO', N'1'), (N'2', N'MEDIO', N'1'), (N'3', N'ALTO', N'1')
GO
GO
COMMIT TRANSACTION
GO

-- ----------------------------
-- Table structure for C_TITULOS
-- ----------------------------
DROP TABLE [C_TITULOS]
GO
CREATE TABLE [C_TITULOS] (
[ID_TITULO] numeric(2) NOT NULL ,
[ABREVIATURA] varchar(6) NOT NULL ,
[DESC_TITULO] varchar(MAX) NOT NULL ,
[ESTATUS] numeric(1) NOT NULL DEFAULT ((1)) 
)


GO

-- ----------------------------
-- Records of C_TITULOS
-- ----------------------------
BEGIN TRANSACTION
GO
INSERT INTO [C_TITULOS] ([ID_TITULO], [ABREVIATURA], [DESC_TITULO], [ESTATUS]) VALUES (N'1', N'Abgdo.', N'ABOGADO', N'1'), (N'2', N'Adm.', N'ADMINISTRADOR', N'1'), (N'3', N'Anl.', N'ANALISTA', N'1'), (N'4', N'Arq.', N'ARQUITECTO', N'1'), (N'5', N'Bach.', N'BACHILLER', N'1'), (N'6', N'C.', N'CIUDADANO', N'1'), (N'7', N'Coord.', N'COORDINADOR', N'1'), (N'8', N'CP.', N'CONTADOR PÚBLICO', N'1'), (N'9', N'Cdor.', N'CONTADOR', N'1'), (N'10', N'Dir.', N'DIRECTOR', N'1'), (N'11', N'Dira.', N'DIRECTORA', N'1'), (N'12', N'Dr.', N'DOCTOR', N'1'), (N'13', N'Dra.', N'DOCTORA', N'1'), (N'14', N'Econ.', N'ECONOMISTA', N'1'), (N'15', N'Ing.', N'INGENIERO', N'1'), (N'16', N'Lic.', N'LICENCIADO', N'1'), (N'17', N'Not.', N'NOTARIO', N'1'), (N'18', N'Prof.', N'PROFESOR', N'1'), (N'19', N'Profa.', N'PROFESORA', N'1'), (N'20', N'Mtro.', N'MAESTRO', N'1'), (N'21', N'Mtra.', N'MAESTRA', N'1'), (N'22', N'Ing.', N'INGENIERO', N'1'), (N'23', N'C.P.', N'CONTADOR PUBLICO', N'1')
GO
GO
COMMIT TRANSACTION
GO

-- ----------------------------
-- Table structure for C_UNIDADES_RESPONSABLES
-- ----------------------------
DROP TABLE [C_UNIDADES_RESPONSABLES]
GO
CREATE TABLE [C_UNIDADES_RESPONSABLES] (
[ID_UR] nvarchar(4) NOT NULL ,
[UNIDAD_RESPONSABLE] varchar(MAX) NOT NULL ,
[ESTATUS] numeric(1) NOT NULL DEFAULT ((1)) 
)


GO

-- ----------------------------
-- Records of C_UNIDADES_RESPONSABLES
-- ----------------------------
BEGIN TRANSACTION
GO
INSERT INTO [C_UNIDADES_RESPONSABLES] ([ID_UR], [UNIDAD_RESPONSABLE], [ESTATUS]) VALUES (N'K00', N'UNIVERSIDAD ABIERTA Y A DISTANCIA DE MEXICO', N'1'), (N'L00', N'COORDINACION NACIONAL DEL SERVICIO PROFESIONAL DOCENTE', N'1'), (N'M00', N'TECNOLOGICO NACIONAL DE MEXICO', N'1'), (N'N00', N'COORDINACION GENERAL @PRENDE.MX', N'1'), (N'100', N'OFICINA DEL C. SECRETARIO DE EDUCACION PUBLICA', N'1'), (N'110', N'DIRECCION GENERAL DE COMUNICACION SOCIAL', N'1'), (N'111', N'UNIDAD DE ASUNTOS JURIDICOS', N'1'), (N'114', N'COORD. GRAL. DE DELEGACIONES FEDERALES DE LA SEP', N'1'), (N'115', N'COORDINACION GENERAL DE EDUCACION INTERCULTURAL  Y BILINGUE', N'1'), (N'116', N'ORGANO INTERNO DE CONTROL', N'1'), (N'117', N'UNIDAD DE SEGUIMIENTO DE COMPROMISOS E INSTRUCCIONES PRESIDE', N'1'), (N'120', N'JEFATURA DE LA OFICINA DEL SECRETARIO', N'1'), (N'121', N'DELEGACION FEDERAL DE LA SEP EN EL EDO DE AGUASCALIENTES', N'1'), (N'122', N'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE BAJA CAL.NORTE', N'1'), (N'123', N'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE BAJA CAL. SUR', N'1'), (N'124', N'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE CAMPECHE', N'1'), (N'125', N'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE COAHUILA', N'1'), (N'126', N'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE COLIMA', N'1'), (N'127', N'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE CHIAPAS', N'1'), (N'128', N'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE CHIHUAHUA', N'1'), (N'130', N'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE DURANGO', N'1'), (N'131', N'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE GUANAJUATO', N'1'), (N'132', N'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE GUERRERO', N'1'), (N'133', N'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE HIDALGO', N'1'), (N'134', N'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE JALISCO', N'1'), (N'135', N'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE MEXICO', N'1'), (N'136', N'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE MICHOACAN', N'1'), (N'137', N'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE MORELOS', N'1'), (N'138', N'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE NAYARIT', N'1'), (N'139', N'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE NUEVO LEON', N'1'), (N'140', N'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE OAXACA', N'1'), (N'141', N'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE PUEBLA', N'1'), (N'142', N'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE QUERETARO', N'1'), (N'143', N'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE QUINTANA ROO', N'1'), (N'144', N'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE SAN LUIS POTOSI', N'1'), (N'145', N'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE SINALOA', N'1'), (N'146', N'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE SONORA', N'1'), (N'147', N'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE TABASCO', N'1'), (N'148', N'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE TAMAULIPAS', N'1'), (N'149', N'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE TLAXCALA', N'1'), (N'150', N'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE VERACRUZ', N'1'), (N'151', N'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE YUCATAN', N'1'), (N'152', N'DELEGACION FEDERAL DE LA SEP EN  EL EDO DE ZACATECAS', N'1'), (N'153', N'COORDINACION DE ORGANOS DESCONCENTRADOS Y DEL SECT. PAR', N'1'), (N'200', N'SUBSECRETARIA DE PLANEACIÓN, EVALUACIÓN Y COORDINACIÓN', N'1'), (N'210', N'DIR GRAL DE PLANEACION PROGRAMACION Y ESTADISTICA EDUCATIVA', N'1'), (N'211', N'DIRECCION GENERAL DE ACREDITACION, INCORPORACION Y REVALIDAC', N'1'), (N'212', N'DIRECCION GENERAL DE EVALUACION DE POLITICAS', N'1'), (N'215', N'COORDINACION NACIONAL DE CARRERA MAGISTERIAL', N'1'), (N'216', N'DIRECCION GENERAL DE TELEVISION EDUCATIVA', N'1'), (N'217', N'DIRECCION GENERAL DE RELACIONES INTERNACIONALES', N'1'), (N'218', N'DIRECCIÓN GENERAL DEL SISTEMA DE INFORMACION Y GESTION EDUCATIVA', N'1'), (N'300', N'SUBSECRETARIA DE EDUCACION BASICA', N'1'), (N'310', N'DIRECCION GENERAL DE DESARROLLO DE LA GESTION EDUCATIVA', N'1'), (N'311', N'DIRECCIÓN GENERAL DE MATERIALES EDUCATIVOS', N'1'), (N'312', N'DIRECCION GENERAL DE DESARROLLO CURRICULAR', N'1'), (N'313', N'DIRECCION GENERAL DE EDUCACION INDIGENA', N'1'), (N'314', N'DIR GRAL DE FORMACION CONTINUA ACTUALIZACIÓN Y DESARROLLO P', N'1'), (N'500', N'SUBSECRETARIA DE EDUCACION SUPERIOR', N'1'), (N'511', N'DIRECCION GENERAL DE EDUCACION SUPERIOR UNIVERSITARIA', N'1'), (N'512', N'DIRECCION GENERAL DE PROFESIONES', N'1'), (N'514', N'COORD, GENERAL DE UNIVERSIDADES TECNOLOGICAS Y POLITECNICAS', N'1'), (N'515', N'DIRECCION GRAL. DE EDUC.SUPERIOR PARA PROFESIONALES DE LA ED', N'1'), (N'600', N'SUBSECRETARIA DE EDUCACION MEDIA SUPERIOR', N'1'), (N'610', N'DIRECCION GENERAL DE EDUCACION TECNOLOGICA AGROPECUARIA', N'1'), (N'611', N'DIRECCION GENERAL DE EDUCACION TECNOLOGICA INDUSTRIAL', N'1'), (N'613', N'DIRECCION GENERAL DE CENTROS DE FORMACION PARA EL TRABAJO', N'1'), (N'615', N'DIRECCION GRAL. DE EDUCACION EN CIENCIA Y TECNOLOGIA DEL MAR', N'1'), (N'616', N'DIRECCION GENERAL DEL BACHILLERATO', N'1'), (N'700', N'OFICIALIA MAYOR', N'1'), (N'710', N'DIRECCIÓN GENERAL DE PRESUPUESTO Y RECURSOS FINANCIEROS', N'1'), (N'711', N'DIRECCION GENERAL DE PERSONAL', N'1'), (N'712', N'DIRECCION GENERAL DE RECURSOS MATERIALES Y SERVICIOS', N'1'), (N'713', N'DIREC GRAL DE TECNOLOGIAS DE LA INFORMACION Y COMUNICACIONES', N'1'), (N'714', N'DIRECCION GENERAL DE INNOVACION, CALIDAD Y ORGANIZACION', N'1'), (N'CCA', N'CONACULTA', N'1')
GO
GO
COMMIT TRANSACTION
GO

-- ----------------------------
-- Table structure for C_UR_SECUNDARIAS
-- ----------------------------
DROP TABLE [C_UR_SECUNDARIAS]
GO
CREATE TABLE [C_UR_SECUNDARIAS] (
[ID_UR] nvarchar(4) NOT NULL ,
[ID_UR_SEC] nvarchar(4) NOT NULL ,
[DESCRIPCION_UR_SEC] varchar(MAX) NOT NULL ,
[NOMBRE_RESPONSABLE_OF] varchar(MAX) NULL ,
[ESTATUS] numeric(1) NOT NULL DEFAULT ((1)) 
)


GO

-- ----------------------------
-- Records of C_UR_SECUNDARIAS
-- ----------------------------
BEGIN TRANSACTION
GO
INSERT INTO [C_UR_SECUNDARIAS] ([ID_UR], [ID_UR_SEC], [DESCRIPCION_UR_SEC], [NOMBRE_RESPONSABLE_OF], [ESTATUS]) VALUES (N'200', N'1', N'DIRECCIÓN GENERAL DEL SISTEMA DE INFORMACIÓN Y GESTIÓN EDUCATIVA', N'C.P. JORGE QUIROZ TÉLLEZ   ', N'1'), (N'200', N'2', N'DIRECCIÓN GENERAL DE EVALUACIÓN DE POLÍTICAS', N'LIC. ANA MARÍA LUZ ACEVES ESTRADA      ', N'1'), (N'500', N'1', N'ÁREA DE TIC EN LA SUBSECRETARÍA DE EDUCACIÓN SUPERIOR', N'MTRO. JUAN JOSÉ GONZÁLEZ MORENO ', N'1'), (N'500', N'2', N'COORDINACIÓN DE ASESORES DE LA SUBSECRETARIA DE EDUCACIÓN SUPERIOR', N'DR. JUAN JOSÉ SERRATO VELASCO   ', N'1'), (N'600', N'1', N'COORDINACIÓN SECTORIAL DE OPERACIÓN TÉCNICA Y FINANCIERA DE LA SUBSECRETARIA DE EDUCACIÓN MEDIA SUPERIOR', N'LIC. DANIEL ÁVILA FERNÁNDEZ   ', N'1'), (N'600', N'2', N'COORDINACIÓN GENERAL DE LA UCA PROFORHCOM', N'MTRA. CLAUDIA NATERAS SANDOVAL', N'1'), (N'713', N'1', N'DIRECCIÓN DE ADMINISTRACIÓN DE PROYECTOS DE SISTEMAS INFORMÁTICOS', N'ING. MARÍA ELENA LÓPEZ FRANCISCO', N'1'), (N'713', N'2', N'DIRECCIÓN DE DICTAMINACIÓN TÉCNICA Y GESTIÓN DE CONTRATACIÓN DE TIC', N'LIC. MONTSERRAT CAMPOS SANDOVAL', N'1'), (N'713', N'3', N'DIRECCIÓN DE INFRAESTRUCTURA DE COMUNICACIONES', N'ING. MARIO RAMÓN BALLESTEROS ARANDA', N'1'), (N'713', N'4', N'DIRECCIÓN GENERAL ADJUNTO DE PROYECTOS INFORMATICOS', N'LIC. ROBERTO CARLOS SARABIA MARTÍNEZ', N'1'), (N'713', N'5', N'DIRECCIÓN DE SISTEMAS INFORMÁTICOS', N'LIC. ISAURO ABRAHAM AGUIRRE LÓPEZ', N'1'), (N'713', N'6', N'DIRECCIÓN DE ADMINISTRACIÓN DE LA INFRAESTRUCTURA DE CÓMPUTO', N'ING. LUIS JORGE TEJADA FIGUEROA', N'1'), (N'713', N'7', N'DIRECCION DE ADMINISTRACION DE PROYECTOS', N'LIC. REBECA SERAFÍN PULIDO', N'1')
GO
GO
COMMIT TRANSACTION
GO

-- ----------------------------
-- Table structure for sysdiagrams
-- ----------------------------
DROP TABLE [sysdiagrams]
GO
CREATE TABLE [sysdiagrams] (
[name] sysname NOT NULL ,
[principal_id] int NOT NULL ,
[diagram_id] int NOT NULL IDENTITY(1,1) ,
[version] int NULL ,
[definition] varbinary(MAX) NULL 
)


GO

-- ----------------------------
-- Records of sysdiagrams
-- ----------------------------
BEGIN TRANSACTION
GO
SET IDENTITY_INSERT [sysdiagrams] ON
GO
SET IDENTITY_INSERT [sysdiagrams] OFF
GO
COMMIT TRANSACTION
GO

-- ----------------------------
-- Table structure for T_CARTERA_EJECUTIVA_PROYECTOS
-- ----------------------------
DROP TABLE [T_CARTERA_EJECUTIVA_PROYECTOS]
GO
CREATE TABLE [T_CARTERA_EJECUTIVA_PROYECTOS] (
[ANIO] numeric(4) NOT NULL ,
[FEC_REGISTRO] date NOT NULL ,
[FOLIO_PROYECTO] numeric(3) NOT NULL ,
[VERSION] numeric(1) NOT NULL DEFAULT ((0)) ,
[ID_UR] nvarchar(4) NOT NULL ,
[ID_UR_SEC] nvarchar(4) NULL ,
[OFICIO_SALIDA] numeric(4) NULL ,
[NOMBRE_PROYECTO] varchar(MAX) NOT NULL ,
[OFICIO_REGISTRO] varchar(MAX) NULL ,
[FEC_OFICIO_REGISTRO] date NULL ,
[VOLANTE_REGISTRO] varchar(10) NULL ,
[FEC_LINEA_BASE_INICIO] date NOT NULL ,
[FEC_LINEA_BASE_FIN] date NOT NULL ,
[PLURIANUALIDAD] varchar(2) NOT NULL DEFAULT ('NO') ,
[PRESUPUESTO_ESTIMADO] numeric(18) NOT NULL DEFAULT ((0)) ,
[NOMBRE_LIDER_PROYECTO] varchar(MAX) NOT NULL ,
[ID_FASE_PROYECTO] numeric(1) NOT NULL ,
[ID_DOMINIO_TEC] nchar(30) NULL ,
[ID_PGCM] nvarchar(30) NULL ,
[ID_EDN] nvarchar(30) NULL ,
[ID_TITULO_ELABORO] varchar(5) NOT NULL DEFAULT ('C.') ,
[NOMBRE_ELABORO] varchar(MAX) NOT NULL ,
[CARGO_ELABORO] varchar(MAX) NOT NULL ,
[ID_TITULO_REVISO] varchar(5) NOT NULL DEFAULT ('C.') ,
[NOMBRE_REVISO] varchar(MAX) NOT NULL ,
[CARGO_REVISO] varchar(MAX) NOT NULL ,
[ID_TITULO_APROBO] varchar(5) NOT NULL DEFAULT ('C.') ,
[NOMBRE_APROBO] varchar(MAX) NOT NULL ,
[CARGO_APROBO] varchar(MAX) NOT NULL ,
[OFICIO_ENVIO_DPNTIC] varchar(50) NULL DEFAULT ('SIN INFORMACION') ,
[OFICIO_RECEP_MOD] varchar(50) NOT NULL ,
[VOLANTE_RECEP_MOD] nvarchar(10) NULL ,
[ID_FORMATO] varchar(MAX) NULL ,
[FEC_MODIFICACION] date NOT NULL ,
[CREATE_BY] numeric(4) NULL ,
[CREATE_ON] date NULL 
)


GO

-- ----------------------------
-- Records of T_CARTERA_EJECUTIVA_PROYECTOS
-- ----------------------------
BEGIN TRANSACTION
GO
COMMIT TRANSACTION
GO

-- ----------------------------
-- Table structure for T_GRUPOS
-- ----------------------------
DROP TABLE [T_GRUPOS]
GO
CREATE TABLE [T_GRUPOS] (
[ID_GRUPO] int NOT NULL IDENTITY(1,1) ,
[NOMBRE_GRUPO] nchar(25) NULL ,
[DESCRIPTION] nchar(50) NULL 
)


GO
DBCC CHECKIDENT(N'[T_GRUPOS]', RESEED, 3)
GO

-- ----------------------------
-- Records of T_GRUPOS
-- ----------------------------
BEGIN TRANSACTION
GO
SET IDENTITY_INSERT [T_GRUPOS] ON
GO
INSERT INTO [T_GRUPOS] ([ID_GRUPO], [NOMBRE_GRUPO], [DESCRIPTION]) VALUES (N'1', N'admin                    ', N'Administrador                                     '), (N'2', N'generador                ', N'Generador                                         '), (N'3', N'visualizador             ', N'Visualizador                                      ')
GO
GO
SET IDENTITY_INSERT [T_GRUPOS] OFF
GO
COMMIT TRANSACTION
GO

-- ----------------------------
-- Table structure for T_LOGIN_ATTEMPS
-- ----------------------------
DROP TABLE [T_LOGIN_ATTEMPS]
GO
CREATE TABLE [T_LOGIN_ATTEMPS] (
[ID_ATTEMPS] int NOT NULL IDENTITY(1,1) ,
[IP_ADDRESS] nchar(25) NULL ,
[LOGIN] nchar(25) NULL ,
[TIME] nchar(25) NULL 
)


GO

-- ----------------------------
-- Records of T_LOGIN_ATTEMPS
-- ----------------------------
BEGIN TRANSACTION
GO
SET IDENTITY_INSERT [T_LOGIN_ATTEMPS] ON
GO
INSERT INTO [T_LOGIN_ATTEMPS] ([ID_ATTEMPS], [IP_ADDRESS], [LOGIN], [TIME]) VALUES (N'1', N'127.0.0.1                ', N'TEST                     ', N'TEST                     ')
GO
GO
SET IDENTITY_INSERT [T_LOGIN_ATTEMPS] OFF
GO
COMMIT TRANSACTION
GO

-- ----------------------------
-- Table structure for T_USUARIO_GRUPOS
-- ----------------------------
DROP TABLE [T_USUARIO_GRUPOS]
GO
CREATE TABLE [T_USUARIO_GRUPOS] (
[ID_USUARIO_GRUPOS] int NOT NULL IDENTITY(1,1) ,
[ID_USUARIO] int NULL ,
[ID_GRUPO] int NULL 
)


GO
DBCC CHECKIDENT(N'[T_USUARIO_GRUPOS]', RESEED, 1004)
GO

-- ----------------------------
-- Records of T_USUARIO_GRUPOS
-- ----------------------------
BEGIN TRANSACTION
GO
SET IDENTITY_INSERT [T_USUARIO_GRUPOS] ON
GO
INSERT INTO [T_USUARIO_GRUPOS] ([ID_USUARIO_GRUPOS], [ID_USUARIO], [ID_GRUPO]) VALUES (N'1', N'1', N'1'), (N'2', N'1', N'2'), (N'3', N'1', N'3'), (N'1004', N'3', N'1')
GO
GO
SET IDENTITY_INSERT [T_USUARIO_GRUPOS] OFF
GO
COMMIT TRANSACTION
GO

-- ----------------------------
-- Table structure for T_USUARIOS
-- ----------------------------
DROP TABLE [T_USUARIOS]
GO
CREATE TABLE [T_USUARIOS] (
[ID_USUARIO] int NOT NULL IDENTITY(1,1) ,
[IP_ADDRESS] nchar(25) NULL ,
[NOMBRE_USUARIO] nchar(20) NULL ,
[PASSWORD] nchar(100) NULL ,
[SALT] nchar(10) NULL ,
[EMAIL] nchar(50) NULL ,
[ACTIVATION_CODE] nchar(100) NULL ,
[FORGOTTEN_PASSWORD_CODE] nchar(50) NULL ,
[FORGOTTEN_PASSWORD_TIME] nchar(20) NULL ,
[REMEMBER_CODE] nchar(10) NULL ,
[CREATED_ON] nchar(20) NULL ,
[LAST_LOGIN] nchar(20) NULL ,
[ACTIVE] int NULL ,
[FIRST_NAME] nchar(100) NULL ,
[LAST_NAME] nchar(100) NULL ,
[COMPANY] nchar(25) NULL ,
[PHONE] nchar(25) NULL 
)


GO
DBCC CHECKIDENT(N'[T_USUARIOS]', RESEED, 3)
GO

-- ----------------------------
-- Records of T_USUARIOS
-- ----------------------------
BEGIN TRANSACTION
GO
SET IDENTITY_INSERT [T_USUARIOS] ON
GO
INSERT INTO [T_USUARIOS] ([ID_USUARIO], [IP_ADDRESS], [NOMBRE_USUARIO], [PASSWORD], [SALT], [EMAIL], [ACTIVATION_CODE], [FORGOTTEN_PASSWORD_CODE], [FORGOTTEN_PASSWORD_TIME], [REMEMBER_CODE], [CREATED_ON], [LAST_LOGIN], [ACTIVE], [FIRST_NAME], [LAST_NAME], [COMPANY], [PHONE]) VALUES (N'1', N'127.0.0.1                ', N'iezpinoza           ', N'$2y$08$eK7WJnQd5nUQvLX0btuwGOT3MZ/3T/zvu1Yd5VCf95lUJF2z7rWKG                                        ', null, N'ing.ezpinoza@gmail.com                            ', null, null, null, null, N'1268889823          ', N'1484165652          ', N'1', N'Ivan                                                                                                ', N'Espinoza                                                                                            ', N'Tecnoogia Aplicada       ', N'5512239821               '), (N'3', N'::1                      ', N'omare               ', N'$2y$08$QLPelwhxmMZis9RaBtot3.FSrwADQ3vXR6jfYq9vRrKd9QRHsPqKC                                        ', null, N'omar.xancopinca@nube.sep.gob.mx                   ', null, null, null, null, N'1484165668          ', null, N'1', N'Omar Eduardo                                                                                        ', N'Xancopinca                                                                                          ', N'SEP                      ', N'0                        ')
GO
GO
SET IDENTITY_INSERT [T_USUARIOS] OFF
GO
COMMIT TRANSACTION
GO

-- ----------------------------
-- Indexes structure for table sysdiagrams
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table sysdiagrams
-- ----------------------------
ALTER TABLE [sysdiagrams] ADD PRIMARY KEY ([diagram_id])
GO

-- ----------------------------
-- Uniques structure for table sysdiagrams
-- ----------------------------
ALTER TABLE [sysdiagrams] ADD UNIQUE ([principal_id] ASC, [name] ASC)
GO

-- ----------------------------
-- Indexes structure for table T_GRUPOS
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table T_GRUPOS
-- ----------------------------
ALTER TABLE [T_GRUPOS] ADD PRIMARY KEY ([ID_GRUPO])
GO

-- ----------------------------
-- Indexes structure for table T_LOGIN_ATTEMPS
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table T_LOGIN_ATTEMPS
-- ----------------------------
ALTER TABLE [T_LOGIN_ATTEMPS] ADD PRIMARY KEY ([ID_ATTEMPS])
GO

-- ----------------------------
-- Indexes structure for table T_USUARIO_GRUPOS
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table T_USUARIO_GRUPOS
-- ----------------------------
ALTER TABLE [T_USUARIO_GRUPOS] ADD PRIMARY KEY ([ID_USUARIO_GRUPOS])
GO

-- ----------------------------
-- Indexes structure for table T_USUARIOS
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table T_USUARIOS
-- ----------------------------
ALTER TABLE [T_USUARIOS] ADD PRIMARY KEY ([ID_USUARIO])
GO

-- ----------------------------
-- Foreign Key structure for table [T_USUARIO_GRUPOS]
-- ----------------------------
ALTER TABLE [T_USUARIO_GRUPOS] ADD FOREIGN KEY ([ID_GRUPO]) REFERENCES [T_GRUPOS] ([ID_GRUPO]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [T_USUARIO_GRUPOS] ADD FOREIGN KEY ([ID_USUARIO]) REFERENCES [T_USUARIOS] ([ID_USUARIO]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
