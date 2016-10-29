<html>

<head>
  <title>Cesantias e Interes</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($campo)):
     include("../conexion.php");
  ?>
  <center><h4><u>Cesantias e Intereses</u></h4></center>
<form action="" method="post" id="f1" anme="f1">
  <table border="0" align="center">
  <tr><td><br></td></tr>
  <tr>
    <td><b>Desde:</b></td>
       <td><input type="text" name="Desde" value="<? echo date("Y-m-d");?>" class="cajas" size="11" maxlength="11"></td>
  </tr>
  <tr>
    <td><b>Hasta:</b></td>
       <td><input type="text" name="Hasta" value="<? echo date("Y-m-d");?>" class="cajas" size="11" maxlength="11"></td>
  </tr>
  <tr>
         <td><b>Zona:</b></td>
                              <td><select name="campo" class="cajas">
                              <option value="0">Seleccione la zona
                                <?
                                 $consulta_z="select zona.codzona,zona.zona from zona where zona.nomina='SI' order by zona";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codzona"];?>"><?echo $filas_z["zona"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
       </tr>
     <tr><td></td></tr>
      <tr><td></td></tr>
   <tr>
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
      <input type="reset" value="Limpiar"class="boton">
    </td>
  </tr>
   <tr><td></td></tr>
    <tr><td></td></tr>
</table>

</form>
<?
elseif (empty($campo)):
?>
  <script language="javascript">
    alert ("Despliegue la vista para eligir la zona ?")
    history.back()
  </script>
    <?
     else:
       include("../conexion.php");
         $consulta="select zona.zona from zona where
                 zona.codzona='$campo'";
         $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
         $registro=mysql_num_rows($resultado);
          ?>
            <table border="0" align="center">
                <?
            while($filas=mysql_fetch_array($resultado)):
               ?>
             <tr>
              <td><?echo $filas["zona"];?></td>

              </tr>
              <?
            endwhile;
            ?>
            </table>
            <?
          $consu="select cesantiainteres.*,empleado.basico from empleado,cesantiainteres where
          empleado.cedemple=cesantiainteres.cedemple and
          cesantiainteres.inicioperiodo = '$Desde' and
          cesantiainteres.fechafinal = '$Hasta' and
          cesantiainteres.codzona='$campo'order by cesantiainteres.nombre";
          $resu=mysql_query($consu)or die ("error al buscar cesantias");
          $reg=mysql_num_rows($resu);
          $reg=mysql_affected_rows();
          if ($reg != 0):
     ?>
            <center><h4>Listado de Empleados</h4></center>
            <table border="0" align="center">
              <tr class="cajas">
                <td>Para ver El Informe de las cesantias, Presione Click Sobre el Nro_Cesantia..</td>
              </tr>
            </table>
           <table border="0" align="center">
              <tr  class="cajas">
                  <th>#</th>
                  <th>Nro_Cesantia</th>
                 <th>Documento</th>
                 <th>Empleado</th>
                 <th>F._Inicio</th>
                 <th>F._Corte</th>
                 <th>F_Proceso</th>
                 <th>Basico</th>
                 <th>Ibc</th>
                 <th>Vlr_Cesantia</th>
                 <th>Vlr_Interes</th>
              </tr>
    <?      $j=1;
            while($filas_s=mysql_fetch_array($resu)){
                $Cesantia=number_format($filas_s["pagocesantia"],0);
                $Interes=number_format($filas_s["pagointeres"],0);
                $Ibc=number_format($filas_s["salario"],0);
                $Basico=number_format($filas_s["basico"],0);
                ?>
                <tr class="cajas align="center">
                     <th><?echo $j;?></th>
                       <td><a href="ImpCesantiaInteres.php?NroC=<?echo $filas_s["nrocesantia"];?>"><?echo $filas_s["nrocesantia"];?></a></td>
                        <td><?echo $filas_s["cedemple"];?></td>
                        <td><?echo $filas_s["nombre"];?></td>
                       <td><?echo $filas_s["fechainicio"];?></td>
                       <td><?echo $filas_s["fechafinal"];?></td>
                       <td><div align="center"><?echo $filas_s["fechap"];?></div></div></td>
                       <td><div align="right"><?echo $Basico;?></div></td>
                       <td><div align="right"><?echo $Ibc;?></div></td>
                       <td><div align="right"><?echo $Cesantia;?></div></td>
                        <td><div align="right"><?echo $Interes;?></div></div></td>
                 </tr>
                 <?
                $j=$j+1;
               $TotalC=$TotalC + $filas_s["pagocesantia"];
               $TotalI=$TotalI + $filas_s["pagointeres"];
            }
            $TotalC=number_format($TotalC);
            $TotalI=number_format($TotalI);
            ?>
            </table>
            <div align="center"><b>Total_Cesantia:&nbsp;$<?echo $TotalC;?>&nbsp;Total_Interes:&nbsp;$<?echo $TotalI;?></b></div>
            <?
          else:
            ?>
              <script language="javascript">
                alert("No Existen empleados con Primas en esta Zona")
                history.back()
             </script>
            <?

         endif;
  endif;
  ?>
</table>

</body>
</html>
