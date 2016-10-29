<html>
<head>
<title>Modificacion de contrato</title>
 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
if (!isset($cedula)):
?>
<center><h4><u>Crear Observación</u></h4></center>
  <form action="" method="post">
    <table border="0" align="center">
     <tr>
       <td colspan="2"><br></td>
     </tr
      <tr>
        <td><b>Documento Identidad:</b></td>
        <td><input type="text" name="cedula" value="" size="15" maxlength="15"</td>
      </tr>
      <tr><td><br></td></tr>
      <tr>
    <td colspan="2">
      <input type="submit" value="Buscar"class="boton">
      <input type="reset" value="Limpiar"class="boton">
    </td>
    </tr>
   </table>
   </form>
<?
elseif(empty($cedula)):
?>
  <script language="javascript">
    alert("Digite el documento de identidad ?")
    history.back()
  </script>
<?
  else:
    include("../conexion.php");
    $consulta="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1  from empleado where cedemple='$cedula'";
    $resultado=mysql_query($consulta)or die("Consulta incorrecta 1");
    $registro=mysql_num_rows($resultado);
    if ($registro!=0):
    ?>
     <table border="0" align="center">
       <?
       while($filas=mysql_fetch_array($resultado)):
         ?>
        <tr>
           <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple"];?></td>
        </tr>
        <?
        endwhile;
        ?>
      </table>
      <tr><td><br></td></tr>
      <?
      include("../conexion.php");
      $con="select contrato.contrato,contrato.fechainic,contrato.fechater,contrato.salario,contrato.cargo,contrato.nota,contrato.zona from empleado,contrato where empleado.codemple=contrato.codemple and empleado.cedemple='$cedula'";
      $resul=mysql_query($con)or die("Consulta incorrecta");
      $registro=mysql_num_rows($resul);
      if ($registro!=0):
         ?>
        <center><h4>Listado de Contratos<h4></center>
        <table border="0"align="center">
          <tr class="cajas">
            <td>Para agregar observaciones al contrato, Presione Click en el Nro_Contrato ..</td>
          </tr>
        </table>
        <tr><td><br></td></tr>   
        <table border="0" align="center">
          <tr>
               <td colspan="9"></td>
          </tr>
          <tr>
            <th>Nro_Contrato</th>
            <th>Fecha_Inicio</th>
            <th>Fecha_Final</th>
            <th>Salario</th>
            <th>Cargo</th>
            <th>Nota</th>
            <th>Zona</th>
          </tr>
          <?
             while($filas_s=mysql_fetch_array($resul)):
                $cambio=$filas_s["salario"];
               $xcambio= number_format($cambio,2);
               ?>
               <tr class="cajas">
                 <td><a href="nota.php?contrato=<?echo $filas_s["contrato"];?>"><?echo $filas_s["contrato"];?></a></td>
                 <td><?echo $filas_s["fechainic"];?></td>
                 <td><?echo $filas_s["fechater"];?></td>
                 <td><?echo $xcambio;?></td>
                 <td><?echo $filas_s["cargo"];?></td>
                  <td><?echo $filas_s["nota"];?></td>
                   <td><?echo $filas_s["zona"];?></td> 
               </tr>
               <?
             endwhile;
             ?>
             </table>
             <?
      else:
        ?>
        <script language="javascript">
          alert("NO hay contratos Para este Empleado ?")
          history.back()
        </script>
        <?
      endif;
    else:
      ?>
        <script language="javascript">
          alert("El Documento No existe en el sistema ?")
          history.back()
        </script>
        <?
    endif;
  endif;
       ?>
     </table>
     </form>
</body>
</html>
