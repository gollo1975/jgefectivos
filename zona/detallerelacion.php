<?
 session_start();
?>
<html>
        <head>
                <title>Crear Relaci�n</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
<?  if(session_is_registered("xsession")):
    include("../conexion.php");
    $consulta="select zona.codzona,zona.zona,zona.telzona from zona where codzona='$cod'";
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
     ?><center><h4><u>Crear Relaci�n</u></h4></center><?
     while($filas=mysql_fetch_array($resultado)):
       ?>

         <form action="grabarelacion.php" method="post" >
           <table border="0" align="center"width="310">
           <tr><td><br></td></tr>
             <tr>
               <td><b>Cod_Zona:</b></td>
               <td ><input type="text" value="<?echo $filas["codzona"];?>" name="codzona" size="3" readonly class="cajas"></td>
             </tr>
             <tr>
               <td><b>Zona:</b></td>
               <td ><input type="text" value="<?echo $filas["zona"];?>"name="zona" size="60" maxlength="60" class="cajas"></td>
             </tr>
             <tr>
               <td><b>Tel�fono:</b></td>
               <td ><input type="text" value="<?echo $filas["telzona"];?>" name="telzona"size="10" maxlength="7" class="cajas"></td>
             </tr>
              <tr>
                <td><b>Vendedor</b></td>
                           <td><select name="vendedor" class="cajas">
                           <option value="0">Seleccione el vendedor
                            <?
                             $consulta_z="select cedulaven,nombreven from vendedor where estado='ACTIVO' order by nombreven";
                             $resultado_z=mysql_query($consulta_z) or die("Error en la busqueda de vendedores");
                             while ($filas_z=mysql_fetch_array($resultado_z))
                            {
                                 ?>
                                  <option value="<?echo $filas_z["cedulaven"];?>"><?echo $filas_z["nombreven"];?>
                                <?
                            }
                                ?>
                           </select></td>
               </tr>
                <tr><td><br></td></tr>
       <tr>
         <td colspan="5"><div align="center">---------------------------------<b>Datos de la Comisi�n</b>-------------------------------------</div></td>
       </tr>
       <tr><td><br></td></tr>
        <tr>
        <td><b>Valor %:</b></td>
        <td><input type="text" name="comision"  value="" size="11" maxlength="11" class="cajas" ></td>
       </tr>
       <tr>
              <td> <b>Compartida:</b></td>
               <td ><select name="compartida" class="cajasletra">
                  <option value="NO">NO
                  <option value="SI">SI
                  </select>
                </td>
        </tr>

         <tr><td><br></td></tr>
            <td colspan="2"><input type="submit" value="Guardar" class="boton">&nbsp;<input type="reset" value="Limpiar" class="boton"></td> 
        </tr>
<tr><td><br></td></tr>
</table>

  </form>

        <?
                   endwhile;
                 endif;
else:
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Secci�n")
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
