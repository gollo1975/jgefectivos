<html>

<head>
<title>Consulta de cuentas de cobro por sucursal</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<script language="javascript">
        function imprimir(numero)// para declara funcion
        {
                pagina='imprimir.php?nrocuenta=' + numero
                tiempo=100
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }

</script>
<body>
<?
    include("../conexion.php");
     $variable="select cliente.cliente from cliente where
                 cliente.nit='$nit'";
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
                 <td><?echo $filas["cliente"];?></td>
               </tr>
                <?
              endwhile;

             include("../conexion.php");
            $variable1="select cuenta.* from cliente,cuenta where
                    cliente.nit=cuenta.nit and
                   cliente.nit='$nit'";
            $resultado1=mysql_query($variable1)or die("consulta incorrecta");
            $registro=mysql_num_rows($resultado1);
            if ($registro==0):
              ?>
              <script language="javascript">
                alert("No hay cuentas de cobro para este cliente ?.")
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
                  <td><br></td> 
                  <th class="fondo">Nro_Cuenta</th>
                 <th>Fecha_Inicio</th></center>
                  <th>Fecha_Vencimiento</th>
                  <th>Fecha_Proceso</th>
                  <th>Total</th>
                  <th>Saldo</th>
               </tr>
                  <?
                 while($filas_s=mysql_fetch_array($resultado1)):
                 ?>
                   <tr class="cajas">
                   <td><input type="button" value="Imprimir" onclick="imprimir('<?echo $filas_s["nrocuenta"];?>')"></td>
                   <td><?echo $filas_s["nrocuenta"];?></td>
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
