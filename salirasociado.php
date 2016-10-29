<?
  session_start();
  $fin=session_unregister("xvalidar");
  session_destroy();
?>
<script language="javascript">
  pagina='acceso/accesoasociado.php'
  tiempo=10
  ubicacion='_parent'
  setTimeout("open(pagina,ubicacion)",tiempo)
</script>
