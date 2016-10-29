<html>
        <head>
                <title>Agregar Memorando</title>
               <LINK  REL="stylesheet" HREF="../estilo.css" type="text/css">

        </head>
        <body>

           <script language="javascript">
                    function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }
                      function chequearcampos()
                    {
                        if (document.getElementById("Cedula").value.length <=0)
                        {
                            alert ("Digite el documento de identidad.");
                            document.getElementById("Cedula").focus();
                            return;
                        }
                        if (document.getElementById("FirmaP").value.length <=0)
                        {
                            alert ("Digitar el nombre de la persona que firma el Documento!");
                            document.getElementById("FirmaP").focus();
                            return;
                        }
                         document.getElementById("matmemo").submit();

                    }
                </script>
                <?
if (!isset($Cedula)){
    include("../conexion.php");  ?>
    <center><h4><u>P. Disciplinarios</u></h4></center>
     <form action="" method="post" id="matmemo" name="matmemo">
         <table border="0" align="center"
            <tr><td><br></td></tr>
           <tr>
              <td><b>Documento de Identidad:</b></td>
              <td><input type="text" name="Cedula" value="" size="15" mexlength="15" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Cedula"></td>
           </tr>
         <tr>
         <td><b>Tipo_Proceso:</b></td>
         <td colspan="1"><select name="TipoProceso" id="TipoProceso" class="cajasletra">
             <option value="0">Seleccione
             <?
             $consulta_z="select tipoprocesomemo.idproceso,tipoprocesomemo.concepto from tipoprocesomemo where estado='ACTIVO'  order by concepto";
             $resultado_z=mysql_query($consulta_z) or die("Error al buscar el proceso");
             while ($filas_z=mysql_fetch_array($resultado_z))
                   {
                   ?>
                   <option value="<?echo $filas_z["idproceso"];?>"><?echo $filas_z["concepto"];?>
                   <?
                   }
                   ?>
                   </select></td>
           </tr>
             <tr>
	        <td><b>Quien Firma:</b></td>
	           <td><input type="text" name="FirmaP" value="" size="40" maxlength="40"class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="FirmaP"></td>
	        </tr>
           <tr><td><br></td></tr>
          <tr>
             <td colspan="6">
             <input type="button" Value="Guardar" class="boton" id ="grabar" name="grabar" onClick="chequearcampos()">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
         </tr>
     </table>
  </form>
<?
}elseif(empty($TipoProceso)){
?>
  <script language="javascript">
     alert("Seleccion un proceso de la lista!")
     history.back()
  </script>
<?
}else{
      include("../conexion.php");
      $FirmaP=strtoupper($FirmaP);
      /*codigo que busca el tipo de proceso*/
       $conP="select tipoproceso.*,tipoprocesomemo.concepto  from tipoproceso,tipoprocesomemo
	       where tipoproceso.idproceso=tipoprocesomemo.idproceso and
	             tipoprocesomemo.idproceso='$TipoProceso'";
               $resP=mysql_query($conP) or die("Error al el tipo de proceso");
               $filaP=mysql_fetch_array($resP);
               $Concepto=$filaP["descripcion"];
               $DescripcionProceso= $filaP["concepto"];
      /*fin codigo*/
      if($admon!=''):
	   $conM="select empleado.cedemple,concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' , apemple1) as nombres  from empleado,contrato
	    where empleado.codemple=contrato.codemple and
	          contrato.fechater='0000-00-00' and
	          empleado.cedemple='$Cedula'";
	   $resulM=mysql_query($conM) or die("Error al busca empleados");
	   $reg=mysql_num_rows($resulM);
	   $filas=mysql_fetch_array($resulM);
	   $nombres=$filas["nombres"];
	   if($reg==0):
	      ?>
	      <script language="javascript">
	         alert("Este empleado no se le puede hacer proceso disciplinario por que esta retirado del Sistema!")
	         history.back()
	      </script>
	      <?
	   else:
	     ?>
	      <center><h4><u>Proceso Disciplinario</u></h4></center>
	      <form action="grabarnuevo.php" method="post" id="grabarnuevo">
              <input type="hidden" name="admon" value="<?echo $admon;?>">
                <input type="hidden" name="TipoProceso" value="<?echo $TipoProceso;?>">
	         <table border="0" align="center"
	         <tr><td><br></td></tr>
	           <tr>
	             <td><b>Fecha_Proceso:</b></td>
	             <td><input type="text" name="fecha" value="<?echo date("Y-m-d");?>" size="15" mexlength="10" class="cajas"></td>
	           </tr>
	            <tr>
	             <td><b>Señor:</b></td>
	             <td><input type="text" name="senor" value="Señor(a)" size="15" readonly class="cajas"></td>
	            </tr>
	             <tr>
	             <td><b>Documento:</b></td>
	             <td><input type="text" name="cedula" value="<?echo $Cedula;?>" size="15" readonly class="cajas"></td>
	            </tr>
	             <tr>
	             <td><b>Empleado:</b></td>
	             <td><input type="text" name="" value="<?echo $nombres;?>" size="40"  readonly class="cajas"></td>
	            </tr>
	            <tr>
	             <td><b>Municipio</b></td>
	                 <td><select name="municipio" class="cajasletra">
	                      <option value="0">Seleccione el Municipio
	                      <?
	                      $consulta_z="select codmuni,municipio from municipio  order by municipio";
	                      $resultado_z=mysql_query($consulta_z) or die("Error al buscar municipios");
	                      while ($filas_z=mysql_fetch_array($resultado_z)):
	                          ?>
	                          <option value="<?echo $filas_z["codmuni"];?>"><?echo $filas_z["municipio"];?>
	                         <?
	                      endwhile;
	                         ?>
	                   </select></td>
	            </tr>
	            <tr>
	              <td><b>Dirigida:</b></td>
	              <td><input type="text" name="dirigida" value="EMPLEADO JGEFECTIVOS SAS" size="40" class="cajas" mexlength="40"></td>
	            </tr>
	            <tr>
	              <td><b>Remitente:</b></td>
	              <td><input type="text" name="remitente" value="La Ciudad" size="25" mexlength="25"class="cajas"></td>
	           </tr>
	           <tr>
	              <td><b>Tipo_Proceso:</b></td>
	              <td><input type="text" name="asunto" value="<?echo $DescripcionProceso;?>" size="40" mexlength="40"class="cajas" readonly></td>
	            </tr>
	            <tr>
                     <td><b>Motivo:</b></td>
                      <td colspan="5"><p align="justify"><textarea name="nota" cols="89" rows="15" class="cajas" ><?echo $Concepto;?>  </textarea></td>
                    </tr>
	            <tr>
	               <td><b>Firma:</b></td>
	               <td><input type="text" name="firma" value="<?echo $FirmaP;?>" size="40" mexlength="40"class="cajas"></td>
                     </tr>
                     <tr>
	               <td><b>Cargo:</b></td>
	               <td><input type="text" name="cargo" value="JEFE DE GESTION HUMANA - SELECCION" size="40" mexlength="40" class="cajas"></td>
	            </tr>
	            <tr>
	               <td><b>Empresa:</b></td>
	               <td><input type="text" name="empresa" value="JGEFECTIVOS S.A.S." size="40" mexlength="40" class="cajas"></td>
	            </tr>
	            <tr><td><br></td></tr>
	            <tr>
	               <td colspan="6">
	                 <input type="submit" Value="Guardar" class="boton">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
	            </tr>
	     </table>
	   </form>
          <?
	   endif;
       else:
	       if($Szona!= 0):
	           $conM="select empleado.cedemple,concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' , apemple1) as nombres  from zona,empleado,contrato
		    where zona.codzona=empleado.codzona and
	                  zona.codzona='$Szona' and
	                  empleado.codemple=contrato.codemple and
		          contrato.fechater='0000-00-00' and
		          empleado.cedemple='$Cedula'";
		   $resulM=mysql_query($conM) or die("Error al busca empleados");
		   $reg=mysql_num_rows($resulM);
		   $filas=mysql_fetch_array($resulM);
		   $nombres=$filas["nombres"];
		   if($reg==0):
		      ?>
		      <script language="javascript">
		         alert("Este empleado no se le puede hacer proceso disciplinario o no esta autorizado para elaborar el registro.")
		         history.back()
		      </script>
		      <?
		   else:
			     ?>
			      <center><h4><u>Proceso Disciplinario</u></h4></center>
			      <form action="grabarnuevo.php" method="post">
	                      <input type="hidden" name="Szona" value="<?echo $Szona;?>">
						  <input type="hidden" name="TipoProceso" value="<?echo $TipoProceso;?>">
			         <table border="0" align="center"
			         <tr><td><br></td></tr>
	                           <tr>
			             <td><b>Fecha_Proceso:</b></td>
			             <td><input type="text" name="fecha" value="<?echo date("Y-m-d");?>" size="15" mexlength="10" class="cajas"></td>
			           </tr>
			            <tr>
			             <td><b>Señor:</b></td>
			             <td><input type="text" name="senor" value="Señor(a)" size="15" readonly class="cajas"></td>
			            </tr>
			             <tr>
			             <td><b>Documento:</b></td>
			             <td><input type="text" name="cedula" value="<?echo $Cedula;?>" size="15" readonly class="cajas"></td>
			            </tr>
			             <tr>
			             <td><b>Empleado:</b></td>
			             <td><input type="text" name="" value="<?echo $nombres;?>" size="40"  readonly class="cajas"></td>
			            </tr>
			            <tr>
			             <td><b>Municipio</b></td>
			                 <td><select name="municipio" class="cajasletra">
			                      <option value="0">Seleccione el Municipio
			                      <?
			                      $consulta_z="select codmuni,municipio from municipio  order by municipio";
			                      $resultado_z=mysql_query($consulta_z) or die("Error al buscar municipios");
			                      while ($filas_z=mysql_fetch_array($resultado_z)):
			                          ?>
			                          <option value="<?echo $filas_z["codmuni"];?>"><?echo $filas_z["municipio"];?>
			                         <?
			                      endwhile;
			                         ?>
			                   </select></td>
			            </tr>
			            <tr>
			              <td><b>Dirigida:</b></td>
			              <td><input type="text" name="dirigida" value="EMPLEADO JGEFECTIVOS SAS" size="40" class="cajas" mexlength="40"></td>
			            </tr>
			            <tr>
			              <td><b>Remitente:</b></td>
			              <td><input type="text" name="remitente" value="La Ciudad" size="25" mexlength="25"class="cajas"></td>
			           </tr>
			           <tr>
			              <td><b>Tipo_Proceso:</b></td>
			              <td><input type="text" name="asunto" value="<?echo $DescripcionProceso;?>" size="40" mexlength="40"class="cajas" readonly></td>
			            </tr>
			            <tr>
		                     <td><b>Motivo:</b></td>
		                      <td colspan="5"><p align="justify"><textarea name="nota" cols="89" rows="15" class="cajas" ><?echo $Concepto;?>  </textarea></td>
		                    </tr>
			            <tr>
			               <td><b>Firma:</b></td>
			               <td><input type="text" name="firma" value="<?echo $FirmaP;?>" size="40" mexlength="40"class="cajas"></td>
		                     </tr>
		                     <tr>
			               <td><b>Cargo:</b></td>
			               <td><input type="text" name="cargo" value="JEFE DE GESTION HUMANA - SELECCION" size="40" mexlength="40" class="cajas"></td>
			            </tr>
			            <tr>
			               <td><b>Empresa:</b></td>
			               <td><input type="text" name="empresa" value="JGEFECTIVOS S.A.S." size="40" mexlength="40" class="cajas"></td>
			            </tr>
			            <tr><td><br></td></tr>
			            <tr>
			               <td colspan="6">
			                 <input type="submit" Value="Guardar" class="boton">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
			            </tr>
		     </table>
		   </form>
	          <?
	      endif;
           else:
                $conM="select empleado.cedemple,concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' , apemple1) as nombres  from sucursal,zona,empleado,contrato
	         where sucursal.codsucursal=zona.codsucursal and
                  zona.codzona=empleado.codzona and
                  sucursal.codsucursal='$Sdepto' and
                  empleado.codemple=contrato.codemple and
	          contrato.fechater='0000-00-00' and
	          empleado.cedemple='$Cedula'";
		   $resulM=mysql_query($conM) or die("Error al busca empleados sucursales");
		   $reg=mysql_num_rows($resulM);
		   $filas=mysql_fetch_array($resulM);
		   $nombres=$filas["nombres"];
		   if($reg==0):
		      ?>
		      <script language="javascript">
		         alert("Este empleado no se le puede hacer proceso disciplinario o no esta autorizado para elaborar el registro.")
		         history.back()
		      </script>
		      <?
		   else:
			     ?>
			      <center><h4><u>Proceso Disciplinario</u></h4></center>
			      <form action="grabarnuevo.php" method="post">
	                 <input type="hidden" name="Sdepto" value="<?echo $Sdepto;?>">
					 <input type="hidden" name="TipoProceso" value="<?echo $TipoProceso;?>">
			         <table border="0" align="center"
				            <tr><td><br></td></tr>
	                                   <td><b>Fecha_Proceso:</b></td>
				             <td><input type="text" name="fecha" value="<?echo date("Y-m-d");?>" size="15" mexlength="10" class="cajas"></td>
				           </tr>
				            <tr>
				             <td><b>Señor:</b></td>
				             <td><input type="text" name="senor" value="Señor(a)" size="15" readonly class="cajas"></td>
				            </tr>
				             <tr>
				             <td><b>Documento:</b></td>
				             <td><input type="text" name="cedula" value="<?echo $Cedula;?>" size="15" readonly class="cajas"></td>
				            </tr>
				             <tr>
				             <td><b>Empleado:</b></td>
				             <td><input type="text" name="" value="<?echo $nombres;?>" size="40"  readonly class="cajas"></td>
				            </tr>
				            <tr>
				             <td><b>Municipio</b></td>
				                 <td><select name="municipio" class="cajasletra">
				                      <option value="0">Seleccione el Municipio
				                      <?
				                      $consulta_z="select codmuni,municipio from municipio  order by municipio";
				                      $resultado_z=mysql_query($consulta_z) or die("Error al buscar municipios");
				                      while ($filas_z=mysql_fetch_array($resultado_z)):
				                          ?>
				                          <option value="<?echo $filas_z["codmuni"];?>"><?echo $filas_z["municipio"];?>
				                         <?
				                      endwhile;
				                         ?>
				                   </select></td>
				            </tr>
				            <tr>
				              <td><b>Dirigida:</b></td>
				              <td><input type="text" name="dirigida" value="EMPLEADO JGEFECTIVOS SAS" size="40" class="cajas" mexlength="40"></td>
				            </tr>
				            <tr>
				              <td><b>Remitente:</b></td>
				              <td><input type="text" name="remitente" value="La Ciudad" size="25" mexlength="25"class="cajas"></td>
				           </tr>
				           <tr>
				              <td><b>Tipo_Proceso:</b></td>
				              <td><input type="text" name="asunto" value="<?echo $DescripcionProceso;?>" size="40" mexlength="40"class="cajas" readonly></td>
				            </tr>
				            <tr>
			                     <td><b>Motivo:</b></td>
			                      <td colspan="5"><p align="justify"><textarea name="nota" cols="89" rows="15" class="cajas" ><?echo $Concepto;?>  </textarea></td>
			                    </tr>
				            <tr>
				               <td><b>Firma:</b></td>
				               <td><input type="text" name="firma" value="<?echo $FirmaP;?>" size="40" mexlength="40"class="cajas"></td>
			                     </tr>
			                     <tr>
				               <td><b>Cargo:</b></td>
				               <td><input type="text" name="cargo" value="COORDINADOR(A) DE ZONA" size="40" mexlength="40" class="cajas"></td>
				            </tr>
				            <tr>
				               <td><b>Empresa:</b></td>
				               <td><input type="text" name="empresa" value="JGEFECTIVOS S.A.S." size="40" mexlength="40" class="cajas"></td>
				            </tr>
				            <tr><td><br></td></tr>
				            <tr>
				               <td colspan="6">
				                 <input type="submit" Value="Guardar" class="boton">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
				            </tr>
		           </table>
		   </form>
	          <?
	      endif;
           endif;
       endif;

}
                 ?>
        </body>
</html>
