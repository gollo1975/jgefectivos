<LINK REL="stylesheet"  HREF="../estiloa.css" type="text/css">
<?
 $hasta=date("Y-m-d");
 include("../conexion.php");
 $consult="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,contrato.fechainic from contrato,empleado where
            empleado.codemple=contrato.codemple and
            contrato.fechater='0000-00-00' and
            empleado.cedemple='$xcodigo'";
 $resul=mysql_query($consult) or die("Consulta de empleado incorrecta");
 $regis=mysql_num_rows($resul);
 $filas=mysql_fetch_array($resul);
 $desde=$filas["fechainic"];
 if ($regis!=0):
      $con="select consignacion.nrocon,consignacion.fechapro,consignacion.valor from empleado,consignacion where
      empleado.cedemple=consignacion.cedemple and
      consignacion.fechapro between '$desde'and '$hasta' and
      empleado.cedemple='$xcodigo' order by consignacion.nrocon";
      $resul=mysql_query($con)or die("Consulta incorrecta una");
      $reg=mysql_num_rows($resul);
      if($reg!=0):
        ?>
        <center><h4><u>Aportes al Fondo</u></h4><center>
        <table border="1" align="center">
           <tr>
             <td colspan="5"><br></td>
           </tr>
           <tr>
            <td><b>Nro_Pago</b></td>
            <td><b>F_Proceso</b></td>
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
           alert("No existen aportes para este Empleado.!")
           history.back()
        </script>
       <?
     endif;
else:
   ?>
         <script language="javascript">
           alert("Este empleado no tiene contrato con la Cooperativa ?")
           history.back()
        </script>
       <?
endif;
  ?>

