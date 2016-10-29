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
          <div class="lbmenu">
                <a href="menusupervisor.php?tipoM=RETIRO"><font size=3>+</font></a>RETIRO
            </div>
            <?
            if ($tipoMenu=="RETIRO")
            {
            ?>
            <div class="itemmenu">
                <a href="menusupervisor.php?op=memorando&op1=admemp" target="contenido">Memorando</a><br>
                </div>
            <?
            }
            ?>
            <div class="lbmenu">
                <a href="menusupervisor.php?tipoM=CONSULTA"><font size=3>+</font></a>CONSULTA
            </div>
            <?
            if ($tipoMenu=="CONSULTA")
            {
            ?>
            <div class="itemmenu">
                <a href="menusupervisor.php?op=emple&op1admemp" target="contenido">Empleado por</a><br>
                <a href="menusupervisor.php?op=contra" target="contenido">Contrato de Trabajo</a><br>
                <a href="menusupervisor.php?op=zon" target="contenido">Zonas Por Sucursal</a><br>
                <a href="menusupervisor.php?op=listar" target="contenido">Listar Información de </a><br>
                <a href="menusupervisor.php?op=memo" target="contenido">Memorandos</a><br>
                <a href="menusupervisor.php?op=carne" target="contenido">Carnet de Empleado</a><br>
                <a href="menusupervisor.php?op=listarzo" target="contenido">Zona</a><br>
                <a href="menusupervisor.php?op=funera" target="contenido">Funeraria Por</a><br>
                <a href="menusupervisor.php?op=cursoecho" target="contenido">Curso Cooperativo</a><br>
            </div>
            <?
            }
            ?>
            <div class="lbmenu">
                <a href="menusupervisor.php?tipoM=REPORTES"><font size=3>+</font></a>REPORTES
            </div>
            <?
            if ($tipoMenu=="REPORTES")
            {
            ?>
            <div class="itemmenu">
                <a href="menusupervisor.php?op=asocia&op1admemp" target="contenido">Empleado por</a><br>
                <a href="menusupervisor.php?op=merca" target="contenido">Mercado por</a><br>
                <a href="menusupervisor.php?op=cartal" target="contenido">Carta Laboral</a><br>
                <a href="menusupervisor.php?op=presta" target="contenido">Prestaciones Sociales</a><br>
                <a href="menusupervisor.php?op=compe" target="contenido">Nomina Por</a><br>
                <a href="menusupervisor.php?op=reportenovedad" target="contenido">Novedades de Nomina</a><br>
                <a href="menusupervisor.php?op=exportar" target="contenido">Exportar Archivos</a><br>
            </div>
            <?
           }
           ?>
           <div class="lbmenu">
                <a href="menusupervisor.php?tipoM=UTILIDADES"><font size=3>+</font></a>UTILIDADES
            </div>
            <?
            if ($tipoMenu=="UTILIDADES")
            {
            ?>
            <div class="itemmenu">
                <a href="menusupervisor.php?op=clave&op1admemp" target="contenido"><b>Cambio de Clave</b></a><br>
           </div>
           <?
           }
           ?>
           <div class="lbmenu">
                <a href="menusupervisor.php?tipoM=SALIR"><font size=3>+</font></a>CERRAR CESION
            </div>
            <?
            if ($tipoMenu=="SALIR")
            {
            ?>
            <div class="itemmenu">
                <a href="menusupervisor.php?op=salir&op1admemp" target="contenido"><b>Salir</b></a><br>
            </div>
            <?
            }
            ?>
         </div>
        <div>
          <br><br>
         <?
     }
     /*menu retiro*/
      if ($opcion=="memorando")
        include ("memorando/menu.php");
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
      if ($opcion=="carne")
        include ("carnet/menu1.php");
      if ($opcion=="listarzo")
        include ("listarzona/menu1.php");
      if ($opcion=="funera")
        include ("funeraria/menu1.php");
        if ($opcion=="cursoecho")
        include ("curso/menu1.php");
        /*menu reporte*/
       if ($opcion=="asocia")
        include ("meneasociado.php");
       if ($opcion=="merca")
        include ("mercado/menu1.php");
        if ($opcion=="creditopor")
        include ("pagocredito/menu1.php");
        if ($opcion=="cartal")
          include ("cartalaboral/menu1.php");
        if ($opcion=="presta")
          include ("menuprestacion.php");
        if ($opcion=="compe")
        include ("nomina/menu.php");
        if ($opcion=="prim")
        include ("vacaciones/menu3.php");
         if ($opcion=="reportenovedad")
        include ("novedades/menu1.php");
        if ($opcion=="exportar")
        include ("exportacion/menu.php");
        /*menu utilidades*/
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
