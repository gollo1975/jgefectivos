<html>
<head>
<title>Consulta de Facturas</title>
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
<center><h4>Consulta de Facturas Pendientes</h4></center>
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
            $variable1="select pagar.*,provedor.nomprove,provedor.cuenta,provedor.tipoc,provedor.banco from sucursal,pagar,provedor where
                    sucursal.codsucursal=provedor.codsucursal and
                    provedor.nitprove=pagar.nitprove and
                    pagar.saldo > 0 and
                    pagar.fechaven between '$desde'and'$hasta' and
                    sucursal.codsucursal='$campo' order by provedor.nomprove, pagar.fechaven ASC";
        $resultado1=mysql_query($variable1)or die("consulta incorrecta");
        $registro=mysql_num_rows($resultado1);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("No hay Facturas Pendientes por pagar.")
            history.back()
          </script>
         <?
         else:
         ?>
         <table border="0" align="center">
           <tr><td class="cajas">Para ver el Detallado de la Factura o Documento, Presione Click Sobre el [Nro_Factura]..</td></tr>
         </table>
          <table border="0" align="center">
          <tr class="cajas">
             <th>Nro</th>
             <th class="fondo">Nro_Factura</th>
             <th class="fondo">Nit/Cedula</th>
              <th><div align="left">&nbsp;Proveedor</div></th>
              <th class="fondo">F_Proceso</th>
              <th class="fondo">F_Inicio</th>
              <th class="fondo">F_Ven.</th>
              <th class="fondo">Vlr_Pagar</th>
              <th class="fondo">Nro_Cta</th>
              <th class="fondo">Producto</th>
              <th class="fondo">Entidad</th>
              <th class="fondo">Tipo_Factura</th>
              </tr>
              <?
               $i=1;
             while($filas_s=mysql_fetch_array($resultado1)):
             $SaldoA=number_format($filas_s["saldo"],0);
             ?>
               <tr class="cajas">
                <th><?echo $i;?></th>
             <td><a href="detalladofactura.php?xbusca=<?echo $filas_s["nrofactura"];?>&nit=<?echo $filas_s["nitprove"];?>"><?echo $filas_s["nrofactura"];?></a></a></td>
                <td><?echo $filas_s["nitprove"];?></td>
                 <td><?echo $filas_s["nomprove"];?></td>
                  <td><?echo $filas_s["fechagra"];?></td>
                 <td><?echo $filas_s["fechaini"];?></td>
                 <td><?echo $filas_s["fechaven"];?></td>
                 <td><div align="right"><font color="red">$<?echo $SaldoA;?></font></div></td>
                 <td><?echo $filas_s["cuenta"];?></td>
                 <td><?echo $filas_s["tipoc"];?></td>
                 <td><?echo $filas_s["banco"];?></td>
                 <td><div align="center"><?echo $filas_s["tipofactura"];?></div></td>
                 </tr>
                <?
                $i=$i+1;
                $saldo=$saldo+$filas_s["saldo"];
              endwhile;
              $saldo=number_format($saldo,0);
              ?>
             </table>
              <center><tr><td class="cajas"><b><b>Total_Cartera:</b>&nbsp;<? echo $saldo;?></td></tr></center>
              <?
           endif;
         endif;
         ?>
        </table>
       </body>
  </html>
