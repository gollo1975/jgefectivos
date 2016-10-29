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
  <frameset rows="4,90,6" >
    <frame src="" name="encabezado" frameborder=0>
    <frame src="izqrecursoh.php" frameborder=0 scrolling=yes>
   <frame src="pie.php?msg= Calle 52 Nro 45-56 Of. 305 Tel. 2318120 " name="pie" frameborder=0>
   </frameset>
    <?
else:
?>
  <script language="javascript">
   alert("Acceso Incorrecto al Sistema ?")
   pagina='acceso/agregar.php'
   tiempo=10
   ubicacion='_self'
   setTimeout("open(pagina,ubicacion)",tiempo)
  </script>
  <?
endif;
?>
</html>
