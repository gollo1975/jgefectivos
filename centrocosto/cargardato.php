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
        $conS="select salario.control,salario.insertar,salario.activo,salario.permanente,salario.agrupado from salario
           where salario.codsala=$datos ";
       $resuS=mysql_query($conS) or die ("Error al buscar codigos");
       $fila=mysql_fetch_array($resuS);
       $Control=$fila["control"];
       $Insertar=$fila["insertar"];
       $Activo=$fila["activo"];
       $Permanente=$fila["permanente"];
       $conP="select parametropension.estado,parametropension.codsala from parametropension
           where parametropension.codsala=$datos and
           parametropension.estado='ACTIVO' and
           parametropension.cedemple='$cedemple'";
       $resuP=mysql_query($conP) or die ("Error al buscar parametros");
       $regP=mysql_num_rows($resuP);
       if($regP==0):
             $consulta="select * from salario where codsala=$datos";
             $resultado=mysql_query($consulta) or die ("eliminacion incorrecta");
             $registros=mysql_affected_rows();
             if ($registros!=0):
                 ?>
                 <center><h4><u>Agregar Dato</u></h4></center>
                         <?
                        while ($filas=mysql_fetch_array($resultado)):
                          $CodSala=$filas["codsala"];
                          $Concepto=$filas["desala"];
                           $Prestacion=$filas["prestacion"];
                           $Ingreso=$filas["ingreso"];
                           $FormaPago=$filas["formapago"];
                           $TotalH=$filas["totalhoras"];
                           $PorS=$filas["porcentaje"];
						   $Agrupado= $filas["agrupado"];
                           if($Prestacion=='SI' and $Ingreso=='NO' and $FormaPago=='HORAS'):
                              if($Periodo=='MEDIO TIEMPO'):
                                 $PorH=$filas["porcentaje"];
                                 $Total=((($Salario/30/8)*$PorH/100)/2);
                              else:
                                  $PorH=$filas["porcentaje"];
                                  $Total=(($Salario/30/8)*$PorH/100);
                              endif;
                           endif;
                           if($Prestacion=='SI' and $Ingreso=='SI' and $FormaPago=='HORAS'):
                              if($Periodo=='MEDIO TIEMPO'):
                                 $PorH=$filas["porcentaje"];
                                 $Total=((($Salario/30/8)*$PorH/100)/2);
                              else:
                                  $PorH=$filas["porcentaje"];
                                  $Total=(($Salario/30/8)*$PorH/100);
                              endif;
                           endif;
                           if($FormaPago=='NINGUNA' and $TotalH=='ING'):
                              $Total=($Salario/30/8);
                           endif;
                           if($FormaPago=='HORAS' and $TotalH=='ING'):
                               $ConP="select parametroauxilio.* from parametroauxilio where estado='ACTIVO'";
			       $RegP=mysql_query($ConP)or die("Error al buscar empleado");
			       $filas=mysql_fetch_array($RegP);
	                       $Minimo=$filas["minimo"];
                               $TotalAux=round($Minimo*1.5);
                               if($Salario <= $TotalAux):
                                  $Total= (($Minimo/30)/8);
                                  $PorS=0;
                               else:
                                  $Total=(((($Salario/30)*$PorS)/100)/8);
                                  $PorS=$PorS;
                               endif;
                           endif;
                         ?>
                            <form action="guardardato.php" method="post">
                            <input type="hidden" name="codcentro" value="<? echo $codcentro;?>">
                            <input type="hidden" name="datos" value="<? echo $datos;?>">
                            <input type="hidden" name="cedemple" value="<? echo $cedemple;?>">
                              <table border="0" align="center">
                                 <tr><td><br></td></tr>
                             <tr>
                               <td><b>Cod_Sala:</b></td>
                               <td colspan=3><input type="text" value="<?echo $CodSala;?>"name="codsala" size="6" class="cajas" readonly></td>
                             </tr>
                             <tr>
                               <td><b>Concepto:</b></td>
                               <td colspan=3><input type="text" value="<?echo $Concepto;?>" name="descripcion" size="50" maxlength="50 " class="cajas" readonly></td>
                             </tr>
                             <tr>
                               <td><b>Vlr_Hora:</b></td>
                               <td colspan=3><input type="text" value="<?echo $Total;?>" name="vlrhora"size="11" maxlength="11" class="cajas"></td>
                             </tr>
                             <tr>
                               <td><b>Nro_Hora:</b></td>
                               <td colspan=3><input type="text" value="" name="nrorhora"size="11" maxlength="11" class="cajas"></td>
                             </tr>
                              <tr>
                               <td><b>Salario:</b></td>
                               <td colspan=3><input type="text" value=""name="salario" size="11" maxlength="11" class="cajas"></td>
                               </tr>
                               <tr>
                                <td><b>Variable:</b></td>
                                <td><select name="tipocon" class="cajas">
                                   <option value="VARIABLE">VARIABLE
                                   <option value="FIJO">FIJO
                                </select></td>
                             </tr>
                              <tr>
                               <td><b>Porcentaje:</b></td>
                               <td colspan=3><input type="text" value="<?echo $PorS;?>"name="porcentaje" size="11" maxlength="11" class="cajas"></td>
                             </tr>
                             <tr>
                               <td><b>Deducción:</b></td>
                               <td colspan=3><input type="text" value=""name="deduccion" size="11" maxlength="11" class="cajas"></td>
                             </tr>
                              <tr>
                                <td><b>Prestacion:</b></td>
                                <td><select name="prestacion" class="cajas">
                                  <option value="<?echo $Prestacion;?>" selected><?echo $Prestacion;?>
                                  <option value="NO">NO
                                  <option value="SI">SI
                                </select></td>
                             </tr>
                             <tr>
                                <td><b>Visible:</b></td>
                                <td><select name="control" class="cajas">
                                  <option value="<?echo $Control;?>" selected><?echo $Control;?>
                                  <option value="NO">NO
                                  <option value="SI">SI
                                </select></td>
                             </tr>
                              <tr>
                                <td><b>Insertar:</b></td>
                                <td><select name="insertar" class="cajas">
                                  <option value="<?echo $Insertar;?>" selected><?echo $Insertar;?>
                                  <option value="NO">NO
                                  <option value="SI">SI
                                </select></td>
                             </tr>
                              <tr>
                                <td><b>Activo:</b></td>
                                <td><select name="activo" class="cajas">
                                  <option value="<?echo $Activo;?>" selected><?echo $Activo;?>
                                  <option value="NO">NO
                                  <option value="SI">SI
                                </select></td>
                             </tr>
                               <tr>
                                <td><b>Perman.:</b></td>
                                <td><select name="permanente" class="cajas">
                                  <option value="<?echo $Permanente;?>" selected><?echo $Permanente;?>
                                  <option value="NO">NO
                                  <option value="SI">SI
                                </select></td>
                             </tr>
							 <tr>
                                <td><b>Agrupado:</b></td>
                                <td><select name="Agrupado" class="cajas" id="Agrupado">
                                  <option value="<?echo $Agrupado;?>" selected><?echo $Agrupado;?>
                                  <option value="NO">NO
                                  <option value="SI">SI
                                </select></td>
                             </tr>
                             <tr><td><br></td></tr>
                             <tr>
                                <td colspan="5"><input type="submit" value="Agregar Dato" class="boton"></td>
                             </tr>
                          </table>
                       </form>
                   <?
                           endwhile;
                endif;
       else:
            ?>
            <script language="javascript">
                alert("Este parametro no se le puede subir a este empleado, favor cambiar el estado de Pensión!")
                history.back()
            </script>
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
