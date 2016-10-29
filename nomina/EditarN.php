<?
 session_start();
?>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<script type="text/javascript">
     function Totalizar()
         {
          var total = document.getElementById("vlrhora").value
          var total1 = document.getElementById("nrohora").value
          var subtotal = parseFloat (total) * parseFloat(total1);
          document.getElementById("salario").value =  parseFloat(subtotal);
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
		/*codigo que busca el campo ibcprestacional*/
		$conC="select salario.ibcprestacional from salario
			where salario.codsala='$datos'";
		$resC=mysql_query($conC)or die ("Error de consulta la tabla salario");
		$fila=mysql_fetch_array($resC);
		$CodSala = $fila["ibcprestacional"];
		/*fin codigo*/
        $consulta="select denovedanomina.* from denovedanomina where
                 denovedanomina.codsala='$datos' and
                  denovedanomina.radicado='$conse'";
        $resultado=mysql_query($consulta) or die ("Error la buscar registro $consulta");
        $registros=mysql_affected_rows();
         if ($registros!=0):

?>
        <center><h4><u>Detalle del Registro</u></h4></center>
                         <?
                        while ($filas_s=mysql_fetch_array($resultado)):
                         ?>
                            <form action="GrabarEditadoN.php" method="post" name="f1" id="f1">
                            <input type="hidden" name="datos" value="<? echo $datos;?>">
                            <input type="hidden" name="cedula" value="<? echo $cedemple;?>">
                            <input type="hidden" name="desde" value="<? echo $desde;?>">
                            <input type="hidden" name="hasta" value="<? echo $hasta;?>">
							 <input type="hidden" name="CodSala" value="<? echo $CodSala;?>">
                            <input type="hidden" name="codzona" value="<? echo $codzona;?>">
                              <table border="0" align="center">
                              <tr><td><br></td></tr>
                              <tr>
                               <td><b>Radicado:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["radicado"];?>"name="radicado" class="cajas" size="11" readonly></td>
                             </tr>
                             <tr>
                               <td><b>Nro Cuenta:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["codsala"];?>"name="codsala"  size="11"class="cajas" readonly></td>
                             </tr>
                             <tr>
                               <td><b>Descripción:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["concepto"];?>"class="cajas" name="descripcion" size="40" class="cajas" readonly></td>
                             </tr>
                             <tr>
                               <td><b>Vlr_Hora:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["vlrhora"];?>" class="cajas"name="vlrhora" size="11" id="vlrhora" ></td>
                             </tr>
                             <tr>
                               <td><b>Nro_Hora:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["nrohora"];?>" class="cajas"name="nrohora"size="11" id="nrohora" onFocus= "Totalizar()"></td>
                             </tr>
                              <tr>
                               <td><b>Salario:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["salario"];?>" class="cajas" name="salario" id="salario" size="11" maxlength="11"  onFocus= "Totalizar()" onClick = "Totalizar()" ></td>
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
                               <td colspan=3><input type="text" value="<?echo $filas_s["porcentaje"];?>"name="porcentaje"  class="cajas"size="11" maxlength="11" class="cajas"></td>
                             </tr>
                             <tr>
                               <td><b>Deducción:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["deduccion"];?>"name="deduccion"  class="cajas"size="11" maxlength="11" class="cajas"></td>
                             </tr>
                             <tr><td><br></td></tr>
                             <tr>
                                <td colspan="5"><input type="submit" value="Guardar" class="boton" id="grabar" name="grabar"></td>
                             </tr>

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
