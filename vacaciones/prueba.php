<html>

<head>
  <title>Consulta de vacaciones</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>

<body>
<?
if (!isset($valor)):
     ?>
     <center><h4><u>Vacaciones</u></h4></center>
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
    $opcion=" select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado where empleado.cedemple='$valor'";
    $re=mysql_query($opcion)or die ("Eror de consulta $opcion");
    $reg= mysql_num_rows($re);
    if ($reg!=0):
        while($filas=mysql_fetch_array($re)):
         ?>
         <table border="0" align="center">
           <tr class="cajas">
             <td>Presione Click sobre el Documento de Identidad para Ver las prestaciones Finales..</td>
           </tr>
          </table>
          <tr><td><br></td></tr>
         <tr class="cajas">
         <center><td><b>Documento:</b>&nbsp;<a href="detalladocesantia.php?valor=<? echo $filas["cedemple"];?>"><? echo $filas["cedemple"];?></td></center>
           <center><td><b>&nbsp;&nbsp;<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></b></td></center>
           </tr>
         <?
      endwhile;
      $consulta="select vacacion.* from empleado,vacacion where
           empleado.cedemple=vacacion.cedemple and
           vacacion.cedemple='$valor'";
       $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
       $registro=mysql_num_rows($resultado);
       if ($registro==0):
         ?>
        <script language="javascript">
        alert ("Este empleado no tiene vacaciones Generadas  ?")
       open("prueba.php","_self")  
        </script>
        <?
       else:
        ?>
          <tr><td><br></td></tr>
           <table border="0" align="center">
                    <tr class="cajas">
                      <td>Presione Click sobre el Nro_Vacacion para Ver el Reporte de Vacaciones..</td>
                    </tr>
                  </table>
            <table border="0" align="center">
               <tr>
                 <td colspan="30"></td>
               </tr>
               <tr class="cajas">
               <th>Nro</th>
                 <th>Nro_Vacacón</th>
                 <th>F._Proceso</th>
                 <th>F._Inicio</th>
                 <th>Fecha_Final</th>
                 <th>Dias</th>
                 <th>Ibc</th>
                 <th>Vlr_Pagado</th>
                  </tr>
                <? $con=1;
                 while($filas_s=mysql_fetch_array($resultado)):
                 $ibc=number_format($filas_s["ibc"],0);
                 $valor=number_format($filas_s["valor"],0);
                           ?>
                     <tr class="cajas align="center">
                     <th><?echo $con;?></th>
                       <td><a href="imprimir.php?codvaca=<?echo $filas_s["codvaca"];?>"><?echo $filas_s["codvaca"];?></a></td>
                        <td><?echo $filas_s["fechap"];?></td>
                       <td><?echo $filas_s["fechai"];?></td>
                       <td><?echo $filas_s["fechac"];?></td>
                       <td><?echo $filas_s["dias"];?></td>
                       <td><?echo $ibc;?></td>
                        <td><?echo $valor;?></td>
                        </tr>
                       <?
                       $con=$con+1;
                  endwhile;
                  ?>
                   </table>
                  <?
           endif;
     else:
        ?>
          <script language="javascript">
             alert("El documento digitado no existe en Sistema ?")
             open("prueba.php","_self")
          </script>
        <?
     endif;
 endif;
 ?>
</body>
</html>
