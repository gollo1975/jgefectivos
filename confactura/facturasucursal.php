<html>

<head>
<title>Consulta de Factura por sucursal</title>
 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<script language="javascript">
        function volver()// para declara funcion
        {
                pagina='facturasucursal.php'
                tiempo=100
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }

</script>
<?
if (empty($desde)):
include("../conexion.php");
?>
<center><h4>Consulta de Factura por sucursal</h4></center>
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

  </form>
  <?
elseif (empty($campo)):
   ?>
   <script language="javascript">
     alert("Debe de seleccionar una sucursal")
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
         $resultado=mysql_query($variable)or die("consulta incorrecta");
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
                <tr><td><br></td></tr>
              <?
            endif;
             include("../conexion.php");
            $variable1="select zona.zona,factura.nrofactura,factura.fechaini,factura.fechaven,factura.fechagra,factura.subtotal,factura.iva,factura.grantotal,
                    factura.nsaldo,factura.estado from sucursal,zona,factura where
                    sucursal.codsucursal=zona.codsucursal and
                    zona.codzona=factura.codzona and
                    factura.fechaini between '$desde'and'$hasta' and
                    sucursal.codsucursal='$campo' order by factura.nrofactura";
        $resultado1=mysql_query($variable1)or die("consulta incorrecta");
        $registro=mysql_num_rows($resultado1);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("No facturas a nivel de sucursales.")
            history.back()
          </script>
         <?
         else:
         ?>

          <table align="center">
           <tr>
             <td class="cajas">Si desea ver los recibo de cajas, Presion Click Sobre el Nro de la Factura ?</td>
           </tr>
         </table>
         <tr><td><br></td></tr>
          <table border="0" align="center">
           <tr>
             <td colspan="30" class="fondo"></td>
           </tr>
           <tr class="cajas">
             <th class="fondo">Nro_Factura</th>
             <th class="fondo">Zona</th>
              <th class="fondo">F_Inicio</th>
              <th class="fondo">F_Venci.</th>
              <th class="fondo">F_Proceso</th>
              <th class="fondo">Subtotal</th>
              <th class="fondo">Iva</th>
              <th class="fondo">Total</th>
              <th class="fondo">N_Saldo</th>
              <th class="fondo">Estado</th>
              </tr>
              <?
             while($filas_s=mysql_fetch_array($resultado1)):
             $aux=number_format($filas_s["subtotal"],0);
             $aux1=number_format($filas_s["iva"],0);
             $aux2=number_format($filas_s["grantotal"],0);
             $aux3=number_format($filas_s["nsaldo"],0);
             ?>
               <tr class="cajas">
             <td>&nbsp;&nbsp;<a href="detalladorecibo.php?nrofactura=<?echo $filas_s["nrofactura"];?>"><?echo $filas_s["nrofactura"];?></a></td>
                <td>&nbsp;&nbsp;<?echo $filas_s["zona"];?></td>
                 <td>&nbsp;&nbsp;<?echo $filas_s["fechaini"];?></td>
                 <td>&nbsp;&nbsp;<?echo $filas_s["fechaven"];?></td>
                 <td>&nbsp;&nbsp;<?echo $filas_s["fechagra"];?></td>
                 <td>&nbsp;&nbsp;<?echo $aux;?></td>
                 <td>&nbsp;&nbsp;<?echo $aux1;?></td>
                 <td>&nbsp;&nbsp;<?echo $aux2;?></td>
                 <td>&nbsp;&nbsp;<?echo $aux3;?></td>
                 <td>&nbsp;&nbsp;<?echo $filas_s["estado"];?></td>
                 </tr>
                <?
              endwhile;
              ?>

              </table>
              <tr><td><br></td></br>
               <th><center><a href="imp2.php?campo=<?echo $campo;?>&desde=<?echo $desde;?>&hasta=<?echo $hasta;?>" target="_blank" onclick="volver()" class="fondo"><b>Imprimir Facturación</b></a></center></th>
               <?
           endif;
         endif;

         ?>

        </table>
       </body>
  </html>
