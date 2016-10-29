<LINK REL="stylesheet"  HREF="../estiloa.css" type="text/css">
<?
 $hasta=date("Y-m-d");
 include("../conexion.php");
 $consult="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,contrato.fechainic from contrato,empleado where
            empleado.codemple=contrato.codemple and
            contrato.fechater='0000-00-00' and
            empleado.cedemple='$cedula'";
 $resul=mysql_query($consult) or die("Consulta de empleado incorrecta");
 $regis=mysql_num_rows($resul);
 $filas=mysql_fetch_array($resul);
 $desde=$filas["fechainic"];
 if ($regis!=0):
      $con="select consignacion.nrocon,consignacion.fechapro,consignacion.valor from empleado,consignacion where
      empleado.cedemple=consignacion.cedemple and
      consignacion.fechapro between '$desde'and '$hasta' and
      empleado.cedemple='$cedula' order by consignacion.nrocon";
      $resul=mysql_query($con)or die("Consulta incorrecta una");
      $reg=mysql_num_rows($resul);
      if($reg!=0):
        ?>
        <center><h4><u>Aportes Social</u></h4><center>
          <tr>
             <td class="cajas" colspan="10"><div align="center"><b>Fecha_Inicio:</b>&nbsp;<?echo $desde;?></div></td>
           </tr>
           <tr><td><br></td></tr>
        <table border="1" align="center">
           <tr>
            <td><b>Nro_Consignación</b></td>
            <td><b>Fecha_Proceso</b></td>
            <td><b>Vlr_Aporte</b></td>
          </tr>
          <?
          while($filas=mysql_fetch_array($resul)):
          $valor=number_format($filas["valor"],0);
          ?>
            <tr  class="cajas">
               <td><?echo $filas["nrocon"];?></td>
               <td><?echo $filas["fechapro"];?></td>
               <td><?echo $valor;?></td>
            </tr>
            <?
            $suma=$suma+$filas["valor"];
         endwhile;
         $suma=number_format($suma,0);
         ?>
        </table>
       <td>&nbsp;</td>
        <center><td class="cajas"><b>Total Aporte:</b>&nbsp;&nbsp;$<?echo $suma?></td></center>
        <input type="hidden" name="suma" value="<?echo $suma ?>">
        <td><br></td>
        </form>
        <?
     else:
       ?>
         <script language="javascript">
           alert("No hay aportes Para este Empleados ?")
           history.back()
        </script>
       <?
     endif;
else:
   ?>
         <script language="javascript">
           alert("Este asociado no tiene contrato con la Cooperativa ?")
           history.back()
        </script>
       <?
endif;
  ?>

