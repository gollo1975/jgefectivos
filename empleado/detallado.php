<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<?
 include("../conexion.php");
        $consulta="select talla.*,zona.zona from empleado,talla,zona,contrato where
        empleado.codzona=zona.codzona and
        empleado.codemple=contrato.codemple and
        empleado.cedemple=talla.cedemple and
        contrato.fechater='0000-00-00' and
        zona.codzona='$codigo'";
            $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
            $registro=mysql_num_rows($resultado);
if($registro!=0):
  ?>
     <table border="0" align="center">
        <tr>
           <td class="cajas"><b>Zona:</b>&nbsp;<?echo $zona;?></td>
        </tr>
     </table>
     <tr><td><br></td></tr>
        <table border="0" align="center">
        <tr class="cajas">
             <th>Item</th>
             <th>Ducumento</th>
             <th>Nombre</th>
             <th>Camisa</th>
             <th>Pantal�n</th>
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
    alert("Esta zona no se le ha grabado la dotaci�n ?")
    history.back()
  </script>
  <?
endif;
?>
