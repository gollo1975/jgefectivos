<?
  session_start();
  $fin=session_unregister("xdepto");
  session_destroy();
?>
<script language="javascript">
  pagina='acceso/agregardepartamento.php'
  tiempo=10
  ubicacion='_parent'
  setTimeout("open(pagina,ubicacion)",tiempo)
</script>
