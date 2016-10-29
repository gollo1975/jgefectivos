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
               <a href="menu.php?tipoM=PROCESOS"><font size=3>+</font></a> PROCESOS
            </div>
            <?
            if ($tipoMenu=="PROCESOS")
            {
            ?>
            <div class="itemmenu">
                <a href="menu.php?op=empresas&op1=admemp" target="contenido">Empresas</a><br>
                <a href="menu.php?op=sucursal" target="contenido">Sucursal</a><Br>
                <a href="menu.php?op=depto" target="contenido">Departamentos</a><Br>
                <a href="menu.php?op=municipio" target="contenido">Municipios</a><Br>
                <a href="menu.php?op=vendedor" target="contenido">Vendedor</a><Br>
                <a href="menu.php?op=pension" target="contenido">Pensión</a><Br>
                <a href="menu.php?op=eps" target="contenido">EPS</a><Br>
                <a href="menu.php?op=zona" target="contenido">Zona</a><Br>
                <a href="menu.php?op=subcontra" target="contenido">Subcontratos</a><Br>
                <a href="menu.php?op=procesar" target="contenido">Procesar</a><Br>
                <a href="menu.php?op=crear" target="contenido">Crear</a><Br>
                <a href="menu.php?op=crearnovedad" target="contenido">Novedades de Nomina</a><Br>
                <a href="menu.php?op=crearpara" target="contenido">Parámetros de Nomina</a><Br>
                <a href="menu.php?op=observa" target="contenido">Observación</a><Br>
            </div>
            <?
            }
            ?>
            <div class="lbmenu">
                <a href="menu.php?tipoM=NOMINA"><font size=3>+</font></a>NOMINA
            </div>
            <?
            if ($tipoMenu=="NOMINA")
            {
            ?>
            <div class="itemmenu">
                <a href="menu.php?op=empleado&op1=admemp" target="contenido">Empleado</a><br>
                <a href="menu.php?op=sala" target="contenido">Item Salario</a><br>
                <a href="menu.php?op=contrato" target="contenido">Contrato</a><br>
                <a href="menu.php?op=banco" target="contenido">Bancos</a><br>
                <a href="menu.php?op=curso" target="contenido">Curso de Cooperativismo</a><br>
                <a href="menu.php?op=centrocosto" target="contenido">Centro de Costos</a><br>
                <a href="menu.php?op=generar" target="contenido">Generar</a><br>
            </div>
            <?
            }
            ?>
            <div class="lbmenu">
                 <a href="menu.php?tipoM=RETIROS"><font size=3>+</font></a>RETIROS
            </div>
            <?
            if ($tipoMenu=="RETIROS")
            {
            ?>
            <div class="itemmenu">
                <a href="menu.php?op=memorando&op1=admemp" target="contenido">Memorando</a><br>
                <a href="menu.php?op=retiro" target="contenido">Retiro de Asociados</a><br>
                <a href="menu.php?op=prestacion" target="contenido">Pago de Prestaciones</a><br>
                <a href="menu.php?op=prim" target="contenido">Pago de Primas</a><br>
                <a href="menu.php?op=vaca" target="contenido">Vacaciones</a><br>
                <a href="menu.php?op=carta" target="contenido">Carta Laboral</a><br>
                <a href="menu.php?op=novedad" target="contenido">Novedad</a><br>
            </div>
            <?
            }
            ?>
            <div class="lbmenu">
                <a href="MENU.PHP?tipoM=COSTO"><font size=3>+</font></a>COSTO
            </div>
            <?
            if ($tipoMenu=="COSTO")
            {
            ?>
            <div class="itemmenu">
                <a href="menu.php?op=funeraria&op1=admemp" target="contenido">Afiliado Funeraria</a><br>
                <a href="menu.php?op=mercado" target="contenido">Autorización Mercado</a><br>
                <a href="menu.php?op=carnet" target="contenido">Entrega de Carnet</a><br>
                <a href="menu.php?op=pagar" target="contenido">Mercados por Pagar</a><br>
                <a href="menu.php?op=cheque" target="contenido">Descargar Factura Proveedor</a><br>
                <a href="menu.php?op=tercero" target="contenido">Crear Terceros</a><br>
                <a href="menu.php?op=descargapresta" target="contenido">Registrar Compensaciones</a><br>
                <a href="menu.php?op=gracomision" target="contenido">Comisiones</a><br>
                <a href="menu.php?op=examen" target="contenido">Examenes de Ingreso</a><br>
                <a href="menu.php?op=registro" target="contenido">Registro de personal</a><br>
                <a href="menu.php?op=Fondos" target="contenido">Formatos de Auxilios</a><br>
            </div>
            <?
            }
            ?>
            <div class="lbmenu">
                <a href="menu.php?tipoM=CONSULTA"><font size=3>+</font></a>CONSULTA
            </div>
            <?
            if ($tipoMenu=="CONSULTA")
            {
            ?>
            <div class="itemmenu">
                <a href="menu.php?op=emple&op1admemp" target="contenido">Empleado por</a><br>
                <a href="menu.php?op=contra" target="contenido">Contrato de Trabajo</a><br>
                <a href="menu.php?op=zon" target="contenido">Zonas Por Sucursal</a><br>
                <a href="menu.php?op=listar" target="contenido">Listar Información de </a><br>
                 <a href="menu.php?op=memo" target="contenido">Memorandos</a><br>
                <a href="menu.php?op=deta" target="contenido">Detallado de Factura</a><br>
                <a href="menu.php?op=carne" target="contenido">Carnet de Empleado</a><br>
                <a href="menu.php?op=prove" target="contenido">Proveedor Por</a><br>
                <a href="menu.php?op=clie" target="contenido">Cliente</a><br>
                <a href="menu.php?op=listarzo" target="contenido">Zona</a><br>
                <a href="menu.php?op=funera" target="contenido">Funeraria Por</a><br>
                <a href="menu.php?op=confa" target="contenido">Compras</a><br>
                <a href="menu.php?op=cursoecho" target="contenido">Curso Cooperativo</a><br>
                <a href="menu.php?op=convendedor" target="contenido">Vendedores</a><br>
                <a href="menu.php?op=conexamen" target="contenido">Examenes Médicos</a><br>
                <a href="menu.php?op=conregistro" target="contenido">Registros Visitante</a><br>
                <a href="menu.php?op=confondos" target="contenido">Formato de Fondos</a><br>
            </div>
            <?
            }
            ?>
            <div class="lbmenu">
                <a href="menu.php?tipoM=REPORTES"><font size=3>+</font></a>REPORTES
            </div>
            <?
            if ($tipoMenu=="REPORTES")
            {
            ?>
            <div class="itemmenu">
                <a href="menu.php?op=asocia&op1admemp" target="contenido">Empleado por</a><br>
                <a href="menu.php?op=factu" target="contenido">Factura de Venta</a><br>
                <a href="menu.php?op=merca" target="contenido">Mercado por</a><br>
                <a href="menu.php?op=cuentac" target="contenido">Cuenta de Cobro Por</a><br>
                <a href="menu.php?op=aporteso" target="contenido">Aporte Social Por</a><br>
                <a href="menu.php?op=notacre" target="contenido">Nota Crédito Por</a><br>
                <a href="menu.php?op=creditopor" target="contenido">Crédito Por</a><br>
                <a href="menu.php?op=cartal" target="contenido">Carta Laboral</a><br>
                <a href="menu.php?op=presta" target="contenido">Prestaciones Sociales</a><br>
                <a href="menu.php?op=compe" target="contenido">Nomina Por</a><br>
                <a href="menu.php?op=retiroaso" target="contenido">Retiro de Empleado</a><br>
                <a href="menu.php?op=recibo" target="contenido">Recibo de Caja</a><br>
                <a href="menu.php?op=reportecomprobante" target="contenido">Comprobante de Egreso</a><br>
                <a href="menu.php?op=servifa" target="contenido">Factura de Servicio</a><br>
                <a href="menu.php?op=serviempaca" target="contenido">Servicio Empacadores</a><br>
                <a href="menu.php?op=reportenovedad" target="contenido">Novedades de Nomina</a><br>
                <a href="menu.php?op=planilla" target="contenido">Planilla de Nomina</a><br>
                <a href="menu.php?op=contratistas" target="contenido">Subcontratos</a><br>
                <a href="menu.php?op=recomision" target="contenido">Comisiones por</a><br>
                <a href="menu.php?op=exporte" target="contenido">Exportar Archivos</a><br>
            </div>
            <?
           }
            ?>
           <div class="lbmenu">
                <a href="menu.php?tipoM=CONTABILIDAD"><font size=3>+</font></a>CONTABILIDAD
            </div>
            <?
            if ($tipoMenu=="CONTABILIDAD")
            {
             ?>
             <div class="itemmenu">
                <a href="menu.php?op=comprobantes&op1admemp" target="contenido">Comprobantes Contable</a><br>
                <a href="menu.php?op=comproegreso" target="contenido">Comprobante de Egreso</a><br>
                <a href="menu.php?op=pagofactura" target="contenido">Compras</a><br>
                <a href="menu.php?op=recibocaja" target="contenido"> Recibo de Caja</a><br>
                <a href="menu.php?op=notacreditocontabilidad" target="contenido"> Nota Crédito</a><br>
                <a href="menu.php?op=provedor" target="contenido">Terceros</a><br>
                <a href="menu.php?op=puc" target="contenido">P.u.c</a><br>
                <a href="menu.php?op=documento" target="contenido">Documentos Contables</a><br>
             </div>
             <?
             }
           ?>
           <div class="lbmenu">
                <a href="menu.php?tipoM=UTILIDADES"><font size=3>+</font></a>UTILIDADES
            </div>
            <?
            if ($tipoMenu=="UTILIDADES")
            {
            ?>
            <div class="itemmenu">
                <a href="menu.php?op=clave&op1admemp" target="contenido"><b>Cambio de Clave</b></a><br>
           </div>
           <?
           }
           ?>
           <div class="lbmenu">
                <a href="menu.php?tipoM=SALIR"><font size=3>+</font></a>CERRAR CESION
            </div>
            <?
            if ($tipoMenu=="SALIR")
            {
            ?>
            <div class="itemmenu">
                <a href="menu.php?op=salir&op1admemp" target="contenido"><b>Salir</b></a><br>
            </div>
            <?
            }
            ?>
         </div>
        <div>
          <br><br>
         <?
    }
    /*menu proceso*/
    if ($opcion=="empresas")
        include ("maestro/menu.php");
    if ($opcion=="sucursal")
        include ("sucursal/menu.php");
    if ($opcion=="depto")
        include ("departamento/menu.php");
    if ($opcion=="municipio")
        include ("municipio/menumunicipio.php");
    if ($opcion=="vendedor")
        include ("vendedor/menu.php");
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
    if ($opcion=="crearpara")
        include ("parametro/menu.php");
    if ($opcion=="observa")
        include ("observacion/menu.php");
    /*menu nomina*/
    if ($opcion=="empleado")
        include ("empleado/menu.php");
    if ($opcion=="sala")
        include ("salario/menu.php");
    if ($opcion=="contrato")
        include ("contrato/menu.php");
    if ($opcion=="banco")
        include ("banco/menu.php");
    if ($opcion=="curso")
        include ("curso/menu.php");
    if ($opcion=="centrocosto")
        include ("menucentro.php");
    if ($opcion=="generar")
        include ("menugenerar.php");
    /*menu retiro*/
     if ($opcion=="memorando")
        include ("memorando/menu.php");
       if ($opcion=="prestacion")
        include ("vacaciones/menu5.php");
     if ($opcion=="vaca")
        include ("vacaciones/menu1.php");
     if ($opcion=="retiro")
        include ("retiro/menu.php");
     if ($opcion=="prim")
        include ("vacaciones/menu3.php");
     if ($opcion=="carta")
        include ("cartalaboral/menu.php");
     if ($opcion=="novedad")
        include ("novedad/menu.php");
     /*menu costo*/
     if ($opcion=="funeraria")
        include ("funeraria/menu.php");
     if ($opcion=="mercado")
        include ("mercado/menu.php");
     if ($opcion=="carnet")
        include ("carnet/menu.php");
     if ($opcion=="pagar")
        include ("carteramercado/menu.php");
     if ($opcion=="cheque")
        include ("cheque/menu.php");
     if ($opcion=="tercero")
        include ("menucuenta.php");
     if ($opcion=="descargapresta")
        include ("vacaciones/menu6.php");
     if ($opcion=="gracomision")
        include ("comision/menu.php");
     if ($opcion=="examen")
        include ("examen/menu.php");
     if ($opcion=="registro")
       include ("ingreso/menuingreso.php");
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
       if ($opcion=="convendedor")
       include ("vendedor/menu1.php");
       if ($opcion=="cursoecho")
        include ("curso/menu1.php");
         if ($opcion=="conexamen")
        include ("examen/menu2.php");
      if ($opcion=="conregistro")
        include ("ingreso/menuconsulta.php");
      if ($opcion=="confondos")
        include ("formatos/menuconsulta.php");
        /*menu reportes*/
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
        if ($opcion=="recomision")
        include ("comision/menu1.php");
        if ($opcion=="exporte")
        include ("exportacion/menu.php");
        /*menu contabilidad*/
        if ($opcion=="comprobantes")
          include ("contable/menucomprobante.php");
        if ($opcion=="comproegreso")
          include ("comprobantegreso/menucomprobante.php");
        if ($opcion=="recibocaja")
          include ("recibocaja/menu.php");
        if ($opcion=="notacreditocontabilidad")
          include ("notacredito/menunotacredito.php");
        if ($opcion=="pagofactura")
          include ("porpagar/menu.php");
        if ($opcion=="provedor")
          include ("proveedor/menu.php");
        if ($opcion=="puc")
          include ("contable/menupuc.php");
        /*menu utilidades*/
        if ($opcion=="clave")
        include ("acceso/menu.php");
        /*menu salir*/
         if ($opcion=="salir")
        include ("salir.php");
     ?>
        </div>
         <?
else:
?>
  <script language="javascript">
   alert("Cargando La Base de Datos con el Servidor?")
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
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           