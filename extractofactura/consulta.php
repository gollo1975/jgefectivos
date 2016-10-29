<html>

<head>
  <title>Consulta de detallado de facturas</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<script language="javascript">
        function imprimir(numero)// para declara funcion
        {
                pagina='imprimir.php?autoriza=' + numero
                tiempo=100
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }

</script>


</head>
<body>
<?
  if (!isset($desde)):
     include("../conexion.php");
  ?>
 <center><h4>Consulta de detallado de facturas</h4></center>
<form action="" method="post">
  <table border="0" align="center">
  <tr  class="fondo">
       <td colspan="2"></td>
  </tr>
   <tr><td><br></td></tr>
   <tr>
     <td><b>Desde:</b></td>
       <td><input type="text" name="desde" value="<?echo date("Y-m-d");?>" size="10" maxlength="10"></td>
     </tr>
     <tr>
       <td><b>Hasta:</b></td>
       <td><input type="text" name="hasta" value="<?echo date("Y-m-d");?>" size="10" maxlength="10"></td>
     </tr>
     <tr>
       <td><b>Digite la Zona:</b></td>
       <td><select name="campo" class="cajas">
          <option value="0">Seleccione la zona
          <?
          $consulta_z="select * from zona order by zona";
          $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
          while($filas_z=mysql_fetch_array($resultado_z)):
            ?>
            <option value="<?echo $filas_z["codzona"];?>"> <?echo $filas_z["zona"];?>
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
     elseif(empty($hasta)):
    ?>
      <script language="javascript">
        alert ("Digite la fecha final ?")
        history.back()
      </script>
      <?
        elseif(empty($campo)):
        ?>
          <script language="javascript">
            alert ("Seleccione la zona de consulta ?")
            history.back()
          </script>
         <?
           else:
              include("..//conexion.php");
              $consulta="select extracto.autoriza,extracto.nrofactura,extracto.desde,extracto.hasta from extracto,factura,zona where
              zona.codzona=factura.codzona and
              factura.nrofactura=extracto.nrofactura and
              extracto.desde between '$desde' and '$hasta' and
              zona.codzona='$campo'";
              $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
              $registro=mysql_num_rows($resultado);
              if ($registro==0):
                 ?>
                 <script language="javascript">
                  alert ("No hay resultados de consulta. ?")
                  history.back()
                 </script>
                <?
              else:
               ?>
              <center><h4>Detallado de Factura por Zona</h4></center>
               <table border="0" align="center">
               <tr  class="fondo">
                 <td colspan="9"></td>
               </tr>
               <tr  class="cajas">

                  <th><br></th>
                  <th>Cod_Autorización</th>
                  <th>Nro_Factura</th>
                  <th>Inicio</th>
                  <th>Hasta</th>
                </tr>
            <?
               while($filas=mysql_fetch_array($resultado)):
           ?>
               <tr  class="cajas">
                 <td><input type="button" value="Imprimir" onclick="imprimir('<?echo $filas["autoriza"];?>')"></td>
                 <td><?echo $filas["autoriza"];?></td>
                 <td><a href="imprimirfa.php?nrofactura=<?echo $filas["nrofactura"];?>"><?echo $filas["nrofactura"];?></a></td>
                 <td><?echo $filas["desde"];?></td>
                 <td><?echo $filas["hasta"];?></td>
               </tr>
               <?
    endwhile;
    endif;
  endif;
  ?>
</table>

</body>
</html>
