<html>
<head>
  <title></title>
</head>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<body>
<div align="center"><h4><u>Editar Registro</u></h4></div>
<form action="GrabarEditadoRequisito.php" method="post" id="f1" name="f1">
    <input type="hidden" name="NroId" value="<?echo $NroId;?>">
    <input type="hidden" name="UsuarioPreparador" value="<?echo $UsuarioPreparador;?>">
    <table border="0" align="center">
         <tr>
              <td><b>Documento:</b></td>
              <td><input type="text" name="Cedula" value="<?echo $Documento;?>"size="15" class="cajas" readonly onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Cedula" readonly></td>
	 </tr>
	 <tr>
	       <td><b>Empleado:</b></td>
	       <td><input type="text" name="Nombre" value="<?echo $Nombre;?>" size="55"  class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Nombre" readonly></td>
	  </tr>
           <tr>
	       <td><b>Tipo_Ingreso:</b></td>
	       <td><input type="text" name="Tipo" value="<?echo $Tipo;?>" size="15" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Nombre" readonly></td>
	  </tr>
	    <tr>
                   <td><b>Observación:</b></td>
                   <td colspan="9"><textarea name="Nota" cols="56" rows="4" class="cajas" id="Nota"><?echo $Nota;?></textarea></td>
               </tr>
         </table>
         <?
         include("../conexion.php");
        $Sql="select detalladomaestrorequisito.*,listadodocumentoempleado.sugerido  from detalladomaestrorequisito, maestrorequisito,listadodocumentoempleado
                where detalladomaestrorequisito.idRequisito = maestrorequisito.idRequisito  and
				listadodocumentoempleado.iddocumento= detalladomaestrorequisito.iddocumento and     
                maestrorequisito.idRequisito='$NroId' and
                maestrorequisito.cerrado='NO'";
         $Rt=mysql_query($Sql)or die ("Error al buscar requisitos");
         $Cont=mysql_num_rows($Rt);
         if($Cont != 0 ):
               ?>
               <table border="0" align="center" >
                     <tr class="cajas">
                        <th><b>&nbsp;</b></th><th><b><u>Descripcion</u></b></th><th><b><u>C_Real</u></b></th><th><b><u>Validar</u></b></th><th><b><u>C_Ent.</u></b></th><th><b><u>C_Pend.</u></b></th>
                     </tr>
                     <tr>
                          <td><br></td>
                     </tr>
	  	      <input type="hidden" id="TotalVector" name="TotalVector" value="<?php echo mysql_num_rows($Rt);?>">
                      <?
                      $i=0;
                      while ($filas_s = mysql_fetch_array($Rt)):
                           $i++;
                           ?>
                           <tr class="cajas">
                              <? echo "<td><input type=\"checkbox\" id=\"DatoN[" . $i . "]\" name=\"DatoN[" . $i . "]\" value=\"" . $filas_s['idcodigo'] ."\"></td>";?>
                              <td><input type="text" value="<?echo $filas_s["concepto"];?>" name="Concepto[<? echo $i;?>]"id="Concepto[<? echo $i;?>]" size="90"  readonly class="cajas"> </td>
							  <td><input type="text" value="<?echo $filas_s["sugerido"]; ?>" name="CantidadActual[<?php echo $i;?>]" id="CantidadActual[<?php echo $i;?>]" size="4" class="cajas" readonly> </td>
	                       <td><select size="1" name="ValidarDocumento[<?php echo $i;?>]" id="ValidarDocumento[<?php echo $i;?>]" class="cajas">
                               <option value="<?echo $filas_s["validacion"];?>" selected><?echo $filas_s["validacion"];?>
                               <option value="NO APLICA">NO APLICA</option>
                               <option value="OK">OK</option>
	                       <option value="PENDIENTE">PENDIENTE</option>
	                       </select></td>
                               <td><input type="text" value="<?echo $filas_s["cantidad"]; ?>" name="Cantidad[<?php echo $i;?>]" id="Cantidad[<?php echo $i;?>]" size="4" class="cajas"> </td>
                               <td><input type="text"  value="<?echo $filas_s["pendiente"]; ?>"name="ValidarPendiente[<?php echo $i;?>]" id="ValidarPendiente[<?php echo $i;?>]" class="cajas" size="4"></td>
                           </tr>
                           <?
                      endwhile;
                      ?>
                      <tr><td><br></td></tr>
                       <td colspan="3"><input type="checkbox" id="Proceso" name="Proceso" value="Cerrado"><font color="red">Proceso cerrado Completamente</font></td>
                      <tr><td><br></td></tr>
	               <td colspan="3">
	                <input type="submit" value="Grabar" class="boton" id="Grabar"></td>
	       </table>

         <?
        else:
           ?>
           <script language="javascript">
            alert("Este registro no se puede modificar por que el proceso ya esta cerrado, favor solicitar informacion a sistemas.!")
            history.back()
           </script>
           <?
        endif;
?>
</form>


  
</body>
</html>
