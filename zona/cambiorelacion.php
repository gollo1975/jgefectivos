<?
 session_start();
?>
<html>
        <head>
                <title>Crear Relación</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
<?  if(session_is_registered("xsession")):
    include("../conexion.php");
    $consulta="select relacioncomision.* from relacioncomision where nro='$nro'";
    $resultado=mysql_query($consulta)or die("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
    if ($registro==0):
     ?>
     <script language="javascript">
       alert("No existe el registro en la bd ?")
       history.back()
     </script>
    <?
     else:
     ?><center><h4><u>Editar Relación</u></h4></center><?
     while($filas=mysql_fetch_array($resultado)):
       ?>

         <form action="grabareditado.php" method="post" >
         <input type="hidden" value="<?echo $nro;?>" name="nro">
          <input type="hidden" value="<?echo $cedula;?>" name="cedula">
           <table border="0" align="center"width="310">
           <tr><td><br></td></tr>
             </tr>
              <td><b>Zona:</b></td>
               <td colspan="1"><select name="codzona" class="cajasletra">
                 <?
                 $aux=$filas["codzona"];
                 $consulta_z="select codzona,zona from zona order by zona";
                 $resultado_z=mysql_query($consulta_z)or die("Error al buscar la zona");
                 while($filas_z=mysql_fetch_array($resultado_z)):
                   if ($aux==$filas_z["codzona"]):
                 ?>
                 <option value="<?echo $filas_z["codzona"];?>" selected><?echo $filas_z["zona"];?>
                 <?
                   else:
                   ?>
                     <option value="<?echo $filas_z["codzona"];?>"><?echo $filas_z["zona"];?>
                   <?
                   endif;
                 endwhile;
                 ?> </selet></td>
             </tr>
              <td><b>Vendedor:</b></td>
               <td colspan="1"><select name="vendedor" class="cajasletra">
                 <?
                 $sucaux=$filas["cedulaven"];
                 $consulta_s="select cedulaven,nombreven from vendedor where estado='ACTIVO' order by nombreven";
                 $resultado_s=mysql_query($consulta_s)or die("Error al buscar eñ vendedor");
                 while($filas_s=mysql_fetch_array($resultado_s)):
                   if ($sucaux==$filas_s["cedulaven"]):
                 ?>
                 <option value="<?echo $filas_s["cedulaven"];?>" selected><?echo $filas_s["nombreven"];?>
                 <?
                   else:
                   ?>
                     <option value="<?echo $filas_s["cedulaven"];?>"><?echo $filas_s["nombreven"];?>
                   <?
                   endif;
                 endwhile;
                 ?> </selet></td>
             </tr>
                <tr><td><br></td></tr>
       <tr>
         <td colspan="5"><div align="center">---------------------------------<b>Datos de la Comisión</b>-------------------------------------</div></td>
       </tr>
       <tr><td><br></td></tr>
        <tr>
        <td><b>Valor %:</b></td>
        <td><input type="text" name="comision"  value="<?echo $filas["comision"];?>" size="11" maxlength="11" class="cajas" ></td>
       </tr>
       <tr>
              <td> <b>Compartida:</b></td>
               <td ><select name="compartida" class="cajasletra">
                <option value="<?echo $filas["compartida"];?>"selected><?echo $filas["compartida"];?>
                  <option value="NO">NO
                  <option value="SI">SI
                  </select>
                </td>
        </tr>
        <tr>
              <td> <b>Estado:</b></td>
               <td ><select name="Estado" class="cajasletra">
                <option value="<?echo $filas["estado"];?>"selected><?echo $filas["estado"];?>
                  <option value="ACTIVA">ACTIVA
                  <option value="INACTIVA">INACTIVA
                  </select>
                </td>
        </tr>
         <tr><td><br></td></tr>
            <td colspan="2"><input type="submit" value="Guardar" class="boton">&nbsp;<input type="reset" value="Limpiar" class="boton"></td>
        </tr>
</table>

  </form>

        <?
                   endwhile;
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
 </body>
</html>
