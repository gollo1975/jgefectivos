<html>

<head>
<title>Consulta de cuentas de cobro por sucursal</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<script language="javascript">
        function imprimir(numero)// para declara funcion
        {
                pagina='imprimir.php?nrocuenta=' + numero
                tiempo=100
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }

</script>
<?
if (!isset($campo)):
include("../conexion.php");
?>
  <center><h4>Consulta de Cuentas de Cobro por Fechas</h4></center>
  <form action="" method="post">
    <table border="0" align="center">
      <tr>
        <td colspan="2"></td>
      </tr>
       <tr>
        <td><b>Fecha_Inicio:</b></td>
         <td><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="10" maxlength="10"></td>
       </tr>
       <tr>
        <td><b>Fecha Final:<b></td>
         <td><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="10" maxlength="10"></td>
       </tr>
       <tr>
         <td><b>Digite la sucursal:</b></td>
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
           <input type="reset" value="Limpiar" class="boton">
       </td></tr>
    </table>
     </form>
  <?
elseif (empty($campo)):
   ?>
   <script language="javascript">
     alert("Debe de seleccionar una zona")
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
              <tr align="center"class="cajas">
                <td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sucursal</b></td>
              </tr>
              <?
             while($filas=mysql_fetch_array($resultado)):
             ?>
               <tr class="cajas">
                 <td><?echo $filas["sucursal"];?></td>
               </tr>
                <?
              endwhile;
            endif;
             include("../conexion.php");
            $variable1="select cuenta.*,cliente.cliente,cliente.nit from sucursal,cliente,cuenta where
                    sucursal.codsucursal=cliente.codsucursal and
                    cliente.nit=cuenta.nit and
                    cuenta.fechaini between '$desde'and'$hasta' and
                    sucursal.codsucursal='$campo'";
        $resultado1=mysql_query($variable1)or die("consulta incorrecta");
        $registro=mysql_num_rows($resultado1);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("No hay cuentas de cobro en ese rango de fechas.")
            history.back()
          </script>
         <?
         else:
         ?>

          <table border="0" align="center">
           <tr>
             <td colspan="10" class="fondo"><br></td>
           </tr>
           <tr class="cajas" align="center">

              <th class="fondo">Nit/Cedula</th>
             <th align="center">Cliente</th></center>
              <th class="fondo">Fecha_Inicio</th>
              <th class="fondo">Fecha_Vencimiento</th>
              <th class="fondo">Fecha_Proceso</th>
              <th class="fondo">Total</th>
              <th class="fondo">Saldo</th>
           </tr>
              <?
             while($filas_s=mysql_fetch_array($resultado1)):
             ?>
               <tr class="cajas">
                <td><a href="detallado.php?nit=<?echo $filas_s["nit"];?>"><?echo $filas_s["nit"];?></td>
                 <td><?echo $filas_s["cliente"];?></td>
                 <td><?echo $filas_s["fechaini"];?></td>
                 <td><?echo $filas_s["fechaven"];?></td>
                 <td><?echo $filas_s["fechagra"];?></td>
                 <td><?echo $filas_s["total"];?></td>
                 <td><?echo $filas_s["nsaldo"];?></td>

                 </tr>
                <?
              endwhile;
              ?>
              </table>

               <?
           endif;
         endif;
         ?>

        </table>
       </body>
  </html>
