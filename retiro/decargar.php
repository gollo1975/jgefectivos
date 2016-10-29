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
                $consulta="select retiroprovision.* from retiroprovision where
                     retiroprovision.codretiro='$datos'" ;
                $resultado=mysql_query($consulta) or die ("eliminacion incorrecta");
                $registros=mysql_affected_rows();
         if ($registros!=0):

?>
        <center><h4><u>Modificar datos</u></h4></center>
                         <?
                        while ($filas_s=mysql_fetch_array($resultado)):
                         ?>
                            <form action="guardarmodificado.php" method="post">
                            <input type="hidden" name="datos" value="<? echo $datos;?>">
                            <input type="hidden" name="desde" value="<? echo $desde;?>">
                            <input type="hidden" name="hasta" value="<? echo $hasta;?>">
                            <input type="hidden" name="auxcodigo" value="<? echo $nit;?>">

                              <table border="0" align="center">
                              <tr><td><br></td></tr>
                             <tr>
                               <td><b>Cod_Retiro:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["codretiro"];?>"name="codigo" class="cajas" size="12" readonly></td>
                             </tr>
                             <tr>
                               <td><b>Documento:</b></td>
                               <td colspan=3><input type="text" name="cedula" value="<?echo $filas_s["cedemple"];?>"class="cajas" size="12" class="cajas" readonly></td>
                             </tr>
                             <tr>
                               <td><b>Asociado:</b></td>
                               <td colspan=3><input type="text" name="nombre" value="<?echo $filas_s["nombres"];?>" class="cajas" size="50" readonly></td>
                             </tr>
                              <tr>
                               <td><b>Zona:</b></td>
                               <td colspan=3><input type="text" name="zona" value="<?echo $filas_s["zona"];?>" class="cajas" size="50" readonly></td>
                             </tr>
                              <tr>
                               <td><b>F_Retiro:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["fechare"];?>" class="cajas" name="fecha" size="12" maxlength="11"></td>
                             </tr>
                             <tr>
                               <td><b>Dias_Segu.:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["dias"];?>"name="dia" size="4" maxlength="4" class="cajas"></td>
                             </tr>
                               <tr>
                               <td><b>Dias_Pago:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas_s["diasperiodo"];?>"name="diaPago" size="4" maxlength="4" class="cajas"></td>
                             </tr>
                             <tr>
                             <td><b>Estado:</b></td>
                             <td><select name="Estado" class="cajas">
                                         <option value="<?echo $filas_s["estado"];?>" selected><?echo $filas_s["estado"];?>
                                         <option value="ACTIVO">ACTIVO
                                         <option value="INACTIVO">INACTIVO
                                         </select></td>
                             </tr>
                              <td><b>Tipo_Proceso:</b></td>
                                 </td><td><input type="radio" value="CerrarP"  name="TipoProceso">Cerrar Contrato</td><td><input type="radio" value="Actualizar" name="TipoProceso">Actualizar</td>
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
