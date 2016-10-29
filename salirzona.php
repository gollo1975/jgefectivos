<?
  session_start();
  $fin=session_unregister("xzona");
  session_destroy();
?>
<script language="javascript">
  pagina='acceso/accesozona.php'
  tiempo=10
  ubicacion='_parent'
  setTimeout("open(pagina,ubicacion)",tiempo)
</script>
