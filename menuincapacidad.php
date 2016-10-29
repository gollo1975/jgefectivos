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
                <a href="menuincapacidad.php?tipoM=ARCHIVO"><font size=3>+</font></a>ARCHIVO
            </div>
            <?
            if ($tipoMenu=="ARCHIVO")
            {
            ?>
            <div class="itemmenu">
                <a href="menuincapacidad.php?op=carpeta" target="contenido">Entrega Carpeta</a><br>
                <a href="menuincapacidad.php?op=detallado" target="contenido">Detalle Empleado</a><br>
				<a href="formatoDigital/procesos.php?opc=3&UsuarioSistema=<?echo $xsession;?>" target="contenido">Solicitudes Sistemas</a><Br>	
				<a href="solicitudSS/consultaSolicitud.php" target="contenido">Solicitudes Seguridad Social</a><Br>			
				<a href="solicitudSS/procesos.php?opc=3" target="contenido">Solicitudes Pendientes</a><Br>			
				
            </div>
            <?
            }
            ?>
            <div class="lbmenu">
                <a href="menuincapacidad.php?tipoM=CONSULTA"><font size=3>+</font></a>CONSULTA
            </div>
            <?
            if ($tipoMenu=="CONSULTA")
            {
            ?>
            <div class="itemmenu">
                <a href="menuincapacidad.php?op=carne" target="contenido">Carnet de Empleado</a><br>
                <a href="menuincapacidad.php?op=carpetas" target="contenido">Carpetas Empleados</a><br>	
                <a href="menuincapacidad.php?op=contra" target="contenido">Contrato de Trabajo</a><br>
                <a href="menuincapacidad.php?op=cursoecho" target="contenido">Curso en Alturas</a><br>
				<a href="empresas/procesos.php?opc=5" target="contenido">Documentación Empleados</a><br>								
                <a href="menuincapacidad.php?op=emple&op1admemp" target="contenido">Empleado por</a><br>
				<a href="archivo/procesos.php?opc=1" target="contenido">Empleados sin Beneficiarios</a><br>								
                <a href="menuincapacidad.php?op=conexamen" target="contenido">Examenes Médicos</a><br>				
                <a href="menuincapacidad.php?op=funera" target="contenido">Funeraria Por</a><br>
                <a href="menuincapacidad.php?op=memo" target="contenido">Memorando</a><br>
                <a href="menuincapacidad.php?op=prove" target="contenido">Proveedor Por</a><br>
                <a href="menuincapacidad.php?op=zon" target="contenido">Zonas Por Sucursal</a><br>
                <a href="control/control/fachada.php?opc=71&valor='03'" target="contenido">Consulta Visitantes en Espera</a><br>		
            </div>
            <?
            }
            ?>
            <div class="lbmenu">
                <a href="menuincapacidad.php?tipoM=REPORTES"><font size=3>+</font></a>REPORTES
            </div>
            <?
            if ($tipoMenu=="REPORTES")
            {
            ?>
            <div class="itemmenu">
                <a href="menuincapacidad.php?op=aporteso" target="contenido">Aporte Social Por</a><br>
                <a href="menuincapacidad.php?op=cartal" target="contenido">Carta Laboral</a><br>				
                <a href="menuincapacidad.php?op=asocia&op1admemp" target="contenido">Empleado por</a><br>
                <a href="menuincapacidad.php?op=exportar" target="contenido">Exportar Archivos</a><br>
                <a href="menuincapacidad.php?op=merca" target="contenido">Mercado por</a><br>
                <a href="menuincapacidad.php?op=contratistas" target="contenido">Subcontratos</a><br>
                <a href="menuincapacidad.php?op=retiroaso" target="contenido">Retiro de Empleado</a><br>
            </div>
            <?
           }
           ?>
           <div class="lbmenu">
                <a href="menuincapacidad.php?tipoM=UTILIDADES"><font size=3>+</font></a>UTILIDADES
            </div>
            <?
            if ($tipoMenu=="UTILIDADES")
            {
            ?>
            <div class="itemmenu">
                <a href="menuincapacidad.php?op=clave&op1admemp" target="contenido"><b>Cambio de Clave</b></a><br>
           </div>
           <?
           }
           ?>
           <div class="lbmenu">
                <a href="menuincapacidad.php?tipoM=SALIR"><font size=3>+</font></a>CERRAR SESION
            </div>
            <?
            if ($tipoMenu=="SALIR")
            {
            ?>
            <div class="itemmenu">
                <a href="menuincapacidad.php?op=salir&op1admemp" target="contenido"><b>Salir</b></a><br>
            </div>
            <?
            }
            ?>
         </div>
        <div>
          <br><br>
         <?
     }
       /*ARCHIVO*/
        if ($opcion=="carpeta")
        include ("inventario/menuCarpeta.php");
        if ($opcion=="detallado")
        include ("empleado/menudetalleIncapa.php");
           /*menu consulta*/
       if ($opcion=="emple")
        include ("menuempleEstandar.php");
     if ($opcion=="contra")
        include ("contrato/menu1.php");
     if ($opcion=="zon")
        include ("zona/menu1.php");
     if ($opcion=="carne")
        include ("carnet/menu1.php");
         if ($opcion=="carpetas")
        include ("inventario/menuConCarpeta.php");
     if ($opcion=="prove")
        include ("proveedor/menu2.php");
     if ($opcion=="clie")
        include ("cliente/menu1.php");
      if ($opcion=="listarzo")
        include ("listarzona/menu1.php");
      if ($opcion=="funera")
        include ("funeraria/menu1.php");
        if ($opcion=="cursoecho")
        include ("curso/menu1.php");
         if ($opcion=="memo")
        include ("memorando/menu1.php");
       if ($opcion=="conexamen")
        include ("examen/menu2.php");
        if ($opcion=="examen")
        include ("examen/menu.php");
       /*menu reporte*/
       if ($opcion=="asocia")
        include ("meneasociado.php");
       if ($opcion=="merca")
        include ("mercado/menu1.php");
               if ($opcion=="aporteso")
        include ("entrega/menu1.php");
        if ($opcion=="cartal")
          include ("cartalaboral/menu1.php");
        if ($opcion=="retiro")
        include ("retiro/menu.php");
        if ($opcion=="retiroaso")
        include ("retiro/menu1.php");
        if ($opcion=="contratistas")
        include ("subcontrato/menu1.php");
        if ($opcion=="exportar")
        include ("exportacion/menuAuxiliar.php");
        /*menu utilidad*/
        if ($opcion=="salir")
        include ("salir.php");
        if ($opcion=="clave")
        include ("acceso/menudirecto.php");
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
