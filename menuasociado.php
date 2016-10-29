<?
 session_start();
?>
<html>
  <head>
  <title>JGEFECTIVOS-Empresa de Servicios Temporales</title>
  <LINK  REL="stylesheet" HREF="estiloa.css"  type="text/css">
  </head>
  <body>
   <?
  if(session_is_registered("xtemporal")) :
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
               <a href="menuasociado.php?tipoM=CONSULTA"><font size=3>+</font></a> CONSULTA
            </div>
            <?
            if ($tipoMenu=="CONSULTA")
            {
            ?>
            <div class="itemmenu">
                <a href="menuasociado.php?op=aportesocial&xcodigo=<? echo $xtemporal;?>" target="contenido">Aporte al Fondo</a><Br>			
                <a href="menuasociado.php?op=cartalaboral&xcodigo=<? echo $xtemporal;?>" target="contenido">Certificados</a><Br>			
                <a href="menuasociado.php?op=colilla&xcodigo=<? echo $xtemporal;?>" target="contenido">Colillas de pago</a><Br>
                <a href="menuasociado.php?op=creditos&xcodigo=<? echo $xtemporal?>" target="contenido">Créditos</a><Br>
                <a href="menuasociado.php?op=incapacidad&xcodigo=<? echo $xtemporal;?>" target="contenido">Incapacidades</a><Br>
                <a href="menuasociado.php?op=prestacion&xcodigo=<? echo $xtemporal;?>" target="contenido">Prestaciones Sociales</a><Br>
                <a href="menuasociado.php?op=memorando&xcodigo=<? echo $xtemporal;?>" target="contenido">Proceso disciplinario</a><Br>
				<a href="solicitudSS/procesos.php?opc=3" target="contenido">Solicitudes Pendientes</a><Br>			
				
            </div>
            <?
            }
            ?>
            <div class="lbmenu">
                <a href="menuasociado.php?tipoM=UTILIDADES"><font size=3>+</font></a>UTILIDADES
            </div>
            <?
            if ($tipoMenu=="UTILIDADES")
            {
            ?>
            <div class="itemmenu">
                <a href="menuasociado.php?op=cambiodato&xcodigo=<? echo $xtemporal;?>" target="contenido">Cambiar Clave</a><Br>
           </div>
           <?
           }
           ?>
           <div class="lbmenu">
                <a href="menuasociado.php?tipoM=SALIR"><font size=3>+</font></a>CERRAR SESION
            </div>
            <?
            if ($tipoMenu=="SALIR")
            {
            ?>
            <div class="itemmenu">
                <a href="menuasociado.php?op=salir&op1admemp" target="contenido"><b>Salir</b></a><br>
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
      if ($opcion=="colilla")
        include ("asociado/menucolilla.php");
      if ($opcion=="creditos")
        include ("asociado/menucredito.php");
      if ($opcion=="incapacidad")
        include ("asociado/menuincapacidad.php");
      if ($opcion=="memorando")
        include ("asociado/menumemorando.php");
       if ($opcion=="prestacion")
        include ("asociado/menuprestacion.php");
        if ($opcion=="aportesocial")
        include ("asociado/menuaporte.php");
        if ($opcion=="cartalaboral")
        include ("asociado/menucarta.php");
        /*menu tuilidades*/
        if ($opcion=="cambiodato")
          include ("acceso/menu2.php");
          /*menu salir*/
        if ($opcion=="salir")
        include ("salirasociado.php");
     ?>
        </div>
         <?
else:
?>
  <script language="javascript">
   alert("El Usuario o Clave son Incorrectos para el ingreso")
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
