<?
 session_start();
?>
<html>
  <head>
  <title>JGEFECTIVOS S.A.S.</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
  </head>
  <?
  if(session_is_registered("xdepto")):
 ?>
  <frameset rows="0,95,5">
    <frame src="" name="encabezado" frameborder=0>
    <frame src="izqmenudepartamento.php" frameborder=0 scrolling=yes>
   <frame src="pie.php?msg= Cra 47 Nro 50-24 Of. 1211 Pbx 444-8120 " name="pie" frameborder=0>
   </frameset>
    <?
else:
?>
  <script language="javascript">
   alert("Error al conectar la base de datos con el servidor ?")
   pagina='acceso/agregardepartamento.php'
   tiempo=10
   ubicacion='_self'
   setTimeout("open(pagina,ubicacion)",tiempo)
  </script>
  <?
endif;
?>
</html>
