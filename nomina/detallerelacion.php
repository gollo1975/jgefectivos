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
     ?><center><h4><u>Crear Relación</u></h4></center><?
     while($filas=mysql_fetch_array($resultado)):
       ?>

         <form action="GrabaRelacionZona.php" method="post">
            <input type="hidden" value="<?echo $CodSucursal;?>" name="CodSucursal">
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
               <td><b>Teléfono:</b></td>
               <td ><input type="text" value="<?echo $filas["telzona"];?>" name="telzona"size="10" maxlength="7" class="cajas"></td>
             </tr>
              <tr>
                <td><b>Trabajador</b></td>
                           <td><select name="trabajador" class="cajas">
                           <option value="0">Seleccione funcionario
                            <?
                             $consulta_z="select empleado.cedemple,concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' ,apemple) as empleado from empleado,zona,contrato
                                     where  empleado.codzona=zona.codzona and
                                           empleado.codemple=contrato.codemple and
                                           contrato.fechater='0000-00-00' and
                                      zona.tipoempresa='SI'  order by empleado.cedemple";
                             $resultado_z=mysql_query($consulta_z) or die("Error en la busqueda de vendedores");
                             while ($filas_z=mysql_fetch_array($resultado_z))
                            {
                                 ?>
                                  <option value="<?echo $filas_z["cedemple"];?>"><?echo $filas_z["empleado"];?>
                                <?
                            }
                                ?>
                           </select></td>
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
