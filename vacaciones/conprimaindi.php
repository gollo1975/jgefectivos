<html>

<head>
  <title>Consulta de Primas</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>

<body>
<?
if (!isset($valor)):
     ?>
     <center><h4><u>Compensación Semestral</u></h4></center>
    <form action="" method="post">
      <table border="0" align="center">
      <tr>
           <td colspan="2"><br></td>
      </tr>
       <tr>
         <td><b>Campo de Consulta:</b></td>
         <td><select name="campo">
            <option value="0">Documento
            </select></td>
       </tr>
       <tr>
         <td><b>Dato de Consulta:</b></td>
         <td><input type="text" name="valor" value="" size="20" maxlength="20"></td>
       </tr>
       <tr><td><br></td></tr>
      <tr>
        <td colspan="2">
          <input type="submit" value="Buscar" class="boton">
          <input type="reset" value="limpiar" class="boton">
        </td>
      </tr>
    </table>
    </form>
<?
elseif(empty($valor)):
?>
  <script language="javascript">
    alert ("Digite un valor a Consultar ?")
    history.back()
  </script>
 <?
  else:
    include("../conexion.php");
    $opcion=" select empleado.cedemple,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1  from empleado where empleado.cedemple='$valor'";
    $re=mysql_query($opcion)or die ("Eror de consulta $opcion");
    $reg= mysql_num_rows($re);
    if ($reg!=0):
        while($filas=mysql_fetch_array($re)):
         ?>
         <tr class="cajas">
         <center><td><b>&nbsp;&nbsp;<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></b></td></center>
           </tr>
         <?
      endwhile;
      $consulta="select prima.* from empleado,prima where
           empleado.cedemple=prima.cedemple and
           empleado.cedemple='$valor' order by nroprima DESC";
       $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
       $registro=mysql_num_rows($resultado);
       if ($registro==0):
         ?>
        <script language="javascript">
        alert ("Este empleado no tiene Primas Generadas  ?")
       open("conprimaindi.php","_self")
        </script>
        <?
       else:
        ?>
          <tr><td><br></td></tr>
           <table border="0" align="center">
                    <tr class="cajas">
                      <td>Presione Click sobre el Nro_Prima para Ver el Reporte ..</td>
                    </tr>
                  </table>
            <table border="0" align="center">
               <tr>
                 <td colspan="30"></td>
               </tr>
               <tr class="cajas">
               <th>#</th>
                 <th>Nro_Prima</th>
                 <th>F._Proceso</th>
                 <th>F._Inicio</th>
                 <th>Fecha_Final</th>
                 <th>Dias_Totales</th>
                 <th>Dias_Permiso</th>
                 <th>Ibc</th>
                 <th>Vlr_Pagado</th>
                  </tr>
                <?   $R=1;
                 while($filas_s=mysql_fetch_array($resultado)):
                 $salario=number_format($filas_s["salario"],0);
                 $total=number_format($filas_s["total"],0);
                           ?>
                     <tr class="cajas align="center">
                     <th><?echo $R;?></th>
                       <td><a href="imprimirprima.php?nroprima=<?echo $filas_s["nroprima"];?>"><?echo $filas_s["nroprima"];?></a></td>
                        <td><?echo $filas_s["fechap"];?></td>
                       <td><?echo $filas_s["fechainicio"];?></td>
                       <td><?echo $filas_s["fechacorte"];?></td>
                       <td><div align="center"><?echo $filas_s["dias"];?></div></td>
                       <td><div align="center"><?echo $filas_s["diadeduccion"];?></div></td> 
                       <td><?echo $salario;?></td>
                        <td><div align="right"><?echo $total;?></div></td>
                        </tr>
                       <?
                         $R=$R+1;
                  endwhile;
                  ?>
                   </table>
                  <?
           endif;
     else:
        ?>
          <script language="javascript">
             alert("El documento digitado no existe en Sistema ?")
            open("conprimaindi.php","_self") 
          </script>
        <?
     endif;
 endif;
 ?>
</body>
</html>
