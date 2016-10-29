<html>

<head>
  <title>Consulta de Aporte Sociales</title>
   <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">

</head>
<body>
<?
  if (!isset($campo)):
  ?>
<center><h4>Consulta de Aporte Social</h4></center>
<form action="" method="post">
  <table border="0" align="center">
  <tr class="fondo">
       <td colspan="2"><br></td>
  </tr>
   <tr>
     <td><b>Campo de Consulta:</b></td>
     <td><select name="campo" class="cajas">
        <option value="0">Documento
        </select></td>
   </tr>
   <tr>
     <td><b>Ingrsese el Documento:</b></td>
     <td><input type="text" name="valor" value="" size="20" maxlength="20"></td>
   </tr>
   <tr><td><br></td></tr>
  <tr>
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
      <input type="reset" value="Limpiar"class="boton">
   </td>
  </tr>
</table>
</form>
<?
elseif (empty($valor)):
?>
  <script language="javascript">
    alert ("Digite Dato a Consultar ?")
    history.back()
  </script>
 <?
  else:
    include("../conexion.php");
    $consu="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado,sucursal,zona
          where sucursal.codsucursal=zona.codsucursal and
          zona.codzona=empleado.codzona and
          sucursal.codsucursal='$codigo' and
          empleado.cedemple='$valor'";
    $resulta=mysql_query($consu)or die ("Consulat incorrecta");
    $reg=mysql_num_rows($resulta);
    if ($reg==0):
       ?>
       <script language="javascript">
          alert("El Documento no existe en la tabla y/o este empleado no pertenece a esta zona ? ")
          history.back()
       </script>
       <?
    else:
        while($filas_s=mysql_fetch_array($resulta)):
        ?>
        <table border="0" align="center">
            <tr class="fondo">
              <td colspan="9"></td>
            </tr>
        <tr class="cajas">
         <td><b>Asociado:&nbsp;</b><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["nomemple1"];?>&nbsp;<?echo $filas_s["apemple"];?>&nbsp;<?echo $filas_s["apemple1"];?></td>

        <tr>
        </table>
        <?
        endwhile;
        $consulta="select entrega.nroentrega,fechainic,entrega.fechafinal,entrega.fechagra,entrega.valor from empleado,entrega where
        empleado.cedemple=entrega.cedemple and
        empleado.cedemple='$valor'";
        $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
        $registro=mysql_num_rows($resultado);
        if ($registro==0):
            ?>
            <script language="javascript">
            alert ("Este Empleado no tiene aportes Entregados ?")
            history.back()
            </script>
           <?
        else:
        ?>
          <center><h4>Listado de aportes</h4></center>
           <table border="1" align="center">
            <tr class="fondo">
              <td colspan="9"></td>
            </tr>
            <tr class="cajas">
              <th>Nro_Entrega</th>
              <th>Fecha_Inicio:</th>
              <th>Fecha_Final</th>
              <th>Fecha_Proceso</th> 
              <th>Total</th>
            </tr>
             <?
             while($filas=mysql_fetch_array($resultado)):
             $valor=number_format($filas["valor"],0);
             ?>
             <tr class="cajas">
               <td> <a href="imprimir.php?nroentrega=<?echo $filas["nroentrega"];?>"><?echo $filas["nroentrega"];?></a></td>
               <td><?echo $filas["fechainic"];?></td>
               <td><?echo $filas["fechafinal"];?></td>
               <td><?echo $filas["fechagra"];?></td>
               <td><?echo $valor;?></td>
               </tr>
               <?
               $suma=$suma+$filas["valor"];
             endwhile;
             $suma=number_format($suma,0);
            ?>
            </table>
            <tr><td><br></td></tr>
            <tr>
              <center><td><b>Total:</b>&nbsp;&nbsp;<?echo $suma?></td></center>
            </tr>
            <?
          endif;
    endif;
  endif;
  ?>
</table>

</body>
</html>
