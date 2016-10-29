<?
 session_start();
?>
<html>
  <head>
  <title>JGEFECTIVOS S.A.S.-Empresa de Servicio Temporales</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">   
  </head>
  <?
  if(session_is_registered("xzona")):
 ?>
  <frameset rows="0,95,5">
    <frame src="" name="encabezado" frameborder=0>
    <frame src="izqmenuzona.php" frameborder=0 scrolling=yes>
   <frame src="pie.php?msg= Cra 47 Nro 50-24 Of. 1211 Pbx 444-8120 " name="pie" frameborder=0>
   </frameset>
    <?
else:
?>
  <script language="javascript">
   alert("Error en la conexión a la base de datos ?")
   pagina='acceso/accesozona.php'
   tiempo=10
   ubicacion='_self'
   setTimeout("open(pagina,ubicacion)",tiempo)
  </script>
  <?
endif;
?>
</html>
