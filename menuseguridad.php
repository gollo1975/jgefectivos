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
 /*codigo que permite validar el usuario*/   
    $Sql="select acceso.codigo from acceso where acceso.usuario='$xsession'";
	$RsU=mysql_query($Sql)or die ("Error al buscar usuarios ?");
	$filaU=mysql_fetch_array($RsU);
	$NivelPermiso = $filaU["codigo"];
    $opcion = $_GET['op'];
    $tipoMenu = $_GET['tipoM'];
    if (trim($opcion) == "")
    {
      ?>
          <div class="lbmenu">
                <a href="menuseguridad.php?tipoM=COSTO"><font size=3>+</font></a>COSTO
            </div>
            <?
            if ($tipoMenu=="COSTO")
            {
            ?>
            <div class="itemmenu">
                <a href="menuseguridad.php?op=funeraria" target="contenido">Afiliado Funeraria</a><br>
				<a href="menuseguridad.php?op=conveniocarta&UsuarioPreparador=<?echo $xsession;?>" target="contenido">Contrato Temporal</a><br>
                <a href="menuseguridad.php?op=carnet" target="contenido">Entrega de Carnet</a><br>
				<a href="menuseguridad.php?op=ListadoRequisito&UsuarioPreparador=<?echo $xsession;?>" target="contenido">Requisitos de Ingreso</a><br>
                <a href="menuseguridad.php?op=examen&CodUsuario=<?echo $xsession;?>" target="contenido">Examenes de Ingreso</a><br> 
				<?if($NivelPermiso==10){?>
				     <a href="menuseguridad.php?op=examenadmon" target="contenido">Administrar Examenes</a><br>
				<?}?>	 
                <a href="menuseguridad.php?op=incapa" target="contenido">Incapacidades</a><br>
				<a href="formatoDigital/procesos.php?opc=3&UsuarioSistema=<?echo $xsession;?>" target="contenido">Solicitudes Sistemas</a><Br>	
				<a href="solicitudSS/consultaSolicitud.php" target="contenido">Solicitudes Seguridad Social</a><Br>			
				<a href="solicitudSS/procesos.php?opc=3" target="contenido">Solicitudes Pendientes</a><Br>			
				
            </div>
            <?
            }
            ?>
            <div class="lbmenu">
                <a href="menuseguridad.php?tipoM=CONSULTA"><font size=3>+</font></a>CONSULTA
            </div>
            <?
            if ($tipoMenu=="CONSULTA")
            {
            ?>
            <div class="itemmenu">
                <a href="menuseguridad.php?op=carne" target="contenido">Carnet de Empleado</a><br>
                <a href="menuseguridad.php?op=clie" target="contenido">Cliente</a><br>
                <a href="menuseguridad.php?op=contra" target="contenido">Contrato de Trabajo</a><br>
                <a href="menuseguridad.php?op=cursoecho" target="contenido">Curso en Alturas</a><br>
				<a href="empresas/procesos.php?opc=5" target="contenido">Documentación Empleados</a><br>				
                <a href="menuseguridad.php?op=emple&op1admemp" target="contenido">Empleado por</a><br>
                <a href="menuseguridad.php?op=conexamen&CodUsuario=<?echo $xsession;?>" target="contenido">Examenes Médicos</a><br>
                <a href="menuseguridad.php?op=funera" target="contenido">Funeraria Por</a><br>				
                <a href="menuseguridad.php?op=memo" target="contenido">Memorando</a><br>				
                <a href="menuseguridad.php?op=prove" target="contenido">Proveedor Por</a><br>				
                <a href="menuseguridad.php?op=zon" target="contenido">Zonas Por Sucursal</a><br>
				<a href="menuinformacion.php?op=conregistro" target="contenido">Registros Visitante</a><br>		
				<a href="control/control/fachada.php?opc=71&valor='05'" target="contenido">Consulta Visitantes en Espera</a><br>		
            </div>
            <?
            }
            ?>
            <div class="lbmenu">
                <a href="menuseguridad.php?tipoM=REPORTES"><font size=3>+</font></a>REPORTES
            </div>
            <?
            if ($tipoMenu=="REPORTES")
            {
            ?>
            <div class="itemmenu">
                <a href="menuseguridad.php?op=aporteso" target="contenido">Aporte Social Por</a><br>
                <a href="menuseguridad.php?op=cartal" target="contenido">Carta Laboral</a><br>
                <a href="menuseguridad.php?op=asocia&op1admemp" target="contenido">Empleado por</a><br>
                <a href="menuseguridad.php?op=exportar" target="contenido">Exportar Archivos</a><br>
                <a href="menuseguridad.php?op=merca" target="contenido">Mercado por</a><br>
                <a href="menuseguridad.php?op=retiroaso" target="contenido">Retiro de Empleado</a><br>
                <a href="menuseguridad.php?op=contratistas" target="contenido">Subcontratos</a><br>

            </div>
            <?
           }
           ?>
           <div class="lbmenu">
                <a href="menuseguridad.php?tipoM=UTILIDADES"><font size=3>+</font></a>UTILIDADES
            </div>
            <?
            if ($tipoMenu=="UTILIDADES")
            {
            ?>
            <div class="itemmenu">
                <a href="menuseguridad.php?op=clave&op1admemp" target="contenido"><b>Cambio de Clave</b></a><br>
           </div>
           <?
           }
           ?>
           <div class="lbmenu">
                <a href="menuseguridad.php?tipoM=SALIR"><font size=3>+</font></a>CERRAR SESION
            </div>
            <?
            if ($tipoMenu=="SALIR")
            {
            ?>
            <div class="itemmenu">
                <a href="menuseguridad.php?op=salir&op1admemp" target="contenido"><b>Salir</b></a><br>
            </div>
            <?
            }
            ?>
         </div>
        <div>
          <br><br>
         <?
     }
     if ($opcion=="conveniocarta")
        include ("contrato/menucontrato.php");
      if ($opcion=="funeraria")
        include ("funeraria/menu.php");
       if ($opcion=="carnet")
        include ("carnet/menu.php");
       if ($opcion=="incapa")
        include ("incapacidad/menuseguridad.php");
	 if ($opcion=="ListadoRequisito")
        include ("empleado/MenuDocumentoRequisito.php");
       if ($opcion=="examen")
        include ("examen/menu.php");
	if ($opcion=="examenadmon")
        include ("examen/menuAdministrar.php"); 
        /*menu consulta*/
       if ($opcion=="emple")
        include ("menuempleEstandar.php");
     if ($opcion=="contra")
        include ("contrato/menu1.php");
     if ($opcion=="zon")
        include ("zona/menu1.php");
     if ($opcion=="carne")
        include ("carnet/menu1.php");
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
