<input type="hidden" name="Nro" value="<? echo $Nro;?>">
<input type="hidden" name="CostoE" value="<? echo $CostoE;?>">
<?
include("../conexion.php");
$con="insert into detalladoexamen (conse,vlrexamen,nro) values('$Codigo','$vlrexamen','$Nro')";
$resultado=mysql_query($con) or die("Error al grabar registros  ");
/*consulta que permite actualizar saldo*/ 
$Sql="select detalladoexamen.vlrexamen from detalladoexamen
   where detalladoexamen.nro='$Nro'";
$Rs=mysql_query($Sql)or die ("Error al buscar valores");
$Suma = 0;
while($Linea = mysql_fetch_array($Rs)){
	$Suma += $Linea["vlrexamen"]; 
}
$conA="update examen set costoe='$Suma' where nro='$Nro'";
$resuA=mysql_query($conA) or die("Actualizacion de examen  ");
$registros=mysql_affected_rows();
   ?>
    <script language="javascript">
        open("DetalladoEditado.php?Nro=<?echo $Nro;?>","_self")
    </script>
<?
?>
