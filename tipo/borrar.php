<?
        include("../conexion.php");
        $consulta="delete from tipo where tipocre='$tipocre'";
        $resultado=mysql_query($consulta) or die("Eliminacion Incorrecta");
        $registros=mysql_affected_rows();
        if ($registros==0)
        {
?>
                <script language="javascript">
                        alert("No se Elimino el Registro")
                        history.go(-2)
                </script>
<?
        }
        else
        {
?>
                <script language="javascript">
                        alert("Registro Eliminado")
                        history.go(-2)
                </script>
<?
        }
?>
