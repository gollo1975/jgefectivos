<LINK REL="stylesheet"  HREF="../estilo.css" type="text/css">
<?
 include("../conexion.php");
$con="select consignacion.nrocon,consignacion.fechapro,consignacion.valor from empleado,consignacion where
      empleado.cedemple=consignacion.cedemple and
      consignacion.fechapro between '$fechainic'and '$fechafinal' and
      empleado.cedemple='$cedula' order by consignacion.nrocon";
      $resul=mysql_query($con)or die("Consulta incorrecta una");
      $reg=mysql_num_rows($resul);
      if($reg!=0):
        ?>
        <center><h4><u>Listado</u></h4><center>
        <form action="guardar.php" method="post" id="matpago">
        <input type="hidden" name="cedula" value="<?echo $cedula ?>">
        <input type="hidden" name="fechainic" value="<?echo $fechainic ?>">
        <input type="hidden" name="fechafinal" value="<?echo $fechafinal ?>">
        <input type="hidden" name="fechagra" value="<?echo $fechagra ?>">
        <input type="hidden" name="nota" value="<?echo $nota ?>">
        <table border="0" align="center">
           <tr>
             <td colspan="2"><br></td>
           </tr>
           <tr>
            <th>Item</th>
            <th>Nro_Consignación</th>
            <th>Fecha_Proceso</th>
            <th>Vlr_Aporte</th>
          </tr>
          <? $a=1;
          while($filas=mysql_fetch_array($resul)):
          ?>
            <tr  class="cajas">
               <th><?echo $a;?></th>
               <td><?echo $filas["nrocon"];?></td>
               <td><?echo $filas["fechapro"];?></td>
               <td><?echo $filas["valor"];?></td>
            </tr>
            <?
            $a=$a+1;
            $suma=$suma+$filas["valor"];
         endwhile;
         $Xwin=number_format($suma,0);
         ?>
        </table>
       <td>&nbsp;</td>
        <center><td class="cajas"><b>Total Aporte:</b>&nbsp;&nbsp;$<?echo $Xwin?></td></center>
        <input type="hidden" name="suma" value="<?echo $suma ?>">
        <td><br></td>
        <tr>
          <td colspan="2"
          <td><input type="submit" value="Guardar Aporte" class="boton">
        </tr>
        </form>
        <?
     else:
       ?>
         <script language="javascript">
           alert("NO aportes Para este Empleados ?")
           history.back()
        </script>   
       <?
     endif;
  ?>
