<html>

<head>
  <title>Exportar Nomina</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($Empresa)):
     include("../conexion.php");
  ?>
  <center><h4><u>Acumulado de Nómina</u></h4></center>
<form action="" method="post" width="200">
  <table border="0" align="center">
  <tr><td><br></td></tr>
  <tr>
    <td><b>Inicio_Nomina:</b></td>
    <td><input type="text" name="Desde" value="<? echo date("Y-m-d");?>" class="cajas" size="10" maxlegth="10"></td>
    <td><b>Final_Nomina:</b></td>
    <td><input type="text" name="Hasta" value="<? echo date("Y-m-d");?>" class="cajas" size="10" maxlegth="10"></td>
  </tr>
  <tr>
    <td><b>F_Creación:</b></td>
    <td><input type="text" name="Creacion" value="<? echo date("Y-m-d");?>" class="cajas" size="10" maxlegth="10"></td>
     <td><b>Empresa:</b></td>
                              <td colspan="12"><select name="Empresa" class="cajas">
                              <option value="0">Seleccione la empresa
                                <?
                                 $consulta_z="select codmaestro,nomaestro from maestro ";
                                 $resultado_z=mysql_query($consulta_z)or die ("Error al buscar empresa");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codmaestro"];?>"> <?echo $filas_z["nomaestro"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
   </tr>
   <tr><td><br></td></tr>
   <tr>
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
    </td>
  </tr>
</table>
</form>
<?
elseif (empty($Empresa)):
   ?>
   <script language="javascript">
    alert ("Seleccione la empresa de la lista!")
    history.back()
   </script>
   <?
else:
     include("../conexion.php");
     $con="select empleado.tipod,empleado.cedemple,empleado.apemple,empleado.apemple1,empleado.nomemple,empleado.nomemple1,empleado.diremple,municipio.codmuni,municipio.codepart from maestro,empleado,contrato,zona,sucursal,municipio
             where maestro.codmaestro=sucursal.codmaestro and
             sucursal.codsucursal=zona.codsucursal and
             zona.codzona=empleado.codzona and
             empleado.codmuni=municipio.codmuni and
             empleado.codemple=contrato.codemple and
             contrato.fechainic between '$Creacion' and '$Hasta' and
             maestro.codmaestro='$Empresa' order by empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1";
     $resu=mysql_query($con)or die("Error de Busqueda");
     $reg=mysql_num_rows($resu);
     if ($reg==0):
          ?>
           <script language="javascript">
             alert("No hay aportes sociales en este rango de fechas ?")
             history.back()
           </script>
          <?
     else:
          header("Content-type: application/vnd.ms-excel");
          header("Content-Disposition: attachment; filename=Aporte Social.xls");
          header("Pragma: no-cache");
          header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
          header("Expires: 0");
             ?>
             <table border="0" align="center">
                 <tr class="cajas">
                        <td style='font-weight:bold;font-size:1.1em;'>T.DOC.</td>
                        <td style='font-weight:bold;font-size:1.1em;'>NIT</td>
                        <td style='font-weight:bold;font-size:1.1em;'>DV</td>
                        <td style='font-weight:bold;font-size:1.1em;'>1 APELLIDO</td>
                        <td style='font-weight:bold;font-size:1.1em;'>2 APELLIDO</td>
                        <td style='font-weight:bold;font-size:1.1em;'>1 NOMBRE</td>
                        <td style='font-weight:bold;font-size:1.1em;'>2 NOMBRE</td>
                        <td style='font-weight:bold;font-size:1.1em;'>DIRECCION</td>
                        <td style='font-weight:bold;font-size:1.1em;'>COD_DPTO</td>
                        <td style='font-weight:bold;font-size:1.1em;'>COD_MUNICIPIO</td>
                        <td style='font-weight:bold;font-size:1.1em;'>VLR_DEVENGADO</td>

                 </tr>
             <?
                 $i=1;
              while($filas=mysql_fetch_array($resu)):
               $AuxC=$filas["cedemple"];
               $consulta="SELECT SUM( nomina.devengado ) 'ConNomina'
			FROM nomina, empleado
			WHERE empleado.cedemple = nomina.cedemple
			AND empleado.cedemple = '$AuxC'
			AND nomina.desde
			BETWEEN '$Desde'
			AND '$Hasta'
			GROUP BY empleado.cedemple";
                 $resul=mysql_query($consulta) or die("Error en la busqueda de Nominas");
                 $registro=mysql_affected_rows();
                 $filas_s=mysql_fetch_array($resul)
                 ?>
               <tr class="cajas">
               <td style='font-weight;font-size:0.9em;'><div align="left"><?echo $filas["tipod"];?></div></td>
                <td style='font-weight;font-size:0.9em;'><div align="left"><?echo $filas["cedemple"];?></div></td>
                <td style='font-weight;font-size:0.9em;'><div align="left"></div></td>
               <td style='font-weight;font-size:0.8em;'><?echo $filas["apemple"];?></td>
               <td style='font-weight;font-size:0.8em;'><?echo $filas["apemple1"];?></td>
               <td style='font-weight;font-size:0.8em;'><?echo $filas["nomemple"];?></td>
               <td style='font-weight;font-size:0.8em;'><?echo $filas["nomemple1"];?></td>
               <td style='font-weight;font-size:0.8em;'><?echo $filas["diremple"];?></td>
               <td style ='font-weight;font-size:0.9em;'><?echo $filas["codepart"];?></td>
               <td style='font-weight;font-size:0.8em;'><?echo $filas["codmuni"];?></td>
              <td style ='font-weight;font-size:0.9em;'><?echo $filas_s["ConNomina"];?></td>
               </tr>
               <?
              $i=$i+1;

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
