<html>
<head>
  <title>Consulta de Nomina Por Empleado</title>
   <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
  

  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="../jquery-ui-1.10.4/jquery-1.10.2.js"></script>
  <script src="../jquery-ui-1.10.4/ui/jquery-ui.js"></script>
  <link rel="stylesheet" href="../jquery-ui-1.10.4/themes/base/jquery-ui.css">
  
  <script>
  $(function() {
    $( "#tabs" ).tabs();
  });
  </script>   
</head>
<body>
<?
  if (!isset($dato)):
    ?>
  <center><h4><u>Nomina Por Empleado</u></h4></center>
<form action="" method="post" width="200">
  <table border="0" align="center">
  <tr><td><br></td></tr>  
  <tr>
    <td><b>Documento de Identidad:</b></td>
    <td colspan="3"><input type="text" name="dato" value="" size="15" maxlegth="15"></td>
    </tr>
     <tr><td><br></td></tr>
   <tr>
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
      </td>
  </tr>
</table>
</form>
<?
elseif (empty($dato)):
?>
  <script language="javascript">
    alert ("Digite el documento del Empleado ?")
    history.back()
  </script>
    <?
 else:
       include("../conexion.php");
         $consulta="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado where
                 empleado.nomina='SI' and
                 empleado.cedemple='$dato'";
         $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
         $registro=mysql_num_rows($resultado);
         if ($registro==0):
    ?>
          <script language="javascript">
            alert ("El Empleado no existe en Sistemas. ?")
            history.back()
          </script>
   <?
         else:
             ?>
              <table border="0" align="center">
                <?
                while($filas=mysql_fetch_array($resultado)):
                  ?>
                 <tr>
                  <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
                  </tr>
                  <?
                endwhile;
                ?>
                </table>
                <?
              $consu="select nomina.*,empleado.nomemple,empleado.apemple,zona.zona from empleado,nomina,zona where
					zona.codzona=nomina.codzona and
			        empleado.cedemple=nomina.cedemple and
                    empleado.cedemple='$dato' order by nomina.desde DESC";
              $resulta=mysql_query($consu)or die ("Consulta incorrecta");
              $registro=mysql_num_rows($resulta);
              $registro=mysql_affected_rows();
              if ($registro!=0):
         ?>
                <center><h4><u>Listado de Colillas</u></h4></center>
                <table border="0" align="center">
                  <tr class="cajas">
                    <td>Para ver El Informe de las Colilla, Presione Click Sobre el Cod_Nómina.</td>
                  </tr>
                </table>
                  <table border="0" align="center">

                  <tr  class="cajas">
                      <th>Nro</th>
                      <th>Cod_Nomina</th>
                      <th>Cod_Periodo</th>
                       <th>F_Proceso</th>
                      <th>F_Inicio</th>
                      <th>F_Final</th>
					  <th>Zona</th>
                      <th>Deveng.</th>
                      <th>Deducido</th>
                      <th>Presta.</th>
					  <th>Pagado</th>
                    </tr>
                <?
                $i=1;
                while($filas_s=mysql_fetch_array($resulta)):
                   $aux=number_format($filas_s["neto"],0);
                   $aux1=number_format($filas_s["devengado"],0);
                   $aux2=number_format($filas_s["deduccion"],0);
                   $aux3=number_format($filas_s["presta"],0);
                   ?>
   	             <tr  class="cajas">
                     <th><?echo $i;?></th>
                     <td><a href="imprimir.php?codigo=<?echo $filas_s["consecutivo"];?>"><?echo $filas_s["consecutivo"];?></a></td>
                     <td><?echo $filas_s["codigo"];?></td>
                     <td>&nbsp;&nbsp;<?echo $filas_s["fechap"];?></td>
                     <td>&nbsp;&nbsp;<?echo $filas_s["desde"];?></td>
                     <td>&nbsp;&nbsp;<?echo $filas_s["hasta"];?></td>
					  <td>&nbsp;&nbsp;<?echo $filas_s["zona"];?></td>
                     <td>&nbsp;&nbsp;<?echo $aux1;?></td>
                     <td>&nbsp;&nbsp;<?echo $aux2;?></td>
                     <td>&nbsp;&nbsp;<?echo $aux3;?></td>
					  <td>&nbsp;&nbsp;<?echo $aux;?></td>
                     </tr>
                   <?
                   $i=$i+1;
                   $con=$con+$filas_s["presta"];
                    endwhile;
                    $con=number_format($con,0);
                    ?>
                    </table>
                    <tr><td>&nbsp;</td></tr>
                     <center><td class="cajas"><b>Vlr_Prestación:</b>&nbsp;&nbsp;<?echo $con;?></td></center>
				
                <?
              else:
               ?>
                <script language="javascript">
                  alert("Este Empleado no Tiene Colillas Generadas ..")
                  history.back()
                </script>
               <?
              endif;
         endif;
   endif;
  ?>
</table>

</body>
</html>
