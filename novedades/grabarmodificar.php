<input type="hidden" name="fechap" value="<? echo $fechap;?>" size="11">
<input type="hidden" name="desde" value="<? echo $desde;?>" size="11">
<input type="hidden" name="hasta" value="<? echo $hasta;?>" size="11">
<?
include("../conexion.php");
        $consulta=" update novedadindividual set cedemple='$cedula',nombre='$nombre',codzona='$codzona',zona='$zona',desde='$desde',hasta='$hasta',nota='$observacion'
         where novedadindividual.codnovedad='$codnovedad'";
        $resultado=mysql_query($consulta)or die("inserección incorrecta $consulta");
        $reg=mysql_affected_rows();
        if ($reg!=0):
            ?>
            <script language="javascript">
                alert("Datos Modificados y grabados con éxito ?")
                open("modificar.php","_self");
            </script>
            <?
        else:
           ?>
            <script language="javascript">
                alert("No se Grabaron datos en el sistema ?")
                open("modificar.php","_self");
            </script>
            <?
        endif;
?>
