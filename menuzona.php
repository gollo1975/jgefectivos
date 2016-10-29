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
  if(session_is_registered("xzona")) :
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
               <a href="menuzona.php?tipoM=PROCESOS"><font size=3>+</font></a> PROCESOS
            </div>
            <?
            if ($tipoMenu=="PROCESOS")
            {
            ?>
            <div class="itemmenu">
			   <a href="menuzona.php?op=conveniocarta&codigo=<? echo $xzona;?>" target="contenido">Convenio y Carta</a><br>
                         <a href="menuzona.php?op=memorando&Szona=<? echo $xzona;?>" target="contenido">Memorando</a><br>
				<a href="menuzona.php?op=crearnovedad&codigo=<? echo $xzona;?>" target="contenido">Novedades de Nomina</a><br>	
				<a href="formatoDigital/procesos.php?opc=3" target="contenido"></a>						   
            </div>
            <?
            }
            ?>
            <div class="lbmenu">
                <a href="menuzona.php?tipoM=CONSULTA"><font size=3>+</font></a>CONSULTA
            </div>
            <?
            if ($tipoMenu=="CONSULTA")
            {
            ?>
            <div class="itemmenu">
                <a href="menuzona.php?op=cartalaboral&codigo=<? echo $xzona;?>" target="contenido">Carta Laboral</a><br>
                <a href="menuzona.php?op=mercado&codigo=<? echo $xzona;?>" target="contenido">Cartera Mercados</a><br>
				<a href="menuzona.php?op=nomina&codigo=<? echo $xzona;?>" target="contenido">Colillas de Pago</a><br>
				<a href="empresas/consultaEmpleadoZona.php" target="contenido">Consulta de Empleados</a><br>				
                <a href="menuzona.php?op=servicio&codigo=<? echo $xzona;?>" target="contenido">Detallado Factura_Venta</a><br>				
                <a href="empresas/procesos.php?opc=18&valor=<?php echo $xzona;?>" target="contenido">Documentación Empleados</a><br>
                <a href="menuzona.php?op=emple&codigo=<? echo $xzona;?>" target="contenido">Empleados</a><br>
                <a href="menuzona.php?op=exportar&codigo=<? echo $xzona;?>" target="contenido">Exportar archivos</a><br>
                <a href="menuzona.php?op=faventa&codigo=<? echo $xzona;?>" target="contenido">Factura de Venta</a><br>
                <a href="menuzona.php?op=incapa&codigo=<? echo $xzona;?>" target="contenido">Incapacidades</a><br>
                <a href="menuzona.php?op=memora&codigo=<? echo $xzona;?>" target="contenido">Memorandos</a><br>
                <a href="menuzona.php?op=novedadnomina&codigo=<? echo $xzona;?>" target="contenido">Novedades-Nómina</a><br>                
                <a href="menuzona.php?op=prestacion&codigo=<? echo $xzona;?>" target="contenido">Prestaciones sociales</a><br>
            </div>
            <?
            }
            ?>
           <div class="lbmenu">
                <a href="menuzona.php?tipoM=UTILIDADES"><font size=3>+</font></a>UTILIDADES
            </div>
            <?
            if ($tipoMenu=="UTILIDADES")
            {
            ?>
            <div class="itemmenu">
                <a href="menuzona.php?op=clave&op1admemp&codigo=<? echo $xzona;?>" target="contenido"><b>Cambio de Clave</b></a><br>
           </div>
           <?
           }
           ?>
           <div class="lbmenu">
                <a href="menuzona.php?tipoM=SALIR"><font size=3>+</font></a>CERRAR SESION
            </div>
            <?
            if ($tipoMenu=="SALIR")
            {
            ?>
            <div class="itemmenu">
                <a href="menuzona.php?op=salir&op1admemp" target="contenido"><b>Salir</b></a><br>
            </div>
            <?
            }
            ?>
         </div>
        <div>
          <br><br>

         <?
    }
      /*menu procesos*/
      if ($opcion=="crearnovedad")
        include ("ppal/menu8.php");
        if ($opcion=="memorando")
       include ("memorando/menu.php");
       if ($opcion=="conveniocarta")
        include ("contrato/menudepartamento.php");
       /*menu consulta*/
       if ($opcion=="emple")
        include ("ppal/menu.php");
        if ($opcion=="mercado")
        include ("ppal/menu3.php");
         if ($opcion=="incapa")
        include ("ppal/menu4.php");
         if ($opcion=="memora")
        include ("ppal/menu2.php");
        if ($opcion=="nomina")
        include ("ppal/menu6.php");
         if ($opcion=="faventa")
        include ("ppal/menu10.php");
        if ($opcion=="servicio")
        include ("ppal/menu7.php");
         if ($opcion=="novedadnomina")
        include ("ppal/menu9.php");
         if ($opcion=="prestacion")
        include ("ppal/menuprestacion.php");
        if ($opcion=="cartalaboral")
        include ("ppal/menucartalaboral.php");
         if ($opcion=="exportar")
        include ("ppal/menuexportar.php");
        /*menu tuilidades*/
        if ($opcion=="clave")
          include ("ppal/menu1.php");
          /*menu salir*/
        if ($opcion=="salir")
        include ("salirzona.php");
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
