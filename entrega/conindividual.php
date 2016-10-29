<html>

<head>
<title>Entrega de Aportes Individual</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<script language="javascript">
        function imprimir(numero)// para declara funcion
        {
                pagina='imprimir.php?nroentrega=' + numero
                tiempo=100
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }

</script>
<?
if (!isset($campo)):

?>
  <center><h4>Aportes Sociales</h4></center>
  <form action="" method="post">
    <table border="0" align="center">
      <tr>
        <td colspan="2"></td>
      </tr>
      <tr><td><br></td></tr>
      <tr>
          <td><select name="campo">
                <option value="0">Seleccione una Opción
                <option value="cedemple">Documento
                <option value="nomemple">Nombre
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
                if ($campo=='cedemple'):
                  $consulta="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,entrega.* from empleado,entrega where
                             empleado.cedemple=entrega.cedemple and empleado.$campo='$valor'";

               else:
                  $consulta="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,entrega.* from empleado,entrega where
                                  empleado.cedemple=entrega.cedemple and empleado.$campo like '%$valor%'";

               endif;
                 $resultado=mysql_query($consulta) or die("consulta incorrecta");
                  $registros=mysql_num_rows($resultado);
                  $registro=mysql_affected_rows();
                  if ($registros==0):
                  ?>
                    <script language="javascript">
                                alert("No Existen Registros para este cliente ?")
                                history.back()
                        </script>
                    <?
                  else:
                  ?>
                  <center><h4><u>Entrega de Aportes</u></h4></center>
                    <table border="0" align="center">
                   <tr>
                     <td colspan="10"><br></td>
                   </tr>
                   <tr class="cajas" align="center">
                      <th><br></th>
                      <th class="fondo">Nro_Entrega</th>
                      <th class="fondo">Empleado</th>
                       <th class="fondo">F_Inicio</th>
                      <th class="fondo">F_Final</th>
                      <th class="fondo">F_Proceso</th>
                      <th class="fondo">Vlr_Total</th>
                   </tr>
                      <?
                     while($filas_s=mysql_fetch_array($resultado)):
                     ?>
                       <tr class="cajas">
                       <td><input type="button" value="Imprimir" onclick="imprimir('<?echo $filas_s["nroentrega"];?>')"></td>
                       <td><?echo $filas_s["nroentrega"];?></td>
                       <td><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["nomemple1"];?>&nbsp;<?echo $filas_s["apemple"];?>&nbsp;<?echo $filas_s["apemple1"];?></td>
                       <td><?echo $filas_s["fechainic"];?></td>
                         <td><?echo $filas_s["fechafinal"];?></td>
                         <td><?echo $filas_s["fechagra"];?></td>
                         <td><?echo $filas_s["valor"];?></td>

                         </tr>
                         <?
                         $suma=$suma + $filas_s["valor"];
                         endwhile;
                      ?>
                      </table>
                      <td>&nbsp;</td>
                      <center><td class="cajas"><b>Total Aporte:</b>&nbsp;&nbsp;<?echo $suma?></td></center>
               <?
           endif;

         endif;
         ?>

        </table>
       </body>
  </html>
