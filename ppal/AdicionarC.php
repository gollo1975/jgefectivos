<?
 session_start();
?>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<script language="javascript">
     function sumarTotal()
        {
               var total = document.getElementById("vlrhora").value
               var total1 = document.getElementById("nrohora").value
               var subtotal = parseFloat (total) * parseFloat(total1);
               document.getElementById("salario").value =  parseFloat(subtotal);
         }
</script>
<?
 if(session_is_registered("xzona")):
   if(empty($datos)):
     ?>
      <script language="javascript">
        alert("Debe de Seleccionar un Item ?")
        history.back()
        </script>
     <?
   else:
        include("../conexion.php");
		$conC="select salario.ibcprestacional from salario
			where salario.codsala='$datos'";
		$resC=mysql_query($conC)or die ("Error de consulta la tabla salario");
		$fila=mysql_fetch_array($resC);
		$CodSala = $fila["ibcprestacional"];
		$consulta="select decentro.* from centro,decentro where
                centro.codcentro=decentro.codcentro and
                centro.cedemple='$cedula' and
                decentro.codsala=$datos";
        $resultado=mysql_query($consulta) or die ("eliminacion incorrecta");
        $registros=mysql_affected_rows();
         if ($registros!=0):
              ?>
              <center><h4><u>Modificar Datos</u></h4></center>
                         <?
                        while ($filas_s=mysql_fetch_array($resultado)):
                         ?>
                            <form action="GrabarAdicion.php" method="post" name="adicionar" id="adicionar">
                            <input type="hidden" name="cedula" value="<? echo $cedula;?>">
                            <input type="hidden" name="desde" value="<? echo $desde;?>">
                            <input type="hidden" name="hasta" value="<? echo $hasta;?>">
                            <input type="hidden" name="hasta" value="<? echo $hasta;?>">
			    <input type="hidden" name="CodSala" value="<? echo $CodSala;?>">
                             <input type="hidden" name="codzona" value="<? echo $codzona;?>">
                            <input type="hidden" name="CodNomina" value="<? echo $CodNomina;?>">
                              <table border="0" align="center">
                             <tr>
                               <td><b>Código:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["codsala"];?>" size="6"name="codsala" class="cajas" readonly></td>
                             </tr>
                             <tr>
                               <td><b>Descripción:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["descripcion"];?>"class="cajas" name="descripcion" size="50" maxlength="50 " class="cajas" readonly></td>
                             </tr>
                             <tr>
                               <td><b>Vlr_Hora:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["vlrhora"];?>" class="cajas"name="vlrhora"size="11" maxlength="11" id="vlrhora"></td>
                             </tr>
                              <tr>
                               <td><b>Nro_Hora:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["nrohora"];?>" class="cajas"name="nrohora"size="11" maxlength="11" id="nrohora"></td>
                             </tr>
                              <tr>
                               <td><b>Salario:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["salario"];?>" class="cajas" name="salario" size="11" maxlength="11" id="salario"  onfocus="sumarTotal()"></td>
                             </tr>
                             <tr>
                                <td><b>Prestacion:</b></td>
                                <td><select name="prestacion" class="cajas">
                                  <option value="<?echo $filas_s["prestacion"];?>" selected><?echo $filas_s["prestacion"];?>
                                  <option value="NO">NO
                                  <option value="SI">SI
                                </select></td>
                             </tr>
                             <tr>
                                <td><b>Tipo_Variable:</b></td>
                                <td><select name="tipocon" class="cajas">
                                  <option value="<?echo $filas_s["variacion"];?>" selected><?echo $filas_s["variacion"];?>
                                  <option value="FIJO">FIJO
                                  <option value="VARIABLE">VARIABLE
                                </select></td>
                             </tr>
                             <tr>
                               <td><b>Porcentaje:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["porcentaje"];?>"name="porcentaje" size="11" maxlength="11" class="cajas"></td>
                             </tr>
                             <tr>
                               <td><b>Deducción:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["deduccion"];?>"name="deduccion" size="11" maxlength="11" class="cajas"></td>
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
