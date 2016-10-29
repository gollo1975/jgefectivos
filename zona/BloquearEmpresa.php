<html>
   <head>
       <title>Bloqueo de Empresa</title>
       <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
   </head>
  <body>
      <?
      if (!isset($Zona)):
          include("../conexion.php");
          ?>
          <center><h4><u>Bloqueo de Empresa</u></h4></center>
                <form action="" method="post">
                        <table border="0" align="center"
                                 <tr><td><br></td></tr>
                                 <tr>
			         <td><b>Zona:</b></td>
			         <td colspan="1"><select name="Zona" class="cajasletra">
			               <option value="0">Seleccione la zona
			               <?
			               $consulta_z="select codzona,zona from zona where estado='ACTIVA' and nomina='SI'  order by zona";
			               $resultado_z=mysql_query($consulta_z) or die("Error al buscar zonas");
			                while ($filas_z=mysql_fetch_array($resultado_z)):
			                   ?>
			                   <option value="<?echo $filas_z["codzona"];?>"><?echo $filas_z["zona"];?>
			                   <?
			               endwhile;
			                    ?>
			             </select></td>
			     </tr>
                               <tr>
                                       <td><b>Bloquear:</b></td>
                                        <td><select name="Estado" class="cajas">
                                        <option value="0">Seleccione
                                               <option value="NO">NO
                                                <option value="SI">SI
                                                </select></td>
                                 </tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                                <td colspan="2"><input type="submit" Value="Guardar" class="boton">&nbsp;<input type="reset" Value="Limpiar"class="boton"></td>
                                        </tr>
                                        <tr><td><br></td></tr>

                        </table>

                </form>
                 <?
                elseif(empty($Zona)):
                  ?>
                  <script language="javascript">
                     alert("Seleccion de la lista la zona!")
                     history.back()
                  </script>
                  <?
                  elseif(empty($Estado)):
                  ?>
                  <script language="javascript">
                     alert("Seleccione el estado de la empresa.")
                     history.back()
                  </script>
                  <?
                else:
                    include("../conexion.php");
                    $consulta="update zona set bloqueo='$Estado' where zona.codzona='$Zona'";
	            $resultado=mysql_query($consulta) or die("Error al editar");
	            $registros=mysql_affected_rows();
                     ?>
                       <script language="javascript">
                         alert("El bloque se actualizo con éxito en sistema.!")
                         open("BloquearEmpresa.php","_self")
                       </script>
                  <?
               endif;
                 ?>
        </body>
</html>
