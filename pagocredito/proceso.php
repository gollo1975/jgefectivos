<html>
<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
if (!isset($campo)):?>
  <center><h5>Consulta de Abonos por Crédito</h5></center>
  <form action="" method="post">
  <table border="0" align="center" width="300">
    <tr>
    <tr><td><br></td></tr>
        <?
        include("../conexion.php");?>
        <tr>
           <td><b>Desde:</b></td>
           <td><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="10"</td>
        </tr>
        <tr>
           <td><b>Hasta:</b></td>
           <td><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="10"</td>
        </tr>
         <tr>
         <td><b>Sucursal:</b></td>
                              <td><select name="campo" class="cajas">
                              <option value="0">Seleccione la Suscursal
                                <?
                                 $consulta_z="select sucursal.codsucursal,sucursal.sucursal  from sucursal  order by sucursal.sucursal";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codsucursal"];?>"><?echo $filas_z["sucursal"];?>
                                  <?
                                endwhile;
                                 ?>
                                </select></td>
                               </tr>
                                 <tr>
   
                               <td><b>Cod_Salario</b></td>
                                <td><select name="codsalario" class="cajas">
                                <?
                                $consulta = "select codsala,desala from salario order by desala";
                                $result = mysql_query ($consulta) or die ("Error en la consulta");
                                while($linea=mysql_fetch_array($result))
                                  {
                                  ?>
                                  <option value="<?echo $linea["codsala"];?>"><?echo $linea["desala"];?>
                                  <?
                                   }
                             ?></select></td>
            
       </tr>

           <tr><td><br></td></tr>
          <tr>
         <td colspan="2">
           <input type="submit" value="Buscar" class="boton">
           <input type="reset" value="Limpiar"class="boton"> </td>
       </tr>
     </table>
   </form>
 <?
 elseif (empty($campo)):
   ?>
   <script language="javascript">
     alert("Debe de seleccionar la sucursal ?")
     history.back()
   </script>
   <?
 elseif (empty($codsalario)):
     ?>
   <script language="javascript">
     alert("Debe de seleccionar la línea de crédito ?")
     history.back()
   </script>
   <?
 else:
    include("../conexion.php");
    $consulta="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,zona.zona,credito.nuevo,credito.nrocredito,credito.codsala,salario.desala,abono.abono,abono.fecha from sucursal,zona,empleado,credito,salario,abono where
        sucursal.codsucursal=zona.codsucursal and
        zona.codzona=empleado.codzona and
        empleado.cedemple=credito.cedemple and
        credito.codsala=salario.codsala and
        credito.nrocredito=abono.nrocredito and
        empleado.cedemple=abono.cedemple and
        abono.fecha between '$desde' and '$hasta' and
        sucursal.codsucursal='$campo' and
        salario.codsala='$codsalario' order by empleado.cedemple, zona.zona";
        $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
        $registro=mysql_num_rows($resultado);
        if($registro!=0):
           ?>
          <center><h5>Listado de Abonos</h5></center>
            <table boder="0" align="center">
              <tr class="cajas">
                <td>Para ver los Crédito , presione Click sobre el Documento de Identidad..</td>
              </tr>
            </table>
                <table border="0" align="center">
                <tr class="fondo">
                  <td colspan="9"></td>
                 </tr>
                <tr class="cajas">
                     <th>Documento</th>
                     <th>Asociado</th>
                     <th>zona</th>
                     <th>Nro_Crédito</th>
                     <th>Abono</th>
                     <th>Fecha_Abono</th>
                     <th>Saldo</th>
                </tr>
                    <?
                     while($filas=mysql_fetch_array($resultado)):
                      $aux1=number_format($filas["abono"],0);
                      $aux2=number_format($filas["nuevo"],0);
                   ?>
                     <tr class="cajas">
                      <td><a href="detalladocredito.php?cedemple=<?echo $filas["cedemple"];?>"><?echo $filas["cedemple"];?></a></td>
                       <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
                       <td><?echo $filas["zona"];?></td>
                      <td><?echo $filas["nrocredito"];?></td>
                      <td><?echo $aux1;?></td>
                      <td><?echo $filas["fecha"];?></td>
                      <td><?echo $aux2;?></td>
                       </tr>
                       <?
                       $suma=$suma + $filas["abono"];
                       $suma1=$suma1 + $filas["nuevo"];
                     endwhile;
                     $suma=number_format($suma,0);
                     $suma1=number_format($suma1,0);
                     ?>
                     </table>
                 <tr>
                     <center><td><b>Total_Abono:</b>&nbsp;<?echo $suma;?>&nbsp;<b>Total_Saldo:</b>&nbsp;<?echo $suma1;?></td></center>
                  </tr>
                     <?
        else:
         ?>
          <script language="javascript">
            alert("No hay abonos en el rango de Fechas Seleccionada ?")
            history.back()
          </script>
          <?
        endif;
 endif
 ?>
</body>
</html>
