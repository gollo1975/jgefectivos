<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<?
 include("../conexion.php");
        $consulta="select empleado.*,zona.zona,contrato.*,eps.eps from empleado,eps,zona,contrato where
        empleado.codzona=zona.codzona and
        empleado.codeps=eps.codeps and
        empleado.codemple=contrato.codemple and
        contrato.fechater='0000-00-00' and
                eps.codeps='$codigo'";
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
             <th>Cod_Empleado</th>
             <th>Ducumento:</th>
             <th>Nombre</th>
             <th>Apellido</th>
             <th>zona</th>
             <th>Dirección</th>
             <th>Teléfono</th>
             <th>Salario</th>
             <th>Fecha_Ing.</th>
             </tr>
            <?
             while($filas=mysql_fetch_array($resultado)):
           ?>
             <tr class="cajas">
               <td><?echo $filas["codemple"];?></td>
              <td>&nbsp;&nbsp; <a href="auxiliar.php?cedemple=<?echo $filas["cedemple"];?>"><?echo $filas["cedemple"];?></a></td>
               <td>&nbsp;&nbsp;<?echo $filas["nomemple"];?></td>
               <td>&nbsp;&nbsp;<?echo $filas["apemple"];?></td>
               <td>&nbsp;&nbsp;<?echo $filas["zona"];?></td>
               <td>&nbsp;&nbsp;<?echo $filas["diremple"];?></td>
              <td>&nbsp;&nbsp;<?echo $filas["telemple"];?></td>
              <td>&nbsp;&nbsp;<?echo $filas["salario"];?></td>
              <td>&nbsp;&nbsp;<?echo $filas["fechainic"];?></td>
               </tr>
               <?
               $suma=$suma + 1;
             endwhile;
             ?>
             </table>
         <tr>
             <center><td>Total:&nbsp;<?echo $suma;?></td></center>
          </tr>
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
