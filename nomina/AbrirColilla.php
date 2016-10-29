<html>
<head>
  <title>Modificando Nomina</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
if(!isset($cedula)):

  ?>
  <center><h4><u>Colillas de Nomina</u></h4></center>
  <form action="" method="post">
    <table border="0" align="center">
     <tr><td><br></td></tr>
      <tr>
        <td><b>Documento de Identidad:</b></td>
       <td><input type="text" name="cedula" value="" size="15" maxlength="15"></td>
        </tr>
        <tr><td><br></td></tr>
        <td colspan="5">
         <input type="submit" value="Buscar" class="boton">
        </td>
    </table>
  </form>
  <?
elseif(empty($cedula)):
?>
  <script language="javascript">
    alert("Debe de digitar el documento del empleado ?")
    history.back()
  </script>
<?
else:
include("../conexion.php");
  $consulta="select empleado.cedemple,empleado.nomemple,empleado.apemple from empleado where empleado.cedemple='$cedula'";
    $resultado=mysql_query($consulta)or die("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
   if($registro!=0):
     ?>
        <table border="0" align="center">
            <?
          while($filas_s=mysql_fetch_array($resultado)):
              ?>
            <tr>
              <td><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["apemple"];?></td>
            </tr>
              <?
           endwhile;
            ?>
         </table>
      <?
      $con="select empleado.cedemple,empleado.nomemple,empleado.apemple,nomina.* from nomina,empleado
               where empleado.cedemple=nomina.cedemple and
                     empleado.cedemple='$cedula'";

      $res=mysql_query($con)or die("Consulta incorrecta $con");
      $reg=mysql_num_rows($res);
      if($reg!=0):
      ?>
      <center><h4><u>Colillas de Nomina</u></h4></center>
        <table border="0" align="center">
          <tr>
            <th>Reg.</th>
            <th>Cod_Nomina</th>
            <th>Fecha_Inicio</th>
            <th>Fecha_Corte</th>
            <th>Fecha_Proceso</th>
            <th>Vlr_Pagado</th>
          </tr>
      <?
          $a=1;
          while($filas=mysql_fetch_array($res)):
          $cambio=$filas["neto"];
          $xcambio= number_format($cambio,2);
            ?>
             <tr class="cajas">
             <th><? echo $a;?></th>
               <td><a href="DatosAbrir.php?codigo=<? echo $filas["consecutivo"];?>&Estado=<?echo $filas["estado"];?>"><? echo $filas["consecutivo"];?></a></td>
               <td><? echo $filas["desde"];?></td>
               <td><? echo $filas["hasta"];?></td>
               <td><? echo $filas["fechap"];?></td>
               <td><? echo $xcambio;?></td>
             </tr>
            <?
            $a=$a+1;
          endwhile;
          ?>
          </table>
          <?
      else:
        ?>
          <script language="javascript">
            alert("Este empleado NO presenta colillas en Sistema ?")
             history.back()
          </script>
         <?
      endif;
    else:
       ?>
          <script language="javascript">
            alert("El documento digitado No existe en sistema ?")
            history.back()
          </script>
        <?
    endif;
endif;
?>
</body>
<html>



