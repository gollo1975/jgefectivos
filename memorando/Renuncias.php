<html>
        <head>
                <title>Seguimiento por Renuncias</title>
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
                        if (document.getElementById("cedula").value.length <=0)
                        {
                            alert ("Digite el documento de identidad.");
                            document.getElementById("cedula").focus();
                            return;
                        }
                         document.getElementById("matmemo").submit();

                    }
                </script>
                <?
if (!isset($cedula)):?>
   <center><h4><u>Seguimiento por Renuncias</u></h4></center>
     <form action="" method="post" id="matmemo">
         <table border="0" align="center"
            <tr><td><br></td></tr>
           <tr>
              <td><b>Documento de Identidad:</b></td>
              <td><input type="text" name="cedula" value="" size="15" mexlength="15" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="cedula"></td>
           </tr>

           <tr><td><br></td></tr>
          <tr>
             <td colspan="6">
             <input type="button" Value="Guardar" class="boton" onClick="chequearcampos()">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
         </tr>
     </table>
  </form>
<?
else:
      include("../conexion.php");
      if($admon!=''):
	   $conM="select empleado.cedemple,concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' , apemple1) as nombres,zona.zona  from empleado,contrato,zona
	    where zona.codzona=empleado.codzona and
                   empleado.codemple=contrato.codemple and
	          contrato.fechater='0000-00-00' and
	          empleado.cedemple='$cedula' group by contrato.contrato DESC";
	   $resulM=mysql_query($conM) or die("Error al busca empleados");
	   $reg=mysql_num_rows($resulM);
	   $filas=mysql_fetch_array($resulM);
	   $nombres=$filas["nombres"];
	   if($reg==0):
	      ?>
	      <script language="javascript">
	         alert("Este empleado no se le puede hacer proceso disciplinario")
	         history.back()
	      </script>
	      <?
	   else:
	     ?>
	      <center><h4><u>Proceso Disciplinario</u></h4></center>
	      <form action="GrabarRenuncia.php" method="post">
              <input type="hidden" name="admon" value="<?echo $admon;?>">
	         <table border="0" align="center"

	             <tr>
	             <td><b>Documento:</b></td>
	             <td><input type="text" name="cedula" value="<?echo $cedula;?>" size="15" readonly class="cajas"></td>
	            </tr>
	             <tr>
	             <td><b>Empleado:</b></td>
	             <td><input type="text" name="" value="<?echo $nombres;?>" size="49"  readonly class="cajas"></td>
	            </tr>
                    <tr>
	             <td><b>Zona:</b></td>
	             <td><input type="text" name="zona" value="<?echo $filas["zona"];?>" size="49"  readonly class="cajas"></td>
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
	           </tr>
                   <td><b>Descargos:</b></td>
                   <td colspan="5"><textarea name="descargos" cols="101" rows="15" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="descargos" ></textarea></td>

	            <tr>
	               <td><b>Firma:</b></td>
	               <td><input type="text" name="firma" value="JONATHAN ALEJANDRO URIBE FLOREZ" size="40" maxlength="40"class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="firma"></td>
	               <td><b>Cargo:</b></td>
	               <td><input type="text" name="cargo" value="JEFE DE GESTION HUMANA" size="40" maxlength="40" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="cargo"></td>
	            </tr>
	            <tr>
	               <td><b>Empresa:</b></td>
	               <td><input type="text" name="empresa" value="JGEFECTIVOS S.A.S." size="40" maxlength="40" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="empresa"></td>
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
           $conM="select empleado.cedemple,concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' , apemple1) as nombres,zona.zona  from zona,empleado,contrato
	    where zona.codzona=empleado.codzona and
                  zona.codzona='$Szona' and
                  empleado.codemple=contrato.codemple and
	          contrato.fechater='0000-00-00' and
	          empleado.cedemple='$cedula' group by contrato.contrato DESC";
	   $resulM=mysql_query($conM) or die("Error al busca empleados");
	   $reg=mysql_num_rows($resulM);
	   $filas=mysql_fetch_array($resulM);
	   $nombres=$filas["nombres"];
	   if($reg==0):
	      ?>
	      <script language="javascript">
	         alert("Este empleado no se le puede hacer proceso de renuncia o no esta autorizado para elaborar el registro.")
	         history.back()
	      </script>
	      <?
	   else:
		     ?>
		      <center><h4><u>Proceso Disciplinario</u></h4></center>
		      <form action="GrabarRenuncia.php" method="post">
                      <input type="hidden" name="Szona" value="<?echo $Szona;?>">
                         <table border="0" align="center"

		             <tr>
		             <td><b>Documento:</b></td>
		             <td><input type="text" name="cedula" value="<?echo $cedula;?>" size="15" readonly class="cajas"></td>
		            </tr>
		             <tr>
		             <td><b>Empleado:</b></td>
		             <td><input type="text" name="zona" value="<?echo $nombres;?>" size="49"  readonly class="cajas"></td>
		            </tr>
	                    <tr>
		             <td><b>Zona:</b></td>
		             <td><input type="text" name="" value="<?echo $filas["zona"];?>" size="49"  readonly class="cajas"></td>
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
		           </tr>
	                   <td><b>Descargos:</b></td>
	                   <td colspan="5"><textarea name="descargos" cols="101" rows="15" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="descargos" ></textarea></td>

		            <tr>
		               <td><b>Firma:</b></td>
		               <td><input type="text" name="firma" value="" size="40" maxlength="40"class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="firma"></td>
		               <td><b>Cargo:</b></td>
		               <td><input type="text" name="cargo" value="" size="40" maxlength="40" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="cargo"></td>
		            </tr>
		            <tr>
		               <td><b>Empresa:</b></td>
		               <td><input type="text" name="empresa" value="JGEFECTIVOS S.A.S." size="40" maxlength="40" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="empresa"></td>
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
                $conM="select empleado.cedemple,concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' , apemple1) as nombres,zona.zona  from sucursal,zona,empleado,contrato
	         where sucursal.codsucursal=zona.codsucursal and
                  zona.codzona=empleado.codzona and
                  sucursal.codsucursal='$Sdepto' and
                  empleado.codemple=contrato.codemple and
	          contrato.fechater='0000-00-00' and
	          empleado.cedemple='$cedula'";
		   $resulM=mysql_query($conM) or die("Error al busca empleados sucursales");
		   $reg=mysql_num_rows($resulM);
		   $filas=mysql_fetch_array($resulM);
		   $nombres=$filas["nombres"];
		   if($reg==0):
		      ?>
		      <script language="javascript">
		         alert("Este empleado no se le puede hacer proceso de renuncia o no esta autorizado para elaborar el registro.")
		         history.back()
		      </script>
		      <?
		   else:
		     ?>
		      <center><h4><u>Proceso Disciplinario</u></h4></center>
		      <form action="GrabarRenuncia.php" method="post">
                      <input type="hidden" name="Sdepto" value="<?echo $Sdepto;?>">
                         <table border="0" align="center"

		             <tr>
		             <td><b>Documento:</b></td>
		             <td><input type="text" name="cedula" value="<?echo $cedula;?>" size="15" readonly class="cajas"></td>
		            </tr>
		             <tr>
		             <td><b>Empleado:</b></td>
		             <td><input type="text" name="" value="<?echo $nombres;?>" size="49"  readonly class="cajas"></td>
		            </tr>
	                    <tr>
		             <td><b>Zona:</b></td>
		             <td><input type="text" name="zona" value="<?echo $filas["zona"];?>" size="49"  readonly class="cajas"></td>
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
	                   <td><b>Descargos:</b></td>
	                   <td colspan="5"><textarea name="descargos" cols="101" rows="15" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="descargos" ></textarea></td>

		            <tr>
		               <td><b>Firma:</b></td>
		               <td><input type="text" name="firma" value="" size="40" maxlength="40"class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="firma"></td>
		               <td><b>Cargo:</b></td>
		               <td><input type="text" name="cargo" value="COORDINADORA DE OFICINA" size="40" maxlength="40" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="cargo"></td>
		            </tr>
		            <tr>
		               <td><b>Empresa:</b></td>
		               <td><input type="text" name="empresa" value="JGEFECTIVOS S.A.S." size="40" maxlength="40" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="empresa"></td>
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

 endif;
                 ?>
        </body>
</html>
