<html>

<head>
  <title>Nomina X Cent_Costo</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">

</head>

<?
if (!isset($campo)):
     include("../conexion.php");
    ?>
    <center><h4>Nomina X Cent_Costo</h4></center>
    <form action="" method="post" width="200">
       <table border="0" align="center">
          <tr><td>
            <table border="0" align="center">
           <tr class="fondo">
       <th colspan="8"><br></th>
       </tr>
  <tr>
    <td><b>Desde:</b></td>
    <td colspan="3"><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
    <td><b>Hasta:</b></td>
    <td colspan="3"><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
  </tr>
  <tr>
         <td><b>Zona:</b></td>
                              <td colspan="12"><select name="campo" class="cajas">
                              <option value="0">Seleccione la zona
                                <?
                                 $consulta_z="select * from zona where zona.nomina='SI' order by zona";
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
    <th colspan="2">
      <input type="submit" value="Buscar">
      <input type="reset" value="Limpiar">
    </th>
  </tr>
</table></td></tr>
</table>
</form>
<?
elseif (empty($campo)):
?>
  <script language="javascript">
    alert ("Despliegue la vista para eligir la zona ?")
    history.back()
  </script>
    <?
else:
   include("../conexion.php");
   ?>
    <center><h4><u>Nomina X Cent_Costo</u></h4></center>
      <form action="ConsolidadoCentro.php" method="post" width="200">
       <input type="hidden" name="desde" value="<? echo $desde;?>">
       <input type="hidden" name="hasta" value="<? echo $hasta;?>">
       <input type="hidden" name="CodZona" value="<? echo $campo;?>">
         <table border="0" align="center">
          <tr><td><br></td></tr>
	  <tr>
          <td><b>Zona:</b></td>
                              <td colspan="12"><select name="Buscar" class="cajas">
                              <option value="0">Centro de Costo
                                <?
                                 $ConC="select costo.codcosto,costo.centro from costo order by centro";
                                 $ResC=mysql_query($ConC)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($ResC)):
                                   ?>
                                   <option value="<?echo $filas_z["codcosto"];?>"> <?echo $filas_z["centro"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
           </tr>
           <tr><td><br></td></tr>
    <tr>
    <th colspan="2">
      <input type="submit" value="Buscar">
      <input type="reset" value="Limpiar">
    </th>
  </tr>
</table>
</form>
<?
endif;
?>


</body>
</html>
