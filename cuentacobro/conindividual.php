<html>

<head>
<title>Consulta de cuentas de cobro invidual</title>
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

?>
  <center><h4>Cuentas de Cobro por Documento</h4></center>
  <form action="" method="post">
    <table border="0" align="center">
      <tr>
        <td colspan="2"></td>
      </tr>
       <tr><td><br></td></tr>
      <tr>
          <td><select name="campo">
                <option value="0">Seleccione una Opción
                <option value="nit">Documento
                <option value="cliente">Cliente
                <option value="telcliente">Telefono
           </select></td>
       <td><input type="text" name="valor" value="" size="40" maxleng="40"></td>
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
elseif (empty($valor)):
   ?>
   <script language="javascript">
     alert("Debe de digitar un dato")
     history.back()
   </script>
     <?
elseif (empty($campo)):
   ?>
   <script language="javascript">
     alert("Debe de seleccionar una opción")
     history.back()
   </script>
    <?
   else:
             include("../conexion.php");
               if ($campo=='nit' or $campo=='telcliente'):
                  $consulta="select cliente.*,cuenta.* from cliente,cuenta where
                              cliente.nit=cuenta.nit and cliente.$campo='$valor'";

               else:
                  $consulta="select cliente.*,cuenta.* from cliente,cuenta where
                                  cliente.nit=cuenta.nit and cliente.$campo like '%$valor%'";

               endif;
                 $resultado=mysql_query($consulta) or die("consulta incorrecta");
                  $registros=mysql_num_rows($resultado);
                  $registro=mysql_affected_rows();
                  if ($registros==0):
                  ?>
                    <script language="javascript">
                                alert("No Existen Registros para este cliente")
                                history.back()
                        </script>
                    <?
                  else:
                  ?>
                  <center><h4>Listado de Cuenta de Cobros</h4></center>

                    <table border="0" align="center">
                   <tr>
                     <td colspan="10" class="fondo"><br></td>
                   </tr>
                   <tr class="cajas" align="center">
                      <td><br></td>
                      <th class="fondo">Nro_Cuenta</th>
                       <th class="fondo">Fecha_Inicio</th>
                      <th class="fondo">Fecha_Vencimiento</th>
                      <th class="fondo">Fecha_Proceso</th>
                      <th class="fondo">Total</th>
                      <th class="fondo">&nbsp;Saldo</th>
                   </tr>
                      <?
                     while($filas_s=mysql_fetch_array($resultado)):
                     $aux=number_format($filas_s["total"],0);
                     $aux1=number_format($filas_s["nsaldo"],0);
                     ?>
                       <tr class="cajas">
                       <td><input type="button" value="Imprimir" onclick="imprimir('<?echo $filas_s["nrocuenta"];?>')"></td>
                       <td><?echo $filas_s["nrocuenta"];?></td>
                       <td><?echo $filas_s["fechaini"];?></td>
                         <td><?echo $filas_s["fechaven"];?></td>
                         <td><?echo $filas_s["fechagra"];?></td>
                         <td><?echo $aux;?></td>
                         <td>&nbsp;<?echo $aux1;?></td>

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
