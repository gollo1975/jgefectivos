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
               <a href="menuauxiliarnomina.php?tipoM=PROCESOS"><font size=3>+</font></a> PROCESOS
            </div>
            <?
            if ($tipoMenu=="PROCESOS")
            {
            ?>
            <div class="itemmenu">
                <a href="menuauxiliarnomina.php?op=crear" target="contenido">Crear</a><Br>
                <a href="menuauxiliarnomina.php?op=crearnovedad" target="contenido">Novedades de Nomina</a><Br>
                <a href="menuauxiliarnomina.php?op=procesar" target="contenido">Procesar</a><Br>
				<a href="formatoDigital/procesos.php?opc=3&UsuarioSistema=<?echo $xsession;?>" target="contenido">Solicitudes Sistemas</a><Br>	
				<a href="solicitudSS/consultaSolicitud.php" target="contenido">Solicitudes Seguridad Social</a><Br>			
				<a href="solicitudSS/procesos.php?opc=3" target="contenido">Solicitudes Pendientes</a><Br>			
				
                <a href="menuauxiliarnomina.php?op=subcontra" target="contenido">Subcontratos</a><Br>
            </div>
            <?
            }
            ?>
            <div class="lbmenu">
                <a href="menuauxiliarnomina.php?tipoM=NOMINA"><font size=3>+</font></a>NOMINA
            </div>
            <?
            if ($tipoMenu=="NOMINA")
            {
            ?>
            <div class="itemmenu">
                <a href="menuauxiliarnomina.php?op=centrocosto" target="contenido">Centro de Costos</a><br>
                <a href="menuauxiliarnomina.php?op=contrato" target="contenido">Contrato</a><br>
                <a href="menuauxiliarnomina.php?op=curso" target="contenido">Curso en Altura</a><br>
                <a href="menuauxiliarnomina.php?op=empleado&op1=admemp" target="contenido">Empleado</a><br>
                <a href="menuauxiliarnomina.php?op=generar&Auxiliar=<?echo $xsession;?>" target="contenido">Generar</a><br>
            </div>
            <?
            }
            ?>
            <div class="lbmenu">
                 <a href="menuauxiliarnomina.php?tipoM=RETIROS"><font size=3>+</font></a>RETIROS
            </div>
            <?
            if ($tipoMenu=="RETIROS")
            {
            ?>
            <div class="itemmenu">
                <a href="menuauxiliarnomina.php?op=carta&FirmaDigital=<?echo $xsession;?>" target="contenido">Carta Laboral</a><br>
                <a href="menuauxiliarnomina.php?op=prestacion" target="contenido">Pago de Prestaciones</a><br>
                <a href="menuauxiliarnomina.php?op=prima" target="contenido">Pago de Primas</a><br>
                <a href="menuauxiliarnomina.php?op=retiro" target="contenido">Retiro de Asociados</a><br>
                <a href="menuauxiliarnomina.php?op=vaca" target="contenido">Vacaciones</a><br>
                </div>
            <?
            }
            ?>
            <div class="lbmenu">
                <a href="menuauxiliarnomina.PHP?tipoM=COSTO"><font size=3>+</font></a>COSTO
            </div>
            <?
            if ($tipoMenu=="COSTO")
            {
            ?>
            <div class="itemmenu">
                <a href="menuauxiliarnomina.php?op=mercado" target="contenido">Autorización Mercado</a><br>
                <a href="menuauxiliarnomina.php?op=cheque" target="contenido">Descargar Factura Proveedor</a><br>
                <a href="menuauxiliarnomina.php?op=descargapresta" target="contenido">Registrar Compensaciones</a><br>
            </div>
            <?
            }
            ?>
            <div class="lbmenu">
                <a href="menuauxiliarnomina.php?tipoM=CONSULTA"><font size=3>+</font></a>CONSULTA
            </div>
            <?
            if ($tipoMenu=="CONSULTA")
            {
            ?>
            <div class="itemmenu">
                <a href="menuauxiliarnomina.php?op=contra" target="contenido">Contrato de Trabajo</a><br>			
                <a href="menuauxiliarnomina.php?op=cursoecho" target="contenido">Curso de Alturas</a><br>			
                <a href="menuauxiliarnomina.php?op=deta" target="contenido">Detallado de Factura</a><br>	
				<a href="empresas/procesos.php?opc=5" target="contenido">Documentación Empleados</a><br>							
                <a href="menuauxiliarnomina.php?op=emple&op1admemp" target="contenido">Empleado por</a><br>
                <a href="menuauxiliarnomina.php?op=conexamen" target="contenido">Examenes de Ingreso</a><br>
                <a href="menuauxiliarnomina.php?op=confa" target="contenido">Facturas Pagadas a Proveedor</a><br>
                <a href="menuauxiliarnomina.php?op=funera" target="contenido">Funeraria Por</a><br>
                <a href="menuauxiliarnomina.php?op=listar" target="contenido">Listar Información de </a><br>
                <a href="menuauxiliarnomina.php?op=memo" target="contenido">Memorandos</a><br>
                <a href="menuauxiliarnomina.php?op=prove" target="contenido">Proveedor Por</a><br>
                <a href="menuauxiliarnomina.php?op=listarzo" target="contenido">Zona</a><br>
            </div>
            <?
            }
            ?>
            <div class="lbmenu">
                <a href="menuauxiliarnomina.php?tipoM=REPORTES"><font size=3>+</font></a>REPORTES
            </div>
            <?
            if ($tipoMenu=="REPORTES")
            {
            ?>
            <div class="itemmenu">
                <a href="menuauxiliarnomina.php?op=aporteso" target="contenido">Aporte del Fondo</a><br>
                <a href="menuauxiliarnomina.php?op=cartal" target="contenido">Carta Laboral</a><br>
                <a href="menuauxiliarnomina.php?op=creditopor" target="contenido">Crédito Por</a><br>
                <a href="menuauxiliarnomina.php?op=asocia&op1admemp" target="contenido">Empleado por</a><br>
                <a href="menuauxiliarnomina.php?op=exporte" target="contenido">Exportar Archivos</a><br>
                <a href="menuauxiliarnomina.php?op=factu" target="contenido">Factura de Venta</a><br>
                <a href="menuauxiliarnomina.php?op=servifa" target="contenido">Factura de Servicio</a><br>
                <a href="menuauxiliarnomina.php?op=merca" target="contenido">Mercado por</a><br>
                <a href="menuauxiliarnomina.php?op=compe" target="contenido">Nomina Por</a><br>
                <a href="menuauxiliarnomina.php?op=notacre" target="contenido">Nota Crédito Por</a><br>
                <a href="menuauxiliarnomina.php?op=reportenovedad" target="contenido">Novedades de Nomina</a><br>
                <a href="menuauxiliarnomina.php?op=planilla" target="contenido">Planilla de Nomina</a><br>
				<a href="menuauxiliarnomina.php?op=presta" target="contenido">Prestaciones Sociales</a><br>
                <a href="menuauxiliarnomina.php?op=retiroaso" target="contenido">Retiro de Empleado</a><br>
                <a href="menuauxiliarnomina.php?op=serviempaca" target="contenido">Servicio Empacadores</a><br>
                <a href="menuauxiliarnomina.php?op=contratistas" target="contenido">Subcontratos</a><br>
            </div>
            <?
            }
             ?>
           <div class="lbmenu">
                <a href="menuauxiliarnomina.php?tipoM=CONTABILIDAD"><font size=3>+</font></a>CONTABILIDAD
            </div>
            <?
            if ($tipoMenu=="CONTABILIDAD")
            {
             ?>
             <div class="itemmenu">
                <a href="menuauxiliarnomina.php?op=notacreditocontabilidad" target="contenido"> Nota Crédito</a><br>
             </div>
             <?
             }
             ?>
           <div class="lbmenu">
                <a href="menuauxiliarnomina.php?tipoM=UTILIDADES"><font size=3>+</font></a>UTILIDADES
            </div>
            <?
            if ($tipoMenu=="UTILIDADES")
            {
            ?>
            <div class="itemmenu">
                <a href="menuauxiliarnomina.php?op=clave&op1admemp" target="contenido"><b>Cambio de Clave</b></a><br>
           </div>
           <?
           }
           ?>
             <div class="lbmenu">
                <a href="menuauxiliarnomina.php?tipoM=SALIR"><font size=3>+</font></a>CERRAR SESION
            </div>
            <?
            if ($tipoMenu=="SALIR")
            {
            ?>
            <div class="itemmenu">
                <a href="menuauxiliarnomina.php?op=salir&op1admemp" target="contenido"><b>Salir</b></a><br>
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
    if ($opcion=="curso")
        include ("curso/menu.php");
    if ($opcion=="centrocosto")
        include ("menucentro.php");
    if ($opcion=="generar")
        include ("generaroperativo.php");
     /*menu retiro*/

     if ($opcion=="prestacion")
        include ("vacaciones/menu5.php");
     if ($opcion=="prima")
        include ("vacaciones/menu3.php");
     if ($opcion=="vaca")
        include ("vacaciones/menu1.php");
     if ($opcion=="carta")
        include ("cartalaboral/menu.php");
     /*menu costo*/
     if ($opcion=="mercado")
        include ("mercado/menu.php");
     if ($opcion=="provedor")
        include ("proveedor/menu.php");
     if ($opcion=="pagofactura")
        include ("porpagar/menu.php");
     if ($opcion=="cheque")
        include ("cheque/menu.php");
      if ($opcion=="descargapresta")
        include ("vacaciones/menu6.php");
       /*menu consulta*/
      if ($opcion=="emple")
        include ("menuemple.php");
     if ($opcion=="contra")
        include ("contrato/menu1.php");
     if ($opcion=="listar")
        include ("menulistar.php");
     if ($opcion=="memo")
        include ("memorando/menu1.php");
     if ($opcion=="deta")
        include ("extractofactura/menu.php");
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
        if ($opcion=="notacreditocontabilidad")
          include ("notacredito/menunotacredito.php");
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
