<?
        include("../conexion.php");
        $lista=$_POST["datos"];//diario va en mayuscula el post
        foreach ($lista as $dato)
        {
                $consulta="delete from depagozona where radicado='$codex' and conse='$dato'";
                $resultado=mysql_query($consulta) or die ("eliminacion incorrecta");
                $cons="update incapacidad set pagada='' where incapacidad.nroinca='$numero'";
                $res1=mysql_query($cons)or die("Error de actualizacion en la table examen");
                echo $cons;
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
               header("location: agregarpago.php?codex=$codex&nro=$nro");
        }
?>
