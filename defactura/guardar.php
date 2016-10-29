<?
        if (empty($concepto))
        {
?>
                <script language="javascript">
                        alert("Digite un concepto")
                        history.back()
                </script>
<?
        }
        else
        {
               $concepto=strtoupper($concepto);
                include("../conexion.php");
                $consulta="update listado set concepto='$concepto' where codcomp='$codcomp'";
                $resultado=mysql_query($consulta) or die("Actualizacion Incorrecta");
                $registros=mysql_affected_rows();
                if ($registros==0)
                {
?>
                        <script language="javascript">
                                alert("No se Actualizo el Registro")
                               open("modificar.php","_self")
                        </script>
<?
                }
                else
                {
?>
                        <script language="javascript">
                                alert("Registro Actualizado Correctamente ?")
                                 open("modificar.php","_self")
                        </script>
<?
                }
        }
?>
