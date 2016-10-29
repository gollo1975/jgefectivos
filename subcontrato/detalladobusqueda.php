<html>

<head>
  <title>Cargando Empleados</title>
   <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
   include("../conexion.php");
    $con="select subcontrato.nombre,subcontrato.cedemple,contrato.fechainic,contrato.salario from contrato,empleado,subcontrato
             where empleado.codemple=contrato.codemple and
                  empleado.cedemple=subcontrato.cedemple and
                  contrato.fechater='0000-00-00' and
                   subcontrato.contratista='$cedula' order by contrato.fechainic";
    $re=mysql_query($con)or die ("Error de Busqueda 1");
     $regi=mysql_num_rows($re);
     if ($regi!=0):
        ?>

          <center><h4>Listado de Empleados</h4></center>
          <table border="0" align="center">
              <tr class="cajas">
                  <td><b>Cedula</b></td>
               <td><b>&nbsp;Empleado</b></td>
               <td><b>Fecha_Inicio</b></td>
               <td><b>Salario</b></td>
            </tr>
            <?
            while($filas=mysql_fetch_array($re)):
            ?>
             <tr class="cajas">
               <td><? echo $filas["cedemple"];?></td>
              <td>&nbsp;<? echo $filas["nombre"];?></td>
              <td><? echo $filas["fechainic"];?></td>
              <td><? echo $filas["salario"];?></td>
            </tr>
            <?
            $i=$i+1;
         endwhile;
         ?>
           </table>
           <center><td><b>Nro:</b>&nbsp;<? echo $i;?></td></center>

         <?
        else:
          ?>
          <script language="javascript">
            alert ("Este contratista no tiene empleados a cargo ?")
            history.back()
          </script>
            <?
endif;
?>

</body>

</html>
