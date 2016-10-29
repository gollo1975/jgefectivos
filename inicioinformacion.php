<?
 session_start();
?>
<html>
  <head>
  <title>Cooperativa  de Servicios Profesionales COOPISER</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">   
  </head>
  <?
  if(session_is_registered("xsession")):
?>
  <frameset rows="0,95,5" >
    <frame src="" name="encabezado" frameborder=0>
    <frame src="izqinformacion.php" frameborder=0 scrolling=yes>
   <frame src="pie.php?msg= Cra 47 Nro 50-24 Of. 1211 pbx 444-8120 " name="pie" frameborder=0>
   </frameset>
    <?
else:
?>
  <script language="javascript">
   alert("Acceso Incorrecto")
   pagina='acceso/agregar.php'
   tiempo=10
   ubicacion='_self'
   setTimeout("open(pagina,ubicacion)",tiempo)
  </script>
  <?
endif;
?>
</html>
