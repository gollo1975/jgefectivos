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
 $con="select  decentro.codsala from salario,decentro where salario.codsala=decentro.codsala and decentro.codsala='$codigo'";
 $re=mysql_query($con)or die("Error de Busqueda");
 $reg=mysql_num_rows($re);
 if ($reg!=0):
    $consulta="update decentro set porcentaje='$valor' where decentro.codsala='$codigo'";
    $resulta=mysql_query($consulta)or die ("Error en la Insercci�n");
    $registro=mysql_affected_rows();
    echo "<script language=\"javascript\">";
    echo "open (\"../pie.php?msg=Se actualizaron $registro  Registros, del C�digo Nro: $codigo\",\"pie\");";
    echo "open (\"porcentaje.php\",\"_self\");";
    echo "</script>";
 else:
   ?>
    <script language="javascript">
      alert("Este c�digo de Compensacion no existe en Sistema ?")
      history.back()
    </script>
   <?
 endif;
endif;
?>
