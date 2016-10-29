<?
  session_start();
  $fin=session_unregister("xsession");
  session_destroy();
?>
<script language="javascript">
  pagina='acceso/agregar.php'
  tiempo=10
  ubicacion='_parent'
  setTimeout("open(pagina,ubicacion)",tiempo)
</script>
