<?
if(empty($datos)){
   ?>
   <script language="javascript">
       alert("Seleccione el registro a eliminar del sistema!")
       history.back();
   </script>
  <?
}else{
        include("../conexion.php");
        $lista=$_POST["datos"];//diario va en mayuscula el post
        foreach ($lista as $dato)
        {
               $consulta="delete from dexamen where codigo='$codex' and conse='$dato'";
                $resultado=mysql_query($consulta) or die ("eliminacion incorrecta");
                $registros=mysql_affected_rows();
        }
        if ($registros==0)
        {
?>
                <script language="javascript">
                        alert("Registro(s) NO Eliminado(s)")
                        history.back();
                </script>
<?
        }
        else
        {
               header("location: agregar.php?codex=$codex&nro=$nit");
        }
 }
?>
