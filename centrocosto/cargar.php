<?
 session_start();
?>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
     <script language="javascript">
 function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }

</script>
<?
 if(session_is_registered("xsession")):
   if(empty($datos)):
     ?>
      <script language="javascript">
        alert("Debe de Seleccionar un Item ?")
        history.back()
        </script>
     <?
   else:
        include("../conexion.php");
        $con="select centro.codcentro from centro
         where centro.cedemple='$cedemple'";
        $res=mysql_query($con) or die ("Error al buscar datos en el centro de costo.");
        $reg=mysql_num_rows($res);
        $filas=mysql_fetch_array($res);
        $Xdatos=$filas["codcentro"];
        if($reg==0):
                $consulta="select * from salario where codsala=$datos";
                $resultado=mysql_query($consulta) or die ("eliminacion incorrecta");
                $registros=mysql_affected_rows();
	        if ($registros!=0):
                        while ($filas=mysql_fetch_array($resultado)):
                         ?>
	                <center><h4><u>Crear Item</u></h4></center>
                            <form action="guardar.php" method="post">
                            <input type="hidden" name="cedemple" value="<? echo $cedemple;?>">
                            <input type="hidden" name="datos" value="<? echo $datos;?>">
                              <table border="0" align="center">
                              <tr><td><br></td></tr>
                             <tr>
                               <td><b>Nro Cuenta:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas["codsala"];?>" size="6"name="codsala" readonly class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codsala"></td>
                             </tr>
                             <tr>
                               <td><b>Descripción:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas["desala"];?>" name="descripcion" size="50" maxlength="50 " class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="descripcion"></td>
                             </tr>
                             <tr>
                               <td><b>Vlr_Hora:</b></td>
                               <td colspan=3><input type="text" value="" name="vlrhora"size="11" maxlength="11" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="vlrhora"></td>
                             </tr>
                              <tr>
                               <td><b>Salario:</b></td>
                               <td colspan=3><input type="text" value=""name="salario" size="11" maxlength="11" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="salario"></td>
                             </tr>

                            <tr>
                                <td><b>Pago_Pensión:</b></td>
                                <td><select name="tipocon" class="cajas">
                                  <option value="FIJO">FIJO
                                  <option value="VARIABLE">VARIABLE
                                </select></td>
                             </tr>
                             <tr>
                               <td><b>Porcentaje:</b></td>
                               <td colspan=3><input type="text" value=""name="porcentaje" size="11" maxlength="11" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="porcentaje"></td>
                             </tr>
                             <tr>
                               <td><b>Deducción:</b></td>
                               <td colspan=3><input type="text" value=""name="deduccion" size="11" maxlength="11" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="deduccion"> </td>
                             </tr>
                             <tr>
                                <td><b>Activo:</b></td>
                                <td><select name="activo" class="cajas">
                                  <option value="SI">SI
                                  <option value="NO">NO
                                </select></td>
                             </tr>
                             <tr>
                             <td> <input type="hidden" value="<?echo $filas["prestacion"];?>"name="prestacion" size="11" maxlength="11" class="cajas"></td>
                            </tr>
                            <tr>
                             <td colspan=3><input type="hidden" value="<?echo $filas["control"];?>" name="control" size="3" readonly class="cajas"></td>
                            </tr>
                            <tr>
                             <td colspan=3><input type="hidden" value="<?echo $filas["insertar"];?>" name="insertar" size="3" readonly class="cajas" ></td>
                             </tr>
                             <tr><td><br></td></tr>
                             <tr>
                                <td colspan="5"><input type="submit" value="Guardar" class="boton"></td>
                             </tr>
                             <tr><td><br></td></tr>
                         </table>
                         </form>
                          <?
                       endwhile;
              endif;
     else:
        $conR="select decentro.codsala from centro,decentro
         where centro.codcentro=decentro.codcentro and
         decentro.codcentro='$Xdatos' and
         centro.cedemple='$cedemple' and
         decentro.codsala='$datos'";
        $resR=mysql_query($conR) or die ("Error al buscar datos en el centro de costo dos");
        $regR=mysql_num_rows($resR);
        if($regR==0):
            $consulta="select * from salario where codsala=$datos";
                $resultado=mysql_query($consulta) or die ("eliminacion incorrecta");
                $registros=mysql_affected_rows();
	        if ($registros!=0):
                        while ($filas=mysql_fetch_array($resultado)):
                         ?>
	                <center><h4><u>Crear Item</u></h4></center>
                            <form action="guardar.php" method="post">
                            <input type="hidden" name="cedemple" value="<? echo $cedemple;?>">
                            <input type="hidden" name="datos" value="<? echo $datos;?>">
                              <table border="0" align="center">
                              <tr><td><br></td></tr>
                             <tr>
                               <td><b>Nro Cuenta:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas["codsala"];?>"name="codsala" size="6" readonly class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codsala"></td>
                             </tr>
                             <tr>
                               <td><b>Descripción:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas["desala"];?>" name="descripcion" size="50" maxlength="50 " class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="descripcion"></td>
                             </tr>
                             <tr>
                               <td><b>Vlr_Hora:</b></td>
                               <td colspan=3><input type="text" value="" name="vlrhora"size="11" maxlength="11" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="vlrhora"></td>
                             </tr>
                              <tr>
                               <td><b>Salario:</b></td>
                               <td colspan=3><input type="text" value=""name="salario" size="11" maxlength="11" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="salario"></td>
                             </tr>
                             <tr>
                                <td><b>Pago_Pensión:</b></td>
                                <td><select name="tipocon" class="cajas">
                                  <option value="FIJO">FIJO
                                  <option value="VARIABLE">VARIABLE
                                </select></td>
                             </tr>
                             <tr>
                               <td><b>Porcentaje:</b></td>
                               <td colspan=3><input type="text" value=""name="porcentaje" size="11" maxlength="11" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="porcentaje"></td>
                             </tr>
                             <tr>
                               <td><b>Deducción:</b></td>
                               <td colspan=3><input type="text" value=""name="deduccion" size="11" maxlength="11" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="deduccion"> </td>
                             </tr>
                             <tr>
                                <td><b>Activo:</b></td>
                                <td><select name="activo" class="cajas">
                                  <option value="SI">SI
                                  <option value="NO">NO
                                </select></td>
                             </tr>
                              <tr>
                               <td colspan=3><input type="hidden" value="<?echo $filas["prestacion"];?>"name="prestacion" size="11" maxlength="11" class="cajas" ></td>
                             </tr>
                             <tr>
                               <td colspan=3><input type="hidden" value="<?echo $filas["control"];?>" name="control" size="3" readonly class="cajas"></td>
                            <tr>
                               <td colspan=3><input type="hidden" value="<?echo $filas["insertar"];?>" name="insertar" size="3" readonly class="cajas" ></td>
                             </tr>
                             <tr><td><br></td></tr>
                             <tr>
                                <td colspan="5"><input type="submit" value="Guardar" class="boton"></td>
                             </tr>
                         </table>
                         </form>
                          <?
                       endwhile;
              endif;
        else:
          ?>
          <script language="javascript">
            alert("Este Item ya se le agrego a este empleado.. ?")
            history.go(-1)
          </script>
          <?
        endif;
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
