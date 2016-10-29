<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<?
 include("../conexion.php");
        $consulta="select talla.*,sucursal.sucursal,zona.zona from empleado,talla,zona,contrato,sucursal where
        sucursal.codsucursal=zona.codsucursal and
        empleado.codzona=zona.codzona and
        empleado.codemple=contrato.codemple and
        empleado.cedemple=talla.cedemple and
        contrato.fechater='0000-00-00' and
        sucursal.codsucursal='$codigo'";
            $resultado=mysql_query($consulta)or die ("Error de busqueda de dotacion");
            $registro=mysql_num_rows($resultado);
if($registro!=0):
  ?>
     <table border="0" align="center">
        <tr>
           <td class="cajas"><b>Sucursal:</b>&nbsp;<?echo $sucursal;?></td>
        </tr>
     </table>
     <tr><td><br></td></tr>
        <table border="0" align="center">
        <tr class="cajas">
             <th>Item</th>
             <th>Ducumento</th>
             <th>Nombre</th>
             <th>zona</th>
             <th>Camisa</th>
             <th>Pantalón</th>
             <th>Zapato</th>
             <th>Fecha_P</th>
             <th>Fecha_M</th>
             </tr>
            <?
            $i=1;
             while($filas=mysql_fetch_array($resultado)):
           ?>
             <tr class="cajas">
              <th><div align="center"><?echo $i;?></div></th>
              <td><div align="center"><?echo $filas["cedemple"];?></div></td>
               <td><?echo $filas["nombre"];?></td>
                <td><?echo $filas["zona"];?></td>
               <td><div align="center"><?echo $filas["camisa"];?></div></td>
               <td><div align="center"><?echo $filas["pantalon"];?></div></td>
               <td><div align="center"><?echo $filas["zapato"];?></div></td>
              <td><div align="center"><?echo $filas["fechap"];?></div></td>
              <td><div align="center"><?echo $filas["fecham"];?></div></td>
               </tr>
               <?
                $i=$i+1;
             endwhile;
             ?>
             </table>
             <?
else:

?>
  <script language="javascript">
    alert("Esta sucursal no se le ha grabado la dotación ?")
    history.back()
  </script>
  <?
endif;
?>
