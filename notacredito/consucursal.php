<html>

<head>
<title>Notas Creditos por Sucursal</title>
 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
 <script language="javascript">
        function imprimir(numero)// para declara funcion
        {
                pagina='imprimir.php?nronota=' + numero
                tiempo=100
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }

</script>
<?
if (!isset($campo)):
include("../conexion.php");
?>
<center><h4>Notas Creditos por Sucursal</h4></center>
  <form  action="" method="post">
    <table border="0" align="center">
      <tr>
        <td colspan="2" class="fondo"></td>
      </tr>
       <tr><td><br></td></tr>
       <tr>
        <td><b>Fecha_Inicio:</b></td>
         <td><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="10" maxlength="10"></td>
       </tr>
       <tr>
        <td><b>Fecha Final:</b></td>
         <td><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="10" maxlength="10"></td>
       </tr>
       <tr>
         <td><b>Sucursal:</b></td>
                              <td><select name="campo" class="cajas">
                              <option value="0">Seleccione la sucursal
                                <?
                                 $consulta_z="select * from sucursal order by sucursal";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codsucursal"];?>"> <?echo $filas_z["sucursal"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
       </tr>
       <tr><td><br></td></tr>
       <tr>
         <td colspan="2">
           <input type="submit" value="Buscar" class="boton">
           <input type="reset" value="Limpiar"class="boton"> </td>
       </tr>
    </table>
    <br>

  </form>
  <?
elseif (empty($campo)):
   ?>
   <script language="javascript">
     alert("Debe de seleccionar una Sucursal ?")
     history.back()
   </script>
    <?
elseif (empty($desde)):
   ?>
   <script language="javascript">
     alert("Debe colocar la fecha inicio")
     history.back()
   </script>
   <?
   else:
     include("../conexion.php");
     $variable="select sucursal.sucursal from sucursal where
                 sucursal.codsucursal='$campo'";
         $resultado=mysql_query($variable)or die("consulta incorrecta uno");
        $registro=mysql_num_rows($resultado);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("La sucursal no existe en la bd.")
            history.back()
          </script>
         <?
         else:
         ?>
          <table border="0" align="center">
             <?
             while($filas=mysql_fetch_array($resultado)):
             ?>
               <tr class="cajas">
                 <td><?echo $filas["sucursal"];?></td>
               </tr>
                <?
              endwhile;
              ?>
              </table>
              <?
            endif;
             include("../conexion.php");

            $variable1="select notacredito.nronota,notacredito.nrofactura,notacredito.zona,notacredito.nit,notacredito.valor,notacredito.fecha from sucursal,zona,factura,notacredito where
                    sucursal.codsucursal=zona.codsucursal and
                    zona.codzona=factura.codzona and
                    factura.nrofactura=notacredito.nrofactura and
                   notacredito.fecha between '$desde'and'$hasta' and
                    sucursal.codsucursal='$campo' order by zona.zona ";
        $resultado1=mysql_query($variable1)or die("consulta incorrecta dos");
        $registro=mysql_num_rows($resultado1);
          if ($registro==0):
          ?>
          <script language="javascript">
            alert("No existen Notas Crédito a nivel de sucursales.")
            history.back()
          </script>
         <?
         else:
         ?>
               <tr><td><br></td></td>
          <table boder="0"align="center">
            <tr class="cajas">
             <td>Para ver el Informe de la Nota Credito, Presione Click sobre el [Nro_Nota]</td>
           </tr>
         </table>
           <table border="0"align="center">
           <tr class="cajas">
             <td>Para ver el Informe de la Factura de Venta, Presione Click sobre el [Nro_Factura]</td>
           </tr>
         </table>
          <table border="0" align="center">
           <tr>
             <td colspan="30" class="fondo"></td>
           </tr>
           <tr class="cajas">
              <th class="fondo">Nro_Nota</th>
              <th class="fondo">Nro_Factura</th>
              <th class="fondo">Fecha_Proceso</th>
              <th class="fondo">Valor</th>
              <th class="fondo">Zona</th>


              </tr>
              <?
             while($filas_s=mysql_fetch_array($resultado1)):
             ?>
               <tr class="cajas">
                <td> <a href="imprimir.php?nronota=<?echo $filas_s["nronota"];?>"><?echo $filas_s["nronota"];?></a></td>
                 <td> <a href="../factura/imprimir.php?nrofactura=<?echo $filas_s["nrofactura"];?>"><?echo $filas_s["nrofactura"];?></a></td>
                <td><?echo $filas_s["fecha"];?>&nbsp;<?echo $filas_s["apemple"];?></td>
                 <td><?echo $filas_s["valor"];?></td>
                 <td><?echo $filas_s["zona"];?></td>
                </tr>
                <?
                  $suma=$suma+$filas_s["valor"];
              endwhile;
              ?>
              </table>
              <tr><td><br></td></tr>
            <tr>
              <center><td><b>Total:</b>&nbsp;&nbsp;<?echo $suma?></td></center>
            </tr>

               <?
           endif;
         endif;
         ?>

        </table>

       </body>
  </html>
