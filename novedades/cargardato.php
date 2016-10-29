<?
 session_start();
?>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
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

                $consulta="select * from salario where codsala=$datos";
                $resultado=mysql_query($consulta) or die ("eliminacion incorrecta");
                $registros=mysql_affected_rows();
                if ($registros!=0):

?>
        <center><h4>Modificacion del Item</h4></center>
                         <?
                        while ($filas=mysql_fetch_array($resultado)):
                         ?>
                            <form action="guardardato.php" method="post">
                            <input type="hidden" name="codnovedad" value="<? echo $codnovedad;?>">
                            <input type="hidden" name="datos" value="<? echo $datos;?>">
                            <input type="hidden" name="cedula" value="<? echo $cedula;?>">
                            <input type="hidden" name="desde" value="<? echo $desde;?>">
                            <input type="hidden" name="hasta" value="<? echo $hasta;?>">
                              <table border="0" align="center">
                             <tr>
                               <td><b>Nro Cuenta:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas["codsala"];?>"name="codsala"  class="cajas" readonly></td>
                             </tr>
                             <tr>
                               <td><b>Descripción:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas["desala"];?>" name="descripcion" size="50" maxlength="50 " class="cajas" readonly></td>
                             </tr>
                             <tr>
                               <td><b>Vlr_Hora:</b></td>
                               <td colspan=3><input type="text" value="" name="vlrhora"size="11" maxlength="11" class="cajas"></td>
                             </tr>
                              <tr>
                               <td><b>Nro_Hora:</b></td>
                               <td colspan=3><input type="text" value="" name="nrohora"size="11" maxlength="11" class="cajas"></td>
                             </tr>
                              <tr>
                               <td><b>Salario:</b></td>
                               <td colspan=3><input type="text" value=""name="salario" size="11" maxlength="11" class="cajas"></td>
                             </tr>
                             <tr>
                                <td><b>Prestacion:</b></td>
                                <td><select name="prestacion" class="cajas">
                                  <option value="NO">NO
                                  <option value="SI">SI
                                </select></td>
                             </tr>
                              <tr>
                                <td><b>Tipo Variable:</b></td>
                                <td><select name="tipocon" class="cajas">
                                  <option value="FIJO">FIJO
                                  <option value="VARIABLE">VARIABLE
                                </select></td>
                             </tr>
                             <tr>
                               <td><b>Porcentaje:</b></td>
                               <td colspan=3><input type="text" value=""name="porcentaje" size="11" maxlength="11" class="cajas"></td>
                             </tr>
                             <tr>
                               <td><b>Deducción:</b></td>
                               <td colspan=3><input type="text" value=""name="deduccion" size="11" maxlength="11" class="cajas"></td>
                             </tr>
                             <tr>
                               <td colspan=3><input type="hidden" value="<?echo $filas["control"];?>" name="control" size="3" readonly class="cajas"></td>
                               <td colspan=3><input type="hidden" value="<?echo $filas["insertar"];?>" name="insertar" size="3" readonly class="cajas"></td>
                             </tr>
                             <tr><td><br></td></tr>
                             <tr>
                                <td colspan="5"><input type="submit" value="Agregar Dato" class="boton"></td>
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
