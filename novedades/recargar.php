<?
 session_start();
?>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<script language="javascript">
     function sumarTotal()
        {
               total = document.getElementById("vlrhora").value
               total1 = document.getElementById("nrohora").value
               subtotal = parseFloat (total) * parseFloat(total1);
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
                $consulta="select denovedanomina.* from denovedanomina where
                 denovedanomina.codsala='$datos' and
                  denovedanomina.radicado='$conse'";
                $resultado=mysql_query($consulta) or die ("Error la buscar registro $consulta");
                $registros=mysql_affected_rows();
         if ($registros!=0):

?>
        <center><h4>Detalle del Registro</h4></center>
                         <?
                        while ($filas_s=mysql_fetch_array($resultado)):
                         ?>
                            <form action="grabardetallenovedad.php" method="post">
                            <input type="hidden" name="conse" value="<? echo $conse;?>">
                            <input type="hidden" name="datos" value="<? echo $datos;?>">
                            <input type="hidden" name="cedula" value="<? echo $cedula;?>">
                            <input type="hidden" name="desde" value="<? echo $desde;?>">
                            <input type="hidden" name="hasta" value="<? echo $hasta;?>">
                            <input type="hidden" name="codigo" value="<? echo $codigo;?>">
                              <table border="0" align="center">
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
                               <td colspan=3><input type="text" value="<?echo $filas_s["vlrhora"];?>" class="cajas"name="vlrhora"size="11" readonly></td>
                             </tr>
                             <tr>
                               <td><b>Nro_Hora:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["nrohora"];?>" class="cajas"name="nrohora"size="11" onfocus="sumarTotal()" ></td>
                             </tr>
                              <tr>
                               <td><b>Salario:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["salario"];?>" class="cajas" name="salario" size="11" maxlength="11" onfocus="sumarTotal()"></td>
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
