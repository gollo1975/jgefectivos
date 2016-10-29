<form>
  <input type="hidden" value="<?echo $nit;?>" name="nit">
  <input type="hidden" value="<?echo $codex;?>" name="codex">
</form>
<?
        include("../conexion.php");
        $lista=$_POST["datos"];//diario va en mayuscula el post
        foreach ($lista as $dato)
        {
                $consulta="delete from decuenta where codigo='$dato'";
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
                header("location: agregar.php?nro=$nit&codex=$codex");
        }
?>
