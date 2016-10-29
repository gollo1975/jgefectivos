<?
 session_start();
?>
<html>
  <head>
  <title>JGEFECTIVOS S.A.S.</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">   
  </head>
  <?
  if(session_is_registered("xsession")):
?>
  <frameset rows="0,96,5" >
    <frame src="" name="encabezado" frameborder=0>
    <frame src="izqoperativo.php" frameborder=0 scrolling=yes>
   <frame src="pie.php?msg= Cle 34 Nro 66b-93 Edificio JG Pbx 444-8120 " name="pie" frameborder=0>
   </frameset>
    <?
else:
?>
  <script language="javascript">
   alert("Acceso Incorrecto a la base de datos ?")
   pagina='acceso/agregar.php'
   tiempo=10
   ubicacion='_self'
   setTimeout("open(pagina,ubicacion)",tiempo)
  </script>
  <?
endif;
?>
</html>
