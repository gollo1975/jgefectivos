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
        <div >
        <br>
            <div class="lbmenu">
               <a href="menuinformacion.php?tipoM=PROCESOS"><font size=3>+</font></a> PROCESOS
            </div>
            <?
            if ($tipoMenu=="PROCESOS")
            {
            ?>
            <div class="itemmenu">
               <a href="menuinformacion.php?op=procesar" target="contenido">Procesar</a><Br>
			   <a href="formatoDigital/procesos.php?opc=3&UsuarioSistema=<?echo $xsession;?>" target="contenido">Solicitudes Sistemas</a><Br>	
				<a href="solicitudSS/consultaSolicitud.php" target="contenido">Solicitudes Seguridad Social</a><Br>			
				<a href="solicitudSS/procesos.php?opc=3" target="contenido">Solicitudes Pendientes</a><Br>			
			    
               </div>
            <?
            }
            ?>
            <div class="lbmenu">
                <a href="menuinformacion.php?tipoM=COSTO"><font size=3>+</font></a>COSTOS
            </div>
            <?
            if ($tipoMenu=="COSTO")
            {
            ?>
            <div class="itemmenu">
                <a href="menuinformacion.php?op=curso" target="contenido">Curso de Cooperativismo</a><br>
                <a href="menuinformacion.php?op=examen" target="contenido">Examenes de Ingreso</a><br>
                <a href="control/control/fachada.php?opc=50" target="contenido">Empleados de Planta</a><br>
				<a href="control/control/fachada.php?opc=16" target="contenido">Visitantes</a><br>
            </div>
            <?
            }
            ?>
            <div class="lbmenu">
                <a href="menuinformacion.php?tipoM=CONSULTA"><font size=3>+</font></a>CONSULTA
            </div>
            <?
            if ($tipoMenu=="CONSULTA")
            {
            ?>
            <div class="itemmenu">
                <a href="menuinformacion.php?op=carne" target="contenido">Carnet de Empleado</a><br>
               	<a href="menuinformacion.php?op=cursoecho" target="contenido">Curso Cooperativo</a><br>			
                <a href="menuinformacion.php?op=emple&op1admemp" target="contenido">Empleado por</a><br>
				<a href="contrato/listadocon.php" target="contenido">Contrato de Trabajo</a><br>
                <a href="menuinformacion.php?op=conexamen" target="contenido">Examenes Médicos</a><br>				
                <a href="menuinformacion.php?op=funera" target="contenido">Funeraria Por</a><br>				
                <a href="menuinformacion.php?op=listar" target="contenido">Listar Información de </a><br>
                <a href="menuinformacion.php?op=prove" target="contenido">Proveedor Por</a><br>
                <a href="menuinformacion.php?op=conregistro" target="contenido">Registros Visitante</a><br>				
                </div>
            <?
            }
            ?>
            <div class="lbmenu">
                <a href="menuinformacion.php?tipoM=REPORTES"><font size=3>+</font></a>REPORTES
            </div>
            <?
            if ($tipoMenu=="REPORTES")
            {
            ?>
            <div class="itemmenu">
                <a href="menuinformacion.php?op=aporteso" target="contenido">Aporte Social Por</a><br>
                <a href="menuinformacion.php?op=asocia&op1admemp" target="contenido">Empleado por</a><br>
                <a href="menuinformacion.php?op=exporte" target="contenido">Exportar Archivos</a><br>				
                <a href="menuinformacion.php?op=merca" target="contenido">Mercado por</a><br>
                <a href="menuinformacion.php?op=planilla" target="contenido">Planilla de Nomina</a><br>
                <a href="menuinformacion.php?op=retiroaso" target="contenido">Retiro de Empleado</a><br>
            </div>
            <?
             }
             ?>
           <div class="lbmenu">
                <a href="menuinformacion.php?tipoM=UTILIDADES"><font size=3>+</font></a>UTILIDADES
            </div>
            <?
            if ($tipoMenu=="UTILIDADES")
            {
            ?>
            <div class="itemmenu">
                <a href="menuinformacion.php?op=clave&op1admemp" target="contenido"><b>Cambio de Clave</b></a><br>
           </div>
           <?
           }
           ?>
             <div class="lbmenu">
                <a href="menuinformacion.php?tipoM=SALIR"><font size=3>+</font></a>CERRAR SESION
            </div>
            <?
            if ($tipoMenu=="SALIR")
            {
            ?>
            <div class="itemmenu">
                <a href="menuinformacion.php?op=salir&op1admemp" target="contenido"><b>Salir</b></a><br>
            </div>
            <?
            }
            ?>
          </div>
         </div>
        <div >
          <br><br>
         <?
    }
    /*menu archivo*/
    if ($opcion=="procesar")
        include ("menuprocesar1.php");

     /*menu COSTO*/

    if ($opcion=="curso")
        include ("curso/menu.php");
    if ($opcion=="examen")
        include ("examen/menu.php");

           /*menu consulta*/
      if ($opcion=="emple")
        include ("menuempleEstandar.php");
      if ($opcion=="contra")
        include ("contrato/menu1.php");  
     if ($opcion=="listar")
        include ("menulistar.php");
		
	if ($opcion=="contra")
        include ("contrato/listadocon.php");
		
     if ($opcion=="carne")
        include ("carnet/menu1.php");
      if ($opcion=="listarzo")
        include ("listarzona/menu1.php");
      if ($opcion=="prove")
        include ("proveedor/menu2.php");  
     if ($opcion=="funera")
       include ("funeraria/menu1.php");
     if ($opcion=="cursoecho")
        include ("curso/menu1.php");
      if ($opcion=="conexamen")
        include ("examen/menu2.php");
      if ($opcion=="conregistro")
        include ("ingreso/menuconsulta.php");  
      /*menu reporte*/
       if ($opcion=="asocia")
        include ("meneasociado.php");
       if ($opcion=="merca")
        include ("mercado/menu1.php");
       if ($opcion=="aporteso")
        include ("entrega/menu1.php");
       if ($opcion=="retiroaso")
        include ("retiro/menu1.php");
       if ($opcion=="planilla")
        include ("planilla/menu.php");
       if ($opcion=="exporte")
          include ("exportacion/menuAuxiliar.php");

          /*menu utilidades*/
        if ($opcion=="clave")
        include ("acceso/menu1.php");
        if ($opcion=="salir")
        include ("salir.php");
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
