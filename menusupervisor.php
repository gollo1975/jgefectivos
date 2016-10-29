<?
 session_start();
?>
<html>
  <head>
  <title>JGEFECTIVOS S.A.S. Empresa de Servicios Temporales</title>
  <LINK  REL="stylesheet" HREF="estilo.css"  type="text/css">
  </head>
  <body>
   <?
  if(session_is_registered("xsession")):
?>
  <?php
    include("conexion.php");
    $opcion = $_GET['op'];
    $tipoMenu = $_GET['tipoM'];
    if (trim($opcion) == "")
    {
      ?>
          <div class="lbmenu">
                <a href="menusupervisor.php?tipoM=COSTO"><font size=3>+</font></a>COSTO
            </div>
            <?
            if ($tipoMenu=="COSTO")
            {
            ?>
            <div class="itemmenu">
                <a href="menuseguridad.php?op=funeraria" target="contenido">Afiliado Funeraria</a><br>
                <a href="menuseguridad.php?op=conveniocarta" target="contenido">Contrato Temporal</a><br>
                <a href="menuseguridad.php?op=carnet" target="contenido">Entrega de Carnet</a><br>
                <a href="menuseguridad.php?op=examen&CodUsuario=<?echo $xsession;?>" target="contenido">Examenes de Ingreso</a><br>
                <a href="menuseguridad.php?op=incapa" target="contenido">Incapacidades</a><br>
				<a href="formatoDigital/procesos.php?opc=3&UsuarioSistema=<?echo $xsession;?>" target="contenido">Solicitudes Sistemas</a><Br>	
				<a href="../gestionCalidad/control/fachada.php?opc=3"  target="contenido">Gestion Documental CALIDAD</a><Br>	
				<a href="solicitudSS/consultaSolicitud.php" target="contenido">Solicitudes Seguridad Social</a><Br>			
				<a href="solicitudSS/procesos.php?opc=3" target="contenido">Solicitudes Pendientes</a><Br>
                				
            </div>
            <?
            }
	
      ?>
          <div class="lbmenu">
                <a href="menusupervisor.php?tipoM=RETIRO"><font size=3>+</font></a>RETIRO
            </div>
            <?
            if ($tipoMenu=="RETIRO")
            {
            ?>
            <div class="itemmenu">
                <a href="menusupervisor.php?op=carnet" target="contenido">Entrega de Carnet</a><br>
                <a href="menusupervisor.php?op=memorando&op1=admemp&admon=<?echo $xsession;?>" target="contenido">Memorando</a><br>
                <a href="menusupervisor.php?op=observa" target="contenido">Observaciones de retiro</a><br>
                <a href="menusupervisor.php?op=incapa" target="contenido">Incapacidades</a><br>
                <a href="menusupervisor.php?op=seguimiento" target="contenido">Seguimiento Incapacidad</a><br>
                </div>
            <?
            }
            ?>
            <div class="lbmenu">
                <a href="menusupervisor.php?tipoM=CONSULTA"><font size=3>+</font></a>CONSULTA
            </div>
            <?
            if ($tipoMenu=="CONSULTA")
            {
            ?>
            <div class="itemmenu">
                <a href="menusupervisor.php?op=carne" target="contenido">Carnet de Empleado</a><br>
				<a href="dianino/consultarEmpleado.php" target="contenido">Consultar Dia de Niños</a><br>			
                <a href="menusupervisor.php?op=contra" target="contenido">Contrato de Trabajo</a><br>							
                <a href="menusupervisor.php?op=cursoecho" target="contenido">Curso Cooperativo</a><br>	
				<a href="empresas/procesos.php?opc=5" target="contenido">Documentación Empleados</a><br>
                <a href="menusupervisor.php?op=emple&op1admemp" target="contenido">Empleado por</a><br>
				<a href="menusupervisor.php?op=conexamen&CodUsuario=<?echo $xsession;?>" target="contenido">Examenes Médicos</a><br>
                <a href="menusupervisor.php?op=funera" target="contenido">Funeraria Por</a><br>			
				<a href="dianino/procesos.php?opc=1" target="contenido">Listado de Dia de Niños</a><br>								
                <a href="menusupervisor.php?op=listar" target="contenido">Listar Información de </a><br>
                <a href="menusupervisor.php?op=memo" target="contenido">Memorandos</a><br>				
                <a href="menusupervisor.php?op=conregistro" target="contenido">Registros Visitante</a><br>				
				<a href="control/vista/consultaPlanta.php" target="contenido">Consulta Empleados Planta</a><br>
                <a href="menusupervisor.php?op=zon" target="contenido">Zonas Por Sucursal</a><br>
				<a href="control/control/fachada.php?opc=71&valor='03'" target="contenido">Consulta Visitantes en Espera</a><br>
            </div>
            <?
            }
            ?>
            <div class="lbmenu">
                <a href="menusupervisor.php?tipoM=REPORTES"><font size=3>+</font></a>REPORTES
            </div>
            <?
            if ($tipoMenu=="REPORTES")
            {
            ?>
            <div class="itemmenu">
                <a href="menusupervisor.php?op=aportesocial" target="contenido">Aporte Social Por</a><br>
                <a href="menusupervisor.php?op=cartal" target="contenido">Carta Laboral</a><br>
				<a href="incapacidad/consultaGeneralIncapacidad.php" target="contenido">Consulta General de Incapacides</a><br>
                <a href="menusupervisor.php?op=asocia&op1admemp" target="contenido">Empleado por</a><br>
                <a href="menusupervisor.php?op=exportar" target="contenido">Exportar Archivos</a><br>
                <a href="menusupervisor.php?op=merca" target="contenido">Mercado por</a><br>
                <a href="menusupervisor.php?op=presta" target="contenido">Prestaciones Sociales</a><br>
                <a href="menusupervisor.php?op=retiroaso" target="contenido">Retiro de Empleado</a><br>
            </div>
            <?
           }
           ?>
           <div class="lbmenu">
                <a href="menusupervisor.php?tipoM=UTILIDADES"><font size=3>+</font></a>UTILIDADES
            </div>
            <?
            if ($tipoMenu=="UTILIDADES")
            {
            ?>
            <div class="itemmenu">
                <a href="menusupervisor.php?op=clave&op1admemp" target="contenido"><b>Cambio de Clave</b></a><br>
           </div>
           <?
           }
           ?>
           <div class="lbmenu">
                <a href="menusupervisor.php?tipoM=SALIR"><font size=3>+</font></a>CERRAR SESION
            </div>
            <?
            if ($tipoMenu=="SALIR")
            {
            ?>
            <div class="itemmenu">
                <a href="menusupervisor.php?op=salir&op1admemp" target="contenido"><b>Salir</b></a><br>
            </div>
            <?
            }
            ?>
         </div>
        <div>
          <br><br>
         <?
     }
     /*menu retiro*/
      if ($opcion=="memorando")
        include ("memorando/menu.php");
       if ($opcion=="carnet")
        include ("carnet/menu.php");  
       if ($opcion=="incapa")
        include ("incapacidad/menuseguridad.php");
      if ($opcion=="seguimiento")
        include ("incapacidad/menu3.php");
      if ($opcion=="observa")
        include ("contrato/menu2.php");
      /*menu consulta*/
        if ($opcion=="emple")
        include ("menuempleSeleccion.php");
     if ($opcion=="contra")
        include ("contrato/menu1.php");
     if ($opcion=="zon")
        include ("zona/menu1.php");
     if ($opcion=="listar")
        include ("menulistar.php");
       if ($opcion=="memo")
        include ("memorando/menu1.php");   
      if ($opcion=="carne")
        include ("carnet/menu1.php");
      if ($opcion=="listarzo")
        include ("listarzona/menu1.php");
       if ($opcion=="conexamen")
        include ("examen/menu2.php");	
      if ($opcion=="funera")
        include ("funeraria/menu1.php");
        if ($opcion=="cursoecho")
        include ("curso/menu1.php");
      if ($opcion=="conregistro")
        include ("ingreso/menuconsulta.php");  
        /*menu reporte*/
       if ($opcion=="asocia")
        include ("meneasociado.php");
       if ($opcion=="merca")
        include ("mercado/menu1.php");
        if ($opcion=="creditopor")
        include ("pagocredito/menu1.php");
        if ($opcion=="cartal")
          include ("cartalaboral/menu1.php");
        if ($opcion=="retiroaso")
        include ("retiro/menu1.php");
        if ($opcion=="aportesocial")
        include ("entrega/menu1.php");
        if ($opcion=="presta")
          include ("menuprestacion.php");
        if ($opcion=="prim")
        include ("vacaciones/menu3.php");
        if ($opcion=="exportar")
        include ("exportacion/menuAuxiliar.php");
        /*menu utilidades*/
        if ($opcion=="salir")
        include ("salir.php");
        if ($opcion=="clave")
        include ("acceso/menu1.php");
     ?>
        </div>
         <?
else:
?>
  <script language="javascript">
   alert("Cargando La Base de Datos con el Servidor")
   pagina='acceso/agregar.php'
   tiempo=10
   ubicacion='_self'
   setTimeout("open(pagina,ubicacion)",tiempo)
  </script>
  <?
endif;
?>
   </body>
</html>
