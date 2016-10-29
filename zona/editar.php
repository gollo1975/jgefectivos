<?
 session_start();
?>
<html>
        <head>
                <title>Modificacion de Zona</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
        <?
  if(session_is_registered("xsession")):
               if (!isset($codigo)):
                        include("../conexion.php");
                       
    $consulta="select * from detalladozona where codigo='$Nro'";
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
     ?><center><h4><u>Datos a Modificar</u></h4></center><?
     while($filas=mysql_fetch_array($resultado)):
       ?>

         <form action="guardareditar.php" method="post" width="300">
          <input type="hidden" value="<?echo $Nro;?>" name="nro">
           <table border="0" align="center">
           <tr><td><br></td></tr>
             <tr>
               <td><b>Cod_Zona:</b></td>
               <td colspan=3><input type="text" value="<?echo $filas["codzona"];?>" name="codzona" size="3" readonly></td>
             </tr>
             <tr>
               <td><b>Zona:</b></td>
               <td colspan=3><input type="text" value="<?echo $filas["zona"];?>"name="zona" size="60" class="cajas" readonly></td>
             </tr>
             <tr>
               <td><b>R_Legal:</b></td>
               <td colspan=3><input type="text" value="<?echo $filas["rl"];?>" name="rl"size="60" maxlength="60" class="cajas"></td>
             </tr>
              <tr>
               <td><b>Celular:</b></td>
               <td colspan=3><input type="text" value="<?echo $filas["celular"];?>" name="celular" size="15" maxlength="15" class="cajas"></td>
             </tr>
            <tr>
               <td><b>Contacto_Nom.:</b></td>
               <td colspan=3><input type="text" value="<?echo $filas["contacto"];?>"name="contacto" size="60" maxlength="60" class="cajas"></td>
             </tr>
              <tr>
               <td><b>Cargo:</b></td>
               <td colspan=3><input type="text" value="<?echo $filas["cargo"];?>" name="cargo" size="35" maxlength="35" class="cajas"></td>
             </tr>
              <tr>
               <td><b>Teléfono:</b></td>
               <td colspan=0><input type="text" value="<?echo $filas["telefono"];?>" name="telefonoN" size="8" maxlength="7" class="cajas"></td>
               <td><b>Ext:</b></td>
               <td colspan=0><input type="text" value="<?echo $filas["ext"];?>" name="ext" size="8" maxlength="7" class="cajas"></td>
             </tr>
             <tr>
               <td><b>P_Pagos:</b></td>
               <td colspan=3><input type="text" value="<?echo $filas["pagos"];?>" name="pagos" size="60" maxlength="60" class="cajas"></td>
             </tr>
               <tr>
               <td><b>Teléfono:</b></td>
               <td colspan=0><input type="text" value="<?echo $filas["telefono1"];?>" name="telefono" size="8" maxlength="7" class="cajas"></td>
               <td><b>Ext:</b></td>
               <td colspan=0><input type="text" value="<?echo $filas["ext1"];?>" name="extension" size="8" maxlength="7" class="cajas"></td>
             </tr>
             <tr>
              <td><b>Pago_Nomina:</b></td>
               <td colspan="3"><select name="pagonomina" class="cajas">
               <option value="<?echo $filas["pnomina"];?>"selected><?echo $filas["pnomina"];?>
                  <option value="SEMANAL">SEMANAL
                  <option value="DECADAL">DECADAL
                   <option value="CATORCENAL">CATORCENAL
                  <option value="QUINCENAL">QUINCENAL
                  <option value="MENSUAL">MENSUAL
                  </select>
                </td>
               </tr>
             <tr>
              <td><b>Cartera:</b></td>
               <td colspan="3"><select name="pago" class="cajas">
               <option value="<?echo $filas["periocidad"];?>"selected><?echo $filas["periocidad"];?>
                  <option value="7">7-DIAS	
                  <option value="10">10-DIAS
                  <option value="14">14-DIAS
                  <option value="15">15-DIAS
				  <option value="20">20-DIAS
                  <option value="30">30-DIAS
				  <option value="45">45-DIAS
				  <option value="60">60-DIAS
				  <option value="1">1-DIAS
                  </select>
                </td>
               </tr>
              <tr>
               <td><b>Observación:</b></td>
               <td colspan="3"><textarea name="nota" cols="60" rows="6" class="cajas"><?echo $filas["nota"];?></textarea></td>
             </tr>
             <tr><td><br></td></tr>
             <tr>
               <td colspan="2"><input type="submit" value="Guardar" class="boton"></th>
             </tr>
             <tr><td><br></td></tr>

        <?
                   endwhile;
                 endif;
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
</table>
                </form>


        </body>
</html>
