<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<?
 include("../conexion.php");
        $consulta="select empleado.*,zona.zona,contrato.*,pension.pension from empleado,pension,zona,contrato where
        empleado.codzona=zona.codzona and
        empleado.codpension=pension.codpension and
        empleado.codemple=contrato.codemple and
        contrato.fechater='0000-00-00' and
        pension.codpension='$codigo'";
            $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
            $registro=mysql_num_rows($resultado);
if($registro!=0):
  ?>
    <center><h4>Empleados Consultados</h4></center>
        <table boder="0" align="center">
          <tr class="cajas">
            <td>Para ver La información del Empleado, presione Click sobre el Documento de Identidad..</td>
          </tr>
        </table>
        <table border="0" align="center">
        <tr class="fondo">
          <td colspan="9"></td>
         </tr>
        <tr class="cajas">
             <th>Item</th>
             <th>Código</th>
             <th>Ducumento</th>
             <th>Nombres</th>
             <th>Apellidos</th>
             <th>zona</th>
             <th>Dirección</th>
             <th>Teléfono</th>
             <th>Salario</th>
             <th>Fecha_Ing.</th>
             </tr>
            <?
            $i=1;
             while($filas=mysql_fetch_array($resultado)):
           ?>
             <tr class="cajas">
                <th><? echo $i;?></td>
               <td><?echo $filas["codemple"];?></td>
              <td><a href="auxiliar.php?cedemple=<?echo $filas["cedemple"];?>"><?echo $filas["cedemple"];?></a></td>
               <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?></td>
               <td><?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
               <td><?echo $filas["zona"];?></td>
               <td><?echo $filas["diremple"];?></td>
              <td><?echo $filas["telemple"];?></td>
              <td><?echo $filas["salario"];?></td>
              <td><?echo $filas["fechainic"];?></td>
               </tr>
               <?
               $i=$i + 1;
             endwhile;
             ?>
             </table>
             <?
else:

?>
  <script language="javascript">
    alert("Datos no  encontrado")
    history.back()
  </script>
  <?
endif;
?>
