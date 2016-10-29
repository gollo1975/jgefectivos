<?
 session_start();
?>
<html>
  <head>
  <title>JGEFECTIVOS S.A.S.</title>
  <LINK  REL="stylesheet" HREF="estilo.css"  type="text/css">
  </head>
  <body>
   <?
  if(session_is_registered("xdepto")) :
     
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
               <a href="menudepartamento.php?tipoM=ARCHIVO"><font size=3>+</font></a>ARCHIVO
            </div>
            <?
            if ($tipoMenu=="ARCHIVO")
            {
            ?>
            <div class="itemmenu">
			   <a href="menudepartamento.php?op=conveniocarta&codigo=<? echo $xdepto;?>&UsuarioPreparador=<?echo $DatoUsuario;?>" target="contenido">Contrato Temporal</a><br>
               <a href="menudepartamento.php?op=examenes&codigo=<?echo $xdepto;?>&DatoUsuario=<?echo $DatoUsuario;?>" target="contenido">Examenes de Ingreso</a><br>
               <a href="menudepartamento.php?op=ListadoRequisito&UsuarioPreparador=<?echo $DatoUsuario;?>" target="contenido">Requisitos de Ingreso</a><br>			   
			   <a href="examen/ModificarRegistro.php?CodUsuario=<?php echo $xdepto;?>"  target="contenido">Modificar Registro Examen</a> <br>
               <a href="menudepartamento.php?op=memorando&Sdepto=<? echo $xdepto;?>" target="contenido">Memorando</a><br>
               <a href="menudepartamento.php?op=novedadnomina&codigo=<? echo $xdepto;?>" target="contenido">Novedades de Nómina</a><br>
               <a href="menudepartamento.php?op=incapacidades&codigo=<? echo $xdepto;?>" target="contenido">Procesar incapacidades</a><br>
			   <a href="formatoDigital/procesos.php?opc=3&UsuarioSistema=<?echo $DatoUsuario;?>" target="contenido">Solicitudes Sistemas</a><Br>	
				<a href="solicitudSS/consultaSolicitud.php" target="contenido">Solicitudes Seguridad Social</a><Br>			
				<a href="solicitudSS/procesos.php?opc=3" target="contenido">Solicitudes Pendientes</a><Br>			
			   
            </div>
            <?
            }
            ?>
            <div class="lbmenu">
                <a href="menudepartamento.php?tipoM=CONSULTA"><font size=3>+</font></a>CONSULTA
            </div>
            <?
            if ($tipoMenu=="CONSULTA")
            {
            ?>
            <div class="itemmenu">
                <a href="menudepartamento.php?op=Consultacarnet&codigo=<? echo $xdepto;?>" target="contenido">Carnet Empleado</a><br>				
                <a href="menudepartamento.php?op=cartalaboral&codigo=<? echo $xdepto;?>" target="contenido">Carta Laboral</a><br>
                <a href="menudepartamento.php?op=carteramercado&codigo=<? echo $xdepto;?>" target="contenido">Cartera Mercados</a><br>
                <a href="menudepartamento.php?op=colillapago&codigo=<? echo $xdepto;?>" target="contenido">Colillas de Pago</a><br>				
                <a href="menudepartamento.php?op=ConsultaComision&codigo=<? echo $xdepto;?>&usuario=<?echo $DatoUsuario;?>" target="contenido">Comisiones</a><br>
				<a href="dianino/consultarEmpleadoDep.php" target="contenido">Consultar Dia de Niños</a><br>							  
				<a href="empresas/procesos.php?opc=3&codigo=<?php echo $xdepto;?>" target="contenido">Documentacion por Zona</a><br>  
                <a href="menudepartamento.php?op=detallefactura&codigo=<? echo $xdepto;?>" target="contenido">Detallado de Factura</a><br>
                <a href="menudepartamento.php?op=activo&codigo=<? echo $xdepto;?>" target="contenido">Empleado activos por</a><br>
                <a href="menudepartamento.php?op=ConsultaExamen&codigo=<? echo $xdepto;?>" target="contenido">Examenes Medicos por</a><br>				
                <a href="menudepartamento.php?op=exportar&codigo=<? echo $xdepto;?>" target="contenido">Exportar archivos</a><br>				
                <a href="menudepartamento.php?op=facturaventa&codigo=<? echo $xdepto;?>" target="contenido">Factura de Venta</a><br>
                <a href="menudepartamento.php?op=incapa&codigo=<? echo $xdepto;?>" target="contenido">Incapacidades</a><br>
				<a href="dianino/procesos.php?opc=3&codigo=<?php echo $xdepto;?>" target="contenido">Listado de Dia de Niños</a><br>												
                <a href="menudepartamento.php?op=consultamemorando&codigo=<? echo $xdepto;?>" target="contenido">Memorandos</a><br>
                <a href="menudepartamento.php?op=Consultanovedad&codigo=<? echo $xdepto;?>" target="contenido">Novedades Nomina</a><br>
                <a href="menudepartamento.php?op=planillas&codigo=<? echo $xdepto;?>" target="contenido">Planillas de Nómina</a><br>
                <a href="menudepartamento.php?op=prestacion&codigo=<? echo $xdepto;?>" target="contenido">Prestaciones sociales</a><br>
            </div>
            <?
            }
            ?>
           <div class="lbmenu">
                <a href="menudepartamento.php?tipoM=UTILIDADES"><font size=3>+</font></a>UTILIDADES
            </div>
            <?
            if ($tipoMenu=="UTILIDADES")
            {
            ?>
            <div class="itemmenu">
                <a href="menudepartamento.php?op=clave&op1admemp&codigo=<? echo $xdepto;?>" target="contenido"><b>Cambio de Clave</b></a><br>
           </div>
           <?
           }
           ?>
           <div class="lbmenu">
                <a href="menudepartamento.php?tipoM=SALIR"><font size=3>+</font></a>CERRAR SESION
            </div>
            <?
            if ($tipoMenu=="SALIR")
            {
            ?>
            <div class="itemmenu">
                <a href="menudepartamento.php?op=salir&op1admemp" target="contenido"><b>Salir</b></a><br>
            </div>
            <?
            }
            ?>
         </div>
        <div>
          <br><br>

         <?
    }
      /*menu RETIRO*/
        if ($opcion=="memorando")
            include ("memorando/menu.php");
        if ($opcion=="incapacidades")
            include ("modulodepartamento/menuincapacidad.php");
        if ($opcion=="novedadnomina")
             include ("modulodepartamento/menunovedad.php");
        if ($opcion=="conveniocarta")
           include ("contrato/menucontrato.php");
         if ($opcion=="examenes")
           include ("examen/menusucursales.php");
	     if ($opcion=="ListadoRequisito")
           include ("empleado/MenuDocumentoRequisito.php");
       /*menu consulta*/
       if ($opcion=="activo")
        include ("modulodepartamento/menuactivo.php");
        if ($opcion=="carteramercado")
        include ("modulodepartamento/menucarteramercado.php");
         if ($opcion=="incapa")
        include ("modulodepartamento/menuconsultainca.php");
         if ($opcion=="consultamemorando")
        include ("modulodepartamento/menuconsultamemorando.php");
        if ($opcion=="planillas")
        include ("modulodepartamento/menuplanilla.php");
        if ($opcion=="colillapago")
        include ("modulodepartamento/menucolilla.php");
         if ($opcion=="facturaventa")
        include ("modulodepartamento/menufactura.php");
        if ($opcion=="detallefactura")
        include ("modulodepartamento/menudetalle.php");
         if ($opcion=="prestacion")
        include ("modulodepartamento/menuprestacion.php");
         if ($opcion=="exportar")
        include ("modulodepartamento/menuexportar.php");
        if ($opcion=="cartalaboral")
        include ("modulodepartamento/menucartalaboral.php");
        if ($opcion=="Consultanovedad")
        include ("modulodepartamento/menunovedadN.php");
        if ($opcion=="ConsultaExamen")
        include ("examen/menuconsultaE.php");
        if ($opcion=="Consultacarnet")
        include ("carnet/menu1.php");
         if ($opcion=="ConsultaComision")
        include ("comision/MenuComision.php");
        /*menu tuilidades*/
        if ($opcion=="clave")
        include ("acceso/menusucursal.php");
          /*menu salir*/
        if ($opcion=="salir")
        include ("salirdepartamento.php");
     ?>
        </div>
         <?
else:
?>
  <script language="javascript">
   alert("El Usuario o Clave son Incorrectos")
   pagina='acceso/accesozona.php'
   tiempo=10
   ubicacion='_self'
   setTimeout("open(pagina,ubicacion)",tiempo)
  </script>
  <?
endif;
?>
   </body>

</html>
