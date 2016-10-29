-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.16


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Definition of table `accesonomina`
--

DROP TABLE IF EXISTS `accesonomina`;
CREATE TABLE `accesonomina` (
  `usuario` char(30) NOT NULL,
  `clave` char(40) NOT NULL,
  `idRol` int(5) unsigned zerofill NOT NULL,
  PRIMARY KEY (`usuario`),
  KEY `FK_accesonomina_1` (`idRol`),
  CONSTRAINT `FK_accesonomina_1` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accesonomina`
--

/*!40000 ALTER TABLE `accesonomina` DISABLE KEYS */;
INSERT INTO `accesonomina` (`usuario`,`clave`,`idRol`) VALUES 
 ('900456778','7c222fb2927d828af22f592134e8932480637c0d',00001);
/*!40000 ALTER TABLE `accesonomina` ENABLE KEYS */;


--
-- Definition of table `ausencia`
--

DROP TABLE IF EXISTS `ausencia`;
CREATE TABLE `ausencia` (
  `idAusencia` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `codEmple` char(5) NOT NULL,
  `fechaSolicitud` date NOT NULL,
  `fechaPermiso` date NOT NULL,
  `codEmpleAutoriza` char(5) NOT NULL,
  `departamento` char(100) NOT NULL,
  `totalHoras` int(10) unsigned NOT NULL,
  `observacion` text NOT NULL,
  PRIMARY KEY (`idAusencia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ausencia`
--

/*!40000 ALTER TABLE `ausencia` DISABLE KEYS */;
/*!40000 ALTER TABLE `ausencia` ENABLE KEYS */;


--
-- Definition of table `controlingreso`
--

DROP TABLE IF EXISTS `controlingreso`;
CREATE TABLE `controlingreso` (
  `idControl` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `cedula` char(10) NOT NULL,
  PRIMARY KEY (`idControl`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `controlingreso`
--

/*!40000 ALTER TABLE `controlingreso` DISABLE KEYS */;
/*!40000 ALTER TABLE `controlingreso` ENABLE KEYS */;


--
-- Definition of table `detallehorario`
--

DROP TABLE IF EXISTS `detallehorario`;
CREATE TABLE `detallehorario` (
  `idDetelleHorario` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nitZona` char(15) NOT NULL,
  `cedEmple` char(10) NOT NULL,
  `idHorario` int(5) unsigned zerofill NOT NULL,
  `idPeriodo` int(5) unsigned zerofill NOT NULL,
  PRIMARY KEY (`idDetelleHorario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detallehorario`
--

/*!40000 ALTER TABLE `detallehorario` DISABLE KEYS */;
/*!40000 ALTER TABLE `detallehorario` ENABLE KEYS */;


--
-- Definition of table `horario`
--

DROP TABLE IF EXISTS `horario`;
CREATE TABLE `horario` (
  `idHorario` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nombreHorario` char(40) NOT NULL,
  `horarioInicial` char(10) NOT NULL,
  `idTipoI` int(5) unsigned zerofill NOT NULL,
  `horarioFinal` char(10) NOT NULL,
  `idTipoF` int(5) unsigned zerofill NOT NULL,
  `observacion` text NOT NULL,
  `idJornada` int(5) unsigned zerofill NOT NULL,
  `estado` char(10) NOT NULL,
  PRIMARY KEY (`idHorario`),
  KEY `FK_horario_1` (`idJornada`),
  KEY `FK_horario_2` (`idTipoI`),
  KEY `FK_horario_3` (`idTipoF`),
  CONSTRAINT `FK_horario_1` FOREIGN KEY (`idJornada`) REFERENCES `jornada` (`idJornada`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `horario`
--

/*!40000 ALTER TABLE `horario` DISABLE KEYS */;
/*!40000 ALTER TABLE `horario` ENABLE KEYS */;


--
-- Definition of table `jornada`
--

DROP TABLE IF EXISTS `jornada`;
CREATE TABLE `jornada` (
  `idJornada` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nombreJornada` char(50) NOT NULL,
  `dial` char(2) NOT NULL,
  `diam` char(2) NOT NULL,
  `diaw` char(2) NOT NULL,
  `diaj` char(2) NOT NULL,
  `diav` char(2) NOT NULL,
  `dias` char(2) NOT NULL,
  `diad` char(2) NOT NULL,
  `observacion` text NOT NULL,
  `estado` char(10) NOT NULL,
  PRIMARY KEY (`idJornada`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jornada`
--

/*!40000 ALTER TABLE `jornada` DISABLE KEYS */;
/*!40000 ALTER TABLE `jornada` ENABLE KEYS */;


--
-- Definition of table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `idMenu` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nombreMenu` char(80) NOT NULL,
  PRIMARY KEY (`idMenu`)
) ENGINE=InnoDB AUTO_INCREMENT=901 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`idMenu`,`nombreMenu`) VALUES 
 (00010,'Jornadas'),
 (00020,'Horarios'),
 (00030,'Zonas'),
 (00040,'Rol'),
 (00050,'Permisos'),
 (00060,'Empleado'),
 (00070,'Periodos de Horarios'),
 (00900,'Cerrar Sesion');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;


--
-- Definition of table `movimientoingreso`
--

DROP TABLE IF EXISTS `movimientoingreso`;
CREATE TABLE `movimientoingreso` (
  `idMovimiento` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `horas` time NOT NULL,
  `fecha` date NOT NULL,
  `totalhoras` int(10) unsigned NOT NULL,
  `totalminutos` int(10) unsigned NOT NULL,
  `cedula` char(10) NOT NULL,
  PRIMARY KEY (`idMovimiento`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movimientoingreso`
--

/*!40000 ALTER TABLE `movimientoingreso` DISABLE KEYS */;
/*!40000 ALTER TABLE `movimientoingreso` ENABLE KEYS */;


--
-- Definition of table `periodocontrol`
--

DROP TABLE IF EXISTS `periodocontrol`;
CREATE TABLE `periodocontrol` (
  `idPeriodo` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `fechaInicio` date NOT NULL,
  `fechaFinal` date NOT NULL,
  `nitZona` char(20) NOT NULL,
  PRIMARY KEY (`idPeriodo`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `periodocontrol`
--

/*!40000 ALTER TABLE `periodocontrol` DISABLE KEYS */;
/*!40000 ALTER TABLE `periodocontrol` ENABLE KEYS */;


--
-- Definition of table `permiso`
--

DROP TABLE IF EXISTS `permiso`;
CREATE TABLE `permiso` (
  `idPermiso` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `idSubmenu` int(5) unsigned zerofill NOT NULL,
  `usuario` char(20) NOT NULL,
  `estado` char(10) NOT NULL,
  PRIMARY KEY (`idPermiso`),
  KEY `FK_permiso_1` (`idSubmenu`),
  KEY `FK_permiso_2` (`usuario`),
  CONSTRAINT `FK_permiso_1` FOREIGN KEY (`idSubmenu`) REFERENCES `submenu` (`idSubMenu`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_permiso_2` FOREIGN KEY (`usuario`) REFERENCES `accesonomina` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permiso`
--

/*!40000 ALTER TABLE `permiso` DISABLE KEYS */;
INSERT INTO `permiso` (`idPermiso`,`idSubmenu`,`usuario`,`estado`) VALUES 
 (00016,00901,'900456778','Activo'),
 (00017,00051,'900456778','Activo'),
 (00018,00011,'900456778','Activo'),
 (00019,00012,'900456778','Activo'),
 (00020,00021,'900456778','Activo'),
 (00021,00022,'900456778','Activo'),
 (00022,00023,'900456778','Activo'),
 (00023,00031,'900456778','Activo'),
 (00024,00041,'900456778','Activo'),
 (00025,00042,'900456778','Activo'),
 (00026,00052,'900456778','Activo'),
 (00027,00053,'900456778','Activo'),
 (00028,00061,'900456778','Activo'),
 (00029,00062,'900456778','Activo'),
 (00030,00071,'900456778','Activo');
/*!40000 ALTER TABLE `permiso` ENABLE KEYS */;


--
-- Definition of table `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE `rol` (
  `idRol` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nombreRol` char(40) NOT NULL,
  `estado` char(10) NOT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rol`
--

/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` (`idRol`,`nombreRol`,`estado`) VALUES 
 (00001,'Administrador','Activo'),
 (00002,'Usuario','Activo');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;


--
-- Definition of table `submenu`
--

DROP TABLE IF EXISTS `submenu`;
CREATE TABLE `submenu` (
  `idSubMenu` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `idMenu` int(5) unsigned zerofill NOT NULL,
  `nombreSubMenu` char(80) NOT NULL,
  `url` char(100) NOT NULL,
  PRIMARY KEY (`idSubMenu`),
  KEY `FK_submenu_1` (`idMenu`),
  CONSTRAINT `FK_submenu_1` FOREIGN KEY (`idMenu`) REFERENCES `menu` (`idMenu`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=902 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submenu`
--

/*!40000 ALTER TABLE `submenu` DISABLE KEYS */;
INSERT INTO `submenu` (`idSubMenu`,`idMenu`,`nombreSubMenu`,`url`) VALUES 
 (00011,00010,'Ingreso de Jornadas','../vista/insertarJornada.php'),
 (00012,00010,'Listado de Jornadas','../control/procesos.php?opc=3'),
 (00021,00020,'Ingreso de Horarios','../control/procesos.php?opc=21'),
 (00022,00020,'Listado de Horarios','../control/procesos.php?opc=23'),
 (00023,00020,'Asignación de Horarios','../control/procesos.php?opc=113'),
 (00031,00030,'Listado de Zonas','../control/procesos.php?opc=73'),
 (00041,00040,'Ingreso de Roles','../vista/insertarRol.php'),
 (00042,00040,'Listado de Roles','../control/procesos.php?opc=43'),
 (00051,00050,'Ingreso de Permisos','../control/procesos.php?opc=51'),
 (00052,00050,'Listado de Permisos','../control/procesos.php?opc=53'),
 (00053,00050,'Cambio de Contraseña','../vista/cambiarAcceso.php'),
 (00061,00060,'Listado de Empleados','../control/procesos.php?opc=83'),
 (00062,00060,'Permisos y/o Ausencias','../control/procesos.php?opc=101'),
 (00071,00070,'Ingreso de Periodos de Pago','../vista/insertarPeriodo.php'),
 (00901,00900,'Cerrar Sesion','../control/session.php');
/*!40000 ALTER TABLE `submenu` ENABLE KEYS */;


--
-- Definition of table `tipohorario`
--

DROP TABLE IF EXISTS `tipohorario`;
CREATE TABLE `tipohorario` (
  `idTipo` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nombreTipo` char(2) NOT NULL,
  PRIMARY KEY (`idTipo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipohorario`
--

/*!40000 ALTER TABLE `tipohorario` DISABLE KEYS */;
INSERT INTO `tipohorario` (`idTipo`,`nombreTipo`) VALUES 
 (00004,'AM'),
 (00005,'PM');
/*!40000 ALTER TABLE `tipohorario` ENABLE KEYS */;


--
-- Definition of procedure `consultarAcceso`
--

DROP PROCEDURE IF EXISTS `consultarAcceso`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarAcceso`(in _usuario char(30), in _clave char(40))
BEGIN
  select usuario, clave from accesonomina where usuario = _usuario and clave = sha1(_clave);
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `consultarDetalleHorario`
--

DROP PROCEDURE IF EXISTS `consultarDetalleHorario`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarDetalleHorario`(in _cedEmple char(10), in _idPeriodo int (5))
BEGIN
  select cedEmple, idPeriodo from detallehorario where cedEmple = _cedEmple and idPeriodo = _idPeriodo;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `consultarHorario`
--

DROP PROCEDURE IF EXISTS `consultarHorario`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarHorario`(in _nombreHorario char(40))
BEGIN
  select nombreHorario from horario where nombreHorario = _nombreHorario;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `consultarIngreso`
--

DROP PROCEDURE IF EXISTS `consultarIngreso`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarIngreso`(in _cedula char(10))
BEGIN
  select cedemple from empleado where cedemple =  _cedula;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `consultarJornada`
--

DROP PROCEDURE IF EXISTS `consultarJornada`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarJornada`(in _nombreJornada char(40))
BEGIN
  select nombreJornada from jornada where nombreJornada = _nombreJornada;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `consultarPeriodo`
--

DROP PROCEDURE IF EXISTS `consultarPeriodo`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarPeriodo`(in _fechaInicio date, in _nitZona char (15))
BEGIN
  select fechaInicio, nitZona from periodocontrol where fechaInicio = _fechaInicio and nitZona = _nitZona;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `consultarPermiso`
--

DROP PROCEDURE IF EXISTS `consultarPermiso`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarPermiso`(in _idSubMenu int (5), in _usuario char(20))
BEGIN
  select idSubmenu, usuario from Permiso where usuario = _usuario and idSubMenu = _idSubMenu;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `consultarRol`
--

DROP PROCEDURE IF EXISTS `consultarRol`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarRol`(in _nombreRol char(40))
BEGIN
  select nombreRol from rol where nombreRol = _nombreRol;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `consultarZona`
--

DROP PROCEDURE IF EXISTS `consultarZona`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarZona`(in _nitZona char(15))
BEGIN
  select usuario from accesonomina where usuario = _nitZona;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `generarZona`
--

DROP PROCEDURE IF EXISTS `generarZona`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `generarZona`(in _nitzona char(15))
BEGIN
  insert into accesonomina (usuario, clave, idRol) select nitzona, sha1(nitzona), '00002' from zona where nitzona = _nitzona;

  insert into permiso (idSubMenu, usuario, estado) select '00901', nitzona, 'Activo' from zona where nitzona =  _nitzona;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `insertarAusencia`
--

DROP PROCEDURE IF EXISTS `insertarAusencia`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarAusencia`(in _codEmple char(5), in _fechaSolicitud date, in _fechaPermiso date, in _totalHoras int (2), in _codEmpleAutoriza char(5), in _departamento char(100), in _observacion text)
BEGIN
insert into ausencia (codEmple, fechaSolicitud, fechaPermiso, totalHoras, codEmpleAutoriza, departamento, observacion) values (_codEmple, _fechaSolicitud, _fechaPermiso, _totalHoras, _codEmpleAutoriza, _departamento, _observacion);
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `insertarDetalleHorario`
--

DROP PROCEDURE IF EXISTS `insertarDetalleHorario`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarDetalleHorario`(in _nitZona char(15), in _cedEmple char(10), in _idHorario int(5), in _idPeriodo int (5))
BEGIN
  insert into detallehorario (nitZona, cedEmple, idHorario, idPeriodo) values (_nitZona, _cedEmple, _idHorario, _idPeriodo);
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `insertarHorario`
--

DROP PROCEDURE IF EXISTS `insertarHorario`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarHorario`(in _nombreHorario char(40), in _horarioInicial char (10), in _idTipoI int(5), in _horarioFinal char(10), in _idTipoF int(5), in _observacion text, in _idJornada int(5), in _estado char(10))
BEGIN
  insert into horario (nombreHorario, horarioInicial, idTipoI, horarioFinal, idTipoF, observacion, idJornada, estado) values (_nombreHorario, _horarioInicial, _idTipoI, _horarioFinal, _idTipoF, _observacion, _idJornada, _estado);
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `insertarIngreso`
--

DROP PROCEDURE IF EXISTS `insertarIngreso`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarIngreso`(in _fecha date, in _hora time, in _cedula char(10))
BEGIN
  insert into controlIngreso (fecha, hora, cedula) values (_fecha, _hora, _cedula);
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `insertarJornada`
--

DROP PROCEDURE IF EXISTS `insertarJornada`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarJornada`(in _nombreJornada char(40), in _dial char(2), in _diam char(2), in _diaw char(2), in _diaj char(2), in _diav char(2), in _dias char(2), in _diad char(2), in _observacion text, in _estado char(10))
BEGIN
  insert into jornada (nombreJornada, dial, diam, diaw, diaj, diav, dias, diad, observacion, estado) values (_nombreJornada, _dial, _diam, _diaw, _diaj, _diav, _dias, _diad, _observacion, _estado);
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `insertarPeriodo`
--

DROP PROCEDURE IF EXISTS `insertarPeriodo`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarPeriodo`(in _fechaInicio date, in _fechaFinal date , in _nitZona char(15))
BEGIN
  insert into periodocontrol (fechaInicio, fechaFinal, nitZona) values (_fechaInicio, _fechaFinal, _nitZona);
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `insertarPermiso`
--

DROP PROCEDURE IF EXISTS `insertarPermiso`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarPermiso`(in _idSubMenu int (5), in _usuario char(20), in _estado char(10))
BEGIN
  insert into permiso (idSubMenu, usuario, estado) values (_idSubMenu, _usuario, _estado);
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `insertarRol`
--

DROP PROCEDURE IF EXISTS `insertarRol`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarRol`(in _nombreRol char(40), in _estado char(10))
BEGIN
  insert into rol (nombreRol, estado) values (_nombreRol, _estado);
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `listarAsignacionPeriodo`
--

DROP PROCEDURE IF EXISTS `listarAsignacionPeriodo`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `listarAsignacionPeriodo`()
BEGIN
  select idPeriodo, fechaInicio, fechaFinal, nitZona from periodocontrol where fechaInicio >= current_date();
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `listarEmpleado`
--

DROP PROCEDURE IF EXISTS `listarEmpleado`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `listarEmpleado`(in _usuario char(20))
BEGIN
  select empleado.cedemple, empleado.codemple, empleado.nomemple, empleado.nomemple1, empleado.apemple, empleado.apemple1, movimientoingreso.fecha, movimientoingreso.horas from empleado inner join zona on empleado.codzona = zona.codzona left join movimientoingreso on movimientoingreso.cedula = empleado.cedemple where zona.nitzona = _usuario group by empleado.cedemple;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `listarEmpleadoAusencia`
--

DROP PROCEDURE IF EXISTS `listarEmpleadoAusencia`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `listarEmpleadoAusencia`(in _usuario char(20))
BEGIN
  select distinct empleado.cedemple, empleado.codemple, empleado.nomemple, empleado.nomemple1, empleado.apemple, empleado.apemple1, movimientoingreso.fecha, movimientoingreso.horas from empleado inner join zona on empleado.codzona = zona.codzona inner join movimientoingreso on movimientoingreso.cedula = empleado.cedemple where zona.nitzona = _usuario group by empleado.codemple;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `listarHorario`
--

DROP PROCEDURE IF EXISTS `listarHorario`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `listarHorario`()
BEGIN
  select horario.idHorario, horario.nombreHorario, horario.horarioInicial, horario.idTipoI, horario.horarioFinal, horario.idTipoF, horario.observacion, jornada.idJornada, jornada.nombreJornada from horario inner join jornada on horario.idJornada =  jornada.idJornada where horario.estado = 'Activo';
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `listarJornada`
--

DROP PROCEDURE IF EXISTS `listarJornada`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `listarJornada`()
BEGIN
  select idJornada, nombreJornada, dial, diam, diaw, diaj, diav, dias, diad, observacion from jornada where estado = 'Activo';
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `listarPermiso`
--

DROP PROCEDURE IF EXISTS `listarPermiso`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `listarPermiso`()
BEGIN
  select permiso.idPermiso, zona.nitzona, zona.zona, submenu.idSubMenu, submenu.nombreSubMenu from zona inner join permiso on zona.nitzona = permiso.usuario inner join submenu on permiso.idSubMenu = submenu.idSubMenu where permiso.estado = 'Activo';
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `listarRol`
--

DROP PROCEDURE IF EXISTS `listarRol`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `listarRol`()
BEGIN
  select idRol, nombreRol from rol where estado = 'Activo';
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `listarSubMenu`
--

DROP PROCEDURE IF EXISTS `listarSubMenu`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `listarSubMenu`()
BEGIN
  select * from submenu;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `listarTipo`
--

DROP PROCEDURE IF EXISTS `listarTipo`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `listarTipo`()
BEGIN
  select * from tipohorario;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `listarZona`
--

DROP PROCEDURE IF EXISTS `listarZona`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `listarZona`()
BEGIN
  select codzona, zona, nitzona from zona where estado = 'Activa';
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `listarZonaPermisos`
--

DROP PROCEDURE IF EXISTS `listarZonaPermisos`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `listarZonaPermisos`()
BEGIN
  select zona.codzona, zona.zona, zona.nitzona from zona inner join accesonomina on zona.nitzona = accesonomina.usuario where zona.estado = 'Activa';
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `modificarAcceso`
--

DROP PROCEDURE IF EXISTS `modificarAcceso`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarAcceso`(in _usuario char(30), in _clave char(40), in _claveNueva char(40))
BEGIN
  update Accesonomina set clave = _claveNueva where usuario = _usuario and clave = sha1(_clave);
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `validar`
--

DROP PROCEDURE IF EXISTS `validar`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `validar`(in _usuario char(20), in _clave char(40))
BEGIN
  select usuario, clave from accesonomina where usuario = _usuario and clave = sha1(_clave);
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
