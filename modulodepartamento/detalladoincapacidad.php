<html>
<head>
<title>Grabando registro</title>
<LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
</head>
<body>
<?
if(empty($nroinca)):
else:
    include("../conexion.php");
    $consulta="select incapacidad.* from incapacidad where nroinca='$nroinca'";
    $resultado=mysql_query($consulta)or die("Consulta incorrecta");
    $registros=mysql_num_rows($resultado);
    if($registros==0):
      ?>
      <script language="javascript">
         alert("El Documento no existe en la base de datos:")
         history.back()
       </script>
        <?
    else:
       while($filas=mysql_fetch_array($resultado)):
        ?>
            <center><h4>Datos a Modificar</h4></center>
         <form action="guardarnuevainca.php" method="post">
         <input type="hidden" name="codigo" value="<?echo $codigo;?>">
          <table border="0" align="center">
            <tr>
              <td colspan="2" ><br></td>
            </tr>
            <tr>
              <td><b>Nro_Incapacidad:</b></td>
                <td><input type="text" name="nroinca" value="<?echo $filas["nroinca"];?>" size="11"readonly></td>
             </tr>
                <tr>
                           <td><b>Fecha_Inicio:</b></td>
                           <td><input type="text" name="fechaini" value="<?echo $filas["fechaini"];?>"
                              size="10" maxlength="10"></td>
                         </tr>
                         <tr>
                           <td><b>Fecha_final:</b></td>
                           <td><input type="text" name="fechater" value="<?echo $filas["fechater"];?>"
                              size="10" maxlength="10"></td>
                         </tr>
                         <tr>
                           <td><b>Dias:</b></td>
                           <td><input type="text" name="dias" value="<?echo $filas["dias"];?>"
                              size="10" maxlength="3"></td>
                         </tr>
                        <tr>

               <td><b>Descripción:</b></td>
               <td><select name="tipo"class="cajas">
                 <?
                 $tuxe=$filas["tipoinca"];
                 $consulta_i="select * from tipoinca";
                 $resultado_i=mysql_query($consulta_i)or die("Consulta  incorrecta");
                 while($filas_i=mysql_fetch_array($resultado_i)):
                   if ($tuxe==$filas_i["codeps"]):
                 ?>
                 <option value="<?echo $filas_i["tipoinca"];?>" selected><?echo $filas_i["concepto"];?>
                 <?
                   else:
                   ?>
                     <option value="<?echo $filas_i["tipoinca"];?>"><?echo $filas_i["concepto"];?>
                   <?
                   endif;
                 endwhile;
                 ?> </selet></td>
              </tr>
              <tr>
               <td><b>Eps:</b></td>
               <td><select name="eps"class="cajas">
                 <?
                 $auxe=$filas["codeps"];
                 $consulta_d="select * from eps order by eps";
                 $resultado_d=mysql_query($consulta_d)or die("Consulta de departamento incorrecta");
                 while($filas_d=mysql_fetch_array($resultado_d)):
                   if ($auxe==$filas_d["codeps"]):
                 ?>
                 <option value="<?echo $filas_d["codeps"];?>" selected><?echo $filas_d["eps"];?>
                 <?
                   else:
                   ?>
                     <option value="<?echo $filas_d["codeps"];?>"><?echo $filas_d["eps"];?>
                   <?
                   endif;
                 endwhile;
                 ?> </selet></td>
                 </tr>
                 <tr>
               <td><b>Empleado:</b></td>
               <td><select name="empleado" class="cajas">
                 <?
                 $auxem=$filas["cedemple"];
                 $consulta_f="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado,sucursal,zona
                         where sucursal.codsucursal=zona.codsucursal and
                          zona.codzona=empleado.codzona and
                          sucursal.codsucursal='$codigo' order by empleado.nomemple,empleado.nomemple1,empleado.apemple";
                 $resultado_f=mysql_query($consulta_f)or die("Consulta de empleado incorrecta");
                 while($filas_f=mysql_fetch_array($resultado_f)):
                   if ($auxem==$filas_f["cedemple"]):
                 ?>
                 <option value="<?echo $filas_f["cedemple"];?>" selected><?echo $filas_f["nomemple"];?>&nbsp;<?echo $filas_f["nomemple1"];?>&nbsp;<?echo $filas_f["apemple"];?> &nbsp;<?echo $filas_f["apemple1"];?>
                 <?
                   else:
                   ?>
                     <option value="<?echo $filas_f["cedemple"];?>"><?echo $filas_f["nomemple"];?>&nbsp;<?echo $filas_f["nomemple1"];?>&nbsp;<?echo $filas_f["apemple"];?> &nbsp;<?echo $filas_f["apemple1"];?>
                   <?
                   endif;
                 endwhile;
                 ?> </select></td></tr>
                 <tr>
                       <td><b>Estado:</b></td>
                       <td><select name="estado" class="cajas">
                         <option vale="<? echo $filas ["estado"];?>"selected><? echo $filas["estado"];?>
                         <option value="por cobrar">POR COBRAR
                         <option value="cancelada">CANCELADA
                       </select></td>
                  </tr>
                         <tr>
                           <td><b>Fecha_Proceso:</b></td>
                           <td><input type="text" name="fechapro" value="<?echo $filas["fechapro"];?>"
                              size="10" maxlength="10"></td>
                         </tr>
                          <tr>
                           <td><b>Motivo:</b></td>
                           <td><textarea name="motivo" cols="60" rows="8" class="cajas"><?echo $filas["motivo"];?></textarea></td>
                         </tr>
                         <tr><td><br></td></tr>
                         <tr>
                           <td colspan="2">
                             <input type="submit" value="Guardar" class="boton">
                             <input type="reset" value="Limpiar" class="boton">
                           </td>
                          </tr>


         <?
             endwhile;
           endif;
         endif;
 ?>
 </table>
 
 </form>
</body>
</html>
