<?
 session_start();
?>
<html>
  <head>
  <title>JGEFECTIVOS S.A.S. "Empresa de Servicios Temporales"</title>
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
                <a href="menucontadora.php?tipoM=CONSULTA"><font size=3>+</font></a>CONSULTA
            </div>
            <?
            if ($tipoMenu=="CONSULTA")
            {
            ?>
            <div class="itemmenu">
                <a href="menucontadora.php?op=emple&op1admemp" target="contenido">Empleado por</a><br>
                <a href="menucontadora.php?op=confa" target="contenido">Facturas Pagadas a Proveedor</a><br>
                <a href="menucontadora.php?op=listar" target="contenido">Listar Información de </a><br>								
                <a href="menucontadora.php?op=prove" target="contenido">Proveedor Por</a><br>		
				<a href="formatoDigital/procesos.php?opc=3" target="contenido">Solicitudes Sistemas</a><Br>			
				<a href="solicitudSS/consultaSolicitud.php" target="contenido">Solicitudes Seguridad Social</a><Br>			
				<a href="solicitudSS/procesos.php?opc=3" target="contenido">Solicitudes Pendientes</a><Br>			

                <a href="menucontadora.php?op=zon" target="contenido">Zonas Por Sucursal</a><br>
                <a href="menucontadora.php?op=listarzo" target="contenido">Zona</a><br>

            </div>
            <?
            }
            ?>
            <div class="lbmenu">
                <a href="menucontadora.php?tipoM=REPORTES"><font size=3>+</font></a>REPORTES
            </div>
            <?
            if ($tipoMenu=="REPORTES")
            {
            ?>
            <div class="itemmenu">
                <a href="menucontadora.php?op=aporteso" target="contenido">Aporte Social Por</a><br>
                <a href="menucontadora.php?op=reportecomprobante" target="contenido">Comprobante de Egreso</a><br>
				<a href="menucontadora.php?op=creditopor" target="contenido">Crédito Por</a><br>
                <a href="menucontadora.php?op=cuentac" target="contenido">Cuenta de Cobro Por</a><br>				
                <a href="menucontadora.php?op=exporte" target="contenido">Exportar Archivos</a><br>
                <a href="menucontadora.php?op=factu" target="contenido">Factura de Venta</a><br>
                <a href="menucontadora.php?op=servifa" target="contenido">Factura de Servicio</a><br>							
                <a href="menucontadora.php?op=merca" target="contenido">Mercado por</a><br>
                <a href="menucontadora.php?op=compe" target="contenido">Nomina Por</a><br>
                <a href="menucontadora.php?op=notacre" target="contenido">Nota Crédito Por</a><br>
                <a href="menucontadora.php?op=planilla" target="contenido">Planilla de Nomina</a><br>
                <a href="menucontadora.php?op=recibo" target="contenido">Recibo de Caja</a><br>
           </div>
            <?
           }
           ?>
           <div class="lbmenu">
                <a href="menucontadora.php?tipoM=UTILIDADES"><font size=3>+</font></a>UTILIDADES
            </div>
            <?
            if ($tipoMenu=="UTILIDADES")
            {
            ?>
            <div class="itemmenu">
                <a href="menucontadora.php?op=clave&op1admemp" target="contenido"><b>Cambio de Clave</b></a><br>
           </div>
           <?
           }
           ?>
           <div class="lbmenu">
                <a href="menucontadora.php?tipoM=SALIR"><font size=3>+</font></a>CERRAR SESION
            </div>
            <?
            if ($tipoMenu=="SALIR")
            {
            ?>
            <div class="itemmenu">
                <a href="menucontadora.php?op=salir&op1admemp" target="contenido"><b>Salir</b></a><br>
            </div>
            <?
            }
            ?>
         </div>
        <div>
          <br><br>
         <?
     }
      if ($opcion=="emple")
        include ("menuemple.php");
      if ($opcion=="zon")
        include ("zona/menu1.php");
     if ($opcion=="listar")
        include ("menulistar.php");
       if ($opcion=="prove")
        include ("proveedor/menu2.php");
       if ($opcion=="listarzo")
        include ("listarzona/menu1.php");
         if ($opcion=="confa")
        include ("cheque/menu1.php");
        if ($opcion=="factu")
        include ("confactura/menu.php");
       if ($opcion=="merca")
        include ("mercado/menu1.php");
       if ($opcion=="cuentac")
        include ("cuentacobro/menu1.php");
        if ($opcion=="aporteso")
        include ("entrega/menu1.php");
        if ($opcion=="notacre")
        include ("notacredito/menu1.php");
        if ($opcion=="creditopor")
        include ("pagocredito/menu1.php");
        if ($opcion=="compe")
        include ("nomina/menu.php");
        if ($opcion=="recibo")
        include ("recibocaja/menu1.php");
         if ($opcion=="reportecomprobante")
        include ("comprobantegreso/menureporte.php");
        if ($opcion=="servifa")
        include ("facturar/menu1.php");
         if ($opcion=="planilla")
        include ("planilla/menu.php");
        if ($opcion=="exporte")
        include ("exportacion/menu.php");
        /*menu tulidades*/
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
