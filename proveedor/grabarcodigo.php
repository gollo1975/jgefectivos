<?
include("../conexion.php");
$concepto=strtoupper($concepto);
$consulta="insert into cree (codigocre,concepto,valor)
        values ('$codigo','$concepto','$valor')";
       $resultado=mysql_query($consulta) or die("Error al Grabar crees");
       $reg=mysql_affected_rows();
       ?>
       <script language="javascript">
          alert("Datos grabados con exito en sistema..!")
          open("agregaractividad.php","_self")
       </script>
       <?
?>
