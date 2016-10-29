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
               <a href="menuoperativo.php?tipoM=PROCESOS"><font size=3>+</font></a> PROCESOS
            </div>
            <?
            if ($tipoMenu=="PROCESOS")
            {
            ?>
            <div class="itemmenu">
                <a href="menuoperativo.php?op=pension" target="contenido">Pensión</a><Br>
                <a href="menuoperativo.php?op=eps" target="contenido">EPS</a><Br>
                <a href="menuoperativo.php?op=zona" target="contenido">Zona</a><Br>
                <a href="menuoperativo.php?op=subcontra" target="contenido">Subcontratos</a><Br>
                <a href="menuoperativo.php?op=procesar" target="contenido">Procesar</a><Br>
                <a href="menuoperativo.php?op=crear" target="contenido">Crear</a><Br>
                <a href="menuoperativo.php?op=crearnovedad" target="contenido">Novedades de Nomina</a><Br>
            </div>
            <?
            }
            ?>
            <div class="lbmenu">
                <a href="menuoperativo.php?tipoM=NOMINA"><font size=3>+</font></a>NOMINA
            </div>
            <?
            if ($tipoMenu=="NOMINA")
            {
            ?>
            <div class="itemmenu">
                <a href="menuoperativo.php?op=empleado&op1=admemp" target="contenido">Empleado</a><br>
                <a href="menuoperativo.php?op=contrato" target="contenido">Contrato</a><br>
                <a href="menuoperativo.php?op=banco" target="contenido">Bancos</a><br>
                <a href="menuoperativo.php?op=curso" target="contenido">Curso de Cooperativismo</a><br>
                <a href="menuoperativo.php?op=centrocosto" target="contenido">Centro de Costos</a><br>
                <a href="menuoperativo.php?op=generar" target="contenido">Generar</a><br>
            </div>
            <?
            }
            ?>
            <div class="lbmenu">
                 <a href="menuoperativo.php?tipoM=RETIROS"><font size=3>+</font></a>RETIROS
            </div>
            <?
            if ($tipoMenu=="RETIROS")
            {
            ?>
            <div class="itemmenu">
                <a href="menuoperativo.php?op=memorando&op1=admemp" target="contenido">Memorando</a><br>
                <a href="menuoperativo.php?op=retiro" target="contenido">Retiro de Asociados</a><br>
                <a href="menuoperativo.php?op=prestacion" target="contenido">Pago de Prestaciones</a><br>
                <a href="menuoperativo.php?op=prima" target="contenido">Pago de Primas</a><br>
                <a href="menuoperativo.php?op=vaca" target="contenido">Vacaciones</a><br>
                <a href="menuoperativo.php?op=carta&FirmaDigital=<?echo $validar;?>" target="contenido">Carta Laboral</a><br>
                </div>
            <?
            }
            ?>
            <div class="lbmenu">
                <a href="menuoperativo.PHP?tipoM=COSTO"><font size=3>+</font></a>COSTO
            </div>
            <?
            if ($tipoMenu=="COSTO")
            {
            ?>
            <div class="itemmenu">
                <a href="menuoperativo.php?op=funeraria&op1=admemp" target="contenido">Afiliado Funeraria</a><br>
                <a href="menuoperativo.php?op=mercado" target="contenido">Autorización Mercado</a><br>
                <a href="menuoperativo.php?op=pagar" target="contenido">Mercados por Pagar</a><br>
                <a href="menuoperativo.php?op=cheque" target="contenido">Descargar Factura Proveedor</a><br>
                <a href="menuoperativo.php?op=tercero" target="contenido">Crear Terceros</a><br>
                <a href="menuoperativo.php?op=descargapresta" target="contenido">Registrar Compensaciones</a><br>
                <a href="menuoperativo.php?op=Fondos" target="contenido">Formatos de Auxilios</a><br>
            </div>
            <?
            }
            ?>
            <div class="lbmenu">
                <a href="menuoperativo.php?tipoM=CONSULTA"><font size=3>+</font></a>CONSULTA
            </div>
            <?
            if ($tipoMenu=="CONSULTA")
            {
            ?>
            <div class="itemmenu">
                <a href="menuoperativo.php?op=emple&op1admemp" target="contenido">Empleado por</a><br>
                <a href="menuoperativo.php?op=contra" target="contenido">Contrato de Trabajo</a><br>
                <a href="menuoperativo.php?op=zon" target="contenido">Zonas Por Sucursal</a><br>
                <a href="menuoperativo.php?op=listar" target="contenido">Listar Información de </a><br>
                <a href="menuoperativo.php?op=memo" target="contenido">Memorandos</a><br>
                <a href="menuoperativo.php?op=deta" target="contenido">Detallado de Factura</a><br>
                <a href="menuoperativo.php?op=prove" target="contenido">Proveedor Por</a><br>
                <a href="menuoperativo.php?op=carne" target="contenido">Carnet de Empleado</a><br>
                <a href="menuoperativo.php?op=clie" target="contenido">Cliente</a><br>
                <a href="menuoperativo.php?op=listarzo" target="contenido">Zona</a><br>
                <a href="menuoperativo.php?op=funera" target="contenido">Funeraria Por</a><br>
                <a href="menuoperativo.php?op=confa" target="contenido">Facturas Pagadas a Proveedor</a><br>
                <a href="menuoperativo.php?op=cursoecho" target="contenido">Curso Cooperativo</a><br>
                 <a href="menuoperativo.php?op=conexamen" target="contenido">Examenes de Ingreso</a><br>
                  <a href="menuoperativo.php?op=confondos" target="contenido">Formato de Fondos</a><br>
            </div>
            <?
            }
            ?>
            <div class="lbmenu">
                <a href="menuoperativo.php?tipoM=REPORTES"><font size=3>+</font></a>REPORTES
            </div>
            <?
            if ($tipoMenu=="REPORTES")
            {
            ?>
            <div class="itemmenu">
                <a href="menuoperativo.php?op=asocia&op1admemp" target="contenido">Empleado por</a><br>
                <a href="menuoperativo.php?op=factu" target="contenido">Factura de Venta</a><br>
                <a href="menuoperativo.php?op=merca" target="contenido">Mercado por</a><br>
                <a href="menuoperativo.php?op=cuentac" target="contenido">Cuenta de Cobro Por</a><br>
                <a href="menuoperativo.php?op=aporteso" target="contenido">Aporte Social Por</a><br>
                <a href="menuoperativo.php?op=notacre" target="contenido">Nota Crédito Por</a><br>
                <a href="menuoperativo.php?op=creditopor" target="contenido">Crédito Por</a><br>
                <a href="menuoperativo.php?op=cartal" target="contenido">Carta Laboral</a><br>
                <a href="menuoperativo.php?op=presta" target="contenido">Prestaciones Sociales</a><br>
                <a href="menuoperativo.php?op=compe" target="contenido">Nomina Por</a><br>
                <a href="menuoperativo.php?op=retiroaso" target="contenido">Retiro de Empleado</a><br>
                <a href="menuoperativo.php?op=recibo" target="contenido">Recibo de Caja</a><br>
                <a href="menuoperativo.php?op=reportecomprobante" target="contenido">Comprobante de Egreso</a><br>
                <a href="menuoperativo.php?op=servifa" target="contenido">Factura de Servicio</a><br>
                <a href="menuoperativo.php?op=serviempaca" target="contenido">Servicio Empacadores</a><br>
                <a href="menuoperativo.php?op=reportenovedad" target="contenido">Novedades de Nomina</a><br>
                <a href="menuoperativo.php?op=planilla" target="contenido">Planilla de Nomina</a><br>
                <a href="menuoperativo.php?op=contratistas" target="contenido">Subcontratos</a><br>
                <a href="menuoperativo.php?op=exporte" target="contenido">Exportar Archivos</a><br> 
            </div>
            <?
            }
             ?>
           <div class="lbmenu">
                <a href="menuoperativo.php?tipoM=CONTABILIDAD"><font size=3>+</font></a>CONTABILIDAD
            </div>
            <?
            if ($tipoMenu=="CONTABILIDAD")
            {
             ?>
             <div class="itemmenu">
                <a href="menuoperativo.php?op=comprobantes&op1admemp" target="contenido">Comprobantes Contable</a><br>
                <a href="menuoperativo.php?op=comproegreso" target="contenido">Comprobante de Egreso</a><br>
                <a href="menuoperativo.php?op=pagofactura1" target="contenido">Compras</a><br>
                <a href="menuoperativo.php?op=recibocaja" target="contenido"> Recibo de Caja</a><br>
                <a href="menuoperativo.php?op=notacreditocontabilidad" target="contenido"> Nota Crédito</a><br>
                <a href="menuoperativo.php?op=provedor1" target="contenido">Terceros</a><br>
                <a href="menuoperativo.php?op=puc" target="contenido">P.u.c</a><br>
                <a href="menuoperativo.php?op=documento" target="contenido">Documentos Contables</a><br>
             </div>
             <?
             }
             ?>
           <div class="lbmenu">
                <a href="menuoperativo.php?tipoM=UTILIDADES"><font size=3>+</font></a>UTILIDADES
            </div>
            <?
            if ($tipoMenu=="UTILIDADES")
            {
            ?>
            <div class="itemmenu">
                <a href="menuoperativo.php?op=clave&op1admemp" target="contenido"><b>Cambio de Clave</b></a><br>
           </div>
           <?
           }
           ?>
             <div class="lbmenu">
                <a href="menuoperativo.php?tipoM=SALIR"><font size=3>+</font></a>CERRAR CESION
            </div>
            <?
            if ($tipoMenu=="SALIR")
            {
            ?>
            <div class="itemmenu">
                <a href="menuoperativo.php?op=salir&op1admemp" target="contenido"><b>Salir</b></a><br>
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
    if ($opcion=="crear")
        include ("menucrear.php");
    if ($opcion=="crearnovedad")
        include ("novedades/menu.php");
     /*menu nomina*/      
    if ($opcion=="empleado")
        include ("empleado/menu.php");
       if ($opcion=="contrato")
        include ("contrato/menu.php");
    if ($opcion=="banco")
        include ("banco/menu.php");
    if ($opcion=="curso")
        include ("curso/menu.php");
    if ($opcion=="centrocosto")
        include ("menucentro.php");
    if ($opcion=="generar")
        include ("generaroperativo.php");
     /*menu retiro*/
     if ($opcion=="funeraria")
        include ("funeraria/menu.php");
     if ($opcion=="prestacion")
        include ("vacaciones/menu5.php");
     if ($opcion=="prima")
        include ("vacaciones/menu3.php");
     if ($opcion=="vaca")
        include ("vacaciones/menu1.php");
    if ($opcion=="memorando")
        include ("memorando/menu.php");
     if ($opcion=="carta")
        include ("cartalaboral/menu.php");
     /*menu costo*/
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
      if ($opcion=="descargapresta")
        include ("vacaciones/menu6.php");
      if ($opcion=="Fondos")
       include ("formatos/menuformato.php");
       /*menu consulta*/
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
      if ($opcion=="conexamen")
        include ("examen/menu2.php");
      if ($opcion=="confondos")
        include ("formatos/menuconsulta.php");  
      /*menu reporte*/
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
        if ($opcion=="compe")
        include ("nomina/menu.php");
        if ($opcion=="retiro")
        include ("retiro/menu.php");
        if ($opcion=="prim")
        include ("vacaciones/menu3.php");
        if ($opcion=="retiroaso")
        include ("retiro/menu1.php");
        if ($opcion=="recibo")
        include ("recibocaja/menu1.php");
         if ($opcion=="reportecomprobante")
        include ("comprobantegreso/menureporte.php");
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
        if ($opcion=="exporte")
          include ("exportacion/menu.php");
         /*menu contabilidad*/
        if ($opcion=="comprobantes")
          include ("contable/menucomprobante.php");
        if ($opcion=="comproegreso")
          include ("comprobantegreso/menucomprobante.php");
         if ($opcion=="pagofactura1")
          include ("porpagar/menu.php");
        if ($opcion=="recibocaja")
          include ("recibocaja/menu.php");
        if ($opcion=="notacreditocontabilidad")
          include ("notacredito/menunotacredito.php");
         if ($opcion=="provedor1")
          include ("proveedor/menu.php");
        if ($opcion=="puc")
          include ("contable/menupuc.php");
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
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      