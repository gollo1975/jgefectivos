<td><input type="hidden" name="codigo" value="<? echo $codigo;?>"></td>
<td><input type="hidden" name="cedula" value="<? echo $cedula;?>"></td>
<?

if (empty($valor)):
  ?>
  <script language="javascript">
   alert("Debe de Ingresar el valor para el Cambio ?")
   history.back()
  </script>
  <?
else:
 include("../conexion.php");
 $con="select  decentro.codsala,decentro.codcentro from salario,decentro,empleado,centro
        where empleado.cedemple=centro.cedemple and
            centro.codcentro=decentro.codcentro and
            empleado.cedemple='$cedula' and
            decentro.codsala='$codigo'";
 $re=mysql_query($con)or die("Error de Busqueda");
 $reg=mysql_num_rows($re);
 $filas=mysql_fetch_array($re);
 $codextra=$filas["codcentro"];
 if ($reg!=0):
    $consulta="update decentro set vlrhora='$valor' where decentro.codsala='$codigo' and decentro.codcentro='$codextra'";
    $resulta=mysql_query($consulta)or die ("Error en la Insercción");
    $registro=mysql_affected_rows();
   echo "<script language=\"javascript\">";
    echo "open (\"../pie.php?msg=Se actualizaron $registro  Registros, del Código Nro: $codigo\",\"pie\");";
   echo "open (\"grabarextraindi.php\",\"_self\");";
    echo "</script>";
 else:
   ?>
    <script language="javascript">
      alert("Este código de Compensacion No lo tiene este Empleado ?")
      history.back()
    </script>
   <?
 endif;
endif;
?>
