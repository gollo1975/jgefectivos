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
                $consulta="select detallehijo.* from detallehijo where
                detallehijo.codigo=$datos";
                $resultado=mysql_query($consulta) or die ("Datos errados en la busqueda de informacion");
                $registros=mysql_affected_rows();
              $filas_s=mysql_fetch_array($resultado);
            if ($registros!=0):
                 ?>
                <center><h4><u><u>Modificar Datos</u></u></h4></center>

                            <form action="GrabarEditar.php" method="post">
                            <input type="hidden" name="datos" value="<? echo $datos;?>">
                            <input type="hidden" name="cedemple" value="<? echo $cedemple;?>">
                            <input type="hidden" name="estado" value="<? echo $estado;?>"> 
                              <table border="0" align="center">
                              <tr><td><br></td></tr>
                             <tr>
                               <td><b>Código:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["codigo"];?>" size="10"name="codigo" class="cajas" readonly></td>
                             </tr>
                             <tr>
                              <td><b>Tipo_Id.:</b></td>
			                <td><select name="tipo" class="cajasletra">
                                        <option value="<?echo $filas_s["tipo"];?>" selected readonly><?echo $filas_s["tipo"];?>
			                    <option value="RC">R. CIVIL
			                    <option value="NUIT">N. UNICO DE ID.
			                    <option value="TI">T.IDENTIDAD
			                    <option value="CC">C.CIUDADANIA
			                    <option value="CE">C.EXTRANJERIA
			                    <option value="PA">PASAPORTE
			                    </select></td>
                            </tr>
                             <tr>
                               <td><b>Documento:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["documento"];?>" class="cajas"name="documento"size="15"readonly></td>
                             </tr>
                              <tr>
                               <td><b>Nombres:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["nombre"];?>" class="cajas" name="nombres" size="45" maxlength="45"></td>
                             </tr>
                             <tr>
                               <td><b>F_Nac.:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["fechanac"];?>"name="fechanac" size="15" maxlength="10" class="cajas"></td>
                             </tr>
                               <tr>
                              <td><b>Parent.:</b></td>
			                <td><select name="parentezco" class="cajasletra">
                                        <option value="<?echo $filas_s["parentezco"];?>" selected readonly><?echo $filas_s["parentezco"];?>
                                            <option value="HIJO(A)">HIJO(A)
			                    <option value="ESPOSA">ESPOSA
			                    <option value="MADRE">MADRE
			                    <option value="PADRE">PADRE
			                    <option value="HIJASTRO">HIJASTRO
			                    <option value="OTRO">OTRO
			                    </select></td>
                            </tr>
                             <tr><td><br></td></tr>
                             <tr>
                                <td colspan="5"><input type="submit" value="Guardar" class="boton"></td>
                             </tr>
                         </table>
                       </form>

        <?
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
