<?
 session_start();
?>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<?
if(session_is_registered("xdepto")):
        include("../conexion.php");
            $variable1="select notacredito.* from factura,notacredito where
                    factura.nrofactura=notacredito.nrofactura and
                    factura.nrofactura='$nrofactura'";
                   $resultado1=mysql_query($variable1)or die("consulta incorrecta dos");
           $registro=mysql_num_rows($resultado1);
           if ($registro==0):
           ?>
           <script language="javascript">
             alert("No existen Notas Crédito para esta Factura ?")
             history.back()
          </script>
         <?
         else:
         ?>
         <center><h4>Listado de Notas Crédito</h4></center>
         <table border="0" align="center">
           <tr class="cajas">
             <td>Para ver por pantalla la Nota Crédito, Presione click sobre el Campo [NRO_NOTA]..</td>
           </tr>
         </table>
         <table border="0" align="center">
           <tr class="cajas">
             <td>Para ver por pantalla la Factura, Presione click sobre el Campo [NRO_FACTURA]..</td>
           </tr>
         </table>
           <table border="1" align="center">
           <tr>
             <td colspan="30" class="fondo"></td>
           </tr>
           <tr class="cajas">
              <th class="fondo">Nro_Nota</th>
              <th class="fondo">Nro_Factura</th>
              <th class="fondo">Fecha_Proceso</th>
              <th class="fondo">Valor</th>


              </tr>
              <?
             while($filas_s=mysql_fetch_array($resultado1)):
             ?>
               <tr class="cajas">
                <td> <a href="../notacredito/imprimir.php?nronota=<?echo $filas_s["nronota"];?>"><?echo $filas_s["nronota"];?></a></td>
                 <td> <a href="../factura/imprimir.php?nrofactura=<?echo $filas_s["nrofactura"];?>&estado=1"><?echo $filas_s["nrofactura"];?></a></td>
                <td><?echo $filas_s["fecha"];?>&nbsp;<?echo $filas_s["apemple"];?></td>
                 <td><?echo $filas_s["valor"];?></td>
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
else:
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Sección")
    pagina='../acceso/agregar.php'
    tiempo=10
    ubicacion='_self'
    setTimeout("open(pagina,ubicacion)",tiempo)
 </script>
<?
endif;           

         ?>

        </table>

       </body>
  </html>
