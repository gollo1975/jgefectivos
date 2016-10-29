<?
 session_start();
?>
<html>
  <head>
  <title>COOPERATIVA DE SERVICIOS PROFESIONALES COOPISER</title>
  <LINK  REL="stylesheet" HREF="estilo.css"  type="text/css">
  </head>
  <body>
   <?
  if(session_is_registered("validar")):
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
               <a href="menurecursoh.php?tipoM=PROCESOS"><font size=3>+</font></a> PROCESOS
            </div>
            <?
            if ($tipoMenu=="PROCESOS")
            {
            ?>
            <div class="itemmenu">
                <a href="menurecursoh.php?op=eps" target="contenido">EPS</a><Br>			
                <a href="menurecursoh.php?op=crearnovedad" target="contenido">Novedades de Nomina</a><Br>											
                <a href="menurecursoh.php?op=pension" target="contenido">Pensión</a><Br>                
				<a href="menurecursoh.php?op=procesar" target="contenido">Procesar</a><Br>
                <a href="menu.php?op=subcontra" target="contenido">Subcontratos</a><Br>
                <a href="menurecursoh.php?op=zona" target="contenido">Zona</a><Br>
				<a href="formatoDigital/procesos.php?opc=3" target="contenido">Solicitudes Sistemas</a><Br>	
				<a href="solicitudSS/consultaSolicitud.php" target="contenido">Solicitudes Seguridad Social</a><Br>			
				<a href="solicitudSS/procesos.php?opc=3" target="contenido">Solicitudes Pendientes</a><Br>			
				
            </div>
            <?
            }
            ?>
            <div class="lbmenu">
                <a href="menurecursoh.php?tipoM=NOMINA"><font size=3>+</font></a>NOMINA
            </div>
            <?
            if ($tipoMenu=="NOMINA")
            {
            ?>
            <div class="itemmenu">
                <a href="menurecursoh.php?op=centrocosto" target="contenido">Centro de Costos</a><br>
                <a href="menurecursoh.php?op=empleado&op1=admemp" target="contenido">Empleado</a><br>
                <a href="menurecursoh.php?op=generar" target="contenido">Generar</a><br>
            </div>
            <?
            }
            ?>
            <div class="lbmenu">

                 <a href="menurecursoh.php?tipoM=RETIROS"><font size=3>+</font></a>RETIROS
            </div>
            <?
            if ($tipoMenu=="RETIROS")
            {
            ?>
            <div class="itemmenu">
                <a href="menurecursoh.php?op=carta" target="contenido">Carta Laboral</a><br>
                <a href="menurecursoh.php?op=memorando&op1=admemp" target="contenido">Memorando</a><br>
                <a href="menurecursoh.php?op=prestacion" target="contenido">Pago de Prestaciones</a><br>
                <a href="menurecursoh.php?op=prim" target="contenido">Pago de Primas</a><br>
                <a href="menurecursoh.php?op=retiro" target="contenido">Retiro de Asociados</a><br>
                <a href="menurecursoh.php?op=vaca" target="contenido">Vacaciones</a><br>

                </div>
            <?
            }
            ?>
            <div class="lbmenu">
                <a href="menurecursoh.PHP?tipoM=COSTO"><font size=3>+</font></a>COSTO
            </div>
            <?
            if ($tipoMenu=="COSTO")
            {
            ?>
            <div class="itemmenu">
                <a href="menurecursoh.php?op=mercado" target="contenido">Autorización Mercado</a><br>
                <a href="menurecursoh.php?op=tercero" target="contenido">Crear Terceros</a><br>
                <a href="menurecursoh.php?op=cheque" target="contenido">Descargar Factura Proveedor</a><br>
                <a href="menurecursoh.php?op=pagofactura" target="contenido">Facturas por Pagar</a><br>
                <a href="menurecursoh.php?op=pagar" target="contenido">Mercados por Pagar</a><br>								
                <a href="menurecursoh.php?op=provedor" target="contenido">Proveedores</a><br>
            </div>
            <?
            }
            ?>
            <div class="lbmenu">
                <a href="menurecursoh.php?tipoM=CONSULTA"><font size=3>+</font></a>CONSULTA
            </div>
            <?
            if ($tipoMenu=="CONSULTA")
            {
            ?>
            <div class="itemmenu">
                <a href="menurecursoh.php?op=carne" target="contenido">Carnet de Empleado</a><br>				
                <a href="menurecursoh.php?op=clie" target="contenido">Cliente</a><br>
                <a href="menurecursoh.php?op=contra" target="contenido">Contrato de Trabajo</a><br>
                <a href="menurecursoh.php?op=cursoecho" target="contenido">Curso Cooperativo</a><br>				
                <a href="menurecursoh.php?op=deta" target="contenido">Detallado de Factura</a><br>							
                <a href="menurecursoh.php?op=emple&op1admemp" target="contenido">Empleado por</a><br>
                <a href="menurecursoh.php?op=confa" target="contenido">Facturas Pagadas a Proveedor</a><br>
                <a href="menurecursoh.php?op=funera" target="contenido">Funeraria Por</a><br>
                <a href="menurecursoh.php?op=listar" target="contenido">Listar Información de </a><br>
                <a href="menurecursoh.php?op=memo" target="contenido">Memorandos</a><br>
                <a href="menurecursoh.php?op=prove" target="contenido">Proveedor Por</a><br>
                <a href="menurecursoh.php?op=listarzo" target="contenido">Zona</a><br>
                <a href="menurecursoh.php?op=zon" target="contenido">Zonas Por Sucursal</a><br>
            </div>
            <?
            }
            ?>
            <div class="lbmenu">
                <a href="menurecursoh.php?tipoM=REPORTES"><font size=3>+</font></a>REPORTES
            </div>
            <?
            if ($tipoMenu=="REPORTES")
            {
            ?>
            <div class="itemmenu">
                <a href="menurecursoh.php?op=aporteso" target="contenido">Aporte Social Por</a><br>
                <a href="menurecursoh.php?op=cartal" target="contenido">Carta Laboral</a><br>												
                <a href="menurecursoh.php?op=cuentac" target="contenido">Cuenta de Cobro Por</a><br>
                <a href="menurecursoh.php?op=creditopor" target="contenido">Crédito Por</a><br>
                <a href="menurecursoh.php?op=asocia&op1admemp" target="contenido">Empleado por</a><br>
                <a href="menurecursoh.php?op=factu" target="contenido">Factura de Venta</a><br>
                <a href="menurecursoh.php?op=servifa" target="contenido">Factura de Servicio</a><br>
                <a href="menurecursoh.php?op=merca" target="contenido">Mercado por</a><br>
                <a href="menurecursoh.php?op=notacre" target="contenido">Nota Crédito Por</a><br>				
                <a href="menurecursoh.php?op=reportenovedad" target="contenido">Novedades de Nomina</a><br>				
                <a href="menurecursoh.php?op=planilla" target="contenido">Planilla de Nomina</a><br>				
                <a href="menurecursoh.php?op=presta" target="contenido">Prestaciones Sociales</a><br>
                <a href="menurecursoh.php?op=recibo" target="contenido">Recibo de Caja</a><br>
                <a href="menurecursoh.php?op=retiroaso" target="contenido">Retiro de Empleado</a><br>
				<a href="menurecursoh.php?op=serviempaca" target="contenido">Servicio Empacadores</a><br>
                <a href="menurecursoh.php?op=contratistas" target="contenido">Subcontratos</a><br>
            </div>
            <?
            }
            ?>

           <div class="lbmenu">
                <a href="menurecursoh.php?tipoM=UTILIDADES"><font size=3>+</font></a>UTILIDADES
            </div>
            <?
            if ($tipoMenu=="UTILIDADES")
            {
            ?>
            <div class="itemmenu">
                <a href="menurecursoh.php?op=clave&op1admemp" target="contenido"><b>Cambio de Clave</b></a><br>
           </div>
           <?
           }
           ?>
            <div class="lbmenu">
                <a href="menurecursoh.php?tipoM=SALIR"><font size=3>+</font></a>CERRAR SESION
            </div>
            <?
            if ($tipoMenu=="SALIR")
            {
            ?>
            <div class="itemmenu">
                <a href="menurecursoh.php?op=salir&op1admemp" target="contenido"><b>Salir</b></a><br>
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
        if ($opcion=="pension")
        include ("pension/menu.php");
    if ($opcion=="eps")
        include ("eps/menu.php");
    if ($opcion=="zona")
        include ("zona/menu.php");
   if ($opcion=="subcontra")
        include ("subcontrato/menu.php");        
    if ($opcion=="procesar")
        include ("menuprocesar.php");
    if ($opcion=="crearnovedad")
        include ("novedades/menu.php");        
         if ($opcion=="empleado")
        include ("empleado/menu2.php");
        if ($opcion=="centrocosto")
        include ("menucentro1.php");
    if ($opcion=="generar")
        include ("generarecursoh.php");
     if ($opcion=="memorando")
        include ("memorando/menu.php");
       if ($opcion=="prestacion")
        include ("vacaciones/menu5.php");
     if ($opcion=="vaca")
        include ("vacaciones/menu1.php");
      if ($opcion=="carta")
        include ("cartalaboral/menu.php");
       if ($opcion=="prim")
        include ("vacaciones/menu3.php");
        if ($opcion=="mercado")
        include ("mercado/menu.php");
       if ($opcion=="provedor")
        include ("proveedor/menu.php");
     if ($opcion=="pagar")
        include ("carteramercado/menu.php");
     if ($opcion=="pagofactura")
        include ("porpagar/menu.php");
     if ($opcion=="cheque")
        include ("cheque/menu.php");
     if ($opcion=="tercero")
        include ("menucuenta.php");
      if ($opcion=="emple")
        include ("menuemple.php");
     if ($opcion=="contra")
        include ("contrato/menu1.php");
     if ($opcion=="zon")
        include ("zona/menu1.php");
     if ($opcion=="listar")
        include ("menulistar.php");
     if ($opcion=="memo")
        include ("memorando/menu1.php");
     if ($opcion=="deta")
        include ("extractofactura/menu.php");
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
       if ($opcion=="confa")
        include ("cheque/menu1.php");
       if ($opcion=="cursoecho")
        include ("curso/menu1.php");
       if ($opcion=="asocia")
        include ("meneasociado.php");
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
        if ($opcion=="cartal")
          include ("cartalaboral/menu1.php");
        if ($opcion=="presta")
          include ("menuprestacion.php");
        if ($opcion=="retiro")
        include ("retiro/menu.php");
        if ($opcion=="retiroaso")
        include ("retiro/menu1.php");
        if ($opcion=="recibo")
        include ("recibocaja/menu1.php");
          if ($opcion=="servifa")
        include ("facturar/menu1.php");
         if ($opcion=="serviempaca")
        include ("empacadores/menu1.php");
        if ($opcion=="reportenovedad")
        include ("novedades/menu1.php");
        if ($opcion=="planilla")
        include ("planilla/menu.php");
        if ($opcion=="contratistas")
        include ("subcontrato/menu1.php");
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
